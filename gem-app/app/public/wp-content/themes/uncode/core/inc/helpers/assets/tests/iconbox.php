<?php
/**
 * Iconbox test
 */

function uncode_page_require_asset_iconbox( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_iconbox', false ) ) {
		return true;
	}

	$footer_social = ot_get_option('_uncode_footer_social');
	if ($footer_social !== 'off') {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_icon' ) !== false ) {
			return true;
		}

		if ( strpos( $content, '[uncode_socials' ) !== false ) {
			return true;
		}
	}

	return false;
}
