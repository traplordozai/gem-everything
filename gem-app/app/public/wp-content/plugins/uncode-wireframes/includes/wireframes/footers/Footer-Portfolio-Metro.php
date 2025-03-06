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

$data[ 'name' ]             = esc_html__( 'Footer Portfolio Metro', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Portfolio-Metro.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="121892" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="366908"][vc_separator sep_color="color-prif"][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12" uncode_shortcode_id="696543"][vc_custom_heading text_color="color-wvjs" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="118494" text_color_type="uncode-palette"]LETS MAKE SOMETHING GREAT[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" sub_lead="yes" sub_reduced="yes" text_align="text-left" text_serif="yes" uncode_shortcode_id="156865"]We create cool works[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="330060"][vc_column_text uncode_shortcode_id="145427"]<a href="#">About</a><br />
<a href="#">Services</a><br />
<a href="#">Work</a><br />
<a href="#">Manifesto</a><br />
<a href="#">Careers</a><br />
<a href="#">Solutions</a><br />
<a href="#">Expertise</a><br />
<a href="#">Contact</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12"][vc_custom_heading text_color="color-wvjs" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="576347" text_color_type="uncode-palette"]KICKSTART A PROJECT[/vc_custom_heading][vc_column_text uncode_shortcode_id="206218"]<a href="mailto:create@yourwebsite.com">create@yourwebsite.com</a>[/vc_column_text][vc_empty_space empty_h="1"][vc_custom_heading text_color="color-wvjs" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'"]WE ARE HIRING[/vc_custom_heading][vc_column_text uncode_shortcode_id="729654"]<a href="mailto:hiring@yourwebsite.com">hiring@yourwebsite.com</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12"][uncode_socials size="lead"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="4" medium_visibility="yes" mobile_visibility="yes"][vc_separator sep_color="color-prif"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="2/3" uncode_shortcode_id="102949"][uncode_copyright][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_left_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="105672"][vc_column_text text_lead="small" uncode_shortcode_id="213409"]<a href="#" target="_blank" rel="noopener noreferrer">Privacy Policy</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
