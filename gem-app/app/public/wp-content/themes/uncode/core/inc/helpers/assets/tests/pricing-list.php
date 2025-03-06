<?php
/**
 * Post Table test
 */

function uncode_page_require_asset_pricing_list( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_pricing_list', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_pricing_list' ) !== false ) {
			return true;
		}
	}

	return false;
}
