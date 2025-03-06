<?php
/**
 * Star Rating test
 */

function uncode_page_require_asset_star_rating( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_star_rating', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_star_rating' ) !== false || strpos( $content, '[vc_single_image' ) !== false || strpos( $content, '[vc_gallery' ) !== false ) {
			return true;
		}
	}

	return false;
}
