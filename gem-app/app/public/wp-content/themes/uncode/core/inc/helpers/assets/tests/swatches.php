<?php
/**
 * Swatches test
 */

function uncode_page_require_asset_swatches( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_swatches', false ) ) {
		return true;
	}

	// Required by the AJAX Filters module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_ajax_filter' ) !== false ) {
			return true;
		}
	}

	return false;
}
