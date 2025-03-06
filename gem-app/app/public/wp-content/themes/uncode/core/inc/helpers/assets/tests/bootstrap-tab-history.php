<?php
/**
 * Tab History test
 */

function uncode_page_require_asset_bootstrap_tab_history( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_bootstrap_tab_history', false ) ) {
		return true;
	}

	// Required in tabs and accordions
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'history="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
