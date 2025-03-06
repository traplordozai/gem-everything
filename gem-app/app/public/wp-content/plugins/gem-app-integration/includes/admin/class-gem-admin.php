<?php
if (!defined('ABSPATH')) exit;

class GEM_Admin {
    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'gem-') !== false) {
            wp_enqueue_style('gem-admin-styles', GEM_PLUGIN_URL . 'assets/css/core-ui.css');
            wp_enqueue_script('gem-admin-scripts', GEM_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), '1.0', true);
        }
    }

    // Keep any other methods that don't involve menu registration
}
