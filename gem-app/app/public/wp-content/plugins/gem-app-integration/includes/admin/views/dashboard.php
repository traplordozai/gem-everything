<?php
defined('ABSPATH') || exit;

try {
    $api = gem_app_get_api();
    $dashboard_data = $api->get_dashboard_data();
} catch (Exception $e) {
    $error_message = $e->getMessage();
}
?>

<div class="wrap">
    <h1>GEM App Dashboard</h1>

    <?php if (isset($error_message)): ?>
        <div class="notice notice-error">
            <p><?php echo esc_html($error_message); ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($dashboard_data)): ?>
        <!-- Display dashboard data here -->
        <div class="gem-app-dashboard">
            <!-- Add your dashboard HTML here -->
        </div>
    <?php endif; ?>

    <?php if (!get_option('gem_app_settings')): ?>
        <div class="notice notice-warning">
            <p>Please configure your API credentials in the settings.</p>
            <p><a href="<?php echo esc_url(admin_url('admin.php?page=gem-app-settings')); ?>" class="button button-primary">Configure Settings</a></p>
        </div>
    <?php endif; ?>
</div>
