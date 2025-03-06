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

$data[ 'name' ]             = esc_html__( 'Footer Creative Freelance', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Freelance.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="940213" back_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" position_vertical="middle" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="186018" column_width_pixel="1000"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" uncode_shortcode_id="151889"]Lets start something amazing together[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3" uncode_shortcode_id="500698"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="117098"]Working at the sweet spot between art and programing. Check me out on Dribbble or Medium.[/vc_custom_heading][vc_empty_space empty_h="1" mobile_visibility="yes"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="186728"][vc_button button_color="accent" size="btn-xl" radius="btn-circle" wide="yes" hover_fx="full-colored" border_width="0" scale_mobile="no" link="url:https%3A%2F%2F1.envato.market%2FQ3bJP||target:%20_blank|" button_color_type="uncode-palette" uncode_shortcode_id="134485"]Button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="745225"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="474701"]<a href="mailto:hello@yoursite.com">hello@yoursite.com</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_left_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="201491"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="111112"]646-508-3457[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
