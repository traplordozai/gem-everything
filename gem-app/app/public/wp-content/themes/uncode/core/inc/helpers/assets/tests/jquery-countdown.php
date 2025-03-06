<?php
/**
 * jQuery Countdown test
 */

function uncode_page_require_asset_jquery_countdown( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_jquery_countdown', false ) ) {
		return true;
	}

	// Required by the Countdown VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_countdown' ) !== false ) {
			return true;
		}
	}

	return false;
}
