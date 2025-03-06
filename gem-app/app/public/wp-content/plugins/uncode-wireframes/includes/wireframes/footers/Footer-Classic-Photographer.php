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

$data[ 'name' ]             = esc_html__( 'Footer Classic Photographer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Photographer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="199399" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="171444"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_align="text-center" uncode_shortcode_id="147827"]Ready to make your dream real?<br />
Let’s contact me.[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="168335" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="4/12" uncode_shortcode_id="158582"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_align="text-center" uncode_shortcode_id="207783"]Start a conversation[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="193605"]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a><br />
<a href="http://+(646) 245 234 98">+(646) 245 234 98</a>[/vc_column_text][vc_empty_space empty_h="2" desktop_visibility="yes"][vc_separator sep_color="color-uydo" desktop_visibility="yes" uncode_shortcode_id="506873" sep_color_type="uncode-palette"][/vc_column][vc_column width="8/12"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="420308"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_align="text-center" uncode_shortcode_id="943117"]Explorate[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="356646"]<a href="#">Selected works</a><br />
<a href="#">My services</a><br />
<a href="#">About me</a><br />
<a href="#">Job opportunities</a><br />
<a href="#">News &amp; insights</a><br />
<a href="#">Contact</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="710454"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_align="text-center" uncode_shortcode_id="109745"]Headquarter[/vc_custom_heading][vc_column_text text_lead="yes" text_color="color-prif" uncode_shortcode_id="146162" text_color_type="uncode-palette"]191 Middleville Road,<br />
NY 10001, New York<br />
United States[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="271125"][vc_custom_heading heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_align="text-center" uncode_shortcode_id="700699"]Connections[/vc_custom_heading][uncode_socials][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
