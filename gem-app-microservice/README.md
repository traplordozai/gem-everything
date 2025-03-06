# GEM App Microservice

## Overview

GEM App is a platform for matching students with organizations and faculty mentors. This microservice provides a RESTful API that a WordPress frontend can interact with.

## Features

- User authentication via WordPress integration
- Student profile management
- Organization profile management
- Faculty profile management
- Student-organization matching algorithm
- Document upload and management
- Grading system
- Support ticket system

## Requirements

- Python 3.9+
- PostgreSQL 13+
- Docker and Docker Compose (for local development)
- AWS EB CLI (for deployment)

## API Endpoints

The microservice exposes the following API endpoints:

- `/auth/*`: Authentication endpoints
- `/admin/*`: Admin management endpoints
- `/student/*`: Student endpoints
- `/faculty/*`: Faculty endpoints
- `/organization/*`: Organization endpoints 
- `/grading/*`: Grading management endpoints

## Local Development Setup

### Option 1: Using Docker (Recommended)
1. Make sure Docker and Docker Compose are installed.

2. Build and start the containers:
docker-compose up -d

3. Initialize the database:
docker-compose exec web python migrations_init.py

4. Seed the database with test data:
docker-compose exec web python db_seed.py

5. Access the API at http://localhost:5000

##Option 2: Manual Setup

1. Create and activate a virtual environment:
python -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate

2. Install dependencies:
pip install -r requirements.txt

3. Create a `.env` file with your local configuration (use the template in the repo)

4. Initialize the database:
python migrations_init.py

5. Run the app:
flask run

## AWS Elastic Beanstalk Deployment

1. Install the EB CLI separately (do not use requirements.txt):
```bash
pip install awsebcli --upgrade --user
```

2. Initialize the EB environment:
eb init -p python-3.9 gem-app

3. Create an environment:
eb create gem-app-env
DB_NAME=gem_app
DB_USER=postgres
DB_PASSWORD=postgres
DB_HOST=localhost
DB_PORT=5432
SECRET_KEY=dev-key-for-local-testing-only
JWT_SECRET_KEY=dev-jwt-key-for-local-testing-only
FLASK_ENV=development
WP_SITE_URL=http://localhost:8000/

4. Make sure PostgreSQL is running locally and create the database:
createdb gem_app

5. Initialize the database:
python migrations_init.py

6. Seed the database with test data:
python db_seed.py

7. Run the application:
flask run

## API Endpoints

The microservice exposes the following API endpoints:

### Authentication

- `POST /auth/token`: Get JWT token with WordPress authentication
- `POST /auth/refresh`: Refresh an expired access token
- `POST /auth/logout`: Revoke the current token
- `GET /auth/status`: Check the status of the current JWT token

### Admin

- `GET /admin/dashboard`: Get admin dashboard stats
- `POST /admin/final-acceptance/<student_id>`: Mark student deliverables as accepted
- `GET /admin/matching`: Get matching stats and current matches
- `GET /admin/matching/stats`: Get matching stats
- `POST /admin/matching/start`: Start the matching process
- `POST /admin/matching/reset`: Reset all matches
- `GET /admin/matching/list`: List all matches
- `PUT /admin/matching/<match_id>`: Update a match

### Student

- `GET /student/dashboard`: Get student dashboard information
- `POST /student/support`: Submit a support ticket
- `POST /student/learning-plan`: Submit a learning plan
- `POST /student/midpoint-checkin`: Submit a midpoint check-in
- `POST /student/final-reflection`: Submit a final reflection
- `POST /student/upload-document`: Upload a document
- `GET /student/status`: Check current student status

### Faculty

- `GET /faculty/profile`: Get faculty profile
- `PUT /faculty/profile`: Update faculty profile
- `GET /faculty/projects`: List research projects
- `POST /faculty/projects`: Create a new project
- `PUT /faculty/projects/<project_id>`: Update a project
- `DELETE /faculty/projects/<project_id>`: Delete a project
- `GET /faculty/matches`: View matches
- `POST /faculty/matches/<match_id>/decision`: Accept or reject a match
- `POST /faculty/student/<student_id>/approve-document`: Approve a student document

### Organization

- `GET /organization/profile`: Get organization profile
- `PUT /organization/profile`: Update organization profile
- `GET /organization/requirements`: List requirements
- `POST /organization/requirements`: Add a requirement
- `PUT /organization/requirements/<req_id>`: Update a requirement
- `DELETE /organization/requirements/<req_id>`: Delete a requirement
- `GET /organization/matches`: List matches
- `POST /organization/matches/<match_id>/decision`: Accept or reject a match

### Grading

- `GET /grading/dashboard`: Get grading dashboard stats
- `GET /grading/grades`: List all grades
- `GET /grading/grades/student/<student_id>`: Get grades for a student
- `POST /grading/grades`: Add a grade
- `PUT /grading/grades/<grade_id>`: Update a grade
- `DELETE /grading/grades/<grade_id>`: Delete a grade
- `GET /grading/statements`: List statements
- `GET /grading/statements/<statement_id>`: Get a statement
- `POST /grading/statements/<statement_id>/grade`: Grade a statement
- `GET /grading/export-grades`: Export grades as CSV

## AWS Elastic Beanstalk Deployment

### Prerequisites

1. Install the EB CLI:
pip install awsebcli
Copy
2. Configure AWS credentials:
aws configure
Copy
### Deployment Steps

1. Initialize deployment:
python deploy.py --init-only
Copy
2. Create environment:
python deploy.py --create-only
Copy
3. Set environment variables:
python eb_setenv.py
CopyThen run the generated command.

4. Deploy the application:
python deploy.py --deploy-only
Copy
5. Open the application:
eb open
Copy
### Common Deployment Commands

- View application logs:
eb logs
Copy
- SSH into the EC2 instance:
eb ssh
Copy
- View application status:
eb status
Copy
- View application health:
eb health
Copy
## WordPress Integration

This microservice is designed to integrate with a WordPress frontend through the JSON API. The WordPress site should make calls to this API to perform operations like user authentication, student-organization matching, document management, etc.

### Authentication Flow

1. User logs in to WordPress
2. WordPress gets a token from `/auth/token` using the WordPress user ID and authentication token
3. WordPress frontend uses this token for all subsequent API calls

## Test Users

When you run `db_seed.py`, the following test users are created:

- Admin: admin@example.com / adminpass
- Faculty: faculty1@example.com / faculty1pass (and faculty2, faculty3)
- Organizations: org1@example.com / org1pass (and org2 through org5)
- Students: student1@example.com / student1pass (and student2 through student10)

## License

[MIT License](LICENSE)
