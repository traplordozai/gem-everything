<?php
/**
 * Post Table test
 */

function uncode_page_require_asset_sticky_scroll( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_sticky_scroll', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'type="sticky-scroll"' ) !== false ) {
			return true;
		}
	}

	return false;
}
