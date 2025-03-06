<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Content Menu Tabs', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Menu-Tabs.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1" column_width_pixel="760"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Medium length headline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_tabs][vc_tab no_margin="yes" title="Feature one" tab_id="1490024538-1-541554731288350"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_separator][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_separator][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_tab][vc_tab title="Feature two" tab_id="1490024538-2-01554731288350"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_separator][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" z_index="0" width="1/1"][vc_separator][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" override_padding="yes" column_padding="2" gutter_size="2" overlay_alpha="50" medium_width="6" mobile_width="5" shift_x="0" shift_y="0" z_index="0" width="9/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes"]Short headline[/vc_custom_heading][vc_column_text]Change the color to match your brand or vision, add your logo, choose the perfect layout and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" override_padding="yes" column_padding="2" gutter_size="3" overlay_alpha="50" medium_width="2" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="3/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]$20[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_tab][/vc_tabs][/vc_column][/vc_row]
';

// Check if this wireframe is for a content block
if ( $data[ 'is_content_block' ] && ! $is_content_block ) {
	$data[ 'custom_class' ] .= ' for-content-blocks';
}

// Check if this wireframe requires a plugin
foreach ( $data[ 'dependency' ]  as $dependency ) {
	if ( ! UNCDWF_Dynamic::has_dependency( $dependency ) ) {
		$data[ 'custom_class' ] .= ' has-dependency needs-' . $dependency;
	}
}

vc_add_default_templates( $data );
