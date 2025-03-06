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

$data[ 'name' ]             = esc_html__( 'Portfolio Classic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Classic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-781286" isotope_mode="packery" loop="size:13|order_by:date|post_type:portfolio" style_preset="metro" filtering="yes" filtering_position="right" filter_all_opposite="yes" filtering_uppercase="yes" filter_scroll="yes" gutter_size="3" post_items="media,title,category,date,text,link,author,sep-one,extra" portfolio_items="media|featured|onpost|original,title,category" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_shape="round" radius="xs" single_overlay_color="accent" single_overlay_opacity="95" single_image_color_anim="yes" single_image_anim="no" single_h_align="center" single_padding="3" single_text_reduced="yes" single_title_transform="capitalize" single_title_dimension="h5" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" post_matrix="matrix" matrix_amount="3" carousel_rtl="" single_title_uppercase="" single_icon="fa fa-plus2" order_ids="4154,4142,4146,4151,4140,4089,4087,4085,4071,4078" matrix_items="eyIxX2kiOnsic2luZ2xlX2hlaWdodCI6IjYifX0="][/vc_column][/vc_row]
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
