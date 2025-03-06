<?php
/**
 * Author Profile test
 */

function uncode_page_require_asset_author_profile( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_author_profile', false ) ) {
		return true;
	}

	// Required by the Author VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_author_profile' ) !== false ) {
			return true;
		}
	}

	return false;
}
