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

$data[ 'name' ]             = esc_html__( 'Footer Blog Masonry', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Masonry.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="4" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="676499" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="4/12" uncode_shortcode_id="332255"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'"  text_align="text-center" uncode_shortcode_id="251739"]Contact the publishers[/vc_custom_heading][vc_column_text uncode_shortcode_id="106475"]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a>
<a href="http://+(646) 245 234 98">+(646) 245 234 98</a>[/vc_column_text][vc_empty_space empty_h="2" desktop_visibility="yes"][vc_separator sep_color="color-uydo" desktop_visibility="yes" uncode_shortcode_id="506873" sep_color_type="uncode-palette"][/vc_column][vc_column column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="157478"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="629010"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'"  text_align="text-center" uncode_shortcode_id="160953"]Explorate[/vc_custom_heading][vc_column_text uncode_shortcode_id="569752"]<a href="#">About</a>
<a href="#">Partners</a>
<a href="#">Job opportunities</a>
<a href="#">Advertise</a>
<a href="#">Membership</a>
<a href="#">Privacy Policy</a>
<a href="#">Contact</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="176978"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'"  text_align="text-center" uncode_shortcode_id="523987"]Headquarter[/vc_custom_heading][vc_column_text uncode_shortcode_id="168670"]191 Middleville Road,
NY 10001, New York
United States[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="127315"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'"  text_align="text-center" uncode_shortcode_id="528894"]Connections[/vc_custom_heading][uncode_socials][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
