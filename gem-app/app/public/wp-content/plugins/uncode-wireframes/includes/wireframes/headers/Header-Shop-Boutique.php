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

$data[ 'name' ]             = esc_html__( 'Header Shop Boutique', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'headers' ];
$data[ 'custom_class' ]     = 'headers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'headers/Header-Shop-Boutique.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" medium_visibility="yes" mobile_visibility="yes" shift_y="0" z_index="0"][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="5" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" kburns="zoom" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2" link_to="url:http%3A%2F%2Fthemeforest.net%2Fitem%2Funcode-creative-multiuse-wordpress-theme%2F13373220%3Futm_source%3Dundsgncta%26ref%3Dundsgn%26license%3Dregular%26open_purchase_for_item_id%3D13373220%26purchasable%3Dsource||target:%20_blank|"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_speed="1000" animation_delay="200"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_weight="400" css_animation="curtain" animation_speed="1000" animation_delay="400" interval_animation="200"]Long headline to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button border_width="0" css_animation="alpha-anim" animation_delay="600" link="url:%23|||"]Click the button[/vc_button][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" override_padding="yes" column_padding="5" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" kburns="zoom" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="49" gutter_size="2" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/2" link_to="url:http%3A%2F%2Fthemeforest.net%2Fitem%2Funcode-creative-multiuse-wordpress-theme%2F13373220%3Futm_source%3Dundsgncta%26ref%3Dundsgn%26license%3Dregular%26open_purchase_for_item_id%3D13373220%26purchasable%3Dsource||target:%20_blank|"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_speed="1000" animation_delay="200"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_weight="400" css_animation="curtain" animation_speed="1000" animation_delay="400" interval_animation="200"]Long headline to turn your visitors into users[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button border_width="0" css_animation="alpha-anim" animation_delay="600" link="url:%23|||"]Click the button[/vc_button][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="100" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" desktop_visibility="yes" shift_y="0" z_index="0" shape_dividers=""][vc_column width="1/1"][uncode_slider slider_interval="0" slider_navspeed="400" slider_loop="yes"][vc_row_inner row_inner_height_percent="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" shape_dividers=""][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_speed="1000"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_weight="400" css_animation="curtain" animation_speed="1000" animation_delay="200"]Long headline to turn your visitors into users[/vc_custom_heading][vc_button border_width="0" css_animation="alpha-anim" animation_delay="600" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" shape_dividers=""][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" style="dark" gutter_size="2" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" css_animation="curtain" animation_speed="1000"]Short headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" text_weight="400" css_animation="curtain" animation_speed="1000" animation_delay="200"]Long headline to turn your visitors into users[/vc_custom_heading][vc_button border_width="0" css_animation="alpha-anim" animation_delay="600" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/uncode_slider][/vc_column][/vc_row]
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
