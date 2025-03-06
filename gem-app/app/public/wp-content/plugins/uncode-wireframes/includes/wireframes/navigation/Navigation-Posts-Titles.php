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

$data[ 'name' ]             = esc_html__( 'Navigation Posts Titles', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'navigation' ];
$data[ 'custom_class' ]     = 'navigation';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'navigation/Navigation-Posts-Titles.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="514727" css=".vc_custom_1642071879058{border-top-width: 1px !important;}" border_color_type="uncode-palette" column_width_pixel="1600" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="681218"][uncode_index el_id="index-589-534" index_type="titles" loop="size:1|order_by:date|post_type:post,portfolio|taxonomy_count:10" auto_query="yes" auto_query_type="navigation" gutter_size="3" drop_width="3" drop_ratio="four-three" drop_anchor="center" drop_image_time="250" drop_image_arrange="front" drop_radius="" drop_shadow="yes" drop_shadow_weight="std" drop_image_hover="opacity" single_title_dimension="h4" single_title_weight="400" single_title_height="fontheight-357766" single_title_space="fontspace-781688" navigation_type="next" navigation_label_custom_typo="yes" navigation_label_size="fontsize-338686" navigation_label_weight="500" uncode_shortcode_id="152574" navigation_next_label="Next Item" navigation_next_icon="fa fa-arrow-right2"][/vc_column][/vc_row]
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
