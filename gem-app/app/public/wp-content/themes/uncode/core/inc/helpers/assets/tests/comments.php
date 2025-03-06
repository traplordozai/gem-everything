<?php
/**
 * Comments test
 */

function uncode_page_require_asset_comments( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;

	if ( apply_filters( 'uncode_enqueue_comments', false ) ) {
		return true;
	}

	if ( uncode_post_data_is_singular() ) {
		$show_comments = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_comments' );

		if ( $uncode_post_data['post_type'] === 'product' ) {
			if ( function_exists( 'wc_review_ratings_enabled' ) && wc_review_ratings_enabled() ) {
				return true;
			}
		} else {
			if ( $show_comments === 'on' ) {
				if ( ( comments_open() ) ) {
					if ( get_option( 'thread_comments' ) ) {
						$uncode_check_asset['comment-reply'] = true;
					}

					return true;
				}

				if ( '0' != get_comments_number() ) {
					return true;
				}
			}
		}
	}

	return false;
}
