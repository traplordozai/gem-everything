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

$data[ 'name' ]             = esc_html__( 'Footer Creative Hub', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Hub.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_section back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" content_parallax="0" uncode_shortcode_id="115697" back_color_type="uncode-palette"][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="6" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" css_animation="scroll-trigger" animation_scale_val="75" animation_opacity="100" animation_x="0" animation_y="0" animation_blur="0" animation_rotate="0" animation_perspective="0" animation_offset_top="100" animation_offset_bottom="0" animation_safe="yes" content_parallax="5" uncode_shortcode_id="816719" back_color_type="uncode-palette" column_width_pixel="1600"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="176651"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="936661" heading_custom_size="clamp(80px,10vw,150px)"]<a class="btn-underline-in btn-underline-text" href="#">Let\'s Talk</a>[/vc_custom_heading][vc_empty_space empty_h="4" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="171221"][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="673847"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="119415" text_color_type="uncode-palette"]Get Started[/vc_custom_heading][vc_custom_heading heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'"   uncode_shortcode_id="120940"]<a href="mailto:info@website.com">info@website.com</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="115622"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="197386" text_color_type="uncode-palette"]Navigate[/vc_custom_heading][vc_custom_heading heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'"   uncode_shortcode_id="254849"]<a href="#">Home</a><br />
<a href="#">About</a><br />
<a href="#">Portfolio</a><br />
<a href="#">Contact</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="755297"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3"   text_size="'. uncode_wf_print_font_size( 'h3' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="902803" text_color_type="uncode-palette"]Follow[/vc_custom_heading][vc_custom_heading heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'h4' ) .'"  text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'"   uncode_shortcode_id="182732"]<a href="#">Instagram</a><br />
<a href="#">Behance</a><br />
<a href="#">TikTok</a><br />
<a href="#">Facebook</a><br />
<a href="#">Dribbble</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="187914"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3"   text_size="'. uncode_wf_print_font_size( 'h3' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="102116" text_color_type="uncode-palette"]Headquarter[/vc_custom_heading][vc_custom_heading heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'h4' ) .'"  text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'"   uncode_shortcode_id="163973"]4872 Mark Columbus Blvd<br />
New York, 10035<br />
(212) 555-123456[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="4" mobile_visibility="yes"][vc_separator sep_color="" uncode_shortcode_id="870713" sep_color_type="uncode-solid" sep_color_solid="rgba(255,255,255,0.15)"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="107279"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="179029"][vc_custom_heading text_color="color-wvjs" heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'custom' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="116551" text_color_type="uncode-palette" heading_custom_size="clamp(14px,3vw,16px)"]©2025[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="104641"][vc_custom_heading text_color="color-wvjs" heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'custom' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="210433" text_color_type="uncode-palette" heading_custom_size="clamp(14px,3vw,16px)"]All Rights Reserved[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="165707"][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/4" uncode_shortcode_id="208313"][vc_custom_heading text_color="color-wvjs" heading_semantic="p"   text_size="'. uncode_wf_print_font_size( 'custom' ) .'"   text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"   uncode_shortcode_id="504443" text_color_type="uncode-palette" heading_custom_size="clamp(14px,3vw,16px)"]Privacy Policy[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][/vc_section]
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
