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

$data[ 'name' ]             = esc_html__( 'Product Half-Screen', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Half-Screen.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" expand_height="yes" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" z_index="0" medium_width="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" expand_height="yes" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80471' ) .'" back_image_auto="yes" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" mobile_height="500"][/vc_column_inner][vc_column_inner column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="0" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" column_width_pixel="400"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_align="text-left"]Short headline[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_align="text-left"]Short headline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_column_text auto_text="excerpt"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space empty_h="1"][vc_button dynamic="add-to-cart" quantity="variation" button_color="accent" size="btn-lg" radius="btn-square" hover_fx="full-colored" text_skin="yes" border_width="0" scale_mobile="no"]Text on the button[/vc_button][vc_empty_space empty_h="1"][vc_empty_space empty_h="1"][uncode_share layout="multiple" no_back="yes"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
