<?php
/**
 * Uncode Index (Posts Module) CSS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Generate the CSS for the module
 */
function uncode_get_dynamic_colors_css_for_shortcode_uncode_index( $shortcode, $custom_color_keys ) {
	$accepted_keys = array(
		'index_back_color'      => array( 'bg' ),
		'filter_back_color'     => array( 'bg' ),
		'infinite_button_color' => array( 'button' ),
		'footer_back_color'     => array( 'bg' ),
	);

	$css = '';

	foreach ( $custom_color_keys as $custom_color_key ) {
		if ( ! array_key_exists( $custom_color_key, $accepted_keys ) ) {
			continue;
		}

		$css_value = uncode_get_dynamic_color_attr_data( $shortcode, $custom_color_key, $accepted_keys[$custom_color_key] );

		if ( $css_value ) {
			$css .= $css_value;
		}
	}

	return $css;
}

/**
 * Generate the CSS for the sticky scroll module (both for post index and media gallery as well)
 */
function uncode_get_sticky_scroll_css_for_shortcode_index( $shortcode_data ) {

	global $row_sticky_columns, $main_layout_width;

	$css = '';
	$id = $shortcode_data['id'];
	$lg = isset( $shortcode_data['lg'] ) ? $shortcode_data['lg'] : 3;
	$md = isset( $shortcode_data['md'] ) ? $shortcode_data['md'] : 3;
	$sm = isset( $shortcode_data['sm'] ) ? $shortcode_data['sm'] : 1;

	$vmenu_width = 0;

	$body_border = ot_get_option('_uncode_body_border');
	$body_border = ($body_border !== '' && $body_border !== 0) ? $body_border : 0;
	$body_border_mobile = ($body_border !== '' && $body_border !== 0) ? 9 : 0;

	$menutype = ot_get_option('_uncode_headers');
	if ( $menutype === 'vmenu' ) {
		$vmenu_width = ot_get_option('_uncode_vmenu_width');

		if ($vmenu_width == '') {
			$vmenu_width = '200';
		}
	}

	$extra_pixel = $body_border + $vmenu_width;

	$css .= '@media (min-width: 960px) { .vc_row .hor-scroll-' . $shortcode_data['id'] . ':not(.hor-scroll-relative) .tmb { width: calc(' . 100/intval( $lg ) . 'vw - ' . $extra_pixel . 'px ) } }';
	$css .= '@media (min-width: 960px) { .vc_row .limit-width .hor-scroll-' . $shortcode_data['id'] . ':not(.hor-scroll-relative) .tmb { width: calc( ' . $main_layout_width . ' / ' . intval( $lg ) . ' - ' . $extra_pixel . 'px ) } }';

	$css .= '@media (min-width: 570px) and (max-width: 959px) { .vc_row .hor-scroll-' . $shortcode_data['id'] . ':not(.hor-scroll-relative) .tmb { width: calc(' . 100/intval( $md ) . 'vw - ' . $body_border_mobile . 'px ) } }';
	$css .= '@media (max-width: 569px) { .vc_row .hor-scroll-' . $shortcode_data['id'] . ':not(.hor-scroll-relative) .tmb { width: calc(' . 100/intval( $sm ) . 'vw - ' . $body_border_mobile . 'px ) } }';

	return $css;
}

/**
 * Generate the CSS for the css grids module (both for post index and media gallery as well)
 */
function uncode_get_css_grids_css_for_shortcode_index( $shortcode_data ) {
	$css      = '';
	$id       = $shortcode_data['id'];
	$items    = isset( $shortcode_data['items'] ) ? $shortcode_data['items'] : 4;
	$lg       = isset( $shortcode_data['lg'] ) ? $shortcode_data['lg'] : 1000;
	$lg_items = isset( $shortcode_data['lg_items'] ) ? $shortcode_data['lg_items'] : 3;
	$md       = isset( $shortcode_data['md'] ) ? $shortcode_data['md'] : 600;
	$md_items = isset( $shortcode_data['md_items'] ) ? $shortcode_data['md_items'] : 2;
	$sm       = isset( $shortcode_data['sm'] ) ? $shortcode_data['sm'] : 480;
	$sm_items = isset( $shortcode_data['sm_items'] ) ? $shortcode_data['sm_items'] : 1;

	$css .= '.cssgrid-' . $shortcode_data['id'] . ' .cssgrid-container { grid-template-columns: repeat(' . $items . ', 1fr); }';
	$css .= '@media (max-width: ' . $lg . 'px) { .cssgrid-' . $shortcode_data['id'] . ' .cssgrid-container { grid-template-columns: repeat(' . $lg_items . ', 1fr); } }';
	$css .= '@media (max-width: ' . $md . 'px) { .cssgrid-' . $shortcode_data['id'] . ' .cssgrid-container { grid-template-columns: repeat(' . $md_items . ', 1fr); } }';
	$css .= '@media (max-width: ' . $sm . 'px) { .cssgrid-' . $shortcode_data['id'] . ' .cssgrid-container { grid-template-columns: repeat(' . $sm_items . ', 1fr); } }';

	return $css;
}
