<?php
function gem_app_debug_config() {
    $config = GEM_App_Config::get_instance();
    error_log('GEM App API URL: ' . $config->get('api_url'));
    error_log('GEM App API Key exists: ' . ($config->get('api_key') ? 'yes' : 'no'));
    error_log('GEM App API Secret exists: ' . ($config->get('api_secret') ? 'yes' : 'no'));
}
add_action('admin_init', 'gem_app_debug_config');