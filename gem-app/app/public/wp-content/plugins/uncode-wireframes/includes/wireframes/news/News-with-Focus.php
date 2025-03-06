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

$data[ 'name' ]             = esc_html__( 'News with Focus', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-with-Focus.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="4" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="769534"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3" uncode_shortcode_id="502551" el_class="news-large"][uncode_index el_id="index-903166-323-919" index_type="css_grid" loop="size:2|order_by:date|post_type:post|taxonomy_count:10" grid_items="2" screen_lg_items="2" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="2" post_items="media|featured|onpost|original,date,title" css_grid_images_size="five-four" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="2" single_title_dimension="h2" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="600" single_border="yes" uncode_shortcode_id="113527"][/vc_column][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="135375"][uncode_index el_id="index-903166-323" index_type="css_grid" loop="size:4|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="2" screen_lg_breakpoint="960" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="date,title" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="0" single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="600" single_border="yes" uncode_shortcode_id="665068" offset="2"][/vc_column][/vc_row]
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
