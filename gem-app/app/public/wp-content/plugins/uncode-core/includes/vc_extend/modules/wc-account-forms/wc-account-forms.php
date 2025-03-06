<?php
/**
 * WC Account Forms config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$account_forms_params = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Form type", 'uncode-core') ,
		"param_name" => "account_forms_form_type",
		"admin_label" => true,
		"value" => array(
			esc_html__('Login', 'uncode-core')    => 'login',
			esc_html__('Register', 'uncode-core') => 'register',
			esc_html__('Tracking', 'uncode-core') => 'tracking'
		) ,
		"description" => esc_html__("Select the type of form you want to display.", 'uncode-core')
	) ,
);

$account_forms_heading_options = uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size, $heading_weight, $heading_height, $heading_space, 'account_forms_show_titles' );
$account_forms_params          = array_merge( $account_forms_params, uncode_core_vc_params_get_wc_typography_options( $account_forms_heading_options ) );
$account_forms_button_options  = uncode_core_get_wc_button_options( 'account_forms', $button_options );
$account_forms_params          = array_merge( $account_forms_params, uncode_core_vc_params_get_wc_buttons_and_forms_options( $account_forms_button_options ) );
$account_forms_params          = array_merge( $account_forms_params, $wc_extra_options );

$account_forms_params[] = array(
	"type" => 'checkbox',
	"heading" => esc_html__("Button Adjust", 'uncode-core') ,
	"param_name" => "account_forms_manual_button_adjust",
	"description" => esc_html__("Activate to adjust the button position, useful to create equal height layouts.", 'uncode-core') ,
	"value" => Array(
		esc_html__("Yes, please", 'uncode-core') => 'yes'
	) ,
	"group" => esc_html__( "Buttons & Forms", 'uncode-core' ),
);

$account_forms_params[] = array(
	'type' => 'textfield',
	"heading" => esc_html__("Button Adjust Value", 'uncode-core') ,
	'param_name' => 'account_forms_manual_button_adjust_value',
	'description' => esc_html__("Insert the top position pixel.", 'uncode-core') ,
	'dependency' => array(
		'element' => 'account_forms_manual_button_adjust',
		'value' => 'yes'
	),
	"group" => esc_html__( "Buttons & Forms", 'uncode-core' ),
);

vc_map(array(
	'name' => esc_html__('Account Forms', 'uncode-core') ,
	'base' => 'uncode_woocommerce_account_forms',
	'icon' => 'icon-wpb-woocommerce',
	'weight' => -120,
	'show_settings_on_create' => true,
	'icon' => 'fa fa-sign-in',
	'category' => array(
		esc_html__('WooCommerce', 'uncode-core') ,
	),
	'description' => esc_html__('WooCommerce Log-in Sign-in Register Tracking', 'uncode-core') ,
	'params' => $account_forms_params,
));
