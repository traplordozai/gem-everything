# Import all models to make them available when importing from gem_app.models
from .base_model import BaseModel
from .user import User
from .token_blacklist import TokenBlacklist
from .faculty import FacultyProfile, ResearchProject
from .matching import Match, MatchHistory, MatchingRound
from .organization import OrganizationProfile, OrganizationRequirement
from .student import StudentProfile, StudentGrade, AreaRanking, Statement
from .support import SupportTicket

# Define models that should be accessible directly from gem_app.models
__all__ = [
    'BaseModel',
    'User',
    'TokenBlacklist',
    'FacultyProfile',
    'ResearchProject',
    'Match',
    'MatchHistory',
    'MatchingRound',
    'OrganizationProfile',
    'OrganizationRequirement',
    'StudentProfile',
    'StudentGrade',
    'AreaRanking',
    'Statement',
    'SupportTicket',
]