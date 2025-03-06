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

$data[ 'name' ]             = esc_html__( 'Footer Portfolio Freelance', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Portfolio-Freelance.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="50" override_padding="yes" h_padding="5" top_padding="3" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="434738" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="5/12" uncode_shortcode_id="124367"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="122305"]Lets create something great[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" width="7/12" uncode_shortcode_id="854680"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/3" uncode_shortcode_id="634716"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/3" uncode_shortcode_id="141533"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Socialise[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-minus2"]
<ul>
    <li><a href="#">Facebook</a></li>
    <li><a href="#">Instagram</a></li>
    <li><a href="#">Dribbble</a></li>
    <li><a href="#">LinkedIn</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" style="dark"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/3" uncode_shortcode_id="656327"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h3' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'"]Contact[/vc_custom_heading][uncode_list larger="yes" icon="fa fa-minus2"]
<ul>
    <li><a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a></li>
</ul>
[/uncode_list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="0" bottom_padding="2" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" uncode_shortcode_id="829031" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="157765"][vc_separator sep_color=",Default"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content=""][vc_column_inner column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_visibility="yes" medium_width="0" mobile_visibility="yes" mobile_width="0" width="1/2" uncode_shortcode_id="146595"][vc_column_text text_lead="small" uncode_shortcode_id="152807"]Thanks for visiting.[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" align_horizontal="align_right" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" align_medium="align_left_tablet" medium_width="0" align_mobile="align_left_mobile" mobile_width="0" width="1/2" uncode_shortcode_id="142533"][uncode_copyright text_lead="small"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
