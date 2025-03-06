<?php
/**
 * Share test
 */

function uncode_page_require_asset_share( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_share', false ) ) {
		return true;
	}

	// Check share option in single pages
	if ( uncode_post_data_is_singular() ) {
		if ( isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) ) {
			$content_type = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_select_content', true );

			if ( $content_type === 'default' || $content_type === '' ) {
				$page_show_share = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_share', true );

				if ( $page_show_share === 'on' ) {
					return true;
				} else if ( $page_show_share === '' ) {
					$generic_show_share = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_share' );
					if ( $generic_show_share !== '' && $generic_show_share !== 'off' ) {
						return true;
					}
				}
			}
		}
	}

	// Required by the Share VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_share' ) !== false ) {
			return true;
		}
	}

	// Wishlist page
	if ( class_exists( 'YITH_WCWL' ) ) {
		$wishlist_page = absint( get_option( 'yith_wcwl_wishlist_page_id' ) );

		if ( $wishlist_page > 0 ) {
			if ( is_page( $wishlist_page ) ) {
				return true;
			}
		}
	}

	return false;
}
