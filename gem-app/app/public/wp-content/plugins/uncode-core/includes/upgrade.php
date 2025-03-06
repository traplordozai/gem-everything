<?php
/**
 * All checks during an upgrade go here
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if a new version of Uncode Core has been installed or updated.
 */
function uncode_check_if_plugin_was_updated() {
	if ( defined( 'UNCODE_SLIM' ) && ( ! get_option( 'uncode_core_latest_version' ) || version_compare( get_option( 'uncode_core_latest_version' ), UncodeCore_Plugin::VERSION, '<' ) ) ) {
		update_option( 'uncode_core_latest_version', UncodeCore_Plugin::VERSION, false );
		do_action( 'uncode_core_upgraded' );
	}
}
add_action( 'admin_init', 'uncode_check_if_plugin_was_updated' );

/**
 * Check if author module exists from previous version, otherwise set default values.
 * @since Uncode 1.6.1
 */
function uncode_check_for_author_module() {
	if ( defined( 'UNCODE_SLIM' ) && ! get_option('uncode_check_for_author_module') ) {
		$options = get_option( ot_options_id() );

		if ( is_array( $options ) ) {
			foreach ( $options as $option => $value ) {
				if ( strpos( $option, '_uncode_post_index_' ) === 0 ) {
					$new_option           = str_replace( '_post_index_', '_author_index_', $option );
					$options[$new_option] = $value;
				}
			}
		}

		update_option( 'uncode_check_for_author_module', true, false );
		update_option( ot_options_id(), $options );
	}
}
add_action( 'admin_init', 'uncode_check_for_author_module' );
