"""
Central initialization point for utility modules.
"""

from .context_processors import init_template_context
from .matching_algorithm import MatchingAlgorithm, validate_matching_results
from .matching_service import MatchingService
from .wp_auth import verify_wordpress_signature
from .decorators import (
    admin_required, 
    faculty_required, 
    organization_required, 
    student_required,
    role_required
)

__all__ = [
    # Context processors
    'init_template_context',
    
    # Matching utilities
    'MatchingAlgorithm',
    'MatchingService',
    'validate_matching_results',
    
    # WordPress authentication
    'verify_wordpress_signature',
    
    # Decorators
    'admin_required',
    'faculty_required',
    'organization_required',
    'student_required',
    'role_required',
]

def initialize_utils(app):
    """
    Initialize utility modules that need app context.
    
    Args:
        app: The Flask application instance
    """
    # Initialize context processors
    init_template_context(app)
