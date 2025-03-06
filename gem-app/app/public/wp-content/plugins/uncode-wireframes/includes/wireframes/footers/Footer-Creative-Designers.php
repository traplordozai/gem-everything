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

$data[ 'name' ]             = esc_html__( 'Footer Creative Designers', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Designers.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="159249" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="158557"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="202082"][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="779279"][vc_empty_space empty_h="0"][vc_single_image media="'. uncode_wf_print_single_image( '85259' ) .'" media_width_use_pixel="yes" media_width_pixel="74" uncode_shortcode_id="132680"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="147239"]You have come this far...<br />
Lets have a chat![/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/4" uncode_shortcode_id="271582"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="400161"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="124288" text_color_type="uncode-palette"]Navigate[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" uncode_shortcode_id="819974"]
<ul>
<li><a href="#">Work</a></li>
<li><a href="#">Studio</a></li>
<li><a href="#">What we do</a></li>
<li><a href="#">Journal</a></li>
<li><a href="#">Contact</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="976329"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="174497" text_color_type="uncode-palette"]Talk[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" uncode_shortcode_id="142153"]
<ul>
<li><a href="#">General</a></li>
<li><a href="#">Marketing</a></li>
<li><a href="#">Get a quote</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="694698"][vc_custom_heading text_color="color-wvjs" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="657462" text_color_type="uncode-palette"]Social[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" uncode_shortcode_id="129683"]
<ul>
<li><a href="#">Instagram</a></li>
<li><a href="#">Dribbble</a></li>
</ul>
[/uncode_list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
