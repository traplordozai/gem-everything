<?php defined('ABSPATH') || exit; ?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="gem-calendar-container">
        <div id="gem-faculty-calendar">
            <!-- Calendar will be initialized here via JavaScript -->
            <div class="calendar-loading">Loading calendar...</div>
        </div>
        
        <div class="calendar-actions">
            <button type="button" class="button button-primary" id="add-event-btn">
                Add New Event
            </button>
        </div>
    </div>

    <!-- Add/Edit Event Modal -->
    <div id="event-modal" class="gem-modal" style="display: none;">
        <div class="gem-modal-content">
            <span class="gem-modal-close">&times;</span>
            <h2>Event Details</h2>
            <form id="event-form">
                <input type="hidden" id="event-id" name="event_id">
                
                <div class="form-field">
                    <label for="event-title">Title</label>
                    <input type="text" id="event-title" name="title" required>
                </div>
                
                <div class="form-field">
                    <label for="event-start">Start Date/Time</label>
                    <input type="datetime-local" id="event-start" name="start" required>
                </div>
                
                <div class="form-field">
                    <label for="event-end">End Date/Time</label>
                    <input type="datetime-local" id="event-end" name="end" required>
                </div>
                
                <div class="form-field">
                    <label for="event-description">Description</label>
                    <textarea id="event-description" name="description"></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="button button-primary">Save Event</button>
                    <button type="button" class="button button-secondary gem-modal-close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>