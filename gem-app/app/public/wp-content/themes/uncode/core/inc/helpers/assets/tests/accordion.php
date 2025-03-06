<?php
/**
 * Accordion test
 */

function uncode_page_require_asset_accordion( $content_array ) {
	GLOBAL $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_accordion', false ) ) {
		return true;
	}

	// Required by the Accordion VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_accordion' ) !== false ) {
			return true;
		}
	}

	return false;
}
