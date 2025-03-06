<?php
/**
 * Uncode WC Checkout Steps config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$woocommerce_steps_params = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom step labels", 'uncode-core') ,
		"param_name" => "custom_labels",
		"description" => esc_html__("Activate it to use custom labels.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("General", 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Label Cart', 'uncode-core') ,
		'param_name' => 'custom_label_cart',
		'description' => esc_html__('Custom label for the Cart page.', 'uncode-core') ,
		"group" => esc_html__("General", 'uncode-core'),
		'dependency' => array(
			'element' => 'custom_labels',
			'value' => 'yes'
		)
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Label Checkout', 'uncode-core') ,
		'param_name' => 'custom_label_checkout',
		'description' => esc_html__('Custom label for the Checkout page.', 'uncode-core') ,
		"group" => esc_html__("General", 'uncode-core'),
		'dependency' => array(
			'element' => 'custom_labels',
			'value' => 'yes'
		)
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Label Complete', 'uncode-core') ,
		'param_name' => 'custom_label_complete',
		'description' => esc_html__('Custom label for the Thank-You page.', 'uncode-core') ,
		"group" => esc_html__("General", 'uncode-core'),
		'dependency' => array(
			'element' => 'custom_labels',
			'value' => 'yes'
		)
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Step icon', 'uncode-core') ,
		'param_name' => 'icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'value' => '',
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
		"group" => esc_html__("General", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Step numbers", 'uncode-core') ,
		"param_name" => "show_numbers",
		"description" => esc_html__("Activate it to show the numerical index of each step.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("General", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Font family", 'uncode-core') ,
		"param_name" => "font_family",
		"description" => esc_html__("Specify text font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Font size", 'uncode-core') ,
		"param_name" => "font_size",
		"description" => esc_html__("Specify a font size.", 'uncode-core') ,
		'std' => 'h2',
		"value" => $heading_size,
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Font weight", 'uncode-core') ,
		"param_name" => "font_weight",
		"description" => esc_html__("Specify text weight.", 'uncode-core') ,
		"value" => $heading_weight,
		'std' => '',
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Text transform", 'uncode-core') ,
		"param_name" => "text_transform",
		"description" => esc_html__("Specify the text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Line height", 'uncode-core') ,
		"param_name" => "line_height",
		"description" => esc_html__("Specify text line height.", 'uncode-core') ,
		"value" => $heading_height,
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Letter spacing", 'uncode-core') ,
		"param_name" => "letter_spacing",
		"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
		"group" => esc_html__("Typography", 'uncode-core') ,
	) ,
);

$woocommerce_steps_params = array_merge( $woocommerce_steps_params, $wc_extra_options );

vc_map(array(
	'name' => esc_html__('Checkout Steps', 'uncode-core') ,
	'base' => 'uncode_woocommerce_steps',
	'php_class_name' => 'uncode_generic_admin',
	'icon' => 'fa fa-credit-card',
	'weight' => -137,
	'category' => array(
		esc_html__('WooCommerce', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Checkout Cart Steps', 'uncode-core') ,
	'params' => $woocommerce_steps_params,
));
