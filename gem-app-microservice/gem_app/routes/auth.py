from flask import Blueprint, request, jsonify
from datetime import datetime, timedelta
import jwt
from ..config import Config
from ..models import User
from ..utils.wp_auth import verify_wordpress_signature

auth = Blueprint('auth', __name__)

@auth.route('/wordpress', methods=['POST'])
def wordpress_auth():
    """Authenticate WordPress plugin requests"""
    data = request.json
    
    # Verify required fields
    required = ['site_url', 'wp_version', 'plugin_version', 'signature']
    if not all(field in data for field in required):
        return jsonify({'error': 'Missing required fields'}), 400
        
    # Verify WordPress signature
    if not verify_wordpress_signature(data):
        return jsonify({'error': 'Invalid signature'}), 401
    
    # Generate JWT token
    token = jwt.encode({
        'site_url': data['site_url'],
        'exp': datetime.utcnow() + timedelta(hours=1)
    }, Config.JWT_SECRET_KEY)
    
    return jsonify({'token': token})
