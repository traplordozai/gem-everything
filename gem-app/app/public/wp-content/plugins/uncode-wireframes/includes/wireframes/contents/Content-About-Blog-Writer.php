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

$data[ 'name' ]             = esc_html__( 'Content About Blog Writer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-About-Blog-Writer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="843896"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="760002"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="775063"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="10/12" uncode_shortcode_id="400306"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" uncode_shortcode_id="134374"]Professor of History at State University Colorado.[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="290179"]Long headline to turn your visitors into users of your website[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="180920"][/vc_column_inner][/vc_row_inner][vc_separator sep_color="" uncode_shortcode_id="131089" sep_color_type="uncode-solid" sep_color_solid="#c6c5c0"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="118921"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="103283"][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="840262"]General Sociology[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="450628"]Courses on the history of psychology generally begin with the subject ancient philosophical origins.[/vc_custom_heading][vc_empty_space][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="173193"]Methodology Research[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="208117"]Cognitive psychology involves the study of internal mental processes all of the things that go on.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="335620"][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="209554"]Cognitive Psychology[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="205939"]While course requirements may vary from one school to the next, most experimental psychology.[/vc_custom_heading][vc_empty_space][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="135473"]Social Psychology[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="600296"]Introduction to the history of psychology and the scientific study of the human mind.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="901981"][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="212958"]General Pedagogy[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="131815"]A course in physiological psychology serves as a good introduction to the field of neuropsychology.[/vc_custom_heading][vc_empty_space][vc_custom_heading heading_semantic="h4"  uncode_shortcode_id="115618"]History of Humanities[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="134752"]It may seem overwhelming at first, due to the sheer volume of information you will learn[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
