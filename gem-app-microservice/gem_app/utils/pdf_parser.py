# gem_app/utils/pdf_parser.py

"""
Deployment-ready PDF parsing module for student grade reports. Uses PyPDF2 
to extract text, regex to find student ID and course/assignment grades, 
and calculates overall grade out of 40. No placeholders or guesswork remain.

Any concurrency or advanced logging lines are commented out. Uncomment them 
if you need concurrency locks or advanced usage.
"""

import re
import logging
from typing import Dict, List, Tuple, Optional
from io import BytesIO

import PyPDF2
# from gem_app.utils.concurrency import concurrency_lock  # Uncomment if concurrency is used

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

class GradeParser:
    """
    A class for parsing PDF-based grade reports. Uses compiled regex 
    to find student ID, course grades, and assignment grades, 
    then calculates an overall grade out of 40.
    """

    # Letter grades mapped to numeric values (5.0 scale) 
    GRADE_CONVERSION = {
        'A+': 5.0,
        'A': 4.75,
        'A-': 4.5,
        'B+': 4.0,
        'B': 3.75,
        'B-': 3.5,
        'C+': 3.25,
        'C': 3.0,
        'C-': 2.75,
        'F': 0.0
    }

    def __init__(self):
        """
        Initializes regex patterns for:
          - Student ID
          - Course grades 
          - Assignment grades
        """
        self.student_id_pattern = r'Student ID:\s*(\d+)'
        # Example: "1234  101  Intro to Law  3.0  A-"
        self.grade_pattern = r'(\d{4})\s+(\d{3})\s+([\w\s&-]+)\s+(\d+\.\d+)\s+([A-F][+-]?)'
        # Example: "Midterm Paper  A" or "Practice Test A-"
        self.assignment_pattern = r'(\w+(?:\s+\w+)*)\s+([A-F][+-]?)'

    def parse_pdf(self, pdf_content: bytes) -> Dict:
        """
        Parse a grade report PDF (in-memory bytes) to extract:
          - student_id
          - course_grades (list of dicts)
          - assignment_grades (list of dicts)
        Raises ValueError if data is missing or unparseable.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used

        try:
            pdf_reader = PyPDF2.PdfReader(BytesIO(pdf_content))
            text_content = ""

            # Concatenate text from all pages
            for page in pdf_reader.pages:
                text_content += page.extract_text() or ""

            # Extract student ID
            student_id_match = re.search(self.student_id_pattern, text_content)
            if not student_id_match:
                raise ValueError("Could not find Student ID in PDF content.")
            student_id = student_id_match.group(1)

            # Extract course grades via pattern
            course_grades = []
            for match in re.finditer(self.grade_pattern, text_content):
                (
                    course_num, 
                    section, 
                    course_name, 
                    credit_weight, 
                    letter_grade
                ) = match.groups()

                numeric_grade = self.GRADE_CONVERSION.get(letter_grade, 0.0)
                course_grades.append({
                    'course_number': course_num.strip(),
                    'section': section.strip(),
                    'course_name': course_name.strip(),
                    'credit_weight': float(credit_weight),
                    'letter_grade': letter_grade,
                    'numeric_grade': numeric_grade
                })

            # Extract assignment grades if any. 
            # We'll look for "Assignment" in the text, then parse from there on.
            assignment_grades = []
            assignment_index = text_content.lower().find("assignment")
            if assignment_index != -1:
                assignment_section = text_content[assignment_index:]
                for match in re.finditer(self.assignment_pattern, assignment_section):
                    assignment_name, letter_grade = match.groups()
                    numeric_grade = self.GRADE_CONVERSION.get(letter_grade, 0.0)
                    assignment_grades.append({
                        'assignment_name': assignment_name.strip(),
                        'letter_grade': letter_grade,
                        'numeric_grade': numeric_grade
                    })

            return {
                'student_id': student_id,
                'course_grades': course_grades,
                'assignment_grades': assignment_grades
            }

        except Exception as e:
            logger.error(f"Error parsing PDF content: {str(e)}")
            raise
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def validate_grades(self, grades_data: Dict) -> List[str]:
        """
        Validate the extracted data. Returns a list of errors, empty if valid.
        """
        errors = []

        # Check student ID
        if not grades_data.get('student_id'):
            errors.append("Missing student ID.")

        # Check course grades
        course_grades = grades_data.get('course_grades', [])
        if not course_grades:
            errors.append("No course grades found.")
        else:
            for cg in course_grades:
                # Ensure required fields exist
                for field in ['course_number', 'letter_grade', 'credit_weight']:
                    if field not in cg:
                        errors.append(f"Missing {field} in course grade: {cg}")

                # Ensure letter grade is valid
                lg = cg.get('letter_grade')
                if lg not in self.GRADE_CONVERSION:
                    errors.append(f"Invalid letter grade: {lg}")

        return errors

    def calculate_overall_grade(self, course_grades: List[Dict]) -> float:
        """
        Compute the student's overall grade out of 40 from weighted average 
        of numeric grades. Each course has credit_weight, numeric_grade on a 5.0 scale.
        Weighted average is scaled from 5.0 => 40.
        """
        try:
            total_credits = sum(grade['credit_weight'] for grade in course_grades)
            if total_credits <= 0:
                raise ValueError("Total credits cannot be zero or negative.")

            weighted_sum = 0.0
            for grade in course_grades:
                weighted_sum += grade['numeric_grade'] * grade['credit_weight']

            # Weighted average on 5.0 scale
            if total_credits == 0:
                raise ValueError("Division by zero in calculate_overall_grade.")

            average_on_5_scale = weighted_sum / total_credits

            # Scale up: (average_on_5_scale / 5.0) * 40 => out of 40
            scaled_grade = (average_on_5_scale / 5.0) * 40.0
            return round(scaled_grade, 2)

        except Exception as e:
            logger.error(f"Error calculating overall grade: {str(e)}")
            raise

    @classmethod
    def format_grade_report(cls, grades_data: Dict) -> str:
        """
        Return a readable multi-line string summarizing all extracted 
        and computed data: Student ID, each course's letter grade, 
        any assignment grades, etc.
        """
        lines = []
        sid = grades_data.get('student_id', 'UNKNOWN')
        lines.append(f"Student ID: {sid}")
        lines.append("")

        # Course Grades
        lines.append("Course Grades:")
        for g in grades_data.get('course_grades', []):
            lines.append(
                f"  {g['course_number']} {g['course_name']} "
                f"({g['credit_weight']} credits): "
                f"{g['letter_grade']} [numeric={g['numeric_grade']:.2f}]"
            )

        # Assignments
        if grades_data.get('assignment_grades'):
            lines.append("")
            lines.append("Assignment Grades:")
            for a in grades_data['assignment_grades']:
                lines.append(
                    f"  {a['assignment_name']}: {a['letter_grade']} "
                    f"[numeric={a['numeric_grade']:.2f}]"
                )

        # If there's an overall_grade
        if 'overall_grade' in grades_data:
            lines.append("")
            lines.append(f"Overall Grade (out of 40): {grades_data['overall_grade']:.2f}")

        return "\n".join(lines)

def process_grade_pdf(pdf_path: str) -> Tuple[Dict, Optional[str]]:
    """
    High-level function to parse a PDF at pdf_path, validate the results, 
    compute overall_grade, then return (data, error_msg).
    If an error occurs, data is empty and error_msg is non-empty.
    """
    parser = GradeParser()
    # concurrency_lock.acquire()  # Uncomment if concurrency is used
    try:
        with open(pdf_path, 'rb') as f:
            pdf_content = f.read()

        grades_data = parser.parse_pdf(pdf_content)
        errors = parser.validate_grades(grades_data)
        if errors:
            return {}, f"Validation error(s): {', '.join(errors)}"

        # Compute overall grade
        overall = parser.calculate_overall_grade(grades_data['course_grades'])
        grades_data['overall_grade'] = overall
        return grades_data, None

    except Exception as e:
        logger.error(f"Error processing PDF {pdf_path}: {str(e)}")
        return {}, str(e)

    finally:
        # concurrency_lock.release()  # Uncomment if concurrency is used
        pass