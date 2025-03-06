<?php
/**
 * Vivus test
 */

function uncode_page_require_asset_vivus( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_vivus', false ) ) {
		return true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'icon_image' ) !== false ) {
			$regex_attr = '/icon_image=\"(.*?)\"/';
			preg_match_all( $regex_attr, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if ( is_array( $value ) && isset( $value[1] ) && $value[1] ) {
					$media_attributes = uncode_get_media_info( $value[1] );

					if ( isset( $media_attributes->animated_svg ) && $media_attributes->animated_svg === '1' ) {
						return true;
					}
				}
			}
		}
	}

	return false;
}
