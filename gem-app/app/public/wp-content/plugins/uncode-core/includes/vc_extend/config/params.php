<?php
/**
 * Params functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Units
 */
function uncode_core_vc_params_get_units() {
	$units = array(
		'1/12' => '1',
		'2/12' => '2',
		'3/12' => '3',
		'4/12' => '4',
		'5/12' => '5',
		'6/12' => '6',
		'7/12' => '7',
		'8/12' => '8',
		'9/12' => '9',
		'10/12' => '10',
		'11/12' => '11',
		'12/12' => '12',
		'1/5*' => '15',
	);

	return $units;
}

/**
 * Button sizes
 */
function uncode_core_vc_params_get_button_sizes() {
	$size_arr = array(
		esc_html__('Standard', 'uncode-core') => '',
		esc_html__('Small', 'uncode-core') => 'btn-sm',
		esc_html__('Large', 'uncode-core') => 'btn-lg',
		esc_html__('Extra-Large', 'uncode-core') => 'btn-xl',
		esc_html__('Button link', 'uncode-core') => 'btn-link',
		esc_html__('Standard link', 'uncode-core') => 'link',
	);

	return $size_arr;
}

/**
 * Icon sizes
 */
function uncode_core_vc_params_get_icon_sizes() {
	$icon_sizes = array(
		esc_html__('Standard', 'uncode-core') => '',
		esc_html__('2x', 'uncode-core') => 'fa-2x',
		esc_html__('3x', 'uncode-core') => 'fa-3x',
		esc_html__('4x', 'uncode-core') => 'fa-4x',
		esc_html__('5x', 'uncode-core') => 'fa-5x',
	);

	return $icon_sizes;
}

/**
 * Heading semantic values
 */
function uncode_core_vc_params_get_heading_semantic_values() {
	$heading_semantic = array(
		esc_html__('h1', 'uncode-core') => 'h1',
		esc_html__('h2', 'uncode-core') => 'h2',
		esc_html__('h3', 'uncode-core') => 'h3',
		esc_html__('h4', 'uncode-core') => 'h4',
		esc_html__('h5', 'uncode-core') => 'h5',
		esc_html__('h6', 'uncode-core') => 'h6',
		esc_html__('p', 'uncode-core') => 'p',
		esc_html__('div', 'uncode-core') => 'div'
	);

	return $heading_semantic;
}

/**
 * Heading font sizes
 */
function uncode_core_vc_params_get_heading_font_sizes() {
	$heading_size = array(
		esc_html__('Default', 'uncode-core') => '',
		esc_html__('h1', 'uncode-core') => 'h1',
		esc_html__('h2', 'uncode-core') => 'h2',
		esc_html__('h3', 'uncode-core') => 'h3',
		esc_html__('h4', 'uncode-core') => 'h4',
		esc_html__('h5', 'uncode-core') => 'h5',
		esc_html__('h6', 'uncode-core') => 'h6',
	);

	$font_sizes = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_sizes') : array();

	if (!empty($font_sizes)) {
		foreach ($font_sizes as $key => $value) {
			$heading_size[$value['title']] = $value['_uncode_heading_font_size_unique_id'];
		}
	}

	$heading_size[esc_html__('BigText', 'uncode-core')] = 'bigtext';

	return $heading_size;
}

/**
 * Heading font heights
 */
function uncode_core_vc_params_get_heading_font_heights() {
	$font_heights = (function_exists('ot_get_option')) ? ot_get_option('_uncode_heading_font_heights') : array();
	$heading_height = array(
		esc_html__('Default', 'uncode-core') => '',
	);
	if (!empty($font_heights)) {
		foreach ($font_heights as $key => $value) {
			$heading_height[$value['title']] = $value['_uncode_heading_font_height_unique_id'];
		}
	}

	return $heading_height;
}

/**
 * Heading font weights
 */
function uncode_core_vc_params_get_heading_font_weights() {
	$heading_weight = array(
		esc_html__('Default', 'uncode-core') => '',
		esc_html__('100', 'uncode-core') => 100,
		esc_html__('200', 'uncode-core') => 200,
		esc_html__('300', 'uncode-core') => 300,
		esc_html__('400', 'uncode-core') => 400,
		esc_html__('500', 'uncode-core') => 500,
		esc_html__('600', 'uncode-core') => 600,
		esc_html__('700', 'uncode-core') => 700,
		esc_html__('800', 'uncode-core') => 800,
		esc_html__('900', 'uncode-core') => 900,
	);

	return $heading_weight;
}

/**
 * Button font weights
 */
function uncode_core_vc_params_get_button_font_weights() {
	$button_weight = array(
		esc_html__('100', 'uncode-core') => 100,
		esc_html__('200', 'uncode-core') => 200,
		esc_html__('300', 'uncode-core') => 300,
		esc_html__('400', 'uncode-core') => 400,
		esc_html__('500', 'uncode-core') => 500,
		esc_html__('600', 'uncode-core') => 600,
		esc_html__('700', 'uncode-core') => 700,
		esc_html__('800', 'uncode-core') => 800,
		esc_html__('900', 'uncode-core') => 900,
	);

	return $button_weight;
}

/**
 * Get target styles
 */
function uncode_core_vc_params_get_target_styles() {
	$target_arr = array(
		esc_html__('Same window', 'uncode-core') => '_self',
		esc_html__('New window', 'uncode-core') => "_blank"
	);

	return $target_arr;
}

/**
 * Get border styles
 */
function uncode_core_vc_params_get_border_styles() {
	$border_style = array(
		esc_html__('None', 'uncode-core') => '',
		esc_html__('Solid', 'uncode-core') => 'solid',
		esc_html__('Dotted', 'uncode-core') => 'dotted',
		esc_html__('Dashed', 'uncode-core') => 'dashed',
		esc_html__('Double', 'uncode-core') => 'double',
		esc_html__('Groove', 'uncode-core') => 'groove',
		esc_html__('Ridge', 'uncode-core') => 'ridge',
		esc_html__('Inset', 'uncode-core') => 'inset',
		esc_html__('Outset', 'uncode-core') => 'outset',
		esc_html__('Initial', 'uncode-core') => 'initial',
		esc_html__('Inherit', 'uncode-core') => 'inherit',
	);

	return $border_style;
}

/**
 * Get CSS animation styles
 */
function uncode_core_vc_params_get_css_animation( $with_parallax = false ) {
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => esc_html__('Animation', 'uncode-core') ,
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Opacity', 'uncode-core') => 'alpha-anim',
			esc_html__('Zoom in', 'uncode-core') => 'zoom-in',
			esc_html__('Zoom out', 'uncode-core') => 'zoom-out',
			esc_html__('Top to bottom', 'uncode-core') => 'top-t-bottom',
			esc_html__('Bottom to top', 'uncode-core') => 'bottom-t-top',
			esc_html__('Left to right', 'uncode-core') => 'left-t-right',
			esc_html__('Right to left', 'uncode-core') => 'right-t-left',
		) ,
		'group' => esc_html__('Animation', 'uncode-core') ,
		'description' => esc_html__('Specify the entrance animation.', 'uncode-core')
	);

	if ( $with_parallax ) {
		$add_css_animation['value'][esc_html__('Parallax', 'uncode-core')] = 'parallax';
	}

	return $add_css_animation;
}

/**
 * Get CSS animation delay
 */
