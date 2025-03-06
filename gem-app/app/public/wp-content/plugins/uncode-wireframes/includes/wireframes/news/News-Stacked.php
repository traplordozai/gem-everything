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

$data[ 'name' ]             = esc_html__( 'News Stacked', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Stacked.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="100" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" gutter_size="4" column_width_use_pixel="yes" shift_y="0" z_index="0" css_animation="inner-rows" animation_state="end" animation_origin="center" animation_scale_val="25" animation_scale_step="yes" animation_opacity="100" animation_x="0" animation_y="0" animation_blur="0" animation_rotate="25" animation_rotate_alt="yes" animation_start_point="center" animation_inner_space="35" no_animation_last="yes" animation_anticipate="0" content_parallax="0" animation_bottom_space="0" style="inherited" uncode_shortcode_id="194740" column_width_pixel="1600" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0"  overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" zoom_width="0" zoom_height="0" width="1/1" uncode_shortcode_id="153856"][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-987656725" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="159875" matrix_items="e30=" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-9876567255" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_position="right" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="126204" matrix_items="e30=" offset="1" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-9876567140" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="214136" matrix_items="e30=" offset="2" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-9876567162" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_position="right" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="314414" matrix_items="e30=" offset="3" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-98765671116" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="171779" matrix_items="e30=" offset="4" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner width="1/1"][uncode_index el_id="index-98765671372" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="6" post_items="media|featured|onpost|original,date,title,text|excerpt|110,spacer|one,author|md_size|display_qualification" footer_full_width="yes" single_text="lateral" single_width="12" single_image_position="right" single_image_size="5" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="4" single_title_dimension="custom" single_meta_custom_typo="yes" single_meta_size="large" single_meta_weight="400" single_shadow="yes" shadow_weight="std" single_border="yes" post_matrix="matrix" matrix_amount="2" uncode_shortcode_id="169265" matrix_items="e30=" offset="5" heading_custom_size="clamp(20px,5vw,60px)"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]

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
