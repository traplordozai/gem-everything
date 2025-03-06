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

$data[ 'name' ]             = esc_html__( 'Counter Creative', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Creative.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="accent" back_image="'. uncode_wf_print_single_image( '80472' ) .'" kburns="yes" overlay_color="accent" overlay_alpha="80" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" row_name="About Me"][vc_column column_width_percent="100" position_vertical="middle" style="dark" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" position_vertical="bottom" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Tagline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Medium length headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_horizontal="left" position_vertical="bottom" style="dark" gutter_size="4" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_separator][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="4" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="2" mobile_width="4" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="18" size="fontsize-445851" height="fontheight-179065" weight="700" css_animation="alpha-anim" animation_delay="200"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" css_animation="alpha-anim" animation_delay="200"]Feature one[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="2" mobile_width="4" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="22" size="fontsize-445851" height="fontheight-179065" weight="700" css_animation="alpha-anim" animation_delay="300"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" css_animation="alpha-anim" animation_delay="200"]Feature two[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="2" mobile_width="4" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="64" size="fontsize-445851" height="fontheight-179065" weight="700" css_animation="alpha-anim" animation_delay="400"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" css_animation="alpha-anim" animation_delay="200"]Feature three[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="2" overlay_alpha="50" medium_width="2" mobile_width="4" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/4"][uncode_counter value="125" size="fontsize-445851" height="fontheight-179065" weight="700" css_animation="alpha-anim" animation_delay="500"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" css_animation="alpha-anim" animation_delay="200"]Feature four[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
