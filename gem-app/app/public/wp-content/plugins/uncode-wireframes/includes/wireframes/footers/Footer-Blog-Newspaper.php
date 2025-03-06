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

$data[ 'name' ]             = esc_html__( 'Footer Blog Newspaper', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Newspaper.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="182990" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="100459"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3" uncode_shortcode_id="190537"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="255703"]Newsletter Subscription[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="default-background"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="112583"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" align_horizontal="align_right" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="421871"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="146645"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="131515"]Editorial[/vc_custom_heading][vc_column_text uncode_shortcode_id="131506"]<a href="#">Membership</a>
<a href="#">About Us</a>
<a href="#">Partners</a>
<a href="#">Categories</a>
<a href="#">Work with Us</a>
<a href="#">Advertise</a>
<a href="#">Contact Us</a>
<a href="#">Privacy Policy</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="200882"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="486504"]Headquarter[/vc_custom_heading][vc_column_text uncode_shortcode_id="837485"]191 Middleville Road,
NY 10001, New York
United States[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="805020"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="191390"]Contact[/vc_custom_heading][vc_column_text uncode_shortcode_id="778884"]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a>
<a href="http://+(646) 245 234 98">+(646) 245 234 98</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
