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

$data[ 'name' ]             = esc_html__( 'Portfolio Digital Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Digital-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" el_class="portfolio-row"][vc_column column_width_percent="70" align_horizontal="align_center" override_padding="yes" column_padding="0" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="100" align_horizontal="align_center" override_padding="yes" column_padding="3" style="dark" gutter_size="3" back_color="accent" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="bottom-t-top" animation_delay="200" shadow="std" radius="std" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Short headline[/vc_custom_heading][vc_empty_space empty_h="1"][uncode_index el_id="index-9876545789" index_type="carousel" loop="size:6|order_by:date|post_type:portfolio" carousel_lg="1" carousel_md="1" carousel_sm="1" thumb_size="three-four" gutter_size="3" inner_padding="yes" post_items="title,media,text,link,author,date,category,extra" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="media|featured|onpost|poster,title" carousel_interval="5000" carousel_navspeed="400" carousel_loop="yes" carousel_overflow="yes" carousel_dots="yes" carousel_dots_space="yes" carousel_dots_mobile="yes" stage_padding="65" single_text="overlay" single_overlay_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="95" single_image_anim="no" single_h_align="center" single_padding="3" single_title_dimension="h2" single_shadow="yes" shadow_weight="xl" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" no_double_tap="yes" filtering_transform="uppercase" carousel_rtl="" filtering_menu="dropdown" single_block_click="yes" single_text_hover="yes" single_no_background="" single_title_serif="" single_title_divider="" single_half_padding="" single_title_bold="yes" footer_position="left" items="e30=" order_ids="4078,4065,4081,4146,4069,4142,4140,4085,4071" single_icon="fa fa-plus2"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_button button_color="accent" size="" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
