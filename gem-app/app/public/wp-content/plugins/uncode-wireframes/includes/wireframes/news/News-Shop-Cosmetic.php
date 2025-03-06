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

$data[ 'name' ]             = esc_html__( 'News Shop Cosmetic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Shop-Cosmetic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" changer_back_color="yes" uncode_shortcode_id="742912" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="171770"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" limit_content="" uncode_shortcode_id="102502"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="414654"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="182035"]Medium headline[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="711549"][vc_button border_width="0" uncode_shortcode_id="100567"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-5" index_type="css_grid" loop="size:3|order_by:date|post_type:post|taxonomy_count:10" grid_items="3" screen_lg_items="2" screen_lg_breakpoint="960" screen_md_items="1" screen_md_breakpoint="540" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="4" post_items="date,title,spacer|half,text|excerpt|100,spacer_two|one,media|featured|onpost|original" css_grid_images_size="three-two" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_padding="2"  single_title_dimension="h3" single_title_height="fontheight-357766" single_meta_custom_typo="yes" single_meta_size="default" single_meta_weight="400" uncode_shortcode_id="634225"][/vc_column][/vc_row]
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
