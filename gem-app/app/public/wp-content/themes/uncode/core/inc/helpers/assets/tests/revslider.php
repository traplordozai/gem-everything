<?php
/**
 * Revslider test
 */

function uncode_page_require_asset_revslider( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_revslider', false ) ) {
		return true;
	}

	if ( defined( 'RS_REVISION' ) ) {
		return true;
	}

	return false;
}
