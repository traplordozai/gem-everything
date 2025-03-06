<?php
/**
 * Logs Functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if can record the logs.
 */
function uncode_toolkit_privacy_can_record_logs() {
	$records_enabled = uncode_toolkit_privacy_logs_enabled();

	if ( ! $records_enabled ) {
		return false;
	}

	if ( get_option( 'uncode_privacy_record_logs_for_registered_users', '' ) === 'yes' ) {
		if ( is_user_logged_in() ) {
			$user_can_log = true;
		} else {
			$user_can_log = false;
		}
	} else {
		$user_can_log = true;
	}

	return $user_can_log;
}

/**
 * Check if logs are enabled.
 */
function uncode_toolkit_privacy_logs_enabled() {
	return get_option( 'uncode_privacy_record_logs', '' ) === 'yes' ? true : false;
}

/**
 * Set a cookie.
 */
function uncode_toolkit_privacy_setcookie( $name, $value, $expire = 0, $secure = false ) {
	if ( ! headers_sent() ) {
		if ( PHP_VERSION_ID < 70300 ) {
			setcookie( $name, $value, $expire, COOKIEPATH. '; samesite=Strict', COOKIE_DOMAIN, is_ssl() );
		} else {
			$arr_cookie_options = apply_filters( 'uncode_privacy_get_cookies_req_options', array(
				'expires'  => $expire,
				'path'     => COOKIEPATH,
				'secure'   => is_ssl(),
				'samesite' => 'Strict'
			) );

			setcookie( $name, $value, $arr_cookie_options );
		}
	} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		trigger_error( "Cookie cannot be set - headers already sent", E_USER_NOTICE );
	}
}

/**
 * Get User IP
 */
function uncode_toolkit_privacy_get_ip() {
	$ip = false;

	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		// Check ip from share internet.
		$ip = filter_var( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ), FILTER_VALIDATE_IP );
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		// To check ip is pass from proxy.
		// Can include more than 1 ip, first is the public one.

		// WPCS: sanitization ok.
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$ips = explode( ',', wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
		if ( is_array( $ips ) ) {
			$ip = filter_var( $ips[0], FILTER_VALIDATE_IP );
		}
	} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$ip = filter_var( wp_unslash( $_SERVER['REMOTE_ADDR'] ), FILTER_VALIDATE_IP );
	}

	$ip = false !== $ip ? $ip : '127.0.0.1';

	// Fix potential CSV returned from $_SERVER variables.
	$ip_array = explode( ',', $ip );
	$ip_array = array_map( 'trim', $ip_array );

	return apply_filters( 'uncode_toolkit_privacy_get_ip', $ip_array[0] );
}

/**
 * Get user ID from cookie.
 */
function uncode_toolkit_privacy_get_visitor_id_from_cookie( $cookie ) {
	if ( isset( $cookie['uncode_gdpr_session_' . COOKIEHASH] ) && $cookie['uncode_gdpr_session_' . COOKIEHASH] && is_string( $cookie['uncode_gdpr_session_' . COOKIEHASH] ) ) {
		$session_cookie = $cookie['uncode_gdpr_session_' . COOKIEHASH];

		list( $visitor_id, $session_expiration, $session_expiring, $cookie_hash ) = explode( '||', $session_cookie );

		// Validate hash
		$to_hash = $visitor_id . '|' . $session_expiration;
		$hash    = hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );

		if ( empty( $cookie_hash ) || ! hash_equals( $hash, $cookie_hash ) ) {
			return false;
		}

		return $visitor_id;
	}

	return false;
}

/**
 * Save log.
 */
function uncode_toolkit_privacy_save_log( $session_id, $consents, $proofs ) {
	if ( $session_id ) {
		global $wpdb;

		$record_date       = new DateTime( current_time( 'Y-m-d H:i:s' ) );
		$record_date       = $record_date->format( 'Y-m-d H:i:s' );
		$subject_id        = $session_id;
		$subject_ip        = uncode_toolkit_privacy_get_ip();
		$subject_email     = NULL;
		$subject_username  = NULL;
		$subject_firstname = NULL;
		$subject_lastname  = NULL;
		$consents          = is_array( $consents ) ? $consents : array();
		$proofs            = is_array( $proofs ) ? $proofs : array(
			'content' => '',
			'form'    => ''
		);

		if ( is_user_logged_in() ) {
			$user_data       = get_userdata( get_current_user_id() );
			$user_email      = $user_data->user_email;
			$user_username   = $user_data->user_login;
			$user_first_name = $user_data->first_name;
			$user_last_name  = $user_data->last_name;

			if ( $user_email ) {
				$subject_email = $user_email;
			}

			if ( $user_username ) {
				$subject_username = $user_username;
			}

			if ( $user_first_name ) {
				$subject_firstname = $user_first_name;
			}

			if ( $user_last_name ) {
				$subject_lastname = $user_last_name;
			}
		}

		$wpdb->insert(
			$wpdb->prefix . "uncode_gdpr_records",
			array(
				'subject_id'        => $subject_id,
				'record_date'       => $record_date,
				'subject_ip'        => $subject_ip,
				'subject_email'     => $subject_email,
				'subject_username'  => $subject_username,
				'subject_firstname' => $subject_firstname,
				'subject_lastname'  => $subject_lastname,
				'proofs'            => maybe_serialize( $proofs ),
				'consents'          => maybe_serialize( $consents ),
			),
			array(
				'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
			)
		);
	}
}

