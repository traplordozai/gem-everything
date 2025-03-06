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

$data[ 'name' ]             = esc_html__( 'Counter Corporation', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'counters' ];
$data[ 'custom_class' ]     = 'counters';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'counters/Counter-Corporation.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="color-wayh" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/3" uncode_shortcode_id="230789"][uncode_counter value="14" counter_color="accent" size="fontsize-338686" weight="600" height="fontheight-161249" suffix="M" uncode_shortcode_id="180367" counter_color_type="uncode-palette"][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Maximum gain profit under controlled management[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-circle-check" icon_color="accent" uncode_shortcode_id="260016" icon_color_type="uncode-palette"]
<ul>
<li>Surveying</li>
<li>Deep foundations</li>
<li>Formwork and concreting</li>
<li>Grout injection</li>
<li>Suspended scaffolding</li>
</ul>
<p>[/uncode_list][/vc_column][vc_column column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/3" uncode_shortcode_id="787905"][uncode_counter value="120" counter_color="accent" size="fontsize-338686" weight="600" height="fontheight-161249" suffix="%" uncode_shortcode_id="188697" counter_color_type="uncode-palette"][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Increase in turnover every six months organically[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-circle-check" icon_color="accent" uncode_shortcode_id="260016" icon_color_type="uncode-palette"]
<ul>
<li>Surveying</li>
<li>Deep foundations</li>
<li>Formwork and concreting</li>
<li>Grout injection</li>
<li>Suspended scaffolding</li>
</ul>
<p>[/uncode_list][/vc_column][vc_column column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="1/3" uncode_shortcode_id="166889"][uncode_counter value="1150" counter_color="accent" size="fontsize-338686" weight="600" height="fontheight-161249" suffix="K" uncode_shortcode_id="165611" counter_color_type="uncode-palette"][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Our valuable rate for your financial conversion[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-circle-check" icon_color="accent" uncode_shortcode_id="260016" icon_color_type="uncode-palette"]
<ul>
<li>Surveying</li>
<li>Deep foundations</li>
<li>Formwork and concreting</li>
<li>Grout injection</li>
<li>Suspended scaffolding</li>
</ul>
<p>[/uncode_list][/vc_column][/vc_row]
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
