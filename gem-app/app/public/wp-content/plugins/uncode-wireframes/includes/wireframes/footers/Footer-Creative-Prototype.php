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

$data[ 'name' ]             = esc_html__( 'Footer Creative Prototype', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Prototype.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_section back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" content_parallax="5" uncode_shortcode_id="421462" back_color_type="uncode-palette"][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="7" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="339695" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="114719"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="776455"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="181071"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="126935" heading_custom_size="clamp(20px,5vw,30px)"]©2025[/vc_custom_heading][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="172870" heading_custom_size="clamp(20px,5vw,24px)" el_class="footer-links"]<a href="#">Privacy Policy</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="152780"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="179103" heading_custom_size="clamp(20px,5vw,30px)"]<a href="mailto:info@yourwebsite.com">info@yourwebsite.com</a>[/vc_custom_heading][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" uncode_shortcode_id="166005" heading_custom_size="clamp(20px,5vw,24px)" el_class="footer-links"]<a href="#">About Us</a>
<a href="#">Terms of Service</a>
<a href="#">Contact Us</a>
<a href="#">Support Center</a>
<a href="#">For Business</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="200553"][vc_separator sep_color="" desktop_visibility="yes" uncode_shortcode_id="187855"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="160738"][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="928385" heading_custom_size="clamp(20px,5vw,30px)"]Join the Newsletter[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="no-labels-background"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="147067" el_class="overflow-hidden" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="859845"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="854769"]Headline[/vc_custom_heading][/vc_column][/vc_row][/vc_section]
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
