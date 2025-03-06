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

$data[ 'name' ]             = esc_html__( 'Content Boxed Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Boxed-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="143495"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/1" uncode_shortcode_id="108062" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="413231"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="7/12" uncode_shortcode_id="642639"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="178090" heading_custom_size="clamp(35px,5vw,90px)"]Medium length headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="5/12" uncode_shortcode_id="189232"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="130034"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/3" uncode_shortcode_id="889284"][vc_button size="btn-lg" hover_fx="full-colored" border_width="0" icon_position="right" scale_mobile="no" icon="fa fa-arrow-right4" uncode_shortcode_id="114674"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/3" uncode_shortcode_id="950838"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="448746" heading_custom_size="clamp(25px,4vw,35px)"]e-Commerce[/vc_custom_heading][vc_empty_space empty_h="1"][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="562217" heading_custom_size="clamp(18px,4vw,20px)"]Marketplace Integration[/vc_custom_heading][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="206987" heading_custom_size="clamp(18px,4vw,20px)"]eCommerce Development[/vc_custom_heading][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="175636" heading_custom_size="clamp(18px,4vw,20px)"]Strategy and Consulting[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/3" uncode_shortcode_id="388145"][vc_empty_space empty_h="2" desktop_visibility="yes" medium_visibility="yes"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="158660" heading_custom_size="clamp(25px,4vw,35px)"]Visual Identity[/vc_custom_heading][vc_empty_space empty_h="1"][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="342415" heading_custom_size="clamp(18px,4vw,20px)"]Strategy Development[/vc_custom_heading][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="500" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="163205" heading_custom_size="clamp(18px,4vw,20px)"]Branding Elements[/vc_custom_heading][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="162454" heading_custom_size="clamp(18px,4vw,20px)"]Visual Content Creation[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
