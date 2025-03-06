<?php
/**
 * Ajax Filters test
 */

function uncode_page_require_asset_ajax_filters( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_ajax_filters', false ) ) {
		return true;
	}

	// Always enqueue when the Ajax filtering is enabled
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'filtering="ajax"' ) !== false ) {
			return true;
		}
	}

	// Required by the Ajax Filters module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_ajax_filter' ) !== false ) {
			return true;
		}
	}

	return false;
}
