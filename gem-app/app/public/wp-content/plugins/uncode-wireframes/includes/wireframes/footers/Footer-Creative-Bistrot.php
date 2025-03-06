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

$data[ 'name' ]             = esc_html__( 'Footer Creative Bistrot', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Creative-Bistrot.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="2" back_color="accent" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="167698" back_color_type="uncode-palette" column_width_pixel="1600"][vc_column column_width_percent="100" gutter_size="5" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/1" uncode_shortcode_id="120646"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'bigtext' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="182061"]Headline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="895421"][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="3/12" uncode_shortcode_id="721461" el_class="skin-links"][vc_custom_heading heading_semantic="h3" uncode_shortcode_id="152854"]Pasquale[/vc_custom_heading][vc_empty_space empty_h="1" el_class="custom"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="111057" el_class="footer-links"]875 Park Avenue, Manhattan,
New York, NY 10021[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="967428"](212) 555-0198[/vc_custom_heading][vc_empty_space empty_h="1"][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h6" uncode_shortcode_id="102833"]Socials[/vc_custom_heading][vc_empty_space empty_h="1"][uncode_socials size="lead"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/12" uncode_shortcode_id="377697"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="3/12" uncode_shortcode_id="203810" el_class="skin-links"][vc_custom_heading heading_semantic="h3" uncode_shortcode_id="140109"]Navigate[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="271434" el_class="footer-links"]<a href="#">Burgers List</a>
<a href="#">Drinks List</a>
<a href="#">Reservations</a>
<a href="#">Press &amp; Accolades</a>
<a href="#">The Craft Beers</a>
<a href="#">Private Dining</a>
<a href="#">Our Restaurant</a>
<a href="#">Latest News</a>
<a href="#">Join the Team</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="7" mobile_width="0" width="5/12" uncode_shortcode_id="449072"][vc_custom_heading heading_semantic="h3" uncode_shortcode_id="151948"]Opening Hours[/vc_custom_heading][vc_empty_space empty_h="1" el_class="custom-second"][uncode_pricing_list values="%5B%7B%22entry%22%3A%22Monday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Tuesday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Wednesday%22%2C%22value%22%3A%22We\'re%20Closed%22%2C%22disabled%22%3A%22yes%22%7D%2C%7B%22entry%22%3A%22Thursday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Friday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Saturday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Sunday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%5D" gutter_tab_h="2" tab_gap="2" media_width_percent="33" border_style="solid" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-161249' ) .'" uncode_shortcode_id="182383"][/vc_column_inner][/vc_row_inner][vc_separator sep_color=",Default"][uncode_copyright][/vc_column][/vc_row]
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
