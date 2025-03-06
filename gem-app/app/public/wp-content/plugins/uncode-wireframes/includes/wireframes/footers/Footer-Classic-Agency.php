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

$data[ 'name' ]             = esc_html__( 'Footer Classic Agency', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Agency.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="6" bottom_padding="6" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="418406" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/1" uncode_shortcode_id="185335"][vc_single_image media="'. uncode_wf_print_single_image( '85259' ) .'" media_width_use_pixel="yes" media_width_pixel="68" uncode_shortcode_id="325925"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="8/12" uncode_shortcode_id="156279"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/3" uncode_shortcode_id="885123"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="467553"]Navigate[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" uncode_shortcode_id="176336"]
<ul>
<li><a href="#">Home</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Portfolio</a></li>
<li><a href="#">Latest</a></li>
<li><a href="#">Contact</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/3" uncode_shortcode_id="371595"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="516741"]Lets talk[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" uncode_shortcode_id="161668"]
<ul>
<li><a href="#">Business</a></li>
<li><a href="#">General</a></li>
<li><a href="#">Support</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" align_mobile="align_left_mobile" mobile_width="7" width="1/3" uncode_shortcode_id="974403"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="208323"]Networks[/vc_custom_heading][uncode_socials][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
