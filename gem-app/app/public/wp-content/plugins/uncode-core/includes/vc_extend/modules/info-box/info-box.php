<?php
/**
 * VC Info Box config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$info_heading_size = $heading_size;
unset($info_heading_size['BigText']);
vc_map( array(
	'base' => 'uncode_info_box',
	'name' => esc_html__('Info Box', 'uncode-core') ,
	'icon' => 'fa fa-info-circle',
	'php_class_name' => 'uncode_info_box',
	'weight' => 9350,
	'category' => array(
		esc_html__('Dynamic', 'uncode-core') ,
	),
   	'description' => esc_html__('Blog post author date comments reading time categories meta info box', 'uncode-core') ,
	'params' => array(
		array(
			'type' => 'sorted_list',
			'heading' => esc_html__('Elements', 'uncode-core') ,
			'param_name' => 'items',
			'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
			'admin_label' => true,
			'value' => 'Date,Categories,Author',
			'group' => esc_html__('Elements', 'uncode-core') ,
			'options' => array(
				array(
					'Date',
					esc_html__('Date', 'uncode-core') ,
				) ,
				array(
					'Categories',
					esc_html__('Categories', 'uncode-core') ,
					array(
						array(
							'',
							esc_html__('Display prefix', 'uncode-core')
						) ,
						array(
							'do_not_display_prefix',
							esc_html__('Do not display prefix', 'uncode-core')
						) ,
					) ,
				) ,
				array(
					'Author',
					esc_html__('Author', 'uncode-core') ,
					array(
						array(
							'no_avatar',
							esc_html__('No avatar', 'uncode-core'),
						) ,
						array(
							'Small_avatar_size',
							esc_html__('Small avatar', 'uncode-core'),
						) ,
						array(
							'Medium_avatar_size',
							esc_html__('Medium avatar', 'uncode-core'),
						),
						array(
							'Large_avatar_size',
							esc_html__('Large avatar', 'uncode-core'),
						),
						array(
							'Extra_avatar_size',
							esc_html__('Extra large avatar', 'uncode-core')
						)
					),
					array(
						array(
							'inline_avatar',
							esc_html__('Inline avatar', 'uncode-core'),
						) ,
						array(
							'top_avatar',
							esc_html__('Top avatar', 'uncode-core'),
						) ,
					),
					array(
						array(
							'display_prefix',
							esc_html__('Display prefix', 'uncode-core')
						) ,
						array(
							'do_not_display_prefix',
							esc_html__('Do not display prefix', 'uncode-core')
						) ,
					),
				),
				array(
					'Comments',
					esc_html__('Comments', 'uncode-core') ,
				) ,
				array(
					'Reading_time',
					esc_html__('Reading time', 'uncode-core') ,
				) ,
			)
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font family", 'uncode-core') ,
			"param_name" => "text_font",
			"description" => esc_html__("Specify text font family.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => $heading_font,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text size", 'uncode-core') ,
			"param_name" => "text_size",
			"description" => esc_html__("Specify a font size.", 'uncode-core') ,
			'std' => '',
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => $info_heading_size,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Font weight", 'uncode-core') ,
			"param_name" => "text_weight",
			"description" => esc_html__("Specify text weight.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => $heading_weight,
			'std' => '',
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Text transform", 'uncode-core') ,
			"param_name" => "text_transform",
			"description" => esc_html__("Specify the text transformation.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Uppercase', 'uncode-core') => 'uppercase',
				esc_html__('Lowercase', 'uncode-core') => 'lowercase',
				esc_html__('Capitalize', 'uncode-core') => 'capitalize'
			) ,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Line height", 'uncode-core') ,
			"param_name" => "text_height",
			"description" => esc_html__("Specify text line height.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => $heading_height,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Letter spacing", 'uncode-core') ,
			"param_name" => "text_space",
			"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => $heading_space,
		) ,
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Separators", 'uncode-core') ,
			"param_name" => "separator",
			"description" => esc_html__("Specify a separator.", 'uncode-core') ,
			'group' => esc_html__('Style', 'uncode-core') ,
			"value" => array(
				esc_html__('None', 'uncode-core') => '',
				esc_html__('| - Vertical bar', 'uncode-core') => 'pipe',
				esc_html__('• - Bullet', 'uncode-core') => 'bullet',
			) ,
		) ,
		$add_css_animation,
		$add_animation_speed,
		$add_animation_delay,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Desktop", 'uncode-core') ,
			"param_name" => "desktop_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Tablet", 'uncode-core') ,
			"param_name" => "medium_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Mobile", 'uncode-core') ,
			"param_name" => "mobile_visibility",
			"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
			'group' => esc_html__('Responsive', 'uncode-core') ,
			"value" => Array(
				'' => 'yes'
			) ,
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Element ID', 'uncode-core') ,
			'param_name' => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra class name', 'uncode-core') ,
			'param_name' => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
			"group" => esc_html__("Extra", 'uncode-core')
		) ,
	)
) );
