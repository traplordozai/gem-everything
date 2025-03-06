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

$data[ 'name' ]             = esc_html__( 'Blog Double', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Double.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="84" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" el_class="overflow-hidden"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-1" loop="size:2|order_by:date|post_type:post" style_preset="metro" single_height_viewport="yes" gutter_size="0" post_items="media|featured|onpost|poster,date,title" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="960" screen_md="770" screen_sm="640" single_text="overlay" single_width="6" single_fluid_height="84" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_overlay_anim="no" single_h_align="center" single_h_align_mobile="left" single_reduced="three_quarter" single_reduced_mobile="yes" single_h_position="center" single_padding="3" single_title_dimension="fontsize-155944" single_shadow="yes" single_border="yes" single_title_uppercase="" single_title_bold="yes" footer_position="left" carousel_rtl="" single_no_background="" order_ids="4237,4231,4239,4233,4262,4245,4252,4243,4254,4247,4241,4629,4229,4636,4225,4193,20518,20520"][/vc_column][/vc_row]
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
