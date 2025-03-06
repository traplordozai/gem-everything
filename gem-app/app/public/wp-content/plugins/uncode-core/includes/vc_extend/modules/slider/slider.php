<?php
/**
 * VC Slider config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

vc_map(array(
    'name' => esc_html__('Content Slider', 'uncode-core') ,
    'description' => esc_html__('Button element', 'uncode-core') ,
    'base' => 'uncode_slider',
    'weight' => 9500,
    'php_class_name' => 'uncode_slider',
    'show_settings_on_create' => false,
    'is_container' => true,
    'icon' => 'fa fa-fast-forward',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Slider slideshow header carousel hero', 'uncode-core') ,
    'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Transition type', 'uncode-core') ,
			'param_name' => 'slider_type',
			"value" => array(
				esc_html__('Slide', 'uncode-core') => '',
				esc_html__('Fade', 'uncode-core') => 'fade'
			) ,
			'description' => esc_html__('Specify the transition type.<br />NB. Fade option works only with 1 item selected to create a slideshow.', 'uncode-core') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Auto rotate slides', 'uncode-core') ,
			'param_name' => 'slider_interval',
			'value' => array(
				3000,
				5000,
				10000,
				15000,
				esc_html__('Disable', 'uncode-core') => 0
			) ,
			'std' => 0,
			'description' => esc_html__('Specify the automatic timeout between slides in milliseconds.', 'uncode-core') ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Navigation speed', 'uncode-core') ,
			'param_name' => 'slider_navspeed',
			'value' => array(
				200,
				400,
				700,
				1000,
				esc_html__('Disable', 'uncode-core') => 0
			) ,
			'std' => 400,
			'description' => esc_html__('Specify the navigation speed between slides in milliseconds.', 'uncode-core') ,
		) ,
		array(
			'type' => 'checkbox',
			"heading" => esc_html__("Loop *", 'uncode-core') ,
			'param_name' => 'slider_loop',
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"description" => esc_html__("Activate the loop option to make the carousel infinite. NB. Don't activate if the slider contains an Isotope index and, for performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Advanced Navigation", 'uncode-core') ,
			"param_name" => "advanced_nav",
			"description" => esc_html__("Activate to have the Advanced Navigation Target and hide the native Carousel navigation options.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'type',
				'value' => 'carousel',
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Slider target', 'uncode-core') ,
			'param_name' => 'el_id1',
			'value' => '',
			'description' => esc_html__("It represents the Target ID for advanced navigation, copy and paste into the Carousel/Slider Navigation module to connect the two modules. PS. If the two modules are in the same Row, there is no need to connect them because the connection is automatic.", 'uncode-core') ,
			"edit_field_class" => "target-advanced_nav input-readonly",
			'dependency' => array(
				'element' => 'advanced_nav',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			"heading" => esc_html__("Arrows hidden", 'uncode-core') ,
			'param_name' => 'slider_hide_arrows',
			"edit_field_class" => "on-advanced_nav",
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"description" => esc_html__("Activate this to hide slider arrows. NB. Arrows are visible only when you use the Content Slider in the page header.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'advanced_nav',
				'is_empty' => true,
			) ,
		) ,
		array(
			'type' => 'checkbox',
			"heading" => esc_html__("Dots hidden", 'uncode-core') ,
			'param_name' => 'slider_hide_dots',
			"edit_field_class" => "on-advanced_nav",
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"description" => esc_html__("Activate this to hide slider pagination dots.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'advanced_nav',
				'is_empty' => true,
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dots Navigation Extra Top", 'uncode-core') ,
			"param_name" => "slider_dots_space",
			"description" => esc_html__("Activate this to add extra top space to the Navigation Dots.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'std' => '',
			"group" => esc_html__("Dots", 'uncode-core'),
			'dependency' => array(
				'element' => 'slider_hide_dots',
				'is_empty' => true,
			) ,
		) ,
  		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Dots Navigation Position', 'uncode-core') ,
			'param_name' => 'slider_dot_position',
			"value" => array(
				esc_html__('Center', 'uncode-core') => '',
				esc_html__('Left', 'uncode-core') => 'left',
				esc_html__('Right', 'uncode-core') => 'right',
			) ,
			"group" => esc_html__("Dots", 'uncode-core'),
			'description' => esc_html__('Specify the position of dots.', 'uncode-core') ,
			'dependency' => array(
				'element' => 'slider_hide_dots',
				'is_empty' => true,
			) ,
		) ,
  		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Dots container width', 'uncode-core') ,
			'param_name' => 'slider_dot_width',
			"value" => array(
				esc_html__('Full width', 'uncode-core') => '',
				esc_html__('Limit width', 'uncode-core') => 'limit',
			) ,
			"group" => esc_html__("Dots", 'uncode-core'),
			'description' => esc_html__('Specify the width of the dots container.', 'uncode-core') ,
			'dependency' => array(
				'element' => 'slider_dot_position',
				'value' => array('left', 'right'),
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Dots container width unit", 'uncode-core') ,
			"param_name" => "column_width_use_pixel",
			"edit_field_class" => 'vc_column row_height',
			"description" => 'Set this value if you want to constrain the container width.',
			"value" => array(
				'' => 'yes'
			),
			"group" => esc_html__("Dots", 'uncode-core'),
			'dependency' => array(
				'element' => 'slider_dot_position',
				'value' => array('left', 'right'),
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Dots container width", 'uncode') ,
			"param_name" => "slider_width_percent",
			"min" => 0,
			"max" => 100,
			"step" => 1,
			"value" => 100,
			"group" => esc_html__("Dots", 'uncode-core'),
			"description" => esc_html__("Set the container width with a percent value.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'is_empty' => true,
			)
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__("Dots container width", 'uncode-core'),
			"group" => esc_html__("Dots", 'uncode-core'),
			'param_name' => 'silder_width_pixel',
			'description' => esc_html__("Insert the container width in pixel.", 'uncode-core') ,
			'dependency' => array(
				'element' => 'column_width_use_pixel',
				'not_empty' => true
			)
		) ,
		array(
			"type" => "type_numeric_slider",
			'heading' => esc_html__('Dots container padding', 'uncode-core') ,
			"description" => esc_html__("Activate this option to add left and right padding to dots container.", 'uncode-core') ,
			"param_name" => "h_padding",
			"min" => 0,
			"max" => 7,
			"step" => 1,
			"value" => 2,
			"group" => esc_html__("Dots", 'uncode-core'),
			'dependency' => array(
				'element' => 'slider_dot_position',
				'value' => array('left', 'right'),
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'value' => ( (function_exists('uncode_big_rand')) ? uncode_big_rand() : rand() ),
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
		)
    ) ,
    'custom_markup' => '
	<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
		%content%
	</div>
	<div class="tab_controls vc_element-icon" style="width: 100%; margin-top: 20px;">
	    <a class="add_tab" title="' . esc_html__('Add slide', 'uncode-core') . '" style="color: white;"><i class="fa fa-plus2"></i> <span class="tab-label">' . esc_html__('Add slide', 'uncode-core') . '</span></a>
	</div>',
    'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
    'js_view' => 'UncodeAccordionView'
));
