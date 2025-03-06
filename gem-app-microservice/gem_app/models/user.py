import re
from datetime import datetime, timedelta

from flask import current_app
from flask_login import UserMixin
from werkzeug.security import generate_password_hash, check_password_hash
from itsdangerous import URLSafeTimedSerializer

from gem_app.extensions import db
from gem_app.models.base_model import BaseModel

class User(UserMixin, BaseModel):
    """
    The main user model: admin, student, faculty, organization.
    """
    __tablename__ = 'users'

    email = db.Column(db.String(120), unique=True, nullable=False)
    password_hash = db.Column(db.String(256))
    first_name = db.Column(db.String(64), nullable=False)
    last_name = db.Column(db.String(64), nullable=False)
    role = db.Column(db.String(20), nullable=False)  # 'admin', 'student', etc.
    student_id = db.Column(db.String(20), unique=True)
    last_login = db.Column(db.DateTime)
    is_active = db.Column(db.Boolean, default=True)

    # One-to-one relationships
    student_profile = db.relationship('StudentProfile', backref='user', uselist=False)
    organization_profile = db.relationship('OrganizationProfile', backref='user', uselist=False)
    faculty_profile = db.relationship('FacultyProfile', backref='user', uselist=False)

    # Reset password fields
    reset_token = db.Column(db.String(100), unique=True)
    reset_token_expiry = db.Column(db.DateTime)

    # OPTIONAL user tracking
    created_by_user = db.Column(db.Integer, nullable=True)
    updated_by_user = db.Column(db.Integer, nullable=True)

    def set_password(self, password: str) -> None:
        """Set user password with secure hashing.
        
        Args:
            password: The plaintext password to hash and store.
        """
        self.password_hash = generate_password_hash(password)
        self.save()

    def check_password(self, password: str) -> bool:
        """Check if the provided password matches the stored hash.
        
        Args:
            password: The plaintext password to check.
            
        Returns:
            bool: True if password matches, False otherwise.
        """
        return check_password_hash(self.password_hash, password)

    def update_last_login(self) -> None:
        """Update the last login timestamp to the current time."""
        self.last_login = datetime.utcnow()
        self.save()

    def get_reset_password_token(self, expires_in=3600) -> str:
        """Generate a secure password reset token.
        
        Args:
            expires_in: Token expiration time in seconds (default: 1 hour).
            
        Returns:
            str: The generated reset token.
        """
        s = URLSafeTimedSerializer(current_app.config['SECRET_KEY'])
        self.reset_token = s.dumps({'user_id': self.id})
        self.reset_token_expiry = datetime.utcnow() + timedelta(seconds=expires_in)
        self.save()
        return self.reset_token

    @staticmethod
    def verify_reset_token(token: str, expires_in=3600):
        """Verify a password reset token.
        
        Args:
            token: The token to verify.
            expires_in: Token expiration time in seconds.
            
        Returns:
            User: The user object if token is valid, None otherwise.
        """
        s = URLSafeTimedSerializer(current_app.config['SECRET_KEY'])
        try:
            user_id = s.loads(token, max_age=expires_in)['user_id']
        except:
            return None

        user = User.query.get(user_id)
        if user and user.reset_token == token and user.reset_token_expiry > datetime.utcnow():
            return user
        return None

    @property
    def full_name(self):
        """Get the user's full name.
        
        Returns:
            str: The user's full name (first + last).
        """
        return f"{self.first_name} {self.last_name}"

    def to_dict(self):
        """Convert user to dictionary representation.
        
        Returns:
            dict: User data dictionary.
        """
        base = super().to_dict()
        base.update({
            'email': self.email,
            'first_name': self.first_name,
            'last_name': self.last_name,
            'role': self.role,
            'student_id': self.student_id,
            'last_login': self.last_login.isoformat() if self.last_login else None,
            'is_active': self.is_active,
            'reset_token': self.reset_token,
            'reset_token_expiry': self.reset_token_expiry.isoformat() if self.reset_token_expiry else None,
        })
        return base