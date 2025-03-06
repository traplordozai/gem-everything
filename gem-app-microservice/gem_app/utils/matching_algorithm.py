"""
Provides a dictionary-based matching algorithm with a deferred acceptance 
(stable matching) approach.

Usage Flow:
1. Prepare students and organizations as dictionaries
2. Run matching:
    algo = MatchingAlgorithm()
    matches, student_scores, unmatched = algo.run_matching_round(students, organizations)
3. Validate:
    errors = validate_matching_results(matches, students, organizations)
"""

from typing import Dict, List, Tuple, Optional
import logging
from datetime import datetime
import numpy as np
from collections import defaultdict

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

class MatchingAlgorithm:
    """
    Dictionary-based approach to:
      - compute match scores (ranking, grades, statement, location, work_mode)
      - run a deferred acceptance matching round
    """

    def __init__(self):
        """
        Initialize the matching algorithm with score component weights.
        
        weights: fraction of total match score allocated to each component:
        1. ranking: 0.30 - Student's ranking of the area of law
        2. grades: 0.30 - Student's academic performance
        3. statement: 0.20 - Student's statement quality
        4. location: 0.10 - Match between preferred and actual location
        5. work_mode: 0.10 - Match between preferred and actual work mode
        """
        self.weights = {
            'ranking': 0.30,
            'grades': 0.30,
            'statement': 0.20,
            'location': 0.10,
            'work_mode': 0.10
        }

    def calculate_match_scores(
        self,
        student: Dict,
        organization: Dict
    ) -> Tuple[float, Dict[str, float]]:
        """
        Calculate the match score for a (student, organization) pair.
        
        Args:
            student: Dictionary with student data
            organization: Dictionary with organization data
            
        Returns:
            tuple: (total_score, component_scores)
        """
        try:
            # 1) Ranking score - How the student ranked this area of law
            ranking_score = self._calculate_ranking_score(
                student.get('rankings', {}),
                organization.get('area_of_law', '')
            ) * self.weights['ranking']

            # 2) Grades score - Student's overall academic performance
            student_grade = student.get('grades', {}).get('overall_grade', 0)
            org_min_grade = organization.get('minimum_grade', 0)
            grades_score = self._calculate_grades_score(
                student_grade,
                org_min_grade
            ) * self.weights['grades']

            # 3) Statement score - Quality of student's statement for this area
            statement = student.get('statements', {}).get(
                organization.get('area_of_law', ''), ''
            )
            statement_ratings = student.get('statement_ratings', {})
            statement_score = self._calculate_statement_score(
                statement,
                statement_ratings
            ) * self.weights['statement']

            # 4) Location score - Match between preferred and actual locations
            location_score = self._calculate_location_score(
                student.get('preferences', {}).get('location', []),
                organization.get('location', '')
            ) * self.weights['location']

            # 5) Work mode score - Match between preferred and actual work modes
            work_mode_score = self._calculate_work_mode_score(
                student.get('preferences', {}).get('work_mode', []),
                organization.get('work_mode', '')
            ) * self.weights['work_mode']

            # Collect all component scores
            component_scores = {
                'ranking': ranking_score,
                'grades': grades_score,
                'statement': statement_score,
                'location': location_score,
                'work_mode': work_mode_score
            }
            
            # Sum for total score
            total_score = sum(component_scores.values())

            return total_score, component_scores

        except Exception as e:
            logger.error(f"Error in calculate_match_scores: {str(e)}")
            raise

    def _calculate_ranking_score(
        self,
        student_rankings: Dict[str, float],
        org_area: str
    ) -> float:
        """
        Convert student's area-of-law ranking to a 0-1 scale.
        
        Typically lower rank → higher preference → higher score.
        We'll invert & normalize by max rank in student_rankings.
        
        Args:
            student_rankings: Dictionary mapping areas to rank values
            org_area: The organization's area of law
            
        Returns:
            float: Score between 0 and 1
        """
        try:
            if not student_rankings or not org_area:
                return 0.0

            max_rank = max(student_rankings.values())
            if max_rank <= 0:
                return 0.0

            # If org_area not found, we assume worst rank
            area_rank = student_rankings.get(org_area, max_rank)

            # Invert: lower rank → higher score
            # raw range → 1..(max_rank+1)
            # e.g. if area_rank=1 => raw_score=(max_rank-1+1)=max_rank
            # normalized => raw_score / max_rank
            raw_score = (max_rank - area_rank + 1)
            return raw_score / max_rank

        except Exception as e:
            logger.error(f"Error calculating ranking score: {str(e)}")
            return 0.0

    def _calculate_grades_score(
        self,
        student_grade: float,
        minimum_grade: float
    ) -> float:
        """
        Calculate a score based on student's grades.
        
        student_grade is out of 40.
        If student_grade < minimum_grade => 0.
        Otherwise scale to 0..1 => grade/40
        
        Args:
            student_grade: Student's overall grade (out of 40)
            minimum_grade: Organization's minimum grade requirement
            
        Returns:
            float: Score between 0 and 1
        """
        try:
            if student_grade < minimum_grade:
                return 0.0
            return min(float(student_grade) / 40.0, 1.0)
        except Exception as e:
            logger.error(f"Error calculating grades score: {str(e)}")
            return 0.0

    def _calculate_statement_score(
        self,
        statement: str,
        ratings: Dict[str, int]
    ) -> float:
        """
        Calculate a score based on the quality of the student's statement.
        
        If we have statement rating keys like 'clarity','relevance','passion',
        'understanding','goals' each 1..5, we average => 0..1.
        If no ratings or no statement => 0
        
        Args:
            statement: The student's statement text
            ratings: Dictionary of statement ratings
            
        Returns:
            float: Score between 0 and 1
        """
        try:
            if not statement or not ratings:
                return 0.0

            # For instance, sum(ratings.values()) could be up to 25 if each is 5
            # We want 0..1 => sum(...) / (len(ratings)*5)
            sum_r = sum(ratings.values())
            max_possible = len(ratings) * 5.0
            if max_possible == 0:
                return 0.0
            return float(sum_r) / max_possible

        except Exception as e:
            logger.error(f"Error calculating statement score: {str(e)}")
            return 0.0

    def _calculate_location_score(
        self,
        student_locations: List[str],
        org_location: str
    ) -> float:
        """
        Calculate a score based on location preferences.
        
        If org_location is in student's list => 1
        If no preference => 0.5
        Else => 0
        
        Args:
            student_locations: List of student's preferred locations
            org_location: Organization's location
            
        Returns:
            float: Score (0, 0.5, or 1)
        """
        try:
            if not student_locations:
                return 0.5
            return 1.0 if org_location in student_locations else 0.0
        except Exception as e:
            logger.error(f"Error calculating location score: {str(e)}")
            return 0.0

    def _calculate_work_mode_score(
        self,
        student_modes: List[str],
        org_mode: str
    ) -> float:
        """
        Calculate a score based on work mode preferences.
        
        If org_mode is in student's list => 1
        If no preference => 0.5
        else => 0
        
        Args:
            student_modes: List of student's preferred work modes
            org_mode: Organization's work mode
            
        Returns:
            float: Score (0, 0.5, or 1)
        """
        try:
            if not student_modes:
                return 0.5
            return 1.0 if org_mode in student_modes else 0.0
        except Exception as e:
            logger.error(f"Error calculating work mode score: {str(e)}")
            return 0.0

    def run_matching_round(
        self,
        students: Dict[str, Dict],
        organizations: Dict[str, Dict],
        previous_matches: Optional[Dict[str, List[str]]] = None
    ) -> Tuple[Dict[str, List[str]], Dict[str, List[float]], List[str]]:
        """
        Run a single round of deferred acceptance matching.
        
        Args:
            students: Dictionary of student data keyed by student ID
            organizations: Dictionary of organization data keyed by org ID
            previous_matches: Dictionary of existing matches from previous rounds
            
        Returns:
            tuple: (current_matches, student_scores, unmatched_students)
              - current_matches: {org_id -> [student_id,...]}
              - student_scores: {student_id -> [list_of_scores_for_each org]}
              - unmatched_students: [list_of_student_ids]
        """
        try:
            unmatched_students = list(students.keys())
            current_matches: Dict[str, List[str]] = {}
            student_preferences: Dict[str, List[Tuple[str, float]]] = defaultdict(list)

            # 1) Calculate scores for each feasible (student, org) pair
            for sid, sdata in students.items():
                for oid, odata in organizations.items():
                    capacity = odata.get('available_positions', 1)
                    if capacity <= 0:
                        continue
                    score, _ = self.calculate_match_scores(sdata, odata)
                    if score > 0:
                        student_preferences[sid].append((oid, score))

            # 2) Sort each student's preference list by descending score
            for sid in student_preferences:
                student_preferences[sid].sort(key=lambda x: x[1], reverse=True)

            # 3) Deferred acceptance loop
            while unmatched_students:
                sid = unmatched_students[0]
                prefs = student_preferences[sid]
                if not prefs:
                    # No viable org left for this student
                    unmatched_students.remove(sid)
                    continue

                # Student proposes to their top choice
                org_id, score = prefs[0]
                org_info = organizations[org_id]
                capacity = org_info.get('available_positions', 1)

                # Initialize org's match list if needed
                if org_id not in current_matches:
                    current_matches[org_id] = []

                if len(current_matches[org_id]) < capacity:
                    # Organization has space, accept the student
                    current_matches[org_id].append(sid)
                    unmatched_students.remove(sid)
                else:
                    # Organization is full, see if this student should replace someone
                    matched_with_scores: List[Tuple[str, float]] = []
                    
                    # Get scores for all students currently matched with this org
                    for msid in current_matches[org_id]:
                        ms_score = 0.0
                        for (orgpref, s) in student_preferences[msid]:
                            if orgpref == org_id:
                                ms_score = s
                                break
                        matched_with_scores.append((msid, ms_score))

                    # Add the current student
                    matched_with_scores.append((sid, score))

                    # Sort by score, keep top 'capacity' students
                    sorted_candidates = sorted(matched_with_scores, key=lambda x: x[1], reverse=True)
                    new_matched = sorted_candidates[:capacity]
                    new_ids = [m[0] for m in new_matched]

                    # Update the organization's matches
                    current_matches[org_id] = new_ids

                    # Find students who lost their spot
                    bumped = set(x[0] for x in matched_with_scores) - set(new_ids)
                    
                    if sid in bumped:
                        # Current student was bumped, remove top preference
                        student_preferences[sid].pop(0)

                    # Handle all bumped students
                    for bump_sid in bumped:
                        if bump_sid != sid:
                            # Re-add them to unmatched list
                            if bump_sid not in unmatched_students:
                                unmatched_students.append(bump_sid)

                    # Remove current student from unmatched
                    unmatched_students.remove(sid)
                    
                    # Re-add if they were bumped
                    if sid in bumped:
                        unmatched_students.append(sid)

            # Build student_scores dictionary (scores for each preference)
            student_scores: Dict[str, List[float]] = {}
            for sid, prefs in student_preferences.items():
                student_scores[sid] = [sc for (_, sc) in prefs]

            # Gather unmatched students (those not matched to any organization)
            matched_students = {s for slist in current_matches.values() for s in slist}
            all_students_set = set(students.keys())
            unmatched_list = list(all_students_set - matched_students)

            return current_matches, student_scores, unmatched_list

        except Exception as e:
            logger.error(f"Error in run_matching_round: {str(e)}")
            raise

def validate_matching_results(
    matches: Dict[str, List[str]],
    students: Dict[str, Dict],
    organizations: Dict[str, Dict]
) -> List[str]:
    """
    Validate final matches for capacity and duplication errors.
    
    Args:
        matches: Dictionary of matches {org_id: [student_id, ...]}
        students: Dictionary of student data {student_id: {...}}
        organizations: Dictionary of organization data {org_id: {...}}
        
    Returns:
        list: List of error messages (empty if valid)
    """
    errors = []

    # 1) Check capacities
    for oid, matched_sids in matches.items():
        if oid not in organizations:
            errors.append(f"Unknown organization ID: {oid}")
            continue
        capacity = organizations[oid].get('available_positions', 1)
        if len(matched_sids) > capacity:
            errors.append(
                f"Organization {oid} matched with {len(matched_sids)} students but capacity is {capacity}."
            )

    # 2) Check for unknown or duplicated students
    assigned_students = set()
    for oid, matched_sids in matches.items():
        for sid in matched_sids:
            if sid not in students:
                errors.append(f"Unknown student ID: {sid} in matches for organization {oid}")
            if sid in assigned_students:
                errors.append(f"Student {sid} matched multiple times.")
            assigned_students.add(sid)

    return errors