# gem_app/routes/admin.py

import os
import csv
import io
from datetime import datetime, timedelta

from flask import (
    Blueprint, request, jsonify,
    current_app, Response
)
from flask_login import login_required, current_user
from flask_jwt_extended import jwt_required, get_jwt_identity
from sqlalchemy import func, or_

from gem_app import db
from gem_app.models.user import User
from gem_app.models.student import StudentProfile, StudentGrade
from gem_app.models.organization import OrganizationProfile
from gem_app.models.matching import Match, MatchHistory, MatchingRound
from gem_app.utils.decorators import admin_required
from gem_app.utils.matching_service import MatchingService  # If used
from gem_app.utils.pdf_parser import process_grade_pdf      # If you parse PDF files
from gem_app.utils.csv_parser import process_survey_data    # If you parse CSV data
from ..models.student import StudentProfile

admin = Blueprint('admin', __name__)


def allowed_file(filename, allowed_extensions) -> bool:
    """
    Simple helper to check if the uploaded file has an allowed extension.
    """
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in allowed_extensions


# ------------------------------------------------------------------------------
# DASHBOARD (formerly rendered an HTML template)
# ------------------------------------------------------------------------------
@admin.route('/dashboard')
@login_required
@admin_required
def dashboard():
    """
    Returns admin dashboard stats in JSON. 
    Formerly rendered 'admin/dashboard.html'.
    """
    stats = {
        'total_students': StudentProfile.query.count(),
        'matched_students': StudentProfile.query.filter_by(status='matched').count(),
        'pending_matches': Match.query.filter_by(status='pending').count()
    }

    # Example: Students waiting for final admin acceptance
    final_approval_list = StudentProfile.query.filter(
        StudentProfile.learning_plan_approved_by_mentor.is_(True),
        StudentProfile.midpoint_approved_by_mentor.is_(True),
        StudentProfile.final_reflection_approved_by_mentor.is_(True),
        StudentProfile.deliverables_accepted_by_admin.is_(False)
    ).all()

    # Return both stats and a minimal list of students needing admin acceptance
    approval_students = []
    for s in final_approval_list:
        approval_students.append({
            'id': s.id,
            'name': f"{s.user.first_name} {s.user.last_name}",
            'status': s.status
        })

    return jsonify({
        'stats': stats,
        'final_approval_list': approval_students
    })


# ------------------------------------------------------------------------------
# FINAL ACCEPTANCE
# ------------------------------------------------------------------------------
@admin.route('/final-acceptance/<int:student_id>', methods=['POST'])
@login_required
@admin_required
def final_acceptance(student_id):
    """
    Marks the student's deliverables as fully accepted by admin, 
    changing student.status to 'completed'. Returns JSON.
    """
    student = StudentProfile.query.get_or_404(student_id)

    # Ensure mentors have approved everything
    if not (
        student.learning_plan_approved_by_mentor and
        student.midpoint_approved_by_mentor and
        student.final_reflection_approved_by_mentor
    ):
        return jsonify({'error': 'All mentor/supervisor approvals are not complete.'}), 400

    student.deliverables_accepted_by_admin = True
    student.status = 'completed'
    db.session.commit()

    return jsonify({'success': True})


# ------------------------------------------------------------------------------
# MATCHING INTERFACE (formerly 'matching_interface' that rendered 'admin/matching.html')
# ------------------------------------------------------------------------------
@admin.route('/matching')
@login_required
@admin_required
def matching_interface():
    """
    Returns matching stats and current matches in JSON, 
    instead of rendering an HTML page.
    """
    try:
        stats = {
            'total_students': StudentProfile.query.count(),
            'matched_students': StudentProfile.query.filter_by(status='matched').count(),
            'unmatched_students': StudentProfile.query.filter_by(status='unmatched').count(),
            'available_positions': db.session.query(
                func.sum(OrganizationProfile.available_positions)
            ).scalar() or 0
        }
        organizations = OrganizationProfile.query.all()

        # Pull current matches and associated student/org data
        matches_query = (
            db.session.query(Match, StudentProfile, OrganizationProfile)
            .join(StudentProfile, Match.student_profile_id == StudentProfile.id)
            .outerjoin(OrganizationProfile, Match.organization_profile_id == OrganizationProfile.id)
            .all()
        )

        formatted_matches = []
        for match_obj, student, org in matches_query:
            formatted_matches.append({
                'match_id': match_obj.id,
                'status': match_obj.status,
                'student_name': f"{student.user.first_name} {student.user.last_name}",
                'student_id': student.user.student_id or student.id,
                'organization_name': org.name if org else None
            })

        # Return as JSON
        return jsonify({
            'stats': stats,
            'organizations': [
                {'id': org.id, 'name': org.name} for org in organizations
            ],
            'matches': formatted_matches
        })

    except Exception as e:
        current_app.logger.error(f"Error in matching interface: {str(e)}")
        return jsonify({'error': 'Error loading matching interface.', 'details': str(e)}), 500


