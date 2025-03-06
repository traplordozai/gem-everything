<?php
/**
 * Isotope/Packery/Cells-By-Row test
 */

function uncode_page_require_asset_lightgallery( $content_array ) {
	global $uncode_post_data;

	$lg_plugins = array();

	if ( apply_filters( 'uncode_enqueue_lightgallery_plugins', false ) ) {
		return ['share','hash','thumb'];
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_gallery' ) === false && strpos( $content, '[uncode_index' ) === false && strpos( $content, '[vc_single_image' ) === false && strpos( $content, '[uncode_single_product_gallery' ) === false && strpos( $content, '[vc_button' ) === false && strpos( $content, '[vc_icon' ) === false ) {
			continue;
		}

		if ( strpos( $content, 'lbox_social="yes"' ) !== false && ! in_array( 'share', $lg_plugins )  ) {
			$lg_plugins['share'] = true;
		}

		if ( strpos( $content, 'lbox_full="yes"' ) !== false && ! in_array( 'fullscreen', $lg_plugins ) ) {
			$lg_plugins['fullscreen'] = true;
		}

		if ( ( strpos( $content, 'lbox_deep="yes"' ) !== false || strpos( $content, '[vc_gallery ' ) !== false ) && ! in_array( 'hash', $lg_plugins ) ) {
			$lg_plugins['hash'] = true;
		}

	}

	return $lg_plugins;
}
