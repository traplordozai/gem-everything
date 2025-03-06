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

$data[ 'name' ]             = esc_html__( 'Header Classic Workshop', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Workshop.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="65" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="145648" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="463780"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="613021"][vc_column_inner width="7/12"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_speed="1000" interval_animation="60" uncode_shortcode_id="168659"]Medium length headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="5/12" uncode_shortcode_id="906184"][vc_column_text text_lead="yes" uncode_shortcode_id="579992"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-out" scale_mobile="no" css_animation="bottom-t-top" animation_speed="1000" animation_delay="300" uncode_shortcode_id="101952" link="url:%23"]Click the button[/vc_button][/vc_column][/vc_row][vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="10" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="419208" row_height_pixel="400" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="6" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/4" uncode_shortcode_id="208743"][vc_empty_space empty_h="5"][vc_empty_space empty_h="5"][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="-4" shift_y_fixed="yes" shift_y_down="0" z_index="0" medium_width="3" mobile_visibility="yes" mobile_width="3" width="1/4" uncode_shortcode_id="689273"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" alignment="center" rotating="speed" uncode_shortcode_id="123304" media_width_pixel="240"][/vc_column][/vc_row]
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
