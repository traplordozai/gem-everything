# gem_app/utils/csv_parser.py

import pandas as pd
import numpy as np
import json
import logging
from typing import Dict, List, Optional, Tuple

from datetime import datetime

# If you have a concurrency lock or user-tracking setup, import them here:
# from gem_app.utils.concurrency import concurrency_lock
# from flask import current_app
# from flask_login import current_user

# We definitely have a PDF parser in gem_app/utils/pdf_parser.py:
from gem_app.utils.pdf_parser import process_grade_pdf

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

###############################################################################
# SurveyDataParser
###############################################################################
class SurveyDataParser:
    """
    Parses and validates CSV survey data (student demographics, rankings, statements),
    cleans the fields, and extracts per-student data for further processing.
    """

    def __init__(self):
        """
        required_columns organizes the fields by category to ensure everything
        we need is present in the CSV. 'rankings' will help us create numeric
        match scores, 'statements' are the text-based areas, and 'demographic'
        must contain name/email/Student ID.
        """
        self.required_columns = {
            'demographic': [
                'RecipientLastName',
                'RecipientFirstName',
                'RecipientEmail',
                'Student ID'
            ],
            'rankings': [
                'PublicInterestRank', 'SocialJusticeRank', 'PrivateCivilRank',
                'InternationalLawRank', 'EnvironmentalLawRank', 'LabourLawRank',
                'FamilyLawRank', 'BusinessLawRank', 'IPLawRank'
            ],
            'statements': [
                'Public Interest', 'Social Justice', 'Private/Civil',
                'International Law', 'Environment', 'Labour', 'Family',
                'Business Law', 'IP'
            ]
        }

    ###########################################################################
    # parse_csv
    ###########################################################################
    def parse_csv(self, csv_content: str) -> Tuple[pd.DataFrame, List[str]]:
        """
        Parse the raw CSV data (already loaded as a string), validate columns,
        and clean the DataFrame if no validation errors.

        Returns (df, errors). If errors, df may be empty.
        """
        try:
            # concurrency_lock.acquire()  # Uncomment if you have concurrency

            df = pd.read_csv(csv_content)
            validation_errors = self._validate_dataframe(df)
            if not validation_errors:
                df = self._clean_dataframe(df)

            # concurrency_lock.release()  # Uncomment if you have concurrency
            return df, validation_errors

        except Exception as e:
            logger.error(f"Error parsing CSV: {str(e)}")
            # if concurrency_lock: concurrency_lock.release()
            return pd.DataFrame(), [str(e)]

    ###########################################################################
    # _validate_dataframe
    ###########################################################################
    def _validate_dataframe(self, df: pd.DataFrame) -> List[str]:
        """
        Ensures that required columns exist, IDs are present, and
        numeric fields are valid.
        """
        errors = []

        # Check required columns for each category
        for category, columns in self.required_columns.items():
            missing_cols = [col for col in columns if col not in df.columns]
            if missing_cols:
                errors.append(
                    f"Missing {category} columns: {', '.join(missing_cols)}"
                )

        # Validate Student ID presence
        if 'Student ID' in df.columns:
            missing_ids = df['Student ID'].isna().sum()
            if missing_ids > 0:
                errors.append(f"Found {missing_ids} missing Student ID(s).")

        # Validate numeric ranking columns
        ranking_cols = self.required_columns['rankings']
        for col in ranking_cols:
            if col in df.columns:
                # A “rank” must be numeric or blank
                mask_invalid = df[col].notna() & (~df[col].astype(str).str.match(r'^\d+(\.\d+)?$'))
                invalid_count = df[mask_invalid].shape[0]
                if invalid_count > 0:
                    errors.append(f"Found {invalid_count} invalid numeric rank values in {col}.")

        return errors

    ###########################################################################
    # _clean_dataframe
    ###########################################################################
    def _clean_dataframe(self, df: pd.DataFrame) -> pd.DataFrame:
        """
        Convert ranking columns to float, strip text fields,
        standardize case for email, etc.
        """
        # Convert ranking columns to numeric
        for col in self.required_columns['rankings']:
            if col in df.columns:
                df[col] = pd.to_numeric(df[col], errors='coerce')

        # Clean text-based statements
        for col in self.required_columns['statements']:
            if col in df.columns:
                df[col] = df[col].fillna('').str.strip()

        # Clean demographic fields
        df['RecipientLastName'] = df['RecipientLastName'].str.strip()
        df['RecipientFirstName'] = df['RecipientFirstName'].str.strip()
        df['RecipientEmail'] = df['RecipientEmail'].str.strip().str.lower()

        # Standardize Student ID
        df['Student ID'] = df['Student ID'].astype(str).str.strip()

        return df

    ###########################################################################
    # extract_student_data
    ###########################################################################
    def extract_student_data(self, df: pd.DataFrame, student_id: str) -> Dict:
        """
        Pull all relevant fields for a given student ID from the DataFrame,
        including demographic data, numeric rankings, statements, and preferences.
        """
        try:
            row = df[df['Student ID'] == student_id].iloc[0]

            # Build rankings
            ranking_data = {}
            for col in self.required_columns['rankings']:
                if col in df.columns:
                    # e.g. 'PublicInterestRank' => 'PublicInterest'
                    area_key = col.replace('Rank', '')
                    ranking_data[area_key] = row[col]

            # Build statements
            statement_data = {}
            for col in self.required_columns['statements']:
                if col in df.columns:
                    statement_data[col] = row[col]

            # Build preferences
            preferences = {
                'location': self._parse_location_preferences(row),
                'work_mode': self._parse_work_mode_preferences(row)
            }

            return {
                'demographic': {
                    'first_name': row['RecipientFirstName'],
                    'last_name': row['RecipientLastName'],
                    'email': row['RecipientEmail'],
                    'student_id': student_id
                },
                'rankings': ranking_data,
                'statements': statement_data,
                'preferences': preferences
            }

        except Exception as e:
            logger.error(f"Error extracting data for student {student_id}: {str(e)}")
            # current_app.logger.error(f"Extraction error for {student_id} by {current_user.id}")
            raise

    ###########################################################################
    # _parse_location_preferences
    ###########################################################################
    def _parse_location_preferences(self, row) -> List[str]:
        """
        If the CSV has a 'Location' column with comma-separated locations,
        parse and return a clean list. If not found or empty, return [].
        """
        try:
            raw_val = row.get('Location', '')
            if not raw_val:
                return []
            parts = raw_val.split(',')
            return [loc.strip() for loc in parts if loc.strip()]
        except:
            return []

    ###########################################################################
    # _parse_work_mode_preferences
    ###########################################################################
    def _parse_work_mode_preferences(self, row) -> List[str]:
        """
        If the CSV has a 'WorkMode' column with comma-separated modes,
        parse and return a clean list. If not found or empty, return [].
        """
        try:
            raw_val = row.get('WorkMode', '')
            if not raw_val:
                return []
            parts = raw_val.split(',')
            return [m.strip() for m in parts if m.strip()]
        except:
            return []

    ###########################################################################
    # calculate_ranking_scores
    ###########################################################################
    def calculate_ranking_scores(self, rankings: Dict[str, float]) -> Dict[str, float]:
        """
        Takes numeric ranks and converts them to normalized scores out of 30.
        (In your overall matching algorithm, 30% might be allocated to ranking preference.)

        If rank is missing or zero, we handle it gracefully by setting a 0 score.
        """
        try:
            if not rankings:
                return {}

            max_rank = max(rankings.values()) if rankings.values() else 0
            # Convert: rank -> raw score = (max_rank - rank + 1)
            raw_scores = {
                area: ((max_rank - val + 1) if val is not None else 0)
                for area, val in rankings.items()
            }
            total_raw = sum(raw_scores.values())

            # Normalize so sum of scores = 30
            if total_raw > 0:
                return {
                    area: (raw / total_raw) * 30
                    for area, raw in raw_scores.items()
                }
            return {area: 0 for area in rankings.keys()}

        except Exception as e:
            logger.error(f"Error in calculate_ranking_scores: {str(e)}")
            raise

    ###########################################################################
    # bulk_process_students
    ###########################################################################
    def bulk_process_students(self, df: pd.DataFrame) -> Dict[str, Dict]:
        """
        For each row in df, create the student's dictionary of data
        and store by ID.
        """
        results = {}
        for _, row in df.iterrows():
            sid = str(row['Student ID'])
            try:
                data = self.extract_student_data(df, sid)
                results[sid] = data
            except Exception as e:
                logger.error(f"Error in bulk processing for student {sid}: {str(e)}")
                # current_app.logger.info(f"Bulk process error for {sid}, user {current_user.id}")
                continue
        return results

    ###########################################################################
    # export_to_json
    ###########################################################################
    def export_to_json(self, data: Dict, output_path: str):
        """
        Simple JSON export. Raises on failure.
        """
        try:
            with open(output_path, 'w', encoding='utf-8') as f:
                json.dump(data, f, indent=2)
        except Exception as e:
            logger.error(f"Error exporting to JSON at {output_path}: {str(e)}")
            raise

