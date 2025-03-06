<?php
/**
 * VC Custom Fields test
 */

function uncode_page_require_asset_custom_fields( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_custom_fields', false ) ) {
		return true;
	}

	// Required by the Custom Fields VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_custom_fields' ) !== false ) {
			return true;
		}
	}

	return false;
}
