<?php
/**
 * GEM App API Client
 */

defined('ABSPATH') || exit;

class GEM_App_API_Client {
    private $api_url;
    private $api_key;
    
    public function __construct() {
        $this->api_url = get_option('gem_app_api_url');
        $this->api_key = get_option('gem_app_api_key');
    }

    /**
     * Make an API request
     *
     * @param string $method HTTP method
     * @param string $endpoint API endpoint
     * @param array $data Request data
     * @return array Response data or error
     */
    public function request($method, $endpoint, $data = array()) {
        $url = trailingslashit($this->api_url) . ltrim($endpoint, '/');
        
        $args = array(
            'method'    => $method,
            'timeout'   => 30,
            'headers'   => array(
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ),
        );

        if (!empty($data) && in_array($method, array('POST', 'PUT', 'PATCH'))) {
            $args['body'] = wp_json_encode($data);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'error'   => $response->get_error_message()
            );
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return array(
                'success' => false,
                'error'   => 'Invalid JSON response from API'
            );
        }

        $status_code = wp_remote_retrieve_response_code($response);
        if ($status_code >= 400) {
            return array(
                'success' => false,
                'error'   => $data['message'] ?? 'API request failed',
                'code'    => $status_code
            );
        }

        return array(
            'success' => true,
            'data'    => $data
        );
    }
}