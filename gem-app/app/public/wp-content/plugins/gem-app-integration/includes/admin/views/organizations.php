<?php
defined('ABSPATH') || exit;

// Get API instance
$api = gem_app_get_api();

try {
    // Fetch organizations data
    $organizations = $api->request('/organizations', 'GET');
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
    $organizations = array();
}
?>

<div class="wrap">
    <h1>Organization Management</h1>

    <?php if ($error): ?>
    <div class="notice notice-error">
        <p><?php echo esc_html($error); ?></p>
    </div>
    <?php endif; ?>

    <div class="gem-app-organizations-list">
        <!-- Add organizations list table here -->
        <p>Organization management interface coming soon.</p>
    </div>
</div>