<?php
/**
 * Personal data exporters.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Legacy_Tools_Exporters' ) ) :

/**
 * Uncode_Toolkit_Privacy_Legacy_Tools_Exporters Class
 */
class Uncode_Toolkit_Privacy_Legacy_Tools_Exporters {

	/**
	 * Finds and exports data associated with an email address.
	 */
	public static function cookie_preferences_data_exporter( $email ) {
		$data_to_export = array();
		$logs           = uncode_toolkit_privacy_get_logs_by_email( $email );

		foreach ( $logs as $log ) {
			$data_to_export[] = array(
				'group_id'    => 'uncode_toolkit_privacy_logs',
				'group_label' => __( 'Cookie Preferences Logs', 'uncode-privacy' ),
				'item_id'     => 'cookie-preference-log-' . $log->record_id,
				'data'        => self::get_log_personal_data( $log ),
			);
		}

		return array(
			'data' => $data_to_export,
			'done' => true,
		);
	}

	/**
	 * Get personal data (key/value pairs) for a cookie preference log object.
	 */
	protected static function get_log_personal_data( $log ) {
		$personal_data   = array();
		$props_to_export = apply_filters( 'uncode_toolkit_privacy_export_cookie_preferences_personal_data_props', array(
			'subject_id'        => __( 'User ID', 'uncode-privacy' ),
			'subject_ip'        => __( 'IP Address', 'uncode-privacy' ),
			'subject_email'     => __( 'User Email', 'uncode-privacy' ),
			'subject_username'  => __( 'User Nickname', 'uncode-privacy' ),
			'subject_firstname' => __( 'User Firstname', 'uncode-privacy' ),
			'subject_lastname'  => __( 'User Lastname', 'uncode-privacy' ),
			'consents'          => __( 'Consents', 'uncode-privacy' ),
			'record_date'       => __( 'Log Date', 'uncode-privacy' ),
		), $log );

		foreach ( $props_to_export as $prop => $name ) {
			$value = '';

			switch ( $prop ) {
				case 'subject_ip':
					$value = $log->subject_ip;
					break;
				case 'subject_email':
					$value = $log->subject_email;
					break;
				case 'subject_username':
					$value = $log->subject_username;
					break;
				case 'subject_firstname':
					$value = $log->subject_firstname;
					break;
				case 'subject_lastname':
					$value = $log->subject_lastname;
					break;
				case 'consents':
					$consents = maybe_unserialize( $log->consents );

					if ( is_array( $consents ) ) {
						foreach ( $consents as $consent_id => $consent_value ) {
							$value .= $consent_id . ':' . $consent_value . ' ';
						}
					} else {
						$value = '';
					}

					break;
				case 'record_date':
					$value = $log->record_date;
					break;
			}

			$value = apply_filters( 'uncode_toolkit_privacy_export_cookie_preferences_personal_data_prop', $value, $prop, $log );

			if ( $value ) {
				$personal_data[] = array(
					'name'  => $name,
					'value' => $value,
				);
			}
		}

		/**
		 * Allow extensions to register their own personal data for this log for the export.
		 */
		$personal_data = apply_filters( 'uncode_toolkit_privacy_export_cookie_preferences_personal_data', $personal_data, $log );

		return $personal_data;
	}
}

endif;
