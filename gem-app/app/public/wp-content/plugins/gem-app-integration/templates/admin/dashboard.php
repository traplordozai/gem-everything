<div class="wrap gem-admin-dashboard">
    <h1>GEM Portal Dashboard</h1>
    
    <div class="gem-dashboard-grid">
        <!-- Quick Stats -->
        <div class="gem-card">
            <h2>Overview</h2>
            <div class="gem-stats-grid">
                <div class="gem-stat-item">
                    <span class="gem-stat-label">Active Students</span>
                    <span class="gem-stat-value"><?php echo esc_html(gem_get_active_students_count()); ?></span>
                </div>
                <div class="gem-stat-item">
                    <span class="gem-stat-label">Organizations</span>
                    <span class="gem-stat-value"><?php echo esc_html(gem_get_organizations_count()); ?></span>
                </div>
                <div class="gem-stat-item">
                    <span class="gem-stat-label">Pending Matches</span>
                    <span class="gem-stat-value"><?php echo esc_html(gem_get_pending_matches_count()); ?></span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="gem-card">
            <h2>Recent Activity</h2>
            <div class="gem-activity-list">
                <?php gem_display_recent_activity(); ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="gem-card">
            <h2>Quick Actions</h2>
            <div class="gem-action-buttons">
                <a href="<?php echo esc_url(admin_url('admin.php?page=gem-student-management')); ?>" class="gem-button gem-button--primary">
                    Manage Students
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=gem-matching-process')); ?>" class="gem-button gem-button--secondary">
                    Review Matches
                </a>
            </div>
        </div>
    </div>
</div>