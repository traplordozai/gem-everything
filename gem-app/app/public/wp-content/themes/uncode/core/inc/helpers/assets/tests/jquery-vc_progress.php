<?php
/**
 * VC Progress Bar test
 */

function uncode_page_require_asset_jquery_vc_progress( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_jquery_vc_progress_bar', false ) ) {
		return true;
	}

	// We require VC Progress Bar for the Progress Bar VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_progress_bar' ) !== false ) {
			return true;
		}
	}

	return false;
}
