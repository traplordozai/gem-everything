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

$data[ 'name' ]             = esc_html__( 'Shop Titles Categories', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop' ];
$data[ 'custom_class' ]     = 'shop';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop/Shop-Titles-Categories.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="214637" back_color_type="uncode-palette" css=".vc_custom_1708536999722{border-top-width: 1px !important;padding-right: 18px !important;padding-left: 18px !important;}" border_color_type="uncode-palette"][vc_column column_width_use_pixel="yes" position_vertical="middle" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="5" style="dark" back_color="accent" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="15" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/1" uncode_shortcode_id="168584" back_color_type="uncode-palette" el_class="overflow-hidden" overlay_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" limit_content="" uncode_shortcode_id="100738"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="952210"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="168463" heading_custom_size="clamp(30px, 4vw, 50px)"]Heading[/vc_custom_heading][/vc_column_inner][/vc_row_inner][uncode_index el_id="index-938365" index_type="titles" loop="size:12|order_by:date|post_type:product|taxonomy_query:product_cat|taxonomy_count:10" titles_display="inline" gutter_size="3" drop_h_space="lg" drop_image_separator="dot" drop_image_position="column" drop_image_time="400" drop_image_hover="opacity-inverted" drop_image_extra="yes" drop_image_extra_type="count" drop_image_extra_size="50" single_style="dark" single_title_dimension="custom" single_css_animation="alpha-anim" single_animation_speed="1000" titles_gap_reduced_mobile="yes" titles_hide_meta_mobile="yes" titles_hide_separator_mobile="yes" textual_display="inline" drop_title_hover="outlined-inverted" drop_image_index="yes" uncode_shortcode_id="102434" heading_custom_size="clamp(25px, 3vw, 60px)"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" limit_content="" uncode_shortcode_id="100738"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="182482" el_class="skin-links"][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-in" uncode_shortcode_id="140331"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
