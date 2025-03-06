<?php
if (!defined('ABSPATH')) exit;

class GEM_Organization_Portal {
    private static $instance = null;
    private $template_path;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->template_path = plugin_dir_path(dirname(__FILE__)) . 'templates/organization/';
        
        add_action('init', array($this, 'register_endpoints'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_gem_save_project', array($this, 'handle_save_project'));
        add_action('wp_ajax_gem_review_application', array($this, 'handle_review_application'));
    }

    public function register_endpoints() {
        add_rewrite_rule(
            'organization-portal/?$',
            'index.php?gem_page=organization_dashboard',
            'top'
        );
        add_rewrite_rule(
            'organization-portal/projects/?$',
            'index.php?gem_page=organization_projects',
            'top'
        );
        add_rewrite_rule(
            'organization-portal/applications/?$',
            'index.php?gem_page=organization_applications',
            'top'
        );
    }

    public function enqueue_scripts() {
        if ($this->is_organization_portal()) {
            wp_enqueue_style(
                'gem-organization-portal',
                plugins_url('assets/css/organization-portal.css', dirname(__FILE__)),
                array(),
                GEM_VERSION
            );
            wp_enqueue_script(
                'gem-organization-portal',
                plugins_url('assets/js/organization-portal.js', dirname(__FILE__)),
                array('jquery'),
                GEM_VERSION,
                true
            );
            wp_localize_script('gem-organization-portal', 'gemOrg', array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('gem-organization')
            ));
        }
    }

    public function render_page() {
        if (!current_user_can('manage_projects')) {
            wp_die(__('You do not have permission to access this page.', 'gem'));
        }

        $page = get_query_var('gem_page', 'organization_dashboard');
        $template = '';

        switch ($page) {
            case 'organization_dashboard':
                $template = 'dashboard.php';
                $data = $this->get_dashboard_data();
                break;
            case 'organization_projects':
                $template = 'projects.php';
                $data = $this->get_projects_data();
                break;
            case 'organization_applications':
                $template = 'applications.php';
                $data = $this->get_applications_data();
                break;
            default:
                wp_die(__('Page not found.', 'gem'));
        }

        if (file_exists($this->template_path . $template)) {
            include $this->template_path . $template;
        }
    }

    private function get_dashboard_data() {
        global $wpdb;
        $user_id = get_current_user_id();
        $org_id = $this->get_organization_id($user_id);

        return array(
            'active_projects' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}gem_projects 
                WHERE organization_id = %d AND status = 'active'",
                $org_id
            )),
            'pending_applications' => $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}gem_matches m 
                JOIN {$wpdb->prefix}gem_projects p ON m.project_id = p.id 
                WHERE p.organization_id = %d AND m.status = 'pending'",
                $org_id
            )),
            'recent_projects' => $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}gem_projects 
                WHERE organization_id = %d 
                ORDER BY created_at DESC LIMIT 5",
                $org_id
            ))
        );
    }

    private function get_projects_data() {
        global $wpdb;
        $org_id = $this->get_organization_id(get_current_user_id());
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}gem_projects 
            WHERE organization_id = %d 
            ORDER BY created_at DESC",
            $org_id
        ));
    }

    private function get_applications_data() {
        global $wpdb;
        $org_id = $this->get_organization_id(get_current_user_id());
        
        return $wpdb->get_results($wpdb->prepare(
            "SELECT m.*, p.title as project_title, s.student_id, 
            u.display_name as student_name 
            FROM {$wpdb->prefix}gem_matches m 
            JOIN {$wpdb->prefix}gem_projects p ON m.project_id = p.id 
            JOIN {$wpdb->prefix}gem_students s ON m.student_id = s.id 
            JOIN {$wpdb->users} u ON s.user_id = u.ID 
            WHERE p.organization_id = %d 
            ORDER BY m.created_at DESC",
            $org_id
        ));
    }

    public function handle_save_project() {
        check_ajax_referer('gem-organization', 'nonce');

        if (!current_user_can('manage_projects')) {
            wp_send_json_error('Permission denied');
        }

        $project_data = array(
            'organization_id' => $this->get_organization_id(get_current_user_id()),
            'title' => sanitize_text_field($_POST['title']),
            'description' => wp_kses_post($_POST['description']),
            'requirements' => wp_kses_post($_POST['requirements']),
            'start_date' => sanitize_text_field($_POST['start_date']),
            'end_date' => sanitize_text_field($_POST['end_date']),
            'status' => sanitize_text_field($_POST['status'])
        );

        global $wpdb;
        $result = $wpdb->insert(
            $wpdb->prefix . 'gem_projects',
            $project_data,
            array('%d', '%s', '%s', '%s', '%s', '%s', '%s')
        );

        if ($result) {
            wp_send_json_success('Project saved successfully');
        } else {
            wp_send_json_error('Failed to save project');
        }
    }

    public function handle_review_application() {
        check_ajax_referer('gem-organization', 'nonce');

        if (!current_user_can('review_students')) {
            wp_send_json_error('Permission denied');
        }

        $match_id = intval($_POST['match_id']);
        $status = sanitize_text_field($_POST['status']);
        $notes = wp_kses_post($_POST['notes']);

        global $wpdb;
        $result = $wpdb->update(
            $wpdb->prefix . 'gem_matches',
            array(
                'status' => $status,
                'notes' => $notes,
                'updated_at' => current_time('mysql')
            ),
            array('id' => $match_id),
            array('%s', '%s', '%s'),
            array('%d')
        );

        if ($result) {
            // Send notification to student
            $this->notify_student($match_id, $status);
            wp_send_json_success('Application review saved');
        } else {
            wp_send_json_error('Failed to save review');
        }
    }

    private function get_organization_id($user_id) {
        global $wpdb;
        return $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}gem_organizations 
            WHERE user_id = %d",
            $user_id
        ));
    }

    private function notify_student($match_id, $status) {
        global $wpdb;
        $student_email = $wpdb->get_var($wpdb->prepare(
            "SELECT u.user_email 
            FROM {$wpdb->prefix}gem_matches m 
            JOIN {$wpdb->prefix}gem_students s ON m.student_id = s.id 
            JOIN {$wpdb->users} u ON s.user_id = u.ID 
            WHERE m.id = %d",
            $match_id
        ));

        if ($student_email) {
            $subject = sprintf(
                __('Your application status has been updated to %s', 'gem'),
                $status
            );
            wp_mail($student_email, $subject, $this->get_notification_message($match_id, $status));
        }
    }

    private function get_notification_message($match_id, $status) {
        // Template logic for email notification
        return sprintf(
            __('Your application has been %s. Please log in to your student portal for more details.', 'gem'),
            $status
        );
    }

    private function is_organization_portal() {
        return strpos($_SERVER['REQUEST_URI'], 'organization-portal') !== false;
    }
}