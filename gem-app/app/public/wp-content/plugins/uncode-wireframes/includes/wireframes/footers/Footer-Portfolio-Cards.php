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

$data[ 'name' ]             = esc_html__( 'Footer Portfolio Cards', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Portfolio-Cards.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="290142" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="187896"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="345145"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="160384"][vc_custom_heading  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" css_animation="curtain" animation_speed="1000" uncode_shortcode_id="207646" heading_custom_size="clamp(20px, 4vw, 35px)" text_indent="20%"]Mark Snijder is a highly acclaimed web designer and creative director based in Munich, Germany. With over 15 years of experience in the digital design industry, Mark has carved a niche for herself as a visionary in web design and user experience. His work is characterized by innovative designs that not only captivate but also provide seamless user experiences, thereby setting new standards in the digital realm. He leads his team by example, inspiring them to push boundaries and explore new technologies and methodologies. Throughout his career, Mark has received numerous awards and accolades for his work, including the prestigious Webby Awards, the Awwwards, and the CSS Design Awards. His projects range from innovative website designs for startups to comprehensive digital branding strategies for multinational corporations.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="345145"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="138991"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" css_animation="marquee" marquee_clone="yes" marquee_speed="0" marquee_hover="yes" uncode_shortcode_id="210464" heading_custom_size="clamp(30px, 12vw, 250px)"]<a href="mailto:info@yoursite.com">Medium length headline <span style="vertical-align: middle; font-size: 0.5em;">ツ</span></a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="345145"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="7" width="6/12" uncode_shortcode_id="114121"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="689661" heading_custom_size="clamp(20px, 4vw, 35px)"]CONTACT[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="126671"]<a href="mailto:info@yoursite.com">info@yoursite.com</a>
(321) 532 0088[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="3/12" uncode_shortcode_id="176885"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="374481"]<a href="#">Instagram</a>
<a href="#">Dribbble</a>
<a href="#">Facebook</a>
<a href="#">Behance</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="3/12" uncode_shortcode_id="960749"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="152585"]<a href="#">Twitter</a>
<a href="#">Awwwards</a>
<a href="#">YouTube</a>
<a href="#">Pinterest</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="345145"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="6/12" uncode_shortcode_id="145329"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="278359" heading_custom_size="clamp(20px, 4vw, 35px)"]2024[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_right_tablet" medium_width="4" mobile_width="7" width="4/12" uncode_shortcode_id="146520"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="169469" heading_custom_size="clamp(20px, 4vw, 35px)"]All Rights Reserved[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="589354"][vc_icon icon="fa fa-arrow-up-circle" size="fa-3x" uncode_shortcode_id="308377" link="url:%23top"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
