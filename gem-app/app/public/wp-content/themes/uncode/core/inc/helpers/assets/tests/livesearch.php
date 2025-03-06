<?php
/**
 * Livesearch test
 */

function uncode_page_require_asset_livesearch( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_livesearch', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'live_search="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
