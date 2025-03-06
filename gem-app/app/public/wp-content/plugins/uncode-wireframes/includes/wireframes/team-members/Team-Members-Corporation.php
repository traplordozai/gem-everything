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

$data[ 'name' ]             = esc_html__( 'Team Members Corporation', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'team_members' ];
$data[ 'custom_class' ]     = 'team_members';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'team-members/Team-Members-Corporation.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" overlay_alpha="50" equal_height="yes" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12"][vc_empty_space empty_h="0"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="175581"]Tagline[/vc_custom_heading][/vc_column][vc_column width="8/12"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="142024"]Change the color to match your brand or vision, add your logo.[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="168750"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_percent="100" media_ratio="four-five" uncode_shortcode_id="901998"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="He held several senior-level executive management positions in both private and publicly traded companies." uncode_shortcode_id="573388"]Harrison Rees, CEO[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="201957"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_percent="100" media_ratio="four-five" uncode_shortcode_id="607827"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="He has led the development and execution of asset management strategies for several large." uncode_shortcode_id="202097"]Crosby Whey, CFO[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="134163"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_percent="100" media_ratio="four-five" uncode_shortcode_id="864736"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" sub_lead="yes" sub_reduced="yes" subheading="Passionate about making a difference and building long-standing relationships guidance." uncode_shortcode_id="451476"]Emily Burke, Human Capital[/vc_custom_heading][/vc_column][/vc_row]
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
