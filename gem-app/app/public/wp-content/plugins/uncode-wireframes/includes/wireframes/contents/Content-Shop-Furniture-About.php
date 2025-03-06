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

$data[ 'name' ]             = esc_html__( 'Content Shop Furniture About', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Shop-Furniture-About.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="accent" overlay_alpha="50" gutter_size="5" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="214127" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="218468"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h6' ) .'" text_transform="uppercase" uncode_shortcode_id="144505" text_color_type="uncode-solid" text_color_solid="rgba(255,255,255,0.25)"]About the firm[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="470232" heading_custom_size="clamp(30px, 3vw, 45px)"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" toggle="yes" max_height="40vh" closed_txt="Open Section" btn_margin="lg" open_txt="Close Section" fade="sm" btn_align="left" toggle_scroll="yes" width="1/2" uncode_shortcode_id="162616" toggle_classes="h5 btn-underline-out btn-custom-typo font-846016 font-weight-500 text-initial no-letterspace border-width-0 text-default-color btn-no-scale cursor-init"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="162866"]Meet our dynamic team of interior designers, where creativity meets functionality to redefine spaces. With a shared passion for transforming environments, each team member brings a unique perspective and specialized expertise to the table. From concept to execution, we blend aesthetics with practicality, turning visions into vibrant, harmonious realities. With a keen eye for detail and a commitment to client satisfaction, our team is dedicated to crafting personalized, inspiring interiors that resonate with individual lifestyles. Together, we bring your dreams to life, one space at a time.[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="181774"]From concept to completion, we blend functionality with aesthetics, ensuring every project is a testament to our commitment to creating environments that reflect your personality and aspirations. Join us in the journey of shaping spaces that tell your story.[/vc_custom_heading][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="574301" heading_custom_size="clamp(25px, 3vw, 30px)"]“ There is an extraordinary joy that comes from knowing the designs you bring to life resonate with profound purpose.”[/vc_custom_heading][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" uncode_shortcode_id="156710"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="316453"]<strong>Torben Svensson</strong><br />
Torben spearheads our team, shaping designs that seamlessly blend aesthetics and functionality. Their leadership sets the tone for an environment where creativity flourishes.[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="114320"]<strong>Lovisa Bergstrom</strong><br />
As our seasoned senior designer, Lovisa brings a wealth of expertise in curating spaces that exude elegance. With a portfolio of successful projects, their touch transforms every room into a sophisticated haven.[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="986310"]<strong>Henrik Larsgaard</strong><br />
Known for pushing the boundaries of design, Henrik injects fresh ideas into every project. Their innovative approach ensures that each space is a unique reflection of the client personality and lifestyle.[/vc_custom_heading][/vc_column][/vc_row]
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
