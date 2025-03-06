class GEM_Application_Review {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_review_menu'));
        add_action('wp_ajax_update_application_status', array($this, 'handle_status_update'));
        add_action('wp_ajax_add_application_note', array($this, 'handle_note_addition'));
    }

    public function render_review_interface() {
        $applications = $this->get_pending_applications();
        
        ?>
        <div class="wrap application-review">
            <h1>Student Applications</h1>
            
            <div class="review-filters">
                <div class="filter-group">
                    <label>Filter by:</label>
                    <select id="projectFilter">
                        <option value="">All Projects</option>
                        <?php $this->render_project_options(); ?>
                    </select>
                    
                    <select id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending Review</option>
                        <option value="shortlisted">Shortlisted</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="search-box">
                    <input type="text" id="applicationSearch" placeholder="Search applications...">
                </div>
            </div>

            <div class="applications-grid">
                <?php foreach ($applications as $application): ?>
                    <div class="application-card" data-id="<?php echo esc_attr($application->id); ?>">
                        <div class="student-info">
                            <img src="<?php echo esc_url($application->student_avatar); ?>" alt="Student Photo">
                            <h3><?php echo esc_html($application->student_name); ?></h3>
                            <p><?php echo esc_html($application->project_title); ?></p>
                        </div>
                        
                        <div class="application-meta">
                            <span class="status <?php echo esc_attr($application->status); ?>">
                                <?php echo esc_html(ucfirst($application->status)); ?>
                            </span>
                            <span class="date">
                                <?php echo esc_html($application->submission_date); ?>
                            </span>
                        </div>

                        <div class="application-actions">
                            <button class="view-details">View Details</button>
                            <button class="shortlist">Shortlist</button>
                            <button class="schedule-interview">Schedule Interview</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Application Details Modal -->
            <div id="applicationModal" class="modal">
                <!-- Modal content -->
            </div>
        </div>
        <?php
    }

    private function get_pending_applications() {
        $api = gem_app_api();
        return $api->request('/faculty/applications/pending');
    }
}