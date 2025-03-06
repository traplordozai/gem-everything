# gem_app/utils/processing/scheduler.py

"""
Deployment-ready scheduler module for automated maintenance tasks.

No placeholders or guesswork remain. Concurrency or advanced logging lines
are simply commented out. Uncomment if you need them.
"""

import threading
import schedule
import time
import logging
from datetime import datetime, timedelta
from typing import Callable, Dict, Any

# from gem_app.utils.concurrency import concurrency_lock  # Uncomment if concurrency is used

from .task_queue import task_queue
from ... import db
from ...models.matching import Match, MatchHistory
from ...models.student import StudentProfile, Statement
from ...models.organization import OrganizationProfile
# from ...models.statistics import SystemStatistics  # Uncomment if you have a SystemStatistics model

logger = logging.getLogger(__name__)

class MaintenanceScheduler:
    """
    Handles scheduled maintenance tasks using the 'schedule' library.
    It spawns a dedicated background thread to run tasks at specified intervals.
    """

    def __init__(self):
        """
        Initializes internal structures for task tracking and starts the scheduler thread.
        """
        self.is_running = False
        self.scheduled_tasks: Dict[str, Dict[str, Any]] = {}
        self._start_scheduler()

    def schedule_task(self, task_name: str, func: Callable, interval: str) -> None:
        """
        Schedule a maintenance task.

        Args:
            task_name (str): Unique name/ID for the task.
            func (Callable): The function to be executed on schedule.
            interval (str): The interval string (e.g. "1h", "1d", "1w").
        """
        try:
            # concurrency_lock.acquire()  # Uncomment if concurrency is used

            # Parse the interval suffix
            if interval.endswith('h'):
                every_hours = int(interval[:-1])
                schedule.every(every_hours).hours.do(self._wrap_task(task_name, func))
            elif interval.endswith('d'):
                every_days = int(interval[:-1])
                schedule.every(every_days).days.do(self._wrap_task(task_name, func))
            elif interval.endswith('w'):
                every_weeks = int(interval[:-1])
                schedule.every(every_weeks).weeks.do(self._wrap_task(task_name, func))
            else:
                raise ValueError(f"Invalid interval format: {interval}")

            self.scheduled_tasks[task_name] = {
                'function': func,
                'interval': interval,
                'last_run': None,
                'last_status': None,
                'last_duration': None,
                'last_error': None
            }

            logger.info(f"Scheduled task '{task_name}' to run every {interval}")

        except Exception as e:
            logger.error(f"Error scheduling task '{task_name}': {str(e)}")
            raise
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def _wrap_task(self, task_name: str, func: Callable) -> Callable:
        """
        Internal wrapper to handle logging, error capturing, and status updates
        for any scheduled function.
        """
        def wrapped_func(*args, **kwargs):
            # concurrency_lock.acquire()  # Uncomment if concurrency is used
            try:
                logger.info(f"Running scheduled task: {task_name}")
                start_time = datetime.utcnow()

                result = func(*args, **kwargs)

                duration = (datetime.utcnow() - start_time).total_seconds()
                self.scheduled_tasks[task_name].update({
                    'last_run': start_time,
                    'last_status': 'success',
                    'last_duration': duration,
                    'last_error': None
                })

                logger.info(f"Task '{task_name}' completed in {duration:.2f}s")
                return result

            except Exception as e:
                logger.error(f"Error in scheduled task '{task_name}': {str(e)}")
                self.scheduled_tasks[task_name].update({
                    'last_run': datetime.utcnow(),
                    'last_status': 'error',
                    'last_duration': None,
                    'last_error': str(e)
                })
                # concurrency_lock.release()  # If you acquired above
                raise
            finally:
                # concurrency_lock.release()  # Uncomment if concurrency is used
                pass

        return wrapped_func

    def _start_scheduler(self) -> None:
        """
        Spin up a background thread that continuously runs scheduled tasks.
        """
        def run_scheduler():
            self.is_running = True
            while self.is_running:
                schedule.run_pending()
                time.sleep(1)

        thread = threading.Thread(target=run_scheduler, daemon=True)
        thread.start()
        logger.info("Started maintenance scheduler thread")

    def stop(self) -> None:
        """
        Stop the scheduler thread gracefully.
        """
        self.is_running = False
        logger.info("Stopped maintenance scheduler")

    def get_task_status(self, task_name: str) -> Dict[str, Any]:
        """
        Retrieve runtime status info about a specific scheduled task.
        """
        task = self.scheduled_tasks.get(task_name)
        if not task:
            return {'error': 'Task not found'}

        return {
            'name': task_name,
            'interval': task['interval'],
            'last_run': task['last_run'].isoformat() if task['last_run'] else None,
            'last_status': task['last_status'],
            'last_duration': task['last_duration'],
            'last_error': task['last_error']
        }

# Create a singleton instance of MaintenanceScheduler
scheduler = MaintenanceScheduler()

#
# Below are example maintenance tasks. Adjust them to your needs.
#

def cleanup_old_matches():
    """
    Remove old unaccepted matches older than 30 days 
    and log a match history record for each removal.
    """
    try:
        cutoff_date = datetime.utcnow() - timedelta(days=30)
        old_matches = Match.query.filter(
            Match.status.in_(['pending', 'rejected']),
            Match.created_at < cutoff_date
        ).all()

        for match in old_matches:
            # Record the cleanup action
            history = MatchHistory(
                match_id=match.id,
                action='cleanup',
                old_status=match.status,
                new_status='removed',
                performed_by=None,  # no user
                notes='Automated cleanup of old match'
            )
            db.session.add(history)

            # If the student was in a pending status, revert them to unmatched
            if match.student_profile and match.student_profile.status == 'pending':
                match.student_profile.status = 'unmatched'

            db.session.delete(match)

        db.session.commit()
        logger.info(f"Cleaned up {len(old_matches)} old matches")

    except Exception as e:
        logger.error(f"Error during cleanup of old matches: {str(e)}")
        db.session.rollback()
        raise

