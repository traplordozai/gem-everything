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

$data[ 'name' ]             = esc_html__( 'Content Events', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Events.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="color-wayh" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" row_name="Events"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1" column_width_pixel="700"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" sub_lead="yes"]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="2"][vc_separator][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Short headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Tagline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]May 24-26[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_button button_color="accent" border_width="0" link="url:%23||target:%20_blank|"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Short headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Tagline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]May 24-26[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_button button_color="accent" border_width="0" link="url:%23||target:%20_blank|"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Short headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Tagline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="3" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]May 24-26[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" medium_width="2" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][vc_button button_color="accent" border_width="0" link="url:%23||target:%20_blank|"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator][/vc_column][/vc_row]
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
