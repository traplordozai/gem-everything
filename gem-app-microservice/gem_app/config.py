import os
from dotenv import load_dotenv

load_dotenv()

class Config:
    """Base config."""
    SECRET_KEY = os.getenv('SECRET_KEY')
    
    # Handle MySQL socket connection for Local by Flywheel
    db_socket = os.getenv('DB_SOCKET')
    if db_socket:
        SQLALCHEMY_DATABASE_URI = f"mysql+pymysql://{os.getenv('DB_USER')}:{os.getenv('DB_PASSWORD')}@{os.getenv('DB_HOST')}/{os.getenv('DB_NAME')}?unix_socket={db_socket}"
    else:
        SQLALCHEMY_DATABASE_URI = f"mysql+pymysql://{os.getenv('DB_USER')}:{os.getenv('DB_PASSWORD')}@{os.getenv('DB_HOST')}/{os.getenv('DB_NAME')}"
    
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    JWT_SECRET_KEY = os.getenv('JWT_SECRET_KEY')
    JWT_ACCESS_TOKEN_EXPIRES = 3600  # 1 hour
    WP_SITE_URL = os.getenv('WP_SITE_URL')

class DevelopmentConfig(Config):
    """Development config."""
    DEBUG = True
    DEVELOPMENT = True

class ProductionConfig(Config):
    """Production config."""
    DEBUG = False
    DEVELOPMENT = False

class TestingConfig(Config):
    """Testing config."""
    TESTING = True
    SQLALCHEMY_DATABASE_URI = 'sqlite:///:memory:'

def get_config():
    """Return config based on environment."""
    config_dict = {
        'development': DevelopmentConfig,
        'production': ProductionConfig,
        'testing': TestingConfig
    }
    
    flask_env = os.getenv('FLASK_ENV', 'development').lower()
    return config_dict.get(flask_env, DevelopmentConfig)
