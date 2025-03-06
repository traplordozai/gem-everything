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

$data[ 'name' ]             = esc_html__( 'Shop Furniture Products', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Furniture-Products.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="188524" border_color_type="uncode-palette" css=".vc_custom_1709043453626{border-top-width: 1px !important;}"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="5"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="852248"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="839280"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="198834" column_width_pixel="740"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="211099" heading_custom_size="clamp(30px, 3vw, 45px)"]Long headline to turn your visitors into users[/vc_custom_heading][vc_button size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" icon_position="right" scale_mobile="no" uncode_shortcode_id="178136" icon="fa fa-arrow-right2"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-59022263" index_type="carousel" loop="size:6|order_by:date|post_type:product|taxonomy_count:10" carousel_lg="3" carousel_md="2" carousel_sm="1" thumb_size="four-five" gutter_size="2" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|auto-w-atc|atc-typo-column|hide-atc,title,price|inline" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="1"  single_title_dimension="h5" single_title_weight="500" single_title_space="fontspace-781688" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" single_animation_delay="400" single_animation_first="yes" uncode_shortcode_id="376373" order_ids="111416,111447,111497,111476,111429,111487"][/vc_column][/vc_row]
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
