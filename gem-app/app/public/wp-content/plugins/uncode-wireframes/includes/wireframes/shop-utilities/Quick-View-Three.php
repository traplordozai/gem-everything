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

$data[ 'name' ]             = esc_html__( 'Quick-View Three', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Quick-View-Three.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0"][vc_column width="1/2"][uncode_single_product_gallery columns="3" gutter_thumb="2"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" text_weight="400" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_column_text auto_text="excerpt"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space empty_h="1"][vc_button dynamic="add-to-cart" quantity="variation" button_color="accent" radius="btn-circle" wide="yes" hover_fx="full-colored" border_width="0" scale_mobile="no"]Text on the button[/vc_button][vc_empty_space empty_h="1"][vc_separator][uncode_share layout="multiple" no_back="yes"][/vc_column][/vc_row]
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