# ------------------------------------------------------------------------------
# MATCHING STATS
# ------------------------------------------------------------------------------
@admin.route('/matching/stats')
@login_required
@admin_required
def get_matching_stats():
    """
    Returns the latest matching stats in JSON for the front-end.
    """
    try:
        stats = {
            'total_students': StudentProfile.query.count(),
            'matched_students': StudentProfile.query.filter_by(status='matched').count(),
            'unmatched_students': StudentProfile.query.filter_by(status='unmatched').count(),
            'available_positions': db.session.query(
                func.sum(OrganizationProfile.available_positions)
            ).scalar() or 0
        }
        return jsonify({'success': True, 'stats': stats})
    except Exception as e:
        current_app.logger.error(f"Error getting matching stats: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# START MATCHING
# ------------------------------------------------------------------------------
@admin.route('/matching/start', methods=['POST'])
@login_required
@admin_required
def start_matching():
    """
    Initiates the matching process by running the algorithm and storing results.
    Returns JSON.
    """
    try:
        round_number = MatchingRound.query.count() + 1
        matching_round = MatchingRound(
            round_number=round_number,
            status='started',
            started_by=current_user.id
        )
        matching_round.save()

        # Example usage of an external matching service:
        # matching_service = MatchingService()
        # results = matching_service.run_algorithm()
        # For demo, pretend results are empty:
        results = {'matches': [], 'unmatched': []}

        matching_round.status = 'completed'
        matching_round.completed_at = datetime.utcnow()
        matching_round.matched_students = len(results['matches'])
        db.session.commit()

        return jsonify({
            'success': True,
            'matches': len(results['matches']),
            'unmatched': len(results['unmatched'])
        })
    except Exception as e:
        current_app.logger.error(f"Error running matching process: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# RESET MATCHES
# ------------------------------------------------------------------------------
@admin.route('/matching/reset', methods=['POST'])
@login_required
@admin_required
def reset_matches():
    """
    Deletes all matches, resets student statuses, and resets org positions.
    Returns JSON.
    """
    try:
        Match.query.delete()
        StudentProfile.query.update({StudentProfile.status: 'unmatched'})
        OrganizationProfile.query.update({OrganizationProfile.filled_positions: 0})
        db.session.commit()
        return jsonify({'success': True})
    except Exception as e:
        current_app.logger.error(f"Error resetting matches: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# LIST MATCHES
# ------------------------------------------------------------------------------
@admin.route('/matching/list')
@login_required
@admin_required
def list_matches():
    """
    Returns a JSON list of current matches for dynamic UI updates.
    """
    try:
        matches_query = (
            db.session.query(Match, StudentProfile, OrganizationProfile)
            .join(StudentProfile, Match.student_profile_id == StudentProfile.id)
            .outerjoin(OrganizationProfile, Match.organization_profile_id == OrganizationProfile.id)
            .all()
        )

        formatted = []
        for match_obj, student, org in matches_query:
            formatted.append({
                'id': match_obj.id,
                'student_name': f"{student.user.first_name} {student.user.last_name}",
                'student_id': student.user.student_id or student.id,
                'organization_name': org.name if org else "Unmatched",
                'score': match_obj.score or 0,
                'status': match_obj.status
            })

        return jsonify({'matches': formatted})
    except Exception as e:
        current_app.logger.error(f"Error listing matches: {str(e)}")
        return jsonify({'error': str(e)}), 500


# ------------------------------------------------------------------------------
# UPDATE MATCH
# ------------------------------------------------------------------------------
@admin.route('/matching/<int:match_id>', methods=['PUT'])
@login_required
@admin_required
def update_match(match_id):
    """
    Updates a specific match's organization or other details, returning JSON.
    """
    try:
        match_obj = Match.query.get_or_404(match_id)
        data = request.get_json()

        if 'organization_id' in data:
            old_org_id = match_obj.organization_profile_id
            new_org_id = data['organization_id']

            # Decrement old org's filled_positions
            if old_org_id and old_org_id != new_org_id:
                old_org = OrganizationProfile.query.get(old_org_id)
                if old_org and old_org.filled_positions > 0:
                    old_org.filled_positions -= 1
                    old_org.save()

            # Increment new org's filled_positions
            if new_org_id and new_org_id != old_org_id:
                new_org = OrganizationProfile.query.get(new_org_id)
                if new_org.filled_positions >= new_org.available_positions:
                    raise ValueError("Organization has no available positions.")
                new_org.filled_positions += 1
                new_org.save()

            match_obj.organization_profile_id = new_org_id
            match_obj.match_type = 'manual'
            match_obj.modified_by = current_user.id
            match_obj.save()

        return jsonify({'success': True})

    except ValueError as e:
        return jsonify({'success': False, 'error': str(e)}), 400
    except Exception as e:
        current_app.logger.error(f"Error updating match: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# VIEW GRADES (formerly rendered a template)
# ------------------------------------------------------------------------------
@admin.route('/grades')
@login_required
@admin_required
def view_grades():
    """
    Returns a JSON list of all students & their overall grades 
    (previously rendered 'admin/view-grades.html').
    """
    students = StudentProfile.query.all()
    data = []
    for s in students:
        data.append({
            'id': s.id,
            'student_name': f"{s.user.first_name} {s.user.last_name}",
            'overall_grade': s.overall_grade,
            'status': s.status
        })
    return jsonify({'students': data})


# ------------------------------------------------------------------------------
# FILTER GRADES
# ------------------------------------------------------------------------------
@admin.route('/grades/filter', methods=['POST'])
@login_required
@admin_required
def filter_grades():
    """
    Filters grades based on search, grade range, upload date, and status.
    Returns JSON for dynamic updates.
    """
    try:
        data = request.get_json()
        query = StudentProfile.query.join(User)

        # Name / ID search
        if data.get('search'):
            search_pattern = f"%{data['search']}%"
            query = query.filter(
                or_(
                    User.first_name.ilike(search_pattern),
                    User.last_name.ilike(search_pattern),
                    User.student_id.ilike(search_pattern)
                )
            )

        # Grade range
        if data.get('grade_range'):
            min_grade, max_grade = map(float, data['grade_range'].split('-'))
            query = query.filter(StudentProfile.overall_grade.between(min_grade, max_grade))

        # Upload date filters
        if data.get('upload_date'):
            today = datetime.utcnow().date()
            if data['upload_date'] == 'today':
                query = query.join(StudentGrade).filter(
                    func.date(StudentGrade.created_at) == today
                )
            elif data['upload_date'] == 'week':
                week_ago = today - timedelta(days=7)
                query = query.join(StudentGrade).filter(
                    StudentGrade.created_at >= week_ago
                )
            elif data['upload_date'] == 'month':
                month_ago = today - timedelta(days=30)
                query = query.join(StudentGrade).filter(
                    StudentGrade.created_at >= month_ago
                )

        # Status filter
        if data.get('status'):
            query = query.filter(StudentProfile.status == data['status'])

        filtered_students = query.all()

        def format_grade_breakdown(grades):
            if not grades:
                return None
            snippet = ", ".join([
                f"{g.course_name}: {g.grade}"
                for g in grades[:3]
            ])
            if len(grades) > 3:
                snippet += "..."
            return snippet

        results = []
        for sp in filtered_students:
            results.append({
                'id': sp.id,
                'name': f"{sp.user.first_name} {sp.user.last_name}",
                'student_id': sp.user.student_id,
                'overall_grade': sp.overall_grade,
                'grade_breakdown': format_grade_breakdown(sp.grades),
                'upload_date': sp.grades[0].created_at.strftime('%Y-%m-%d') if sp.grades else None,
                'status': sp.status
            })

        return jsonify({'success': True, 'students': results})
    except Exception as e:
        current_app.logger.error(f"Error filtering grades: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# GET GRADE DETAILS
# ------------------------------------------------------------------------------
@admin.route('/grades/<int:student_id>')
@login_required
@admin_required
def get_grade_details(student_id):
    """
    Returns detailed grade info for a specific student in JSON form.
    """
    try:
        student = StudentProfile.query.get_or_404(student_id)
        return jsonify({
            'success': True,
            'grades': [{
                'course_name': g.course_name,
                'letter_grade': g.grade,
                'numeric_grade': g.numeric_grade,
                'created_at': g.created_at.strftime('%Y-%m-%d')
            } for g in student.grades],
            'overall_grade': student.overall_grade
        })
    except Exception as e:
        current_app.logger.error(f"Error fetching grade details: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# EXPORT GRADES (CSV)
# ------------------------------------------------------------------------------
@admin.route('/grades/export')
@login_required
@admin_required
def export_grades():
    """
    Exports all student grades to a CSV file for download.
    """
    try:
        students = StudentProfile.query.all()
        output = io.StringIO()
        writer = csv.writer(output)

        writer.writerow([
            'Student ID', 'First Name', 'Last Name', 'Overall Grade',
            'Course Name', 'Letter Grade', 'Numeric Grade', 'Date'
        ])

        for sp in students:
            for g in sp.grades:
                writer.writerow([
                    sp.user.student_id,
                    sp.user.first_name,
                    sp.user.last_name,
                    sp.overall_grade,
                    g.course_name,
                    g.grade,
                    g.numeric_grade,
                    g.created_at.strftime('%Y-%m-%d')
                ])

        output.seek(0)
        return Response(
            output.getvalue(),
            mimetype='text/csv',
            headers={'Content-Disposition': 'attachment; filename=grades_export.csv'}
        )
    except Exception as e:
        current_app.logger.error(f"Error exporting grades: {str(e)}")
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# REPROCESS GRADES
# ------------------------------------------------------------------------------
@admin.route('/grades/<int:student_id>/reprocess', methods=['POST'])
@login_required
@admin_required
def reprocess_grades(student_id):
    """
    Re-parses a PDF for updated grades (using process_grade_pdf).
    Returns JSON.
    """
    try:
        student = StudentProfile.query.get_or_404(student_id)
        pdf_path = os.path.join(
            current_app.config['GRADES_FOLDER'],
            f"{student.user.student_id}_grades.pdf"
        )
        if not os.path.exists(pdf_path):
            raise FileNotFoundError("No PDF found for that student.")

        # parse the PDF for new grades
        grades_data, error_msg = process_grade_pdf(pdf_path)
        if error_msg:
            raise ValueError(error_msg)

        # remove existing grades
        StudentGrade.query.filter_by(student_profile_id=student.id).delete()

        # add new
        for g in grades_data['course_grades']:
            db.session.add(StudentGrade(
                student_profile_id=student.id,
                course_name=g['course_name'],
                grade=g['letter_grade'],
                numeric_grade=g['numeric_grade']
            ))

        student.overall_grade = grades_data['overall_grade']
        student.status = 'verified'
        db.session.commit()

        return jsonify({'success': True})
    except Exception as e:
        db.session.rollback()
        return jsonify({'error': str(e)}), 500


# ------------------------------------------------------------------------------
# DELETE GRADES
# ------------------------------------------------------------------------------
@admin.route('/grades/<int:student_id>', methods=['DELETE'])
@login_required
@admin_required
def delete_grades(student_id):
    """
    Deletes all grades for a given student, resetting them to 'pending'.
    Returns JSON.
    """
    try:
        student = StudentProfile.query.get_or_404(student_id)
        StudentGrade.query.filter_by(student_profile_id=student.id).delete()
        student.overall_grade = None
        student.status = 'pending'
        db.session.commit()

        return jsonify({'success': True})
    except Exception as e:
        db.session.rollback()
        return jsonify({'success': False, 'error': str(e)}), 500


# ------------------------------------------------------------------------------
# IMPORT SURVEY
# ------------------------------------------------------------------------------
@admin.route('/import/survey', methods=['POST'])
@login_required
@admin_required
def import_survey():
    """
    Imports CSV data for student surveys, or PDFs in bulk if needed.
    Returns JSON.
    """
    try:
        if 'file' not in request.files:
            return jsonify({'error': 'No file uploaded'}), 400

        file = request.files['file']
        if not file.filename:
            return jsonify({'error': 'No file selected'}), 400

        if allowed_file(file.filename, {'csv'}):
            filename = file.filename
            filepath = os.path.join(current_app.config['UPLOAD_FOLDER'], filename)
            file.save(filepath)

            try:
                process_survey_data(filepath)
                os.remove(filepath)
                return jsonify({'success': True})
            except Exception as e:
                return jsonify({'error': str(e)}), 500
        else:
            return jsonify({'error': 'Invalid file type (expected .csv)'}), 400

    except Exception as e:
        current_app.logger.error(f"Error importing survey: {str(e)}")
        return jsonify({'error': str(e)}), 500


# ------------------------------------------------------------------------------
# UPLOAD GRADES (PDF) (formerly rendered 'admin/upload-grades.html')
# ------------------------------------------------------------------------------
@admin.route('/upload-grades', methods=['GET', 'POST'])
@login_required
@admin_required
def upload_grades():
    """
    For uploading PDF grade files and processing them with process_grade_pdf.
    Previously rendered an HTML form; now returns JSON.
    """
    if request.method == 'POST':
        if 'files[]' not in request.files:
            return jsonify({'success': False, 'error': 'No files uploaded'})

        uploaded_files = request.files.getlist('files[]')
        processed_results = []

        for file in uploaded_files:
            if not file.filename:
                continue
            if allowed_file(file.filename, {'pdf'}):
                try:
                    filename = file.filename
                    filepath = os.path.join(current_app.config['GRADES_FOLDER'], filename)
                    file.save(filepath)

                    grades_data, error = process_grade_pdf(filepath)
                    if error:
                        processed_results.append({
                            'filename': filename,
                            'success': False,
                            'message': f"Error processing file: {error}",
                            'student_id': None
                        })
                        continue

                    student_id = grades_data.get('student_id')
                    student = StudentProfile.query.join(User).filter(User.student_id == student_id).first()

                    if not student:
                        processed_results.append({
                            'filename': filename,
                            'success': False,
                            'message': f"No student found with ID {student_id}",
                            'student_id': student_id
                        })
                        continue

                    # Clear existing
                    StudentGrade.query.filter_by(student_profile_id=student.id).delete()

                    for g in grades_data['course_grades']:
                        db.session.add(StudentGrade(
                            student_profile_id=student.id,
                            course_name=g['course_name'],
                            grade=g['letter_grade'],
                            numeric_grade=g['numeric_grade']
                        ))

                    student.overall_grade = grades_data['overall_grade']
                    db.session.commit()

                    processed_results.append({
                        'filename': filename,
                        'success': True,
                        'message': f"Processed grades for student {student_id}",
                        'student_id': student_id
                    })
                except Exception as e:
                    processed_results.append({
                        'filename': file.filename,
                        'success': False,
                        'message': str(e),
                        'student_id': None
                    })
                    db.session.rollback()
            else:
                processed_results.append({
                    'filename': file.filename,
                    'success': False,
                    'message': "Invalid file type (must be .pdf)",
                    'student_id': None
                })

        return jsonify({
            'success': True,
            'processed_files': processed_results
        })

@admin.route('/api/students', methods=['GET'])
def api_students():
    """
    Returns a JSON list of all students so WordPress can fetch real data.
    In production, you’d likely add authentication, but for now we keep it open.
    """
    students = StudentProfile.query.all()

    result = []
    for s in students:
        # If your StudentProfile references a User:
        user = s.user
        if user:
            full_name = f"{user.first_name} {user.last_name}"
            student_id = user.student_id
        else:
            full_name = "Unknown"
            student_id = "N/A"

        result.append({
            "id": s.id,
            "name": full_name,
            "status": s.status,
            "student_id": student_id,
            "overall_grade": s.overall_grade,
        })

    return jsonify({"students": result}), 200

    # If you really want a GET route to return JSON or a message:
    return jsonify({
        'info': "This endpoint accepts POST requests with PDFs in 'files[]'."
    })