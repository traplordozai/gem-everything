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

$data[ 'name' ]             = esc_html__( 'Footer Blog Travel', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Travel.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="131278" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="478601"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="228159"][vc_empty_space empty_h="0"][vc_custom_heading  ]Newsletter[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="465131"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="229138"]Sign up to receive monthly updates from the us[/vc_custom_heading][vc_column_text uncode_shortcode_id="957399"]<a href="#">⸻ Stay in the Loop</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="2" medium_visibility="yes" mobile_visibility="yes"][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="6/12" uncode_shortcode_id="459293"][vc_column_text uncode_shortcode_id="208247"]hello@yourwebsite.com<br />
+(646) 245 234 98[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="3/12" uncode_shortcode_id="100929"][vc_column_text uncode_shortcode_id="263651"]Uncode Travel<br />
191 Middleville Road,<br />
NY 10001, New York<br />
United States[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_left_mobile" mobile_width="0" width="3/12" uncode_shortcode_id="893955"][uncode_socials][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3"][/vc_column][/vc_row]
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
