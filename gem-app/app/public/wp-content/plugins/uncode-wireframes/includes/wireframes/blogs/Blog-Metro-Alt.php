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

$data[ 'name' ]             = esc_html__( 'Blog Metro Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Metro-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" row_name="blog"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-1" loop="size:12|order_by:date|order:DESC|post_type:post" style_preset="metro" gutter_size="2" post_items="media|featured|onpost|poster,category|bordered|topright|display-icon,date,title" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="960" screen_md="770" screen_sm="640" single_text="overlay" single_width="3" single_height="3" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_coloration="bottom_gradient" single_overlay_opacity="50" single_text_visible="yes" single_text_anim="no" single_overlay_visible="yes" single_v_position="bottom" single_reduced="three_quarter" single_padding="2" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" post_matrix="matrix" matrix_amount="3" single_title_uppercase="" single_title_bold="yes" footer_position="left" carousel_rtl="" single_no_background="" order_ids="4237,4231,4239,4233,4262,4245,4252,4243,4254,4247,4241,4629,4229,4636,4225,4193,20518,20520" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsInNpbmdsZV9oZWlnaHQiOiI2In19"][/vc_column][/vc_row]
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
