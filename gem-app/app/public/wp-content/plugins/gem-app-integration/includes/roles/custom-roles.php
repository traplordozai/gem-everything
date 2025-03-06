<?php
/**
 * GEM App Custom Roles Management
 */

defined('ABSPATH') || exit;

class GEM_App_Roles {
    private static $instance = null;
    
    // Role definitions
    private $roles = array(
        'student' => array(
            'display_name' => 'Student',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'upload_documents' => true,
                'view_matches' => true,
                'gem_student_access' => true
            )
        ),
        'faculty' => array(
            'display_name' => 'Faculty',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'review_students' => true,
                'manage_documents' => true,
                'gem_faculty_access' => true
            )
        ),
        'organization' => array(
            'display_name' => 'Organization',
            'capabilities' => array(
                'read' => true,
                'edit_profile' => true,
                'post_opportunities' => true,
                'view_matches' => true,
                'gem_organization_access' => true
            )
        )
    );

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init() {
        add_action('admin_init', array($this, 'add_custom_capabilities'));
        add_action('init', array($this, 'register_custom_roles'));
    }

    public function register_custom_roles() {
        foreach ($this->roles as $role_key => $role_data) {
            if (!get_role($role_key)) {
                add_role(
                    $role_key,
                    $role_data['display_name'],
                    $role_data['capabilities']
                );
            }
        }
    }

    public function add_custom_capabilities() {
        $admin_role = get_role('administrator');
        
        // Ensure admin has all custom capabilities
        foreach ($this->roles as $role_data) {
            foreach ($role_data['capabilities'] as $cap => $grant) {
                if ($grant && !$admin_role->has_cap($cap)) {
                    $admin_role->add_cap($cap);
                }
            }
        }
    }

    public function get_role_capabilities($role) {
        return isset($this->roles[$role]) ? $this->roles[$role]['capabilities'] : array();
    }

    public function get_available_roles() {
        return array_map(function($role_data) {
            return $role_data['display_name'];
        }, $this->roles);
    }
}

// Initialize roles
function gem_app_init_roles() {
    $roles = GEM_App_Roles::get_instance();
    $roles->init();
}
add_action('init', 'gem_app_init_roles', 0);

// Helper functions
function gem_app_user_has_role($user_id, $role) {
    $user = get_userdata($user_id);
    return $user && in_array($role, (array) $user->roles);
}

function gem_app_get_user_role_display_name($user_id) {
    $user = get_userdata($user_id);
    if (!$user) return '';
    
    $roles = GEM_App_Roles::get_instance()->roles;
    foreach ($user->roles as $role) {
        if (isset($roles[$role])) {
            return $roles[$role]['display_name'];
        }
    }
    return '';
}
