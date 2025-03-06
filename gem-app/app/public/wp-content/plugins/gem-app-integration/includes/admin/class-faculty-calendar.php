<?php
defined('ABSPATH') || exit;

class GEM_Faculty_Calendar {
    private $api;

    public function __construct() {
        $this->api = gem_app_get_api();
        add_action('admin_menu', array($this, 'add_calendar_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_calendar_scripts'));
    }

    public function add_calendar_menu() {
        add_submenu_page(
            'gem-faculty-portal',
            'Faculty Calendar',
            'Calendar',
            'edit_posts',
            'gem-faculty-calendar',
            array($this, 'render_calendar_page')
        );
    }

    public function enqueue_calendar_scripts($hook) {
        if ('gem-faculty-portal_page_gem-faculty-calendar' !== $hook) {
            return;
        }

        wp_enqueue_style('gem-calendar-style', GEM_APP_PLUGIN_URL . 'assets/css/calendar.css', array(), GEM_APP_VERSION);
        wp_enqueue_script('gem-calendar-script', GEM_APP_PLUGIN_URL . 'assets/js/calendar.js', array('jquery'), GEM_APP_VERSION, true);
    }

    public function render_calendar_page() {
        // Check if user has permission
        if (!current_user_can('edit_posts')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // Get calendar data from API
        $response = $this->api->request('/faculty/calendar');
        $calendar_data = isset($response['data']) ? $response['data'] : array();

        // Include the calendar template
        include GEM_APP_PLUGIN_DIR . 'includes/admin/views/calendar.php';
    }

    public function get_calendar_events($start_date = null, $end_date = null) {
        if (!$start_date) {
            $start_date = date('Y-m-d');
        }
        if (!$end_date) {
            $end_date = date('Y-m-d', strtotime('+30 days'));
        }

        $response = $this->api->request('/faculty/calendar/events', 'GET', array(
            'start_date' => $start_date,
            'end_date' => $end_date
        ));

        return isset($response['data']) ? $response['data'] : array();
    }

    public function add_event($event_data) {
        return $this->api->request('/faculty/calendar/events', 'POST', $event_data);
    }

    public function update_event($event_id, $event_data) {
        return $this->api->request("/faculty/calendar/events/{$event_id}", 'PUT', $event_data);
    }

    public function delete_event($event_id) {
        return $this->api->request("/faculty/calendar/events/{$event_id}", 'DELETE');
    }
}