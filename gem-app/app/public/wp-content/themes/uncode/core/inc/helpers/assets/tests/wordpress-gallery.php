<?php
/**
 * WordPress Gallery test
 */

function uncode_page_require_asset_wordpress_gallery( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_wordpress_gallery', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[gallery ' ) !== false ) {
			return true;
		}
	}

	return false;
}
