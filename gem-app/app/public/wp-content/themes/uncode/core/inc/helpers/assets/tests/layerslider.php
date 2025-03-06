<?php
/**
 * Layerslider test
 */

function uncode_page_require_asset_layerslider( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_layerslider', false ) ) {
		return true;
	}

	if ( defined( 'LS_PLUGIN_VERSION' ) ) {
		return true;
	}

	return false;
}