function uncode_core_vc_params_get_css_animation_delay() {
	$delay = array(
		'type' => 'dropdown',
		'heading' => esc_html__('Animation delay', 'uncode-core') ,
		'param_name' => 'animation_delay',
		'value' => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('ms 100', 'uncode-core') => 100,
			esc_html__('ms 200', 'uncode-core') => 200,
			esc_html__('ms 300', 'uncode-core') => 300,
			esc_html__('ms 400', 'uncode-core') => 400,
			esc_html__('ms 500', 'uncode-core') => 500,
			esc_html__('ms 600', 'uncode-core') => 600,
			esc_html__('ms 700', 'uncode-core') => 700,
			esc_html__('ms 800', 'uncode-core') => 800,
			esc_html__('ms 900', 'uncode-core') => 900,
			esc_html__('ms 1000', 'uncode-core') => 1000,
			esc_html__('ms 1100', 'uncode-core') => 1100,
			esc_html__('ms 1200', 'uncode-core') => 1200,
			esc_html__('ms 1300', 'uncode-core') => 1300,
			esc_html__('ms 1400', 'uncode-core') => 1400,
			esc_html__('ms 1500', 'uncode-core') => 1500,
			esc_html__('ms 1600', 'uncode-core') => 1600,
			esc_html__('ms 1700', 'uncode-core') => 1700,
			esc_html__('ms 1800', 'uncode-core') => 1800,
			esc_html__('ms 1900', 'uncode-core') => 1900,
			esc_html__('ms 2000', 'uncode-core') => 2000,
		) ,
		'group' => esc_html__('Animation', 'uncode-core') ,
		'description' => esc_html__('Specify the entrance animation delay in milliseconds.', 'uncode-core') ,
		'admin_label' => true,
		'dependency' => array(
			'element' => 'css_animation',
			'value' => array(
				'alpha-anim',
				'zoom-in',
				'zoom-out',
				'top-t-bottom',
				'bottom-t-top',
				'left-t-right',
				'right-t-left',
				'curtain',
				'curtain-words',
				'single-curtain',
				'single-slide',
				'single-slide-opposite',
				'typewriter',
			),
		) ,
	);

	return $delay;
}

/**
 * Get CSS animation speed
 */
function uncode_core_vc_params_get_css_animation_speed() {
	$speed = array(
		'type' => 'dropdown',
		'heading' => esc_html__('Animation speed', 'uncode-core') ,
		'param_name' => 'animation_speed',
		'admin_label' => true,
		'value' => array(
			esc_html__('Default (400)', 'uncode-core') => '',
			esc_html__('ms 100', 'uncode-core') => 100,
			esc_html__('ms 200', 'uncode-core') => 200,
			esc_html__('ms 300', 'uncode-core') => 300,
			esc_html__('ms 400', 'uncode-core') => 400,
			esc_html__('ms 500', 'uncode-core') => 500,
			esc_html__('ms 600', 'uncode-core') => 600,
			esc_html__('ms 700', 'uncode-core') => 700,
			esc_html__('ms 800', 'uncode-core') => 800,
			esc_html__('ms 900', 'uncode-core') => 900,
			esc_html__('ms 1000', 'uncode-core') => 1000,
			esc_html__('ms 1100', 'uncode-core') => 1100,
			esc_html__('ms 1200', 'uncode-core') => 1200,
			esc_html__('ms 1300', 'uncode-core') => 1300,
			esc_html__('ms 1400', 'uncode-core') => 1400,
			esc_html__('ms 1500', 'uncode-core') => 1500,
			esc_html__('ms 1600', 'uncode-core') => 1600,
			esc_html__('ms 1700', 'uncode-core') => 1700,
			esc_html__('ms 1800', 'uncode-core') => 1800,
			esc_html__('ms 1900', 'uncode-core') => 1900,
			esc_html__('ms 2000', 'uncode-core') => 2000,
		) ,
		'group' => esc_html__('Animation', 'uncode-core') ,
		'description' => esc_html__('Specify the entrance animation speed in milliseconds.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'css_animation',
			'value' => array(
				'alpha-anim',
				'zoom-in',
				'zoom-out',
				'top-t-bottom',
				'bottom-t-top',
				'left-t-right',
				'right-t-left',
				'curtain',
				'curtain-words',
				'single-curtain',
				'single-slide',
				'single-slide-opposite',
				'typewriter',
			),
		) ,
	);

	return $speed;
}

/**
 * Get CSS background repeat
 */
function uncode_core_vc_params_get_css_background_repeat() {
	$add_background_repeat = array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background repeat", 'uncode-core') ,
		'description' => wp_kses(__('Define the background repeat. <a href=\'http://www.w3schools.com/cssref/pr_background-repeat.asp\' target=\'_blank\'>Check this for reference</a>', 'uncode-core') , array( 'a' => array( 'href' => array(),'target' => array() ) ) ),
		'param_name' => 'back_repeat',
		'param_holder_class' => 'background-image-settings',
		'value' => array(
			esc_html__('Select...', 'uncode-core') => '',
			esc_html__('No Repeat', 'uncode-core') => 'no-repeat',
			esc_html__('Repeat All', 'uncode-core') => 'repeat',
			esc_html__('Repeat Horizontally', 'uncode-core') => 'repeat-x',
			esc_html__('Repeat Vertically', 'uncode-core') => 'repeat-y',
			esc_html__('Inherit', 'uncode-core') => 'inherit'
		) ,
		'dependency' => array(
			'element' => 'back_image',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Style", 'uncode-core')
	);

	return $add_background_repeat;
}

/**
 * Get CSS background attachment
 */
