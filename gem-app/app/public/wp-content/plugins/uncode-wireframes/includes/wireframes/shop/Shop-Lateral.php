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

$data[ 'name' ]             = esc_html__( 'Shop Lateral', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Lateral.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" override_padding="yes" column_padding="0" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-2" loop="size:6|order_by:date|post_type:product" footer_full_width="yes" gutter_size="2" post_items="media|featured|onpost|original,date,title,text|excerpt|160,sep-one|full,link|link" product_items="media|featured|onpost|original|hide-sale|enhanced-atc,title,price|default,text|excerpt|60" screen_lg="1000" screen_md="600" screen_sm="480" single_text="lateral" images_size="one-one" single_image_position="right" single_image_size="6" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" single_overlay_opacity="50" single_text_anim="no" single_overlay_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="3" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200"][/vc_column][/vc_row]
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
