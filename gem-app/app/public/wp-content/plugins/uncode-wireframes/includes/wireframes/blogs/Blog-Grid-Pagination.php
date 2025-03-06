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

$data[ 'name' ]             = esc_html__( 'Blog Grid Pagination', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Grid-Pagination.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column width="1/1"][uncode_index el_id="index-15588655905" isotope_mode="fitRows" loop="size:3|order_by:date|post_type:post" filtering="yes" filtering_full_width="yes" filtering_position="center" filtering_uppercase="yes" pagination="yes" footer_full_width="yes" gutter_size="2" post_items="media|featured|onpost|poster,category|colorbg|topright|display-icon,date,title,text|excerpt|84" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="1000" screen_md="900" screen_sm="480" images_size="three-two" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" radius="xs" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_anim="no" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" single_half_padding="" single_title_bold="yes" single_title_serif="" single_title_divider="" single_no_background="" items="e30=" footer_position="left" carousel_rtl="" single_icon="fa fa-plus2" filtering_transform="uppercase"][/vc_column][/vc_row]
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
