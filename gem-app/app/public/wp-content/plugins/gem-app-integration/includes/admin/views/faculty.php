<?php
defined('ABSPATH') || exit;

// Get API instance
$api = gem_app_get_api();

try {
    // Fetch faculty data
    $faculty = $api->request('/faculty', 'GET');
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
    $faculty = array();
}
?>

<div class="wrap">
    <h1>Faculty Management</h1>

    <?php if ($error): ?>
    <div class="notice notice-error">
        <p><?php echo esc_html($error); ?></p>
    </div>
    <?php endif; ?>

    <div class="gem-app-faculty-list">
        <!-- Add faculty list table here -->
        <p>Faculty management interface coming soon.</p>
    </div>
</div>