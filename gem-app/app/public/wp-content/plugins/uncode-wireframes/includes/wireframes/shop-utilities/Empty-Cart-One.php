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

$data[ 'name' ]             = esc_html__( 'Empty Cart One', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Empty-Cart-One.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="85" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_single_image media="'. uncode_wf_print_single_image( '83463' ) .'" media_width_use_pixel="yes" media_ratio="four-three" alignment="center" media_width_pixel="400"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]Medium length headline[/vc_custom_heading][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="400"][uncode_woocommerce_widget_product_search][/vc_column_inner][/vc_row_inner][vc_button button_color="accent" border_width="0" link="|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
