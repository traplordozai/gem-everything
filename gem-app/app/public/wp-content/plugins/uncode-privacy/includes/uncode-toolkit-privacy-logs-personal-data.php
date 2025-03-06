<?php
/**
 * Logs exporter/eraser Functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Handle logs exporter/eraser actions.
 */
function uncode_toolkit_privacy_personal_data_handle_actions() {
	if ( isset( $_POST['uncode_form_action'] ) ) {
		$action = ! empty( $_POST['uncode_form_action'] ) ? sanitize_key( wp_unslash( $_POST['uncode_form_action'] ) ) : '';


		switch ( $action ) {
			case 'uncode_privacy_search_logs_request':
				if ( isset( $_POST[ 'uncode_privacy_search_logs_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'uncode_privacy_search_logs_nonce' ] ), 'uncode_privacy_search_logs_request' ) ) {
					$search_args = false;
					$search_type = isset( $_POST['search_type_for_privacy_request'] ) ? sanitize_key( $_POST['search_type_for_privacy_request'] ) : 'username';

					switch ( $search_type ) {
						case 'username':
							$username = isset( $_POST['username_for_privacy_request'] ) ? sanitize_text_field( $_POST['username_for_privacy_request'] ) : '';

							if ( ! $username ) {
								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Type a valid username.', 'uncode-privacy' ) );
								return false;
							}

							$search_args = array(
								'type'  => $search_type,
								'value' => trim( $username ),
							);

							break;

						case 'email':
							$email = isset( $_POST['email_for_privacy_request'] ) ? sanitize_text_field( $_POST['email_for_privacy_request'] ) : '';

							if ( ! $email ) {
								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Type a valid email address.', 'uncode-privacy' ) );
								return false;
							}

							$search_args = array(
								'type'  => $search_type,
								'value' => trim( $email ),
							);

							break;

						case 'ip':
							$ip = isset( $_POST['ip_address_for_privacy_request'] ) ? sanitize_text_field( $_POST['ip_address_for_privacy_request'] ) : '';

							if ( ! $ip ) {
								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Type a valid IP address.', 'uncode-privacy' ) );
								return false;
							}

							$search_args = array(
								'type'  => $search_type,
								'value' => trim( $ip ),
							);

							break;

						case 'cookie':
							$cookie = isset( $_POST['session_cookie_for_privacy_request'] ) ? sanitize_text_field( $_POST['session_cookie_for_privacy_request'] ) : '';

							if ( ! $cookie ) {
								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Type a valid cookie value.', 'uncode-privacy' ) );
								return false;
							}

							$search_args = array(
								'type'  => $search_type,
								'value' => trim( $cookie ),
							);

							break;

						case 'date':
							$from_date = isset( $_POST['log_start_date_for_privacy_request'] ) ? sanitize_text_field( $_POST['log_start_date_for_privacy_request'] ) : '';
							$to_date   = isset( $_POST['log_end_date_for_privacy_request'] ) ? sanitize_text_field( $_POST['log_end_date_for_privacy_request'] ) : '';

							if ( ! uncode_toolkit_privacy_personal_data_validate_date_range( $from_date, $to_date ) ) {
								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Type a valid range of dates.', 'uncode-privacy' ) );
								return false;
							}

							$search_args = array(
								'type'  => $search_type,
								'value' => array(
									'from' => trim( $from_date ),
									'to'   => trim( $to_date ),
								),
							);

							break;
					}

					if ( is_array( $search_args ) ) {
						$url = uncode_toolkit_privacy_personal_data_get_search_action_query_vars( $search_args );

						if ( apply_filters( 'uncode_privacy_logs_redirect_js', false ) ) {
							echo '<script>window.location.href = "' . $url . '";</script>';
						} else {
							wp_safe_redirect( $url );
						}
					}
				} else {
					uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Invalid nonce.', 'uncode-privacy' ) );
				}

				break;

			case 'uncode_privacy_handle_logs_request':
				if ( isset( $_POST[ 'uncode_privacy_handle_logs_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'uncode_privacy_handle_logs_nonce' ] ), 'uncode_privacy_handle_logs_request' ) ) {
					if ( isset( $_POST['action'] ) && $_POST['action'] === 'delete' ) {
						if ( isset( $_POST['record_id'] ) ) {
							$records_to_delete = $_POST['record_id'];

							if ( is_array( $records_to_delete ) && count( $records_to_delete ) > 0 ) {
								foreach ( $records_to_delete as $record_id_to_delete ) {
									uncode_toolkit_privacy_delete_log( $record_id_to_delete );
								}

								uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Logs deleted.', 'uncode-privacy' ), 'success' );
							}
						}
					}
				} else {
					uncode_toolkit_privacy_personal_data_print_action_error( 'uncode_privacy_handle_logs', __( 'Invalid nonce.', 'uncode-privacy' ) );
				}

				break;
		}
	}
}

/**
 * Print error message.
 */
function uncode_toolkit_privacy_personal_data_print_action_error( $error_key, $message, $type = 'error' ) {
	add_settings_error(
		$error_key,
		$error_key,
		$message,
		$type
	);

	settings_errors( $error_key );
}

/**
 * Validates date in format YYYY-MM-DD.
 */
function uncode_toolkit_privacy_personal_data_is_valid_date( $date ) {
	$date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';

	if ( ! preg_match( $date_regex, $date ) ) {
		return false;
	}

	return true;
}

/**
 * Validate date range.
 */
function uncode_toolkit_privacy_personal_data_validate_date_range( $from, $to ) {
	// Check if $from is a valid date
	if ( $from && ! uncode_toolkit_privacy_personal_data_is_valid_date( $from ) ) {
		return false;
	}

	// Check if $to is a valid date
	if ( $to && ! uncode_toolkit_privacy_personal_data_is_valid_date( $to ) ) {
		return false;
	}

	if ( $from && $to ) {
		$from_temp = new DateTime( $from );
		$to_temp   = new DateTime( $to );

		if ( $from_temp >= $to_temp ) {
			return false;
		}
	}

	return true;
}

/**
 * Get query vars to append.
 */
function uncode_toolkit_privacy_personal_data_get_search_action_query_vars( $args ) {
	$url = UNCODE_TOOLKIT_PRIVACY_LOGS_URL;
	$query_vars = array();

	if ( isset( $args['type'] ) && isset( $args['value'] ) ) {
		if ( is_array( $args['value'] ) ) {
			$query_vars['type'] = $args['type'];

			foreach ( $args['value'] as $key => $value) {
				$query_vars[$key] = $value;
			}
		} else if ( $args['type'] === 'cookie' ) {
			$args['value'] = str_replace( '||', '%7C%7C', $args['value'] );
			$query_vars = $args;
		} else {
			$query_vars = $args;
		}

		$url = add_query_arg( $query_vars, UNCODE_TOOLKIT_PRIVACY_LOGS_URL );
	}

	return $url;
}

/**
 * Get current query vars.
 */
function uncode_toolkit_privacy_personal_data_get_current_search_action_query_vars() {
	$query_vars = array();

	if ( isset( $_GET['type'] ) && $_GET['type'] ) {
		$query_vars['type'] = $_GET['type'];

		if ( isset( $_GET['value'] ) && $_GET['value'] ) {
			$query_vars['value'] = $_GET['value'];
		}

		if ( $_GET['type'] === 'date' ) {
			if ( isset( $_GET['from'] ) && $_GET['from'] ) {
				$query_vars['from'] = $_GET['from'];
			}

			if ( isset( $_GET['to'] ) && $_GET['to'] ) {
				$query_vars['to'] = $_GET['to'];
			}
		}
	}

	return $query_vars;
}
