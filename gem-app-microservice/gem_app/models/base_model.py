import datetime
from gem_app.extensions import db

class BaseModel(db.Model):
    """Base model class that other models will inherit from.
    
    Provides common fields like id, timestamps, and versioning support.
    """
    __abstract__ = True

    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    created_at = db.Column(
        db.DateTime,
        default=datetime.datetime.utcnow,
        nullable=False
    )
    updated_at = db.Column(
        db.DateTime,
        default=datetime.datetime.utcnow,
        onupdate=datetime.datetime.utcnow,
        nullable=False
    )
    concurrency_version = db.Column(db.Integer, default=1, nullable=False)

    # Optional user tracking
    created_by_user = db.Column(db.Integer, nullable=True)
    updated_by_user = db.Column(db.Integer, nullable=True)

    def save(self):
        """Save the model instance to the database.
        
        Increments concurrency_version to help with optimistic locking.
        """
        if self.concurrency_version is None:
            self.concurrency_version = 0
        self.concurrency_version += 1
        db.session.add(self)
        db.session.commit()

    def delete(self):
        """Delete the model instance from the database."""
        db.session.delete(self)
        db.session.commit()

    def to_dict(self):
        """Convert model instance to a dictionary.
        
        Returns:
            dict: Dictionary representation of the model.
        """
        return {
            'id': self.id,
            'created_at': self.created_at.isoformat() if self.created_at else None,
            'updated_at': self.updated_at.isoformat() if self.updated_at else None,
            'concurrency_version': self.concurrency_version,
            'created_by_user': self.created_by_user,
            'updated_by_user': self.updated_by_user,
        }

    @staticmethod
    def strict_save(instance, expected_version: int):
        """Save the model instance with optimistic locking.
        
        Args:
            instance: The model instance to save.
            expected_version: The expected concurrency version.
            
        Raises:
            ValueError: If the concurrency version doesn't match the expected version.
        """
        if instance.concurrency_version != expected_version:
            raise ValueError("Concurrency version mismatch; record was modified.")
        instance.save()