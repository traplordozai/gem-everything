<?php
/**
 * BG Changer test
 */

function uncode_page_require_asset_bg_changer( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_bg_changer', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'changer_back_color="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
