<?php
/**
 * VC Uncode Hook config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'base' => 'uncode_do_action',
	'name' => esc_html__('Uncode Do Action', 'uncode-core') ,
	'icon' => 'fa fa-code',
	'weight' => 8250,
	'category' => array(
		esc_html__('WooCommerce Product', 'uncode-core') ,
		esc_html__('Extra', 'uncode-core') ,
	),
	'description' => esc_html__('Shortcode Hook PHP Filter Launch Append Function', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Hook type', 'uncode-core') ,
			'param_name' => 'hook_type',
			'description' => esc_html__('Select the type of hook.', 'uncode-core'),
			'value' => array(
				esc_html__('Custom', 'uncode-core') => '',
				'woocommerce_single_product_summary' => 'woocommerce_single_product_summary',
			) ,
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Hook name', 'uncode-core') ,
			'param_name' => 'hook',
			'description' => esc_html__('Use to launch hooks at specific points during the page execution. NB. No special characters but underscores are allowed.', 'uncode-core'),
			'dependency' => array(
				'element' => 'hook_type',
				'is_empty' => true
			),
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Hook priority', 'uncode-core') ,
			'param_name' => 'hook_priority',
			'description' => esc_html__('Type the priority of the hook you want to launch. Leave blank to print all hooks attached to the \'woocommerce_single_product_summary\' action.', 'uncode-core'),
			'dependency' => array(
				'element' => 'hook_type',
				'value' => array(
					'woocommerce_single_product_summary'
				)
			),
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Hook debug', 'uncode-core') ,
			'param_name' => 'hook_debug',
			'description' => esc_html__('Activate debugging to see a list of all hooks attached to the \'woocommerce_single_product_summary\' action and their priority.', 'uncode-core'),
			'value' => array(
				'' => 'yes'
			),
			'dependency' => array(
				'element' => 'hook_type',
				'value' => array(
					'woocommerce_single_product_summary'
				)
			),
			"group" => esc_html__("General", 'uncode-core') ,
		) ,
	) ,
));
