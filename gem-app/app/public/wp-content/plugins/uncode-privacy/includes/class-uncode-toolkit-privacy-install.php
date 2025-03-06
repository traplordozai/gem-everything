<?php
/**
 * Install Class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Toolkit_Privacy_Install' ) ) :

/**
 * Uncode_Toolkit_Privacy_Install Class
 */
class Uncode_Toolkit_Privacy_Install {

	/**
	 * Install Tables
	 */
	public static function install() {
		// Create tables
		self::create_tables();
	}

	/**
	 * Set up the database tables.
	 */
	private static function create_tables() {
		global $wpdb;

		$wpdb->hide_errors();

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( self::get_schema() );
	}

	/**
	 * Get Table schema
	 * @return string
	 */
	private static function get_schema() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$wpdb->prefix}uncode_gdpr_records (
			record_id bigint(20) NOT NULL auto_increment,
			subject_id varchar(255) NOT NULL,
			subject_ip varchar(255) NULL,
			subject_email varchar(255) NULL,
			subject_username varchar(255) NULL,
			subject_firstname varchar(255) NULL,
			subject_lastname varchar(255) NULL,
			proofs longtext NULL,
			consents longtext NULL,
			record_date datetime NOT NULL,
			PRIMARY KEY  (record_id),
			KEY subject_id (subject_id)
		) $charset_collate;
		";

		return $sql;

	}
}

endif;
