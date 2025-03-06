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

$data[ 'name' ]             = esc_html__( 'Header Classic Landing', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Landing.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="0" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" parallax="yes" kburns="zoom" overlay_color="accent" overlay_alpha="80" equal_height="yes" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" top_divider="gradient" enable_bottom_divider="default" bottom_divider_inv="curve-opacity" shape_bottom_invert="yes" shape_bottom_h_use_pixel="" shape_bottom_height="140" shape_bottom_opacity="100" shape_bottom_index="0" row_name="Welcome" shape_dividers=""][vc_column column_width_percent="100" position_vertical="bottom" align_horizontal="align_center" style="dark" overlay_alpha="50" gutter_size="3" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="4" css_animation="bottom-t-top" animation_delay="200" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase" sub_lead="yes" mobile_visibility="yes"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" el_class="row-button"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="3" width="1/1" column_width_pixel="700"][vc_button border_width="0" css_animation="bottom-t-top" animation_delay="400" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_use_pixel="yes" gutter_size="0" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="-5" shift_y_down_fixed="yes" z_index="0" width="1/1" column_width_pixel="860" el_class="display-table-cell"][vc_empty_space empty_h="1"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="three-two" css_animation="bottom-t-top" animation_delay="600"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column width="1/1"][vc_empty_space empty_h="3" desktop_visibility="yes" medium_visibility="yes"][/vc_column][/vc_row]
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
