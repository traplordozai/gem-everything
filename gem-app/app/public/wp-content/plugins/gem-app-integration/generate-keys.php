<?php
// Bootstrap WordPress
require_once dirname(dirname(dirname(__DIR__))) . '/wp-load.php';

// Verify admin privileges
if (!current_user_can('manage_options')) {
    die('Unauthorized access');
}

// Generate secure keys
$api_key = wp_generate_password(32, false);
$api_secret = wp_generate_password(64, true);
$verification_key = wp_generate_password(64, true);

// Store in WordPress options
update_option('gem_app_settings', array(
    'api_key' => $api_key,
    'api_secret' => $api_secret,
    'verification_key' => $verification_key,
    'api_url' => 'http://localhost:5000'
));

// Output the keys
echo "Generated API Credentials:\n\n";
echo "API Key: " . $api_key . "\n";
echo "API Secret: " . $api_secret . "\n";
echo "Verification Key: " . $verification_key . "\n";
echo "\nThese credentials have been stored in WordPress options.\n";
echo "Please update your .env file with these values.\n";