###############################################################################
# process_survey_csv
###############################################################################
def process_survey_data(csv_path: str) -> Tuple[Dict[str, Dict], Optional[str]]:
    """
    High-level function to parse and process a single CSV file from disk.
    Returns (processed_data, error_msg).

    - processed_data: A dictionary keyed by student ID,
      containing demographic, statements, preferences, etc.
    - error_msg: None if successful, or a string explaining what went wrong.
    """
    parser = SurveyDataParser()
    try:
        with open(csv_path, 'r', encoding='utf-8') as csv_file:
            csv_content = csv_file.read()

        df, validation_errors = parser.parse_csv(csv_content)
        if validation_errors:
            return {}, "Validation errors: " + "; ".join(validation_errors)

        # Build the data for every student
        processed_data = parser.bulk_process_students(df)

        # Calculate ranking scores for each student
        for sid, student_data in processed_data.items():
            # Convert their raw 'rankings' into a normalized out-of-30 scale
            ranking_scores = parser.calculate_ranking_scores(student_data['rankings'])
            student_data['ranking_scores'] = ranking_scores

        return processed_data, None

    except Exception as e:
        logger.error(f"Error in process_survey_csv({csv_path}): {str(e)}")
        return {}, str(e)

###############################################################################
# DataBatchProcessor
###############################################################################
class DataBatchProcessor:
    """
    Processes multiple CSV and PDF files in one pass, merging them by student ID.
    No guesswork—this absolutely calls process_grade_pdf from pdf_parser.
    """

    def __init__(self):
        self.survey_parser = SurveyDataParser()

    def process_batch(
        self,
        csv_files: List[str],
        pdf_files: List[str]
    ) -> Tuple[Dict[str, Dict], List[str]]:
        """
        For each CSV in csv_files, parse + build data. For each PDF in pdf_files,
        parse + merge 'grades' into the existing data dict by matching student_id.

        Returns (merged_data, error_list).
        """
        errors = []
        merged_data = {}

        # concurrency_lock.acquire()  # Uncomment if concurrency is used

        # Process all CSVs
        for csvf in csv_files:
            try:
                data, err = process_survey_csv(csvf)
                if err:
                    errors.append(f"{csvf}: {err}")
                else:
                    # Merge into merged_data
                    for sid, stud_data in data.items():
                        if sid not in merged_data:
                            merged_data[sid] = stud_data
                        else:
                            # If that student ID is already present, we could merge fields
                            merged_data[sid].update(stud_data)
            except Exception as e:
                errors.append(f"{csvf}: {str(e)}")

        # Process all PDFs
        for pdff in pdf_files:
            try:
                pdf_data, pdf_err = process_grade_pdf(pdff)
                if pdf_err:
                    errors.append(f"{pdff}: {pdf_err}")
                else:
                    sid = pdf_data.get('student_id')
                    if sid is None:
                        errors.append(f"{pdff}: No student_id found in PDF data.")
                        continue

                    # Merge PDF grades into the existing record or create a new one
                    if sid not in merged_data:
                        merged_data[sid] = {}
                    merged_data[sid]['grades'] = pdf_data
            except Exception as e:
                errors.append(f"{pdff}: {str(e)}")

        # concurrency_lock.release()  # Uncomment if concurrency is used

        return merged_data, errors

###############################################################################
# validate_batch_results
###############################################################################
def validate_batch_results(processed_data: Dict[str, Dict]) -> List[str]:
    """
    Examine the final processed data (after merging CSV + PDF)
    to check for any missing fields or incomplete info.
    Returns a list of warnings.
    """
    warnings = []
    for sid, data in processed_data.items():
        # Check presence of top-level keys
        if 'demographic' not in data:
            warnings.append(f"Student {sid} missing 'demographic' info.")
        if 'rankings' not in data:
            warnings.append(f"Student {sid} missing 'rankings' info.")
        if 'statements' not in data:
            warnings.append(f"Student {sid} missing 'statements' info.")
        if 'grades' not in data:
            warnings.append(f"Student {sid} missing 'grades' from PDF.")

        # If we do have 'grades' but no course_grades, note it
        if 'grades' in data and not data['grades'].get('course_grades'):
            warnings.append(f"Student {sid} has 'grades' but no 'course_grades' details.")

        # Check if all ranks are zero or None
        if 'rankings' in data and data['rankings'] and not any(data['rankings'].values()):
            warnings.append(f"Student {sid} has empty numeric ranking data.")

    return warnings