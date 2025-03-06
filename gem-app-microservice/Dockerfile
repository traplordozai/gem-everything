FROM python:3.9-slim

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    gcc \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Copy requirements
COPY requirements.txt .

# Install Python dependencies
RUN pip install --no-cache-dir -r requirements.txt

# Copy the rest of the code
COPY . .

# Set environment variables
ENV FLASK_APP=application.py
ENV FLASK_ENV=development
ENV PYTHONPATH=/app

# Expose port 5000
EXPOSE 5000

# Run gunicorn with a healthcheck
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost:5000/health || exit 1

# Command to run the application
CMD ["flask", "run", "--host=0.0.0.0", "--port=5000"]