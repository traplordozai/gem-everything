"""
Script to seed the database with initial test data.
This should only be run once on a fresh database.
"""

import os
import sys
import random
from datetime import datetime, timedelta
from werkzeug.security import generate_password_hash

from gem_app import create_app, db
from gem_app.models.user import User
from gem_app.models.student import StudentProfile, StudentGrade, AreaRanking, Statement
from gem_app.models.faculty import FacultyProfile, ResearchProject
from gem_app.models.organization import OrganizationProfile, OrganizationRequirement
from gem_app.models.support import SupportTicket

# Areas of law for consistent data across entities
AREAS_OF_LAW = [
    'Public Interest',
    'Social Justice',
    'Private/Civil',
    'International Law',
    'Environment',
    'Labour',
    'Family',
    'Business Law',
    'IP'
]

# Common work modes
WORK_MODES = ['in-person', 'hybrid', 'remote']

# Locations for test data
LOCATIONS = [
    'New York',
    'Los Angeles',
    'Chicago',
    'San Francisco',
    'Washington DC',
    'Boston',
    'Seattle',
    'Austin',
    'Remote'
]

def create_admin_user():
    """Create an admin user for testing."""
    admin = User(
        email='admin@example.com',
        password_hash=generate_password_hash('adminpass'),
        first_name='Admin',
        last_name='User',
        role='admin',
        is_active=True
    )
    db.session.add(admin)
    print("Created admin user: admin@example.com / adminpass")
    return admin

def create_faculty_users(count=3):
    """Create faculty users with profiles and research projects."""
    faculty_users = []
    departments = ['Law', 'Political Science', 'Public Policy', 'Business', 'Criminal Justice']
    
    for i in range(1, count + 1):
        # Create faculty user
        faculty = User(
            email=f'faculty{i}@example.com',
            password_hash=generate_password_hash(f'faculty{i}pass'),
            first_name=f'Faculty{i}',
            last_name=f'User',
            role='faculty',
            is_active=True
        )
        db.session.add(faculty)
        db.session.flush()  # Get ID before committing
        
        # Create faculty profile
        department = random.choice(departments)
        profile = FacultyProfile(
            user_id=faculty.id,
            department=department,
            research_areas=f"Research in {', '.join(random.sample(AREAS_OF_LAW, 3))}",
            office_location=f"Building {i}, Room {i*100}",
            available_positions=random.randint(1, 3)
        )
        db.session.add(profile)
        db.session.flush()
        
        # Create some research projects
        for j in range(1, random.randint(1, 3) + 1):
            area = random.choice(AREAS_OF_LAW)
            project = ResearchProject(
                faculty_profile_id=profile.id,
                title=f"Research Project {j} on {area}",
                description=f"This project investigates important aspects of {area} law.",
                area_of_law=area,
                required_skills=f"Legal research, writing, {random.choice(['Python', 'R', 'SPSS', 'Data analysis'])}",
                is_active=True,
                created_by_user=faculty.id
            )
            db.session.add(project)
        
        faculty_users.append(faculty)
        print(f"Created faculty user: faculty{i}@example.com / faculty{i}pass")
    
    return faculty_users

def create_organization_users(count=5):
    """Create organization users with profiles and requirements."""
    org_users = []
    
    for i in range(1, count + 1):
        # Create organization user
        org = User(
            email=f'org{i}@example.com',
            password_hash=generate_password_hash(f'org{i}pass'),
            first_name=f'Org{i}',
            last_name='Representative',
            role='organization',
            is_active=True
        )
        db.session.add(org)
        db.session.flush()
        
        # Choose area of law and location
        area = random.choice(AREAS_OF_LAW)
        location = random.choice(LOCATIONS)
        work_mode = random.choice(WORK_MODES)
        
        # Create organization profile
        profile = OrganizationProfile(
            user_id=org.id,
            name=f"Organization {i}",
            area_of_law=area,
            description=f"We are a leading organization in {area} law. Our mission is to provide excellent legal services.",
            website=f"https://org{i}.example.com",
            location=location,
            work_mode=work_mode,
            available_positions=random.randint(1, 4)
        )
        db.session.add(profile)
        db.session.flush()
        
        # Add requirements
        min_grade = random.randint(20, 35)
        req1 = OrganizationRequirement(
            organization_profile_id=profile.id,
            requirement_type='minimum_grade',
            value=str(min_grade),
            is_mandatory=True
        )
        db.session.add(req1)
        
        # Add some specific skills requirements
        skills = ['Legal writing', 'Research', 'Data analysis', 'Client interaction', 'Negotiation']
        req2 = OrganizationRequirement(
            organization_profile_id=profile.id,
            requirement_type='skill',
            value=random.choice(skills),
            is_mandatory=random.choice([True, False])
        )
        db.session.add(req2)
        
        org_users.append(org)
        print(f"Created organization user: org{i}@example.com / org{i}pass")
    
    return org_users

