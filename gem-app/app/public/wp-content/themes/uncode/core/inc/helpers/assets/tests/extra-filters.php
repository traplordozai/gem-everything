<?php
/**
 * Extra filters test
 */

function uncode_page_require_asset_extra_filters( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_extra_filters', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'show_extra_filters="yes"' ) !== false || strpos( $content, 'filter_mobile_wrapper="yes"' ) !== false || strpos( $content, 'filter_mobile_dropdown="yes"' ) !== false ) {
			return true;
		}
	}

	return false;
}
