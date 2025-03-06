<?php
defined('ABSPATH') || exit;

function render_faculty_dashboard() {
    $api = gem_app_api();
    $faculty_id = get_current_user_id();
    $stats = $api->request('/faculty/dashboard/' . $faculty_id);
    
    ?>
    <div class="wrap faculty-dashboard">
        <h1>Faculty Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Active Projects</h3>
                <div class="stat-value"><?php echo esc_html($stats['active_projects']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Student Applications</h3>
                <div class="stat-value"><?php echo esc_html($stats['pending_applications']); ?></div>
            </div>
            <div class="stat-card">
                <h3>Available Positions</h3>
                <div class="stat-value"><?php echo esc_html($stats['available_positions']); ?></div>
            </div>
        </div>
        
        <div class="recent-activity">
            <h2>Recent Activity</h2>
            <!-- Activity list -->
        </div>
    </div>
    <?php
}