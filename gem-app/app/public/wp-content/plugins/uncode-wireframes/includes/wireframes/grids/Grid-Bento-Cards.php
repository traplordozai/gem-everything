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

$data[ 'name' ]             = esc_html__( 'Grid Bento Cards', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Bento-Cards.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="justify" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="138034" back_color_type="uncode-palette" column_width_pixel="1400"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="left top" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="10" radius="hg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="1/2" uncode_shortcode_id="103603" back_color_type="uncode-palette" overlay_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="492113"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" media_ratio="one-one" shape="img-circle" uncode_shortcode_id="202128" media_width_pixel="80"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="204343"]“ Long headline to turn your visitors into users ”[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" sub_reduced="yes" uncode_shortcode_id="186482" subheading="Change the color to match your brand"]Medium length headline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="130322"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-round" radius="hg" uncode_shortcode_id="147466"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="121501"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" radius="hg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="107601" back_color_type="uncode-palette"][uncode_counter value="3" counter_color="" size="fontsize-338686" weight="600" height="fontheight-179065" uncode_shortcode_id="184496" suffix="x"][vc_empty_space empty_h="3"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="130537"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="109621"][vc_row_inner row_inner_height_percent="100" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="108187"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" radius="hg" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="833071" back_color_type="uncode-palette"][uncode_counter value="98" counter_color="" size="fontsize-338686" weight="600" height="fontheight-179065" uncode_shortcode_id="484342" suffix="%"][vc_empty_space empty_h="3"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="214013"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" shape="img-round" radius="hg" uncode_shortcode_id="463179"][/vc_column][/vc_row]
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
