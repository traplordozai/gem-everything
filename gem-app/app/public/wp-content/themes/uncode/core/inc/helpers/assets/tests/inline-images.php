<?php
/**
 * Inline Images test
 */

function uncode_page_require_asset_inline_images( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_inline_images', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'uncode_inline_image' ) !== false ) {
			return true;
		}
	}

	return false;
}
