<?php
/**
 * Noise test
 */

function uncode_page_require_asset_simplex_noise( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_noise', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'overlay_animated="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
