import re

from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class FacultyProfile(BaseModel):
    """Faculty profile for mentors/supervisors in the system."""
    __tablename__ = 'faculty_profiles'

    user_id = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    department = db.Column(db.String(128), nullable=False)
    research_areas = db.Column(db.Text)
    office_location = db.Column(db.String(128))
    available_positions = db.Column(db.Integer, default=1)
    filled_positions = db.Column(db.Integer, default=0)

    # Optional user tracking
    created_by_user = db.Column(db.Integer, nullable=True)
    updated_by_user = db.Column(db.Integer, nullable=True)

    research_projects = db.relationship(
        'ResearchProject',
        backref='faculty_profile',
        lazy=True,
        cascade="all, delete-orphan"
    )
    matches = db.relationship('Match', backref='faculty_profile', lazy=True)

    def _validate_fields(self):
        """Validate essential field values.
        
        Raises:
            ValueError: If validation fails.
        """
        if len(self.department.strip()) < 2:
            raise ValueError("Department name is too short.")
        if not re.match(r'^[A-Za-z ]+$', self.department.strip()):
            raise ValueError("Department can only contain letters and spaces.")
        if self.research_areas and len(self.research_areas.strip()) < 5:
            raise ValueError("Research areas text is too short.")

    def positions_remaining(self):
        """Get the number of available positions remaining.
        
        Returns:
            int: Number of unfilled positions.
        """
        return self.available_positions - self.filled_positions

    def add_position(self, count=1):
        """Add available positions.
        
        Args:
            count: Number of positions to add (default: 1).
            
        Raises:
            ValueError: If count is less than 1.
        """
        if count < 1:
            raise ValueError("Cannot add fewer than 1 position.")
        self.available_positions += count
        self._validate_fields()
        self.save()

    def fill_position(self):
        """Mark a position as filled.
        
        Raises:
            ValueError: If no positions are available.
        """
        if self.filled_positions >= self.available_positions:
            raise ValueError("No available positions remain.")
        self.filled_positions += 1
        self._validate_fields()
        self.save()

    def release_position(self):
        """Release a filled position, making it available again.
        
        Only works if there's at least one filled position.
        """
        if self.filled_positions > 0:
            self.filled_positions -= 1
            self._validate_fields()
            self.save()

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Faculty profile data dictionary.
        """
        base = super().to_dict()
        base.update({
            'user_id': self.user_id,
            'department': self.department,
            'research_areas': self.research_areas,
            'office_location': self.office_location,
            'available_positions': self.available_positions,
            'filled_positions': self.filled_positions,
            'created_by_user': self.created_by_user,
            'updated_by_user': self.updated_by_user
        })
        return base

class ResearchProject(BaseModel):
    """Research project offered by faculty members."""
    __tablename__ = 'research_projects'

    faculty_profile_id = db.Column(db.Integer, db.ForeignKey('faculty_profiles.id'), nullable=False)
    title = db.Column(db.String(256), nullable=False)
    description = db.Column(db.Text)
    area_of_law = db.Column(db.String(64))
    required_skills = db.Column(db.Text)
    is_active = db.Column(db.Boolean, default=True)

    created_by_user = db.Column(db.Integer, nullable=True)
    updated_by_user = db.Column(db.Integer, nullable=True)

    def deactivate(self):
        """Mark the research project as inactive."""
        self.is_active = False
        self.save()

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Research project data dictionary.
        """
        base = super().to_dict()
        base.update({
            'faculty_profile_id': self.faculty_profile_id,
            'title': self.title,
            'description': self.description,
            'area_of_law': self.area_of_law,
            'required_skills': self.required_skills,
            'is_active': self.is_active,
            'created_by_user': self.created_by_user,
            'updated_by_user': self.updated_by_user
        })
        return base