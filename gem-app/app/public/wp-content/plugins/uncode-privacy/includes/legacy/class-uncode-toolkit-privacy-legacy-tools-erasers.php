<?php
/**
 * Personal data erasers.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Legacy_Tools_Erasers' ) ) :

/**
 * Uncode_Toolkit_Privacy_Legacy_Tools_Erasers Class
 */
class Uncode_Toolkit_Privacy_Legacy_Tools_Erasers {

	/**
	 * Finds and erases data associated with an email address.
	 */
	public static function cookie_preferences_data_eraser( $email ) {
		$response = array(
			'items_removed'  => false,
			'items_retained' => false,
			'messages'       => array(),
			'done'           => true,
		);

		$logs = uncode_toolkit_privacy_get_logs_by_email( $email );

		foreach ( $logs as $log ) {
			if ( apply_filters( 'uncode_toolkit_privacy_erase_cookie_preferences_personal_data', true, $log ) ) {
				self::remove_log_personal_data( $log );

				$response[ 'messages' ][]    = sprintf( __( 'Removed personal data from log %s.', 'uncode-privacy' ), $log->record_id );
				$response[ 'items_removed' ] = true;
			} else {
				$response[ 'messages' ][]    = sprintf( __( 'Personal data within log %s has been retained.', 'uncode-privacy' ), $log->record_id );
				$response[ 'items_retained' ] = true;
			}
		}

		return $response;
	}

	/**
	 * Remove personal data from a log object.
	 */
	public static function remove_log_personal_data( $log ) {
		/**
		 * Allow extensions to remove their own personal data for this log
		 */
		do_action( 'uncode_toolkit_privacy_before_remove_cookie_preferences_personal_data', $log );

		/**
		 * Expose props and data types we'll be anonymizing.
		 */
		$props_to_remove = apply_filters( 'uncode_toolkit_privacy_remove_cookie_preferences_personal_data_props', array(
			'subject_id'        => 'text',
			'subject_ip'        => 'ip',
			'subject_email'     => 'email',
			'subject_username'  => 'text',
			'subject_firstname' => 'text',
			'subject_lastname'  => 'text',
			'proofs'            => 'longtext',
			'consents'          => 'longtext',
			'record_date'       => 'date',
		), $log );

		$new_log_data = clone $log;

		if ( ! empty( $props_to_remove ) && is_array( $props_to_remove ) ) {
			foreach ( $props_to_remove as $prop => $data_type ) {
				$value = $log->{$prop};

				// Skip empty values
				if ( empty( $value ) || empty( $data_type ) ) {
					continue;
				}

				$anon_value = function_exists( 'wp_privacy_anonymize_data' ) ? wp_privacy_anonymize_data( $data_type, $value ) : '';

				$anon_value = apply_filters( 'uncode_toolkit_privacy_remove_cookie_preferences_personal_data_prop_value', $anon_value, $prop, $value, $data_type, $log );

				$new_log_data->{$prop} = $anon_value;
			}

			uncode_toolkit_privacy_anonymize_log( $log->record_id, $new_log_data );
		}

		/**
		 * Allow extensions to remove their own personal data for this log.
		 */
		do_action( 'uncode_toolkit_privacy_remove_cookie_preferences_personal_data', $log );
	}
}

endif;
