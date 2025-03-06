class GEM_Faculty_Profile {
    public function __construct() {
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_post_update_faculty_profile', array($this, 'handle_profile_update'));
    }
    
    public function register_settings() {
        register_setting('faculty_profile', 'faculty_department');
        register_setting('faculty_profile', 'research_interests');
        register_setting('faculty_profile', 'office_hours');
        register_setting('faculty_profile', 'project_preferences');
    }
    
    public function handle_profile_update() {
        // Validation and update logic
        check_admin_referer('faculty_profile_update');
        
        $faculty_id = get_current_user_id();
        $updates = array(
            'department' => sanitize_text_field($_POST['faculty_department']),
            'research_interests' => sanitize_textarea_field($_POST['research_interests']),
            'office_hours' => sanitize_textarea_field($_POST['office_hours']),
            'project_preferences' => sanitize_textarea_field($_POST['project_preferences'])
        );
        
        // Update profile
        $api = gem_app_api();
        $response = $api->request('/faculty/profile/' . $faculty_id, 'POST', $updates);
        
        wp_redirect(admin_url('admin.php?page=faculty-profile&updated=true'));
        exit;
    }
}