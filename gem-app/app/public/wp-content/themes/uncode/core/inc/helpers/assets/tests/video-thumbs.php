<?php
/**
 * Video Thumbs test
 */

function uncode_page_require_asset_video_thumbs( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_video_thumbs', false ) ) {
		return true;
	}

	// Required by the Single Media and Author VC modules
	foreach ( $content_array as $content ) {
		if ( strpos( $content, ' advanced_videos="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
