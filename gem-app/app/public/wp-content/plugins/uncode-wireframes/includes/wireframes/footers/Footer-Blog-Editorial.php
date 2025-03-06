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

$data[ 'name' ]             = esc_html__( 'Footer Blog Editorial', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Editorial.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="103391" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="4" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="171997"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/6" uncode_shortcode_id="186977"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="128241"]Categories[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="148129"]
<ul>
<li><a href="#">Music</a></li>
<li><a href="#">Lifestyle</a></li>
<li><a href="#">Cinema</a></li>
<li><a href="#">Fashion</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/6" uncode_shortcode_id="147388"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="915627"]Company[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="394530"]
<ul>
<li><a href="#">Our Focus</a></li>
<li><a href="#">About Us</a></li>
<li><a href="#">Partners</a></li>
<li><a href="#">Contact</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/6" uncode_shortcode_id="860995"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="131268"]Press[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="100807"]
<ul>
<li><a href="#">Tutorials</a></li>
<li><a href="#">Magazine</a></li>
<li><a href="#">Documentation</a></li>
<li><a href="#">Resources</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="3" align_mobile="align_left_mobile" mobile_width="4" width="1/6" uncode_shortcode_id="984654"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="112625"]Subscription[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="788445"]
<ul>
<li><a href="#">Pricing</a></li>
<li><a href="#">How it works</a></li>
<li><a href="#">Testimonials</a></li>
<li><a href="#">User cases</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/6" uncode_shortcode_id="189012"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="207161"]Collaborate[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="743353"]
<ul>
<li><a href="#">Work with us</a></li>
<li><a href="#">Properties</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Insights</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="4" width="1/6" uncode_shortcode_id="691335"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="191814"]Locations[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3" uncode_shortcode_id="140781"]
<ul>
<li><a href="#">Milan</a></li>
<li><a href="#">Amsterdam</a></li>
<li><a href="#">London</a></li>
<li><a href="#">Paris</a></li>
</ul>
<p>[/uncode_list][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-prif"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/12"][vc_custom_heading heading_semantic="h4"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="438629"]Newsletter[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12"][vc_column_text]Get a sneak preview of our latest news…[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="6/12"][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="default-background"][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-prif"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="156536"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="103672"][uncode_copyright text_lead="small"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="216297"][uncode_socials][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