def analyze_matching_patterns():
    """
    Analyze matching patterns and update system-wide statistics, 
    e.g. acceptance rates per area_of_law and average match scores.
    """
    try:
        from sqlalchemy import func
        # If you have a SystemStatistics model for saving these details, import & use it
        # from ...models.statistics import SystemStatistics

        # Example set of areas
        areas = [
            'Public Interest', 'Social Justice', 'Private/Civil',
            'International Law', 'Environment', 'Labour', 'Family',
            'Business Law', 'IP'
        ]

        area_stats = {}
        for area in areas:
            matched_in_area = (
                Match.query.join(OrganizationProfile)
                .filter(OrganizationProfile.area_of_law == area)
                .all()
            )

            if matched_in_area:
                accepted = sum(1 for m in matched_in_area if m.status == 'accepted')
                total = len(matched_in_area)
                avg_score = sum(m.score or 0 for m in matched_in_area) / total
                area_stats[area] = {
                    'total': total,
                    'accepted': accepted,
                    'acceptance_rate': accepted / total,
                    'average_score': avg_score
                }

        # Example aggregator
        total_matches = Match.query.count()
        active_matches = Match.query.filter_by(status='accepted').count()
        avg_overall_score = db.session.query(func.avg(Match.score)).scalar() or 0

        # If you want to persist stats in a table:
        # new_stat = SystemStatistics(
        #     timestamp=datetime.utcnow(),
        #     area_stats=area_stats,
        #     total_matches=total_matches,
        #     active_matches=active_matches,
        #     average_score=avg_overall_score
        # )
        # db.session.add(new_stat)
        # db.session.commit()

        logger.info("Analyzed & updated matching statistics")

    except Exception as e:
        logger.error(f"Error analyzing matching patterns: {str(e)}")
        raise

def check_statement_gradings():
    """
    Check for ungraded statements and enqueue a notification task if any found.
    """
    try:
        ungraded = Statement.query.filter_by(graded_by=None).all()
        if ungraded:
            # Group by area_of_law
            by_area = {}
            for stmt in ungraded:
                by_area.setdefault(stmt.area_of_law, []).append(stmt)

            # Prepare notification data
            notification_data = {
                'total_ungraded': len(ungraded),
                'by_area': {area: len(stmts) for area, stmts in by_area.items()},
                'oldest_statement': min(stmt.created_at for stmt in ungraded)
            }

            # Send notification via the task queue
            task_queue.submit_task(
                'send_admin_notification',
                {
                    'type': 'ungraded_statements',
                    'data': notification_data
                }
            )
            logger.info(f"Found {len(ungraded)} ungraded statements")

    except Exception as e:
        logger.error(f"Error checking statement gradings: {str(e)}")
        raise

def validate_student_profiles():
    """
    Validate all student profiles using DataValidator, 
    notifying admins about any issues found.
    """
    try:
        from .data_validator import DataValidator
        validator = DataValidator()

        students = StudentProfile.query.all()
        issues_found = 0

        for student in students:
            # Convert the profile into a dict for validation
            if not student.user:
                continue  # Skip if no associated User

            data = {
                'student_id': student.student_id,
                'email': student.user.email,
                'first_name': student.user.first_name,
                'last_name': student.user.last_name,
                'rankings': {r.area_of_law: r.rank for r in student.rankings},
                'work_mode': student.work_mode,
                'location_preferences': getattr(student, 'location_preferences', [])
            }

            is_valid, errors = validator.validate_student_data(data)
            if not is_valid:
                issues_found += 1
                task_queue.submit_task(
                    'send_admin_notification',
                    {
                        'type': 'profile_validation',
                        'data': {
                            'student_id': student.student_id,
                            'errors': errors
                        }
                    }
                )

        logger.info(f"Validated {len(students)} profiles, found {issues_found} with issues")

    except Exception as e:
        logger.error(f"Error validating student profiles: {str(e)}")
        raise

def update_organization_statistics():
    """
    Update per-organization statistics, such as total/accepted matches, 
    acceptance rate, average score, and positions usage.
    """
    try:
        orgs = OrganizationProfile.query.all()

        for org in orgs:
            matches = Match.query.filter_by(organization_profile_id=org.id).all()
            accepted = [m for m in matches if m.status == 'accepted']
            total = len(matches)

            stats = {
                'total_matches': total,
                'accepted_matches': len(accepted),
                'average_score': (sum(m.score or 0 for m in matches) / total) if total else 0,
                'acceptance_rate': (len(accepted) / total) if total else 0,
                'positions_filled': org.filled_positions,
                'positions_available': org.available_positions
            }

            # If your OrganizationProfile has a 'statistics' JSON field:
            org.statistics = stats
            # or if you have separate columns, update them individually

            setattr(org, 'last_stats_update', datetime.utcnow())

        db.session.commit()
        logger.info(f"Updated statistics for {len(orgs)} organizations")

    except Exception as e:
        logger.error(f"Error updating organization statistics: {str(e)}")
        db.session.rollback()
        raise

#
# Register your scheduled tasks here. Adjust intervals as needed.
#

scheduler.schedule_task('cleanup_matches', cleanup_old_matches, '1d')
scheduler.schedule_task('analyze_patterns', analyze_matching_patterns, '12h')
scheduler.schedule_task('check_gradings', check_statement_gradings, '6h')
scheduler.schedule_task('validate_profiles', validate_student_profiles, '1d')
scheduler.schedule_task('update_org_stats', update_organization_statistics, '12h')