<?php
/**
 * VC Navigation test
 */

function uncode_page_require_asset_vc_navigation( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_vc_navigation', false ) ) {
		return true;
	}

	// Required by the Navigation module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_navigation' ) !== false ) {
			return true;
		}
	}

	return false;
}
