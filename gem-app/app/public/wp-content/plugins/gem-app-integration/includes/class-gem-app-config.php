<?php
defined('ABSPATH') || exit;

class GEM_App_Config {
    private static $instance = null;
    private $settings;
    
    const OPTION_NAME = 'gem_app_settings';
    
    private function __construct() {
        $this->settings = get_option(self::OPTION_NAME, array());
        $this->maybe_set_defaults();
    }
    
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function maybe_set_defaults() {
        $defaults = array(
            'api_url' => 'http://localhost:5000',
            'api_key' => 'bN4pX8$mK2vR5#hL9@jW3cF7&tY6qA1s',
            'api_secret' => 'kj8H#mP9$vL2nQ5xR7@cY4wZ9&fB3tE6',
            'verification_key' => 'eT9#kM4$wP7nL2@vB5xH8cR3&jY6fQ1s'
        );
        
        $updated = false;
        foreach ($defaults as $key => $value) {
            if (!isset($this->settings[$key])) {
                $this->settings[$key] = $value;
                $updated = true;
            }
        }
        
        if ($updated) {
            update_option(self::OPTION_NAME, $this->settings);
        }
    }
    
    public function get($key = null) {
        if ($key === null) {
            return $this->settings;
        }
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }
}