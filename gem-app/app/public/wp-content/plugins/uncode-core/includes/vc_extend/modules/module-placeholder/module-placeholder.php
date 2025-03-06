<?php
/**
 * Module Placeholder config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
	'name' => esc_html__('Module Placeholder', 'uncode-core') ,
	'base' => 'uncode_module_placeholder',
	'weight' => 8240,
	'icon' => 'fa fa-image',
	'php_class_name' => 'uncode_module_placeholder',
	'description' => esc_html__('Module Placeholder', 'uncode-core') ,
	// 'show_settings_on_create' => false ,
	'params' => array(
		array(
			'type' => 'type_readonly_info',
			'param_name' => 'readonly_info1',
			'value' => "1",
			'heading' => esc_html__('How to use', 'uncode-core') ,
			'description' => esc_html__('Please use the Placeholder module to build custom layouts using the Posts and Media Gallery modules \'Pattern\' display feature. Once a Content Block with a \'Placeholder\' is associated with the Posts and Media Gallery modules, all \'Placeholders\' will be procedurally replaced by the elements that are part of the Query (Blog Post, Portfolio, Products, or Images). In a few words, a \'Placeholder\' element represents the position of a thumbnail on the final page. NB. Please note that the Placeholder is only visible as a stylization when it\'s used in a Content Block via the Frontend Editor to create a \'Pattern\'. This happens because the same \'Pattern\' can be used on the final page to create loops of different Posts Type. When rendered via a page that uses the \'Pattern\', it faithfully represents the final page\'s rendering.', 'uncode-core') ,
		) ,
	) ,
));
