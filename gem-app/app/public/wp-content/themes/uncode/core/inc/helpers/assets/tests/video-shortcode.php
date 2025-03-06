<?php
/**
 * Video shortcode test
 */

function uncode_page_require_asset_video_shortcode( $content_array ) {
	global $uncode_check_asset;

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[video' ) !== false ) {
			$uncode_check_asset['mediaelement'] = true;

			return;
		}
	}
}
