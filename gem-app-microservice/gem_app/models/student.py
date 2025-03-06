import re
from datetime import datetime, date

from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class StudentProfile(BaseModel):
    """Profile for students in the system."""
    __tablename__ = 'student_profiles'

    user_id = db.Column(db.Integer, db.ForeignKey('users.id'), nullable=False)
    start_date = db.Column(db.Date, nullable=True)
    end_date = db.Column(db.Date, nullable=True)
    overall_grade = db.Column(db.Float)
    statement_score = db.Column(db.Float)
    status = db.Column(db.String(20), default='pending')

    # File paths for uploaded documents
    resume_path = db.Column(db.String(256))
    cover_letter_path = db.Column(db.String(256))
    transcript_path = db.Column(db.String(256))
    learning_plan_path = db.Column(db.String(256))
    midpoint_checkin_path = db.Column(db.String(256))
    final_reflection_path = db.Column(db.String(256))

    # Content for structured documents
    learning_plan_text = db.Column(db.Text)
    midpoint_checkin_text = db.Column(db.Text)
    final_reflection_text = db.Column(db.Text)

    # Approval flags
    learning_plan_approved_by_mentor = db.Column(db.Boolean, default=False)
    midpoint_approved_by_mentor = db.Column(db.Boolean, default=False)
    final_reflection_approved_by_mentor = db.Column(db.Boolean, default=False)
    deliverables_accepted_by_admin = db.Column(db.Boolean, default=False)

    # Relationships
    grades = db.relationship('StudentGrade', backref='student_profile', lazy=True)
    rankings = db.relationship('AreaRanking', backref='student_profile', lazy=True)
    statements = db.relationship('Statement', backref='student_profile', lazy=True)
    matches = db.relationship('Match', backref='student_profile', lazy=True)

    def weeks_in_program(self):
        """Calculate the number of weeks the student has been in the program.
        
        Returns:
            int: Number of weeks since start_date, or None if no start_date.
        """
        if not self.start_date:
            return None
        delta = date.today() - self.start_date
        return (delta.days // 7) + 1

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Student profile data dictionary.
        """
        base = super().to_dict()
        base.update({
            'user_id': self.user_id,
            'start_date': self.start_date.isoformat() if self.start_date else None,
            'end_date': self.end_date.isoformat() if self.end_date else None,
            'overall_grade': self.overall_grade,
            'statement_score': self.statement_score,
            'status': self.status,
            'resume_path': self.resume_path,
            'cover_letter_path': self.cover_letter_path,
            'transcript_path': self.transcript_path,
            'learning_plan_path': self.learning_plan_path,
            'midpoint_checkin_path': self.midpoint_checkin_path,
            'final_reflection_path': self.final_reflection_path,
            'learning_plan_text': self.learning_plan_text,
            'midpoint_checkin_text': self.midpoint_checkin_text,
            'final_reflection_text': self.final_reflection_text,
            'learning_plan_approved_by_mentor': self.learning_plan_approved_by_mentor,
            'midpoint_approved_by_mentor': self.midpoint_approved_by_mentor,
            'final_reflection_approved_by_mentor': self.final_reflection_approved_by_mentor,
            'deliverables_accepted_by_admin': self.deliverables_accepted_by_admin,
        })
        return base

class StudentGrade(BaseModel):
    """Individual course grades for students."""
    __tablename__ = 'student_grades'

    student_profile_id = db.Column(db.Integer, db.ForeignKey('student_profiles.id'), nullable=False)
    course_name = db.Column(db.String(128), nullable=False)
    grade = db.Column(db.String(2), nullable=False)
    numeric_grade = db.Column(db.Float, nullable=False)
    term = db.Column(db.String(64))

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Student grade data dictionary.
        """
        base = super().to_dict()
        base.update({
            'student_profile_id': self.student_profile_id,
            'course_name': self.course_name,
            'grade': self.grade,
            'numeric_grade': self.numeric_grade,
            'term': self.term
        })
        return base

class AreaRanking(BaseModel):
    """Student ranking preferences for different areas of law."""
    __tablename__ = 'area_rankings'

    student_profile_id = db.Column(db.Integer, db.ForeignKey('student_profiles.id'), nullable=False)
    area_of_law = db.Column(db.String(64), nullable=False)
    rank = db.Column(db.Integer, nullable=False)

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Area ranking data dictionary.
        """
        base = super().to_dict()
        base.update({
            'student_profile_id': self.student_profile_id,
            'area_of_law': self.area_of_law,
            'rank': self.rank
        })
        return base

class Statement(BaseModel):
    """Student statements for different areas of law."""
    __tablename__ = 'statements'

    student_profile_id = db.Column(db.Integer, db.ForeignKey('student_profiles.id'), nullable=False)
    area_of_law = db.Column(db.String(64), nullable=False)
    content = db.Column(db.Text, nullable=False)

    # Grading components
    clarity_rating = db.Column(db.Integer)
    relevance_rating = db.Column(db.Integer)
    passion_rating = db.Column(db.Integer)
    understanding_rating = db.Column(db.Integer)
    goals_rating = db.Column(db.Integer)
    total_score = db.Column(db.Float)
    graded_by = db.Column(db.Integer, db.ForeignKey('users.id'))
    graded_at = db.Column(db.DateTime)

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Statement data dictionary.
        """
        base = super().to_dict()
        base.update({
            'student_profile_id': self.student_profile_id,
            'area_of_law': self.area_of_law,
            'content': self.content,
            'clarity_rating': self.clarity_rating,
            'relevance_rating': self.relevance_rating,
            'passion_rating': self.passion_rating,
            'understanding_rating': self.understanding_rating,
            'goals_rating': self.goals_rating,
            'total_score': self.total_score,
            'graded_by': self.graded_by,
            'graded_at': self.graded_at.isoformat() if self.graded_at else None
        })
        return base