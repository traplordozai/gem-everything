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

$data[ 'name' ]             = esc_html__( 'Footer Creative Event', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Event.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="535894" back_color_type="uncode-palette"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="182421"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="895421"][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="6/12" uncode_shortcode_id="499938"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="842883"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="202824"]Since its inception in 2016, The Malmö Design Conference has emerged as a leading conference dedicated to the expansive realm of design. The conference was born from a shared vision: to propel creative professionals to new heights and foster a dynamic design community. Over the past few years, The Malmö Design Conference has evolved into a multi-day event, featuring keynote sessions, workshops, panel discussions, exhibitions, and more, all held in unique and inspiring venues.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="193889"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="188541"]Conference[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="630441"]<a href="#">About</a>
<a href="#">Schedule</a>
<a href="#">Speakers</a>
<a href="#">Venue</a>
<a href="#">FAQs</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="727055"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="165468"]Attendees[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="263361"]<a href="#">Register Now</a>
<a href="#">Passes &amp; Pricing</a>
<a href="#">Accommodation</a>
<a href="#">Workshops</a>
<a href="#">Networking</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="2/12" uncode_shortcode_id="130898"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" uncode_shortcode_id="305639"]Connect[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="485447"]<a href="#">Contact Us</a>
<a href="#">Volunteer with Us</a>
<a href="#">Media &amp; Press</a>[/vc_column_text][vc_empty_space empty_h="1"][uncode_socials][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][vc_custom_heading heading_semantic="div" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" inline_media="'. uncode_wf_print_single_image( 'yes' ) .'" medias="'. uncode_wf_print_multiple_images( array( 17917,17917,17917,17917,17917,17917,17917,17917 ) ) .'" media_height="100" media_space="gutter" css_alt_animation="marquee" marquee_clone_alt="yes" marquee_space_alt="1" marquee_speed_alt="0" marquee_hover_alt="yes" uncode_shortcode_id="124597" el_class="marquee-freezed"][<a href="#">uncode_inline_image</a>][<a href="#">uncode_inline_image</a>][<a href="#">uncode_inline_image</a>][<a href="#">uncode_inline_image</a>][<a href="#">uncode_inline_image</a>][<a href="#">uncode_inline_image</a>][/vc_custom_heading][/vc_column][/vc_row]
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
