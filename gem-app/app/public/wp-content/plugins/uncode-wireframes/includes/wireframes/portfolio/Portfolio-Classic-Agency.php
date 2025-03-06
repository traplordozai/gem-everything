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

$data[ 'name' ]             = esc_html__( 'Portfolio Classic Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Classic-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="0" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="100" gutter_size="4" medium_width="0" shift_x="0" shift_y="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-1" loop="size:6|order_by:date|post_type:portfolio" index_back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" filtering="yes" filtering_position="center" filtering_uppercase="yes" filter_mobile="yes" gutter_size="0" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="media|featured|onpost|poster,title" screen_lg="1000" screen_md="800" screen_sm="600" single_text="overlay" images_size="four-three" single_overlay_color="accent" single_overlay_opacity="85" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h4" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="600" single_animation_delay="200" custom_order="yes" filtering_transform="uppercase" carousel_rtl="" filtering_menu="dropdown" single_block_click="yes" single_text_hover="yes" single_no_background="" single_title_serif="" single_title_divider="" single_half_padding="" single_title_bold="yes" footer_position="left" items="e30=" single_icon="fa fa-cog"][/vc_column][/vc_row]
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
