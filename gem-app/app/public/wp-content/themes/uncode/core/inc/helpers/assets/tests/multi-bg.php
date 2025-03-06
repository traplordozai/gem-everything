<?php
/**
 * Noise test
 */

function uncode_page_require_asset_multi_bg( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_multi_bg', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'multiple_media="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
