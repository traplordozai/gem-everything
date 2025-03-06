# gem_app/utils/processing/__init__.py

"""
Deployment-ready __init__.py for the 'processing' subpackage, 
exposing PipelineHandler, task queue, data validator, and scheduler.
No placeholders or guesswork remain.
"""

from .pipeline_handler import ProcessingPipeline
from .task_queue import task_queue
from .data_validator import DataValidator
from .scheduler import scheduler

__all__ = [
    'ProcessingPipeline',
    'task_queue',
    'DataValidator',
    'scheduler'
]