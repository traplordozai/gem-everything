<?php
/**
 * Tooltip test
 */

function uncode_page_require_asset_tooltip( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_tooltip', false ) ) {
		return true;
	}

	// Check tooltip classes
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'btn-tooltip' ) !== false ) {
			return true;
		}
	}

	return false;
}
