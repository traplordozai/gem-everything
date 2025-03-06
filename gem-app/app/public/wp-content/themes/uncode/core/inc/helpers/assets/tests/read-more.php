<?php
/**
 * Read more column test
 */

function uncode_page_require_asset_read_more( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_dividers', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, ' toggle="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}