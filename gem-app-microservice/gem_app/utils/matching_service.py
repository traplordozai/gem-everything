"""
Provides a MatchingService class that uses the MatchingAlgorithm
to run multi-round matching and persist results as Match objects in the database.
"""

import logging
from typing import Dict, List, Any, Optional
from collections import defaultdict

from gem_app.extensions import db
from gem_app.models.matching import Match, MatchingRound
from gem_app.models.student import StudentProfile, Statement, AreaRanking
from gem_app.models.organization import OrganizationProfile, OrganizationRequirement
from gem_app.utils.matching_algorithm import MatchingAlgorithm

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

class MatchingService:
    """
    A service class that orchestrates:
      1) Loading data from StudentProfile and OrganizationProfile models
      2) Running multi-round matching (deferred acceptance)
      3) Creating or updating Match records in the DB

    Usage:
        matching_svc = MatchingService()
        results = matching_svc.run_matching(max_rounds=3)
        # results => {'matches': {org_id: [student_id, ...]}, 'unmatched': [student_id,...]}
    """

    def __init__(self):
        """Initialize the matching service with an algorithm instance."""
        self.matching_algorithm = MatchingAlgorithm()

    def run_matching(self, max_rounds: int = 3, round_number: Optional[int] = None) -> Dict[str, Any]:
        """
        Main entry point for the matching process:
          1) Gathers data for students and organizations
          2) Runs up to `max_rounds` of matching
          3) Saves matches to the database with status='pending'

        Args:
            max_rounds: Maximum number of matching rounds to run
            round_number: Optional specific round number to use
            
        Returns:
            dict: Results with 'matches' and 'unmatched' keys
        """
        try:
            # Prepare data for the algorithm
            students = self._get_students_for_matching()
            organizations = self._get_organizations_for_matching()

            # Initialize tracking structures
            all_matches = {}  # Will store all matches across rounds
            unmatched_students = list(students.keys())
            
            # If not specified, calculate current round number
            if round_number is None:
                round_number = MatchingRound.query.count() + 1

            # Track which round each match was made in
            round_results = []
            
            # Run multiple rounds of matching
            current_round = 1
            while unmatched_students and current_round <= max_rounds:
                logger.info(f"Starting matching round {current_round} with {len(unmatched_students)} unmatched students")
                
                # Run a matching round
                round_matches, student_scores, unmatched_students = self.matching_algorithm.run_matching_round(
                    students,
                    organizations,
                    previous_matches=all_matches
                )
                
                # Track which round each match was made in
                for org_id, student_ids in round_matches.items():
                    for student_id in student_ids:
                        round_results.append({
                            'student_id': student_id,
                            'org_id': org_id,
                            'round': current_round
                        })
                
                # Merge round matches into overall matches
                for org_id, student_ids in round_matches.items():
                    if org_id not in all_matches:
                        all_matches[org_id] = []
                    
                    # Only add students not already matched
                    for student_id in student_ids:
                        if student_id not in all_matches[org_id]:
                            all_matches[org_id].append(student_id)
                
                current_round += 1

            # Save matches to database
            self._save_matches_to_database(all_matches, round_results, round_number)

            return {
                'matches': all_matches,
                'unmatched': unmatched_students,
                'round_results': round_results
            }
        
        except Exception as e:
            logger.error(f"Error running matching: {str(e)}")
            db.session.rollback()
            raise

    def _get_students_for_matching(self) -> Dict[str, Dict]:
        """
        Load eligible students from the database and convert to dictionary format.
        
        Returns:
            dict: Student data keyed by student ID
        """
        # Get students with 'unmatched' or 'pending' status
        eligible_students = StudentProfile.query.filter(
            StudentProfile.status.in_(['unmatched', 'pending'])
        ).all()

        # Build student dictionary for the algorithm
        students_dict = {}
        for student in eligible_students:
            # Skip students without a user
            if not student.user:
                continue
                
            student_id = str(student.id)  # Use profile ID as the key

            # Build ranking dictionary from AreaRanking objects
            ranking_dict = {}
            for ranking in student.rankings:
                ranking_dict[ranking.area_of_law] = float(ranking.rank)

            # Build statements dictionary from Statement objects
            statement_dict = {}
            for stmt in student.statements:
                statement_dict[stmt.area_of_law] = stmt.content

            # Build statement ratings dictionary
            statement_ratings = {}
            for stmt in student.statements:
                if stmt.graded_by is not None:
                    area_ratings = {}
                    if stmt.clarity_rating is not None:
                        area_ratings['clarity'] = stmt.clarity_rating
                    if stmt.relevance_rating is not None:
                        area_ratings['relevance'] = stmt.relevance_rating
                    if stmt.passion_rating is not None:
                        area_ratings['passion'] = stmt.passion_rating
                    if stmt.understanding_rating is not None:
                        area_ratings['understanding'] = stmt.understanding_rating
                    if stmt.goals_rating is not None:
                        area_ratings['goals'] = stmt.goals_rating
                    
                    statement_ratings[stmt.area_of_law] = area_ratings

            # Create a properly formatted student entry
            students_dict[student_id] = {
                'id': student_id,
                'user_id': student.user.id,
                'rankings': ranking_dict,
                'grades': {'overall_grade': float(student.overall_grade or 0.0)},
                'statements': statement_dict,
                'statement_ratings': statement_ratings,
                'preferences': {
                    # These fields might not exist in the current model
                    # We'll use empty lists as fallback
                    'location': getattr(student, 'location_preferences', []) or [],
                    'work_mode': [getattr(student, 'work_mode', '')] if hasattr(student, 'work_mode') and student.work_mode else []
                }
            }

        return students_dict

    def _get_organizations_for_matching(self) -> Dict[str, Dict]:
        """
        Load organizations from the database and convert to dictionary format.
        
        Returns:
            dict: Organization data keyed by organization ID
        """
        orgs = OrganizationProfile.query.all()
        orgs_dict = {}
        
        for org in orgs:
            # Skip if no positions available
            if org.available_positions <= org.filled_positions:
                continue
                
            org_id = str(org.id)  # Use profile ID as the key

            # Find minimum grade requirement if any
            min_grade = 0.0  # Default minimum grade
            if hasattr(org, 'requirements'):
                for req in org.requirements:
                    if req.requirement_type == 'minimum_grade':
                        try:
                            min_grade = float(req.value)
                        except (ValueError, TypeError):
                            # Keep default if conversion fails
                            pass

            # Create organization entry
            orgs_dict[org_id] = {
                'id': org_id,
                'user_id': org.user_id,
                'name': org.name,
                'area_of_law': org.area_of_law,
                'location': org.location,
                'work_mode': org.work_mode,
                'available_positions': org.available_positions - org.filled_positions,  # Available positions remaining
                'minimum_grade': min_grade
            }

        return orgs_dict

    def _save_matches_to_database(self, 
                                  final_matches: Dict[str, List[str]], 
                                  round_results: List[Dict], 
                                  round_number: int) -> None:
        """
        Save matching results to the database.
        
        Args:
            final_matches: Dictionary of matches {org_id: [student_id, ...]}
            round_results: List of match details with round numbers
            round_number: The round number to use for this batch
        """
        try:
            # Create a MatchingRound record
            matching_round = MatchingRound.query.filter_by(round_number=round_number).first()
            
            # If no matching round exists, create a new one
            if not matching_round:
                from flask import current_app
                from flask_login import current_user
                
                # Use a system user ID if not in a request context
                user_id = None
                try:
                    if current_user and current_user.is_authenticated:
                        user_id = current_user.id
                    else:
                        # Find the first admin user
                        from gem_app.models.user import User
                        admin = User.query.filter_by(role='admin').first()
                        if admin:
                            user_id = admin.id
                except Exception:
                    pass
                
                matching_round = MatchingRound(
                    round_number=round_number,
                    status='started',
                    started_by=user_id
                )
                db.session.add(matching_round)
                db.session.commit()
            
            # Create a round_info dictionary to track which round each match was made in
            round_info = {}
            for result in round_results:
                student_id = result['student_id']
                org_id = result['org_id']
                match_round = result['round']
                round_info[(student_id, org_id)] = match_round
            
            # Create Match objects for each student-organization pair
            for org_id, student_ids in final_matches.items():
                for student_id in student_ids:
                    # Check if this match already exists
                    existing_match = Match.query.filter_by(
                        student_profile_id=int(student_id),
                        organization_profile_id=int(org_id)
                    ).first()
                    
                    if not existing_match:
                        # Create component scores
                        students = self._get_students_for_matching()
                        organizations = self._get_organizations_for_matching()
                        
                        student = students.get(student_id)
                        organization = organizations.get(org_id)
                        
                        if student and organization:
                            total_score, component_scores = self.matching_algorithm.calculate_match_scores(
                                student, organization
                            )
                            
                            # Get the round this match was made in
                            match_round = round_info.get((student_id, org_id), 1)
                            
                            # Create the match record
                            match = Match(
                                student_profile_id=int(student_id),
                                organization_profile_id=int(org_id),
                                status='pending',
                                match_type='algorithmic',
                                score=total_score,
                                round_number=match_round,
                                ranking_score=component_scores.get('ranking', 0),
                                grades_score=component_scores.get('grades', 0),
                                statement_score=component_scores.get('statement', 0),
                                location_score=component_scores.get('location', 0),
                                work_mode_score=component_scores.get('work_mode', 0)
                            )
                            db.session.add(match)
            
            # Update the matching round status
            matching_round.status = 'completed'
            matching_round.total_students = len(set(student_id for matches in final_matches.values() for student_id in matches))
            matching_round.matched_students = matching_round.total_students
            matching_round.total_organizations = len(final_matches)
            
            # Commit all changes
            db.session.commit()
            
            logger.info(f"Saved {matching_round.matched_students} matches to database in round {round_number}")
            
        except Exception as e:
            db.session.rollback()
            logger.error(f"Error saving matches to database: {str(e)}")
            raise