<?php
/**
 * Collapse test
 */

function uncode_page_require_asset_collapse( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_collapse', false ) ) {
		return true;
	}

	// Required by the Accordion VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_accordion_tab' ) !== false ) {
			return true;
		}
	}

	return false;
}
