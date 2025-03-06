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

$data[ 'name' ]             = esc_html__( 'Shop Classic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Classic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="step"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="100" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full=""][vc_row_inner][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="660"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" sub_lead="yes" sub_reduced="yes" text_uppercase=""]Short headline[/vc_custom_heading][vc_column_text text_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_column_text][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-15687" isotope_mode="fitRows" loop="size:3|order_by:date|order:DESC|post_type:product" gutter_size="2" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media|featured|onpost|original|hide-sale|enhanced-atc,price|inline,spacer|half" portfolio_items="title,media,text,category" screen_lg="900" screen_md="600" screen_sm="480" images_size="three-four" single_shape="round" radius="xs" single_overlay_opacity="20" single_image_anim="no" single_h_align="center" single_padding="1" single_title_dimension="fontsize-160000" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" custom_order="yes" no_double_tap="yes" carousel_rtl="" single_title_uppercase="" filtering_menu="inline" single_block_click="" single_text_hover="" single_no_background="" single_title_serif="" single_title_divider=""][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
