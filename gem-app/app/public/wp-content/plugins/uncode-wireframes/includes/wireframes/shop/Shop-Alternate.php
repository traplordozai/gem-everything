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

$data[ 'name' ]             = esc_html__( 'Shop Alternate', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Alternate.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="186325" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="161894"][uncode_index el_id="index-41439378-357" isotope_mode="cellsByRow" loop="size:12|order_by:rand|post_type:product|taxonomy_count:10" gutter_size="4" post_items="media|featured|onpost|poster,title,spacer|half" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc|atc-typo-column|hide-atc,price|default" portfolio_items="media|featured|onpost|original,title" screen_lg="760" screen_md="600" screen_sm="480" single_width="6" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_image_anim="no" single_h_align="center" single_padding="2" single_text_reduced="yes" single_title_dimension="h3" single_border="yes" single_css_animation="parallax" single_parallax_intensity="1" post_matrix="matrix" matrix_amount="4" custom_cursor="accent" skew="yes" matrix_items="eyIwX2kiOnsiaW1hZ2VzX3NpemUiOiIiLCJzaW5nbGVfd2lkdGgiOiI2Iiwic2luZ2xlX3RpdGxlX2RpbWVuc2lvbiI6ImgxIn0sIjJfaSI6eyJpbWFnZXNfc2l6ZSI6IiIsInNpbmdsZV93aWR0aCI6IjMiLCJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4IjoiaGlnaCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiIxMCJ9LCIzX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsImltYWdlc19zaXplIjoiIiwic2luZ2xlX3RpdGxlX2RpbWVuc2lvbiI6ImgxIiwic2luZ2xlX2Nzc19hbmltYXRpb24iOiJwYXJhbGxheCIsInNpbmdsZV9wYXJhbGxheCI6Im5vcm1hbCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiI1In0sIjFfaSI6eyJzaW5nbGVfd2lkdGgiOiIzIiwiaW1hZ2VzX3NpemUiOiIiLCJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4IjoiaGlnaCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiI4In19" uncode_shortcode_id="581161"][/vc_column][/vc_row]
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
