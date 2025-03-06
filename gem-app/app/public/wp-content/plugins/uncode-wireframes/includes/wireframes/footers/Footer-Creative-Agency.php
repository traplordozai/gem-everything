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

$data[ 'name' ]             = esc_html__( 'Footer Creative Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="6" bottom_padding="6" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="2" uncode_shortcode_id="199527" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="610435"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/1" uncode_shortcode_id="168999" column_width_pixel="740"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="729631"]We would love to build something amazing[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button button_color="accent" size="btn-lg" radius="btn-circle" hover_fx="full-colored" border_width="0" scale_mobile="no" custom_cursor="yes" uncode_shortcode_id="111776" button_color_type="uncode-palette" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-prif" uncode_shortcode_id="776335" sep_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="236484"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="158725"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="138042"]Follow[/vc_custom_heading][uncode_socials][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="168888"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="178766"]Navigation[/vc_custom_heading][vc_column_text uncode_shortcode_id="317859"]<a href="#">Our Works</a>
<a href="#">About</a>
<a href="#">Services</a>
<a href="#">Careers</a>
<a href="#">Latest News</a>
<a href="#">Contact</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="456772"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="215058"]Headquarter[/vc_custom_heading][vc_column_text uncode_shortcode_id="118720"]5678 Creative Street
Suite #345
Los Angeles, CA 90021

<a href="#">View on Maps</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_center_mobile" mobile_width="0" width="1/4" uncode_shortcode_id="111074"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="128179"]Conversation[/vc_custom_heading][vc_column_text uncode_shortcode_id="847592"]<a href="mailto:hello@yournewwebsite.com">hello@yournewwebsite.com</a>
646-932-3253[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
