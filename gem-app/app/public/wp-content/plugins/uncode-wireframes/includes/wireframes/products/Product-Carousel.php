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

$data[ 'name' ]             = esc_html__( 'Product Carousel', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Carousel.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="65" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="0" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="step" style="inherited" row_name="Gallery"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full=""][vc_gallery el_id="gallery-73689423" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" dynamic="yes" dynamic_source="featured" carousel_lg="2" carousel_md="2" carousel_sm="1" thumb_size="one-one" gutter_size="4" media_items="media|nolink|original,icon|md" carousel_v_align="middle" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_mobile="yes" carousel_dot_position="left" carousel_half_opacity="yes" stage_padding="0" single_overlay_color="color-wayh" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_shadow="yes" shadow_weight="lg" shadow_darker="yes" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" single_animation_first="yes" lbox_no_tmb="yes" carousel_rtl="" single_title_uppercase="" single_half_padding="" single_title_serif="" single_no_background=""][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" desktop_visibility="yes"][vc_column width="1/1"][vc_empty_space][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider_inv="step_2_3" shape_bottom_invert="yes" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="100" shape_bottom_color="color-gyho" shape_bottom_opacity="100" shape_bottom_index="0" shape_bottom_responsive="yes" shape_bottom_tablet_hide="yes" shape_bottom_mobile_hide="yes" inverted_device_order="yes" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="7/12"][vc_empty_space empty_h="2"][vc_custom_heading auto_text="excerpt" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings.[/vc_custom_heading][vc_column_text auto_text="content" text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][vc_separator][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Short headline[/vc_custom_heading][uncode_single_product_meta][vc_separator][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Short headline[/vc_custom_heading][uncode_single_product_reviews][/vc_column][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="5/12"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h3' ) .'"]This is a custom heading element.[/vc_custom_heading][uncode_single_product_rating][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_button dynamic="add-to-cart" quantity="variation" button_color="accent" size="btn-lg" wide="yes" hover_fx="full-colored" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
