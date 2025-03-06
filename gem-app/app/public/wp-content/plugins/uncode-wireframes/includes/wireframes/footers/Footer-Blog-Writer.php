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

$data[ 'name' ]             = esc_html__( 'Footer Blog Writer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Writer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="752403"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="133361"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="976202"][vc_column_inner width="10/12"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'fontsize-445851' ) .'" uncode_shortcode_id="124102"]Long headline to turn your visitors into users of your website[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="179123"][/vc_column_inner][/vc_row_inner][vc_separator sep_color="" uncode_shortcode_id="110636" sep_color_type="uncode-solid" sep_color_solid="#b2adad"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="6" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="477919"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="208182"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="152110"]Send an email[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="114733"]<u><a href="mailto:yourmail@website.com">yourmail@website.com</a></u>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="153860"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="726219"]Follow on Social[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="197041"]<u><a href="#">Facebook</a></u><br />
<u><a href="#">Twitter</a></u><br />
<u><a href="#">Instagram</a></u>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
