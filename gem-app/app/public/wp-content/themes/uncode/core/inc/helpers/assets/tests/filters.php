<?php
/**
 * Filters test
 */

function uncode_page_require_asset_filters( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_filters', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'filtering="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
