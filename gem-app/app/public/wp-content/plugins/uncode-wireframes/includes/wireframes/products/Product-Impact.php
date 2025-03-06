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

$data[ 'name' ]             = esc_html__( 'Product Impact', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Product-Impact.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="6" bottom_padding="4" back_color="accent" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" top_divider="gradient" enable_bottom_divider="default" bottom_divider="tilt-opacity" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="90" shape_bottom_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" shape_bottom_opacity="100" shape_bottom_ratio="yes" shape_bottom_index="0" column_width_pixel="1338" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="0" shift_y="0" z_index="0" inverted_device_order="yes" limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="1" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="3" shift_y="0" shift_y_down="0" z_index="2" medium_width="0" mobile_width="0" css_animation="right-t-left" animation_delay="200" shadow="xl" shadow_darker="yes" width="1/3"][vc_custom_heading auto_text="yes" heading_semantic="h1" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]This is a custom heading element.[/vc_custom_heading][uncode_single_product_rating][vc_custom_heading auto_text="price" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'"]This is a custom heading element.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button dynamic="add-to-cart" quantity="variation" button_color="accent" size="btn-lg" wide="yes" text_skin="yes" italic="yes" border_width="0"]Text on the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="-2" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="left-t-right" animation_delay="200" width="2/3"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" dynamic="yes" media_width_percent="100" media_ratio="four-three"][vc_empty_space][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" style="inherited" row_height_pixel="300" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" medium_width="0" zoom_width="0" zoom_height="0" width="1/1"][vc_gallery el_id="gallery-95845344534" type="carousel" medias="'. uncode_wf_print_multiple_images( array( 80471 ) ) .'" dynamic="yes" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="sixteen-nine" gutter_size="0" media_items="media,icon" carousel_interval="0" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_pointer_events="yes" stage_padding="0" single_overlay_opacity="20" single_image_anim="no" single_h_align="center" single_padding="2" single_icon="fa fa-plus2" single_border="yes" single_css_animation="right-t-left" single_animation_delay="200" single_animation_first="yes" lbox_caption="yes" no_double_tap="yes" carousel_rtl="" single_title_uppercase="" single_title_bold="" single_title_serif="" onclick="link_image" custom_links_target="_self" items="eyI4ODY4X2kiOnsic2luZ2xlX3dpZHRoIjoiNCIsInNpbmdsZV9oZWlnaHQiOiI0In0sIjg4NjJfaSI6eyJzaW5nbGVfd2lkdGgiOiI0Iiwic2luZ2xlX2hlaWdodCI6IjQifSwiODg2MF9pIjp7InNpbmdsZV93aWR0aCI6IjQifX0=" single_half_padding="" single_no_background=""][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="mountains"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3"][vc_custom_heading heading_semantic="h3" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Short headline[/vc_custom_heading][uncode_single_product_meta][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3"][vc_custom_heading heading_semantic="h3" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Short headline[/vc_custom_heading][vc_column_text auto_text="content"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_column_text][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" bottom_divider="mountains" css=".vc_custom_1591793972240{border-top-width: 1px !important;}"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3"][vc_custom_heading heading_semantic="h3" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Short headline[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3"][uncode_single_product_reviews][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" enable_top_divider="default" top_divider="gradient" shape_top_h_use_pixel="true" shape_top_height_percent="100" shape_top_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_top_opacity="100" shape_top_index="0" style="inherited"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'"]Related products[/vc_custom_heading][uncode_index el_id="index-145759" loop="size:4|order_by:date|post_type:product" gutter_size="3" product_items="media|featured|onpost|original|hide-sale|enhanced-atc|inherit-w-atc,title,price|inline" screen_lg="1000" screen_md="600" screen_sm="100" single_width="3" single_overlay_opacity="50" single_overlay_anim="no" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_border="yes"][/vc_column][/vc_row]
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
