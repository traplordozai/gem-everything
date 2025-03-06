<?php
/**
 * VC Chart test
 */

function uncode_page_require_asset_jquery_vc_chart( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_jquery_vc_chart', false ) ) {
		return true;
	}

	// We require VC Chart for the Pie Chart VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_pie' ) !== false ) {
			return true;
		}
	}

	return false;
}
