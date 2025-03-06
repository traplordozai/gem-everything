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

$data[ 'name' ]             = esc_html__( 'Empty Cart Four', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Empty-Cart-Four.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="75" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="accent" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" el_class="gradient" shape_dividers=""][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="900"][vc_icon icon="fa fa-shopping-bag2" background_style="fa-rounded" size="fa-3x" outline="yes"][/vc_icon][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400"]Change the color to match your brand or vision[/vc_custom_heading][vc_empty_space empty_h="2"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2"][vc_button border_width="0" scale_mobile="no" width="200" link="|||"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2"][vc_button border_width="0" scale_mobile="no" width="200" link="|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
