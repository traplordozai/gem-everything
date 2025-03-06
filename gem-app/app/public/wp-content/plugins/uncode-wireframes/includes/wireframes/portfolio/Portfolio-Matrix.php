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

$data[ 'name' ]             = esc_html__( 'Portfolio Matrix', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Matrix.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" gutter_size="3" overlay_alpha="100" shift_x="0" shift_y="0" medium_width="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-1" isotope_mode="packery" loop="size:16|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="0" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media,text,category" portfolio_items="media|featured|onpost|original" screen_lg="1200" screen_md="900" screen_sm="480" single_text="overlay" single_width="3" images_size="three-four" single_overlay_opacity="20" single_h_align="center" single_padding="1" single_text_reduced="yes" single_title_dimension="h6" single_border="yes" single_css_animation="zoom-in" post_matrix="matrix" matrix_amount="8" filtering_menu="inline" single_block_click="yes" single_text_hover="yes" single_no_background="yes" single_half_padding="yes" single_title_bold="yes" footer_position="left" filtering_transform="uppercase" order_ids="2489,4063,4065,4069,4067,4078,4071,4081,4085,4089,4087,4142,4140,4146,4151,4154" matrix_items="eyIwX2kiOnsiaW1hZ2VzX3NpemUiOiJvbmUtb25lIn0sIjJfaSI6eyJpbWFnZXNfc2l6ZSI6Im9uZS1vbmUifSwiNl9pIjp7ImltYWdlc19zaXplIjoib25lLW9uZSJ9LCI3X2kiOnsiaW1hZ2VzX3NpemUiOiJvbmUtb25lIn19" uncode_shortcode_id="117142"][/vc_column][/vc_row]
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
