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

$data[ 'name' ]             = esc_html__( 'Popup Creative Bistrot', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'popups' ];
$data[ 'custom_class' ]     = 'popups';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'popups/Popup-Creative-Bistrot.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="1" uncode_shortcode_id="134530" el_class="pp-odd pp-large"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="std" width="1/1" uncode_shortcode_id="614543" el_class="overflow-hidden-uncell"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" shift_y="0" z_index="0" uncode_shortcode_id="654227" limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="276296" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" badge_style="yes" back_color="accent" uncode_shortcode_id="107550" heading_custom_size="clamp(25px,6vw,40px)" el_class="rotate-minus-beta" back_color_type="uncode-palette"]Medium[/vc_custom_heading][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" badge_style="yes" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" uncode_shortcode_id="611551" text_color_type="uncode-palette" heading_custom_size="clamp(25px,6vw,50px)" el_class="rotate-minus-beta" back_color_type="uncode-palette"]Length[/vc_custom_heading][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" badge_style="yes" back_color="accent" uncode_shortcode_id="809153" heading_custom_size="clamp(25px,6vw,40px)" el_class="rotate-minus-beta" back_color_type="uncode-palette"]Headline[/vc_custom_heading][vc_empty_space empty_h="3" mobile_visibility="yes"][vc_column_text text_lead="yes" uncode_shortcode_id="153889"]Change the color to match your brand or vision, add your logo, choose the perfect layout.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="197317"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" uncode_shortcode_id="190439"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
