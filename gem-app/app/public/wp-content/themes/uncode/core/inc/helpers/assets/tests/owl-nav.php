<?php
/**
 * Owl Nav test
 */

function uncode_page_require_asset_owlnav( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_carousel_nav', false ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_carousel_nav' ) !== false ) {
			return true;
		}
	}

	return false;
}