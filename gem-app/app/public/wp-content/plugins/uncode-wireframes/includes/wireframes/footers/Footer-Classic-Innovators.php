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

$data[ 'name' ]             = esc_html__( 'Footer Classic Innovators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Innovators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="75" gutter_size="5" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" content_parallax="0" uncode_shortcode_id="104210" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="135537"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="166010"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="138974"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="140831" heading_custom_size="clamp(24px,5vw,35px)"]<a href="#">Leadership</a>
<a href="#">Industries</a>
<a href="#">About</a>
<a href="#">Knowledge</a>
<a href="#">Sustainability</a>
<a href="#">Contact</a>
<a href="#">FAQ</a>
<a href="#">Login</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="322795"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="981499" heading_custom_size="clamp(24px,5vw,35px)"]Ready to explore the future and embrace a sustainable approach to research and development? Let’s connect![/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="411903" el_class="light-color"]<a class="text-accent-color btn-underline-in btn-underline-text" href="mailto:info@mysite.com">info@mysite.com</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3" mobile_visibility="yes"][vc_separator sep_color="" uncode_shortcode_id="813178"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="128491"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="1" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="1/2" uncode_shortcode_id="164843"][uncode_socials size="lead"][uncode_copyright][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="4" mobile_visibility="yes" mobile_width="4" width="3/12" uncode_shortcode_id="164552"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="877615"]<a href="#">About</a>
<a href="#">Services</a>
<a href="#">Plans</a>
<a href="#">Contact</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="4" mobile_visibility="yes" mobile_width="4" width="3/12" uncode_shortcode_id="101789"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="885123"]<a href="#">Terms &amp; Conditions</a>
<a href="#">Privacy Policy</a>
<a href="#">Refund Policy</a>
<a href="#">Accessibility Statement</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
