import os
import json
import re
from datetime import date, datetime, timedelta

from flask import Blueprint, request, jsonify, current_app
from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_mail import Message

from gem_app.extensions import db, mail
from gem_app.models.user import User
from gem_app.models.student import StudentProfile
from gem_app.models.matching import Match
from gem_app.models.support import SupportTicket

student = Blueprint('student', __name__)

def get_current_user():
    """Helper function to get the current user from JWT identity."""
    user_id = get_jwt_identity()
    if user_id:
        return User.query.get(user_id)
    return None

def word_count(text: str):
    """Count the number of words in a text."""
    return len(re.findall(r'\w+', text))

def get_due_dates(start_date: date):
    """Calculate due dates based on program start date."""
    learning_plan_due = start_date + timedelta(days=6)
    midpoint_due = start_date + timedelta(days=34)
    final_due = start_date + timedelta(days=69)
    return learning_plan_due, midpoint_due, final_due

def is_past_deadline(submitted: bool, due_date: date) -> bool:
    """Check if a deadline has passed without submission."""
    if submitted:
        return False
    return date.today() > due_date

@student.route('/dashboard', methods=['GET'])
@jwt_required()
def dashboard():
    """Get student dashboard information."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Student profile not found.'}), 404

    if not profile.start_date:
        return jsonify({
            'student_id': profile.id,
            'status': profile.status,
            'late_message': None,
            'info': 'No start_date set. Possibly new or not enrolled yet.'
        })

    lp_due, mid_due, final_due = get_due_dates(profile.start_date)
    has_lp = bool(profile.learning_plan_text or profile.learning_plan_path)
    has_mid = bool(profile.midpoint_checkin_text or profile.midpoint_checkin_path)
    has_final = bool(profile.final_reflection_text or profile.final_reflection_path)

    late_message = None
    if (is_past_deadline(has_lp, lp_due)
        or is_past_deadline(has_mid, mid_due)
        or is_past_deadline(has_final, final_due)):
        late_message = "You are overdue on one or more deliverables. Contact admin."

    # Get current match information
    current_match = Match.query.filter_by(
        student_profile_id=profile.id, 
        status='accepted'
    ).first()
    
    match_info = None
    if current_match:
        org_name = None
        faculty_name = None
        
        if current_match.organization_profile:
            org_name = current_match.organization_profile.name
            
        if current_match.faculty_profile and current_match.faculty_profile.user:
            faculty_user = current_match.faculty_profile.user
            faculty_name = f"{faculty_user.first_name} {faculty_user.last_name}"
            
        match_info = {
            'id': current_match.id,
            'organization_name': org_name,
            'faculty_name': faculty_name,
            'matched_date': current_match.accepted_at.isoformat() if current_match.accepted_at else None
        }

    return jsonify({
        'student_id': profile.id,
        'status': profile.status,
        'late_message': late_message,
        'match': match_info,
        'documents': {
            'learning_plan': has_lp,
            'midpoint_checkin': has_mid,
            'final_reflection': has_final,
            'resume': bool(profile.resume_path),
            'cover_letter': bool(profile.cover_letter_path),
            'transcript': bool(profile.transcript_path)
        },
        'approvals': {
            'learning_plan': profile.learning_plan_approved_by_mentor,
            'midpoint': profile.midpoint_approved_by_mentor,
            'final_reflection': profile.final_reflection_approved_by_mentor,
            'admin_acceptance': profile.deliverables_accepted_by_admin
        }
    })

@student.route('/support', methods=['POST'])
@jwt_required()
def support():
    """Submit a support ticket or complaint."""
    current_user = get_current_user()
    if not current_user:
        return jsonify({'error': 'Authentication required'}), 401
    
    data = request.json
    if not data:
        return jsonify({'error': 'No JSON data provided'}), 400
    
    category = data.get('category', 'other').lower()
    subject = data.get('subject', '').strip()
    message = data.get('message', '').strip()
    
    if not message:
        return jsonify({'error': 'Message field is required'}), 400

    priority = 'normal'
    if category in ['complaint', 'technical']:
        priority = 'high'

    new_ticket = SupportTicket(
        student_id=current_user.id,
        category=category,
        subject=subject or None,
        message=message,
        priority=priority
    )
    db.session.add(new_ticket)
    db.session.commit()

    if category == 'complaint':
        try:
            admin_email = current_app.config.get('MAIL_USERNAME')
            if admin_email:
                msg = Message(
                    subject=f"New Complaint (Ticket #{new_ticket.id})",
                    sender=current_app.config['MAIL_DEFAULT_SENDER'],
                    recipients=[admin_email],
                    body=(
                        f"Category: {category}\nSubject: {subject}\nMessage:\n{message}\n\n"
                        f"From Student ID: {current_user.id} - {current_user.email}"
                    )
                )
                mail.send(msg)
        except Exception as e:
            current_app.logger.error(f"Error sending complaint email: {e}")

    return jsonify({'success': True, 'ticket_id': new_ticket.id})

@student.route('/learning-plan', methods=['POST'])
@jwt_required()
def learning_plan():
    """Submit a learning plan."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Student profile not found.'}), 404
    
    data = request.json or {}
    required_fields = ["student_name", "mentor_name", "organization", "plan_date", "goals"]
    for field in required_fields:
        if field not in data or not data[field]:
            return jsonify({'error': f"{field} is required"}), 400
    
    if len(data["goals"]) < 3:
        return jsonify({'error': 'At least 3 goals required'}), 400
    
    profile.learning_plan_text = json.dumps(data)
    db.session.commit()
    
    return jsonify({'success': True, 'message': 'Learning Plan submitted'})

