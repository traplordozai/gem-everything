<?php
/**
 * Admin related functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Admin' ) ) :

/**
 * Uncode_Toolkit_Privacy_Admin Class
 */
class Uncode_Toolkit_Privacy_Admin {

	/**
	 * The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 */
	private $version;

	/**
	 * Allowed HTML for wp_kses.
	 */
	private $allowed_html;

	/**
	 * Get things going
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->allowed_html = array(
			'a' => array(
				'href'   => true,
				'title'  => true,
				'target' => true,
			),
		);
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && ( strpos( $screen->id, 'uncode-privacy-settings' ) !== false || strpos( $screen->id, 'uncode-privacy-logs' ) !== false ) ) {
			// add_thickbox();
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/uncode-privacy-admin.css', array(), $this->version, 'all' );

			if ( get_option( 'uncode_privacy_record_logs', '' ) === 'yes' ) {
				$jquery_ui_url = is_ssl() ? 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' : 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css';
				wp_enqueue_style('jquery-ui-css', $jquery_ui_url);
			}
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && ( strpos( $screen->id, 'uncode-privacy-settings' ) !== false || strpos( $screen->id, 'uncode-privacy-logs' ) !== false ) ) {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$deps = array( 'jquery', 'wp-util', 'jquery-ui-sortable' );

			$params = array(
				'has_datepicker' => false,
				'pagenow'        => $screen->id,
			);

			if ( get_option( 'uncode_privacy_record_logs', '' ) === 'yes' ) {
				$deps[] = 'jquery-ui-datepicker';
				$params['has_datepicker'] = true;
			}

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/uncode-privacy-admin' . $suffix . '.js', $deps, $this->version, true );

			wp_localize_script( $this->plugin_name, 'uncode_privacy_admin_params', $params );
		}
	}

	/**
	 * Adds a menu page for the plugin.
	 */
	public function add_menu() {
		add_submenu_page( 'uncode-system-status', esc_html__( 'Privacy', 'uncode-privacy' ), esc_html__( 'Privacy', 'uncode-privacy' ), 'edit_theme_options', 'uncode-privacy-settings', array( $this, 'settings_page_template' ) );
		add_submenu_page( 'uncode-system-status', esc_html__( 'Privacy Logs', 'uncode-privacy' ), esc_html__( 'Privacy Logs', 'uncode-privacy' ), 'edit_theme_options', 'uncode-privacy-logs', array( $this, 'logs_page_template' ) );
		add_filter( 'submenu_file', array( $this, 'hide_logs_menu' ) );
	}

	/**
	 * Register settings.
	 */
	public function register_settings() {
		$settings = array(
			'uncode_privacy_privacy_policy_page'              => 'intval',
			'uncode_privacy_banner_accept_button_type'        => 'sanitize_text_field',
			'uncode_privacy_banner_show_reject'               => 'sanitize_text_field',
			'uncode_privacy_record_logs'                      => array( $this, 'sanitize_record_logs' ),
			'uncode_privacy_record_logs_for_registered_users' => 'sanitize_text_field',
			'uncode_privacy_banner_style'                     => 'sanitize_text_field',
			'uncode_privacy_cookie_banner_content'            => array( $this, 'sanitize_with_links' ),
			'uncode_privacy_cookie_privacy_excerpt'           => 'sanitize_textarea_field',
			'uncode_privacy_fallback'                         => 'sanitize_textarea_field',
			'uncode_privacy_consent_types'                    => array( $this, 'sanitize_consents' ),
		);

		foreach ( $settings as $option_name => $sanitize_callback ) {
			register_setting( 'uncode-privacy', $option_name, array( 'sanitize_callback' => $sanitize_callback ) );
		}
	}

	/**
	 * Settings Page
	 */
	public function settings_page_template() {
		$privacy_policy_page = get_option( 'uncode_privacy_privacy_policy_page', 0 );
		$tabs        = array(
			'general'  => esc_html__( 'General', 'uncode-privacy' ),
			'consents' => esc_html__( 'Consents', 'uncode-privacy' ),
		);

		if ( get_option( 'uncode_privacy_record_logs', '' ) === 'yes' ) {
			$tabs['logs'] = esc_html__( 'Logs', 'uncode-privacy' );
		}

		include_once plugin_dir_path( __FILE__ ) . 'views/admin/tmpl-consents.php';
		include plugin_dir_path( __FILE__ ) . 'views/admin/settings.php';
	}

	/**
	 * Logs Page
	 */
	public function logs_page_template() {
		include plugin_dir_path( __FILE__ ) . 'views/admin/logs.php';
	}

	/**
	 * Sanitize content but allow links.
	 */
	public function sanitize_with_links( $string ) {
		return wp_kses( $string, $this->allowed_html );
	}

	/**
	 * Check if record table is installed when saving.
	 */
	public function sanitize_record_logs( $value ) {
		if ( $value === 'yes' ) {
			Uncode_Toolkit_Privacy_Install::install();
		}

		return $value;
	}

	/**
	 * Sanitize the consents option when saving.
	 */
	public function sanitize_consents( $consents ) {
		$output = array();

		if ( ! is_array( $consents ) ) {
			return $consents;
		}

		foreach ( $consents as $key => $props ) {
			if ( '' === $props[ 'name' ] || '' === $props[ 'description' ] ) {
				unset( $consents[ $key ] );
				continue;
			}

			$output[ $key ] = array(
				'name'        => sanitize_text_field( wp_unslash( $props[ 'name' ] ) ),
				'required'    => isset( $props[ 'required' ] ) ? boolval( $props[ 'required' ] ) : 0,
				'state'       => isset( $props[ 'state' ] ) ? boolval( $props[ 'state' ] ) : 0,
				'description' => wp_kses( wp_unslash( $props[ 'description' ] ), $this->allowed_html ),
			);
		}

		return $output;
	}

	/**
	 * Hide logs page from menu.
	 */
	public function hide_logs_menu( $submenu_file ) {
		global $plugin_page;

		$hidden_submenus = array(
			'uncode-privacy-logs' => true,
		);

		// Select another submenu item to highlight (optional).
		if ( $plugin_page && isset( $hidden_submenus[ $plugin_page ] ) ) {
			$submenu_file = 'submenu_to_highlight';
		}

		// Hide the submenu.
		foreach ( $hidden_submenus as $submenu => $unused ) {
			remove_submenu_page( 'uncode-system-status', $submenu );
		}

		return $submenu_file;
	}
}

endif;
