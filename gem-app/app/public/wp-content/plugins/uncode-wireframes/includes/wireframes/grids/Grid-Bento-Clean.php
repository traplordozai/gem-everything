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

$data[ 'name' ]             = esc_html__( 'Grid Bento Clean', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Bento-Clean.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="justify" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="922095" back_color_type="uncode-palette" column_width_pixel="1400"][vc_column column_width_percent="100" position_horizontal="left" position_vertical="justify" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="5/12" uncode_shortcode_id="663891" back_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="166529"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" badge_style="yes" radius="xl" uncode_shortcode_id="269854" back_color_type="uncode-solid" back_color_solid="rgba(44,68,55,0.1)"]Tagline[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="140611"]Long headline to turn your visitors into users[/vc_custom_heading][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="206219"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_button button_color="accent" size="btn-lg" hover_fx="full-colored" border_width="0" scale_mobile="no" button_color_type="uncode-palette" uncode_shortcode_id="106305" link="url:%23"]Click the Button[/vc_button][/vc_column][vc_column column_width_percent="100" position_vertical="justify" align_horizontal="align_center" gutter_size="3" style="dark" back_image="'. uncode_wf_print_single_image( '80471' ) .'" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="4/12" uncode_shortcode_id="956660" mobile_height="50vh"][vc_empty_space empty_h="1"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_center" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="144185"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="419532"]Medium headline[/vc_custom_heading][vc_empty_space empty_h="0"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="3/12" uncode_shortcode_id="179667"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-round" radius="lg" uncode_shortcode_id="990664"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="142798"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" style="dark" back_color="accent" overlay_alpha="50" radius="lg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="176378" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-111509' ) .'" uncode_shortcode_id="137875"]20% Off[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" uncode_shortcode_id="186265"]Change the color to match your brand[/vc_custom_heading][vc_empty_space][vc_button size="btn-lg" hover_fx="full-colored" border_width="0" scale_mobile="no" uncode_shortcode_id="115278" link="url:%23"]Click the Button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
