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

$data[ 'name' ]             = esc_html__( 'Footer Blog Metro', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'footers' ];
$data[ 'custom_class' ]     = 'footers';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'footers/Footer-Blog-Metro.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="100" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" inverted_device_order="yes" uncode_shortcode_id="472821" back_color_type="uncode-palette"][vc_column column_width_percent="100" position_horizontal="left" gutter_size="3" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="0" zoom_width="0" zoom_height="0" width="4/12" uncode_shortcode_id="114051"][uncode_socials][/vc_column][vc_column column_width_percent="100" position_horizontal="left" gutter_size="3" overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="6" mobile_width="0" zoom_width="0" zoom_height="0" width="8/12" uncode_shortcode_id="137441"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="140623"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="953589"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="200060"]Explore[/vc_custom_heading][uncode_list icon="fa fa-arrow-right2" icon_color="color-rgdb" uncode_shortcode_id="198103" icon_color_type="uncode-palette"]
<ul>
    <li><a href="#" rel="nofollow noopener">About</a></li>
    <li><a href="#" rel="nofollow noopener">Partners</a></li>
    <li><a href="#" rel="nofollow noopener">Press</a></li>
    <li><a href="#" rel="nofollow noopener">Advertise</a></li>
</ul>
[/uncode_list][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="208486"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="130709"]Staff[/vc_custom_heading][vc_column_text text_color="color-rgdb" uncode_shortcode_id="526492" text_color_type="uncode-palette"]9876 Design Blvd,
Suite 543, Beverly Hills,
CA 90212[/vc_column_text][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="3" mobile_width="0" width="1/3" uncode_shortcode_id="451072"][vc_custom_heading heading_semantic="h5" text_size="'. uncode_wf_print_font_size( 'h4' ) .'" uncode_shortcode_id="723928"]Conversation[/vc_custom_heading][vc_column_text text_color="color-prif" uncode_shortcode_id="213439" text_color_type="uncode-palette"]<a href="mailto:hello@yourwebsite.com">hello@yourwebsite.com</a>
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
