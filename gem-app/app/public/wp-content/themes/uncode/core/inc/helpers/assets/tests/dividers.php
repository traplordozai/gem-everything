<?php
/**
 * Dividers test
 */

function uncode_page_require_asset_dividers( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_dividers', false ) ) {
		return true;
	}

	// Dividers are enabled when they have a value
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'enable_top_divider="default"' ) !== false || strpos( $content, 'enable_top_divider="custom"' ) !== false || strpos( $content, 'enable_bottom_divider="default"' ) !== false || strpos( $content, 'enable_bottom_divider="custom"' ) !== false || strpos( $content, 'vc_separator ' ) !== false ) {
			return true;
		}
	}

	return false;
}