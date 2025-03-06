from flask_migrate import Migrate, init, migrate, upgrade
from gem_app import create_app, db

def init_migrations():
    """Initialize database migrations and create initial migration."""
    app = create_app()
    migrate_manager = Migrate(app, db)  # Renamed to avoid conflict with the migrate function
    
    with app.app_context():
        init()  # Initialize migrations directory
        migrate()  # Create initial migration
        upgrade()  # Apply migration

if __name__ == '__main__':
    init_migrations()