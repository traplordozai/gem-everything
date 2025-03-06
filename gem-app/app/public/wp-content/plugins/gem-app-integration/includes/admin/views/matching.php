<?php
defined('ABSPATH') || exit;

// Get API instance
$api = gem_app_get_api();

try {
    // Fetch matching data
    $matching = $api->request('/matching', 'GET');
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
    $matching = array();
}
?>

<div class="wrap">
    <h1>Matching Process</h1>

    <?php if ($error): ?>
    <div class="notice notice-error">
        <p><?php echo esc_html($error); ?></p>
    </div>
    <?php endif; ?>

    <div class="gem-app-matching">
        <!-- Add matching interface here -->
        <p>Matching process interface coming soon.</p>
    </div>
</div>