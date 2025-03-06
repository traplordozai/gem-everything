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

$data[ 'name' ]             = esc_html__( 'Footer Shop Streetwear', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Shop-Streetwear.jpg';
$data[ 'dependency' ]       = array('cf7');
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="120076"][vc_column column_width_percent="100" gutter_size="6" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="124949"][vc_row_inner limit_content=""][vc_column_inner column_width_use_pixel="yes" align_horizontal="align_center" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" column_width_pixel="500"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'fontsize-155944' ) .'" uncode_shortcode_id="179787"]Subscribe[/vc_custom_heading][vc_column_text text_lead="small"]Exceptional quality. Ethical factories. Radical Transparency. Sign up to enjoy free U.S. shipping and returns on your first order.[/vc_column_text][contact-form-7 id="'. uncode_wf_print_form_id( '83036' ) .'" html_class="no-labels-underline"][/vc_column_inner][/vc_row_inner][vc_separator sep_color="color-rgdb" el_height="10px" uncode_shortcode_id="706054" sep_color_type="uncode-palette"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="2/12" uncode_shortcode_id="577199"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="159504"]Account[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">Manage Account</a><br />
<a href="#">Saved Items</a><br />
<a href="#">Orders &amp; Returns</a><br />
<a href="#">Redeem a Gift card</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="2/12" uncode_shortcode_id="204746"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="183410"]Company[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">About</a><br />
<a href="#">Factories</a><br />
<a href="#">Careers</a><br />
<a href="#">International</a><br />
<a href="#">Accessibility</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="2/12" uncode_shortcode_id="787106"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="309955"]Connect[/vc_custom_heading][vc_column_text text_lead="small"]<a href="#">Contact &amp; FAQ</a><br />
<a href="#">Instagram</a><br />
<a href="#">Twitter</a><br />
<a href="#">Affiliates</a><br />
<a href="#">Bulk Orders</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_width="0" width="2/12" uncode_shortcode_id="355202"][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="2" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_center_tablet" medium_width="0" align_mobile="align_center_mobile" mobile_width="0" width="4/12" uncode_shortcode_id="426910"][uncode_socials size="lead"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
