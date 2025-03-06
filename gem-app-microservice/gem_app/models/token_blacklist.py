from datetime import datetime
from gem_app.extensions import db

class TokenBlacklist(db.Model):
    """Tracks revoked JWT tokens to enforce security.
    
    This model stores information about JWT tokens that have been revoked before
    their natural expiration time, ensuring they can't be used again.
    """
    id = db.Column(db.Integer, primary_key=True)
    jti = db.Column(db.String(36), nullable=False, unique=True)  # JWT ID
    token_type = db.Column(db.String(10), nullable=False)  # 'access' or 'refresh'
    user_id = db.Column(db.Integer, nullable=False)
    expires = db.Column(db.DateTime, nullable=False)
    revoked_at = db.Column(db.DateTime, default=datetime.utcnow, nullable=False)

    def to_dict(self):
        """Convert model to dictionary representation.
        
        Returns:
            dict: Token data dictionary.
        """
        return {
            'token_id': self.jti,
            'token_type': self.token_type,
            'user_id': self.user_id,
            'revoked_at': self.revoked_at.isoformat(),
            'expires': self.expires.isoformat()
        }

    @staticmethod
    def is_token_revoked(jwt_payload):
        """Check if a token is in the blacklist.
        
        Args:
            jwt_payload: The decoded JWT payload.
            
        Returns:
            bool: True if token is revoked, False otherwise.
        """
        jti = jwt_payload['jti']
        token = TokenBlacklist.query.filter_by(jti=jti).first()
        return token is not None