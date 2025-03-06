<?php
/**
 * Rotate It test
 */

function uncode_page_require_asset_rotate_it( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_rotate_it', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, ' rotating="' ) !== false || ( strpos( $content, 'uncode_inline_image' ) !== false && strpos( $content, ' rotate' ) !== false ) ) {
			return true;
		}
	}

	return false;
}
