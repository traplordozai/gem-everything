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

$data[ 'name' ]             = esc_html__( 'Shop Off-Grid Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Off-Grid-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="2" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="step_2_3"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="4" mobile_width="0" shift_x="3" shift_y="0" shift_y_down="0" z_index="0" width="6/12"][uncode_index el_id="index-1" loop="size:1|order_by:date|post_type:product" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|inline" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_width="12" images_size="one-one" single_overlay_opacity="10" single_image_anim_move="yes" single_h_align="center" single_h_align_mobile="center" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="600"][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="4" mobile_width="0" shift_x="5" shift_y="3" shift_y_down="0" z_index="0" width="4/12"][uncode_index el_id="index-2" loop="size:1|order_by:date|post_type:product" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|inline" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_width="12" images_size="three-four" single_overlay_opacity="10" single_image_anim_move="yes" single_h_align="center" single_h_align_mobile="center" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="600" offset="1"][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="3" shift_y="-3" shift_y_down="0" z_index="0" width="2/12"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="tilt"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/12"][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="4" mobile_width="0" shift_x="3" shift_y="0" shift_y_down="0" z_index="0" width="5/12"][uncode_index el_id="index-3" loop="size:1|order_by:date|post_type:product" gutter_size="3" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|inline" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_width="12" images_size="one-one" single_overlay_opacity="10" single_image_anim_move="yes" single_h_align="center" single_h_align_mobile="center" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="600" offset="2"][vc_empty_space empty_h="3" mobile_visibility="yes"][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" align_medium="align_center_tablet" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" shift_x="-3" shift_y="3" shift_y_down="0" z_index="1" width="5/12"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_delay="400" interval_animation="200"][uncode_hl_text bg="color-gyho" opacity="1" color="" height="50" animate="true" offset="0em"]Long headline to turn your visitors into users[/uncode_hl_text][/vc_custom_heading][/vc_column][vc_column width="1/12"][/vc_column][/vc_row]
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
