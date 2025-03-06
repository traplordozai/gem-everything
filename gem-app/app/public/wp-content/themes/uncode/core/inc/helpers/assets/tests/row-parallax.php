<?php
/**
 * Check Skin on Scroll test
 */

function uncode_page_require_asset_row_parallax( $content_array ) {
	if ( apply_filters( 'uncode_page_require_asset_row_parallax', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'content_parallax="' ) !== false ) {
			return true;
		}
	}

	return false;
}
