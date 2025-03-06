<?php
/**
 * Single Media test
 */

function uncode_page_require_asset_single_media( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_single_media', false ) ) {
		return true;
	}

	// Required by the Single Media and Author VC modules
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_single_image' ) !== false ) {
			return true;
		}

		if ( strpos( $content, '[uncode_author_profile' ) !== false ) {
			return true;
		}
	}

	return false;
}
