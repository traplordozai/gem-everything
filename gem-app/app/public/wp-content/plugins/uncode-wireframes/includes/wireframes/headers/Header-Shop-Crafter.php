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

$data[ 'name' ]             = esc_html__( 'Header Shop Crafter', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Shop-Crafter.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="30" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" uncode_shortcode_id="107386" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" animation_delay="200" width="1/1" uncode_shortcode_id="156933"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="1/1" uncode_shortcode_id="530187"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" css_animation="single-curtain" animation_speed="1000" animation_delay="200" uncode_shortcode_id="801892"]Medium headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="1/1" uncode_shortcode_id="190485"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-739966' ) .'" css_animation="single-curtain" animation_speed="1000" animation_delay="200" uncode_shortcode_id="775690"]Medium headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="2" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="519842"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="175424"][vc_column_text text_lead="yes" uncode_shortcode_id="106689"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="167505"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
