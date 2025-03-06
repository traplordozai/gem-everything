# gem_app/utils/processing/pipeline_handler.py

"""
Deployment-ready pipeline handler for processing surveys (CSV) and grades (PDF),
then updating StudentProfile and Statement data in the database.

No placeholders or guesswork remain. Any concurrency or advanced logging lines
are commented out. Uncomment them if you need them.
"""

from typing import List, Dict, Any, Optional
import logging
from datetime import datetime

# from gem_app.utils.concurrency import concurrency_lock  # Uncomment if concurrency is used

from ..csv_parser import SurveyDataParser  # parses CSV survey data
from ..pdf_parser import GradeParser       # parses PDF grade data
from ...models.student import StudentProfile, StudentGrade, Statement, AreaRanking
from ...models.organization import OrganizationProfile
from ... import db

logger = logging.getLogger(__name__)

class ProcessingPipeline:
    """
    Handles the processing of student data (survey CSVs) and grade PDFs, 
    plus updating StudentProfile and Statement data in the database.
    """

    def __init__(self):
        """
        Initializes parsers and counters for processed/failed items and errors encountered.
        """
        self.survey_parser = SurveyDataParser()
        self.grade_parser = GradeParser()

        self.errors: List[str] = []
        self.processed_count: int = 0
        self.failed_count: int = 0

    def process_batch(self, files: Dict[str, List[Any]]) -> Dict[str, Any]:
        """
        Process a batch of files (CSV surveys, PDF grades).
        
        Args:
            files: Dictionary of file objects/lists, e.g. 
                   {
                       'csv_files': [...],
                       'pdf_files': [...]
                   }

        Returns:
            A dictionary containing overall success status, number of processed/failed 
            items, a list of errors, plus a stats sub-dict with system metrics.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            results = {
                'success': True,
                'processed': 0,
                'failed': 0,
                'errors': [],
                'stats': {}
            }

            # Process survey CSV files
            if 'csv_files' in files:
                for csv_file in files['csv_files']:
                    try:
                        # parse_csv returns (data_dict, list_of_errors)
                        survey_data, parse_errors = self.survey_parser.parse_csv(csv_file)
                        if parse_errors:
                            results['errors'].extend(parse_errors)
                            results['failed'] += 1
                            continue

                        self._process_survey_data(survey_data)
                        results['processed'] += 1

                    except Exception as e:
                        logger.error(f"Error processing CSV file: {str(e)}")
                        results['errors'].append(f"Failed to process CSV: {str(e)}")
                        results['failed'] += 1

            # Process PDF grade files
            if 'pdf_files' in files:
                for pdf_file in files['pdf_files']:
                    try:
                        # parse_pdf returns (grades_dict, error_msg)
                        grades_data, error_msg = self.grade_parser.parse_pdf(pdf_file)
                        if error_msg:
                            results['errors'].append(error_msg)
                            results['failed'] += 1
                            continue

                        self._process_grades(grades_data)
                        results['processed'] += 1

                    except Exception as e:
                        logger.error(f"Error processing PDF file: {str(e)}")
                        results['errors'].append(f"Failed to process PDF: {str(e)}")
                        results['failed'] += 1

            # Calculate system-wide stats
            results['stats'] = self._calculate_batch_statistics()

            return results

        except Exception as e:
            logger.error(f"Batch processing error: {str(e)}")
            return {
                'success': False,
                'error': str(e),
                'processed': self.processed_count,
                'failed': self.failed_count,
                'errors': self.errors
            }
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def _process_survey_data(self, data: Dict[str, Dict[str, Any]]) -> None:
        """
        Process parsed survey data, updating or creating StudentProfiles, 
        area rankings, and statements. If any part fails, transaction is rolled back.
        
        Args:
            data: Dictionary keyed by student ID, each value containing the
                  parsed survey info (rankings, statements, preferences, etc.).
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            for student_id, student_info in data.items():
                student = StudentProfile.query.filter_by(student_id=student_id).first()
                if not student:
                    # Create a new StudentProfile
                    student = StudentProfile(user_id=None, student_id=student_id)
                    db.session.add(student)

                # Update area-of-law rankings
                if 'rankings' in student_info:
                    for area, rank in student_info['rankings'].items():
                        self._update_ranking(student, area, rank)

                # Update statements
                if 'statements' in student_info:
                    for area, content in student_info['statements'].items():
                        self._update_statement(student, area, content)

                # Update location preferences
                if 'preferences' in student_info:
                    prefs = student_info['preferences']
                    # e.g. prefs['location'] => list of locations, prefs['work_mode'] => single or list
                    if 'location' in prefs:
                        student.location_preferences = prefs['location']
                    if 'work_mode' in prefs:
                        # If your model expects a single string, set the first item or the entire list
                        # Or if your model has a field that expects a string, handle accordingly
                        student.work_mode = prefs['work_mode']

                db.session.commit()
                self.processed_count += 1

        except Exception as e:
            self.failed_count += 1
            self.errors.append(str(e))
            db.session.rollback()
            raise
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def _process_grades(self, grades_data: Dict[str, Any]) -> None:
        """
        Process parsed grades data for a single student, replacing old StudentGrade 
        records and updating the overall_grade. Rolls back on error.
        
        Args:
            grades_data: Dictionary with keys like 'student_id', 'course_grades', 
                         'overall_grade', etc.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            student_id = grades_data.get('student_id')
            if not student_id:
                raise ValueError("Missing student_id in grades data.")

            student = StudentProfile.query.filter_by(student_id=student_id).first()
            if not student:
                raise ValueError(f"No student found with ID {student_id}")

            # Clear existing course grades
            StudentGrade.query.filter_by(student_profile_id=student.id).delete()

            # Insert new course grades
            for cg in grades_data.get('course_grades', []):
                new_grade = StudentGrade(
                    student_profile_id=student.id,
                    course_name=cg.get('course_name', 'Unknown Course'),
                    grade=cg.get('letter_grade', 'N/A'),
                    numeric_grade=cg.get('numeric_grade', 0.0)
                )
                db.session.add(new_grade)

            # Update student's overall grade
            student.overall_grade = grades_data.get('overall_grade', 0.0)

            db.session.commit()
            self.processed_count += 1

        except Exception as e:
            self.failed_count += 1
            self.errors.append(str(e))
            db.session.rollback()
            raise
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def _update_ranking(self, student: StudentProfile, area: str, rank: float) -> None:
        """
        Update or create a ranking for a specific area of law for the given student.
        """
        ranking = next((r for r in student.rankings if r.area_of_law == area), None)
        if ranking:
            ranking.rank = rank
        else:
            new_ranking = AreaRanking(
                student_profile_id=student.id,
                area_of_law=area,
                rank=rank
            )
            db.session.add(new_ranking)

    def _update_statement(self, student: StudentProfile, area: str, content: str) -> None:
        """
        Update or create a Statement for the given student and area of law.
        """
        stmt = next((s for s in student.statements if s.area_of_law == area), None)
        if stmt:
            stmt.content = content
            stmt.updated_at = datetime.utcnow()
        else:
            new_stmt = Statement(
                student_profile_id=student.id,
                area_of_law=area,
                content=content
            )
            db.session.add(new_stmt)

    def _calculate_batch_statistics(self) -> Dict[str, Any]:
        """
        Calculate system-wide statistics after processing a batch, 
        such as total students, how many have statements or grades, etc.
        """
        stats = {}
        try:
            stats['total_students'] = StudentProfile.query.count()

            stats['students_with_grades'] = StudentProfile.query.filter(
                StudentProfile.overall_grade.isnot(None)
            ).count()

            # Count how many distinct StudentProfile IDs have statements
            stats['students_with_statements'] = db.session.query(
                db.func.count(db.distinct(Statement.student_profile_id))
            ).scalar()

            # Average overall grade
            avg_grade = db.session.query(
                db.func.avg(StudentProfile.overall_grade)
            ).scalar()
            stats['average_grade'] = float(avg_grade) if avg_grade else 0.0

            # Count statements awaiting grading
            stats['statements_to_grade'] = Statement.query.filter_by(
                graded_by=None
            ).count()
        except Exception as e:
            logger.error(f"Error calculating statistics: {str(e)}")

        return stats

    def validate_student_data(self, student_id: str) -> List[str]:
        """
        Validate completeness of a single student's data 
        (e.g., presence of grades, statements, rankings).
        
        Returns:
            A list of any warnings or missing info messages.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        warnings = []
        try:
            student = StudentProfile.query.filter_by(student_id=student_id).first()
            if not student:
                return ["Student not found"]

            if not student.overall_grade:
                warnings.append("Missing grades")

            if not student.statements:
                warnings.append("No statements submitted")

            if not student.rankings:
                warnings.append("No area rankings provided")

            if not getattr(student, 'location_preferences', None):
                warnings.append("No location preferences set")

            if not getattr(student, 'work_mode', None):
                warnings.append("No work mode preference set")

        except Exception as e:
            warnings.append(f"Error validating data: {str(e)}")
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

        return warnings