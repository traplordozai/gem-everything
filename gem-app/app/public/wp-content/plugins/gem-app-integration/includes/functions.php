<?php
defined('ABSPATH') || exit;

if (!function_exists('gem_app_get_api')) {
    function gem_app_get_api() {
        return GEM_App_API::get_instance();
    }
}

if (!function_exists('gem_app_get_config')) {
    function gem_app_get_config() {
        return GEM_App_Config::get_instance();
    }
}

// Remove duplicate settings updates from here - they should be in an initialization function

/**
 * Get plugin settings
 *
 * @return array
 */
function gem_app_get_settings() {
    return get_option('gem_app_settings', array(
        'api_url' => 'http://localhost:5000',
        'api_key' => '',
        'api_secret' => '',
    ));
}

/**
 * Update plugin settings
 *
 * @param array $settings
 * @return bool
 */
function gem_app_update_settings($settings) {
    return update_option('gem_app_settings', $settings);
}

/**
 * Check if user has faculty role
 *
 * @param int|WP_User|null $user
 * @return bool
 */
function gem_app_is_faculty($user = null) {
    if (!$user) {
        $user = wp_get_current_user();
    }
    
    if (!$user instanceof WP_User) {
        $user = get_user_by('id', $user);
    }
    
    if (!$user) {
        return false;
    }
    
    return in_array('faculty', (array) $user->roles);
}

/**
 * Format date for display
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function gem_app_format_date($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
}

// Remove duplicate function declarations - these are now only in class-gem-app-api.php

// Store the generated keys in WordPress options
update_option('gem_app_settings', array(
    'api_key' => 'bN4pX8$mK2vR5#hL9@jW3cF7&tY6qA1s',
    'api_secret' => 'kj8H#mP9$vL2nQ5xR7@cY4wZ9&fB3tE6',
    'verification_key' => 'eT9#kM4$wP7nL2@vB5xH8cR3&jY6fQ1s',
    'api_url' => 'http://localhost:5000'
));

