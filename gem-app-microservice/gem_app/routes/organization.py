from flask import Blueprint, request, jsonify
from flask_jwt_extended import jwt_required, get_jwt_identity

from gem_app.extensions import db
from gem_app.models.user import User
from gem_app.models.organization import OrganizationProfile, OrganizationRequirement
from gem_app.models.matching import Match
from gem_app.models.student import StudentProfile

organization = Blueprint('organization', __name__)

def get_current_user():
    """Helper function to get the current user from JWT identity."""
    user_id = get_jwt_identity()
    if user_id:
        return User.query.get(user_id)
    return None

@organization.route('/profile', methods=['GET'])
@jwt_required()
def get_org_profile():
    """Get the organization profile for the current user."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    return jsonify({'organization': org.to_dict()})

@organization.route('/profile', methods=['PUT'])
@jwt_required()
def update_org_profile():
    """Update the organization profile for the current user."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    data = request.json or {}
    
    if 'name' in data:
        org.name = data['name']
    if 'area_of_law' in data:
        org.area_of_law = data['area_of_law']
    if 'description' in data:
        org.description = data['description']
    if 'website' in data:
        org.website = data['website']
    if 'location' in data:
        org.location = data['location']
    if 'work_mode' in data:
        org.work_mode = data['work_mode']
    if 'available_positions' in data:
        org.available_positions = int(data['available_positions'])
    
    db.session.commit()
    
    return jsonify({'success': True, 'org_id': org.id})

@organization.route('/requirements', methods=['GET'])
@jwt_required()
def list_requirements():
    """List requirements for the current organization."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    reqs = OrganizationRequirement.query.filter_by(organization_profile_id=org.id).all()
    
    return jsonify({
        'requirements': [r.to_dict() for r in reqs]
    })

@organization.route('/requirements', methods=['POST'])
@jwt_required()
def add_requirement():
    """Add a new requirement for the current organization."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    data = request.json or {}
    
    new_req = OrganizationRequirement(
        organization_profile_id=org.id,
        requirement_type=data.get('requirement_type', 'unspecified'),
        value=data.get('value', ''),
        is_mandatory=bool(data.get('is_mandatory', False))
    )
    
    db.session.add(new_req)
    db.session.commit()
    
    return jsonify({'success': True, 'req_id': new_req.id})

@organization.route('/requirements/<int:req_id>', methods=['PUT'])
@jwt_required()
def update_requirement(req_id):
    """Update a specific requirement."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    req = OrganizationRequirement.query.get_or_404(req_id)
    org = OrganizationProfile.query.get(req.organization_profile_id)
    
    if org.user_id != current_user.id:
        return jsonify({'error': 'Not your organization'}), 403
    
    data = request.json or {}
    
    if 'requirement_type' in data:
        req.requirement_type = data['requirement_type']
    if 'value' in data:
        req.value = data['value']
    if 'is_mandatory' in data:
        req.is_mandatory = bool(data['is_mandatory'])
    
    db.session.commit()
    
    return jsonify({'success': True})

@organization.route('/requirements/<int:req_id>', methods=['DELETE'])
@jwt_required()
def delete_requirement(req_id):
    """Delete a specific requirement."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    req = OrganizationRequirement.query.get_or_404(req_id)
    org = OrganizationProfile.query.get(req.organization_profile_id)
    
    if org.user_id != current_user.id:
        return jsonify({'error': 'Not your organization'}), 403
    
    db.session.delete(req)
    db.session.commit()
    
    return jsonify({'success': True, 'message': 'Requirement deleted'})

@organization.route('/matches', methods=['GET'])
@jwt_required()
def list_matches():
    """List all matches for the current organization."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    matches = Match.query.filter_by(organization_profile_id=org.id).all()
    
    result = []
    for match in matches:
        student = StudentProfile.query.get(match.student_profile_id)
        student_user = student.user if student else None
        
        result.append({
            'match_id': match.id,
            'status': match.status,
            'student_name': f"{student_user.first_name} {student_user.last_name}" if student_user else "Unknown",
            'student_id': student_user.student_id if student_user else None,
            'created_at': match.created_at.isoformat() if match.created_at else None,
            'accepted_at': match.accepted_at.isoformat() if match.accepted_at else None,
            'rejected_at': match.rejected_at.isoformat() if match.rejected_at else None
        })
    
    return jsonify({'matches': result})

@organization.route('/matches/<int:match_id>/decision', methods=['POST'])
@jwt_required()
def match_decision(match_id):
    """Accept or reject a match."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'organization':
        return jsonify({'error': 'Organization privileges required'}), 403
    
    org = OrganizationProfile.query.filter_by(user_id=current_user.id).first()
    if not org:
        return jsonify({'error': 'Organization profile not found'}), 404
    
    match = Match.query.filter_by(id=match_id, organization_profile_id=org.id).first()
    if not match:
        return jsonify({'error': 'Match not found or not associated with your organization'}), 404
    
    data = request.json or {}
    action = data.get('action')
    reason = data.get('reason', '')
    
    if action == 'accept':
        if org.filled_positions >= org.available_positions:
            return jsonify({'error': 'No available positions remaining'}), 400
        
        match.accept(current_user.id)
        org.fill_position()
        
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