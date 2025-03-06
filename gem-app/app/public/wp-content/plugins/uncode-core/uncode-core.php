<?php
/*
Plugin Name: Uncode Core
Plugin URI: http://www.undsgn.com
Description: Uncode Core Plugin for Undsgn Themes.
Version: 2.9.1.3
Author: Undsgn
Author URI: http://www.undsgn.com
Text Domain: uncode-core
Domain Path: languages
*/

define( 'UNCODE_CORE_FILE', __FILE__ );
define( 'UNCODE_CORE_PLUGIN_DIR', dirname(__FILE__) );
define( 'UNCODE_CORE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'UNCODE_CORE_ADVANCED', true );
if ( ! defined( 'UNCODE_FILTER_PREFIX' ) ) {
	define( 'UNCODE_FILTER_PREFIX', 'unfilter' );
}

// Blocking direct access
if( ! function_exists( 'uncode_block_direct_access' ) ) {
	function uncode_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Direct access denied.' );
		}
	}
}

if( ! class_exists( 'UncodeCore_Plugin' ) ) {
	class UncodeCore_Plugin {

		const VERSION = '2.9.1.3';
		protected static $instance = null;

		private function __construct() {
			$this->load_textdomain();
		}

		public function load_textdomain() {
			// Set filter for plugin's languages directory
			$lang_dir = plugin_dir_path( __FILE__ ) . 'languages/';

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'uncode-core' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'uncode-core', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/uncode-core/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/uncode-core folder
				load_textdomain( 'uncode-core', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/uncode-core/languages/ folder
				load_textdomain( 'uncode-core', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'uncode-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
			}
		}

		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

// Init the plugin
add_action( 'plugins_loaded', array( 'UncodeCore_Plugin', 'get_instance' ) );

/**
 * Include main file.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/main.php';
