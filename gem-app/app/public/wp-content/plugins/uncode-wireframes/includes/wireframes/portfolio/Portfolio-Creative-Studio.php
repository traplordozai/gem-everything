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

$data[ 'name' ]             = esc_html__( 'Portfolio Creative Studio', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Creative-Studio.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-73887442535635" loop="size:5|order_by:date|post_type:portfolio" style_preset="metro" index_back_color="color-rgdb" gutter_size="0" post_items="icon,title,text|excerpt|76,author" portfolio_items="title,media|featured|onpost|original,category" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="3" single_height="3" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_color="accent" single_overlay_opacity="80" single_image_color_anim="yes" single_image_anim_move="yes" single_h_align="center" single_padding="2" single_title_dimension="h2" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" post_matrix="matrix" footer_position="left" carousel_rtl="" single_title_serif="" single_no_background="" order_ids="4089,4087,4146,4142,4140" single_icon="fa fa-plus2" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsInNpbmdsZV9oZWlnaHQiOiI2Iiwic2luZ2xlX2ZsdWlkX2hlaWdodCI6IjkwIn19"][/vc_column][/vc_row]
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
