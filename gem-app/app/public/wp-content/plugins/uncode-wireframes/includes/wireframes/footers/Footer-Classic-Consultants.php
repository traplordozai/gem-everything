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

$data[ 'name' ]             = esc_html__( 'Footer Classic Consultants', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Consultants.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="149255" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="5" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="123859"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="180901"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="4/12" uncode_shortcode_id="136998"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="568457" heading_custom_size="clamp(35px,6vw,60px)"]Long headline to turn your visitors into users[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="952654"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="443338"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="210678"]NAVIGATE[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="202591"]<a href="#">Projects</a><br />
<a href="#">Thoughts</a><br />
<a href="#">About</a><br />
<a href="#">Services</a><br />
<a href="#">Contact</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="174663"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_weight="700" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="144677"]Follow us[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="141259"]<a href="#">Twitter</a><br />
<a href="#">Facebook</a><br />
<a href="#">Instagram</a><br />
<a href="#">LinkedIn</a><br />
<a href="#">Pinterest</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="963821"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="103298"]Customers[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="201888"]<a href="#">FAQ</a><br />
<a href="#">Cookie Policy</a><br />
<a href="#">Privacy Policy</a><br />
<a href="#">Licenses</a><br />
<a href="#">Help Center</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator uncode_shortcode_id="190188" sep_color_type="uncode-solid" sep_color_solid="rgba(255,255,255,0.25)"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="184938"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="4/12" uncode_shortcode_id="871322"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="590514"]©2024 ⸻ All rights reserved.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="2/12" uncode_shortcode_id="450604"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="115791"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="677903"]London[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="274882"]71, Windsor Road<br />
London, Chiswick<br />
W28 3QW<br />
+44 2012345678[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="203495"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="100409"]Amsterdam[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="613193"]20, Oude Haagseweg<br />
Amsterdam, Holland<br />
1066 BW<br />
+31 201234567[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="198648"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_space="'. uncode_wf_print_font_space( 'fontspace-210350' ) .'" uncode_shortcode_id="471858"]GÖTEBORG[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="124754"]5, Biskopsvagen<br />
Greater Stockholm<br />
41469 GBG<br />
+46 31123456[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
