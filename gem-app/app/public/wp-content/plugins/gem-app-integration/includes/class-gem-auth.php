<?php
if (!defined('ABSPATH')) exit;

class GEM_Auth {
    private static $instance = null;
    private $roles = array(
        'gem_student' => array(
            'display_name' => 'GEM Student',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'upload_documents' => true,
                'view_projects' => true,
            )
        ),
        'gem_organization' => array(
            'display_name' => 'GEM Organization',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'manage_projects' => true,
                'review_students' => true,
            )
        ),
        'gem_faculty' => array(
            'display_name' => 'GEM Faculty',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'review_applications' => true,
                'manage_projects' => true,
                'grade_students' => true,
            )
        ),
        'gem_admin' => array(
            'display_name' => 'GEM Administrator',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'manage_gem' => true,
                'manage_students' => true,
                'manage_organizations' => true,
                'manage_faculty' => true,
                'manage_matches' => true,
                'view_reports' => true,
            )
        )
    );

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', array($this, 'register_roles'));
        add_filter('authenticate', array($this, 'authenticate_user'), 30, 3);
        add_action('wp_login', array($this, 'redirect_after_login'), 10, 2);
    }

    public function register_roles() {
        foreach ($this->roles as $role_key => $role_data) {
            add_role($role_key, $role_data['display_name'], $role_data['capabilities']);
        }
    }

    public function authenticate_user($user, $username, $password) {
        if ($user instanceof WP_User) {
            // Check if user has any GEM roles
            $gem_roles = array_keys($this->roles);
            $has_gem_role = false;
            
            foreach ($gem_roles as $role) {
                if (in_array($role, (array) $user->roles)) {
                    $has_gem_role = true;
                    break;
                }
            }

            if ($has_gem_role) {
                // Check user status in respective table
                global $wpdb;
                foreach (array('students', 'faculty', 'organizations') as $table) {
                    $table_name = $wpdb->prefix . 'gem_' . $table;
                    $status = $wpdb->get_var($wpdb->prepare(
                        "SELECT status FROM $table_name WHERE user_id = %d",
                        $user->ID
                    ));

                    if ($status && $status !== 'active') {
                        return new WP_Error(
                            'account_inactive',
                            __('Your account is currently inactive. Please contact the administrator.', 'gem')
                        );
                    }
                }
            }
        }

        return $user;
    }

    public function redirect_after_login($user_login, $user) {
        $redirect_url = home_url();

        if (in_array('gem_student', (array) $user->roles)) {
            $redirect_url = home_url('/student-portal/');
        } elseif (in_array('gem_organization', (array) $user->roles)) {
            $redirect_url = home_url('/organization-portal/');
        } elseif (in_array('gem_faculty', (array) $user->roles)) {
            $redirect_url = home_url('/faculty-portal/');
        } elseif (in_array('gem_admin', (array) $user->roles)) {
            $redirect_url = admin_url('admin.php?page=gem-admin');
        }

        wp_safe_redirect($redirect_url);
        exit;
    }

    public function check_capability($capability) {
        return current_user_can($capability);
    }

    public function get_user_role() {
        $user = wp_get_current_user();
        foreach (array_keys($this->roles) as $role) {
            if (in_array($role, (array) $user->roles)) {
                return $role;
            }
        }
        return false;
    }
}