<?php
/**
 * jQuery Full Page test
 */

function uncode_page_require_asset_jquery_fullpage( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;

	if ( apply_filters( 'uncode_enqueue_jquery_fullpage', false ) ) {
		return true;
	}

	if ( uncode_post_data_is_singular() ) {
		if ( isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) ) {
			$page_scroll = get_post_meta( $uncode_post_data['ID'], '_uncode_page_scroll', true );

			if ( $page_scroll === 'slide' ) {
				return true;
			} else if ( $page_scroll === 'on' ) {
				$snap_scroll = get_post_meta( $uncode_post_data['ID'], '_uncode_scroll_snap', true );

				if ( $snap_scroll === 'on' ) {
					return true;
				} else {
					$uncode_check_asset['onepage'] = true; // This is a simple OnePage
				}
			}
		}
	}

	return false;
}
