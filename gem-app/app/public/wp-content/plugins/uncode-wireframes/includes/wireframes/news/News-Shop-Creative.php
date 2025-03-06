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

$data[ 'name' ]             = esc_html__( 'News Shop Creative', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Shop-Creative.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="142207"][vc_column column_width_percent="100" gutter_size="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="252845"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="201644"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="843158"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="592109" heading_custom_size="clamp(35px,12vw,75px)"]Heading[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="444913"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="861750"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_transform="uppercase" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="741183" heading_custom_size="clamp(12px,2vw,16px)"]
Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="113631"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="950505"][vc_column column_width_percent="100" gutter_size="5" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="10/12" uncode_shortcode_id="252845"][uncode_index el_id="index-9505893" index_type="carousel" loop="size:7|order_by:date|post_type:post|taxonomy_count:10" carousel_lg="2" carousel_md="1" carousel_sm="1" thumb_size="one-one" gutter_size="2" post_items="media|featured|onpost|original,date,title,spacer|one,link|link|default_size|scale_mobile|READ MORE →" carousel_interval="0" carousel_navspeed="700" carousel_overflow="yes" stage_padding="0" single_text="lateral" single_image_size="7" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="1" single_title_dimension="h2" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" single_animation_first="yes" uncode_shortcode_id="204306"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="156836"][/vc_column][/vc_row]
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
