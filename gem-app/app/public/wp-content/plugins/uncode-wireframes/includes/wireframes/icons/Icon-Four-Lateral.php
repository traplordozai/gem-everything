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

$data[ 'name' ]             = esc_html__( 'Icon Four Lateral', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Four-Lateral.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="4" bottom_padding="4" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="407020" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="115711"][vc_icon position="left" icon="fa fa-gift2" size="fa-2x"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'"  add_margin="yes" title="Gift Vouchers" uncode_shortcode_id="301250"]Lorem ipsum dolor sit amet, id pericula appe llantur eam, mea.[/vc_icon][/vc_column][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="779484"][vc_icon position="left" icon="fa fa-profile-female" size="fa-2x"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'"  add_margin="yes" title="Member Discounts" uncode_shortcode_id="788249"]Lorem ipsum dolor sit amet, id pericula appe llantur eam, mea.[/vc_icon][/vc_column][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="715032"][vc_icon position="left" icon="fa fa-bike" size="fa-2x"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'"  add_margin="yes" title="Free Delivery" uncode_shortcode_id="177274"]Lorem ipsum dolor sit amet, id pericula appe llantur eam, mea.[/vc_icon][/vc_column][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/4" uncode_shortcode_id="239731"][vc_icon position="left" icon="fa fa-mobile2" size="fa-2x"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" title="Track Shipping" uncode_shortcode_id="710547"]Lorem ipsum dolor sit amet, id pericula appe llantur eam, mea.[/vc_icon][/vc_column][/vc_row]
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
