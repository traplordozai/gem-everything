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

$data[ 'name' ]             = esc_html__( 'Blog Masonry', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Masonry.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="0" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" animation_delay="200" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-147013" loop="size:12|order_by:date|post_type:post" filtering="yes" filtering_full_width="yes" filter_all_opposite="yes" filtering_uppercase="yes" filter_mobile="yes" filter_scroll="yes" footer_style="dark" gutter_size="3" post_items="media|featured|onpost|original,category|colorbg|topright,date,title,text|excerpt|60,sep-one|extra,author|md_size|display_qualification" screen_lg="1400" screen_md="960" screen_sm="480" single_width="2" images_size="four-three" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim_move="yes" single_padding="2" single_title_dimension="h5" single_title_height="fontheight-357766" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" post_matrix="matrix" matrix_amount="2" single_image_translate="yes" shadow_hover="yes" shadow_hover_weight="lg" shadow_darker_hover="yes" matrix_items="eyIwX2kiOnsiaW1hZ2VzX3NpemUiOiJ0d28tb25lIn19"][/vc_column][/vc_row]
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
