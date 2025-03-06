<?php
/**
 * Session Class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Session' ) ) :

/**
 * Uncode_Toolkit_Privacy_Session Class
 */
class Uncode_Toolkit_Privacy_Session {

	/** @var int $_visitor_id */
	protected $_visitor_id;

	/** @var string cookie name */
	private $_cookie;

	/** @var string session due to expire timestamp */
	private $_session_expiring;

	/** @var string session expiration timestamp */
	private $_session_expiration;

	/** $var bool Bool based on whether a cookie exists **/
	private $_has_cookie = false;

	/**
	 * Constructor for the session class.
	 */
	public function __construct() {
		global $wpdb;

		$this->_cookie = 'uncode_gdpr_session_' . COOKIEHASH;

		if ( $cookie = $this->get_session_cookie() ) {
			$this->_visitor_id         = $cookie[0];
			$this->_session_expiration = $cookie[1];
			$this->_session_expiring   = $cookie[2];
			$this->_has_cookie         = true;

			// Update session if its close to expiring
			if ( time() > $this->_session_expiring ) {
				$this->set_session_expiration();
			}

		} else {
			$this->set_session_expiration();
			$this->_visitor_id = $this->generate_visitor_id();
		}

		$this->set_visitor_session_cookie();

		// Actions
		add_action( 'wp_logout', array( $this, 'destroy_session' ) );
	}

	/**
	 * get_visitor_id function.
	 *
	 * @access public
	 * @return int
	 */
	public function get_visitor_id() {
		return $this->_visitor_id;
	}

	/**
	 * Sets the session cookie on-demand.
	 */
	public function set_visitor_session_cookie() {
		// Set/renew our cookie
		$to_hash           = $this->_visitor_id . '|' . $this->_session_expiration;
		$cookie_hash       = hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );
		$cookie_value      = $this->_visitor_id . '||' . $this->_session_expiration . '||' . $this->_session_expiring . '||' . $cookie_hash;
		$this->_has_cookie = true;

		// Set the cookie
		uncode_toolkit_privacy_setcookie( $this->_cookie, $cookie_value, $this->_session_expiration );
	}

	/**
	 * Return true if the current user has an active session, i.e. a cookie to retrieve values.
	 *
	 * @return bool
	 */
	public function has_session() {
		return isset( $_COOKIE[ $this->_cookie ] ) || $this->_has_cookie || is_user_logged_in();
	}

	/**
	 * Set session expiration.
	 */
	public function set_session_expiration() {
		$this->_session_expiring   = time() + intval( apply_filters( 'uncode_gdpr_session_expiring', 60 * 60 * 47 ) ); // 47 Hours.
		$this->_session_expiration = time() + intval( apply_filters( 'uncode_gdpr_session_expiration', 60 * 60 * 48 ) ); // 48 Hours.
	}

	/**
	 * Generate a unique visitor ID, or return user ID if logged in.
	 *
	 * Uses Portable PHP password hashing framework to generate a unique cryptographically strong ID.
	 *
	 * @return int|string
	 */
	public function generate_visitor_id() {
		if ( is_user_logged_in() ) {
			return get_current_user_id();
		} else {
			require_once( ABSPATH . 'wp-includes/class-phpass.php');
			$hasher = new PasswordHash( 8, false );
			return md5( $hasher->get_random_bytes( 32 ) );
		}
	}

	/**
	 * Get session cookie.
	 *
	 * @return bool|array
	 */
	public function get_session_cookie() {
		if ( empty( $_COOKIE[ $this->_cookie ] ) || ! is_string( $_COOKIE[ $this->_cookie ] ) ) {
			return false;
		}

		list( $visitor_id, $session_expiration, $session_expiring, $cookie_hash ) = explode( '||', $_COOKIE[ $this->_cookie ] );

		// Validate hash
		$to_hash = $visitor_id . '|' . $session_expiration;
		$hash    = hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );

		if ( empty( $cookie_hash ) || ! hash_equals( $hash, $cookie_hash ) ) {
			return false;
		}

		return array( $visitor_id, $session_expiration, $session_expiring, $cookie_hash );
	}

	/**
	 * Destroy all session data.
	 */
	public function destroy_session() {
		// Clear cookie
		uncode_toolkit_privacy_setcookie( $this->_cookie, '', time() - YEAR_IN_SECONDS );

		// Clear data
		$this->_visitor_id = $this->generate_visitor_id();
	}
}

endif;
