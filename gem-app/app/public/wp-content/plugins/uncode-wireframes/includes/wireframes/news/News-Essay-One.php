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

$data[ 'name' ]             = esc_html__( 'News Essay One', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Essay-One.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="854157" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="201967"][uncode_index el_id="index-341454-676" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title|excerpt|120" css_grid_images_size="one-one" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" uncode_shortcode_id="577181"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="1/4" uncode_shortcode_id="835453"][uncode_index el_id="index-341454-676-817" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title|excerpt|120" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" single_animation_delay="100" uncode_shortcode_id="103345" offset="1"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="178299"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="1/4" uncode_shortcode_id="653059"][uncode_index el_id="index-341454-676-817" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title|excerpt|120" css_grid_images_size="three-four" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" single_animation_delay="200" uncode_shortcode_id="711409" offset="2"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="181341" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="214511"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="2/4" uncode_shortcode_id="137746"][uncode_index el_id="index-341454-676" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title|excerpt|120" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h1" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" uncode_shortcode_id="134983" offset="3"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="5" mobile_width="0" width="1/4" uncode_shortcode_id="115070"][uncode_index el_id="index-341454-676-817" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="3" post_items="media|featured|onpost|original,date,title|excerpt|120" css_grid_images_size="four-three" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h3" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" single_animation_delay="100" uncode_shortcode_id="903277" offset="4"][/vc_column][/vc_row]
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
