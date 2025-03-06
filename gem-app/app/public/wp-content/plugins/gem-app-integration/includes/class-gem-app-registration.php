<?php
/**
 * GEM App Registration Handler
 */

defined('ABSPATH') || exit;

class GEM_App_Registration {
    private $api_client;
    
    public function __construct() {
        $this->api_client = new GEM_App_API_Client();
        
        add_action('init', array($this, 'register_endpoints'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_gem_app_register', array($this, 'handle_registration'));
        add_action('wp_ajax_nopriv_gem_app_register', array($this, 'handle_registration'));
    }

    public function register_endpoints() {
        add_rewrite_rule(
            'gem-register/([^/]+)/?$',
            'index.php?gem_registration_type=$matches[1]',
            'top'
        );
        
        add_rewrite_tag('%gem_registration_type%', '([^&]+)');
    }

    public function enqueue_scripts() {
        if (!$this->is_registration_page()) {
            return;
        }

        wp_enqueue_style(
            'gem-app-registration',
            GEM_APP_PLUGIN_URL . 'assets/css/registration.css',
            array(),
            GEM_APP_VERSION
        );

        wp_enqueue_script(
            'gem-app-registration',
            GEM_APP_PLUGIN_URL . 'assets/js/registration.js',
            array('jquery'),
            GEM_APP_VERSION,
            true
        );

        wp_localize_script('gem-app-registration', 'gemAppReg', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('gem-app-registration-nonce')
        ));
    }

    public function handle_registration() {
        check_ajax_referer('gem-app-registration-nonce', 'nonce');

        $type = sanitize_text_field($_POST['type']);
        $data = $this->sanitize_registration_data($_POST);

        // Validate required fields
        $validation = $this->validate_registration_data($type, $data);
        if (!$validation['success']) {
            wp_send_json_error($validation['error']);
        }

        // Send registration to API
        $response = $this->api_client->request('POST', "/register/{$type}", $data);

        if (!$response['success']) {
            wp_send_json_error($response['error']);
        }

        // Create WordPress user if registration successful
        $user_data = $this->create_wordpress_user($data, $type);
        
        if (is_wp_error($user_data)) {
            wp_send_json_error($user_data->get_error_message());
        }

        wp_send_json_success(array(
            'message' => 'Registration successful',
            'redirect' => $this->get_redirect_url($type)
        ));
    }

    private function sanitize_registration_data($post_data) {
        return array(
            'first_name' => sanitize_text_field($post_data['first_name'] ?? ''),
            'last_name'  => sanitize_text_field($post_data['last_name'] ?? ''),
            'email'      => sanitize_email($post_data['email'] ?? ''),
            'password'   => $post_data['password'] ?? '',
            'type'       => sanitize_text_field($post_data['type'] ?? ''),
            'meta'       => $this->sanitize_meta_data($post_data['meta'] ?? array())
        );
    }

    private function validate_registration_data($type, $data) {
        $required_fields = array(
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'email'      => 'Email',
            'password'   => 'Password'
        );

        foreach ($required_fields as $field => $label) {
            if (empty($data[$field])) {
                return array(
                    'success' => false,
                    'error'   => "{$label} is required"
                );
            }
        }

        if (!is_email($data['email'])) {
            return array(
                'success' => false,
                'error'   => 'Invalid email address'
            );
        }

        if (strlen($data['password']) < 8) {
            return array(
                'success' => false,
                'error'   => 'Password must be at least 8 characters long'
            );
        }

        return array('success' => true);
    }

    private function create_wordpress_user($data, $type) {
        $user_data = array(
            'user_login'    => $data['email'],
            'user_email'    => $data['email'],
            'user_pass'     => $data['password'],
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'display_name'  => $data['first_name'] . ' ' . $data['last_name'],
            'role'          => $this->get_role_for_type($type)
        );

        $user_id = wp_insert_user($user_data);

        if (is_wp_error($user_id)) {
            return $user_id;
        }

        // Add user meta
        update_user_meta($user_id, 'gem_app_user_type', $type);
        update_user_meta($user_id, 'gem_app_user_id', $data['user_id']);

        return $user_id;
    }

    private function get_role_for_type($type) {
        $roles = array(
            'student'      => 'gem_student',
            'faculty'      => 'gem_faculty',
            'organization' => 'gem_organization'
        );

        return $roles[$type] ?? 'subscriber';
    }

    private function get_redirect_url($type) {
        $redirects = array(
            'student'      => home_url('/student-profile/'),
            'faculty'      => home_url('/faculty-profile/'),
            'organization' => home_url('/organization-profile/')
        );

        return $redirects[$type] ?? home_url();
    }

    private function sanitize_meta_data($meta) {
        $sanitized = array();
        
        foreach ($meta as $key => $value) {
            $sanitized[sanitize_key($key)] = is_array($value) 
                ? array_map('sanitize_text_field', $value)
                : sanitize_text_field($value);
        }
        
        return $sanitized;
    }

    private function is_registration_page() {
        return get_query_var('gem_registration_type') !== '';
    }
}