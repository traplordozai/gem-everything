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

$data[ 'name' ]             = esc_html__( 'Grid Split Hours List', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'grids' ];
$data[ 'custom_class' ]     = 'grids';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'grids/Grid-Split-Hours-List.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" equal_height="yes" gutter_size="2" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="33" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="190268" back_color_type="uncode-solid" back_color_solid="#fef9f3"][vc_column column_width_use_pixel="yes" position_vertical="justify" gutter_size="3" override_padding="yes" column_padding="4" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="704290" back_color_type="uncode-palette" column_width_pixel="600"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" sub_lead="yes" uncode_shortcode_id="137113" subheading="We\'re always delighted to welcome our guests, but kindly recommend making a reservation to ensure your perfect dining experience."]Opening Hours[/vc_custom_heading][uncode_pricing_list values="%5B%7B%22entry%22%3A%22Monday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Tuesday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Wednesday%22%2C%22value%22%3A%22We\'re%20Closed%22%2C%22disabled%22%3A%22yes%22%7D%2C%7B%22entry%22%3A%22Thursday%22%2C%22value%22%3A%2219%3A00%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Friday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Saturday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%2C%7B%22entry%22%3A%22Sunday%22%2C%22value%22%3A%2212%3A30%20-%2024%3A00%22%7D%5D" gutter_tab_h="2" tab_gap="2" media_width_percent="33" border_style="solid" text_size="'. uncode_wf_print_font_size( 'h5' ) .'" text_weight="400" uncode_shortcode_id="203653"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" align_horizontal="align_center" gutter_size="2" override_padding="yes" column_padding="0" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="128123"][vc_row_inner row_inner_height_percent="70" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="154785" overlay_color_type="uncode-palette"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="4" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="114911" mobile_height="400"][/vc_column_inner][/vc_row_inner][vc_row_inner limit_content=""][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="3" override_padding="yes" column_padding="4" style="dark" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="209486" back_color_type="uncode-palette"][vc_button size="link" btn_link_size="h4" btn_link_underline="btn-underline-in" custom_typo="yes"  font_weight="400" uncode_shortcode_id="164185"]Twilight Savor, 875 Park Avenue, Manhattan, New York, NY 10021[/vc_button][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
