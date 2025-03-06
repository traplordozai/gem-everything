"""WordPress authentication utilities."""
import hmac
import hashlib
from typing import Dict
from flask import current_app

def verify_wordpress_signature(data: Dict) -> bool:
    """
    Verify the signature from WordPress plugin requests.
    
    Args:
        data: Dictionary containing request data including:
            - site_url: WordPress site URL
            - wp_version: WordPress version
            - plugin_version: GEM App plugin version
            - signature: HMAC signature of the request
            
    Returns:
        bool: True if signature is valid, False otherwise
    """
    try:
        # Get the signature from the request data
        received_signature = data.get('signature')
        if not received_signature:
            return False

        # Get the secret key from environment
        secret_key = current_app.config.get('WP_VERIFICATION_KEY')
        if not secret_key:
            current_app.logger.error('WP_VERIFICATION_KEY not configured')
            return False

        # Create the message string
        message = '|'.join([
            str(data.get('site_url', '')),
            str(data.get('wp_version', '')),
            str(data.get('plugin_version', ''))
        ])

        # Create HMAC signature
        expected_signature = hmac.new(
            secret_key.encode(),
            message.encode(),
            hashlib.sha256
        ).hexdigest()

        # Compare signatures using constant-time comparison
        return hmac.compare_digest(
            expected_signature.encode(),
            received_signature.encode()
        )

    except Exception as e:
        current_app.logger.error(f'Signature verification failed: {str(e)}')
        return False