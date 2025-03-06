<?php
/**
 * VC Media Gallery config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$add_text_size = uncode_core_vc_params_get_text_size( 'single_text_lead', false, esc_html__("Blocks", 'uncode-core') );

$gallery_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'gallery_back_color', esc_html__("Gallery background color", 'uncode-core'), esc_html__("Specify a background color for the module.", 'uncode-core'), esc_html__('Module', 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'type', 'value' => array( 'isotope', 'carousel', 'justified', 'css_grid' ) ) ) );
list( $add_gallery_back_color_type, $add_gallery_back_color, $add_gallery_back_color_solid, $add_gallery_back_color_gradient ) = $gallery_back_color_options;

$filter_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'filter_back_color', esc_html__("Filter color", 'uncode-core'), esc_html__("Specify a background color for the filter menu.", 'uncode-core'), esc_html__('Module', 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'filtering', 'value' => 'yes' ) ) );
list( $add_filter_back_color_type, $add_filter_back_color, $add_filter_back_color_solid, $add_filter_back_color_gradient ) = $filter_back_color_options;

$infinite_button_color_options = uncode_core_vc_params_get_advanced_color_options( 'infinite_button_color', esc_html__("Load more button color", 'uncode-core'), esc_html__("Specify a background color for the load more button.", 'uncode-core'), esc_html__("Module", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'infinite_button', 'value' => 'yes' ), 'default_label' => true ) );
list( $add_infinite_button_color_type, $add_infinite_button_color, $add_infinite_button_color_solid, $add_infinite_button_color_gradient ) = $infinite_button_color_options;

$footer_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'footer_back_color', esc_html__("Load more color", 'uncode-core'), esc_html__("Specify a background color for the infinite.", 'uncode-core'), esc_html__("Module", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'infinite_button', 'value' => 'yes' ), 'default_label' => true ) );
list( $add_footer_back_color_type, $add_footer_back_color, $add_footer_back_color_solid, $add_footer_back_color_gradient ) = $footer_back_color_options;

$breakpoint_lg_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_lg', esc_html__("Breakpoint First", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 1000, 'cols' => 3 ), array( 'dependency' => array( 'element' => 'type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_lg_cols, $add_breakpoint_lg_screen ) = $breakpoint_lg_options;

$breakpoint_md_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_md', esc_html__("Breakpoint Second", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 600, 'cols' => 2 ), array( 'dependency' => array( 'element' => 'type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_md_cols, $add_breakpoint_md_screen ) = $breakpoint_md_options;

$breakpoint_sm_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_sm', esc_html__("Breakpoint Third", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 480, 'cols' => 1 ), array( 'dependency' => array( 'element' => 'type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_sm_cols, $add_breakpoint_sm_screen ) = $breakpoint_sm_options;

$add_parallax_options = uncode_core_vc_params_get_parallax_options( esc_html__("Blocks", 'uncode-core'), 'single_parallax_intensity', 'single_css_animation' );
$add_parallax_centered_options = uncode_core_vc_params_get_parallax_centered_options( esc_html__("Blocks", 'uncode-core'), 'single_parallax_centered', 'single_parallax_intensity' );

$simplify_single_tab = get_option( 'uncode_core_settings_opt_simplify_single_block_tab' ) === 'on' ? true : false;
$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);

$custom_grid_content_block_id = uncode_core_vc_params_get_cb_dropdown(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Content Block', 'uncode-core') ,
		'param_name' => 'custom_grid_content_block_id',
		'description' => esc_html__('Choose a Content Block.', 'uncode-core'),
		'group' => esc_html__('General', 'uncode-core') ,
		'value' => array(),
		'dependency' => array(
			'element' => 'type',
			'value' => 'custom_grid',
		)
	)
);

$media_gallery_params = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Title', 'uncode-core') ,
		'param_name' => 'title',
		'description' => esc_html__('Enter text which will be used as module title. Leave blank if no title is needed.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		'admin_label' => true,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'el_id',
		'value' => (function_exists('uncode_big_rand')) ? uncode_big_rand() : rand() ,
		'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout', 'uncode-core') ,
		'param_name' => 'type',
		'value' => array(
			esc_html__('Grid', 'uncode-core') => 'isotope',
			esc_html__('CSS Grid', 'uncode-core') => 'css_grid',
			esc_html__('Carousel', 'uncode-core') => 'carousel',
			esc_html__('Justify', 'uncode-core') => 'justified',
			esc_html__('Pattern', 'uncode-core') => 'custom_grid',
			esc_html__('Sticky Scroll', 'uncode-core') => 'sticky-scroll',
			esc_html__('Marquee', 'uncode-core') => 'linear',
		) ,
		'admin_label' => true,
		'description' => esc_html__('Specify the module layout mode.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Direction', 'uncode-core') ,
		'param_name' => 'sticky_dir',
		'value' => array(
			esc_html__('Left to Right', 'uncode-core') => '',
			esc_html__('Right to Left', 'uncode-core') => 'left',
		) ,
		'description' => esc_html__('Set the direction of the Sticky Scroll elements.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Wrapper', 'uncode-core') ,
		'param_name' => 'sticky_wrap',
		'value' => array(
			esc_html__('Row', 'uncode-core') => '',
			esc_html__('Column', 'uncode-core') => 'column',
		) ,
		'description' => esc_html__('Set the wrapper of the Sticky Scroll. If you insert other elements within the same Row that get stuck, use \'Column\', alternatively \'Row\'.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout mode', 'uncode-core') ,
		'param_name' => 'isotope_mode',
		"description" => wp_kses(__("Specify the module layout mode. <a href='http://isotope.metafizzy.co/layout-modes.html' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		"value" => array(
			esc_html__('Masonry', 'uncode-core') => 'masonry',
			esc_html__('Fit Rows', 'uncode-core') => 'fitRows',
			esc_html__('Cells by Row', 'uncode-core') => 'cellsByRow',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
			esc_html__('Packery', 'uncode-core') => 'packery',
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'isotope',
		) ,
	) ,
	$custom_grid_content_block_id,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Random order", 'uncode-core') ,
		"param_name" => "random",
		"description" => esc_html__("Activate this to have a media random order. NB. Limited support with Single tab modifications.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("General", 'uncode-core') ,
	) ,
	array(
		'type' => 'media_element',
		'heading' => esc_html__('Media', 'uncode-core') ,
		'param_name' => 'medias',
		'has_galleries' => true,
		"edit_field_class" => 'vc_column uncode_gallery',
		'value' => '',
		'description' => esc_html__('Specify images from Media Library.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dynamic Media", 'uncode-core') ,
		"param_name" => "dynamic",
		"description" => esc_html__("Activate to display medias from Select Media or Product Gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Dynamic source", 'uncode-core') ,
		"param_name" => "dynamic_source",
		"description" => esc_html__("Set the source for the Dynamic Media.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'dynamic',
			'not_empty' => true,
		) ,
		"value" => array(
			esc_html__('Gallery/Media', 'uncode-core') => '',
			esc_html__('Gallery/Media with Featured Image', 'uncode-core') => 'featured',
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Explode albums", 'uncode-core') ,
		"param_name" => "explode_albums",
		"description" => esc_html__("Activate to treat gallery elements as single media part of a unique gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Items', 'uncode-core') ,
		'param_name' => 'grid_items',
		'description' => esc_html__('Specify the number of columns for this breakpoint.', 'uncode-core') ,
		"std" => '4',
		"value" => array(
				esc_html__('1 Column', 'uncode-core') => '1',
				esc_html__('2 Columns', 'uncode-core') => '2',
				esc_html__('3 Columns', 'uncode-core') => '3',
				esc_html__('4 Columns', 'uncode-core') => '4',
				esc_html__('5 Columns', 'uncode-core') => '5',
				esc_html__('6 Columns', 'uncode-core') => '6',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'css_grid',
		) ,
	) ,
	$add_breakpoint_lg_cols,
	$add_breakpoint_lg_screen,
	$add_breakpoint_md_cols,
	$add_breakpoint_md_screen,
	$add_breakpoint_sm_cols,
	$add_breakpoint_sm_screen,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Layout style", 'uncode-core') ,
		"param_name" => "style_preset",
		"description" => esc_html__("Select the visualization mode.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => 'masonry',
			esc_html__('Metro', 'uncode-core') => 'metro',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	) ,
	$add_gallery_back_color_type,
	$add_gallery_back_color,
	$add_gallery_back_color_solid,
	$add_gallery_back_color_gradient,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Desktop', 'uncode-core') ,
		'param_name' => 'carousel_lg',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of columns for the viewport from 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Tablet', 'uncode-core') ,
		'param_name' => 'carousel_md',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of columns for the viewport from 570px to 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Device', 'uncode-core') ,
		'param_name' => 'carousel_sm',
		'value' => 1,
		'description' => esc_html__('Insert the numbers of columns for the viewport from 0 to 570px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Row height', 'uncode-core') ,
		'param_name' => 'justify_row_height',
		'value' => 250,
		'description' => esc_html__('The preferred height of rows in pixel.', 'uncode-core'),
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'justified',
			) ,
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Optional max row height', 'uncode-core') ,
		'param_name' => 'justify_max_row_height',
		'value' => '',
		'description' => esc_html__('The preferred maximum height of rows in pixel. Note that with this option can crop the images if they need to be higher to be justified.', 'uncode-core'),
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'justified',
			) ,
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Justify last row", 'uncode-core') ,
		"param_name" => "justify_last_row",
		"description" => esc_html__("Decide to justify the last row, to hide it if it can't be justified or to align them to the left, center or right", 'uncode-core') ,
		"value" => array(
			esc_html__('Default (no justisfied, left aligned)', 'uncode-core') => 'nojustify',
			esc_html__('Hide', 'uncode-core') => 'hide',
			esc_html__('Align to the center', 'uncode-core') => 'center',
			esc_html__('Align to the right', 'uncode-core') => 'right',
		) ,
		"std" => "nojustify",
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'justified',
			) ,
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'sticky_thumb_size',
		'description' => esc_html__('Specify the aspect ratio for the media. Please note that if you use \'Fluid\', or \'Relative\', it\'s necessary to set a Row height value on the Row container settings.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
			esc_html__('Fluid', 'uncode-core') => 'fluid',
			esc_html__('Relative', 'uncode-core') => 'relative',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll'
			)
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Desktop', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_lg',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Tablet', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_md',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 570px to 960px. NB. If you disable it on tablets, it will automatically set to 1.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Device', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_sm',
		'value' => 1,
		'description' => esc_html__('Insert the numbers of items for the viewport from 0 to 570px. NB. If you disable it on devices, it will automatically set to 1.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Desktop", 'uncode-core') ,
		"param_name" => "sticky_th_vh_lg",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Desktop.", 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Tablet", 'uncode-core') ,
		"param_name" => "sticky_th_vh_md",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Tablet.", 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Device", 'uncode-core') ,
		"param_name" => "sticky_th_vh_sm",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Device.", 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove menu height", 'uncode-core') ,
		"param_name" => "sticky_th_vh_minus",
		"description" => esc_html__("Activate this option to remove the menu height from the fluid calculations.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid',
			) ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'thumb_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filtering", 'uncode-core') ,
		"param_name" => "filtering",
		"description" => esc_html__("Activate to enable the filters.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array('isotope', 'justified', 'css_grid'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter Skin", 'uncode-core') ,
		"param_name" => "filter_style",
		"description" => esc_html__("Specify the filter Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter typography", 'uncode-core') ,
		"param_name" => "filter_typography",
		"description" => esc_html__("Specify the filter typography.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Inherit / Column', 'uncode-core') => 'inherit'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	$add_filter_back_color_type,
	$add_filter_back_color,
	$add_filter_back_color_solid,
	$add_filter_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter full width", 'uncode-core') ,
		"param_name" => "filtering_full_width",
		"description" => esc_html__("Activate this to force the full width of the filter.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter position", 'uncode-core') ,
		"param_name" => "filtering_position",
		"description" => esc_html__("Specify the filter menu positioning.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter uppercase", 'uncode-core') ,
		"param_name" => "filtering_uppercase",
		"description" => esc_html__("Activate this to have the filter menu in uppercase.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter mobile hidden", 'uncode-core') ,
		"param_name" => "filter_mobile",
		"description" => esc_html__("Activate this to hide the filter menu in mobile mode.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter mobile align", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_align",
		"description" => esc_html__("Set the alignment for the filter mobile.", 'uncode-core') ,
		"value" => array(
			esc_html__('Center', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filter_mobile',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter mobile dropdown", 'uncode-core') ,
		"param_name" => "filter_mobile_dropdown",
		"description" => esc_html__("Activate the dropdown style for the filter mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filter_mobile',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Filter dropdown text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_dropdown_text",
		"description" => esc_html__("Activate the filter dropdown text. NB. The default value is 'Categories'.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile_dropdown',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter scroll", 'uncode-core') ,
		"param_name" => "filter_scroll",
		"description" => esc_html__("Activate this to scroll to the  module when filtering.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter sticky", 'uncode-core') ,
		"param_name" => "filter_sticky",
		"description" => esc_html__("Activate this to have a sticky filter menu when scrolling.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter 'Show All' opposite", 'uncode-core') ,
		"param_name" => "filter_all_opposite",
		"description" => esc_html__("Activate this to position the 'Show All' button opposite to the rest.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
		'dependency' => array(
			'element' => 'filtering_position',
			'value' => array(
				'left',
				'right'
			)
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Filter 'Show All' text", 'uncode-core') ,
		"param_name" => "filter_all_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Show All'.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Load More", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite",
		"description" => wp_kses(__("Activate this to load more items with scrolling.<br>NB. This option doesn't work is combination with the 'Random' order or with multiple isotope/galleries in the same page.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'justified', 'css_grid' )
		)
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Load More Preloaded', 'uncode-core') ,
		'param_name' => 'infinite_preloaded_items',
		'value' => 10,
		'description' => 'Defines the number of elements that are shown when the page loads.' ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		)
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Load More Loading', 'uncode-core') ,
		'param_name' => 'infinite_loading_items',
		'value' => 10,
		'description' => 'Defines the number of elements that are loaded with each iteration of the Load More.' ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Load more style", 'uncode-core') ,
		"param_name" => "infinite_button",
		'value' => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Preloader', 'uncode-core') => 'icon',
			esc_html__('Button', 'uncode-core') => 'yes',
		) ,
		"description" => esc_html__("Choose the load more style.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		)
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button hover effect", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_hover_fx",
		"description" => esc_html__("Specify an effect on hover state.", 'uncode-core') ,
		"value" => array(
			'Inherit' => '',
			'Outlined' => 'outlined',
			'Flat' => 'full-colored',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Load more button outlined inverse", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_outline",
		"description" => esc_html__("Outlined buttons don't have a full background color. NB: this option is available only with Load More Button Hover Effect > Outlined.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
  array(
		"type" => "textfield",
		"heading" => esc_html__("Load more button text", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Load more'.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button shape", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_shape",
		"description" => esc_html__("Specify the load more button shape.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'btn-default-shape',
			esc_html__('Round', 'uncode-core') => 'btn-round',
			esc_html__('Circle', 'uncode-core') => 'btn-circle',
			esc_html__('Square', 'uncode-core') => 'btn-square'
		) ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	$add_infinite_button_color_type,
	$add_infinite_button_color,
	$add_infinite_button_color_solid,
	$add_infinite_button_color_gradient,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Load more Skin", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "footer_style",
		"description" => esc_html__("Specify the infinite Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	$add_footer_back_color_type,
	$add_footer_back_color,
	$add_footer_back_color_solid,
	$add_footer_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Load more full width", 'uncode-core') ,
		// 'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "footer_full_width",
		"description" => esc_html__("Activate this to force the full width of the infinite.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Items gap", 'uncode-core') ,
		"param_name" => "gutter_size",
		"min" => 0,
		"max" => 6,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the items gap.", 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'justified',
				'sticky-scroll',
				'linear',
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Inner Padding", 'uncode-core') ,
		"param_name" => "inner_padding",
		"description" => esc_html__("Activate this to have an inner padding with the same size as the items gap.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Vertical alignment", 'uncode-core') ,
		"param_name" => "css_grid_v_align",
		"description" => esc_html__("Select the vertical alignment. NB. With CSS Grid it's possible to select the vertical alignment of thumbnails between them if they have different heights.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
		) ,
		"std" => '',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Equal height", 'uncode-core') ,
		"param_name" => "css_grid_equal_height",
		"description" => esc_html__("With the 'Content Under Image' Block Layout, activate this to create equal height thumbnails. NB. The equal height is applied to the container element so, for example, it is visible if you have the Border or Shadow options.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'css_grid',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Direction', 'uncode-core') ,
		'param_name' => 'linear_orientation',
		'value' => array(
			esc_html__('Horizontal', 'uncode-core') => '',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
		) ,
		'description' => esc_html__('Set the direction for Marquee. NB. If you use Vertical orientation please apply the \'overflow-hidden\' class to the container Row if you wish to limit it to the Row in which it is inserted.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'linear',
			) ,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Alignment", 'uncode-core') ,
		"description" => esc_html__("Sets the alignment for thumbnails.", 'uncode-core') ,
		"param_name" => "linear_v_alingment",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
		) ,
		'dependency' => array(
			'element' => 'linear_orientation',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Alignment", 'uncode-core') ,
		"description" => esc_html__("Sets the alignment for thumbnails.", 'uncode-core') ,
		"param_name" => "linear_h_alingment",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'dependency' => array(
			'element' => 'linear_orientation',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Size", 'uncode-core') ,
		"param_name" => "size_by",
		"description" => esc_html__("Set the size of thumbnails, preferably use a Clamp value, ex: clamp(100px, 20vw, 450px)", 'uncode-core') ,
		"value" => array(
			esc_html__('Width', 'uncode-core') => '',
			esc_html__('Height', 'uncode-core') => 'height'
		) ,
		"std" => "",
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array('linear'),
		) ,
	) ,
	array(
		'type' => 'textfield',
		'std' => 'clamp(100px, 20vw, 450px)',
		'heading' => esc_html__('Width', 'uncode-core') ,
		'param_name' => 'linear_width',
		'description' => esc_html__('Declares the width of the thumbnail.', 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'size_by',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Height', 'uncode-core') ,
		'param_name' => 'linear_height',
		'description' => esc_html__('Declares the height of the thumbnail.', 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'size_by',
			'value' => array('height'),
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Animation", 'uncode-core') ,
		"description" => esc_html__("Set the Marquee animation type.", 'uncode-core') ,
		"param_name" => "linear_animation",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Marquee Auto (right to left)', 'uncode-core') => 'marquee',
			esc_html__('Marquee Auto (left to right)', 'uncode-core') => 'marquee-opposite',
			esc_html__('Marquee Scroll (right to left)', 'uncode-core') => 'marquee-scroll',
			esc_html__('Marquee Scroll (left to right)', 'uncode-core') => 'marquee-scroll-opposite',
			esc_html__('None', 'uncode-core') => 'none',
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'linear'
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Speed", 'uncode-core') ,
		"param_name" => "linear_speed",
		"description" => esc_html__("Set the Marquee animation speed.", 'uncode-core') ,
		"min" => -4,
		"max" => 4,
		"step" => 1,
		"value" => 0,
		'dependency' => array(
			'element' => 'type',
			'value' => array('linear'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Edge to Edge", 'uncode-core') ,
		"param_name" => "marquee_clone",
		"description" => esc_html__("Repeat the Marquee to cover the viewport.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array(
				'marquee-scroll',
				'marquee-scroll-opposite',
			),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Hover", 'uncode-core') ,
		"param_name" => "linear_hover",
		"description" => esc_html__("Choose to reduce or stop the Marquee animation when hovered.", 'uncode-core') ,
		"value" => array(
			esc_html__('Disabled', 'uncode-core') => '',
			esc_html__('Slow Down', 'uncode-core') => 'yes',
			esc_html__('Pause', 'uncode-core') => 'pause'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array('marquee', 'marquee-opposite'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Draggable", 'uncode-core') ,
		"param_name" => "draggable",
		"description" => esc_html__("Select this option to drag the Marquee.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array('marquee', 'marquee-opposite', 'marquee-scroll', 'marquee-scroll-opposite'),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze",
		"description" => esc_html__("Select this option to stop the Marquee animation.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array('marquee', 'marquee-opposite', 'marquee-scroll', 'marquee-scroll-opposite'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze_desktop",
		"description" => esc_html__("Select this option to stop the Marquee animation on desktop.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'marquee_freeze',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Mobile Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze_mobile",
		"description" => esc_html__("Select this option to stop the Marquee animation on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'marquee_freeze',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Blurred margins", 'uncode-core') ,
		"param_name" => "marquee_blur",
		"description" => esc_html__("[...]", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array(
				'marquee',
				'marquee-opposite',
				'marquee-scroll',
				'marquee-scroll-opposite',
			),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Media Elements', 'uncode-core') ,
		'param_name' => 'media_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
		'value' => 'media|lightbox|original,icon',
		"group" => esc_html__("Module", 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'custom_link',
						esc_html__('Custom link', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'caption',
				esc_html__('Caption', 'uncode-core') ,
			) ,
			array(
				'description',
				esc_html__('Description', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'team-social',
				esc_html__('Team socials', 'uncode-core') ,
			) ,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items height", 'uncode-core') ,
		"param_name" => "carousel_height",
		"description" => esc_html__("Specify the carousel items height.", 'uncode-core') ,
		"value" => array(
			esc_html__('Auto', 'uncode-core') => '',
			esc_html__('Equal height', 'uncode-core') => 'equal',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => array(
				'',
				'one-one',
				'two-one',
				'three-two',
				'four-three',
				'ten-three',
				'sixteen-nine',
				'twentyone-nine',
				'one-two',
				'two-three',
				'three-four',
				'three-ten',
				'nine-sixteen',
				'five-four',
				'four-five',
			),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items vertical alignment", 'uncode-core') ,
		"param_name" => "carousel_v_align",
		"description" => esc_html__("Specify the items vertical alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_height',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Autoheight", 'uncode-core') ,
		"param_name" => "carousel_autoh",
		"description" => esc_html__("Activate to adjust the height automatically when possible.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => array(
				'',
				'one-one',
				'two-one',
				'three-two',
				'four-three',
				'ten-three',
				'sixteen-nine',
				'twentyone-nine',
				'one-two',
				'two-three',
				'three-four',
				'three-ten',
				'nine-sixteen',
				'five-four',
				'four-five',
			),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Transition type', 'uncode-core') ,
		'param_name' => 'carousel_type',
		"value" => array(
			esc_html__('Slide', 'uncode-core') => '',
			esc_html__('Fade', 'uncode-core') => 'fade'
		) ,
		'description' => esc_html__('Specify the transition type.<br />NB. Fade option works only with 1 item selected to create a slideshow.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Auto rotate slides', 'uncode-core') ,
		'param_name' => 'carousel_interval',
		'value' => array(
			3000,
			5000,
			10000,
			15000,
			esc_html__('Disable', 'uncode-core') => 0
		) ,
		'description' => esc_html__('Specify the automatic timeout between slides in milliseconds.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Navigation speed', 'uncode-core') ,
		'param_name' => 'carousel_navspeed',
		'value' => array(
			200,
			400,
			700,
			1000,
		) ,
		'std' => 400,
		'description' => esc_html__('Specify the navigation speed between slides in milliseconds.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Loop", 'uncode-core') ,
		"param_name" => "carousel_loop",
		"description" => esc_html__("Activate the loop option to make the carousel infinite.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Overflow visible", 'uncode-core') ,
		"param_name" => "carousel_overflow",
		"description" => esc_html__("Activate this option to make the element overflow its container (get rid of the cropping area).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced Navigation", 'uncode-core') ,
		"param_name" => "advanced_nav",
		"description" => esc_html__("Activate to have the Advanced Navigation Target and hide the native Carousel navigation options.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Carousel target', 'uncode-core') ,
		'param_name' => 'el_id1',
		'value' => '',
		'description' => esc_html__("It represents the Target ID for advanced navigation, copy and paste into the Carousel/Slider Navigation module to connect the two modules. PS. If the two modules are in the same Row, there is no need to connect them because the connection is automatic.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"edit_field_class" => "target-advanced_nav input-readonly",
		'dependency' => array(
			'element' => 'advanced_nav',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Arrows", 'uncode-core') ,
		"param_name" => "carousel_nav",
		"description" => esc_html__("Activate this to show arrows.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Arrows Mobile", 'uncode-core') ,
		"param_name" => "carousel_nav_mobile",
		"description" => esc_html__("Activate this to show arrows for mobile devices.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows Skin", 'uncode-core') ,
		"param_name" => "carousel_nav_skin",
		"description" => esc_html__("Specify the arrows Skin.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots", 'uncode-core') ,
		"param_name" => "carousel_dots",
		"description" => esc_html__("Activate this to show dots in the bottom.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots Extra Top", 'uncode-core') ,
		"param_name" => "carousel_dots_space",
		"description" => esc_html__("Activate this to add extra top space to the Dots.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'std' => '',
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dots',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots Mobile", 'uncode-core') ,
		"param_name" => "carousel_dots_mobile",
		"description" => esc_html__("Activate this to show dots in the bottom for mobile devices.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots inside", 'uncode-core') ,
		"param_name" => "carousel_dots_inside",
		"description" => esc_html__("Activate to have the dots inside the carousel.", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Dots Position', 'uncode-core') ,
		'param_name' => 'carousel_dot_position',
		"edit_field_class" => "hide-advanced_nav",
		"value" => array(
			esc_html__('Center', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'description' => esc_html__('Specify the position of dots.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Dots Padding", 'uncode-core') ,
		"param_name" => "carousel_dot_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the distance from the carousel horizontal edge", 'uncode-core') ,
		"edit_field_class" => "hide-advanced_nav",
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dots_inside',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Textual carousel", 'uncode-core') ,
		"param_name" => "carousel_textual",
		"description" => esc_html__("Activate this to have a carousel with only text.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide quotes", 'uncode-core') ,
		"param_name" => "hide_quotes",
		"description" => esc_html__("Activate this to hide the automatic quotes.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_textual',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Off-Grid", 'uncode-core') ,
		"param_name" => "off_grid",
		"description" => esc_html__("Activate this to put odd or even elements Off-Grid.<br />NB. Please note that this option cannot be combined with the Filtering.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'std' => '',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'isotope_mode',
			'value' => array(
				'masonry',
				'packery'
			),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Off-Grid Items Rhythm", 'uncode-core') ,
		"param_name" => "off_grid_element",
		"description" => esc_html__("Select what item to put Off-Grid.", 'uncode-core') ,
		'value' => array(
			esc_html__('Odd', 'uncode-core') => 'odd',
			esc_html__('Even', 'uncode-core') => 'even',
			esc_html__('Custom', 'uncode-core') => 'custom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Off-Grid custom value', 'uncode-core') ,
		'param_name' => 'off_grid_custom',
		'value' => '0,2',
		'description' => wp_kses(__('Enter a number or a series of comma separated numbers.<br />NB. The first element is identified by 0.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid_element',
			'value' => array(
				'custom',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Off-Grid value", 'uncode-core') ,
		"param_name" => "off_grid_val",
		"min" => 1,
		"max" => 7,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the shift value.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Off-Grid All Items", 'uncode-core') ,
		"param_name" => "off_grid_all",
		"description" => esc_html__("Set this option to apply the Off-Grid to all elements. Normally it is applied only to the elements of the first row.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - First step', 'uncode-core') ,
		'param_name' => 'screen_lg',
		'value' => 1000,
		'description' => wp_kses(__('Insert the isotope large layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - Second step', 'uncode-core') ,
		'param_name' => 'screen_md',
		'value' => 600,
		'description' => wp_kses(__('Insert the isotope medium layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - Third step', 'uncode-core') ,
		'param_name' => 'screen_sm',
		'value' => 480,
		'description' => wp_kses(__('Insert the isotope small layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not Active Items Transparent", 'uncode-core') ,
		"param_name" => "carousel_half_opacity",
		"description" => esc_html__("Activate this option to make semitransparent not active items.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not active items scaled", 'uncode-core') ,
		"param_name" => "carousel_scaled",
		"description" => esc_html__("Activate this option to scale not active items.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not Active Items Not Clickable", 'uncode-core') ,
		"param_name" => "carousel_pointer_events",
		"description" => esc_html__("Activate this option to make Not Active Items Not Clickable.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Stage padding", 'uncode-core') ,
		"description" => esc_html__("Activate this option to add left and right padding style onto stage-wrapper.", 'uncode-core') ,
		"param_name" => "stage_padding",
		"min" => 0,
		"max" => 75,
		"step" => 5,
		"value" => 0,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced Video Settings", 'uncode-core') ,
		"param_name" => "advanced_videos",
		"description" => esc_html__("Activate the Videos tab with special options for autoplay videos. NB. These options can't work with Metro layout.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
				'css_grid',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Block layout", 'uncode-core') ,
		"param_name" => "single_text",
		"description" => esc_html__("Specify the text positioning inside the thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Content overlay', 'uncode-core') => 'overlay',
			esc_html__('Content under image', 'uncode-core') => 'under'
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope','carousel','custom_grid','sticky-scroll','css_grid','linear'
			) ,
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Width", 'uncode-core') ,
		"param_name" => "single_width",
		"description" => esc_html__("Specify the thumbnail width.", 'uncode-core') ,
		"value" => $units,
		"std" => "4",
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Height", 'uncode-core') ,
		"param_name" => "single_height",
		"description" => esc_html__("Specify the thumbnail height.", 'uncode-core') ,
		"value" => array(
			esc_html__("Default", 'uncode-core') => ""
		) + $units,
		"std" => "",
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
			) ,
		) ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => 'metro',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => 'masonry',
		) ,
		'admin_label' => true,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'custom_grid_images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array('custom_grid'),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'css_grid_images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array('css_grid', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "single_style",
		"description" => esc_html__("Specify the Skin inside the content thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Background color", 'uncode-core') ,
		"param_name" => "single_back_color",
		"description" => esc_html__("Specify a background color for the thumbnail.", 'uncode-core') ,
		"value" => $uncode_colors,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Shape', 'uncode-core') ,
		'param_name' => 'single_shape',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Rounded', 'uncode-core') => 'round',
			esc_html__('Circular', 'uncode-core') => 'circle'
		) ,
		'description' => esc_html__('Specify one if you want to shape the block.', 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'std' => '',
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => ' ',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
			esc_html__('Huge', 'uncode-core') => 'hg',
		),
		"std" => ' ',
		'dependency' => array(
			'element' => 'single_shape',
			'value' => 'round'
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Overlay color", 'uncode-core') ,
		"param_name" => "single_overlay_color",
		"description" => esc_html__("Specify a background color for the thumbnail.", 'uncode-core') ,
		"value" => $uncode_colors,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay coloration", 'uncode-core') ,
		"param_name" => "single_overlay_coloration",
		"description" => wp_kses(__("Specify the coloration style for the overlay. NB. For the gradient you can't customize the overlay color.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => array(
			esc_html__('Fully colored', 'uncode-core') => '',
			esc_html__('Gradient top', 'uncode-core') => 'top_gradient',
			esc_html__('Gradient bottom', 'uncode-core') => 'bottom_gradient',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Overlay Blend Mode", 'uncode-core') ,
		"param_name" => "single_overlay_blend",
		"description" => esc_html__("Specify a Blend Mode.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core'),
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Multiply', 'uncode-core') => 'multiply',
			esc_html__('Screen', 'uncode-core') => 'screen',
			esc_html__('Overlay', 'uncode-core') => 'overlay',
			esc_html__('Darken', 'uncode-core') => 'darken',
			esc_html__('Lighten', 'uncode-core') => 'lighten',
			esc_html__('Color dodge', 'uncode-core') => 'color-dodge',
			esc_html__('Color burn', 'uncode-core') => 'color-burn',
			esc_html__('Hard light', 'uncode-core') => 'hard-light',
			esc_html__('Soft light', 'uncode-core') => 'soft-light',
			esc_html__('Difference', 'uncode-core') => 'difference',
			esc_html__('Exclusion', 'uncode-core') => 'exclusion',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Overlay Opacity", 'uncode-core') ,
		"param_name" => "single_overlay_opacity",
		"min" => 1,
		"max" => 100,
		"step" => 1,
		"value" => 50,
		"description" => esc_html__("Set the overlay opacity.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay visibility", 'uncode-core') ,
		"param_name" => "single_overlay_visible",
		"description" => esc_html__("Activate this to show the overlay as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay animation", 'uncode-core') ,
		"param_name" => "single_overlay_anim",
		"description" => esc_html__("Activate this to animate the overlay on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text visibility", 'uncode-core') ,
		"param_name" => "single_text_visible",
		"description" => esc_html__("Activate this to show the text as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation", 'uncode-core') ,
		"param_name" => "single_text_anim",
		"description" => esc_html__("Activate this to animate the text on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation type", 'uncode-core') ,
		"param_name" => "single_text_anim_type",
		"description" => esc_html__("Specify the animation type.", 'uncode-core') ,
		"value" => array(
			esc_html__('Opacity', 'uncode-core') => '',
			esc_html__('Bottom to top', 'uncode-core') => 'btt',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text_anim',
			'value' => 'yes',
		) ,
	) ,		array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration", 'uncode-core') ,
		"param_name" => "single_image_coloration",
		"description" => esc_html__("Specify the image coloration mode.", 'uncode-core') ,
		"value" => array(
			esc_html__('Standard', 'uncode-core') => '',
			esc_html__('Desaturated', 'uncode-core') => 'desaturated',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration animation", 'uncode-core') ,
		"param_name" => "single_image_color_anim",
		"description" => esc_html__("Activate this to animate the image coloration on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Static', 'uncode-core') => '',
			esc_html__('Animated', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image animation", 'uncode-core') ,
		"param_name" => "single_image_anim",
		"description" => esc_html__("Activate this to animate the image on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Image magnetic", 'uncode') ,
		"param_name" => "single_image_magnetic",
		"description" => esc_html__("Enable this option to enable the magnetic effect and slightly move the image according with the mouse position.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode') ,
		'dependency' => array(
			'element' => 'single_image_anim',
			'value' => array('yes'),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content alignment", 'uncode-core') ,
		"param_name" => "single_h_align",
		"description" => esc_html__("Specify the horizontal alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content vertical position", 'uncode-core') ,
		"param_name" => "single_v_position",
		"description" => esc_html__("Specify the text vertical position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content width reduced", 'uncode-core') ,
		"param_name" => "single_reduced",
		"description" => esc_html__("Specify the text reduction amount to shrink the overlay content dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('100%', 'uncode-core') => '',
			esc_html__('75%', 'uncode-core') => 'three_quarter',
			esc_html__('50%', 'uncode-core') => 'half',
			esc_html__('Limit Width', 'uncode-core') => 'limit-width',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Width Full Device", 'uncode-core') ,
		"param_name" => "single_reduced_mobile",
		"description" => esc_html__("Activate this to have 100% content wide on mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_reduced',
			'value' => array('three_quarter', 'half'),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content horizontal position", 'uncode-core') ,
		"param_name" => "single_h_position",
		"description" => esc_html__("Specify the text horizontal position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_reduced',
			'value' => array('three_quarter', 'half'),
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Content Padding", 'uncode-core') ,
		"param_name" => "single_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the text padding", 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Reduced Gap", 'uncode-core') ,
		"param_name" => "single_text_reduced",
		"description" => esc_html__("Activate this to have less space between all the text elements inside the thumbnail.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Multiple click areas", 'uncode-core') ,
		"param_name" => "single_elements_click",
		"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when available).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title semantic", 'uncode-core') ,
		"param_name" => "single_title_semantic",
		"description" => esc_html__("Specify element tag.", 'uncode-core') ,
		"value" => $heading_semantic,
		'std' => 'h3',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font family", 'uncode-core') ,
		"param_name" => "single_title_family",
		"description" => esc_html__("Specify the title font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title size", 'uncode-core') ,
		"param_name" => "single_title_dimension",
		"description" => esc_html__("Specify the title dimension.", 'uncode-core') ,
		"value" => $heading_size_h,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom size', 'uncode-core') ,
		'param_name' => 'heading_custom_size',
		'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_title_dimension',
			'value' => array('custom'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font weight", 'uncode-core') ,
		"param_name" => "single_title_weight",
		"description" => esc_html__("Specify the title font weight.", 'uncode-core') ,
		"value" => $heading_weight,
		'std' => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title text transform", 'uncode-core') ,
		"param_name" => "single_title_transform",
		"description" => esc_html__("Specify the title text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title line height", 'uncode-core') ,
		"param_name" => "single_title_height",
		"description" => esc_html__("Specify the title line height.", 'uncode-core') ,
		"value" => $heading_height,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title letter spacing", 'uncode-core') ,
		"param_name" => "single_title_space",
		"description" => esc_html__("Specify the title letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		'heading' => esc_html__('Title scale mobile', 'uncode-core') ,
		'param_name' => 'single_title_scale_mobile',
		'description' => esc_html__('Activate this to slightly reduce title size on mobile.', 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay' ,
		) ,
	) ,
	$add_text_size,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Meta typography', 'uncode-core') ,
		'param_name' => 'single_meta_custom_typo',
		'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font size", 'uncode-core') ,
		"param_name" => "single_meta_size",
		"description" => esc_html__("Specify the meta dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('Small', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'default',
			esc_html__('Large', 'uncode-core') => 'large',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font weight", 'uncode-core') ,
		"param_name" => "single_meta_weight",
		"description" => esc_html__("Specify the meta font weight.", 'uncode-core') ,
		"value" =>$heading_weight,
		"std" => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta text transform", 'uncode-core') ,
		"param_name" => "single_meta_transform",
		"description" => esc_html__("Specify the meta text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'uncode-core') ,
		'param_name' => 'single_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'value' => '',
		'settings' => array(
			'emptyIcon' => true,
			 // default true, display an "EMPTY" icon?
			'iconsPerPage' => 1100,
			 // default 100, how many icons per/page to display
			'type' => 'uncode'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		'type' => 'vc_link',
		'heading' => esc_html__('Custom link', 'uncode-core') ,
		'param_name' => 'single_link',
		'description' => esc_html__('Enter the custom link for the item.', 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow", 'uncode-core') ,
		"param_name" => "single_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Shadow type", 'uncode-core') ,
		"param_name" => "shadow_weight",
		"description" => esc_html__("Specify the shadow option preset.", 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
		'dependency' => array(
			'element' => 'single_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow Darker", 'uncode-core') ,
		"param_name" => "shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No border", 'uncode-core') ,
		"param_name" => "single_border",
		"description" => esc_html__("Activate this to remove the border around the block.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array_merge($add_css_animation_w_parallax, array(
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"param_name" => 'single_css_animation',
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'isotope',
				'css_grid',
				'carousel',
				'justified',
				'custom_grid',
				'sticky-scroll'
			)
		) ,
	)) ,
	array_merge($add_animation_speed, array(
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"param_name" => 'single_animation_speed',
		'dependency' => array(
			'element' => 'single_css_animation',
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
			)
		)
	)) ,
	array_merge($add_animation_delay, array(
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"param_name" => 'single_animation_delay',
		'dependency' => array(
			'element' => 'single_css_animation',
			'not_empty' => true
		)
	)) ,
	$add_parallax_options,
	$add_parallax_centered_options,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Animation sequential", 'uncode-core') ,
		"description" => esc_html__("Specifies whether the animation is applied sequentially.", 'uncode-core') ,
		"param_name" => "single_animation_sequential",
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core')  => 'no',
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'css_grid' ,
		) ,
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Animation first items", 'uncode-core') ,
		"description" => esc_html__("Animate only the first items.", 'uncode-core') ,
		"param_name" => "single_animation_first",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel' ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Type', 'uncode-core') ,
		'param_name' => 'post_matrix',
		'description' => esc_html__("Follow the IDs or create an independent Matrix.", 'uncode-core'),
		'value' => array(
			esc_html__('By ID', 'uncode-core') => '',
			esc_html__('By Matrix', 'uncode-core') => 'matrix',
		) ,
		'std' => '',
		'group' => esc_html__('Single', 'uncode-core'),
	) ,
	array(
		'type' => 'uncode_matrix_set_amount',
		'heading' => esc_html__('Matrix amount', 'uncode-core') ,
		'param_name' => 'matrix_amount',
		'description' => esc_html__('Enter an integer number that will define your matrix range. If you use the pagination mode the max limit is the post count itself.', 'uncode-core') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'value' => '5',
		'dependency' => array(
			'element' => 'post_matrix',
			'value' => 'matrix',
		) ,
	) ,
	array(
		'type' => 'uncode_items',
		'heading' => 'Items List',
		'param_name' => 'items',
		'description' => esc_html__('Edit single items.') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		// 'dependency' => array(
		// 	'element' => 'explode_albums',
		// 	'is_empty' => true
		// )
		'dependency' => array(
			'element' => 'post_matrix',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'type_readonly_info',
		'param_name' => 'readonly_info1',
		'value' => "1",
		'heading' => esc_html__('Items List', 'uncode-core') ,
		'description' => esc_html__("'By ID' option doesn't work when 'Explode Albums' is on.", 'uncode-core') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'uncode_wrapper_class' => 'by-id-dependent-field',
	) ,
	array(
		'type' => 'uncode_matrix_items',
		'heading' => 'Items list',
		'param_name' => 'matrix_items',
		'description' => esc_html__('Edit single items.') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'dependency' => array(
			'element' => 'post_matrix',
			'value' => 'matrix',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop Play Hover", 'uncode-core') ,
		"param_name" => "play_hover",
		"description" => esc_html__("Activate this option to have videos that start on hover when a Poster image is set.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop play last frame", 'uncode-core') ,
		"param_name" => "play_pause",
		"description" => esc_html__("Activate this option to have videos that restart from the last frame played, otherwise they restart from the beginning.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Mobile behavior", 'uncode-core') ,
		"param_name" => "mobile_videos",
		"description" => esc_html__("Set the mobile behavior, it's possible to have autoplay video or replace it with the Poster image (suggested option if you have multiple videos on the same page or if the videos are heavy).", 'uncode-core') ,
		"value" => array(
			esc_html__('Replace with poster', 'uncode-core') => '',
			esc_html__('Autoplay videos', 'uncode-core') => 'autoplay',
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Skin',
		'param_name' => 'lbox_skin',
		'value' => array(
			esc_html__('Dark', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'white',
		) ,
		'description' => esc_html__('Specify the lightbox Skin.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Transparency',
		'param_name' => 'lbox_transparency',
		'value' => array(
			esc_html__('Semi-Transparent', 'uncode-core') => '',
			esc_html__('Opaque', 'uncode-core') => 'opaque',
		) ,
		'description' => esc_html__('Specify the transparency style of the Lightbox background.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows",
		"description" => esc_html__("Specify whether to have navigation Arrows or not.", 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows Background", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows_bg",
		"description" => esc_html__("Specify the background transparency.", 'uncode-core') ,
		"value" => array(
			esc_html__('Transparent', 'uncode-core') => '',
			esc_html__('Semi-Transparent', 'uncode-core') => 'semi-transparent',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_gallery_arrows',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Direction',
		'param_name' => 'lbox_dir',
		'value' => array(
			esc_html__('Horizontal', 'uncode-core') => '',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
		) ,
		'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => !$lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title", 'uncode-core') ,
		"param_name" => "lbox_title",
		"description" => esc_html__("Activate this to add the media title.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Caption", 'uncode-core') ,
		"param_name" => "lbox_caption",
		"description" => esc_html__("Activate this to add the media caption.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Social", 'uncode-core') ,
		"param_name" => "lbox_social",
		"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Deeplinking", 'uncode-core') ,
		"param_name" => "lbox_deep",
		"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No arrows", 'uncode-core') ,
		"param_name" => "lbox_no_arrows",
		"description" => esc_html__("Activate this for not showing the arrows.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => !$lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Actual Size", 'uncode-core') ,
		"param_name" => "lbox_actual_size",
		"description" => esc_html__("Set the magnification to real pixels of the image.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Fullscreen", 'uncode-core') ,
		"param_name" => "lbox_full",
		"description" => esc_html__("Set the fullscreen magnification on the monitor viewport.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Download", 'uncode-core') ,
		"param_name" => "lbox_download",
		"description" => esc_html__("Enable image downloading.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Zoom Origin", 'uncode-core') ,
		"param_name" => "lbox_zoom_origin",
		"description" => esc_html__("Set the zoom effect from the thumbnail, this only works if you are using the image with the original ratio.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Counter", 'uncode-core') ,
		"param_name" => "lbox_counter",
		"description" => esc_html__("Show the counter with the count of images in the gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No thumbnails", 'uncode-core') ,
		"param_name" => "lbox_no_tmb",
		"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Lightbox Transition", 'uncode-core') ,
		"param_name" => "lbox_transition",
		"description" => esc_html__("Specifies the transition between images. This works if the images have already been preloaded by the plugin script.", 'uncode-core') ,
		"value" => array(
			esc_html__('Slide', 'uncode-core') => '',
			esc_html__('Fade', 'uncode-core') => 'lg-fade',
			esc_html__('Zoom In', 'uncode-core') => 'lg-zoom-in',
			esc_html__('Zoom In Big', 'uncode-core') => 'lg-zoom-in-big',
			esc_html__('Zoom Out', 'uncode-core') => 'lg-zoom-out',
			esc_html__('Zoom Out Big', 'uncode-core') => 'lg-zoom-out-big',
			esc_html__('Zoom Out In', 'uncode-core') => 'lg-zoom-out-in',
			esc_html__('Zoom In Out', 'uncode-core') => 'lg-zoom-in-out',
			esc_html__('Soft Zoom', 'uncode-core') => 'lg-soft-zoom',
			esc_html__('Slide Circular', 'uncode-core') => 'lg-slide-circular',
			esc_html__('Slide Vertical', 'uncode-core') => 'lg-slide-vertical',
			esc_html__('Lollipop', 'uncode-core') => 'lg-lollipop',
			esc_html__('Lollipop Reverse', 'uncode-core') => 'lg-lollipop-rev',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_skin',
			'value' => $lbox_enhance ? array(
				'white',
				'',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove double tap", 'uncode-core') ,
		"param_name" => "no_double_tap",
		"description" => esc_html__("Remove the double tap action on mobile. This doesn't work with lightbox.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Disable Tablet", 'uncode-core') ,
		"param_name" => "no_sticky_scroll_tablet",
		"description" => esc_html__("Disable the Sticky Scroll layout on Tablet. Please note that the elements will be placed on a vertical column.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Disable Device", 'uncode-core') ,
		"param_name" => "no_sticky_scroll_mobile",
		"description" => esc_html__("Disable the Sticky Scroll layout on Device. Please note that the elements will be placed on a vertical column.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Height iOS", 'uncode-core') ,
		"param_name" => "sticky_scroll_mobile_safe_height",
		"description" => esc_html__("If you enable this option only on Safari iOS the browser's address bar is also considered in the height calculation.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Special Cursor", 'uncode-core') ,
		"param_name" => "custom_cursor",
		"description" => esc_html__("Enable this to activate the special curson when you hover over the items.", 'uncode-core') ,
		"value" => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark',
			esc_html__('Accent', 'uncode-core') => 'accent',
			esc_html__('Difference', 'uncode-core') => 'diff',
			esc_html__('Blur', 'uncode-core') => 'blur',
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Special Cursor Tooltip", 'uncode-core') ,
		"param_name" => "cursor_title",
		"description" => esc_html__("Activate the Cursor textual Tooltip.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'custom_cursor',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Thumbnail title", 'uncode-core') ,
		"param_name" => "hide_title_tooltip",
		"description" => esc_html__("Use this option to display the original Title element. When using a Tooltip on desktop, it may be useful to show the original thumbnail title only on mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hide', 'uncode-core') => '',
			esc_html__('Display on mobile', 'uncode-core') => 'mobile',
			esc_html__('Display on desktop', 'uncode-core') => 'desktop',
			esc_html__('Display always', 'uncode-core') => 'always',
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Tooltip Boing", 'uncode-core') ,
		"param_name" => "cursor_title_boing",
		"description" => esc_html__("Activate the Tooltip Boing effect when moving from one element to another.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Transparent Background", 'uncode-core') ,
		"param_name" => "hide_cursor_bg",
		"description" => esc_html__("Activate to remove the Tooltip background.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom Tooltip text', 'uncode-core') ,
		'param_name' => 'custom_tooltip',
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		'description' => esc_html__('Enter a custom text for the Tooltip. Ex: Read More.', 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Extra tooltip class', 'uncode-core') ,
		'param_name' => 'tooltip_class',
		'description' => esc_html__("Enter possible extra classes that allow you to modify the Tooltip style. Ex: 'h2 font-weight-700 font-136269'.", 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Skew", 'uncode-core') ,
		"param_name" => "skew",
		"description" => esc_html__("Apply the Skew effect at the page scroll. NB. For performance reasons, this option is disabled while working with the Frontend Editor.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Extra class name', 'uncode-core') ,
		'param_name' => 'el_class',
		'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
		'group' => esc_html__('Extra', 'uncode-core')
	) ,
);

if ( $lbox_enhance ) {
	$uncode_advanced_videos = array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Advanced Videos", 'uncode-core') ,
			"param_name" => "lb_video_advanced",
			"description" => esc_html__("Activate for the advanced video options.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Autoplay videos", 'uncode-core') ,
			"param_name" => "lb_autoplay",
			"description" => esc_html__("Set the autoplay.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Mute videos", 'uncode-core') ,
			"param_name" => "lb_muted",
			"description" => esc_html__("Set the mute option.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
	);
} else {
	$uncode_advanced_videos = array();
}

$media_gallery_params = array_merge($media_gallery_params, $uncode_advanced_videos);

if ( $simplify_single_tab ) {
	foreach ( $media_gallery_params as $media_gallery_param_key => $media_gallery_param_value ) {
		if ( isset( $media_gallery_param_value['group'] ) && ( strpos( $media_gallery_param_value['group'], 'Blocks') !== false ) ) {
			if ( isset( $media_gallery_param_value['param_name'] ) ) {
				if ( in_array( $media_gallery_param_value['param_name'], uncode_core_enabled_simplified_single_options() ) ) {
					$media_gallery_params[$media_gallery_param_key]['param_holder_class'] = 'simple-single-tab-enabled';
				} else {
					$media_gallery_params[$media_gallery_param_key]['param_holder_class'] = 'simple-single-tab-disabled';
				}
			}
		}

		if ( isset( $media_gallery_param_value['type'] ) && $media_gallery_param_value['type'] === 'sorted_list' ) {
			$media_gallery_params[$media_gallery_param_key]['param_holder_class'] = 'simple-single-tab-disabled';
		}
	}
}

vc_map(array(
	'name' => esc_html__('Media Gallery', 'uncode-core') ,
	'base' => 'vc_gallery',
	'php_class_name' => 'uncode_generic_admin',
	'weight' => 9900,
	'icon' => 'fa fa-th-large',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
		esc_html__('Dynamic', 'uncode-core') ,
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
   	'description' => esc_html__('Gallery images masonry grid metro carousel lightbox media self hosted video audio testimonials quotes YouTube Vimeo team members products Photos', 'uncode-core') ,
	'params' => $media_gallery_params,
));
