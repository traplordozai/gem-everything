<?php
/**
 * TwentyTwenty test
 */

function uncode_page_require_asset_twentytwenty( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_twentytwenty', false ) ) {
		return true;
	}

	// Required by the TwentyTwenty module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_twentytwenty' ) !== false ) {
			return true;
		}
	}

	return false;
}
