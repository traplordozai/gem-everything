<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'News Classic Innovators', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Classic-Innovators.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="186421"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="730276"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="171078"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="940335"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h5' ) .'" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" radius="xl" uncode_shortcode_id="184645" back_color_type="uncode-palette"]<span class="text-accent-color">●</span> Updates[/vc_custom_heading][vc_separator sep_color="" uncode_shortcode_id="473947"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="5" column_width_percent="100" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="169072"][vc_column column_width_use_pixel="yes" position_horizontal="left" position_vertical="justify" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="114419" column_width_pixel="480"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="123292"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="988532"]News &amp; Insight[/vc_custom_heading][vc_custom_heading heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="300" uncode_shortcode_id="461760"]We share the latest breakthroughs, innovations, and updates in the biochemical industry[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_button size="btn-lg" radius="btn-circle" outline="yes" border_width="0" icon_position="right" scale_mobile="no" uncode_shortcode_id="286472" icon="fa fa-arrow-right2" link="url:%23"]View Blog[/vc_button][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="203456"][uncode_index el_id="index-991019" index_type="css_grid" loop="size:2|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title" single_text="lateral" css_grid_images_size="three-two" single_image_size="6" single_shape="round" radius="lg" single_overlay_opacity="10" single_padding="1" single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="500" single_border="yes" uncode_shortcode_id="204608"][/vc_column][/vc_row]
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
