# gem_app/models/matching.py

from datetime import datetime

from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class Match(BaseModel):
    """Represents a match between a student and an organization or faculty."""
    __tablename__ = 'matches'

    student_profile_id = db.Column(db.Integer, db.ForeignKey('student_profiles.id'), nullable=False)
    organization_profile_id = db.Column(db.Integer, db.ForeignKey('organization_profiles.id'))
    faculty_profile_id = db.Column(db.Integer, db.ForeignKey('faculty_profiles.id'))

    status = db.Column(db.String(20), nullable=False)  # 'pending', 'accepted', 'rejected'
    match_type = db.Column(db.String(20), nullable=False)  # 'algorithmic', 'manual'
    score = db.Column(db.Float)
    round_number = db.Column(db.Integer)

    created_by = db.Column(db.Integer, db.ForeignKey('users.id'))
    modified_by = db.Column(db.Integer, db.ForeignKey('users.id'))

    accepted_at = db.Column(db.DateTime)
    rejected_at = db.Column(db.DateTime)

    # Score components
    ranking_score = db.Column(db.Float)
    grades_score = db.Column(db.Float)
    statement_score = db.Column(db.Float)
    location_score = db.Column(db.Float)
    work_mode_score = db.Column(db.Float)

    def calculate_total_score(self):
        """Calculate and store the total match score from all components."""
        components = [
            self.ranking_score or 0,
            self.grades_score or 0,
            self.statement_score or 0,
            self.location_score or 0,
            self.work_mode_score or 0
        ]
        self.score = sum(components)
        self.save()
        return self.score

    def accept(self, user_id: int):
        """Accept this match and record the action."""
        self.status = 'accepted'
        self.accepted_at = datetime.utcnow()
        self.modified_by = user_id
        self._create_history_record('accepted', user_id)
        self.save()

    def reject(self, user_id: int, reason=None):
        """Reject this match and record the action."""
        self.status = 'rejected'
        self.rejected_at = datetime.utcnow()
        self.modified_by = user_id
        self._create_history_record('rejected', user_id, notes=reason)
        self.save()

    def _create_history_record(self, action, user_id, notes=None):
        """Create a history record for this match action."""
        history = MatchHistory(
            match_id=self.id,
            action=action,
            old_status=self.status,
            new_status=self.status,
            performed_by=user_id,
            notes=notes
        )
        history.save()

    def to_dict(self):
        """Convert model to dictionary representation."""
        base = super().to_dict()
        base.update({
            'student_profile_id': self.student_profile_id,
            'organization_profile_id': self.organization_profile_id,
            'faculty_profile_id': self.faculty_profile_id,
            'status': self.status,
            'match_type': self.match_type,
            'score': self.score,
            'round_number': self.round_number,
            'created_by': self.created_by,
            'modified_by': self.modified_by,
            'accepted_at': self.accepted_at.isoformat() if self.accepted_at else None,
            'rejected_at': self.rejected_at.isoformat() if self.rejected_at else None,
            'ranking_score': self.ranking_score,
            'grades_score': self.grades_score,
            'statement_score': self.statement_score,
            'location_score': self.location_score,
            'work_mode_score': self.work_mode_score
        })
        return base

class MatchHistory(BaseModel):
    """Tracks the history of match status changes."""
    __tablename__ = 'match_history'

    match_id = db.Column(db.Integer, db.ForeignKey('matches.id'), nullable=False)
    action = db.Column(db.String(64), nullable=False)
    old_status = db.Column(db.String(20))
    new_status = db.Column(db.String(20))
    performed_by = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    notes = db.Column(db.Text)

    match = db.relationship('Match', backref='history_records', lazy=True)

    def to_dict(self):
        """Convert model to dictionary representation."""
        base = super().to_dict()
        base.update({
            'match_id': self.match_id,
            'action': self.action,
            'old_status': self.old_status,
            'new_status': self.new_status,
            'performed_by': self.performed_by,
            'notes': self.notes
        })
        return base

class MatchingRound(BaseModel):
    """Represents a complete matching algorithm run."""
    __tablename__ = 'matching_rounds'

    round_number = db.Column(db.Integer, nullable=False)
    status = db.Column(db.String(20), nullable=False)
    started_by = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    started_at = db.Column(db.DateTime, default=datetime.utcnow)
    completed_at = db.Column(db.DateTime)

    total_students = db.Column(db.Integer)
    matched_students = db.Column(db.Integer)
    total_organizations = db.Column(db.Integer)
    filled_positions = db.Column(db.Integer)
    error_message = db.Column(db.Text)

    def complete(self, matched_count: int):
        """Mark the matching round as completed."""
        self.status = 'completed'
        self.completed_at = datetime.utcnow()
        self.matched_students = matched_count
        self.save()

    def fail(self, error_message: str):
        """Mark the matching round as failed."""
        self.status = 'failed'
        self.completed_at = datetime.utcnow()
        self.error_message = error_message
        self.save()

    def to_dict(self):
        """Convert model to dictionary representation."""
        base = super().to_dict()
        base.update({
            'round_number': self.round_number,
            'status': self.status,
            'started_by': self.started_by,
            'started_at': self.started_at.isoformat() if self.started_at else None,
            'completed_at': self.completed_at.isoformat() if self.completed_at else None,
            'total_students': self.total_students,
            'matched_students': self.matched_students,
            'total_organizations': self.total_organizations,
            'filled_positions': self.filled_positions,
            'error_message': self.error_message
        })
        return base