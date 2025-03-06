from datetime import datetime

from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class SupportTicket(BaseModel):
    """
    Stores a support request / complaint from a student.
    """

    __tablename__ = 'support_tickets'

    student_id = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    category = db.Column(db.String(50), default='other')
    subject = db.Column(db.String(255), nullable=True)
    message = db.Column(db.Text, nullable=False)
    is_resolved = db.Column(db.Boolean, default=False)
    priority = db.Column(db.String(20), default='normal')
    resolved_at = db.Column(db.DateTime, nullable=True)

    def mark_resolved(self):
        """Mark the support ticket as resolved."""
        self.is_resolved = True
        self.resolved_at = datetime.utcnow()
        self.save()
        
    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Support ticket data dictionary.
        """
        base = super().to_dict()
        base.update({
            'student_id': self.student_id,
            'category': self.category,
            'subject': self.subject,
            'message': self.message,
            'is_resolved': self.is_resolved,
            'priority': self.priority,
            'resolved_at': self.resolved_at.isoformat() if self.resolved_at else None
        })
        return base