<?php
/**
 * Lottie test
 */

function uncode_page_require_asset_lottie( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_lottie', false ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_lottie' ) !== false ) {
			return true;
		}
	}

	return false;
}

function uncode_page_require_asset_lottie_interactivity( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_lottie', false ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
        if ( preg_match( '/\[uncode_lottie([^\]]*)trigger=\"(.*)\"/', $content ) ) {
			return true;
		}
	}

	return false;
}
