<?php
defined('ABSPATH') || exit;

// Get API instance
$api = gem_app_get_api();

try {
    // Fetch students data
    $students = $api->request('/students', 'GET');
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
    $students = array();
}
?>

<div class="wrap">
    <h1>Student Management</h1>

    <?php if ($error): ?>
    <div class="notice notice-error">
        <p><?php echo esc_html($error); ?></p>
    </div>
    <?php endif; ?>

    <div class="gem-app-students-list">
        <!-- Add student list table here -->
        <p>Student management interface coming soon.</p>
    </div>
</div>