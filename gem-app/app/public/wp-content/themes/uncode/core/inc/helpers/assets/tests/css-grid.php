<?php
/**
 * CSS-Grid test
 */

function uncode_page_require_asset_css_grid( $content_array ) {
	global $uncode_check_asset;

	if ( apply_filters( 'uncode_enqueue_css_grid', false ) ) {
		$uncode_check_asset['cssgrid'] = true;
		$uncode_check_asset['cssgrid_js'] = true;
	}

	foreach ( $content_array as $content ) {
		// CSS Grids are activated by this property in uncode_index/vc_gallery
		if ( strpos( $content, 'type="css_grid"' ) !== false ) {
			$uncode_check_asset['cssgrid'] = true;
		}

		// Check if index has pagination/filtering/load more
		if ( strpos( $content, 'infinite="yes"' ) !== false || strpos( $content, 'pagination="yes"' ) !== false || strpos( $content, 'filtering="yes"' ) !== false ) {
			$shortcode_matches = array();

			if ( strpos( $content, '[uncode_index' ) !== false ) {
				$regex = '/\[uncode_index(.*?)\]/';
				preg_match_all( $regex, $content, $uncode_indexes, PREG_SET_ORDER );
				$shortcode_matches = array_merge( $shortcode_matches, $uncode_indexes );
			}

			if ( strpos( $content, '[vc_gallery' ) !== false ) {
				$regex = '/\[vc_gallery(.*?)\]/';
				preg_match_all( $regex, $content, $vc_galleries, PREG_SET_ORDER );
				$shortcode_matches = array_merge( $shortcode_matches, $vc_galleries );
			}

			foreach ( $shortcode_matches as $key => $shortcode_match ) {
				if ( isset( $uncode_check_asset['cssgrid_js'] ) ) {
					break;
				}

				if ( is_array( $shortcode_match ) && isset( $shortcode_match[0] ) ) {
					if ( strpos( $shortcode_match[0], 'infinite="yes"' ) !== false ) {
						$uncode_check_asset['cssgrid_js'] = true;
						$uncode_check_asset['gallery_utils'] = true;
					}

					if ( strpos( $shortcode_match[0], 'pagination="yes"' ) !== false ) {
						$uncode_check_asset['cssgrid_js'] = true;
						$uncode_check_asset['gallery_utils'] = true;
					}

					if ( strpos( $shortcode_match[0], 'filtering="yes"' ) !== false ) {
						$uncode_check_asset['cssgrid_js'] = true;
						$uncode_check_asset['gallery_utils'] = true;
					}
				}
			}
		}
	}

	return false;
}
