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

$data[ 'name' ]             = esc_html__( 'Footer Shop Cosmetic', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Cosmetic.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="415112" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="1" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="387615"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="131583"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="3" style="dark"  back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="105815" back_color_type="uncode-palette" column_width_pixel="600"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="963669"]Medium length headline[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="146042" el_class="skin-links"]<a href="#">Twitter</a> · <a href="#">Facebook</a> · <a href="#">Instagram</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="131583"][vc_column_inner column_width_use_pixel="yes" position_horizontal="right" gutter_size="2" override_padding="yes" column_padding="5" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="120736" back_color_type="uncode-palette" column_width_pixel="550"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="903617"]Useful Links[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="519253" el_class="skin-links"]<a href="#">Products Collection</a><br />
<a href="#">Ingredients</a><br />
<a href="#">Brand Philosophy</a><br />
<a href="#">Environment Care</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_use_pixel="yes" position_horizontal="left" align_horizontal="align_right" gutter_size="2" override_padding="yes" column_padding="5" style="dark" back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="645261" back_color_type="uncode-palette" column_width_pixel="550"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="194909"]Contact[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="814380" el_class="skin-links"]Dronningens Gate 19<br />
6004 Oslo, Norway<br />
<a href="#">+789 123 456 345</a><br />
<a href="#">email@example.com</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="131583"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" style="dark"  back_color="accent" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="151209" back_color_type="uncode-palette" column_width_pixel="600"][uncode_copyright][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
