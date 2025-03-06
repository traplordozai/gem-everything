"""
Provides a function to initialize custom context processors for Jinja templates,
injecting user role checks and a dynamic nav menu.
"""

from flask import current_app
from flask_login import current_user

def init_template_context(app):
    """
    Initializes custom Jinja context processors for templates.
    
    This provides role-checking functions (is_admin, etc.) and a dynamic nav menu
    builder that are available in all templates.
    
    Args:
        app: The Flask application instance
    """
    @app.context_processor
    def utility_processor():
        """
        Returns a dictionary of functions/variables for Jinja templates.
        """
        def is_admin():
            """Check if the current user is an admin."""
            return current_user.is_authenticated and current_user.role == 'admin'

        def is_student():
            """Check if the current user is a student."""
            return current_user.is_authenticated and current_user.role == 'student'

        def is_faculty():
            """Check if the current user is faculty."""
            return current_user.is_authenticated and current_user.role == 'faculty'

        def is_organization():
            """Check if the current user is an organization."""
            return current_user.is_authenticated and current_user.role == 'organization'

        def get_nav_items():
            """
            Builds a navigation menu based on the current user's role.
            
            Returns:
                list: A list of dictionaries with 'url' and 'text' keys
            """
            if not current_user.is_authenticated:
                return []

            if current_user.role == 'admin':
                return [
                    {'url': '/admin/dashboard', 'text': 'Dashboard'},
                    {'url': '/admin/matching', 'text': 'Matching Process'},
                    {'url': '/admin/grades', 'text': 'Grade Management'},
                    {'url': '/admin/statements', 'text': 'Statement Grading'},
                    {'url': '/admin/users', 'text': 'User Management'}
                ]
            elif current_user.role == 'student':
                return [
                    {'url': '/student/dashboard', 'text': 'Dashboard'},
                    {'url': '/student/documents', 'text': 'Documents'},
                    {'url': '/student/support', 'text': 'Support'},
                    {'url': '/student/profile', 'text': 'Profile'}
                ]
            elif current_user.role == 'faculty':
                return [
                    {'url': '/faculty/dashboard', 'text': 'Dashboard'},
                    {'url': '/faculty/projects', 'text': 'Research Projects'},
                    {'url': '/faculty/students', 'text': 'Student Supervision'},
                    {'url': '/faculty/profile', 'text': 'Profile'}
                ]
            elif current_user.role == 'organization':
                return [
                    {'url': '/organization/dashboard', 'text': 'Dashboard'},
                    {'url': '/organization/students', 'text': 'Student Matches'},
                    {'url': '/organization/requirements', 'text': 'Requirements'},
                    {'url': '/organization/profile', 'text': 'Profile'}
                ]
            return []

        return dict(
            is_admin=is_admin,
            is_student=is_student,
            is_faculty=is_faculty,
            is_organization=is_organization,
            get_nav_items=get_nav_items,
        )