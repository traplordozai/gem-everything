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

$data[ 'name' ]             = esc_html__( 'Blog Magazine', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Magazine.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0"][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="0" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="1/2" el_class="is_stucked"][uncode_index el_id="index-1" loop="size:1|order_by:date|post_type:post" style_preset="metro" single_height_viewport="yes" gutter_size="3" post_items="media|featured|onpost|original,date,title,text|excerpt|120" screen_lg="100" screen_md="100" screen_sm="100" single_text="overlay" single_width="12" single_fluid_height="100" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="100" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_overlay_anim="no" single_image_anim_move="yes" single_v_position="bottom" single_reduced="three_quarter" single_padding="3" single_title_dimension="fontsize-155944" single_border="yes" single_css_animation="alpha-anim" single_animation_delay="200"][/vc_column_inner][vc_column_inner column_width_percent="100" override_padding="yes" column_padding="3" gutter_size="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2" el_class="remove-top-padding"][uncode_index el_id="index-2" isotope_mode="fitRows" loop="size:All|order_by:date|post_type:post" gutter_size="4" post_items="media|featured|onpost|poster,date,title,text|excerpt|80,category|bordered|topright|display-icon" screen_lg="600" screen_md="480" screen_sm="480" single_width="6" images_size="four-three" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_image_anim_move="yes" single_padding="1" single_title_dimension="h4" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" post_matrix="matrix" matrix_amount="2" offset="1" matrix_items="e30="][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