function uncode_core_vc_params_get_css_background_attachment() {
	$add_background_attachment = array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background Attachment", 'uncode-core') ,
		"description" => wp_kses(__("Define the background attachment. <a href='http://www.w3schools.com/cssref/pr_background-attachment.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_attachment',
		'value' => array(
			esc_html__('Select...', 'uncode-core') => '',
			esc_html__('Fixed', 'uncode-core') => 'fixed',
			esc_html__('Scroll', 'uncode-core') => 'scroll',
			esc_html__('Inherit', 'uncode-core') => 'inherit'
		) ,
		'dependency' => array(
			'element' => 'back_image',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Style", 'uncode-core')
	);

	return $add_background_attachment;
}

/**
 * Get CSS background position
 */
function uncode_core_vc_params_get_css_background_position() {
	$add_background_position = array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background Position", 'uncode-core') ,
		"description" => wp_kses(__("Define the background position. <a href='http://www.w3schools.com/cssref/pr_background-position.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_position',
		'value' => array(
			esc_html__('Select...', 'uncode-core') => '',
			esc_html__('Left Top', 'uncode-core') => 'left top',
			esc_html__('Left Center', 'uncode-core') => 'left center',
			esc_html__('Left Bottom', 'uncode-core') => 'left bottom',
			esc_html__('Center Top', 'uncode-core') => 'center top',
			esc_html__('Center Center', 'uncode-core') => 'center center',
			esc_html__('Center Bottom', 'uncode-core') => 'center bottom',
			esc_html__('Right Top', 'uncode-core') => 'right top',
			esc_html__('Right Center', 'uncode-core') => 'right center',
			esc_html__('Right Bottom', 'uncode-core') => 'right bottom'
		) ,
		'dependency' => array(
			'element' => 'back_image',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Style", 'uncode-core')
	);

	return $add_background_position;
}

/**
 * Get CSS background size
 */
function uncode_core_vc_params_get_css_background_size() {
	$add_background_size = array(
		'type' => 'textfield',
		"heading" => esc_html__("Background Size", 'uncode-core') ,
		"description" => wp_kses(__("Define the background size (Default value is 'cover'). <a href='http://www.w3schools.com/cssref/css3_pr_background-size.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_size',
		'dependency' => array(
			'element' => 'back_image',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Style", 'uncode-core')
	);

	return $add_background_size;
}

/**
 * Get GDPR options
 */
function uncode_core_vc_params_get_gdpr_options() {
	if ( function_exists( 'uncode_privacy_has_consent' ) ) {

		$consent_types = is_array( get_option( 'uncode_privacy_consent_types' ) ) ? get_option( 'uncode_privacy_consent_types' ) : array();
		$type_select = array();
		$type_select[ esc_html__('None', 'uncode-core') ] = '';

		foreach ($consent_types as $type_id => $settings) {
			if ( isset($settings['required']) && $settings['required'] )
				continue;
			$type_select[ esc_html($settings['name']) ] = esc_attr($type_id);
		}

		$gdpr = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Consent ID', 'uncode-core') ,
				'param_name' => 'gdpr_consent_id',
				'value' => $type_select,
				"group" => esc_html__("Consent", 'uncode-core'),
				'description' => esc_html__('Select the consent ID.', 'uncode-core')
			),
			array(
				'type' => 'dropdown',
				"heading" => esc_html__("Logic", 'uncode-core') ,
				'param_name' => 'gdpr_consent_logic',
				"description" => esc_html__("Include or exclude this row according with the consent ID.", 'uncode-core') ,
				"group" => esc_html__("Consent", 'uncode-core'),
				"value" => array(
					esc_html__('Include', 'uncode-core') => 'include',
					esc_html__('Exclude', 'uncode-core') => 'exclude'
				) ,
				"std" => 'include',
				'dependency' => array(
					'element' => 'gdpr_consent_id',
					'not_empty' => true
				)
			),
		);
	} else {
		$gdpr = array();
	}

	return $gdpr;
}

/**
 * Get fonts
 */
function uncode_core_vc_params_get_fonts() {
	$fonts = ( function_exists( 'ot_get_option' ) ) ? ot_get_option( '_uncode_font_groups' ) : array();
	return $fonts;
}

/**
 * Get heading fonts
 */
function uncode_core_vc_params_get_heading_fonts( $fonts ) {
	$heading_font = array(
		esc_html__('Default', 'uncode-core') => '',
	);

	if (isset($fonts) && is_array($fonts)) {
		foreach ($fonts as $key => $value) {
			$heading_font[$value['title']] = $value['_uncode_font_group_unique_id'];
		}
	}

	return $heading_font;
}

/**
 * Get button fonts
 */
function uncode_core_vc_params_get_button_fonts( $fonts ) {
	$button_font = array();

	if (isset($fonts) && is_array($fonts)) {
		foreach ($fonts as $key => $value) {
			$button_font[$value['title']] = $value['_uncode_font_group_unique_id'];
		}
	}

	return $button_font;
}

/**
 * Get font spacing
 */
function uncode_core_vc_params_get_font_spacings() {
	$font_spacings = ( function_exists( 'ot_get_option' ) ) ? ot_get_option( '_uncode_heading_font_spacings' ) : array();
	return $font_spacings;
}

/**
 * Get heading letter spacing
 */
function uncode_core_vc_params_get_heading_spacings( $font_spacings ) {
	$heading_space = array(
		esc_html__('Default', 'uncode-core') => '',
	);

	if ( ! empty( $font_spacings ) ) {
		foreach ($font_spacings as $key => $value) {
			$heading_space[$value['title']] = $value['_uncode_heading_font_spacing_unique_id'];
		}
	}

	return $heading_space;
}

/**
 * Get button letter spacing
 */
function uncode_core_vc_params_get_button_spacings( $font_spacings ) {
	$btn_letter_spacing = array(
		esc_html__('Letter Spacing 0', 'uncode-core') => 'uncode-fontspace-zero',
	);

	if ( ! empty( $font_spacings ) ) {
		foreach ($font_spacings as $key => $value) {
			$btn_letter_spacing[$value['title']] = $value['_uncode_heading_font_spacing_unique_id'];
		}
	}

	return $btn_letter_spacing;
}

/**
 * Get font heights
 */
function uncode_core_vc_params_get_font_heights() {
	$font_heights = ( function_exists( 'ot_get_option' ) ) ? ot_get_option( '_uncode_heading_font_heights' ) : array();
	return $font_heights;
}

/**
 * Get font heading heights
 */
function uncode_core_vc_params_get_font_heading_heights( $font_heights ) {
	$heading_height = array(
		esc_html__('Default', 'uncode-core') => '',
	);

	if (!empty($font_heights)) {
		foreach ($font_heights as $key => $value) {
			$heading_height[$value['title']] = $value['_uncode_heading_font_height_unique_id'];
		}
	}

	return $heading_height;
}

/**
 * Get flat colors
 */
function uncode_core_vc_params_get_flat_colors( $uncode_colors ) {
	$flat_uncode_colors = array();

	if (!empty($uncode_colors)) {
		foreach ($uncode_colors as $key => $value) {
			$flat_uncode_colors[$value[1]] = $value[0];
		}
	}

	return $flat_uncode_colors;
}

/**
 * Get flat colors
 */
function uncode_core_vc_params_get_flat_colors_w_transparent( $uncode_colors_flat ) {
	$flat_uncode_colors = array();
	$i = 0;

	if (!empty($uncode_colors_flat)) {
		foreach ($uncode_colors_flat as $key => $value) {
			if ( $i === 1 ) {
				$flat_uncode_colors[esc_html__('Transparent', 'uncode-core')] = 'transparent';
				$flat_uncode_colors[esc_html__('Accent', 'uncode-core')] = 'accent';
			}
			$flat_uncode_colors[$value[1]] = $value[0];
			$i++;
		}
	}

	return $flat_uncode_colors;
}

/**
 * Get flat colors with accent
 */
function uncode_core_vc_params_get_flat_colors_w_accent( $uncode_colors_flat ) {
	$flat_uncode_colors = array();
	$i = 0;

	if (!empty($uncode_colors_flat)) {
		foreach ($uncode_colors_flat as $key => $value) {
			if ( $i === 1 ) {
				$flat_uncode_colors[esc_html__('Accent', 'uncode-core')] = 'accent';
			}
			$flat_uncode_colors[$value[1]] = $value[0];
			$i++;
		}
	}

	return $flat_uncode_colors;
}

/**
 * Get Uncode CPTs
 */
function uncode_core_vc_params_get_cpts() {
	if ( function_exists('uncode_get_post_types') ) {
		$uncode_post_types = uncode_get_post_types();
	} else {
		$uncode_post_types = array();
	}

	return $uncode_post_types;
}

/**
 * Get Uncode CPTs with label
 */
function uncode_core_vc_params_get_cpts_label() {
	$get_post_types = get_post_types(
		array(
			'public'   => true,
			'_builtin' => false
		),
		'objects'
	);

	$uncode_post_types = array(
		__( 'Post', 'uncode-core' ) => 'post',
		__( 'Page', 'uncode-core' ) => 'page',
	);

	foreach ( $get_post_types as $post_type_key => $post_type_value ) {
		if ( $post_type_key === 'uncodeblock' || $post_type_key === 'uncode_gallery' ) {
			continue;
		}

		$label = ucfirst( $post_type_key );

		if ( isset( $post_type_value->labels ) && isset( $post_type_value->labels->singular_name ) ) {
			$label = $post_type_value->labels->singular_name;
		}

		$uncode_post_types[$label] = $post_type_key;
	}

	return $uncode_post_types;
}

/**
 * Get button params
 */
function uncode_core_vc_params_get_button_options( $uncode_colors, $size_arr, $heading_size, $button_font, $button_weight, $btn_letter_spacing ) {
	$button_color_options = uncode_core_vc_params_get_advanced_color_options( 'button_color', esc_html__("Button color", 'uncode-core'), esc_html__("Specify button color.", 'uncode-core'), false, $uncode_colors, array( 'default_label' => true ) );
	list( $add_button_color_type, $add_button_color, $add_button_color_solid, $add_button_color_gradient ) = $button_color_options;

	$options = array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Text', 'uncode-core') ,
			'admin_label' => true,
			'param_name' => 'content',
			'value' => esc_html__('Text on the button', 'uncode-core') ,
			'description' => esc_html__('Text on the button.', 'uncode-core'),
			'dependency' => array(
				'element' => 'dynamic',
				'value' => array( '', 'permalink' ),
			)
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode-core') ,
			'param_name' => 'link',
			'description' => esc_html__('Button link.', 'uncode-core'),
			'dependency' => array(
				'element' => 'dynamic',
				'is_empty' => true,
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Dynamic button", 'uncode-core') ,
			"param_name" => "dynamic",
			"description" => esc_html__("Select the dynamic source.", 'uncode-core') ,
			"admin_label" => true,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Add to Cart for Single Product (WooCommerce)', 'uncode-core') => 'add-to-cart',
				esc_html__('Link to Product for Quick-View (WooCommerce)', 'uncode-core') => 'permalink',
			) ,
		) ,
		array(
			"type" => 'dropdown',
			'heading' => esc_html__('Quantity', 'uncode-core') ,
			'param_name' => 'quantity',
			'description' => esc_html__('Specify the quantity style.', 'uncode-core') ,
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('Default', 'uncode-core') => 'default',
				esc_html__('Variation', 'uncode-core') => 'variation',
			) ,
			'dependency' => array(
				'element' => 'dynamic',
				'value' => array( 'add-to-cart' ),
			)
		) ,
		$add_button_color_type,
		$add_button_color,
		$add_button_color_solid,
		$add_button_color_gradient,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Size', 'uncode-core') ,
			'param_name' => 'size',
			'value' => $size_arr,
			'admin_label' => true,
			'description' => esc_html__('Button size.', 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text size", 'uncode-core') ,
			"param_name" => "btn_link_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => '',
			"value" => $heading_size,
			'dependency' => array(
				'element' => 'size',
				'value' => 'link',
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Hover color", 'uncode-core') ,
			"param_name" => "btn_link_hover",
			"description" => esc_html__("Specify the hover effect.", 'uncode-core') ,
			'std' => '',
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Accent', 'uncode-core') => 'btn-hover-accent',
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => 'link',
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Underline", 'uncode-core') ,
			"param_name" => "btn_link_underline",
			"description" => esc_html__("Specify the underline effect.", 'uncode-core') ,
			'std' => '',
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Underline', 'uncode-core') => 'btn-underline',
				esc_html__('Underline In', 'uncode-core') => 'btn-underline-in',
				esc_html__('Underline Out', 'uncode-core') => 'btn-underline-out',
				// esc_html__('Strikethrough', 'uncode-core') => 'btn-strikethrough',
				// esc_html__('Strikethrough (Hover)', 'uncode-core') => 'btn-strikethrough-hover',
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => 'link',
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Shape", 'uncode-core') ,
			"param_name" => "radius",
			"description" => esc_html__("You can shape the button with the corners round, squared or circle.", 'uncode-core') ,
			"value" => array(
				esc_html__('Inherit', 'uncode-core') => '',
				esc_html__('Default', 'uncode-core') => 'btn-default-shape',
				esc_html__('Round', 'uncode-core') => 'btn-round',
				esc_html__('Circle', 'uncode-core') => 'btn-circle',
				esc_html__('Square', 'uncode-core') => 'btn-square'
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Border animation", 'uncode-core') ,
			"param_name" => "border_animation",
			"description" => esc_html__("Specify a button border animation.", 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('Ripple Out', 'uncode-core') => 'btn-ripple-out',
				esc_html__('Ripple In', 'uncode-core') => 'btn-ripple-in',
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Fluid', 'uncode-core') ,
			'param_name' => 'wide',
			'description' => esc_html__('Fluid buttons has 100% width.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			"type" => 'textfield',
			"heading" => esc_html__("Fixed width", 'uncode-core') ,
			"param_name" => "width",
			"description" => esc_html__("Add a fixed width in pixel.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'wide',
				'is_empty' => true,
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Hover effect", 'uncode-core') ,
			"param_name" => "hover_fx",
			"description" => esc_html__("Specify an effect on hover state.", 'uncode-core') ,
			"value" => array(
				'Inherit' => '',
				'Outlined' => 'outlined',
				'Flat' => 'full-colored',
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Outlined inverse', 'uncode-core') ,
			'param_name' => 'outline',
			'description' => esc_html__("Outlined buttons don't have a full background color. NB. This option is available only with Hover Effect > Outlined.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Skin text', 'uncode-core') ,
			'param_name' => 'text_skin',
			'description' => esc_html__("Keep the text color as the Skin. NB. This option works well with Hover Effect > Outlined.", 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Shadow', 'uncode-core') ,
			'param_name' => 'shadow',
			'description' => esc_html__('Activate this for the shadow effect.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Shadow type", 'uncode-core') ,
			"param_name" => "shadow_weight",
			"description" => esc_html__("Specify the shadow option preset.", 'uncode-core') ,
			"value" => array(
				esc_html__('Extra Small', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => 'sm',
				esc_html__('Standard', 'uncode-core') => 'std',
				esc_html__('Large', 'uncode-core') => 'lg',
				esc_html__('Extra Large', 'uncode-core') => 'xl',
			) ,
			'dependency' => array(
				'element' => 'shadow',
				'not_empty' => true
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Custom typography', 'uncode-core') ,
			'param_name' => 'custom_typo',
			'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			)
		) ,
		array(
			'type' => 'dropdown',
			'param_name' => 'font_family',
			'heading' => esc_html__('Font family', 'uncode-core') ,
			'description' => esc_html__('Specify the buttons font family.', 'uncode-core') ,
			'std' => '',
			'value' => $button_font,
			'dependency' => array(
				'element' => 'custom_typo',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'param_name' => 'font_weight',
			'heading' => esc_html__('Font weight', 'uncode-core') ,
			'description' => esc_html__('Specify the buttons font weight.', 'uncode-core') ,
			'std' => '',
			'value' => $button_weight,
			'dependency' => array(
				'element' => 'custom_typo',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'param_name' => 'text_transform',
			'heading' => esc_html__('Text transform', 'uncode-core') ,
			'description' => esc_html__('Specify the buttons text transform.', 'uncode-core') ,
			'std' => '',
			'value' => array(
				array(
					'value' => '',
					'label' => esc_html__('Initial', 'uncode-core') ,
				) ,
				array(
					'value' => 'uppercase',
					'label' => esc_html__('Uppercase', 'uncode-core') ,
				) ,
				array(
					'value' => 'lowercase',
					'label' => esc_html__('Lowercase', 'uncode-core') ,
				) ,
				array(
					'value' => 'capitalize',
					'label' => esc_html__('Capitalize', 'uncode-core') ,
				) ,
			) ,
			'dependency' => array(
				'element' => 'custom_typo',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'param_name' => 'letter_spacing',
			'heading' => esc_html__('Letter spacing', 'uncode-core') ,
			'description' => esc_html__('Specify the letter spacing value.', 'uncode-core') ,
			'value' => $btn_letter_spacing,
			'dependency' => array(
				'element' => 'custom_typo',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Italic text', 'uncode-core') ,
			'param_name' => 'italic',
			'description' => esc_html__('Button with italic text style.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Border width", 'uncode-core') ,
			"param_name" => "border_width",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Specify button border width in pixels.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'size',
				'value' => array(
					'',
					'btn-sm',
					'btn-lg',
					'btn-xl',
				),
			)
		) ,
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'settings' => array(
				'emptyIcon' => true,
				 // default true, display an "EMPTY" icon?
				'iconsPerPage' => 1100,
				 // default 100, how many icons per/page to display
				'type' => 'uncode'
			) ,
			'dependency' => array(
				'element' => 'dynamic',
				'value' => array( '', 'permalink' ),
			)
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Icon position", 'uncode-core') ,
			"param_name" => "icon_position",
			"description" => esc_html__("Choose the position of the icon.", 'uncode-core') ,
			"value" => array(
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout display', 'uncode-core') ,
			'param_name' => 'display',
			'description' => esc_html__('Specify the display mode.', 'uncode-core') ,
			"value" => array(
				esc_html__('Block', 'uncode-core') => '',
				esc_html__('Inline', 'uncode-core') => 'inline',
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Inline Mobile', 'uncode-core') ,
			'param_name' => 'inline_mobile',
			'description' => esc_html__('Preserve the display inline mode on mobile.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			),
			'dependency' => array(
				'element' => 'display',
				'value' => 'inline',
			)
		) ,
		array(
			"type" => 'dropdown',
			'heading' => esc_html__('Scale Mobile', 'uncode-core') ,
			'param_name' => 'scale_mobile',
			'description' => esc_html__('Activate this to slightly reduce button size on mobile.', 'uncode-core') ,
			"value" => array(
				esc_html__('Yes', 'uncode-core') => '',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Margin top', 'uncode-core') ,
			'param_name' => 'top_margin',
			'description' => esc_html__('Activate to add the top margin.', 'uncode-core') ,
			'value' => array(
				esc_html__('Yes, please', 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'display',
				'not_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Rel attribute', 'uncode-core') ,
			'param_name' => 'rel',
			'description' => wp_kses(__('Here you can add value for the rel attribute.<br>Example values: <b%value>nofollow</b>, <b%value>lightbox</b>.', 'uncode-core'), array( 'br' => array( ),'b' => array( ) ) ),
			'dependency' => array(
				'element' => 'dynamic',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('onClick', 'uncode-core') ,
			'param_name' => 'onclick',
			'description' => esc_html__('Advanced JavaScript code for onClick action.', 'uncode-core'),
			'dependency' => array(
				'element' => 'dynamic',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'media_element',
			'heading' => esc_html__('Media lightbox', 'uncode-core') ,
			'param_name' => 'media_lightbox',
			'has_galleries' => true,
			'description' => esc_html__('Specify a media from the lightbox.', 'uncode-core') ,
			'dependency' => array(
				'element' => 'dynamic',
				'is_empty' => true,
			)
		) ,
	);

	return $options;
}

/**
 * Get WC heading activator
 */
function uncode_core_vc_params_get_wc_heading_activator() {
	$activator = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Headings typography", 'uncode-core') ,
		"param_name" => "custom_titles_typography",
		"description" => esc_html__('Define custom font settings.', 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
	);

	return $activator;
}

/**
 * Get WC heading options
 */
function uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size, $heading_weight, $heading_height, $heading_space, $vis_dep = false, $label = 'Headings', $param = 'titles_' ) {
	unset( $heading_size[ 'BigText' ] );

	$options = array();

	if ( $vis_dep === false ) {
		$activator = array(
			array(
				"type" => 'checkbox',
				"heading" => sprintf(esc_html__("%s custom", 'uncode-core'), $label),
				"param_name" => "custom_titles_typography",
				"description" => esc_html__('Define custom font settings.', 'uncode-core') ,
				"value" => array(
					'' => 'yes'
				),
				"group" => esc_html__("Typography", 'uncode-core') ,
			),
		);
		$dep = array(
			'element' => "custom_titles_typography",
			'value' => array(
				'yes'
			)
		);
	} elseif ( is_array( $vis_dep ) ) {
		$activator = array();
		$dep = array(
			'element' => $vis_dep[0],
			'value' => $vis_dep[1]
		);
	} else {
		$activator = array(
			array(
				"type" => 'checkbox',
				"heading" => sprintf(esc_html__("%s visibility", 'uncode-core'), $label),
				"param_name" => $param . $vis_dep,
				"description" => esc_html__('Activate this to show section titles.', 'uncode-core') ,
				"std" => 'yes',
				"value" => array(
					'' => 'yes'
				),
				"group" => esc_html__("Typography", 'uncode-core') ,
			),
			array(
				"type" => 'checkbox',
				"heading" => sprintf(esc_html__("%s custom", 'uncode-core'), $label),
				"param_name" => $param . "custom_titles_typography",
				"description" => esc_html__('Define custom font settings.', 'uncode-core') ,
				"value" => array(
					'' => 'yes'
				),
				"group" => esc_html__("Typography", 'uncode-core') ,
				"dependency" => array(
					'element' => $vis_dep,
					'value' => array(
						'yes'
					)
				) ,
			),
		);
		$dep = array(
			'element' => "custom_titles_typography",
			'value' => array(
				'yes'
			)
		);
	}

	$options = array_merge( $options, $activator );

	$typo_options = array(
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s font family", 'uncode-core'), $label),
			"param_name" => $param . "font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s size", 'uncode-core'), $label),
			"param_name" => $param . "size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => is_array( $vis_dep ) ? '' : 'h2',
			"value" => $heading_size,
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			"heading" => sprintf(esc_html__("%s custom size", 'uncode-core'), $label),
			'param_name' => 'heading_custom_size',
			'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
			"group" => esc_html__("Typography", 'uncode-core') ,
			'dependency' => array(
				'element' => $param . "size",
				'value' => array('custom'),
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s weight", 'uncode-core'), $label),
			"param_name" => $param . "weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s transform", 'uncode-core'), $label),
			"param_name" => $param . "transform",
			"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s line height", 'uncode-core'), $label),
			"param_name" => $param . "height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			"value" => $heading_height,
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => sprintf(esc_html__("%s letter spacing", 'uncode-core'), $label),
			"param_name" => $param . "space",
			"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
			"value" => $heading_space,
			"dependency" => $dep,
			"group" => esc_html__("Typography", 'uncode-core') ,
		) ,
	);

	$options = array_merge( $options, $typo_options );

	return $options;
}

/**
 * Get WC bold text option
 */
function uncode_core_vc_params_get_wc_bold_text_option() {
	$bold_text = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Text Bold", 'uncode-core') ,
		"param_name" => "bold_text",
		"description" => esc_html__('Activate this to highlight part of the text in boldface.', 'uncode-core') ,
		"value" => array(
			'' => 'yes'
		),
		"group" => esc_html__("Typography", 'uncode-core') ,
	);

	return $bold_text;
}

/**
 * Get WC form style option
 */
function uncode_core_vc_params_get_wc_form_style_option() {
	$form_style = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Form style", 'uncode-core') ,
		"param_name" => "form_style",
		"description" => esc_html__('Specify the style of the form. NB. If you plan to use extra plugins, be careful to use the "No Label" styles because they might hide possible additional fields of these plugins.', 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Default Background', 'uncode-core') => 'default-background',
			esc_html__('Default Underline', 'uncode-core') => 'default-underline',
			esc_html__('No Label Default', 'uncode-core') => 'no-labels-default',
			esc_html__('No Label Background', 'uncode-core') => 'no-labels-background',
			esc_html__('No Label Underline', 'uncode-core') => 'no-labels-underline',
		) ,
		"group" => esc_html__( "Buttons & Forms", 'uncode-core' )
	);

	return $form_style;
}

/**
 * Get WC extra options
 */
function uncode_core_vc_params_get_wc_extra_options() {
	$extra_options = array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core'),
			"group" => esc_html__("Extra", 'uncode-core') ,
		) ,
	);

	return $extra_options;
}

/**
 * Get WC button options
 */
function uncode_core_get_wc_button_options( $id, $options ) {
	$new_options = array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Buttons custom", 'uncode-core') ,
			"param_name" => $id . '_activate_custom_buttons',
			"description" => esc_html__('Define custom button settings.', 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			),
			"group" => esc_html__( "Buttons & Forms", 'uncode-core' ),
		),
	);

	foreach ( $options as $option ) {
		switch ( $option[ 'param_name' ] ) {
			case 'content':
			case 'link':
			case 'display':
			case 'top_margin':
			case 'rel':
			case 'onclick':
			case 'media_lightbox':
			case 'dynamic':
			case 'icon':
			case 'icon_position':
			case 'width':
			case 'italic':
			case 'border_animation':
			case 'btn_link_size':
			case 'quantity':
			case 'inline_mobile':
			case 'scale_mobile':
			case 'btn_link_underline':
			case 'btn_link_hover':
				continue 2;

			case 'button_color':
				$option[ 'heading' ] = esc_html__("Buttons color", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'radius':
				$option[ 'heading' ] = esc_html__("Buttons shape", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'wide':
				$option[ 'heading' ] = esc_html__("Buttons fluid", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'hover_fx':
				$option[ 'heading' ] = esc_html__("Buttons over effect", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'outline':
				$option[ 'heading' ] = esc_html__("Buttons outlined inverse", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'text_skin':
				$option[ 'heading' ] = esc_html__("Buttons Skin text", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'shadow':
				$option[ 'heading' ] = esc_html__("Buttons shadow", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'custom_typo':
				$option[ 'heading' ] = esc_html__("Buttons custom typography", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'border_width':
				$option[ 'heading' ] = esc_html__("Buttons border width", 'uncode-core');
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'size':
				$option[ 'heading' ] = esc_html__("Buttons size", 'uncode-core');
				$default_options   = $option[ 'value' ];
				$option[ 'value' ] = $default_options;

				if ( ( $key = array_search( 'btn-link', $default_options ) ) !== false ) {
					unset( $default_options[ $key ] );
				}

				if ( ( $key = array_search( 'link', $default_options ) ) !== false ) {
					unset( $default_options[ $key ] );
				}

				$option[ 'value' ] = $default_options;
				$option[ 'dependency' ] = array(
					'element' => $id . '_activate_custom_buttons',
					'value' => array(
						'yes'
					)
				);

				break;

			case 'shadow_weight':
				$option[ 'dependency' ][ 'element' ] = $id . '_button_' . 'shadow';
				$option[ 'heading' ] = esc_html__("Buttons shadow type", 'uncode-core');
				break;

			case 'font_family':
				$option[ 'dependency' ][ 'element' ] = $id . '_button_' . 'custom_typo';
				$option[ 'heading' ] = esc_html__("Buttons font family", 'uncode-core');
				break;

			case 'font_weight':
				$option[ 'dependency' ][ 'element' ] = $id . '_button_' . 'custom_typo';
				$option[ 'heading' ] = esc_html__("Buttons font weight", 'uncode-core');
				break;

			case 'text_transform':
				$option[ 'dependency' ][ 'element' ] = $id . '_button_' . 'custom_typo';
				$option[ 'heading' ] = esc_html__("Buttons text transform", 'uncode-core');
				break;

			case 'letter_spacing':
				$option[ 'dependency' ][ 'element' ] = $id . '_button_' . 'custom_typo';
				$option[ 'heading' ] = esc_html__("Buttons letter spacing", 'uncode-core');
				break;
		}

		// Prepend suffix to param names
		$option[ 'param_name' ] = $id . '_button_' . $option[ 'param_name' ];

		// New group
		$option[ 'group' ] = esc_html__( "Buttons & Forms", 'uncode-core' );

		// Don't show admin label
		$option[ 'admin_label' ] = false;

		$new_options[] = $option;
	}

	return $new_options;
}

/**
 * Get WC thumb size options
 */
function uncode_core_vc_params_get_wc_thumb_size_options() {
	$thumb_size_options = array(
		'type' => 'dropdown',
		'heading' => esc_html__('Thumbnail size', 'uncode-core') ,
		'param_name' => 'thumb_size',
		'description' => esc_html__('Specify the thumbnail size.', 'uncode-core') ,
		'value' => array(
			esc_html__('Small', 'uncode-core') => '',
			esc_html__('Medium', 'uncode-core') => 'medium',
		) ,
		"group" => esc_html__("Cart Table", 'uncode-core') ,
	);

	if ( function_exists( 'wc_get_image_size' ) ) {
		$wc_thumb_size = wc_get_image_size( 'thumbnail' );

		if ( isset( $wc_thumb_size[ 'width' ] ) && $wc_thumb_size[ 'width' ] > 395 ) {
			$thumb_size_options[ 'value' ][ esc_html__('Big', 'uncode-core') ] = 'big';
		}
	}

	return $thumb_size_options;
}

/**
 * Get text size
 */
function uncode_core_vc_params_get_text_size( $id, $label = false, $group = false, $dep = false ) {
	$text_size = array(
		'type' => 'dropdown',
		'heading' => esc_html__('Text size', 'uncode-core') ,
		'param_name' => $id,
		'value' => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core')   => 'small',
			esc_html__('Large', 'uncode-core')     => 'yes',
		) ,
		"description" => esc_html__("Select this option to enlarge or reduce the font size.", 'uncode-core') ,
	);

	if ( $label ) {
		$text_size[ 'heading' ] = $label;
	}

	if ( $group ) {
		$text_size[ 'group' ] = $group;
	}

	if ( is_array( $dep ) ) {
		$text_size[ 'dependency' ] = $dep;
	}

	return $text_size;
}

/**
 * Get off grid options
 */
function uncode_core_vc_params_get_off_grid_options( $id, $group, $dep_id ) {
	$off_grid_options = array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Off-Grid", 'uncode-core') ,
			"param_name" => $id . "_activate_off_grid",
			"description" => esc_html__("Activate this to shift the element.", 'uncode-core') ,
			"value" => array(
				'' => 'yes'
			) ,
			'group' => $group,
			"dependency" => array(
				'element' => $dep_id,
				'value' => array(
					'horizontal'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift x-axis", 'uncode-core') ,
			"param_name" => $id . "_shift_x",
			"custom_class" => "shift_x",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the X axis.", 'uncode-core') ,
			'group' => $group,
			"dependency" => array(
				'element' => $id . "_activate_off_grid",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis", 'uncode-core') ,
			"param_name" => $id . "_shift_y",
			"custom_class" => "shift_y",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to shift in the Y axis. This works on the margin-top property.", 'uncode-core') ,
			'group' => $group,
			"dependency" => array(
				'element' => $id . "_activate_off_grid",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Shift y-axis downward", 'uncode-core') ,
			"param_name" => $id . "_shift_y_down",
			"custom_class" => "shift_y_down",
			"min" => - 5,
			"max" => 5,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set how much the element has to move toward the element below. This works on the margin-bottom property.", 'uncode-core') ,
			'group' => $group,
			"dependency" => array(
				'element' => $id . "_activate_off_grid",
				'value' => array(
					'yes'
				)
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom z-index", 'uncode-core') ,
			"param_name" => $id . "_z_index",
			"min" => 0,
			"max" => 10,
			"step" => 1,
			"value" => 0,
			"description" => esc_html__("Set a custom z-index to ensure the visibility of the element.", 'uncode-core') ,
			'group' => $group,
			"dependency" => array(
				'element' => $id . "_activate_off_grid",
				'value' => array(
					'yes'
				)
			) ,
		) ,
	);

	return $off_grid_options;
}

/**
 * Get WC typography options
 */
function uncode_core_vc_params_get_wc_typography_options( $heading_options = false ) {
	$options = array();

	if ( $heading_options && is_array( $heading_options ) ) {
		$options = array_merge( $options, $heading_options );
	}

	$text_size = uncode_core_vc_params_get_text_size( 'text_lead', false, esc_html__("Typography", 'uncode-core') );
	$bold_text = uncode_core_vc_params_get_wc_bold_text_option();

	$options[] = $text_size;
	$options[] = $bold_text;

	return $options;
}

/**
 * Get WC buttons and forms options
 */
function uncode_core_vc_params_get_wc_buttons_and_forms_options( $button_options, $slim_form_style = false ) {
	$options = array();
	$form_style = uncode_core_vc_params_get_wc_form_style_option();

	if ( $slim_form_style ) {
		// Unset non available options from form style
		$form_style_values       = $form_style[ 'value' ];
		$slim_form_style_options = $form_style;

		if ( ( $key = array_search( 'no-labels-default', $form_style_values ) ) !== false ) {
			unset( $form_style_values[ $key ] );
		}

		if ( ( $key = array_search( 'no-labels-background', $form_style_values ) ) !== false ) {
			unset( $form_style_values[ $key ] );
		}

		if ( ( $key = array_search( 'no-labels-underline', $form_style_values ) ) !== false ) {
			unset( $form_style_values[ $key ] );
		}

		$slim_form_style_options[ 'value' ] = $form_style_values;
		$form_style                         = $slim_form_style_options;
	}

	if ( $button_options && is_array( $button_options ) ) {
		$options = array_merge( $options, $button_options );
	}

	$options[] = $form_style;

	return $options;
}

/**
 * Get widget collapse option (desktop)
 */
function uncode_core_vc_params_get_widget_collapse_desktop() {
	$widget_style = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Desktop collapse", 'uncode-core') ,
		"param_name" => "widget_desktop_collapse",
		"description" => esc_html__("Activate to collapse the widgets on desktop devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Collapsed on load', 'uncode-core') => 'yes',
			esc_html__('Collapsable on click', 'uncode-core') => 'click',
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style;
}

/**
 * Get widget collapse option (mobile)
 */
function uncode_core_vc_params_get_widget_collapse() {
	$widget_style = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Mobile collapse", 'uncode-core') ,
		"param_name" => "widget_collapse",
		"description" => esc_html__("Activate to collapse the widgets on mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Collapsed on load', 'uncode-core') => 'yes',
			esc_html__('Collapsable on click', 'uncode-core') => 'click',
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style;
}

/**
 * Get widget collapse option (tablet)
 */
function uncode_core_vc_params_get_widget_collapse_tablet() {
	$widget_style = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Tablet collapse", 'uncode-core') ,
		"param_name" => "widget_collapse_tablet",
		"description" => esc_html__("Activate to collapse the widgets on tablet devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Collapsed on load', 'uncode-core') => 'yes',
			esc_html__('Collapsable on click', 'uncode-core') => 'click',
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style;
}

/**
 * Get widget collapse icon option
 */
function uncode_core_vc_params_get_widget_collapse_icon() {
	$widget_style = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Collapse icon", 'uncode-core') ,
		"param_name" => "widget_collapse_icon",
		"description" => esc_html__("Choose the icon.", 'uncode-core') ,
		"value" => array(
			esc_html__('^ (Chevron sign)', 'uncode-core') => '',
			esc_html__('+ (Plus sign)', 'uncode-core') => '-plus',
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style;
}

/**
 * Get widget style option
 */
function uncode_core_vc_params_get_widget_style() {
	$widget_style = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Widget style", 'uncode-core') ,
		"param_name" => "use_widget_style",
		"description" => esc_html__("Activate this to use an enhanced style.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style;
}

/**
 * Get widget style no arrows option
 */
function uncode_core_vc_params_get_widget_style_no_arrows() {
	$widget_style_no_arrows = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove arrows", 'uncode-core') ,
		"param_name" => "widget_style_no_arrows",
		"description" => esc_html__("Activate this to remove the arrow icons from the widget.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style_no_arrows;
}

/**
 * Get widget style no separator option
 */
function uncode_core_vc_params_get_widget_style_no_separator() {
	$widget_style_no_separator = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove separator", 'uncode-core') ,
		"param_name" => "widget_style_no_separator",
		"description" => esc_html__("Activate this to remove the separator between title and content.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style_no_separator;
}

/**
 * Get widget style title typography option
 */
function uncode_core_vc_params_get_widget_style_title_typography() {
	$widget_style_title_typography = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title typography", 'uncode-core') ,
		"param_name" => "widget_style_title_typography",
		"description" => esc_html__("Specify the title typography.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Inherit / Column', 'uncode-core') => 'inherit'
		) ,
		"dependency" => array(
			'element' => "use_widget_style",
			'value' => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style_title_typography;
}

/**
 * Get widget style no stars option
 */
function uncode_core_vc_params_get_widget_style_no_stars() {
	$widget_style_no_stars = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide reviews", 'uncode-core') ,
		"param_name" => "widget_style_no_stars",
		"description" => esc_html__("Activate this to hide the reviews from the product list.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style_no_stars;
}

/**
 * Get widget style no thumbs option
 */
function uncode_core_vc_params_get_widget_style_no_thumbs() {
	$widget_style_no_thumbs = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide thumbnails", 'uncode-core') ,
		"param_name" => "widget_style_no_thumbs",
		"description" => esc_html__("Activate this to hide the thumbnails from the product list.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Style", 'uncode-core') ,
	);

	return $widget_style_no_thumbs;
}

/**
 * Build controls for the advanced color picker
 */
function uncode_core_vc_params_get_advanced_color_options( $id, $heading, $description, $group, $uncode_colors, $param_options = array() ) {
	$gradient_supported = true;

	if ( isset( $param_options['flat'] ) && $param_options['flat'] === true ) {
		$gradient_supported = false;
	}

	$gradient_selector_value = array( 'palette', 'solid' );

	if ( $gradient_supported ) {
		$gradient_selector_value[] = 'gradient';
	}

	if ( isset( $param_options['default_label'] ) && $param_options['default_label'] === true ) {
		array_shift( $uncode_colors );

		array_unshift(
			$uncode_colors,
			array(
				'',
				esc_html__( 'Default', 'uncode-core' )
			)
		);
	}

	$options = array(
		array(
			"type"                 => "uncode_advanced_color_selector",
			"param_name"           => $id . "_type",
			"open-advanced-color"  => true,
			"supported"            => $gradient_selector_value,
			),
		array(
			"type"                 => "dropdown",
			"heading"              => $heading,
			'param_holder_class'   => 'advanced-colorpicker-container',
			'advanced-color-type'  => 'uncode-palette',
			"param_name"           => $id,
			"description"          => $description,
			"value"                => $uncode_colors,
			) ,
		array(
			"type"                 => "uncode_colorpicker",
			"heading"              => $heading,
			'param_holder_class'   => 'advanced-colorpicker-container',
			'advanced-color-type'  => 'uncode-solid',
			"param_name"           => $id . "_solid",
			"description"          => $description,
			"close-advanced-color" => $gradient_supported ? false : true,
		),
	);

	if ( $gradient_supported ) {
		$gradientpicker_option = array(
			array(
				"type"                 => "uncode_gradientpicker",
				"heading"              => $heading,
				'param_holder_class'   => 'advanced-colorpicker-container',
				'advanced-color-type'  => 'uncode-gradient',
				"param_name"           => $id . "_gradient",
				"description"          => $description,
				"close-advanced-color" => true,
			),
		);

		$options = array_merge( $options, $gradientpicker_option );
	}

	foreach ( $options as $option_key => $option ) {
		$modified = false;

		if ( $group ) {
			$option['group'] = $group;
			$modified = true;
		}

		if ( isset( $param_options['dependency'] ) ) {
			$option['dependency'] = $param_options['dependency'];
			$modified = true;
		}

		if ( isset( $param_options['tab'] ) ) {
			$option['tab'] = $param_options['tab'];
			$modified = true;
		}

		if ( isset( $param_options['uncode_wrapper_class'] ) ) {
			$option['uncode_wrapper_class'] = $param_options['uncode_wrapper_class'];
			$modified = true;
		}

		if ( $modified ) {
			$options[$option_key] = $option;
		}
	}

	return $options;
}

/**
 * Get parallax options
 */
function uncode_core_vc_params_get_parallax_options( $group = false, $id = 'parallax_intensity', $dep_id = 'css_animation' ) {
	$group = $group ? $group : esc_html__('Animation', 'uncode-core');

	$parallax_options = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Parallax", 'uncode-core') ,
		"param_name" => $id,
		"description" => esc_html__("Specify the Parallax intensity. NB. Not available with Slides Scroll and, for performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
		'group' => $group ,
		'value' => array(
			esc_html__('10%', 'uncode-core') => 1,
			esc_html__('20%', 'uncode-core') => 2,
			esc_html__('30%', 'uncode-core') => 3,
			esc_html__('40%', 'uncode-core') => 4,
			esc_html__('50%', 'uncode-core') => 5,
			esc_html__('60%', 'uncode-core') => 6,
			esc_html__('70%', 'uncode-core') => 7,
			esc_html__('80%', 'uncode-core') => 8,
			esc_html__('90%', 'uncode-core') => 9,
			esc_html__('100%', 'uncode-core') => 10
		) ,
		"dependency" => array(
			'element' => $dep_id,
			'value' => 'parallax'
		) ,
	);

	return $parallax_options;
}

/**
 * Get parallax options
 */
function uncode_core_vc_params_get_parallax_centered_options( $group = false, $id = 'parallax_centered', $dep_id = 'parallax_intensity' ) {
	$group = $group ? $group : esc_html__('Animation', 'uncode-core');

	$parallax_centered_options = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Parallax in Header", 'uncode-core') ,
		"param_name" => $id,
		"description" => esc_html__("This option is recommended for elements that are in the Header, visible before you start scrolling the page.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => $group,
		"dependency" => array(
			'element' => $dep_id,
			'not_empty' => true
		)
	);

	return $parallax_centered_options;
}

/**
 * Build controls for the breakpoint field
 */
function uncode_core_vc_params_get_breakpoint_field_options( $id, $heading, $description, $group, $default, $param_options = array() ) {

	$options = array(
		array(
			"type"                   => "dropdown",
			"heading"                => $heading,
			"param_name"             => $id . '_items',
			"description"            => $description,
			"std"                    => $default['cols'],
			"uncode_wrapper_class"   => 'breakpoint-field-cols',
			"open-breakpoint-field"  => true,
			"value"                  => array(
					esc_html__('1 Column', 'uncode-core')  => '1',
					esc_html__('2 Columns', 'uncode-core') => '2',
					esc_html__('3 Columns', 'uncode-core') => '3',
					esc_html__('4 Columns', 'uncode-core') => '4',
					esc_html__('5 Columns', 'uncode-core') => '5',
					esc_html__('6 Columns', 'uncode-core') => '6',
			) ,
		) ,
		array(
			"type"                   => "textfield",
			"heading"                => $heading,
			"param_name"             => $id . '_breakpoint',
			"description"            => $description,
			"std"                    => $default['screen'],
			"uncode_wrapper_class"   => 'breakpoint-field-screen',
			"close-breakpoint-field" => true,
		) ,
	);

	foreach ( $options as $option_key => $option ) {
		$modified = false;

		if ( $group ) {
			$option['group'] = $group;
			$modified = true;
		}

		if ( isset( $param_options['dependency'] ) ) {
			$option['dependency'] = $param_options['dependency'];
			$modified = true;
		}

		if ( isset( $param_options['tab'] ) ) {
			$option['tab'] = $param_options['tab'];
			$modified = true;
		}

		if ( $modified ) {
			$options[$option_key] = $option;
		}
	}

	return $options;
}

/**
 * Get dropdown for content blocks
 */
function uncode_core_vc_params_get_cb_dropdown( $params ) {
	if ( apply_filters( 'uncode_core_use_text_fields_for_cpt_selects', false ) ) {
		$params['type'] = 'textfield';
		return $params;
	}

	$current_post_id = isset( $_GET[ 'post' ] ) && $_GET[ 'post' ] > 0 ? absint( $_GET[ 'post' ] ) : 0;
	$cblocks         = get_posts( 'post_type="uncodeblock"&numberposts=-1&suppress_filters=0&orderby=title&order=ASC' );
	$content_blocks  = array();

	if ( $cblocks ) {
		foreach ( $cblocks as $cblock ) {
			if ( $cblock->ID === $current_post_id ) {
				continue;
			}

			$content_blocks[ $cblock->post_title ] = $cblock->ID;
		}
	} else {
		$content_blocks[ __( 'No Content Block found', 'uncode-core' ) ] = 0;
	}

	$params['value'] = $content_blocks;

	return $params;
}
