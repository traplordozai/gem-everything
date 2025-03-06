<?php
/**
 * Polyfill for object-fit test
 */

function uncode_page_require_asset_objectfit_polyfill( $content_array ) {
	global $dynamic_srcset_active;

	if ( apply_filters( 'uncode_enqueue_objectfit_polyfill', false ) ) {
		return true;
	}

	// Only the metro style uses picture
	if ( $dynamic_srcset_active ) {
		foreach ( $content_array as $content ) {
			if ( strpos( $content, 'style_preset="metro"' ) !== false ) {
				return true;
			}
		}
	}

	return false;
}