def create_student_users(count=10):
    """Create student users with profiles, grades, rankings, and statements."""
    student_users = []
    
    for i in range(1, count + 1):
        # Create student user
        student = User(
            email=f'student{i}@example.com',
            password_hash=generate_password_hash(f'student{i}pass'),
            first_name=f'Student{i}',
            last_name='User',
            role='student',
            student_id=f'S{100000+i}',
            is_active=True
        )
        db.session.add(student)
        db.session.flush()
        
        # Create student profile
        start_date = datetime.now() - timedelta(days=random.randint(30, 90))
        end_date = start_date + timedelta(days=120)
        
        profile = StudentProfile(
            user_id=student.id,
            start_date=start_date,
            end_date=end_date,
            overall_grade=round(random.uniform(25.0, 40.0), 1),
            status='unmatched'
        )
        db.session.add(profile)
        db.session.flush()
        
        # Add grades
        courses = ['Constitutional Law', 'Criminal Law', 'Civil Procedure', 'Contracts', 'Torts', 'Property']
        for course in random.sample(courses, 3):
            grade_letter = random.choice(['A+', 'A', 'A-', 'B+', 'B'])
            grade_map = {'A+': 4.0, 'A': 3.8, 'A-': 3.7, 'B+': 3.3, 'B': 3.0}
            grade = StudentGrade(
                student_profile_id=profile.id,
                course_name=course,
                grade=grade_letter,
                numeric_grade=grade_map[grade_letter] * 10,  # Scale to 40 max
                term=random.choice(['Fall 2023', 'Spring 2024'])
            )
            db.session.add(grade)
        
        # Add area rankings
        rankings = list(range(1, len(AREAS_OF_LAW) + 1))
        random.shuffle(rankings)
        
        for j, area in enumerate(AREAS_OF_LAW):
            ranking = AreaRanking(
                student_profile_id=profile.id,
                area_of_law=area,
                rank=rankings[j]
            )
            db.session.add(ranking)
        
        # Add statements for top 3 ranked areas
        top_areas = [AREAS_OF_LAW[j] for j in range(len(AREAS_OF_LAW)) if rankings[j] <= 3]
        for area in top_areas:
            statement = Statement(
                student_profile_id=profile.id,
                area_of_law=area,
                content=f"""I am very interested in {area} law because it aligns with my career goals.
                During my studies, I have focused on courses related to this field and have gained 
                valuable insights. I believe that working in this area would allow me to make a 
                meaningful contribution while developing my legal skills further. My background in 
                {random.choice(['research', 'volunteering', 'internships'])} has prepared me well 
                for challenges in this field."""
            )
            db.session.add(statement)
        
        student_users.append(student)
        print(f"Created student user: student{i}@example.com / student{i}pass")
    
    return student_users

def create_support_tickets(student_users, count=5):
    """Create some support tickets for testing."""
    categories = ['technical', 'complaint', 'question', 'other']
    priorities = ['high', 'normal', 'low']
    
    for i in range(count):
        user = random.choice(student_users)
        category = random.choice(categories)
        
        ticket = SupportTicket(
            student_id=user.id,
            category=category,
            subject=f"Support request about {random.choice(['documents', 'grades', 'matching', 'system access'])}",
            message=f"""Hello, I am having an issue with the system.
            {random.choice([
                'I cannot upload my documents.',
                'I have a question about my grades.',
                'I need help with the matching process.',
                'I cannot access certain features.'
            ])}
            
            Please assist me with this issue as soon as possible.
            
            Thank you,
            {user.first_name} {user.last_name}""",
            priority=random.choice(priorities)
        )
        
        # Randomly mark some as resolved
        if random.choice([True, False]):
            ticket.is_resolved = True
            ticket.resolved_at = datetime.now() - timedelta(days=random.randint(1, 10))
        
        db.session.add(ticket)
    
    print(f"Created {count} support tickets")

def main():
    """Main function to seed the database."""
    print("Starting database seeding...")
    
    # Create our Flask app and push an application context
    app = create_app()
    
    with app.app_context():
        # Check if database already has users to avoid duplicate seeding
        if User.query.count() > 0:
            print("Database already has users. Exiting to avoid duplication.")
            return
        
        try:
            # Create users and related data
            admin_user = create_admin_user()
            faculty_users = create_faculty_users(3)
            org_users = create_organization_users(5)
            student_users = create_student_users(10)
            
            # Create support tickets
            create_support_tickets(student_users, 5)
            
            # Commit all changes
            db.session.commit()
            print("Database seeding completed successfully!")
            
        except Exception as e:
            db.session.rollback()
            print(f"Error seeding database: {str(e)}")
            raise

if __name__ == "__main__":
    main()