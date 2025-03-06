from typing import Dict, List, Any, Tuple, Optional
import re
import logging
from datetime import datetime
from ..csv_parser import SurveyDataParser
from ...models.student import StudentProfile, Statement
from ...models.organization import OrganizationProfile

logger = logging.getLogger(__name__)

class DataValidator:
    """Handles data validation, cleanup, and standardization"""

    def __init__(self):
        self.email_pattern = re.compile(r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
        self.student_id_pattern = re.compile(r'^\d{9}$')
        self.allowed_work_modes = {'in-person', 'hybrid', 'remote'}
        self.errors = []
        self.warnings = []

    def validate_student_data(self, data: Dict[str, Any]) -> Tuple[bool, List[str]]:
        """
        Validate student data completeness and format
        
        Args:
            data: Student data dictionary
            
        Returns:
            Tuple of (is_valid, error_messages)
        """
        errors = []

        # Validate basic info
        if not self._validate_email(data.get('email')):
            errors.append("Invalid email format")

        if not self._validate_student_id(data.get('student_id')):
            errors.append("Invalid student ID format")

        # Validate name fields
        if not data.get('first_name'):
            errors.append("Missing first name")
        if not data.get('last_name'):
            errors.append("Missing last name")

        # Validate rankings
        rankings = data.get('rankings', {})
        if not rankings:
            errors.append("Missing area rankings")
        else:
            if not all(1 <= float(rank) <= 5 for rank in rankings.values()):
                errors.append("Rankings must be between 1 and 5")

        # Validate work mode
        work_mode = data.get('work_mode')
        if work_mode and work_mode not in self.allowed_work_modes:
            errors.append(f"Invalid work mode. Must be one of: {', '.join(self.allowed_work_modes)}")

        return len(errors) == 0, errors

    def validate_organization_data(self, data: Dict[str, Any]) -> Tuple[bool, List[str]]:
        """
        Validate organization data
        
        Args:
            data: Organization data dictionary
            
        Returns:
            Tuple of (is_valid, error_messages)
        """
        errors = []

        # Required fields
        required_fields = ['name', 'area_of_law', 'location', 'work_mode']
        for field in required_fields:
            if not data.get(field):
                errors.append(f"Missing required field: {field}")

        # Validate work mode
        work_mode = data.get('work_mode')
        if work_mode and work_mode not in self.allowed_work_modes:
            errors.append(f"Invalid work mode. Must be one of: {', '.join(self.allowed_work_modes)}")

        # Validate positions
        positions = data.get('available_positions')
        if positions is not None:
            try:
                positions = int(positions)
                if positions < 1:
                    errors.append("Available positions must be at least 1")
            except ValueError:
                errors.append("Available positions must be a number")

        return len(errors) == 0, errors

    def validate_statement(self, content: str) -> Tuple[bool, List[str]]:
        """
        Validate statement content
        
        Args:
            content: Statement text
            
        Returns:
            Tuple of (is_valid, error_messages)
        """
        errors = []
        warnings = []

        # Check length
        if not content:
            errors.append("Statement cannot be empty")
        elif len(content) < 100:
            warnings.append("Statement seems too short")
        elif len(content) > 5000:
            errors.append("Statement exceeds maximum length")

        # Check for potential formatting issues
        if re.search(r'[A-Z]{4,}', content):
            warnings.append("Contains excessive capitalization")

        if content.count('.') < 3:
            warnings.append("Statement may be too brief")

        return len(errors) == 0, errors + warnings

    def cleanup_data(self, data: Dict[str, Any]) -> Dict[str, Any]:
        """
        Clean and standardize data
        
        Args:
            data: Raw data dictionary
            
        Returns:
            Cleaned data dictionary
        """
        cleaned = {}

        # Clean string fields
        string_fields = ['first_name', 'last_name', 'email', 'student_id']
        for field in string_fields:
            if field in data:
                cleaned[field] = self._clean_string(data[field])

        # Clean email
        if 'email' in data:
            cleaned['email'] = data['email'].lower().strip()

        # Clean rankings
        if 'rankings' in data:
            cleaned['rankings'] = {
                area: float(rank)
                for area, rank in data['rankings'].items()
                if rank is not None
            }

        # Clean location preferences
        if 'location_preferences' in data:
            cleaned['location_preferences'] = [
                loc.strip()
                for loc in data['location_preferences']
                if loc.strip()
            ]

        # Standardize work mode
        if 'work_mode' in data:
            mode = data['work_mode'].lower().strip()
            if mode in self.allowed_work_modes:
                cleaned['work_mode'] = mode
            else:
                cleaned['work_mode'] = None

        return cleaned

    def standardize_locations(self, locations: List[str]) -> List[str]:
        """
        Standardize location names
        
        Args:
            locations: List of location strings
            
        Returns:
            List of standardized location strings
        """
        standardized = []
        for loc in locations:
            # Remove extra whitespace
            loc = ' '.join(loc.split())
            
            # Remove common prefixes/suffixes
            loc = re.sub(r'^(City of|Town of|Municipality of)\s+', '', loc, flags=re.IGNORECASE)
            
            # Capitalize
            loc = loc.title()
            
            standardized.append(loc)
        
        return list(set(standardized))  # Remove duplicates

    def _validate_email(self, email: Optional[str]) -> bool:
        """Validate email format"""
        if not email:
            return False
        return bool(self.email_pattern.match(email))

    def _validate_student_id(self, student_id: Optional[str]) -> bool:
        """Validate student ID format"""
        if not student_id:
            return False
        return bool(self.student_id_pattern.match(str(student_id)))

    def _clean_string(self, value: Optional[str]) -> Optional[str]:
        """Clean and standardize string values"""
        if not value:
            return None
        # Remove extra whitespace
        value = ' '.join(value.split())
        # Remove special characters
        value = re.sub(r'[^\w\s-]', '', value)
        return value.strip()

    def analyze_data_quality(self, profile_id: int) -> Dict[str, Any]:
        """
        Analyze data quality for a student profile
        
        Args:
            profile_id: Student profile ID
            
        Returns:
            Dictionary containing quality metrics
        """
        profile = StudentProfile.query.get(profile_id)
        if not profile:
            return {'error': 'Profile not found'}

        metrics = {
            'completeness': self._calculate_completeness(profile),
            'statement_quality': self._analyze_statements(profile),
            'grade_analysis': self._analyze_grades(profile),
            'issues': [],
            'recommendations': []
        }

        # Add specific issues and recommendations
        if metrics['completeness'] < 0.8:
            metrics['issues'].append("Profile is incomplete")
            metrics['recommendations'].append("Complete all required profile sections")

        if metrics['statement_quality'].get('average_length', 0) < 200:
            metrics['issues'].append("Statements are too brief")
            metrics['recommendations'].append("Expand statements with more detail")

        return metrics

    def _calculate_completeness(self, profile: StudentProfile) -> float:
        """Calculate profile completeness score"""
        required_fields = [
            profile.first_name,
            profile.last_name,
            profile.email,
            profile.student_id,
            profile.overall_grade,
            profile.rankings,
            profile.statements,
            profile.location_preferences,
            profile.work_mode
        ]
        
        completed = sum(1 for field in required_fields if field)
        return completed / len(required_fields)

    def _analyze_statements(self, profile: StudentProfile) -> Dict[str, Any]:
        """Analyze statement quality"""
        if not profile.statements:
            return {'error': 'No statements found'}

        lengths = [len(stmt.content) for stmt in profile.statements]
        scored_statements = [stmt for stmt in profile.statements if stmt.total_score]

        return {
            'count': len(profile.statements),
            'average_length': sum(lengths) / len(lengths) if lengths else 0,
            'graded_count': len(scored_statements),
            'average_score': sum(stmt.total_score for stmt in scored_statements) / len(scored_statements) if scored_statements else 0
        }

    def _analyze_grades(self, profile: StudentProfile) -> Dict[str, Any]:
        """Analyze grade distribution"""
        if not profile.grades:
            return {'error': 'No grades found'}

        grades = [grade.numeric_grade for grade in profile.grades]
        return {
            'count': len(grades),
            'average': sum(grades) / len(grades),
            'min': min(grades),
            'max': max(grades)
        }