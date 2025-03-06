<?php
/**
 * Breadcrumbs test
 */

function uncode_page_require_asset_breadcrumbs( $content_array ) {
	global $uncode_post_data;

	if ( apply_filters( 'uncode_enqueue_breadcrumbs', false ) ) {
		return true;
	}

	if ( uncode_post_data_is_singular() ) {
		$generic_breadcrumb = ot_get_option('_uncode_' . $uncode_post_data['post_type']  . '_breadcrumb');
		$page_breadcrumb    = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_breadcrumb', true );

		if ($page_breadcrumb === '') {
			$show_breadcrumb = $generic_breadcrumb === 'off' ? false : true;
		} else {
			$show_breadcrumb = $page_breadcrumb === 'off' ? false : true;
		}

		if ( $show_breadcrumb ) {
			return true;
		}
	} else if ( uncode_post_data_is_archive() || uncode_post_data_is_post_type_archive() ) {
		if ( isset( $uncode_post_data['post_type'] ) ) {
			$generic_breadcrumb = ot_get_option('_uncode_' . $uncode_post_data['post_type'] . '_breadcrumb');
			$show_breadcrumb    = $generic_breadcrumb === 'off' ? false : true;

			if ($show_breadcrumb) {
				return true;
			}
		}
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_breadcrumbs' ) !== false ) {
			return true;
		}
	}

	return false;
}
