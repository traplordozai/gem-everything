<?php
defined('ABSPATH') || exit;

// Get API instance
$api = gem_app_get_api();

try {
    // Fetch grading data
    $grading = $api->request('/grading', 'GET');
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
    $grading = array();
}
?>

<div class="wrap">
    <h1>Grading Interface</h1>

    <?php if ($error): ?>
    <div class="notice notice-error">
        <p><?php echo esc_html($error); ?></p>
    </div>
    <?php endif; ?>

    <div class="gem-app-grading">
        <!-- Add grading interface here -->
        <p>Grading interface coming soon.</p>
    </div>
</div>