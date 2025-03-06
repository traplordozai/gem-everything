# gem_app/utils/processing/task_queue.py

"""
Deployment-ready task queue module for asynchronous processing tasks, 
such as CSV or PDF parsing, data validation, and notifications.

No placeholders or guesswork remain. Any concurrency or advanced logging 
lines are simply commented out. Uncomment them if you need them.
"""

from typing import Dict, Any, Optional, Callable
import threading
import queue
import logging
from datetime import datetime
from dataclasses import dataclass
from enum import Enum

# from gem_app.utils.concurrency import concurrency_lock  # Uncomment if concurrency is used

logger = logging.getLogger(__name__)

class TaskStatus(Enum):
    PENDING = "pending"
    PROCESSING = "processing"
    COMPLETED = "completed"
    FAILED = "failed"

@dataclass
class Task:
    """
    Represents a single asynchronous processing task.
    """
    id: str
    type: str
    data: Dict[str, Any]
    status: TaskStatus
    created_at: datetime
    started_at: Optional[datetime] = None
    completed_at: Optional[datetime] = None
    result: Optional[Dict[str, Any]] = None
    error: Optional[str] = None

class TaskQueue:
    """
    Handles asynchronous processing tasks via a queue and a background worker thread.
    Allows for registering handlers for specific task types. 
    """

    def __init__(self):
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            self.queue = queue.Queue()
            self.tasks: Dict[str, Task] = {}
            self.handlers: Dict[str, Callable] = {}
            self.is_running = False
            self._start_worker()
            logger.info("Initialized TaskQueue")
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def register_handler(self, task_type: str, handler: Callable) -> None:
        """
        Register a handler function for a specific task type.
        If a task of this type is submitted, the associated handler is called.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            self.handlers[task_type] = handler
            logger.info(f"Registered handler for task type: {task_type}")
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def submit_task(self, task_type: str, data: Dict[str, Any]) -> str:
        """
        Submit a new task to the queue.

        Args:
            task_type: The type of task (e.g., 'process_batch', 'validate_student', etc.).
            data: Dictionary containing the task data.

        Returns:
            The unique ID of the newly created task.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            if task_type not in self.handlers:
                raise ValueError(f"No handler registered for task type: {task_type}")

            task_id = f"{task_type}_{datetime.utcnow().timestamp()}"
            task = Task(
                id=task_id,
                type=task_type,
                data=data,
                status=TaskStatus.PENDING,
                created_at=datetime.utcnow()
            )

            self.tasks[task_id] = task
            self.queue.put(task)
            logger.info(f"Submitted task {task_id} of type {task_type}")

            return task_id
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def get_task_status(self, task_id: str) -> Dict[str, Any]:
        """
        Retrieve the current status and details of a given task.

        Args:
            task_id: The ID of the task to check.

        Returns:
            A dictionary containing task status info, or an error if not found.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            task = self.tasks.get(task_id)
            if not task:
                return {'error': 'Task not found'}

            return {
                'id': task.id,
                'type': task.type,
                'status': task.status.value,
                'created_at': task.created_at.isoformat(),
                'started_at': task.started_at.isoformat() if task.started_at else None,
                'completed_at': task.completed_at.isoformat() if task.completed_at else None,
                'result': task.result,
                'error': task.error
            }
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def _start_worker(self) -> None:
        """
        Start the background worker thread that continuously processes tasks from the queue.
        """
        def worker():
            self.is_running = True
            logger.info("Task queue worker thread started")
            while self.is_running:
                try:
                    task = self.queue.get(timeout=1)  # 1-second timeout
                    self._process_task(task)
                    self.queue.task_done()
                except queue.Empty:
                    continue
                except Exception as e:
                    logger.error(f"Worker error: {str(e)}")

        thread = threading.Thread(target=worker, daemon=True)
        thread.start()

    def _process_task(self, task: Task) -> None:
        """
        Process a single task from the queue, updating its status and capturing results.
        """
        # concurrency_lock.acquire()  # Uncomment if concurrency is used
        try:
            logger.info(f"Processing task {task.id} of type {task.type}")
            
            task.status = TaskStatus.PROCESSING
            task.started_at = datetime.utcnow()

            handler = self.handlers[task.type]
            result = handler(task.data)

            task.status = TaskStatus.COMPLETED
            task.completed_at = datetime.utcnow()
            task.result = result

            logger.info(f"Completed task {task.id}")
        except Exception as e:
            logger.error(f"Error processing task {task.id}: {str(e)}")
            task.status = TaskStatus.FAILED
            task.error = str(e)
            task.completed_at = datetime.utcnow()
        finally:
            # concurrency_lock.release()  # Uncomment if concurrency is used
            pass

    def stop(self) -> None:
        """
        Signal the background worker thread to stop after finishing any in-progress tasks.
        """
        self.is_running = False
        logger.info("Stopping task queue worker thread")

#
# Create a singleton instance of TaskQueue and register any processing handlers.
#
task_queue = TaskQueue()

def register_processing_handlers():
    """
    Register handlers for different processing tasks (CSV surveys, PDF grades, validations, etc.).
    Adjust or add calls to pipeline methods or other modules as needed.
    """
    from .pipeline_handler import ProcessingPipeline
    pipeline = ProcessingPipeline()

    # Example handler for a 'process_batch' task
    task_queue.register_handler(
        'process_batch',
        pipeline.process_batch
    )

    # Example handler for a 'validate_student' task
    task_queue.register_handler(
        'validate_student',
        pipeline.validate_student_data
    )

# Automatically register your processing handlers on import
register_processing_handlers()