from flask import Blueprint, request, jsonify, current_app, Response
from flask_jwt_extended import jwt_required, get_jwt_identity
import csv
import io
from datetime import datetime

from gem_app.extensions import db
from gem_app.models.user import User
from gem_app.models.student import StudentProfile, StudentGrade, Statement
from gem_app.utils.decorators import admin_required

grading = Blueprint('grading', __name__)

def get_current_user():
    """Helper function to get the current user from JWT identity."""
    user_id = get_jwt_identity()
    if user_id:
        return User.query.get(user_id)
    return None

@grading.route('/dashboard', methods=['GET'])
@jwt_required()
def grading_dashboard():
    """Returns an overview of grading stats in JSON."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    total_students = StudentProfile.query.count()
    total_grades = StudentGrade.query.count()
    average_grade = db.session.query(db.func.avg(StudentGrade.numeric_grade)).scalar() or 0
    
    # Count statements needing grading
    ungraded_statements = Statement.query.filter(Statement.graded_by.is_(None)).count()

    data = {
        'total_students': total_students,
        'total_grades': total_grades,
        'average_numeric_grade': round(average_grade, 2),
        'ungraded_statements': ungraded_statements
    }
    
    return jsonify({'stats': data})

@grading.route('/grades', methods=['GET'])
@jwt_required()
def list_all_grades():
    """Returns all student grades in JSON."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    all_grades = StudentGrade.query.all()
    data = []
    
    for g in all_grades:
        student = g.student_profile
        user = student.user if student else None
        
        data.append({
            'grade_id': g.id,
            'student_name': f"{user.first_name} {user.last_name}" if user else "Unknown",
            'course_name': g.course_name,
            'grade': g.grade,
            'numeric_grade': g.numeric_grade,
            'term': g.term,
            'created_at': g.created_at.strftime('%Y-%m-%d') if g.created_at else None
        })
    
    return jsonify({'grades': data})

@grading.route('/grades/student/<int:student_id>', methods=['GET'])
@jwt_required()
def get_student_grades(student_id):
    """Get grades for a specific student."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    student = StudentProfile.query.get_or_404(student_id)
    user = student.user
    
    grades = StudentGrade.query.filter_by(student_profile_id=student.id).all()
    
    return jsonify({
        'student': {
            'id': student.id,
            'name': f"{user.first_name} {user.last_name}" if user else "Unknown",
            'student_id': user.student_id if user else None,
            'overall_grade': student.overall_grade
        },
        'grades': [
            {
                'id': g.id,
                'course_name': g.course_name,
                'grade': g.grade,
                'numeric_grade': g.numeric_grade,
                'term': g.term,
                'created_at': g.created_at.strftime('%Y-%m-%d') if g.created_at else None
            }
            for g in grades
        ]
    })

@grading.route('/grades', methods=['POST'])
@jwt_required()
def add_grade():
    """Add a new grade for a student."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    data = request.json
    
    if not data:
        return jsonify({'error': 'No data provided'}), 400
    
    required_fields = ['student_id', 'course_name', 'grade', 'numeric_grade']
    for field in required_fields:
        if field not in data:
            return jsonify({'error': f'Missing required field: {field}'}), 400
    
    student = StudentProfile.query.get(data['student_id'])
    if not student:
        return jsonify({'error': 'Student not found'}), 404
    
    new_grade = StudentGrade(
        student_profile_id=student.id,
        course_name=data['course_name'],
        grade=data['grade'],
        numeric_grade=float(data['numeric_grade']),
        term=data.get('term')
    )
    
    db.session.add(new_grade)
    
    # Update overall grade if needed
    if student.overall_grade is None:
        student.overall_grade = float(data['numeric_grade'])
    else:
        # Calculate new average
        all_grades = StudentGrade.query.filter_by(student_profile_id=student.id).all()
        all_grades.append(new_grade)  # Include the new grade
        total = sum(g.numeric_grade for g in all_grades)
        student.overall_grade = total / len(all_grades)
    
    db.session.commit()
    
    return jsonify({
        'success': True,
        'grade_id': new_grade.id,
        'new_overall_grade': student.overall_grade
    })

@grading.route('/grades/<int:grade_id>', methods=['PUT'])
@jwt_required()
def update_grade(grade_id):
    """Update a specific grade record."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    grade = StudentGrade.query.get_or_404(grade_id)
    data = request.json or {}
    
    if 'course_name' in data:
        grade.course_name = data['course_name']
    if 'grade' in data:
        grade.grade = data['grade']
    if 'numeric_grade' in data:
        grade.numeric_grade = float(data['numeric_grade'])
    if 'term' in data:
        grade.term = data['term']
    
    # Update the student's overall grade
    student = grade.student_profile
    all_grades = StudentGrade.query.filter_by(student_profile_id=student.id).all()
    if all_grades:
        total = sum(g.numeric_grade for g in all_grades)
        student.overall_grade = total / len(all_grades)
    else:
        student.overall_grade = None
    
    db.session.commit()
    
    return jsonify({
        'success': True,
        'grade_id': grade.id,
        'new_overall_grade': student.overall_grade
    })

@grading.route('/grades/<int:grade_id>', methods=['DELETE'])
@jwt_required()
def delete_grade(grade_id):
    """Delete a grade record."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    grade = StudentGrade.query.get_or_404(grade_id)
    student = grade.student_profile
    
    db.session.delete(grade)
    
    # Recalculate overall grade
    remaining_grades = StudentGrade.query.filter_by(student_profile_id=student.id).all()
    if remaining_grades:
        total = sum(g.numeric_grade for g in remaining_grades)
        student.overall_grade = total / len(remaining_grades)
    else:
        student.overall_grade = None
    
    db.session.commit()
    
    return jsonify({
        'success': True,
        'message': 'Grade deleted',
        'new_overall_grade': student.overall_grade
    })

