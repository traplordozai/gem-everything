from flask import current_app
from gem_app import create_app, db
from flask_migrate import upgrade

def complete_migrations():
    """Run database migrations and initial setup."""
    app = create_app()
    
    with app.app_context():
        # Ensure all models are imported
        from gem_app.models import User, Role  # Import all your models here
        
        # Create database tables
        db.create_all()
        
        # Run migrations
        upgrade()

if __name__ == '__main__':
    complete_migrations()
