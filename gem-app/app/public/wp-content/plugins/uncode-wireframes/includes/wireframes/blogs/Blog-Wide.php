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

$data[ 'name' ]             = esc_html__( 'Blog Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" uncode_shortcode_id="724432" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_horizontal="left" gutter_size="3" style="dark" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" zoom_width="0" zoom_height="0" width="1/1" uncode_shortcode_id="514445"][uncode_index el_id="index-1" loop="size:16|order_by:date|order:ASC|post_type:post|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" gutter_size="0" post_items="media|featured|onpost|poster,date,title" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="800" screen_md="800" screen_sm="800" single_text="overlay" single_fluid_height="45" single_overlay_color="color-jevc" single_overlay_coloration="bottom_gradient" single_overlay_opacity="100" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_v_position="bottom" single_reduced="half" single_reduced_mobile="yes" single_padding="3" single_elements_click="yes" single_title_dimension="h5" single_border="yes" single_css_animation="right-t-left" single_animation_speed="1000" single_animation_delay="200" post_matrix="matrix" matrix_amount="4" single_text_inline="yes" filtering_menu="inline" single_text_hover="yes" single_block_click="yes" single_title_serif="" single_title_divider="yes" single_no_background="" single_title_bold="yes" single_half_padding="" footer_position="left" carousel_rtl="" order_ids="4193,4231,4247,4252,4225" matrix_items="eyIwX2kiOnsic2luZ2xlX2ZsdWlkX2hlaWdodCI6Ijg1Iiwic2luZ2xlX3dpZHRoIjoiMTIifX0=" uncode_shortcode_id="133610"][/vc_column][/vc_row]
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
