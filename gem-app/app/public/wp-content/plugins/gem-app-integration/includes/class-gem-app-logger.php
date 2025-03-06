<?php
defined('ABSPATH') || exit;

class GEM_App_Logger {
    public static function log($message, $data = array()) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log(sprintf(
                '[GEM App] %s | Data: %s',
                $message,
                wp_json_encode($data)
            ));
        }
    }
}