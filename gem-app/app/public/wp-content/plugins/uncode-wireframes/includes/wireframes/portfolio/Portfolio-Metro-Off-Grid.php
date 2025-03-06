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

$data[ 'name' ]             = esc_html__( 'Portfolio Metro Off-Grid', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Metro-Off-Grid.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited" shape_dividers=""][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-12" loop="size:12|order_by:date|order:DESC|post_type:portfolio" style_preset="metro" gutter_size="2" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="media|featured|onpost|poster,icon" off_grid="yes" off_grid_element="custom" off_grid_custom="1,2" off_grid_val="7" screen_lg="960" screen_md="800" screen_sm="100" single_text="overlay" single_width="3" single_height="3" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_image_anim_move="yes" single_h_align="center" single_reduced="three_quarter" single_h_position="center" single_padding="3" single_text_reduced="yes" single_title_dimension="h3" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="400" post_matrix="matrix" matrix_amount="3" single_image_anim_border="yes" filtering_transform="uppercase" carousel_rtl="" single_title_uppercase="" filtering_menu="inline" single_block_click="yes" single_text_hover="yes" single_title_bold="yes" footer_position="left" order_ids="4146,4081,4142,4078,4140,4089,4087,4085,4151,4069,4071,4154" single_icon="fa fa-plus2" matrix_items="eyIwX2kiOnsic2luZ2xlX3dpZHRoIjoiNiIsInNpbmdsZV9oZWlnaHQiOiI2In19"][/vc_column][/vc_row]
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
