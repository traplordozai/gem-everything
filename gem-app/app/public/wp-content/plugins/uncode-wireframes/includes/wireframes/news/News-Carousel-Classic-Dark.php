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

$data[ 'name' ]             = esc_html__( 'News Carousel Classic Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Carousel-Classic-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="gradient" style="inherited"][vc_column column_width_percent="100" align_horizontal="align_center" overlay_alpha="100" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" css_animation="alpha-anim" zoom_width="0" zoom_height="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="100" gutter_size="3" shift_y="0"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" style="dark" gutter_size="3" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" mobile_width_full="" width="1/1" column_width_pixel="600"][vc_custom_heading text_transform="capitalize" sub_lead="yes" sub_reduced="yes" text_align="text-center" text_serif="" subheading="Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more."]Short headline[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="100" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="100" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" mobile_width_full="" width="1/1"][uncode_index el_id="index-975704645" index_type="carousel" loop="size:9|order_by:date|order:DESC|post_type:post" carousel_lg="3" carousel_md="2" carousel_sm="1" gutter_size="2" post_items="title,text|excerpt|120,sep-one|full,author|md_size|display_qualification" carousel_height="equal" carousel_interval="0" carousel_navspeed="400" carousel_dots="yes" carousel_dots_mobile="yes" carousel_autoh="yes" stage_padding="0" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_shape="round" single_overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" single_overlay_opacity="50" single_h_align_mobile="center" single_padding="3" single_title_transform="capitalize" single_title_dimension="h4" single_title_height="fontheight-357766" single_border="yes" single_css_animation="zoom-in" single_animation_delay="200" custom_order="yes" footer_position="left" single_no_background="yes" title="News" single_icon="fa fa-plus2" order_ids="4252,4247,4193,4231,20518,4233"][/vc_column_inner][/vc_row_inner][vc_button button_color="accent" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row]
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
