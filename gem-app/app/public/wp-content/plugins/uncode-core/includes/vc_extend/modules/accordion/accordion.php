<?php
/**
 * VC Accordion config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$active_bg_options = uncode_core_vc_params_get_advanced_color_options( 'active_bg_color', esc_html__("Active panel background", 'uncode-core'), esc_html__("Set the background for the active panel.", 'uncode-core'), false, $uncode_colors, false );
list( $add_active_bg_type, $add_active_bg, $add_active_bg_solid, $add_active_bg_gradient ) = $active_bg_options;

$active_txt_color_options = uncode_core_vc_params_get_advanced_color_options( 'active_txt_color', esc_html__("Active panel textual color", 'uncode-core'), esc_html__("Set the textual color for the active panel.", 'uncode-core'), false, $uncode_colors, false );
list( $add_active_txt_color_type, $add_active_txt_color, $add_active_txt_color_solid, $add_active_txt_color_gradient ) = $active_txt_color_options;

$panel_id_1 = time() . '-1-' . rand(0, 100);
$panel_id_2 = time() . '-2-' . rand(0, 100);
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
	)
);
$params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Title', 'uncode-core') ,
		'param_name' => 'title',
		'description' => esc_html__('Enter text which will be used as module title. Leave blank if no title is needed.', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Active section', 'uncode-core') ,
		'param_name' => 'active_tab',
		'description' => esc_html__('Enter section number to be active on load. If you need your accordion is closed on page load please apply the value “0”.', 'uncode-core')
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
		'type' => 'checkbox',
		'heading' => esc_html__('Open Panels', 'uncode-core') ,
		'param_name' => 'no_toggle',
		'description' => esc_html__('Activate this option not to close the other panels. NB. Suggested for when there is a lot of content inside Panels.', 'uncode-core') ,
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
			esc_html__('Scroll to panel', 'uncode-core') => '',
			esc_html__('Scroll to parent row', 'uncode-core') => "row",
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Special events', 'uncode-core') ,
		'param_name' => 'panel_event',
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
		'description' => esc_html__('Remove default lazy loading for images in not active panels.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Titles typography', 'uncode-core') ,
		'param_name' => 'typography',
		'description' => esc_html__('Set the font of panel titles. You can set the default, inherit from the column, or a custom typography.', 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__("Inherit", 'uncode-core') => 'yes',
			esc_html__('Custom', 'uncode-core') => 'advanced',
		)
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Icon', 'uncode-core') ,
		'param_name' => 'sign',
		'value' => array(
			esc_html__('Chevron', 'uncode-core') => '',
			esc_html__('Plus', 'uncode-core') => "plus",
			esc_html__('None', 'uncode-core') => "none",
			// esc_html__('Above', 'uncode-core') => 'above',
		) ,
		'description' => esc_html__('Set the icon type for the accordion elements.', 'uncode-core'),
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Icon size', 'uncode-core') ,
		'param_name' => 'sign_size',
		'value' => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core') => "sm",
			esc_html__('Medium', 'uncode-core') => 'md',
		) ,
		'description' => esc_html__('Set the size of the icon.', 'uncode-core'),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove outer border', 'uncode-core') ,
		'param_name' => 'label_border',
		'description' => esc_html__('Removes the outer border between the Accordion panels.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		)
	) ,	
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove inner border', 'uncode-core') ,
		'param_name' => 'content_border',
		'description' => esc_html__('Removes the border between the title and the content.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		)
	) ,	
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove default padding', 'uncode-core') ,
		'param_name' => 'title_padding',
		'description' => esc_html__('Removes the default padding. Useful when setting the Custom Padding.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'content_border',
			'not_empty' => true
		) ,
	) ,	
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Custom padding", 'uncode-core') ,
		"param_name" => "gutter_simple",
		"min" => 0,
		"max" => 2,
		"step" => 1,
		"value" => 0,
		"description" => esc_html__("Set custom padding.", 'uncode-core') ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Remove lateral padding', 'uncode-core') ,
		'param_name' => 'no_h_padding',
		'description' => esc_html__('Removes the side padding of Accordion panels.', 'uncode-core') ,
		'value' => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		),
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
		"heading" => esc_html__("Active panel border radius", 'uncode-core') ,
		"param_name" => "radius",
		"description" => esc_html__("Set the border radius for the active panel.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
			esc_html__('Huge', 'uncode-core') => 'hg',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Active panel shadow", 'uncode-core') ,
		"param_name" => "shadow",
		"description" => esc_html__("Set the shadow for the active panel.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Active panel shadow darker", 'uncode-core') ,
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
);
vc_map(array(
	'name' => esc_html__('Accordion', 'uncode-core') ,
	'base' => 'vc_accordion',
	'weight' => 9250,
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'fa fa-indent',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
	),
	'description' => esc_html__('Panels content collapse', 'uncode-core') ,
	'params' => array_merge($params, array_merge($tab_label_typo_params, $extra_params)),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . esc_html__('Add section', 'uncode-core') . '"><span class="vc_icon"></span> <span class="tab-label">' . esc_html__('Add section', 'uncode-core') . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . esc_html__('Section 1', 'uncode-core') . '" tab_id="' . $panel_id_1 . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . esc_html__('Section 2', 'uncode-core') . '" tab_id="' . $panel_id_2 . '"][/vc_accordion_tab]
',
	'js_view' => 'UncodePanelsView'
));
vc_map(array(
	'name' => esc_html__('Section', 'uncode-core') ,
	'base' => 'vc_accordion_tab',
	'weight' => 9250,
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'uncode-core') ,
			'param_name' => 'title',
			'description' => esc_html__('Accordion section title.', 'uncode-core')
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
			'heading' => esc_html__('Icon size', 'uncode-core') ,
			'param_name' => 'icon_size',
			'value' => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Small', 'uncode-core') => "sm",
				esc_html__('Medium', 'uncode-core') => 'md',
			) ,
			'description' => esc_html__('Set the size of the icon.', 'uncode-core'),
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			) ,
		) ,
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon position', 'uncode-core') ,
			'param_name' => 'icon_position',
			'value' => array(
				esc_html__('Left', 'uncode-core') => '',
				esc_html__('Right', 'uncode-core') => "right",
				// esc_html__('Above', 'uncode-core') => 'above',
			) ,
			'description' => esc_html__('Specify title location.', 'uncode-core'),
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
	'js_view' => 'VcAccordionTabView'
));
