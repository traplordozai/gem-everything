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

$data[ 'name' ]             = esc_html__( 'Footer Classic Medical', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Medical.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="2" enable_top_divider="default" top_divider="step" shape_top_h_use_pixel="true" shape_top_height_percent="50" shape_top_opacity="100" shape_top_index="0" uncode_shortcode_id="160890" back_color_type="uncode-palette" css=".vc_custom_1715610464425{padding-bottom: 18px !important;}" column_width_pixel="1512"][vc_column column_width_percent="100" gutter_size="2" override_padding="yes" column_padding="3" style="dark" back_color="accent" back_image="'. uncode_wf_print_single_image( '97923' ) .'" back_position="right top" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="155262" back_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="139325"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="185094"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="173184"]“Long headline to turn your visitors into users”[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="390374"][vc_button size="btn-lg" border_width="0" scale_mobile="no" uncode_shortcode_id="144728"]Click the button[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="51" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="103161" back_color_type="uncode-palette" el_class="footer"][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="873329"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="290969"][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="1/1" uncode_shortcode_id="810425"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="372391"]Medium length headline[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="no-labels-default"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="7/12"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="290969"][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/3" uncode_shortcode_id="112510"][vc_empty_space empty_h="1"][vc_icon icon="fa fa-facebook-square" size="fa-2x" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" linked_title="yes" uncode_shortcode_id="165722" title="Facebook" link="url:%23|target:_blank"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/3" uncode_shortcode_id="635650"][vc_empty_space empty_h="1"][vc_icon icon="fa fa-twitter" size="fa-2x" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="501514" title="Twitter" link="url:%23|target:_blank"][/vc_icon][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/3" uncode_shortcode_id="307944"][vc_empty_space empty_h="1"][vc_icon icon="fa fa-instagram" size="fa-2x" heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-179065' ) .'" uncode_shortcode_id="680636" title="Instagram" link="url:%23|target:_blank"][/vc_icon][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="51" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="626853" back_color_type="uncode-palette" el_class="footer"][vc_column column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="204006"][vc_separator sep_color="" uncode_shortcode_id="479273"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="3" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="51" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="551220" back_color_type="uncode-palette" el_class="footer"][vc_column column_width_percent="100" gutter_size="2" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="4/12" uncode_shortcode_id="873329"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="207258"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="111579"][vc_custom_heading heading_semantic="h4" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="104374"]Contact[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="141319" el_class="footer-links"]<a href="#">9372 Richmond Road
London, NW85 4LO</a>
<a href="mailto:info@yoursite.com">info@yoursite.com</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="7/12"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="290969"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="1/3" uncode_shortcode_id="199675"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="102225"]Doctors[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="190834" el_class="footer-links"]<a href="#">Jonathan Elliott</a>
<a href="#">Morgan Gill</a>
<a href="#">Bobby Patel</a>
<a href="#">Courtney Mitchell</a>
<a href="#">Jordan Parker</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="3" width="1/3" uncode_shortcode_id="903492"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="755384"]Services[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="145406" el_class="footer-links"]<a href="#">Cardiologist</a>
<a href="#">Pulmonary</a>
<a href="#">Radiology</a>
<a href="#">Neurology</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="7" width="1/3" uncode_shortcode_id="938805"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="135985"]Pages[/vc_custom_heading][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="500" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="935278" el_class="footer-links"]<a href="#">About Us</a>
<a href="#">Services</a>
<a href="#">Contact Us</a>
<a href="#">Pricing</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
