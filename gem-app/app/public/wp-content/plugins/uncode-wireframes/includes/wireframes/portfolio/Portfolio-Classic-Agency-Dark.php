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

$data[ 'name' ]             = esc_html__( 'Portfolio Classic Agency Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Classic-Agency-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="0" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="dark" shape_dividers=""][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][uncode_index el_id="index-1" loop="size:6|order_by:date|order:DESC|post_type:portfolio" index_back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" filtering="yes" filter_style="dark" filtering_position="center" filtering_uppercase="yes" filter_mobile="yes" gutter_size="0" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="media|featured|onpost|original,title,category|nobg|relative|display-icon" screen_lg="1000" screen_md="600" screen_sm="600" single_text="overlay" images_size="four-three" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_image_anim_move="yes" single_h_align="center" single_reduced="three_quarter" single_reduced_mobile="yes" single_h_position="center" single_padding="2" single_text_reduced="yes" single_title_dimension="h4" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" filtering_menu="inline" single_block_click="yes" single_text_hover="yes" single_no_background="" single_title_uppercase="" single_title_serif="" single_title_divider="" single_title_bold="" single_half_padding="" footer_position="left" carousel_rtl="" filtering_transform="" single_icon="fa fa-plus2"][/vc_column][/vc_row]]
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
