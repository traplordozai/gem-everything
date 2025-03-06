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

$data[ 'name' ]             = esc_html__( 'Product Stunning', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Stunning.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" kburns="yes" overlay_color="accent" overlay_alpha="85" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider="step" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="27" shape_bottom_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" shape_bottom_opacity="100" shape_bottom_index="0"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="960"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" dynamic="yes" media_width_percent="100" media_ratio="sixteen-nine" css_animation="zoom-out"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="600"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][uncode_single_product_meta inline="yes"][vc_button dynamic="add-to-cart" quantity="variation" button_color="accent" size="btn-xl" wide="yes" hover_fx="full-colored" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="0" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step" shape_top_h_use_pixel="" shape_top_height="150" shape_top_opacity="100" shape_top_index="0" style="inherited" row_name="Gallery"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="4" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full="" column_width_pixel="1000"][vc_gallery el_id="gallery-736894238" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471,80471 ) ) .'" dynamic="yes" carousel_lg="1" carousel_md="2" carousel_sm="1" thumb_size="three-two" gutter_size="4" media_items="media|lightbox|original,icon|md" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="0" single_shape="round" radius="xs" single_overlay_color="color-wayh" single_overlay_opacity="50" single_image_anim="no" single_h_align="center" single_padding="2" single_icon="fa fa-plus2" single_shadow="yes" shadow_weight="xl" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" single_animation_first="yes" lbox_no_tmb="yes" carousel_rtl="" single_title_uppercase="" single_half_padding="" single_title_serif="" single_no_background=""][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="600"][vc_custom_heading auto_text="excerpt" heading_semantic="h3" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_column_text auto_text="content"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" css=".vc_custom_1589467883284{border-top-width: 1px !important;}"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="1000"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h5' ) .'"]Related products[/vc_custom_heading][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="4" back_color="color-prif" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="step" shape_top_h_use_pixel="true" shape_top_height_percent="30" shape_top_opacity="100" shape_top_index="0" bottom_divider="gradient" style="inherited"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-794770" index_type="carousel" loop="size:5|order_by:date|post_type:product" auto_query="yes" auto_query_type="related" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="sixteen-nine" gutter_size="4" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|inline" portfolio_items="title,media|featured|onpost|original" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="60" single_style="dark" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h6" single_border="yes"][/vc_column][/vc_row]
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
