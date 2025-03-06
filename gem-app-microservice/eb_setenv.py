"""
Script to generate the 'eb setenv' command for AWS Elastic Beanstalk.
This script helps you set all the necessary environment variables for production.
"""

import os
import random
import string
import sys
from getpass import getpass
from argparse import ArgumentParser

def generate_secret_key(length=50):
    """Generate a secure random secret key."""
    chars = string.ascii_letters + string.digits + '!@#$%^&*()-_=+[]{}|;:,.<>?'
    return ''.join(random.choice(chars) for _ in range(length))

def get_arguments():
    """Parse command line arguments."""
    parser = ArgumentParser(description="Generate the 'eb setenv' command for AWS Elastic Beanstalk")
    parser.add_argument('--db-name', default='gem_app', help='Database name')
    parser.add_argument('--db-user', help='Database username')
    parser.add_argument('--db-host', help='Database host')
    parser.add_argument('--db-port', default='5432', help='Database port')
    parser.add_argument('--wp-url', help='WordPress site URL')
    parser.add_argument('--mail-server', help='Mail server hostname')
    parser.add_argument('--mail-port', default='587', help='Mail server port')
    parser.add_argument('--mail-username', help='Mail username')
    parser.add_argument('--admins', help='Admin email addresses (comma separated)')
    
    return parser.parse_args()

def main():
    """Main function to generate the eb setenv command."""
    args = get_arguments()
    
    # Dictionary to store all environment variables
    env_vars = {
        'FLASK_ENV': 'production',
        'SECRET_KEY': generate_secret_key(),
        'JWT_SECRET_KEY': generate_secret_key(),
        'DB_NAME': args.db_name,
        'DB_PORT': args.db_port,
    }
    
    # Get DB credentials
    if args.db_user:
        env_vars['DB_USER'] = args.db_user
    else:
        env_vars['DB_USER'] = input('Database username: ')
    
    env_vars['DB_PASSWORD'] = getpass('Database password: ')
    
    if args.db_host:
        env_vars['DB_HOST'] = args.db_host
    else:
        env_vars['DB_HOST'] = input('Database host: ')
    
    # WordPress URL
    if args.wp_url:
        env_vars['WP_SITE_URL'] = args.wp_url
    else:
        env_vars['WP_SITE_URL'] = input('WordPress site URL: ')
    
    # WordPress JWT secret key
    env_vars['WORDPRESS_JWT_AUTH_SECRET_KEY'] = generate_secret_key(30)
    
    # Mail configuration (optional)
    if args.mail_server:
        env_vars['MAIL_SERVER'] = args.mail_server
        env_vars['MAIL_PORT'] = args.mail_port
        
        if args.mail_username:
            env_vars['MAIL_USERNAME'] = args.mail_username
        else:
            mail_username = input('Mail username (optional): ')
            if mail_username:
                env_vars['MAIL_USERNAME'] = mail_username
        
        if 'MAIL_USERNAME' in env_vars:
            env_vars['MAIL_PASSWORD'] = getpass('Mail password: ')
            env_vars['MAIL_USE_TLS'] = 'true'
    
    # Admin emails
    if args.admins:
        env_vars['ADMINS'] = args.admins
    else:
        admins = input('Admin email addresses (comma separated, optional): ')
        if admins:
            env_vars['ADMINS'] = admins
    
    # Build the eb setenv command
    command = "eb setenv"
    for key, value in env_vars.items():
        # Escape any quotes in the value
        value = str(value).replace('"', '\\"')
        command += f' {key}="{value}"'
    
    print("\nRun the following command to set environment variables in Elastic Beanstalk:")
    print("-" * 80)
    print(command)
    print("-" * 80)
    
    # Option to save to a file
    save = input("\nSave this command to a file? (y/n): ")
    if save.lower() == 'y':
        filename = input("Enter filename (default: eb_setenv.sh): ") or "eb_setenv.sh"
        with open(filename, 'w') as f:
            f.write("#!/bin/bash\n")
            f.write(command)
        os.chmod(filename, 0o755)  # Make executable
        print(f"Saved to {filename}")

if __name__ == "__main__":
    main()