@student.route('/midpoint-checkin', methods=['POST'])
@jwt_required()
def midpoint_checkin():
    """Submit a midpoint check-in."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Student profile not found.'}), 404
    
    data = request.json or {}
    for i in ["student_name", "mentor_name", "organization", "checkin_date", "q1", "q2", "q3", "q4", "q5", "q6"]:
        if not data.get(i):
            return jsonify({'error': f"{i} is required"}), 400
    
    profile.midpoint_checkin_text = json.dumps(data)
    db.session.commit()
    
    return jsonify({'success': True, 'message': 'Midpoint Check-in submitted'})

@student.route('/final-reflection', methods=['POST'])
@jwt_required()
def final_reflection():
    """Submit a final reflection."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Student profile not found.'}), 404
    
    data = request.json or {}
    reflection = data.get('reflection_text', '').strip()
    if not reflection:
        return jsonify({'error': 'reflection_text is required'}), 400
    
    wc = word_count(reflection)
    if wc < 200 or wc > 1000:
        return jsonify({'error': 'Reflection must be 200-1000 words'}), 400
    
    profile.final_reflection_text = reflection
    db.session.commit()
    
    return jsonify({'success': True, 'message': 'Final Reflection submitted'})

@student.route('/upload-document', methods=['POST'])
@jwt_required()
def upload_document():
    """Upload a document file (PDF)."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    if 'file' not in request.files:
        return jsonify({'error': 'No file uploaded'}), 400
    
    file = request.files['file']
    doc_type = request.form.get('type')
    
    if not doc_type:
        return jsonify({'error': 'Missing doc type'}), 400
    
    if file.filename == '':
        return jsonify({'error': 'No file selected'}), 400
    
    if '.' not in file.filename:
        return jsonify({'error': 'Invalid filename'}), 400
    
    ext = file.filename.rsplit('.', 1)[1].lower()
    if ext != 'pdf':
        return jsonify({'error': 'File must be PDF'}), 400
    
    filename = f"{current_user.id}_{doc_type}_{datetime.now().strftime('%Y%m%d%H%M%S')}.pdf"
    filepath = os.path.join(current_app.config['UPLOAD_FOLDER'], filename)
    file.save(filepath)
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Student profile not found'}), 404
    
    if doc_type == 'resume':
        profile.resume_path = filepath
    elif doc_type == 'cover_letter':
        profile.cover_letter_path = filepath
    elif doc_type == 'transcript':
        profile.transcript_path = filepath
    elif doc_type == 'learning_plan':
        profile.learning_plan_path = filepath
    elif doc_type == 'midpoint_checkin':
        profile.midpoint_checkin_path = filepath
    elif doc_type == 'final_reflection':
        profile.final_reflection_path = filepath
    else:
        return jsonify({'error': 'Unknown doc_type'}), 400
    
    db.session.commit()
    
    return jsonify({'success': True})

@student.route('/status', methods=['GET'])
@jwt_required()
def check_status():
    """Check current student status and match information."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'student':
        return jsonify({'error': 'Student privileges required'}), 403
    
    profile = StudentProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'No profile found'}), 404
    
    current_match = Match.query.filter_by(student_profile_id=profile.id, status='accepted').first()
    
    data = {
        'status': profile.status,
        'matched_organization': (
            current_match.organization_profile.name if current_match and current_match.organization_profile else None
        ),
        'matched_faculty': (
            f"{current_match.faculty_profile.user.first_name} {current_match.faculty_profile.user.last_name}" 
            if current_match and current_match.faculty_profile and current_match.faculty_profile.user 
            else None
        ),
        'documents': {
            'resume': bool(profile.resume_path),
            'cover_letter': bool(profile.cover_letter_path),
            'learning_plan': bool(profile.learning_plan_path) or bool(profile.learning_plan_text),
            'midpoint_checkin': bool(profile.midpoint_checkin_path) or bool(profile.midpoint_checkin_text),
            'final_reflection': bool(profile.final_reflection_path) or bool(profile.final_reflection_text)
        }
    }
    
    return jsonify(data)