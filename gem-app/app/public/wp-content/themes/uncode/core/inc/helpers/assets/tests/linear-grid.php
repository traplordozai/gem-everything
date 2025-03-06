<?php
/**
 * Linear Grid test
 */

function uncode_page_require_asset_linear_grid( $content_array ) {
	global $uncode_check_asset;

    if ( apply_filters( 'uncode_enqueue_linear_grid', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, ' type="linear"' ) !== false || strpos( $content, 'index_type="linear"' ) !== false ) {
            $uncode_check_asset['gallery_utils'] = true;
			return true;
		}
	}

	return false;
}