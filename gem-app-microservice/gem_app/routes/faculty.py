from flask import Blueprint, request, jsonify
from flask_jwt_extended import jwt_required, get_jwt_identity

from gem_app.extensions import db
from gem_app.models.user import User
from gem_app.models.faculty import FacultyProfile, ResearchProject
from gem_app.models.matching import Match
from gem_app.models.student import StudentProfile

faculty = Blueprint('faculty', __name__)

def get_current_user():
    """Helper function to get the current user from JWT identity."""
    user_id = get_jwt_identity()
    if user_id:
        return User.query.get(user_id)
    return None

@faculty.route('/profile', methods=['GET'])
@jwt_required()
def get_faculty_profile():
    """Get the faculty profile for the current user."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Faculty profile not found'}), 404
    
    return jsonify({'profile': profile.to_dict()})

@faculty.route('/profile', methods=['PUT'])
@jwt_required()
def update_faculty_profile():
    """Update the faculty profile for the current user."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not profile:
        return jsonify({'error': 'Faculty profile not found'}), 404
    
    data = request.json or {}
    
    if 'department' in data:
        profile.department = data['department']
    if 'research_areas' in data:
        profile.research_areas = data['research_areas']
    if 'office_location' in data:
        profile.office_location = data['office_location']
    if 'available_positions' in data:
        profile.available_positions = int(data['available_positions'])
    
    try:
        # Validate fields
        profile._validate_fields()
        db.session.commit()
        return jsonify({'success': True, 'profile_id': profile.id})
    except ValueError as e:
        return jsonify({'error': str(e)}), 400

@faculty.route('/projects', methods=['GET'])
@jwt_required()
def list_projects():
    """List all research projects for the current faculty."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    projects = ResearchProject.query.filter_by(faculty_profile_id=faculty_profile.id).all()
    
    return jsonify({
        'projects': [project.to_dict() for project in projects]
    })

@faculty.route('/projects', methods=['POST'])
@jwt_required()
def create_project():
    """Create a new research project."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    data = request.json or {}
    
    new_project = ResearchProject(
        faculty_profile_id=faculty_profile.id,
        title=data.get('title', 'Untitled'),
        description=data.get('description', ''),
        area_of_law=data.get('area_of_law', ''),
        required_skills=data.get('required_skills', ''),
        is_active=True,
        created_by_user=current_user.id
    )
    
    db.session.add(new_project)
    db.session.commit()
    
    return jsonify({'success': True, 'project_id': new_project.id})

@faculty.route('/projects/<int:project_id>', methods=['PUT'])
@jwt_required()
def update_project(project_id):
    """Update a specific research project."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    project = ResearchProject.query.filter_by(
        id=project_id, 
        faculty_profile_id=faculty_profile.id
    ).first()
    
    if not project:
        return jsonify({'error': 'Project not found'}), 404
    
    data = request.json or {}
    
    if 'title' in data:
        project.title = data['title']
    if 'description' in data:
        project.description = data['description']
    if 'area_of_law' in data:
        project.area_of_law = data['area_of_law']
    if 'required_skills' in data:
        project.required_skills = data['required_skills']
    if 'is_active' in data:
        project.is_active = bool(data['is_active'])
    
    project.updated_by_user = current_user.id
    db.session.commit()
    
    return jsonify({'success': True})

@faculty.route('/projects/<int:project_id>', methods=['DELETE'])
@jwt_required()
def delete_project(project_id):
    """Delete a specific research project."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    project = ResearchProject.query.filter_by(
        id=project_id, 
        faculty_profile_id=faculty_profile.id
    ).first()
    
    if not project:
        return jsonify({'error': 'Project not found'}), 404
    
    db.session.delete(project)
    db.session.commit()
    
    return jsonify({'success': True, 'message': 'Project deleted'})

@faculty.route('/matches', methods=['GET'])
@jwt_required()
def view_matches():
    """List all matches for the current faculty."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    matches = Match.query.filter_by(faculty_profile_id=faculty_profile.id).all()
    
    result = []
    for match in matches:
        student = StudentProfile.query.get(match.student_profile_id)
        student_user = student.user if student else None
        
        result.append({
            'match_id': match.id,
            'student_name': f"{student_user.first_name} {student_user.last_name}" if student_user else "Unknown",
            'student_id': student_user.student_id if student_user else None,
            'status': match.status,
            'score': match.score,
            'accepted_at': match.accepted_at.isoformat() if match.accepted_at else None,
            'rejected_at': match.rejected_at.isoformat() if match.rejected_at else None
        })
    
    return jsonify({'matches': result})

@faculty.route('/matches/<int:match_id>/decision', methods=['POST'])
@jwt_required()
def match_decision(match_id):
    """Accept or reject a match."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    faculty_profile = FacultyProfile.query.filter_by(user_id=current_user.id).first()
    if not faculty_profile:
        return jsonify({'error': 'No faculty profile found'}), 404
    
    match = Match.query.filter_by(
        id=match_id, 
        faculty_profile_id=faculty_profile.id
    ).first()
    
    if not match:
        return jsonify({'error': 'Match not found'}), 404
    
    data = request.json or {}
    action = data.get('action')
    reason = data.get('reason', '')
    
    if action == 'accept':
        if faculty_profile.filled_positions >= faculty_profile.available_positions:
            return jsonify({'error': 'No available positions remain.'}), 400
        
        match.accept(current_user.id)
        faculty_profile.fill_position()
        
        # Update student status
        student = StudentProfile.query.get(match.student_profile_id)
        if student:
            student.status = 'matched'
            db.session.commit()
        
        return jsonify({'success': True, 'status': 'accepted'})
    
    elif action == 'reject':
        match.reject(current_user.id, reason)
        return jsonify({'success': True, 'status': 'rejected'})
    
    else:
        return jsonify({'error': 'Invalid action; must be "accept" or "reject"'}), 400

@faculty.route('/student/<int:student_id>/approve-document', methods=['POST'])
@jwt_required()
def approve_student_document(student_id):
    """Approve a student document (learning plan, midpoint checkin, final reflection)."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'faculty':
        return jsonify({'error': 'Faculty privileges required'}), 403
    
    # Check if this faculty is matched with the student
    student = StudentProfile.query.get_or_404(student_id)
    
    match = Match.query.filter_by(
        student_profile_id=student.id,
        faculty_profile_id=FacultyProfile.query.filter_by(user_id=current_user.id).first().id,
        status='accepted'
    ).first()
    
    if not match:
        return jsonify({'error': 'You are not matched with this student'}), 403
    
    data = request.json or {}
    document_type = data.get('document_type')
    
    if document_type == 'learning_plan':
        student.learning_plan_approved_by_mentor = True
    elif document_type == 'midpoint':
        student.midpoint_approved_by_mentor = True
    elif document_type == 'final_reflection':
        student.final_reflection_approved_by_mentor = True
    else:
        return jsonify({'error': 'Invalid document type'}), 400
    
    db.session.commit()
    
    return jsonify({'success': True, 'message': f'{document_type} approved'})