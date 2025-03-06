<?php
/**
 * Cursor test
 */

function uncode_page_require_asset_magic_cursor( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_cursor', false ) ) {
		return true;
	}

	$custom_cursor = uncode_check_for_custom_cursor();

	if ( ( $custom_cursor && $custom_cursor !== 'off' ) ) {
		return true;
	}

	return false;
}
