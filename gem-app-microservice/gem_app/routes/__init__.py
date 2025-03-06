# Import all blueprints to make them available when importing from gem_app.routes
from .admin import admin
from .auth import auth
from .faculty import faculty
from .grading import grading
from .organization import organization
from .student import student

# Define blueprints that should be accessible directly from gem_app.routes
__all__ = [
    'admin',
    'auth',
    'faculty',
    'grading',
    'organization',
    'student',
]