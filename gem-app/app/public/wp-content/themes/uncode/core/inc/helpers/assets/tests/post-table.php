<?php
/**
 * Post Table test
 */

function uncode_page_require_asset_post_table( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_post_table', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, ' index_type="table"' ) !== false ) {
			return true;
		}
	}

	return false;
}
