<?php
defined('ABSPATH') || exit;

class GEM_App_API {
    private static $instance = null;
    private $config;
    private $access_token;
    private $refresh_token;
    
    private function __construct() {
        $this->config = GEM_App_Config::get_instance();
        $this->refresh_token_if_needed();
    }
    
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function refresh_token_if_needed() {
        $this->access_token = get_option('gem_app_access_token');
        $this->refresh_token = get_option('gem_app_refresh_token');
        
        if (!$this->access_token) {
            try {
                $this->authenticate();
            } catch (Exception $e) {
                error_log('GEM App - Authentication failed: ' . $e->getMessage());
                return false;
            }
        }
        return true;
    }
    
    public function request($endpoint, $method = 'GET', $data = null, $retry = true) {
        if (!$this->access_token) {
            return array(
                'success' => false,
                'message' => 'Not authenticated'
            );
        }

        $url = trailingslashit($this->config->get('api_url')) . ltrim($endpoint, '/');
        
        $args = array(
            'method' => $method,
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->access_token,
                'Content-Type' => 'application/json',
                'User-Agent' => 'GEM App WordPress Plugin/' . GEM_APP_VERSION,
            ),
            'timeout' => 30,
            'sslverify' => false
        );

        if ($data !== null) {
            $args['body'] = wp_json_encode($data);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'message' => $response->get_error_message()
            );
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($status_code === 401 && $retry) {
            if ($this->refresh_token_if_needed()) {
                return $this->request($endpoint, $method, $data, false);
            }
        }

        return array(
            'success' => $status_code >= 200 && $status_code < 300,
            'code' => $status_code,
            'data' => $body
        );
    }
    
    private function authenticate() {
        $url = trailingslashit($this->config->get('api_url')) . 'wordpress';
        
        $data = array(
            'api_key' => $this->config->get('api_key'),
            'api_secret' => $this->config->get('api_secret'),
            'site_url' => get_site_url(),
            'wp_version' => get_bloginfo('version'),
            'plugin_version' => GEM_APP_VERSION
        );

        $response = wp_remote_post($url, array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'User-Agent' => 'GEM App WordPress Plugin/' . GEM_APP_VERSION,
            ),
            'body' => wp_json_encode($data),
            'timeout' => 30,
            'sslverify' => false
        ));

        if (is_wp_error($response)) {
            throw new Exception('API request failed: ' . $response->get_error_message());
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($status_code !== 200) {
            $error_message = 'Authentication failed with status code: ' . $status_code;
            if (is_array($body) && isset($body['message'])) {
                $error_message .= ' - ' . $body['message'];
            }
            throw new Exception($error_message);
        }

        if (!is_array($body) || !isset($body['token'])) {
            throw new Exception('Invalid response format from authentication server');
        }

        $this->access_token = $body['token'];
        update_option('gem_app_access_token', $this->access_token);
    }
}
// Remove the gem_app_get_api() function from here
