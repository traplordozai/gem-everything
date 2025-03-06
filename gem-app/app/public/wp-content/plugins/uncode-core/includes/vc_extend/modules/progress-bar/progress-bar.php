<?php
/**
 * VC Progress Bar config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$bar_color_options = uncode_core_vc_params_get_advanced_color_options( 'bar_color', esc_html__("Bar color", 'uncode-core'), esc_html__("Specify bar color.", 'uncode-core'), false, $flat_uncode_colors, array( 'default_label' => true ) );
list( $add_bar_color_type, $add_bar_color, $add_bar_color_solid, $add_bar_color_gradient ) = $bar_color_options;

$back_color_options = uncode_core_vc_params_get_advanced_color_options( 'back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify bar background color.", 'uncode-core'), false, $flat_uncode_colors, array( 'default_label' => true ) );
list( $add_back_color_type, $add_back_color, $add_back_color_solid, $add_back_color_gradient ) = $back_color_options;

vc_map(array(
	'name' => esc_html__('Progress Bar', 'uncode-core') ,
	'base' => 'vc_progress_bar',
	'weight' => 9000,
	'icon' => 'fa fa-tasks',
	'description' => esc_html__('Numbers progress percentages value unit', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('Enter text which will be used as module title. Leave blank if no title is needed.', 'uncode-core')
		) ,
		array(
			'type' => 'param_group',
			'heading' => esc_html__('Graphic values', 'uncode-core') ,
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values for graph - value, title and color.', 'uncode-core' ),
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Development', 'uncode-core' ),
					'value' => '90',
				),
				array(
					'label' => esc_html__( 'Design', 'uncode-core' ),
					'value' => '80',
				),
				array(
					'label' => esc_html__( 'Marketing', 'uncode-core' ),
					'value' => '70',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'uncode-core' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as title of bar.', 'uncode-core' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Value', 'uncode-core' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter value of bar.', 'uncode-core' ),
					'admin_label' => true,
				),
				$add_bar_color_type,
				$add_bar_color,
				$add_bar_color_solid,
				$add_bar_color_gradient,
				$add_back_color_type,
				$add_back_color,
				$add_back_color_solid,
				$add_back_color_gradient,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Units', 'uncode-core') ,
			'param_name' => 'units',
			'description' => esc_html__('Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'uncode-core')
		) ,
		array(
			"type" => 'checkbox',
			'heading' => esc_html__('Empty space', 'uncode-core') ,
			"param_name" => "empty_space",
			"description" => esc_html__("Add an empty space between values and units.", 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
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
		)
	)
));
