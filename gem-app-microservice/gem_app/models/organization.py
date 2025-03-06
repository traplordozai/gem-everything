from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class OrganizationProfile(BaseModel):
    """Profile for organizations that can host students."""
    __tablename__ = 'organization_profiles'

    user_id = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    name = db.Column(db.String(128), nullable=False)
    area_of_law = db.Column(db.String(64), nullable=False)
    description = db.Column(db.Text)
    website = db.Column(db.String(256))
    location = db.Column(db.String(128), nullable=False)
    work_mode = db.Column(db.String(20), nullable=False)
    available_positions = db.Column(db.Integer, default=1)
    filled_positions = db.Column(db.Integer, default=0)

    matches = db.relationship('Match', backref='organization_profile', lazy=True)
    requirements = db.relationship(
        'OrganizationRequirement',
        backref='organization_profile',
        lazy=True,
        cascade="all, delete-orphan"
    )

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
        self.save()

    def fill_position(self):
        """Mark a position as filled.
        
        Raises:
            ValueError: If no positions are available.
        """
        if self.filled_positions >= self.available_positions:
            raise ValueError("No available positions remain.")
        self.filled_positions += 1
        self.save()

    def release_position(self):
        """Release a filled position, making it available again.
        
        Only works if there's at least one filled position.
        """
        if self.filled_positions > 0:
            self.filled_positions -= 1
            self.save()

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Organization profile data dictionary.
        """
        base = super().to_dict()
        base.update({
            'user_id': self.user_id,
            'name': self.name,
            'area_of_law': self.area_of_law,
            'description': self.description,
            'website': self.website,
            'location': self.location,
            'work_mode': self.work_mode,
            'available_positions': self.available_positions,
            'filled_positions': self.filled_positions,
        })
        return base

class OrganizationRequirement(BaseModel):
    """Requirements specified by organizations for potential matches."""
    __tablename__ = 'organization_requirements'

    organization_profile_id = db.Column(db.Integer, db.ForeignKey('organization_profiles.id'), nullable=False)
    requirement_type = db.Column(db.String(64), nullable=False)
    value = db.Column(db.String(128), nullable=False)
    is_mandatory = db.Column(db.Boolean, default=False)

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Organization requirement data dictionary.
        """
        base = super().to_dict()
        base.update({
            'organization_profile_id': self.organization_profile_id,
            'requirement_type': self.requirement_type,
            'value': self.value,
            'is_mandatory': self.is_mandatory,
        })
        return base