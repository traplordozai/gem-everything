from functools import wraps
from flask import abort, flash, redirect, url_for, jsonify
from flask_login import current_user

def admin_required(f):
    """Decorator that checks if the current user is an admin."""
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if not current_user.is_authenticated:
            return jsonify({'error': 'Authentication required'}), 401
        if current_user.role != 'admin':
            return jsonify({'error': 'Admin privileges required'}), 403
        return f(*args, **kwargs)
    return decorated_function

def faculty_required(f):
    """Decorator that checks if the current user is faculty."""
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if not current_user.is_authenticated:
            return jsonify({'error': 'Authentication required'}), 401
        if current_user.role != 'faculty':
            return jsonify({'error': 'Faculty privileges required'}), 403
        return f(*args, **kwargs)
    return decorated_function

def organization_required(f):
    """Decorator that checks if the current user is an organization."""
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if not current_user.is_authenticated:
            return jsonify({'error': 'Authentication required'}), 401
        if current_user.role != 'organization':
            return jsonify({'error': 'Organization privileges required'}), 403
        return f(*args, **kwargs)
    return decorated_function

def student_required(f):
    """Decorator that checks if the current user is a student."""
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if not current_user.is_authenticated:
            return jsonify({'error': 'Authentication required'}), 401
        if current_user.role != 'student':
            return jsonify({'error': 'Student privileges required'}), 403
        return f(*args, **kwargs)
    return decorated_function

def role_required(*roles):
    """Decorator that checks if the current user has any of the specified roles."""
    @wraps(role_required)
    def decorator(f):
        @wraps(f)
        def decorated_function(*args, **kwargs):
            if not current_user.is_authenticated:
                return jsonify({'error': 'Authentication required'}), 401
            if current_user.role not in roles:
                return jsonify({'error': 'Insufficient privileges'}), 403
            return f(*args, **kwargs)
        return decorated_function
    return decorator