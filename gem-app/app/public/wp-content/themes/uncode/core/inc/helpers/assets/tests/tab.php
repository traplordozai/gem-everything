<?php
/**
 * Tab test
 */

function uncode_page_require_asset_tab( $content_array ) {
	GLOBAL $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_tab', false ) ) {
		return true;
	}

	// Always include TAB in single products
	if ( uncode_post_data_is_singular() ) {
		$with_builder = false;
		if ( isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) && $uncode_post_data['post_type'] === 'product' ) {
			return true;
		}
	}

	// Required by the Tabs VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_tab' ) !== false ) {
			return true;
		}
	}

	return false;
}