@grading.route('/statements', methods=['GET'])
@jwt_required()
def list_statements():
    """List all statements, with optional filtering for ungraded ones."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    # Filter for ungraded statements if requested
    ungraded_only = request.args.get('ungraded', 'false').lower() == 'true'
    
    query = Statement.query
    if ungraded_only:
        query = query.filter(Statement.graded_by.is_(None))
    
    statements = query.all()
    result = []
    
    for stmt in statements:
        student = stmt.student_profile
        user = student.user if student else None
        
        result.append({
            'id': stmt.id,
            'student_name': f"{user.first_name} {user.last_name}" if user else "Unknown",
            'area_of_law': stmt.area_of_law,
            'content_preview': stmt.content[:100] + '...' if len(stmt.content) > 100 else stmt.content,
            'total_score': stmt.total_score,
            'is_graded': stmt.graded_by is not None,
            'graded_at': stmt.graded_at.isoformat() if stmt.graded_at else None
        })
    
    return jsonify({'statements': result})

@grading.route('/statements/<int:statement_id>', methods=['GET'])
@jwt_required()
def get_statement(statement_id):
    """Get detailed information about a specific statement."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    stmt = Statement.query.get_or_404(statement_id)
    student = stmt.student_profile
    user = student.user if student else None
    
    grader = None
    if stmt.graded_by:
        grader_user = User.query.get(stmt.graded_by)
        if grader_user:
            grader = f"{grader_user.first_name} {grader_user.last_name}"
    
    return jsonify({
        'id': stmt.id,
        'student': {
            'id': student.id,
            'name': f"{user.first_name} {user.last_name}" if user else "Unknown",
            'student_id': user.student_id if user else None
        },
        'area_of_law': stmt.area_of_law,
        'content': stmt.content,
        'ratings': {
            'clarity': stmt.clarity_rating,
            'relevance': stmt.relevance_rating,
            'passion': stmt.passion_rating,
            'understanding': stmt.understanding_rating,
            'goals': stmt.goals_rating,
            'total': stmt.total_score
        },
        'graded_by': grader,
        'graded_at': stmt.graded_at.isoformat() if stmt.graded_at else None
    })

@grading.route('/statements/<int:statement_id>/grade', methods=['POST'])
@jwt_required()
def grade_statement(statement_id):
    """Grade a student statement."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    stmt = Statement.query.get_or_404(statement_id)
    data = request.json or {}
    
    # Update ratings
    if 'clarity_rating' in data:
        stmt.clarity_rating = data['clarity_rating']
    if 'relevance_rating' in data:
        stmt.relevance_rating = data['relevance_rating']
    if 'passion_rating' in data:
        stmt.passion_rating = data['passion_rating']
    if 'understanding_rating' in data:
        stmt.understanding_rating = data['understanding_rating']
    if 'goals_rating' in data:
        stmt.goals_rating = data['goals_rating']
    
    # Calculate total score (average of all ratings)
    ratings = [
        stmt.clarity_rating or 0,
        stmt.relevance_rating or 0,
        stmt.passion_rating or 0,
        stmt.understanding_rating or 0,
        stmt.goals_rating or 0
    ]
    non_zero_ratings = [r for r in ratings if r > 0]
    
    if non_zero_ratings:
        stmt.total_score = sum(non_zero_ratings) / len(non_zero_ratings)
    else:
        stmt.total_score = 0
    
    # Set grading metadata
    stmt.graded_by = current_user.id
    stmt.graded_at = datetime.utcnow()
    
    # Update student's statement score (average of all statement scores)
    student = stmt.student_profile
    all_statements = Statement.query.filter_by(
        student_profile_id=student.id,
        graded_by=stmt.graded_by
    ).all()
    
    if all_statements:
        total = sum(s.total_score or 0 for s in all_statements if s.total_score is not None)
        student.statement_score = total / len(all_statements)
    
    db.session.commit()
    
    return jsonify({
        'success': True,
        'statement_id': stmt.id,
        'total_score': stmt.total_score,
        'student_statement_score': student.statement_score
    })

@grading.route('/export-grades', methods=['GET'])
@jwt_required()
def export_grades():
    """Export all grades as a CSV file."""
    current_user = get_current_user()
    if not current_user or current_user.role != 'admin':
        return jsonify({'error': 'Admin privileges required'}), 403
    
    output = io.StringIO()
    writer = csv.writer(output)
    
    # Write header
    writer.writerow([
        'Student ID', 'First Name', 'Last Name', 'Course', 'Grade', 
        'Numeric Grade', 'Term', 'Date Added'
    ])
    
    # Write data
    students = StudentProfile.query.all()
    for student in students:
        user = student.user
        for grade in student.grades:
            writer.writerow([
                user.student_id if user else '',
                user.first_name if user else '',
                user.last_name if user else '',
                grade.course_name,
                grade.grade,
                grade.numeric_grade,
                grade.term or '',
                grade.created_at.strftime('%Y-%m-%d') if grade.created_at else ''
            ])
    
    # Prepare response
    output.seek(0)
    filename = f"grades_export_{datetime.now().strftime('%Y%m%d')}.csv"
    
    return Response(
        output.getvalue(),
        mimetype='text/csv',
        headers={
            'Content-Disposition': f'attachment; filename="{filename}"',
            'Content-Type': 'text/csv'
        }
    )