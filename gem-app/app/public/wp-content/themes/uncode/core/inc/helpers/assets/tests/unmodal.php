<?php
/**
 * Unmodal test
 */

function uncode_page_require_asset_unmodal( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_unmodal', false ) ) {
		return true;
	}

	// Always include owl in pages with Quick Views
	if ( isset( $uncode_post_data['has_quick_view'] ) && $uncode_post_data['has_quick_view'] ) {
		return true;
	}

	return false;
}
