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

$data[ 'name' ]             = esc_html__( 'Icon Stacked', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Stacked.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_use_pixel="yes" overlay_alpha="50" gutter_size="4" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" zoom_width="0" zoom_height="0" width="1/1" column_width_pixel="600"][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-mobile2" icon_color="accent" background_style="fa-rounded" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" linked_title="yes" no_hover="" title="Medium length display headline" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_icon][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-tools-2" icon_color="accent" background_style="fa-rounded" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" linked_title="yes" no_hover="" title="Medium length display headline" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_icon][vc_icon position="left" title_aligned_icon="yes" icon="fa fa-profile-male" icon_color="accent" background_style="fa-rounded" size="fa-3x" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" add_margin="yes" linked_title="yes" no_hover="" title="Medium length display headline" link="|||"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_icon][/vc_column][/vc_row]
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