/**
 * Get log by email.
 */
function uncode_toolkit_privacy_get_logs_by_email( $email ) {
	$logs = array();

	if ( $email ) {
		global $wpdb;

		$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE subject_email = %s ", $email );
		$results = $wpdb->get_results( $sql );

		foreach ( $results as $line ) {
			$logs[] = $line;
		}
	}

	return $logs;
}

/**
 * Anonimize log record.
 */
function uncode_toolkit_privacy_anonymize_log( $log_id, $log_data ) {
	if ( $log_id && is_object( $log_data ) ) {
		global $wpdb;

		$subject_id        = isset( $log_data->subject_id ) ? $log_data->subject_id : '000000';
		$subject_ip        = isset( $log_data->subject_ip ) ? $log_data->subject_ip : '0.0.0.0';
		$subject_email     = isset( $log_data->subject_email ) ? $log_data->subject_email : 'deleted@site.invalid';
		$subject_username  = isset( $log_data->subject_username ) ? $log_data->subject_username : NULL;
		$subject_firstname = isset( $log_data->subject_firstname ) ? $log_data->subject_firstname : NULL;
		$subject_lastname  = isset( $log_data->subject_lastname ) ? $log_data->subject_lastname : NULL;
		$proofs            = isset( $log_data->proofs ) ? $log_data->proofs : NULL;
		$consents          = isset( $log_data->consents ) ? $log_data->consents : NULL;
		$record_date       = isset( $log_data->record_date ) ? $log_data->record_date : '0000-00-00 00:00:00';

		$wpdb->update(
			$wpdb->prefix . "uncode_gdpr_records",
			array(
				'subject_id'        => $subject_id,
				'subject_ip'        => $subject_ip,
				'subject_email'     => $subject_email,
				'subject_username'  => $subject_username,
				'subject_firstname' => $subject_firstname,
				'subject_lastname'  => $subject_lastname,
				'proofs'            => $proofs,
				'consents'          => $consents,
				'record_date'       => $record_date,
			),
			array(
				'record_id' => $log_id,
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
			),
			array( '%d' )
		);
	}
}

/**
 * Delete log record.
 */
function uncode_toolkit_privacy_delete_log( $log_id ) {
	if ( $log_id ) {
		global $wpdb;

		$wpdb->delete(
			$wpdb->prefix . "uncode_gdpr_records",
			array(
				'record_id' => $log_id,
			)
		);
	}
}

/**
 * Query logs by field.
 */
function uncode_toolkit_privacy_query_log( $args ) {
	$logs = array();

	if ( is_array( $args ) && isset( $args['type'] ) ) {
		global $wpdb;

		switch ( $args['type'] ) {
			case 'username':
				$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE subject_username = %s ", $args['value'] );
				$results = $wpdb->get_results( $sql );

				foreach ( $results as $line ) {
					$logs[] = $line;
				}
				break;

			case 'email':
				$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE subject_email = %s ", $args['value'] );
				$results = $wpdb->get_results( $sql );

				foreach ( $results as $line ) {
					$logs[] = $line;
				}
				break;

			case 'ip':
				$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE subject_ip = %s ", $args['value'] );
				$results = $wpdb->get_results( $sql );

				foreach ( $results as $line ) {
					$logs[] = $line;
				}
				break;

			case 'cookie':
				$session_id = uncode_toolkit_privacy_get_visitor_id_from_cookie( array( 'uncode_gdpr_session_' . COOKIEHASH => wp_unslash( urldecode( $args['value'] ) ) ) );

				if ( $session_id ) {
					$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE subject_id = %s ", $session_id );
					$results = $wpdb->get_results( $sql );

					foreach ( $results as $line ) {
						$logs[] = $line;
					}
				}
				break;

			case 'date':
				$from = isset( $args['from'] ) && $args['from'] ? $args['from'] : false;
				$to   = isset( $args['to'] ) && $args['to'] ? $args['to'] . ' 23:59:59' : false;

				if ( $from && $to ) {
					$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE record_date > %s AND record_date <= %s ", $from, $to );
					$results = $wpdb->get_results( $sql );
				} else if ( $from ) {
					$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE record_date > %s ", $from );
					$results = $wpdb->get_results( $sql );
				} else if ( $to ) {
					$sql     = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records WHERE record_date <= %s ", $to );
					$results = $wpdb->get_results( $sql );
				} else {
					$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}uncode_gdpr_records" );
				}

				foreach ( $results as $line ) {
					$logs[] = $line;
				}
				break;
		}
	}

	return $logs;
}
