<?php
/**
 * Public related functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Public' ) ) :

/**
 * Uncode_Toolkit_Privacy_Public Class
 */
class Uncode_Toolkit_Privacy_Public {

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
	 * Register the stylesheets for the frontend.
	 */
	public function enqueue_styles() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/uncode-privacy-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the frontend.
	 */
	public function enqueue_scripts() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'js-cookie', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/js-cookie' . $suffix . '.js', array(), '2.2.0', true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/uncode-privacy-public' . $suffix . '.js', array( 'jquery', 'js-cookie' ), $this->version, true );

		$accent_color = false;

		if ( function_exists( 'ot_options_id' ) ) {
			if ( is_multisite() ) {
				$uncode_option = get_blog_option( get_current_blog_id(), ot_options_id() );
			} else {
				$uncode_option = get_option( ot_options_id() );
			}

			global $front_background_colors;

			if ( $front_background_colors && isset( $uncode_option[ '_uncode_accent_color' ] ) && isset ( $front_background_colors[ $uncode_option[ '_uncode_accent_color' ] ] ) ) {
				$accent_color = $front_background_colors[ $uncode_option[ '_uncode_accent_color' ] ];
			}
		}

		$accent_color = $accent_color ? $accent_color : '#006cff';

		$privacy_parameters = array(
			'accent_color'                 => $accent_color,
			'ajax_url'                     => admin_url( 'admin-ajax.php' ),
			'nonce_uncode_privacy_session' => wp_create_nonce( 'nonce-uncode-privacy-session' ),
			'enable_debug'                 => apply_filters( 'uncode_privacy_enable_debug_on_js_scripts', false ),
			'logs_enabled'                 => uncode_toolkit_privacy_logs_enabled() ? 'yes' : 'no',
		);

		wp_localize_script( $this->plugin_name, 'Uncode_Privacy_Parameters', $privacy_parameters );
	}

	/**
	 * Set plugin cookies
	 */
	public function set_plugin_cookies() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		$user_id = get_current_user_id();
		$secure_cookie = is_ssl();

		if ( ! isset( $_COOKIE['uncode_privacy']['consent_types'] ) ) {
			if ( ! $user_id ) {
				$this->set_cookie( '[]' );
			} else {
				$user_consents = get_user_meta( $user_id, 'uncode_privacy_consents' );

				$this->set_cookie( json_encode( $user_consents ) );
			}
		} else {
			if ( $user_id ) {
				$user_consents   = (array) get_user_meta( $user_id, 'uncode_privacy_consents' );
				$cookie_consents = (array) json_decode( wp_unslash( $_COOKIE['uncode_privacy']['consent_types'] ) );
				$intersect       = array_intersect( $user_consents, $cookie_consents );
				$diff            = array_merge( array_diff( $user_consents, $intersect ), array_diff( $cookie_consents, $intersect ) );

				if ( ! empty( $diff ) ) {
					$this->set_cookie( json_encode( $user_consents ) );
				}
			}
		}
	}

	/**
	 * Append overlay
	 */
	public function overlay() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		echo '<div class="gdpr-overlay"></div>';
	}

	/**
	 * Print privacy
	 */
	public function privacy_bar() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		$style       = get_option( 'uncode_privacy_banner_style', '' );
		$content     = get_option( 'uncode_privacy_cookie_banner_content', '' );
		$accept_button_text = get_option( 'uncode_privacy_banner_accept_button_type', '' ) === 'accept_all' ? esc_html__( 'Accept All', 'uncode-privacy' ) : esc_html__( 'I Agree', 'uncode-privacy' );
		$accept_button_text = apply_filters( 'uncode_privacy_privacy_bar_button_text', $accept_button_text );
		$reject_button_text = apply_filters( 'uncode_privacy_privacy_bar_reject_button_text', esc_html__( 'Reject All', 'uncode-privacy' ) );

		if ( empty( $content ) ) {
			return;
		}

		include plugin_dir_path( __FILE__ ) . 'views/public/privacy-bar.php';
	}

	/**
	 * Output privacy preferences modal.
	 */
	public function privacy_preferences_modal() {
		if ( ! uncode_toolkit_privacy_is_plugin_enabled() ) {
			return;
		}

		$cookie_privacy_excerpt = get_option( 'uncode_privacy_cookie_privacy_excerpt', '' );
		$consent_types          = uncode_toolkit_privacy_get_consent_types();
		$privacy_policy_page    = get_option( 'uncode_privacy_privacy_policy_page', 0 );
		$user_consents          = isset( $_COOKIE['uncode_privacy']['consent_types'] ) ? json_decode( wp_unslash( $_COOKIE['uncode_privacy']['consent_types'] ) ) : array();

		include plugin_dir_path( __FILE__ ) . 'views/public/privacy-preferences-modal.php';
	}

	/**
	 * Update the user allowed types of consent.
	 * If the user is logged in, we also save consent to user meta.
	 */
	public function update_privacy_preferences() {
		if ( ! isset( $_POST[ 'update-privacy-preferences-nonce' ] ) || ( apply_filters( 'uncode_privacy_enable_nonce_privacy_preferences', true ) && ! wp_verify_nonce( sanitize_key( $_POST[ 'update-privacy-preferences-nonce' ] ), 'uncode-privacy-update_privacy_preferences' ) ) ) {
			wp_die( esc_html__( 'We could not verify the the security token. Please try again.', 'uncode-privacy' ) );
		}

		$consents_default_on_list = isset( $_POST[ 'consents_default_on_list' ] ) ? $_POST[ 'consents_default_on_list' ] : array();
		$consents_default_on_list = array_map( 'sanitize_text_field', (array) $consents_default_on_list );
		$consents                 = isset( $_POST[ 'user_consents' ] ) ? $_POST[ 'user_consents' ] : array();
		$consents                 = array_map( 'sanitize_text_field', (array) $consents );
		$consents_to_save         = array();
		$consents_to_save_in_log  = array();

		// First save all consents that are on by default to off (if unchecked)
		foreach ( $consents_default_on_list as $consents_on ) {
			if ( ! in_array( $consents_on, $consents ) ) {
				$consents_to_save[] = $consents_on . '-off';
			}
		}

		// Then save the other consents
		foreach ( $consents as $consent_id ) {
			if ( in_array( $consent_id, $consents_default_on_list ) ) {
				$consents_to_save[]        = $consent_id . '-on';
				$consents_to_save_in_log[] = $consent_id;
			} else {
				$consents_to_save[]        = $consent_id;
				$consents_to_save_in_log[] = $consent_id;
			}
		}

		$consents_as_json = json_encode( $consents_to_save );

		$this->set_cookie( $consents_as_json );

		// Record log
		if ( uncode_toolkit_privacy_can_record_logs() ) {
			$all_consent_types         = uncode_toolkit_privacy_get_consent_types();
			$user_preferences          = array();
			$saving_from_banner        = isset( $_POST[ 'uncode_privacy_save_cookies_from_banner' ] ) && $_POST[ 'uncode_privacy_save_cookies_from_banner' ] === 'true' ? true : false;
			$saving_from_banner_button = isset( $_POST[ 'uncode_privacy_save_cookies_from_banner_button' ] ) ? $_POST[ 'uncode_privacy_save_cookies_from_banner_button' ] : false;

			$proofs = array(
				'content' => '',
				'form'    => ''
			);

			$form_data = $_POST;
			unset( $form_data['update-privacy-preferences-nonce'] );

			$form_content = array(
				'title'         => esc_html__( 'Privacy Preferences', 'uncode-privacy' ),
				'description'   => esc_html( get_option( 'uncode_privacy_cookie_privacy_excerpt', '' ) ),
				'consents_list' => array(),
				'buttons'       => array(
					'submit' => esc_attr__( 'Save Preferences', 'uncode-privacy' )
				),
				'privacy_link'  =>  '',
			);

			$privacy_policy_page = get_option( 'uncode_privacy_privacy_policy_page', 0 );

			if ( $privacy_policy_page ) {
				$form_content['privacy_link'] = array(
					'url'  => esc_url( apply_filters( 'uncode_privacy_policy_page_link', get_permalink( $privacy_policy_page ) ) ),
					'text' => esc_html__( 'Privacy Policy', 'uncode-privacy' )
				);
			}

			$form_content_consents_list = array();

			foreach ( $all_consent_types as $consent_type_key => $consent_type_value ) {
				$form_content_consents_list[$consent_type_key] = array(
					'label'       => esc_html( $consent_type_value['name'] ),
					'description' => esc_html( $consent_type_value['description'] ),
					'required'    => $consent_type_value['required'] ? 'yes' : 'no',
				);

				if ( in_array( $consent_type_key, $consents_to_save_in_log ) ) {
					$user_preferences[$consent_type_key] = 'yes';
				} else {
					$user_preferences[$consent_type_key] = 'no';
				}
			}

			if ( $saving_from_banner ) {
				$saving_from_banner_button = in_array( $saving_from_banner_button, array( 'accept', 'reject' ) ) ? $saving_from_banner_button : 'accept';
				$accept_button_text        = get_option( 'uncode_privacy_banner_accept_button_type', '' ) === 'accept_all' ? esc_html__( 'Accept All', 'uncode-privacy' ) : esc_html__( 'I Agree', 'uncode-privacy' );
				$accept_button_text        = apply_filters( 'uncode_privacy_privacy_bar_button_text', $accept_button_text );

				$form_content['banner'] = array(
					'content' => esc_html( get_option( 'uncode_privacy_cookie_banner_content', '' ) ),
					'buttons' => array(
						'accept' => $accept_button_text
					)
				);

				if ( get_option( 'uncode_privacy_banner_show_reject', '' ) === 'yes' ) {
					$reject_button_text = apply_filters( 'uncode_privacy_privacy_bar_reject_button_text', esc_html__( 'Reject All', 'uncode-privacy' ) );
					$form_content['banner']['buttons']['reject'] = $reject_button_text;
				}
			}

			$form_content['consents_list'] = $form_content_consents_list;
			$proofs['content']             = $form_content;
			$proofs['form']                = $form_data;

			// Get visitor ID from session
			$visitor_id = uncode_toolkit_privacy_get_visitor_id_from_cookie( $_COOKIE );

			if ( $visitor_id ) {
				uncode_toolkit_privacy_save_log( $visitor_id, $user_preferences, $proofs );
			}
		}

		if ( is_user_logged_in() ) {
			$user = wp_get_current_user();

			if ( apply_filters( 'uncode_privacy_save_privacy_preferences_in_user_meta', true ) ) {
				if ( ! empty( $consents_to_save ) ) {
					delete_user_meta( $user->ID, 'uncode_privacy_consents' );

					foreach ( $consents_to_save as $consent ) {
						$consent = sanitize_text_field( wp_unslash( $consent ) );
						add_user_meta( $user->ID, 'uncode_privacy_consents', $consent );
					}
				}
			}
		}

		$url = esc_url_raw( wp_get_referer() );
		$url = add_query_arg( 'privacy', 'updated', $url );

		wp_safe_redirect( $url );
		exit;
	}

	/**
	 * Get cookies conf
	 */
	public function get_cookies_conf() {
		$arr_cookie_options = array (
			'expires'  => time() + YEAR_IN_SECONDS,
			'path'     => COOKIEPATH,
			'secure'   => is_ssl(),
			'samesite' => 'Strict'
		);

		return apply_filters( 'uncode_privacy_get_cookies_req_options', $arr_cookie_options );
	}

	/**
	 * Set cookie
	 */
	public function set_cookie( $value ) {
		$cookie_name      = 'uncode_privacy[consent_types]';
		$check_headers    = apply_filters( 'uncode_privacy_check_for_headers', false );
		$can_send_headers = true;

		if ( $check_headers ) {
			$can_send_headers = false;

			if ( ! headers_sent() ) {
				$can_send_headers = true;
			} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				trigger_error( "Cookie cannot be set - headers already sent", E_USER_NOTICE );
			}
		}

		if ( $can_send_headers ) {
			if ( PHP_VERSION_ID < 70300 ) {
				setcookie( $cookie_name, $value, time() + YEAR_IN_SECONDS, COOKIEPATH . '; samesite=Strict', COOKIE_DOMAIN, is_ssl() );
				return;
			} else {
				setcookie( $cookie_name, $value, $this->get_cookies_conf() );
			}
		}
	}
}

endif;
