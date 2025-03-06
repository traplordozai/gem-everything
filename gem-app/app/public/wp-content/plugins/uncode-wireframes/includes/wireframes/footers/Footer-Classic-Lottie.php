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

$data[ 'name' ]             = esc_html__( 'Footer Classic Lottie', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Classic-Lottie.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="522163" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="107639"][vc_custom_heading text_color="accent" heading_semantic="h5" uncode_shortcode_id="642556" text_color_type="uncode-palette"]Long headline to turn your visitors into users[/vc_custom_heading][uncode_socials][/vc_column][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="189265"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="173355"][vc_column_inner width="1/4"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="110961"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="230372" text_color_type="uncode-palette"]Products[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="409842" el_class="footer-links"]<a href="#">Checkout</a><br />
<a href="#">Billing</a><br />
<a href="#">Connect</a><br />
<a href="#">Corporate Card</a><br />
<a href="#">Elements</a><br />
<a href="#">Invoicing</a><br />
<a href="#">Payment Links</a><br />
<a href="#">Payouts</a><br />
<a href="#">Pricing</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="535674"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="266436" text_color_type="uncode-palette"]Resources[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="632489" el_class="footer-links"]<a href="#">Library</a><br />
<a href="#">Blog and News</a><br />
<a href="#">Glossary</a><br />
<a href="#">Media Kit</a><br />
<a href="#">FAQ</a><br />
<a href="#">Rate Calculator</a><br />
<a href="#">Invoicing</a>[/vc_custom_heading][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/4" uncode_shortcode_id="885998"][vc_custom_heading text_color="accent" heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="138717" text_color_type="uncode-palette"]Company[/vc_custom_heading][vc_empty_space empty_h="1"][vc_custom_heading heading_semantic="h5"  text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" text_height="'. uncode_wf_print_font_height( 'fontheight-524109' ) .'" uncode_shortcode_id="562151" el_class="footer-links"]<a href="#">About Us</a><br />
<a href="#">Careers</a><br />
<a href="#">Press</a><br />
<a href="#">Partner</a>[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
