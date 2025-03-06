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

$data[ 'name' ]             = esc_html__( 'Content Toggle Big Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Toggle-Big-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" bottom_divider="mountains" uncode_shortcode_id="168251" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" toggle="yes" max_height="50vh" closed_txt="Read More" btn_margin="std" open_txt="Close Story" icon_open="fa fa-cross" fade="sm" btn_align="left" toggle_scroll="yes" width="1/1" uncode_shortcode_id="149566" toggle_classes="custom-link h4 btn-underline-out btn-custom-typo font-787672 font-weight-800 text-initial fontspace-781688"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="663086" heading_custom_size="clamp(30px,16vw,85px)"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="div" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="129951" heading_custom_size="clamp(20px,4vw,40px)"]Since its inception in 2016, The Malmö Design Conference has emerged as a leading conference dedicated to the expansive realm of design. The conference was born from a shared vision: to propel creative professionals to new heights and foster a dynamic design community. Over the past few years, The Malmö Design Conference has evolved into a multi-day event, featuring keynote sessions, workshops, panel discussions, exhibitions, and more, all held in unique and inspiring venues. The design spectrum has broadened significantly, encompassing not only the foundational design principles but also exploring avant-garde concepts and emerging trends in the field.[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="828906" heading_custom_size="clamp(20px,4vw,40px)"]Speakers &amp; Ambassadors[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="996403" heading_custom_size="clamp(20px,4vw,40px)"]Adam Thompson / Bella Mitchell / Cameron Evans / Dana Rodriguez / Ethan Lee / Fiona Johnson / Gabriel Carter / Hailey King / Isaac Anderson / Jasmine Garcia / Keith Wright / Lily Moore / Mason Martinez / Natalie Bennett / Oliver Hayes / Penelope Mitchell / Quentin Turner / Rachel Foster / Samuel Turner / Isabella Davis / Xavier Taylor / Zoe Jenkins / Noah Anderson / Mia Wright / Benjamin Garcia / Ava Mitchell / Elijah Davis / Sophia Thompson / Jackson King / Emma Rodriguez / Lucas Bennett / Aria Martinez / Daniel Evans / Olivia Hayes / Matthew Johnson / Chloe Carter / Ethan Wright / Grace Mitchell / Christopher Davis / Lily Foster / Samuel Thompson / Ella King / Daniel Rodriguez / Mia Hayes / Oliver Mitchell / Sophia Evans / James Wright / Scarlett Anderson / Sebastian Foster / Abigail Turner / Liam Bennett / Zoey King / Caleb Martinez / Victoria Davis / Wyatt Thompson / Harper Mitchell / David Rodriguez / Ava Wright / Elijah Hayes / Mia Foster / Oliver King / Emily Anderson / Noah Foster / Amelia Carter / Benjamin Thompson / Sophia Wright / Ethan King / Olivia Rodriguez / Jackson Foster / Emma Turner / Caleb Hayes / Zoe Mitchell / Daniel Bennett / Mia Foster / Elijah Rodriguez / Ava King / Isaac Hayes / Lily Foster / Aiden Thompson / Emily Wright / Jacob Mitchell / Grace Turner / Christopher Hayes / Scarlett Carter / Samuel Rodriguez / Mia King / Lucas Bennett / Zoe Foster / Oliver Thompson / Sophia Wright / Caleb Mitchell / Emma Turner / Benjamin Hayes / Isabella King / Noah Foster / Ava Rodriguez / Mia Carter / Ethan Hayes / Lily Foster / Samuel Thompson / Emily Wright[/vc_custom_heading][/vc_column][/vc_row]
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
