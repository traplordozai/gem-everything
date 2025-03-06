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

$data[ 'name' ]             = esc_html__( 'Footer Portfolio Parallax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Portfolio-Parallax.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="172106" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="288842"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="marquee" marquee_clone="yes" marquee_speed="0" marquee_hover="yes" uncode_shortcode_id="208225" heading_custom_size="clamp(35px,7vw,125px)"]<a href="mailto:website@youremail.com">Medium length headline</a> ·[/vc_custom_heading][vc_empty_space empty_h="5" medium_visibility="yes" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="141640"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="6/12" uncode_shortcode_id="165719"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="109013" text_color_type="uncode-palette"]Headquarter[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="158459" heading_custom_size="clamp(20px,4vw,30px)"]Ljusstigen 45
214 66 Malmö, Sweden
(322) 512 08 15[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="3/12" uncode_shortcode_id="925358"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="106438" text_color_type="uncode-palette"]Navigate[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="159193"]<a href="#">Home</a>
<a href="#">Portfolio</a>
<a href="#">About</a>
<a href="#">Services</a>
<a href="#">Latest News</a>
<a href="#">Contact</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="3/12" uncode_shortcode_id="466223"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="141433" text_color_type="uncode-palette"]Contact[/vc_custom_heading][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-in" custom_typo="yes"  font_weight="400" letter_spacing="fontspace-781688" uncode_shortcode_id="953251" link="url:mailto%3Awebsite%40youremail.com"]website@youremail.com[/vc_button][uncode_socials size="lead"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="5" medium_visibility="yes" mobile_visibility="yes"][vc_separator sep_color=",Default"][uncode_copyright text_lead="small"][/vc_column][/vc_row]
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
