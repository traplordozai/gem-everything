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

$data[ 'name' ]             = esc_html__( 'Blog Standard', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Standard.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_use_pixel="yes" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" mobile_width_full="" column_width_pixel="900"][uncode_index el_id="index-1179619133" isotope_mode="fitRows" loop="size:6|order_by:date|post_type:post" gutter_size="4" post_items="media|featured|lightbox|poster,icon|md,date,title,text|excerpt|160,sep-one|extra,author|md_size|display_qualification" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="860" screen_md="600" screen_sm="480" single_width="12" images_size="two-one" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" radius="xs" single_overlay_opacity="50" single_image_anim="no" single_padding="2" single_title_dimension="h2" single_css_animation="bottom-t-top" single_animation_delay="200" post_matrix="matrix" matrix_amount="3" single_half_padding="" single_title_uppercase="" single_title_bold="yes" single_title_serif="" single_title_divider="" single_no_background="" footer_position="left" carousel_rtl="" single_icon="fa fa-plus2" matrix_items="e30="][/vc_column][/vc_row]
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
