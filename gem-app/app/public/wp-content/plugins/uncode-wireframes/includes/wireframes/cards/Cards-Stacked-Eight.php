<?php
/**
 * name             - Wireframe title
 * cat_name         - Comma separated list for multiple categories (cat display name)
 * custom_class     - Space separated list for multiple categories (cat ID)
 * dependency       - Array of dependencies
 * is_content_block - (optional) Best in a content block
 *
 * @version  1.0.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wireframe_categories = UNCDWF_Dynamic::get_wireframe_categories();
$data                 = array();

// Wireframe properties

$data[ 'name' ]             = esc_html__( 'Cards Stacked Eight', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'cards' ];
$data[ 'custom_class' ]     = 'cards';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'cards/Cards-Stacked-Eight.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="step" css_animation="inner-rows" animation_state="end" animation_origin="center" animation_scale_val="35" animation_scale_step="yes" animation_opacity="100" animation_x="0" animation_y="0" animation_blur="0" animation_rotate="0" animation_perspective="0" animation_start_point="center" animation_inner_space="10" content_parallax="0" animation_bottom_space="0" animation_last="yes" uncode_shortcode_id="120179" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="6" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="109526"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="1" uncode_shortcode_id="506338" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/1" uncode_shortcode_id="140698"][uncode_index el_id="index-87982103" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="200" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_color="color-jevc" single_overlay_opacity="15" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" no_double_tap="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="151839" heading_custom_size="clamp(25px,10vw,150px)" custom_tooltip="View" tooltip_class="h6"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" uncode_shortcode_id="610029" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="793672"][uncode_index el_id="index-8798210366" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="200" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_color="color-jevc" single_overlay_opacity="15" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" no_double_tap="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="341430" heading_custom_size="clamp(25px,10vw,150px)" custom_tooltip="View" tooltip_class="h6" offset="1"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" uncode_shortcode_id="204485" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="202306"][uncode_index el_id="index-8798210329" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="200" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_color="color-jevc" single_overlay_opacity="15" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" no_double_tap="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="655978" heading_custom_size="clamp(25px,10vw,150px)" custom_tooltip="View" tooltip_class="h6" offset="2"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="2" uncode_shortcode_id="746146" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="585693"][uncode_index el_id="index-8798210380" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="200" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_color="color-jevc" single_overlay_opacity="15" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" no_double_tap="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="953987" heading_custom_size="clamp(25px,10vw,150px)" custom_tooltip="View" tooltip_class="h6" offset="3"][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="4" uncode_shortcode_id="766270" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="161948"][uncode_index el_id="index-879821035" loop="size:1|order_by:date|post_type:portfolio|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="1000" screen_md="1000" screen_sm="200" gutter_size="0" single_text="overlay" single_width="12" single_fluid_height="100" single_shape="round" radius="hg" single_overlay_color="color-jevc" single_overlay_opacity="15" single_overlay_visible="yes" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="custom" single_title_scale_mobile="no" single_border="yes" no_double_tap="yes" custom_cursor="blur" cursor_title="yes" hide_title_tooltip="always" uncode_shortcode_id="165128" heading_custom_size="clamp(25px,10vw,150px)" custom_tooltip="View" tooltip_class="h6" offset="4"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
