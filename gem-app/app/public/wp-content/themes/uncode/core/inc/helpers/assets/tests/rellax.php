<?php
/**
 * Rellax test
 */

function uncode_page_require_asset_rellax( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_rellax', false ) ) {
		return true;
	}

	// Check parallax elements
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'parallax_intensity="' ) !== false ) {
			return true;
		}
	}

	return false;
}
