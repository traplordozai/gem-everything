<?php
/**
 * GEM App Admin Class
 */

defined('ABSPATH') || exit;

class GEM_App_Admin {
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    public function add_admin_menu() {
        // Main menu
        add_menu_page(
            'GEM App Admin',
            'GEM App',
            'manage_options',
            'gem-app-admin',
            array($this, 'render_dashboard_page'),
            'dashicons-groups',
            30
        );

        // Submenus
        add_submenu_page(
            'gem-app-admin',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'gem-app-admin',
            array($this, 'render_dashboard_page')
        );

        add_submenu_page(
            'gem-app-admin',
            'Student Management',
            'Students',
            'manage_options',
            'gem-app-students',
            array($this, 'render_students_page')
        );

        add_submenu_page(
            'gem-app-admin',
            'Organization Management',
            'Organizations',
            'manage_options',
            'gem-app-organizations',
            array($this, 'render_organizations_page')
        );

        add_submenu_page(
            'gem-app-admin',
            'Faculty Management',
            'Faculty',
            'manage_options',
            'gem-app-faculty',
            array($this, 'render_faculty_page')
        );

        add_submenu_page(
            'gem-app-admin',
            'Matching Process',
            'Matching',
            'manage_options',
            'gem-app-matching',
            array($this, 'render_matching_page')
        );

        add_submenu_page(
            'gem-app-admin',
            'Grading Interface',
            'Grading',
            'manage_options',
            'gem-app-grading',
            array($this, 'render_grading_page')
        );
    }

    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'gem-app') === false) {
            return;
        }

        wp_enqueue_style(
            'gem-app-admin',
            GEM_APP_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            GEM_APP_VERSION
        );

        wp_enqueue_script(
            'gem-app-admin',
            GEM_APP_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            GEM_APP_VERSION,
            true
        );

        wp_localize_script('gem-app-admin', 'gemAppAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('gem-app-admin-nonce')
        ));
    }

    public function render_dashboard_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/dashboard.php';
    }

    public function render_students_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/students.php';
    }

    public function render_faculty_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/faculty.php';
    }

    public function render_organizations_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/organizations.php';
    }

    public function render_matching_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/matching.php';
    }

    public function render_grading_page() {
        require_once GEM_APP_PLUGIN_DIR . 'includes/admin/views/grading.php';
    }
}
