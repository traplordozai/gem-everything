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

$data[ 'name' ]             = esc_html__( 'Footer Classic Yoga', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Yoga.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="100" overlay_animated="yes" overlay_animated_1_color="accent" overlay_animated_size="0.35" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="103583" back_color_type="uncode-palette" overlay_animated_1_color_type="uncode-palette" column_width_pixel="1500"][vc_column column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1400" width="1/1" uncode_shortcode_id="203068"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="131583"][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="367111" column_width_pixel="500"][vc_custom_heading heading_semantic="h3"  text_weight="500" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="100012"]Newsletter Sign-Up[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'"][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][/vc_column_inner][/vc_row_inner][vc_separator sep_color="" uncode_shortcode_id="103097"][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="209022"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="159249" el_class="skin-links"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="469477"]Information[/vc_custom_heading][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="719461" el_class="footer-links"]<a href="#">Our Story</a><br />
<a href="#">Testimonials</a><br />
<a href="#">Careers</a><br />
<a href="#">Latest News</a><br />
<a href="#">Contact Us</a><br />
<a href="#">Guidelines</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="179640" el_class="skin-links"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="211752"]Yoga Programs[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="867969" el_class="footer-links"]<a href="#">Beginner Classes</a><br />
<a href="#">Intermediate Classes</a><br />
<a href="#">Advanced Classes</a><br />
<a href="#">Private Sessions</a><br />
<a href="#">Workshops and Events</a><br />
<a href="#">Yoga Teacher Training</a><br />
<a href="#">Online Classes</a><br />
<a href="#">Specialty Yoga</a><br />
<a href="#">Yoga Retreats</a><br />
<a href="#">Corporate Yoga</a><br />
<a href="#">Community Outreach</a><br />
<a href="#">Yoga Therapy</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="131516" el_class="skin-links"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="207391"]Resources[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="729293" el_class="footer-links"]<a href="#">Yoga Pose Library</a><br />
<a href="#">Meditation Guides</a><br />
<a href="#">Nutrition and Wellness</a><br />
<a href="#">Yoga Equipment</a><br />
<a href="#">Yoga and Meditation</a><br />
<a href="#">Articles and Research</a><br />
<a href="#">Health and Safety Tips</a><br />
<a href="#">Yoga for Kids</a><br />
<a href="#">Yoga for Athletes</a><br />
<a href="#">Subscription to Newsletter</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="1/4" uncode_shortcode_id="195767"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="240519"]Opening Hours[/vc_custom_heading][vc_empty_space empty_h="0"][uncode_pricing_list values="%5B%7B%22entry%22%3A%22Monday%22%2C%22value%22%3A%229%20-%2020%22%7D%2C%7B%22entry%22%3A%22Tuesday%22%2C%22value%22%3A%229%20-%2020%22%7D%2C%7B%22entry%22%3A%22Wednesday%22%2C%22value%22%3A%229%20-%2020%22%7D%2C%7B%22entry%22%3A%22Thursday%22%2C%22value%22%3A%229%20-%2020%22%7D%2C%7B%22entry%22%3A%22Friday%22%2C%22value%22%3A%229%20-%2020%22%7D%2C%7B%22entry%22%3A%22Saturday%22%2C%22value%22%3A%229%20-%2013%22%7D%2C%7B%22entry%22%3A%22Sunday%22%2C%22value%22%3A%22Closed%22%2C%22disabled%22%3A%22yes%22%7D%5D" gutter_tab_h="2" tab_gap="2" media_width_percent="33" border_style="solid" heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_space="'. uncode_wf_print_font_space( 'fontspace-781688' ) .'" uncode_shortcode_id="130952"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="2" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="206574"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="201721"][uncode_copyright][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="151070"][uncode_socials][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
