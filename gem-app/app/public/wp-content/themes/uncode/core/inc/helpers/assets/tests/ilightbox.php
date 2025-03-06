<?php
/**
 * iLightBox test
 */

function uncode_page_require_asset_ilightbox( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_ilightbox', false ) ) {
		return true;
	}

	// Always include lightbox in single products
	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') !== 'on' && uncode_post_data_is_singular() ) {
		if ( isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) && $uncode_post_data['post_type'] === 'product' ) {
			return true;
		}
	}

	foreach ( $content_array as $content ) {
		// Check if lightbox is active in vc_single_image, vc_button and vc_icon
		if ( strpos( $content, 'media_lightbox="' ) !== false ) {
			return true;
		}

		// Check if lightbox is active in uncode_index
		if ( strpos( $content, '|lightbox' ) !== false || strpos( $content, 'lightbox|' ) !== false ) {
			return true;
		}

		// Check if lightbox is active in vc_gallery
		if ( strpos( $content, '[vc_gallery' ) !== false ) {
			$regex = '/\[vc_gallery(.*?)\]/';
			preg_match_all( $regex, $content, $vc_galleries, PREG_SET_ORDER );

			foreach ( $vc_galleries as $key => $vc_gallery ) {
				if ( is_array( $vc_gallery ) &&  isset( $vc_gallery[0] ) ) {
					$regex_attr = '/media_items=\"(.*?)\"/';
					preg_match_all( $regex_attr, $vc_gallery[0], $media_items_values, PREG_SET_ORDER );

					$has_lightbox = true;

					foreach ( $media_items_values as $key => $media_items_value ) {
						if ( is_array( $media_items_value ) && isset( $media_items_value[1] ) ) {
							if ( strpos( $media_items_value[1], 'lightbox' ) !== false ) {
								return true;
							} else if ( strpos( $media_items_value[1], 'media|custom_link' ) !== false || strpos( $media_items_value[1], 'media|nolink' ) !== false || strpos( $media_items_value[1], 'media' ) === false ) {
								$has_lightbox = false;
							}
						}
					}

					if ( $has_lightbox ) {
						return true;
					}
				}
			}
		}
	}

	return false;
}
