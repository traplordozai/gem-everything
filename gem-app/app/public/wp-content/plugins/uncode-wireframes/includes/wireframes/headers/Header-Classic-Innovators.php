<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Header Classic Innovators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Classic-Innovators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="75" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" bottom_divider="gradient" content_parallax="3" uncode_shortcode_id="143668" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="138994"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_horizontal="left" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="311432"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="385753" heading_custom_size="clamp(30px,7vw,130px)"]Long headline on two lines[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="3/12" uncode_shortcode_id="392231"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="2" mobile_visibility="yes"][vc_separator sep_color="" uncode_shortcode_id="473947"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="436875" border_color_type="uncode-solid" border_color_solid="rgba(255,255,255,0.25)"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="4/12" uncode_shortcode_id="160565"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="963590"]Long headline on two lines to turn your visitors into users[/vc_custom_heading][vc_button size="btn-lg" radius="btn-circle" outline="yes" border_width="0" icon_position="right" scale_mobile="no" uncode_shortcode_id="182898" icon="fa fa-arrow-right2" link="url:%23"]Click the Button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="5/12" uncode_shortcode_id="536650"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="3/12" uncode_shortcode_id="107912"][vc_single_image media="'. uncode_wf_print_single_image( '83463' ) .'" media_width_percent="100" media_ratio="three-two" shape="img-round" radius="xl" shadow="yes" shadow_weight="std" advanced_videos="yes" mobile_videos="autoplay" uncode_shortcode_id="154913"][vc_icon display="absolute-center" icon="fa fa-play" background_style="fa-rounded" icon_automatic="yes" shadow="yes" uncode_shortcode_id="136963"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
