<?php
/**
 * CF7 test
 */

function uncode_page_require_asset_cf7( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_cf7', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[contact-form-7' ) !== false ) {
			return true;
		}
	}

	return false;
}
