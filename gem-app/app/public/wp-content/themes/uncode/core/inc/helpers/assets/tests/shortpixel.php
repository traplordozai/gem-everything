<?php
/**
 * Shortpixel test
 */

function uncode_page_require_asset_shortpixel( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_shortpixel', false ) ) {
		return true;
	}

	if ( defined( 'WPShortPixel' ) ) {
		return true;
	}

	return false;
}
