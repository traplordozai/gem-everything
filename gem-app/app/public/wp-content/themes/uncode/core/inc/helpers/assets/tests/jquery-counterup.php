<?php
/**
 * jQuery Counterup test
 */

function uncode_page_require_asset_jquery_counterup( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_jquery_counterup', false ) ) {
		return true;
	}

	// We require it for the Counter VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_counter' ) !== false ) {
			return true;
		}
	}

	return false;
}
