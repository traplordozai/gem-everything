<?php
/**
 * jQuery Bigtext test
 */

function uncode_page_require_asset_jquery_bigtext( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_jquery_bigtext', false ) ) {
		return true;
	}

	// Big text is activated when a module has text_size="bigtext", etc
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '="bigtext"' ) !== false ) {
			return true;
		}
	}

	// The "bigtext" size can be selected also in the basic header title
	if ( uncode_post_data_is_singular() ) {
		// Singular
		$header_type = get_post_meta( $uncode_post_data['ID'], '_uncode_header_type', true );

		if ( $header_type === 'header_basic' ) {
			$header_title_size = get_post_meta( $uncode_post_data['ID'], '_uncode_header_title_size', true );

			if ( $header_title_size === 'bigtext' ) {
				return true;
			}
		} else if ( ! $header_type ) {
			$header_type = ot_get_option('_uncode_' . $uncode_post_data['post_type'] . '_header');

			if ( $header_type === 'header_basic' ) {
				$header_title_size = ot_get_option('_uncode_' . $uncode_post_data['post_type'] . '_header_title_size');

				if ( $header_title_size === 'bigtext' ) {
					return true;
				}
			}
		}
	} else if ( uncode_post_data_is_archive() || uncode_post_data_is_post_type_archive() ) {
		// Archives
		if ( isset( $uncode_post_data['post_type'] ) && $uncode_post_data['post_type'] ) {
			$index       = $uncode_post_data['post_type'];
			$header_type = ot_get_option('_uncode_' . $index . '_index_header');

			if ( $header_type === 'header_basic' ) {
				$header_title_size = ot_get_option('_uncode_' . $uncode_post_data['post_type'] . '_index_header_title_size');

				if ( $header_title_size === 'bigtext' ) {
					return true;
				}
			}
		}
	} else if ( uncode_post_data_is_home() ) {
		$header_type = ot_get_option( '_uncode_post_index_header' );

		if ( $header_type === 'header_basic' ) {
			$header_title_size = ot_get_option('_uncode_post_index_header_title_size');

			if ( $header_title_size === 'bigtext' ) {
				return true;
			}
		}
	} else if ( uncode_post_data_is_404() ) {
		// 404
		$header_type = ot_get_option('_uncode_404_header');

		if ( $header_type === 'header_basic' ) {
			$header_title_size = ot_get_option('_uncode_404_header_title_size');

			if ( $header_title_size === 'bigtext' ) {
				return true;
			}
		} else if ( $header_type === 'none' ) {
			return true;
		}
	} else if ( uncode_post_data_is_search() ) {
		// Search
		$header_type = ot_get_option('_uncode_search_index_header');

		if ( $header_type === 'header_basic' ) {
			$header_title_size = ot_get_option('_uncode_search_index_header_title_size');

			if ( $header_title_size === 'bigtext' ) {
				return true;
			}
		}
	}

	return false;
}
