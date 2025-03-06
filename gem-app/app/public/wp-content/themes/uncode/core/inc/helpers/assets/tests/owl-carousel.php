<?php
/**
 * Owl Carousel test
 */

function uncode_page_require_asset_owl_carousel( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;

	if ( apply_filters( 'uncode_enqueue_owl_carousel', false ) ) {
		return true;
	}

	// Always include owl in pages with Quick Views
	if ( isset( $uncode_post_data['has_quick_view'] ) && $uncode_post_data['has_quick_view'] ) {
		$uncode_check_asset['ilightbox'] = true;
		return true;
	}

	if ( uncode_post_data_is_singular() ) {
		// Always include owl in single products
		if ( $uncode_post_data['post_type'] === 'product' ) {
			return true;
		}
	}

	foreach ( $content_array as $content ) {
		// Sliders are carousels
		if ( strpos( $content, '[uncode_slider' ) !== false ) {
			return true;
		}

		// Carousels are activated by this property in uncode_index
		if ( strpos( $content, 'index_type="carousel"' ) !== false ) {
			return true;
		}

		// Carousels are activated by this property in vc_gallery
		if ( strpos( $content, 'type="carousel"' ) !== false ) {
			return true;
		}
	}

	return false;
}
