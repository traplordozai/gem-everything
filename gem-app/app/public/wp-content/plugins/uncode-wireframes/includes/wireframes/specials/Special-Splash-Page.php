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

$data[ 'name' ]             = esc_html__( 'Special Splash Page', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'specials' ];
$data[ 'custom_class' ]     = 'specials';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'specials/Special-Splash-Page.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '80472' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" position_vertical="bottom" override_padding="yes" column_padding="4" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-160000' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-135905' ) .'" text_transform="uppercase"]Tagline[/vc_custom_heading][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'"]Long headline on
two lines of text to turn
your visitors into users[/vc_custom_heading][vc_empty_space empty_h="5" medium_visibility="yes" mobile_visibility="yes"][vc_button button_color="accent" size="" text_skin="yes" border_width="0" link="url:%23|||"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][vc_separator][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0"][vc_column_inner column_width_percent="100" position_vertical="middle" style="dark" gutter_size="3" overlay_alpha="50" medium_width="4" shift_x="0" shift_y="0" z_index="0" width="1/2"][vc_button size="link" btn_link_size="h2" border_width="0" display="inline" link="url:mailto%3Ainfo%40yoursite.com|||"]— Get in touch[/vc_button][vc_button size="link" btn_link_size="h2" border_width="0" display="inline" link="url:tel%3A%2F%2F1-555-555-5555|||"]— Tel +1 (320) 786-5435[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" style="dark" gutter_size="3" overlay_alpha="50" medium_width="4" align_mobile="align_left_mobile" shift_x="0" shift_y="0" z_index="0" width="1/2"][vc_icon display="inline" icon="fa fa-social-dribbble" size="fa-2x" link="url:https%3A%2F%2Fdribbble.com||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-social-twitter" size="fa-2x" link="url:https%3A%2F%2Ftwitter.com||target:%20_blank"][/vc_icon][vc_icon display="inline" icon="fa fa-social-facebook" size="fa-2x" link="url:https%3A%2F%2Fwww.facebook.com||target:%20_blank"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
