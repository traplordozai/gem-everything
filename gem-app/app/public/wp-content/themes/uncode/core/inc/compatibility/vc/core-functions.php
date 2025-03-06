<?php

/**
 * Get the CSS rules from a string (without selectors)
 */
function uncode_get_custom_inline_css( $css ) {
	$internal_css = '';
	$css          = trim( $css );

	$regex = '/{([^}]*)}/m';
	preg_match_all( $regex, $css, $matches, PREG_SET_ORDER, 0 );

	if ( count( $matches ) ) {
		if ( isset( $matches[0] ) && is_array( $matches[0] ) ) {
			$match = $matches[0];

			if ( isset( $match[1] ) && $match[1] ) {
				$internal_css = $match[1];
			}
		}
	}

	$internal_css = str_replace( '!important', '', $internal_css );

	return $internal_css;
}

/**
 * Re-init some needed globals when we load (update)
 * a shortcode in the frontend editor.
 */
function uncode_setup_vc_frontend_globals() {
	global $register_adaptive_meta, $resize_image_quality;

	$adaptive_images        = ot_get_option('_uncode_adaptive');
	$register_adaptive_meta = ot_get_option('_uncode_adaptive_register_meta') === 'on' ? true : false;
	$dynamic_srcset_active  = $adaptive_images === 'off' && ot_get_option('_uncode_dynamic_srcset') === 'on' ? true : false;

	if ( $dynamic_srcset_active ) {
		$register_adaptive_meta = true;
	}

	$resize_image_quality = ot_get_option('_uncode_adaptive_quality');
}
add_action( 'vc_load_shortcode', 'uncode_setup_vc_frontend_globals' );

/**
 * Paginate medias.
 */
function uncode_vc_gallery_paginate_medias( $medias, $page, $preloaded_items, $loading_items ) {
	$max_pages = uncode_vc_gallery_calculate_max_pages( $medias, $preloaded_items, $loading_items );

	if ( $page === 1 ) {
		$medias = array_slice( $medias, 0, $preloaded_items );
	} else if ( $page > 1 ) {
		$offset = $preloaded_items + ( ( $page - 1 ) * $loading_items ) - $loading_items;
		$medias = array_slice( $medias, $offset, $loading_items );
	}

	return array(
		'max_pages' => $max_pages,
		'medias'    => $medias
	);
}

/**
 * Calculates the maximum number of pages.
 */
function uncode_vc_gallery_calculate_max_pages( $medias, $preloaded_items, $loading_items ) {
	$total_medias = count( $medias );
	$max_pages = 1;

	if ( $preloaded_items >= $total_medias ) {
		$max_pages = 1;
	} else {
		$count_after_preload = $total_medias - $preloaded_items;

		while ( $count_after_preload > 0 ) {
			$count_after_preload -= $loading_items;
			$max_pages++;
		}
	}

	return $max_pages;
}
