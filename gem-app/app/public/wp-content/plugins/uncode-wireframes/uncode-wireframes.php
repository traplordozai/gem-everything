<?php
/**
 * Plugin Name:       Uncode Wireframes
 * Plugin URI:        https://undsgn.com/uncode/
 * Description:       Wireframes library for Uncode.
 * Version:           1.8.0
 * Author:            Uncode
 * Author URI:        https://undsgn.com/
 * Requires at least: 4.4
 * Tested up to:      5.9
 * Text Domain:       uncode-wireframes
 * Domain Path:       languages
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Wireframes' ) ) :

/**
 * Main Uncode_Wireframes Class
 */
final class Uncode_Wireframes {

	/**
	 * @var string
	 */
	public $version = '1.8.0';

	/**
	 * @var Uncode_Wireframes The single instance of the class
	 */
	private static $_instance = null;

	/**
	 * Main Uncode_Wireframes Instance
	 *
	 * Insures that only one instance of Uncode_Wireframes exists in memory at any one time.
	 *
	 * @static
	 * @see UNCDWF()
	 * @return Uncode_Wireframes - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'uncode-wireframes' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'uncode-wireframes' ), '1.0.0' );
	}

	/**
	 * Uncode_Wireframes Constructor.
	 */
	public function __construct() {
		$this->setup_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'UNCDWF_Install', 'install' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @return void
	 */
	private function setup_constants() {
		$upload_dir = wp_upload_dir();

		// Plugin version
		if ( ! defined( 'UNCDWF_VERSION' ) ) {
			define( 'UNCDWF_VERSION', $this->version );
		}

		// Plugin Folder Path
		if ( ! defined( 'UNCDWF_PLUGIN_DIR' ) ) {
			define( 'UNCDWF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'UNCDWF_PLUGIN_URL' ) ) {
			define( 'UNCDWF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Wireframes Folder Path
		if ( ! defined( 'UNCDWF_WIREFRAMES_DIR' ) ) {
			define( 'UNCDWF_WIREFRAMES_DIR', UNCDWF_PLUGIN_DIR . 'includes/wireframes/' );
		}

		// Placeholder thumbs folder URL
		if ( ! defined( 'UNCDWF_THUMBS_URL' ) ) {
			define( 'UNCDWF_THUMBS_URL', UNCDWF_PLUGIN_URL . 'assets/images/thumbnails/' );
		}

		// Plugin Root File
		if ( ! defined( 'UNCDWF_PLUGIN_FILE' ) ) {
			define( 'UNCDWF_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Basename
		if ( ! defined( 'UNCDWF_PLUGIN_BASENAME' ) ) {
			define( 'UNCDWF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {
		// Admin only
		if ( is_admin() ) {
			include_once UNCDWF_PLUGIN_DIR . 'includes/class-uncode-wf-install.php';
			include_once UNCDWF_PLUGIN_DIR . 'includes/import-functions.php';
			include_once UNCDWF_PLUGIN_DIR . 'includes/class-uncode-wf-init.php';
			include_once UNCDWF_PLUGIN_DIR . 'includes/class-uncode-wf-import.php';
		}

		// Frontend and backend
		include_once UNCDWF_PLUGIN_DIR . 'includes/core-functions.php';
		include_once UNCDWF_PLUGIN_DIR . 'includes/class-uncode-wf-dynamic.php';
		include_once UNCDWF_PLUGIN_DIR . 'includes/replace-functions.php';
		include_once UNCDWF_PLUGIN_DIR . 'includes/class-uncode-wf-front.php';
	}

	/**
	 * Hook into actions and filters
	 */
	public function init() {
		// Check if Uncode is active
		if ( ! function_exists( 'uncode_setup' ) ) {
			return;
		}

		// Set up localisation
		$this->load_textdomain();
	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$uncode_wireframes_lang_dir = dirname( plugin_basename( UNCDWF_PLUGIN_FILE ) ) . '/languages/';
		$uncode_wireframes_lang_dir = apply_filters( 'uncode_wireframes_languages_directory', $uncode_wireframes_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'uncode-wireframes' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'uncode-wireframes', $locale );

		// Setup paths to current locale file
		$mofile_local  = $uncode_wireframes_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/uncode-wireframes/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /content/languages/uncode-wireframes folder
			load_textdomain( 'uncode-wireframes', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /content/plugins/uncode-wireframes/languages/ folder
			load_textdomain( 'uncode-wireframes', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'uncode-wireframes', false, $uncode_wireframes_lang_dir );
		}
	}

}

endif;

/**
 * Returns the main instance of UNCDWF to prevent the need to use globals.
 *
 * @return Uncode_Wireframes
 */
function UNCDWF() {
	return Uncode_Wireframes::instance();
}

// Get UNCDWF Running
UNCDWF();
