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

$data[ 'name' ]             = esc_html__( 'Footer Blog Review', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Review.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="612077" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="100187"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="3/12" uncode_shortcode_id="246664"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="571213"]Account[/vc_custom_heading][vc_column_text uncode_shortcode_id="604165"]<a href="#">About</a>
<a href="#">Partners</a>
<a href="#">Press</a>
<a href="#">Careers</a>
<a href="#">Advertise</a>
<a href="#">Contact Us</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="3/12" uncode_shortcode_id="463458"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="215248"]Publisher[/vc_custom_heading][vc_column_text uncode_shortcode_id="135541"]<a href="#">Help</a>
<a href="#">Membership Faqs</a>
<a href="#">Privacy Policy</a>
<a href="#">Legals</a>
<a href="#">Cookie Policy</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="4" width="3/12" uncode_shortcode_id="171753"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="119933"]Connect[/vc_custom_heading][vc_column_text uncode_shortcode_id="117171"]<a href="#">Manage Account</a>
<a href="#">Items</a>
<a href="#">Follow Us</a>
<a href="#">Redeem a Gift</a>[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_left_mobile" mobile_width="4" width="3/12" uncode_shortcode_id="210869"][uncode_socials][/vc_column_inner][/vc_row_inner][vc_empty_space empty_h="4" mobile_visibility="yes"][vc_separator sep_color=",Default"][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" align_mobile="align_center_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="195673"][uncode_copyright text_lead="small"][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="140636"][vc_column_text text_lead="small" uncode_shortcode_id="178987"]Made with love with Uncode.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
