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

$data[ 'name' ]             = esc_html__( 'Shop Sticky', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Sticky.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="0" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1547789710831{border-right-width: 0px !important;}"][vc_column column_width_percent="100" override_padding="yes" column_padding="0" overlay_alpha="50" gutter_size="0" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0"][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" sticky="yes" width="1/2"][uncode_index el_id="index-12341" loop="size:1|order_by:date|order:ASC|post_type:product" style_preset="metro" single_height_viewport="yes" gutter_size="2" post_items="media|featured|onpost|original,date,title,text|excerpt|120,sep-one|full,author" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|default" screen_lg="600" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" single_fluid_height="100" single_style="dark" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="25" single_text_visible="yes" single_text_anim_type="btt" single_overlay_anim="no" single_image_anim_move="yes" single_h_align="center" single_v_position="bottom" single_padding="2" single_title_dimension="h6" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="800" single_animation_delay="400" post_matrix="matrix" matrix_amount="3" matrix_items="e30="][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="0" gutter_size="0" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2"][uncode_index el_id="index-12342" loop="size:8|order_by:date|order:ASC|post_type:product" style_preset="metro" single_height_viewport="yes" gutter_size="0" post_items="media|featured|onpost|original,date,title,text|excerpt|120,sep-one|full,author" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|default" screen_lg="600" screen_md="600" screen_sm="480" single_text="overlay" single_width="6" single_fluid_height="60" single_style="dark" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="25" single_text_visible="yes" single_text_anim_type="btt" single_overlay_anim="no" single_image_anim_move="yes" single_h_align="center" single_v_position="bottom" single_padding="2" single_title_dimension="h6" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="800" single_animation_delay="400" post_matrix="matrix" matrix_amount="3" matrix_items="e30=" offset="1"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
