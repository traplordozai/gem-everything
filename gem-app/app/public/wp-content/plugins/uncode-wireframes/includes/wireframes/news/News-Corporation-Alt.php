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

$data[ 'name' ]             = esc_html__( 'News Corporation Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Corporation-2024.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" overlay_alpha="50" equal_height="yes" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="327758"][vc_column column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12"][vc_empty_space empty_h="0"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="175581"]Tagline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="147154"]Change the color to match your brand or vision, add your logo.[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" equal_height="yes" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="985229"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="898756"][uncode_index el_id="index-205112" loop="size:3|order_by:date|post_type:post|taxonomy_count:10" screen_lg="1200" screen_md="600" screen_sm="480" gutter_size="4" post_items="media|featured|onpost|original,date,title,text|excerpt|180" images_size="three-two" single_overlay_opacity="50" single_padding="2" single_title_dimension="h2" single_title_height="fontheight-357766" single_text_lead="yes" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" custom_cursor="accent" uncode_shortcode_id="212445"][/vc_column][/vc_row]
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
