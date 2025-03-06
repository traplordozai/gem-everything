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

$data[ 'name' ]             = esc_html__( 'Footer Blog List', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-List.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="182701" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="210100"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="175365"]Resources[/vc_custom_heading][vc_column_text uncode_shortcode_id="148465"]<a href="#">About</a><br />
<a href="#">Partners</a><br />
<a href="#">Press</a><br />
<a href="#">Careers</a><br />
<a href="#">Advertise</a><br />
<a href="#">Contact Us</a>[/vc_column_text][/vc_column][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="916478"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="462301"]About[/vc_custom_heading][vc_column_text uncode_shortcode_id="163344"]<a href="#">Help</a><br />
<a href="#">Membership Faqs</a><br />
<a href="#">Privacy Policy</a><br />
<a href="#">Legals</a><br />
<a href="#">Cookie Policy</a>[/vc_column_text][/vc_column][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="151510"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="100276"]Contact[/vc_custom_heading][vc_column_text uncode_shortcode_id="186553"]4680 Small Street,<br />
Manhattan, New York,<br />
NY 10021<br />
<a href="mailto:info@yourwebsite.com" target="_blank" rel="noopener noreferrer">info@yourwebsite.com</a>[/vc_column_text][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="121237"][uncode_socials][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" border_color="color-prif" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="101294" back_color_type="uncode-palette" border_color_type="uncode-palette" css=".vc_custom_1633703726527{border-top-width: 1px !important;}" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="144497"][uncode_copyright][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="213013"][vc_column_text uncode_shortcode_id="145766"]Created with Uncode Theme[/vc_column_text][/vc_column][/vc_row]
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
