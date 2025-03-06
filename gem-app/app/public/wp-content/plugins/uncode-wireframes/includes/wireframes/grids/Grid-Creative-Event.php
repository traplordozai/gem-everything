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

$data[ 'name' ]             = esc_html__( 'Grid Creative Event', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Creative-Event.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="1" top_padding="1" bottom_padding="1" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="1" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="109476" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="153078"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="132208"][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="558759" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" uncode_shortcode_id="392653" media_width_pixel="80"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="835145"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="208713"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button size="btn-lg" border_width="0" scale_mobile="no" uncode_shortcode_id="614980"]Click the button[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="194138" back_color_type="uncode-palette" mobile_height="50vh"][uncode_counter value="22" counter_color="" size="custom" weight="600" height="fontheight-161249" uncode_shortcode_id="523534" heading_custom_size="clamp(55px,8vw,125px)"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_weight="800" uncode_shortcode_id="208359"]Workshops[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="185318"][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="281881" back_color_type="uncode-palette" mobile_height="50vh"][vc_icon icon="fa fa-play" background_style="fa-rounded" size="fa-3x" icon_automatic="yes" shadow="yes" media_lightbox="'. uncode_wf_print_single_image( '88180' ) .'" uncode_shortcode_id="231167"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="105180" back_color_type="uncode-palette"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_use_pixel="yes" uncode_shortcode_id="892500" media_width_pixel="80"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="897316"]Medium length headline[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="208713"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings and more.[/vc_custom_heading][vc_empty_space empty_h="1"][vc_button size="btn-lg" border_width="0" scale_mobile="no" uncode_shortcode_id="614980"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="2" back_image="'. uncode_wf_print_single_image( '84889' ) .'" back_position="center bottom" overlay_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="hg" width="1/2" uncode_shortcode_id="158033" overlay_color_type="uncode-palette" mobile_height="50vh"][/vc_column][/vc_row]
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
