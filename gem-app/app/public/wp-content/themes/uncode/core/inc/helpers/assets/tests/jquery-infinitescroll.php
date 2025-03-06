<?php
/**
 * jQuery Infinite Scroll test
 */

function uncode_page_require_asset_jquery_infinitescroll( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_jquery_infinitescroll', false ) ) {
		return true;
	}

	// We require jQuery Infinite Scroll when we find this attribute
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'infinite="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
