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

$data[ 'name' ]             = esc_html__( 'Shop Products Crafter', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Products-Crafter.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="2" overlay_alpha="85" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" row_name="Woman" uncode_shortcode_id="931784"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3" uncode_shortcode_id="148730"][vc_column_text uncode_shortcode_id="179018"]Medium headline[/vc_column_text][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="290713"]Medium length headline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" link_to="|||" uncode_shortcode_id="682671"][vc_column_text uncode_shortcode_id="106055"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.
[/vc_column_text][vc_empty_space empty_h="0"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="5" overlay_alpha="85" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" row_name="Woman" uncode_shortcode_id="553767"][vc_column column_width_use_pixel="yes" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" link_to="|||" uncode_shortcode_id="578363" column_width_pixel="740"][uncode_index el_id="index-1507484453" index_type="carousel" loop="size:3|order_by:date|post_type:product|taxonomy_count:10" carousel_lg="1" carousel_md="2" carousel_sm="1" thumb_size="four-five" gutter_size="4" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc|atc-typo-default|hide-atc,title,price|default" carousel_interval="5000" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots_mobile="yes" carousel_dot_position="left" carousel_width_percent="100" carousel_pointer_events="yes" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="2" single_text_reduced="yes"  single_title_dimension="h5" single_border="yes" custom_order="yes" custom_cursor="diff" order_ids="19263,18962,18964" uncode_shortcode_id="145291"][/vc_column][/vc_row]
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
