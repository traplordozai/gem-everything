<?php
/**
 * Widgets test
 */

function uncode_page_require_asset_widgets( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_widgets', false ) ) {
		return true;
	}

	if ( uncode_post_data_is_singular() ) {
		$specific_sidebar = get_post_meta( $uncode_post_data['ID'], '_uncode_active_sidebar', true );

		if ( $specific_sidebar === 'on' ) {
			$sidebar_name = get_post_meta( $uncode_post_data['ID'], '_uncode_sidebar', true );

			if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
				return true;
			}
		} else if ( $specific_sidebar !== 'off' ) {
			$generic_sidebar = ot_get_option('_uncode_' . $uncode_post_data['post_type']  . '_activate_sidebar');

			if ( $generic_sidebar === 'on' ) {
				$sidebar_name = ot_get_option('_uncode_' . $uncode_post_data['post_type']  . '_sidebar');

				if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
					return true;
				}
			}
		}
	} else if ( uncode_post_data_is_archive() || uncode_post_data_is_post_type_archive() ) {
		if ( isset( $uncode_post_data['post_type'] ) ) {
			$generic_sidebar = ot_get_option('_uncode_' . $uncode_post_data['post_type']  . '_index_activate_sidebar');
			if ( $generic_sidebar === 'on' ) {
				$sidebar_name = ot_get_option('_uncode_' . $uncode_post_data['post_type']  . '_index_sidebar');

				if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
					return true;
				}
			}
		}

		if ( uncode_post_data_is_author() ) {
			$generic_sidebar = ot_get_option('_uncode_author_index_activate_sidebar');

			if ( $generic_sidebar === 'on' ) {
				$sidebar_name = ot_get_option('_uncode_author_index_sidebar');

				if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
					return true;
				}
			}
		}
	} else if ( uncode_post_data_is_home() ) {
		$generic_sidebar = ot_get_option('_uncode_post_index_activate_sidebar');

		if ( $generic_sidebar === 'on' ) {
			$sidebar_name = ot_get_option('_uncode_post_index_sidebar');

			if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
				return true;
			}
		}
	} else if ( uncode_post_data_is_search() ) {
		$generic_sidebar = ot_get_option('_uncode_search_index_activate_sidebar');

		if ( $generic_sidebar === 'on' ) {
			$sidebar_name = ot_get_option('_uncode_search_index_sidebar');

			if ( $sidebar_name && is_active_sidebar( $sidebar_name ) ) {
				return true;
			}
		}
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_widget' ) !== false || strpos( $content, '[uncode_woocommerce_widget' ) !== false || strpos( $content, '[uncode_widget_' ) !== false || strpos( $content, '[vc_wp_' ) !== false || strpos( $content, '[vc_widget_sidebar' ) !== false || strpos( $content, '[uncode_ajax_' ) !== false ) {
			return true;
		}
	}

	return false;
}
