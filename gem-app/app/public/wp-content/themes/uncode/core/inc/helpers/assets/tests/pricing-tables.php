<?php
/**
 * Pricing Tables test
 */

function uncode_page_require_asset_pricing_tables( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_pricing_tables', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_pricing' ) !== false ) {
			return true;
		}
	}

	return false;
}
