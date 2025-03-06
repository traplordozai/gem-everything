<?php
/**
 * VC Tabs config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$active_bg_options = uncode_core_vc_params_get_advanced_color_options( 'active_bg_color', esc_html__("Active tab background", 'uncode-core'), esc_html__("Set the background for the active tab.", 'uncode-core'), false, $uncode_colors, array( 'dependency' => array( 'element' => 'vertical', 'not_empty' => true ) ) );
list( $add_active_bg_type, $add_active_bg, $add_active_bg_solid, $add_active_bg_gradient ) = $active_bg_options;

$active_txt_color_options = uncode_core_vc_params_get_advanced_color_options( 'active_txt_color', esc_html__("Active tab text color", 'uncode-core'), esc_html__("Set the textual color for the active tab.", 'uncode-core'), false, $uncode_colors, array( 'dependency' => array( 'element' => 'vertical', 'not_empty' => true ) ) );
list( $add_active_txt_color_type, $add_active_txt_color, $add_active_txt_color_solid, $add_active_txt_color_gradient ) = $active_txt_color_options;

$tab_id_1 = time() . '-1-' . rand(0, 100);
$tab_id_2 = time() . '-2-' . rand(0, 100);
$extra_params = array(
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
	),

);
$params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Vertical tabs', 'uncode-core') ,
		'param_name' => 'vertical',
		'description' => esc_html__('Specify checkbox to allow all sections to be collapsible.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		)
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('History (permalinks)', 'uncode-core') ,
		'param_name' => 'history',
		'description' => esc_html__('Activate this to activate url history for tabs.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		)
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Scroll target', 'uncode-core') ,
		'param_name' => 'target',
		'description' => esc_html__('Define the History scroll target on page load.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'history',
			'not_empty' => true,
		) ,
		'value' => array(
			esc_html__('Scroll to tabs', 'uncode-core') => '',
			esc_html__('Scroll to parent row', 'uncode-core') => "row",
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Special events', 'uncode-core') ,
		'param_name' => 'tabs_event',
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Posts/Gallery Trigger', 'uncode-core') => 'box-resized',
			esc_html__('Window Resize Trigger', 'uncode-core') => 'window-resize',
		) ,
		'description' => esc_html__('Use for special situations, such as if a Posts or Media Gallery module is inside or other modules require a Resize event.', 'uncode-core') ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove lazy loading', 'uncode-core') ,
		'param_name' => 'no_lazy',
		'description' => esc_html__('Remove default lazy loading for images in not active tabs.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Tabs on hover', 'uncode-core') ,
		'param_name' => 'tab_hover',
		'description' => esc_html__('Change tab on desktop with hover instead of click.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove animation', 'uncode-core') ,
		'param_name' => 'tab_no_fade',
		'description' => esc_html__('Remove the default animation, useful to independently animate internal elements.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Scroll Tabs on Mobile', 'uncode-core') ,
		'param_name' => 'tab_scrolling',
		'description' => esc_html__('Enable the scroll horizontal for the tab navigation on mobile.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'tab_switch',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Switcher style', 'uncode-core') ,
		'param_name' => 'tab_switch',
		'description' => esc_html__('Set the Switcher style. NB. This is not compatible with the Mobile Accordion option.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Indicator animated', 'uncode-core') ,
		'param_name' => 'animation_active',
		'description' => esc_html__('Activates the animation on the indicator highlighting the active tab.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Typography', 'uncode-core') ,
		'param_name' => 'typography',
		'description' => esc_html__('Set the font of tab titles. You can set the default, inherit from the column, or a custom typography', 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__("Inherit", 'uncode-core') => 'yes',
			esc_html__('Custom', 'uncode-core') => 'advanced',
		)
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Tabs alignment', 'uncode-core') ,
		'param_name' => 'align',
		"value" => array(
			esc_html__('Center', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'description' => esc_html__('Set the titles\'s alignment.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Tabs justify', 'uncode-core') ,
		'param_name' => 'width_100',
		'description' => esc_html__('Set the titles\'s justified alignment.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'tab_switch',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove border', 'uncode-core') ,
		'param_name' => 'tab_no_border',
		'description' => esc_html__('Removes the border. When using the Switcher Style the border is removed automatically.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Show dividers', 'uncode-core') ,
		'param_name' => 'tab_h_border',
		'description' => esc_html__('Display the border between the Tabs.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Divider Full-Width', 'uncode-core') ,
		'param_name' => 'border_100',
		'description' => esc_html__('Set the border divider to 100% width.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'is_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'tab_no_border',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Middle alligned', 'uncode-core') ,
		'param_name' => 'valign_middle',
		'description' => esc_html__('Sets vertical middle alignment between Tabs and Content.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Tabs position', 'uncode-core') ,
		'param_name' => 'tabs_align',
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Opposite', 'uncode-core') => 'opposite',
		) ,
		'description' => esc_html__('Reverses the position between Tabs and Content.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Tabs layout', 'uncode-core') ,
		'param_name' => 'tab_custom_size',
		'description' => esc_html__('Set a custom width for Tabs relative to the main grid.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Tabs width", 'uncode-core') ,
		"param_name" => "tab_size",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Sets the width of the Tabs.", 'uncode-core') ,
		"dependency" => array(
			'element' => "tab_custom_size",
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Tabs gap", 'uncode-core') ,
		"param_name" => "tab_gap",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Sets the gap between Tabs and Content.", 'uncode-core') ,
		"dependency" => array(
			'element' => "tab_custom_size",
			'not_empty' => true,
		) ,
	) ,
	// array(
	// 	"type" => "type_numeric_slider",
	// 	"heading" => esc_html__("Columns gap", 'uncode-core') ,
	// 	"custom_class" => "gutter_size",
	// 	"param_name" => "checkout_columns_gap",
	// 	"min" => 0,
	// 	"max" => 4,
	// 	"step" => 1,
	// 	"value" => 3,
	// 	"description" => esc_html__("Set the columns gap.", 'uncode-core') ,
	// 	"dependency" => array(
	// 		'element' => "checkout_layout",
	// 		'value' => array(
	// 			'horizontal'
	// 		)
	// 	) ,
	// ) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "custom_padding",
		"description" => esc_html__("Enable custom padding.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
		'dependency' => array(
			'element' => "tab_custom_size",
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Tabs padding", 'uncode-core') ,
		"param_name" => "gutter_tab",
		"min" => 0,
		"max" => 3,
		"step" => 1,
		"value" => 0,
		"description" => esc_html__("Set the custom padding value.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'custom_padding',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove lateral padding', 'uncode-core') ,
		'param_name' => 'no_h_padding',
		'description' => esc_html__('Removes the side padding of the Tabs.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => "custom_padding",
			'not_empty' => true,
		) ,
	) ,
	$add_active_bg_type,
	$add_active_bg,
	$add_active_bg_solid,
	$add_active_bg_gradient,
	$add_active_txt_color_type,
	$add_active_txt_color,
	$add_active_txt_color_solid,
	$add_active_txt_color_gradient,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Active tab border radius", 'uncode-core') ,
		"param_name" => "radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
			esc_html__('Huge', 'uncode-core') => 'hg',
		) ,
		'dependency' => array(
			'element' => 'tab_no_border',
			'not_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Active tab shadow", 'uncode-core') ,
		"param_name" => "shadow",
		"description" => esc_html__("Set the shadow for the active tab.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
		'dependency' => array(
			'element' => 'tab_no_border',
			'not_empty' => true,
		) ,
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Active tab shadow darker", 'uncode-core') ,
		"param_name" => "shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Tablet breakpoint', 'uncode-core') ,
		'param_name' => 'tab_tablet_bp',
		'description' => esc_html__('Anticipates on Tablet the default breakpoint layout.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Mobile Accordion', 'uncode-core') ,
		'param_name' => 'accordion_bp',
		'description' => esc_html__('Activate to optimise Accordion-like layout on mobile. Nb. Please note that this option may not work if you have complex elements in the tab content, and that it doesn\'t have a preview on Frontend Editor. This is not compatible with the Switcher Style option.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
);
$tab_excerpt_typo_params = array(
	// Can't be used `uncode_core_vc_params_get_text_size` because of the double dep
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Excerpt Text Size', 'uncode-core') ,
		'param_name' => 'excerpt_text_size',
		'value' => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core')   => 'small',
			esc_html__('Large', 'uncode-core')     => 'yes',
		) ,
		"description" => esc_html__("Select this option to enlarge or reduce the font size.", 'uncode-core') ,
		"group" => esc_html__("Typography", 'uncode-core') ,
		'dependency' => array(
			'element' => 'typography',
			'value' => 'advanced',
		),
		'dependency' => array(
			'element' => 'vertical',
			'not_empty' => true,
		) ,
	) ,
);
vc_map(array(
	"name" => esc_html__('Tabs', 'uncode-core') ,
	'base' => 'vc_tabs',
	'weight' => 9300,
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'fa fa-folder',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Tabs tabbed content', 'uncode-core') ,
	'params' => array_merge($params, array_merge($tab_label_typo_params, $tab_excerpt_typo_params, $extra_params)),
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>',
	'default_content' => '
[vc_tab title="' . esc_html__('Tab 1', 'uncode-core') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . esc_html__('Tab 2', 'uncode-core') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' => 'VcTabsView'
));

vc_map(array(
	'name' => esc_html__('Tab', 'uncode-core') ,
	'base' => 'vc_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('Tab title.', 'uncode-core')
		) ,
		array(
			'type' => 'tab_id',
			'heading' => esc_html__('Tab ID', 'uncode-core') ,
			'param_name' => "tab_id",
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Slug', 'uncode-core') ,
			'param_name' => "slug",
			'description' => esc_html__('Custom value used for permalink. This value has to be unique.', 'uncode-core')
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Excerpt', 'uncode-core') ,
			"param_name" => "excerpt",
			"description" => esc_html__("Set the Excerpt. Please note that it is only for the Vertical Tabs layout.", 'uncode-core') ,
		) ,
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('URL (Link)', 'uncode-core') ,
			'param_name' => 'link',
			'description' => esc_html__('Set an additional link. Nb. Note that this option works only for the Vertical Tabs.', 'uncode-core')
		) ,	
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'uncode-core') ,
			'param_name' => 'icon',
			'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 1100,
				'type' => 'uncode'
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon position', 'uncode-core') ,
			'param_name' => 'icon_position',
			'value' => array(
				esc_html__('Left', 'uncode-core') => '',
				esc_html__('Right', 'uncode-core') => "right",
				esc_html__('Above', 'uncode-core') => 'above',
			) ,
			'description' => esc_html__('Specify title location.', 'uncode-core'),
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon size', 'uncode-core') ,
			'param_name' => 'icon_size',
			'value' => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => "sm",
				esc_html__('Medium', 'uncode-core') => 'md',
			) ,
			'description' => esc_html__('Set the icon size.', 'uncode-core'),
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Inner Vertical Spacing", 'uncode-core') ,
			"param_name" => "gutter_size",
			"min" => 0,
			"max" => 4,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Set the vertical rhythm between elements.", 'uncode-core') ,
		) ,
		array(
			"type" => "type_numeric_slider",
			"heading" => esc_html__("Custom Padding", 'uncode-core') ,
			"param_name" => "column_padding",
			"min" => 0,
			"max" => 5,
			"step" => 1,
			"value" => 2,
			"description" => esc_html__("Define a custom top and bottom padding.", 'uncode-core') ,
		) ,
	) ,
	'js_view' => 'VcTabView'
));
