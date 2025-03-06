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

$data[ 'name' ]             = esc_html__( 'Footer Classic Hotel', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Hotel.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="906919" back_color_type="uncode-palette" border_color_type="uncode-solid" border_color_solid="#424242" css=".vc_custom_1633609337768{border-top-width: 1px !important;}" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="109627"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="154841"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="191977"]Uncode[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="649463"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="209916"]Hotel[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="741643"]<a href="#">Home</a><br />
<a href="#">Our story</a><br />
<a href="#">Sleep</a><br />
<a href="#">Food</a><br />
<a href="#">Experience</a><br />
<a href="#">Inspiration</a><br />
<a href="#">Contact</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/3" uncode_shortcode_id="122221"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="135255"]Extras[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="697312"]<a href="#">Special offers</a><br />
<a href="#">Weddings</a><br />
<a href="#">Spa</a><br />
<a href="#">Wellness</a><br />
<a href="#">FAQ</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" gutter_size="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="657124"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="184092"][vc_column_text text_lead="yes" uncode_shortcode_id="797938"]Railway Station Avenue 75,<br />
2500 Bellinzona Campiglio,<br />
Switzerland - CH[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="824018"][uncode_socials size="lead"][/vc_column_inner][/vc_row_inner][vc_icon position="left" space_reduced="yes" icon="fa fa-tripadvisor" size="fa-2x" heading_semantic="p" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="495642" title="Travelers Choice 2021"][/vc_icon][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="2" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="10" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="156027" back_color_type="uncode-palette" overlay_color_type="uncode-palette" shape_dividers=""][vc_column column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="106970" column_width_pixel="700"][uncode_copyright text_lead="small"][/vc_column][/vc_row]
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
