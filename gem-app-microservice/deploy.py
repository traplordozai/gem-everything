"""
Deployment script for AWS Elastic Beanstalk.
This script helps you initialize, create, and deploy the application to AWS EB.
"""

import os
import sys
import subprocess
import argparse
import shutil
from datetime import datetime

def run_command(command, exit_on_error=True):
    """Run a shell command and return its output."""
    print(f"Running: {command}")
    try:
        result = subprocess.run(command, shell=True, check=True, 
                              stdout=subprocess.PIPE, stderr=subprocess.PIPE,
                              universal_newlines=True)
        print(result.stdout)
        return result.stdout
    except subprocess.CalledProcessError as e:
        print(f"Error executing command: {e}")
        print(f"Output: {e.stdout}")
        print(f"Error: {e.stderr}")
        if exit_on_error:
            sys.exit(1)
        return None

def check_eb_cli():
    """Check if EB CLI is installed."""
    try:
        run_command("eb --version")
        return True
    except Exception:
        print("Error: EB CLI not found. Please install it with 'pip install awsebcli'.")
        sys.exit(1)

def init_eb(application_name):
    """Initialize Elastic Beanstalk application."""
    if os.path.exists(".elasticbeanstalk"):
        print("EB already initialized. Skipping initialization.")
        return
    
    # Initialize EB application
    command = f"eb init -p python-3.9 {application_name}"
    run_command(command)

def create_eb_environment(environment_name, instance_type):
    """Create an Elastic Beanstalk environment."""
    # Check if environment already exists
    result = run_command("eb list", exit_on_error=False)
    if result and environment_name in result:
        print(f"Environment {environment_name} already exists. Skipping creation.")
        return
    
    # Create environment
    command = f"eb create {environment_name} --instance-type {instance_type}"
    run_command(command)

def deploy_application():
    """Deploy the application to Elastic Beanstalk."""
    run_command("eb deploy")

def main():
    """Main function for deployment."""
    parser = argparse.ArgumentParser(description="Deploy to AWS Elastic Beanstalk")
    parser.add_argument("--app-name", default="gem-app", help="Application name")
    parser.add_argument("--env-name", default="gem-app-env", help="Environment name")
    parser.add_argument("--instance-type", default="t2.micro", help="EC2 instance type")
    parser.add_argument("--init-only", action="store_true", help="Only initialize, don't create or deploy")
    parser.add_argument("--create-only", action="store_true", help="Only initialize and create, don't deploy")
    parser.add_argument("--deploy-only", action="store_true", help="Only deploy, don't initialize or create")
    
    args = parser.parse_args()
    
    # Verify EB CLI is installed
    check_eb_cli()
    
    if args.deploy_only:
        deploy_application()
        return
    
    # Initialize EB
    init_eb(args.app_name)
    
    if args.init_only:
        return
    
    # Create environment
    create_eb_environment(args.env_name, args.instance_type)
    
    if args.create_only:
        return
    
    # Deploy application
    deploy_application()
    
    print("Deployment completed! Use 'eb open' to view your application.")

if __name__ == "__main__":
    main()