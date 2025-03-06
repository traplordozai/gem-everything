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

$data[ 'name' ]             = esc_html__( 'Footer Shop Furniture', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Furniture.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="107584" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="0" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" border_color="color-wvjs" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="478088" css=".vc_custom_1715701247178{border-top-width: 1px !important;border-right-width: 1px !important;}" border_color_type="uncode-palette"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" inverted_device_order="yes" limit_content="" uncode_shortcode_id="113582"][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="133789"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="753632"]FOLLOW US[/vc_custom_heading][uncode_socials size="lead"][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="118031"]CUSTOMERS[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="157481" el_class="footer-links"]<a href="#">Customer Care</a><br />
<a href="#">Returns and Refunds</a><br />
<a href="#">Privacy Policy</a><br />
<a href="#">Terms of Use</a><br />
<a href="#">Condition of Sale</a>[/vc_custom_heading][vc_empty_space empty_h="3" medium_visibility="yes" mobile_visibility="yes"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="134762"]ONLINE SHOP[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="215799" el_class="footer-links"]<a href="#">How to Shop</a><br />
<a href="#">Shipping</a><br />
<a href="#">Track your Order</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/2" uncode_shortcode_id="884236"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="128724"]SUBSCRIBE[/vc_custom_heading][vc_custom_heading heading_semantic="h6"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="401832"]To stay up to date and receive occasional promotions, make sure to sign up to our newsletter.[/vc_custom_heading][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="default-background"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column column_width_percent="100" position_vertical="justify" align_horizontal="align_center" gutter_size="0" override_padding="yes" column_padding="5" style="dark" overlay_alpha="50" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="925647" border_color_type="uncode-solid" border_color_solid="#445c60" css=".vc_custom_1709113210650{border-top-width: 1px !important;}"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="0" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="127092"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="106497"]SHOWROOM[/vc_custom_heading][vc_empty_space empty_h="2"][uncode_pricing_list values="%5B%7B%22entry%22%3A%22Monday%22%2C%22value%22%3A%222pm%20-%206pm%22%7D%2C%7B%22entry%22%3A%22Thursday%22%2C%22value%22%3A%229am%20-%206pm%22%7D%2C%7B%22entry%22%3A%22Wednesday%22%2C%22value%22%3A%229am%20-%206pm%22%7D%2C%7B%22entry%22%3A%22Thursday%22%2C%22value%22%3A%229am%20-%206pm%22%7D%2C%7B%22entry%22%3A%22Friday%22%2C%22value%22%3A%229am%20-%206pm%22%7D%2C%7B%22entry%22%3A%22Saturday%22%2C%22value%22%3A%229am%20-%208pm%22%7D%2C%7B%22entry%22%3A%22Sunday%22%2C%22value%22%3A%22Closed%22%2C%22disabled%22%3A%22yes%22%7D%5D" gutter_tab_h="2" tab_gap="2" media_width_percent="33" border_style="solid" border_color="color-wvjs" heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="462234" border_color_type="uncode-palette"][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="3" desktop_visibility="yes"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="949786"][vc_custom_heading heading_semantic="h3"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="400698"]CONTACT US[/vc_custom_heading][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="417386" el_class="footer-links"]Malmö, Sweden<br />
<a href="mailto:website@email.com">website@email.com</a><br />
(322) 512 08 15[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="bottom" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="1/2" uncode_shortcode_id="315764"][vc_custom_heading heading_semantic="div"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" uncode_shortcode_id="186344" el_class="footer-links"]<a href="#top">Back to Top</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
