<?php
/**
 * Google Msps test
 */

function uncode_page_require_asset_gmaps( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_gmaps', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_gmaps' ) !== false ) {
			return true;
		}
	}

	return false;
}
