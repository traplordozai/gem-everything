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

$data[ 'name' ]             = esc_html__( 'Product Centered', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Centered.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="50" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="0" back_color="color-prif" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="900"][vc_gallery el_id="gallery-958453445-2736" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471,80471,80471 ) ) .'" dynamic="yes" dynamic_source="featured" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="four-three" gutter_size="0" media_items="media|lightbox|original" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_mobile="yes" carousel_dots_inside="yes" carousel_dot_padding="2" carousel_half_opacity="yes" carousel_pointer_events="yes" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_text_anim_type="btt" single_image_anim="no" single_h_align="center" single_padding="2" single_border="yes" single_css_animation="top-t-bottom" single_animation_delay="200" single_animation_first="yes" lbox_caption="yes" no_double_tap="yes" carousel_rtl="" single_title_uppercase="" single_title_bold="" single_title_serif="" onclick="link_image" custom_links_target="_self" items="eyI4ODY4X2kiOnsic2luZ2xlX3dpZHRoIjoiNCIsInNpbmdsZV9oZWlnaHQiOiI0In0sIjg4NjJfaSI6eyJzaW5nbGVfd2lkdGgiOiI0Iiwic2luZ2xlX2hlaWdodCI6IjQifSwiODg2MF9pIjp7InNpbmdsZV93aWR0aCI6IjQifX0=" single_half_padding="" single_no_background=""][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="2" top_divider="step" bottom_divider="gradient" inverted_device_order="yes"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="500"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]This is a custom heading element.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-gyho"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][uncode_single_product_meta inline="yes"][vc_column_text auto_text="content"]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-gyho"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_button dynamic="add-to-cart" quantity="variation" size="btn-lg" wide="yes" border_width="0" scale_mobile="no"]Text on the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-gyho"][uncode_share layout="multiple" no_back="yes"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="gradient" shape_top_h_use_pixel="true" shape_top_height_percent="33" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" style="inherited"][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="468"][vc_custom_heading text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Related Products[/vc_custom_heading][uncode_index el_id="index-794770" index_type="carousel" loop="size:6|order_by:date|post_type:product" auto_query="yes" auto_query_type="related" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="four-three" gutter_size="5" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,price|inline" portfolio_items="title,media|featured|onpost|original" carousel_interval="3000" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" carousel_half_opacity="yes" carousel_pointer_events="yes" stage_padding="0" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="zoom-in" single_animation_first="yes"][/vc_column][/vc_row]
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
