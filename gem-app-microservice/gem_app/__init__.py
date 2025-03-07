import os
import logging
from logging.handlers import RotatingFileHandler, SMTPHandler
from datetime import timedelta

from flask import Flask, jsonify
from flask_migrate import Migrate
from flask_cors import CORS

from .extensions import db, jwt, login_manager, mail, csrf
from .config import get_config

# Initialize migrations outside of create_app to avoid conflicts
migrate = Migrate()

def create_app(config_class=None):
    """Create and configure the Flask application instance."""
    app = Flask(__name__)
    
    # Use the config_class if provided, otherwise get from environment
    if config_class is None:
        config_class = get_config()
    
    app.config.from_object(config_class)
    
    # Configure CORS with more specific settings
    CORS(app, resources={
        r"/*": {
            "origins": app.config.get('ALLOWED_ORIGINS', ['http://localhost:8000']),
            "methods": ["GET", "POST", "PUT", "DELETE", "OPTIONS"],
            "allow_headers": ["Content-Type", "Authorization"],
            "expose_headers": ["Content-Range", "X-Total-Count"],
            "supports_credentials": True
        }
    })

    @app.route('/health')
    def health_check():
        return jsonify({'status': 'healthy'}), 200

    # Initialize extensions
    db.init_app(app)
    login_manager.init_app(app)
    mail.init_app(app)
    csrf.init_app(app)
    jwt.init_app(app)
    migrate.init_app(app, db)

    # If you want to remove session-based login entirely, comment out the next lines
    login_manager.login_view = None  # No built-in login page
    login_manager.login_message_category = 'info'

    configure_logging(app)

    # Register blueprints
    from gem_app.routes.auth import auth as auth_bp
    from gem_app.routes.admin import admin as admin_bp
    from gem_app.routes.student import student as student_bp
    from gem_app.routes.faculty import faculty as faculty_bp
    from gem_app.routes.organization import organization as org_bp
    from gem_app.routes.grading import grading as grading_bp

    app.register_blueprint(auth_bp, url_prefix='/auth')
    app.register_blueprint(admin_bp, url_prefix='/admin')
    app.register_blueprint(student_bp, url_prefix='/student')
    app.register_blueprint(faculty_bp, url_prefix='/faculty')
    app.register_blueprint(org_bp, url_prefix='/organization')
    app.register_blueprint(grading_bp, url_prefix='/grading')

    from gem_app.models.user import User
    @login_manager.user_loader
    def load_user(user_id):
        return User.query.get(int(user_id))

    # JWT error handlers
    @jwt.expired_token_loader
    def expired_token_callback(jwt_header, jwt_payload):
        return jsonify({
            'status': 401,
            'sub_status': 42,
            'msg': 'The token has expired'
        }), 401

    @jwt.invalid_token_loader
    def invalid_token_callback(error):
        return jsonify({
            'status': 401,
            'sub_status': 43,
            'msg': 'Invalid token'
        }), 401

    @jwt.unauthorized_loader
    def missing_token_callback(error):
        return jsonify({
            'status': 401,
            'sub_status': 44,
            'msg': 'Missing token'
        }), 401

    @jwt.token_in_blocklist_loader
    def check_if_token_revoked(jwt_header, jwt_payload):
        from gem_app.models.token_blacklist import TokenBlacklist
        jti = jwt_payload['jti']
        token = TokenBlacklist.query.filter_by(jti=jti).first()
        return token is not None

    @jwt.revoked_token_loader
    def revoked_token_callback(jwt_header, jwt_payload):
        return jsonify({
            'status': 401,
            'sub_status': 45,
            'msg': 'Token has been revoked'
        }), 401

    with app.app_context():
        db.create_all()  # For dev usage. Production should use migrations.

    return app

def configure_logging(app):
    """Set up rotating file logs and optional SMTP email alerts for critical errors."""
    if not app.debug and not app.testing:
        app.logger.setLevel(logging.WARNING)
        
        # Ensure log directory exists
        log_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
        log_file_path = os.path.join(log_dir, 'app.log')
        
        file_handler = RotatingFileHandler(log_file_path, maxBytes=1_000_000, backupCount=3)
        file_handler.setLevel(logging.WARNING)
        file_formatter = logging.Formatter('[%(asctime)s] %(levelname)s in %(module)s: %(message)s')
        file_handler.setFormatter(file_formatter)
        app.logger.addHandler(file_handler)

        if app.config.get('MAIL_SERVER') and app.config.get('ADMINS'):
            auth = None
            if app.config.get('MAIL_USERNAME') or app.config.get('MAIL_PASSWORD'):
                auth = (app.config.get('MAIL_USERNAME'), app.config.get('MAIL_PASSWORD'))
            
            secure = None
            if app.config.get('MAIL_USE_TLS'):
                secure = ()
            
            mail_handler = SMTPHandler(
                mailhost=(app.config.get('MAIL_SERVER'), app.config.get('MAIL_PORT')),
                fromaddr=app.config.get('MAIL_DEFAULT_SENDER'),
                toaddrs=app.config.get('ADMINS'),
                subject='GEM App Error',
                credentials=auth,
                secure=secure
            )
            mail_handler.setLevel(logging.ERROR)
            mail_handler.setFormatter(logging.Formatter(
                '[%(asctime)s] %(levelname)s in %(module)s: %(message)s'
            ))
            app.logger.addHandler(mail_handler)
