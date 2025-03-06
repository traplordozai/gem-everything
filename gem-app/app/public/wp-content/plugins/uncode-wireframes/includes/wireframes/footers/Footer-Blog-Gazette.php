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

$data[ 'name' ]             = esc_html__( 'Footer Blog Gazette', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Gazette.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="color-wvjs" overlay_alpha="50" equal_height="yes" gutter_size="1" column_width_percent="100" border_color="color-wvjs" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="324043" back_color_type="uncode-palette" css=".vc_custom_1698153263987{border-top-width: 1px !important;}" border_color_type="uncode-palette"][vc_column column_width_percent="100" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="159032" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h6" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="624352"]Heading[/vc_custom_heading][uncode_socials][/vc_column][vc_column column_width_percent="100" gutter_size="0"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="2/3" uncode_shortcode_id="129386"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" uncode_shortcode_id="158779" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="138932" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="123283"]Navigate[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="346056"]<a href="#">Contributors</a>
<a href="#">About</a>
<a href="#">Authors</a>
<a href="#">Media Kit</a>
<a href="#">Subscriptions</a>
<a href="#">Contact Us</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="110283" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="968896"]Customers[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="366820"]<a href="#">Privacy Policy</a>
<a href="#">Cookie Policy</a>
<a href="#">FAQ</a>
<a href="#">Terms of Use</a>
<a href="#">Advertise</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/3" uncode_shortcode_id="419366" back_color_type="uncode-palette"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="176268"]Main Office[/vc_custom_heading][vc_column_text text_lead="yes" text_color="color-prif" uncode_shortcode_id="444074" text_color_type="uncode-palette"]45 skabersjögatan
Malmö,Sweden
<a href="mailto:website@email.com">website@email.com</a>
(322) 512 08 15[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="0" border_color="color-wvjs" border_style="solid" shift_y="0" z_index="0" uncode_shortcode_id="386595" css=".vc_custom_1707409136133{border-top-width: 1px !important;}" border_color_type="uncode-palette" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="682671" back_color_type="uncode-palette"][vc_column_text text_color="color-prif" uncode_shortcode_id="420227" text_color_type="uncode-palette"]© 2024 Uncode. All rights reserved[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" align_horizontal="align_right" gutter_size="3" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="185712" back_color_type="uncode-palette"][vc_column_text text_color="color-prif" uncode_shortcode_id="412471" text_color_type="uncode-palette"]<a href="#">Top</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
