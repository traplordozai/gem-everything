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

$data[ 'name' ]             = esc_html__( 'Footer Shop Bold', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Bold.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="209199"][vc_column column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="688580"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="486579"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="5/12" uncode_shortcode_id="117417"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="945550" heading_custom_size="clamp(35px, 4vw, 70px)"]<a href="#">Home</a><br />
<a href="#">Shop</a><br />
<a href="#">About</a><br />
<a href="#">News</a><br />
<a href="#">Contact</a>[/vc_custom_heading][uncode_socials size="lead"][/vc_column_inner][vc_column_inner width="1/12"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="3/12" uncode_shortcode_id="197419"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="162460"]Collections[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="840000"]<a href="#">Sweatshirts</a><br />
<a href="#">Accessories</a><br />
<a href="#">Sportwear</a><br />
<a href="#">Limited Editions</a><br />
<a href="#">Skatewear</a><br />
<a href="#">Sneakers</a><br />
<a href="#">Caps &amp; Beanies</a><br />
<a href="#">Denim Essentials</a><br />
<a href="#">Graphic Tees</a>[/vc_custom_heading][vc_empty_space][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="163726"]Lookbooks[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="318281"]<a href="#">Lookbook SS24</a><br />
<a href="#">Lookbook FW23</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="3/12" uncode_shortcode_id="101093"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="155620"]Customers[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="204543"]<a href="#">Terms &amp; Conditions</a><br />
<a href="#">Privacy Policy</a><br />
<a href="#">Shipping Info</a><br />
<a href="#">Returns</a><br />
<a href="#">Coupons</a><br />
<a href="#">Help &amp; Support</a><br />
<a href="#">Track Order</a>[/vc_custom_heading][vc_empty_space][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="162883"]Showroom[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="195089"]45 Skabersjögatan<br />
Malmö, Sweden<br />
website@email.com<br />
(322) 512 08 15[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" back_color="accent" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="105404" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="461615"][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" css_animation="marquee" marquee_clone="yes" marquee_space="3" marquee_speed="-2" uncode_shortcode_id="794489" heading_custom_size="clamp(14px, 3vw, 20px)"]© 2024 Uncode. All rights reserved[/vc_custom_heading][/vc_column][/vc_row]
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
