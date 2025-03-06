<?php
/**
 * Plugin Name: GEM App Integration
 * Description: Integration with GEM Application
 * Version: 1.0.0
 */

defined('ABSPATH') || exit;

define('GEM_APP_VERSION', '1.0.0');
define('GEM_APP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GEM_APP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load core files
require_once GEM_APP_PLUGIN_DIR . 'includes/class-gem-app-config.php';
require_once GEM_APP_PLUGIN_DIR . 'includes/class-gem-app-api.php';
require_once GEM_APP_PLUGIN_DIR . 'includes/functions.php';

// Initialize plugin
add_action('plugins_loaded', 'gem_app_init');

function gem_app_init() {
    // Initialize admin
    if (is_admin()) {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/class-gem-app-admin.php';
        GEM_App_Admin::get_instance();
    }
}

// Add activation hook
register_activation_hook(__FILE__, 'gem_app_activate');

function gem_app_activate() {
    // Activation tasks
}
