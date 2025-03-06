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

$data[ 'name' ]             = esc_html__( 'Footer Marketing', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Marketing.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][uncode_socials size="lead"][/vc_column][vc_column column_width_percent="100" style="dark" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="2/3"][vc_row_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Explore[/vc_custom_heading][uncode_list icon="fa fa-arrow-right3"]
<ul>
 	<li><a href="#" rel="nofollow noopener">About</a></li>
 	<li><a href="#" rel="nofollow noopener">Services</a></li>
 	<li><a href="#" rel="nofollow noopener">Portfolio</a></li>
 	<li><a href="#" rel="nofollow noopener">Contact</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Studio[/vc_custom_heading][vc_column_text]9876 Design Blvd,
Suite 543, Beverly Hills,
CA 90212[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" style="dark" gutter_size="3" overlay_alpha="50" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="1/3"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'"]Start a conversation[/vc_custom_heading][vc_column_text]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a>
+1(789) 800-1234[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
