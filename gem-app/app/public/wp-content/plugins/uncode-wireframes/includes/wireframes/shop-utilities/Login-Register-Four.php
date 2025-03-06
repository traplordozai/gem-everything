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

$data[ 'name' ]             = esc_html__( 'Login-Register One', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Login-Register-Four.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][/vc_column][/vc_row][vc_row row_height_percent="75" override_padding="yes" h_padding="2" top_padding="7" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" parallax="yes" overlay_color="accent" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" top_divider="gradient" bottom_divider="gradient" shape_dividers=""][vc_column column_width_use_pixel="yes" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" radius="xs" shadow="xl" width="1/1" column_width_pixel="700"][vc_tabs typography="yes" width_100="yes"][vc_tab gutter_size="3" column_padding="2" title="Register" tab_id="1581550660-1-521590072745927"][uncode_woocommerce_account_forms account_forms_form_type="register" account_forms_show_titles="" bold_text="yes" account_forms_activate_custom_buttons="yes" account_forms_button_button_color="accent" account_forms_button_size="btn-lg" account_forms_button_wide="yes" account_forms_button_border_width="2"][/vc_tab][vc_tab gutter_size="3" column_padding="2" title="Login" tab_id="1581550660-2-401590072745927"][uncode_woocommerce_account_forms account_forms_show_titles="" bold_text="yes" account_forms_activate_custom_buttons="yes" account_forms_button_size="btn-lg" account_forms_button_wide="yes" account_forms_button_border_width="2"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
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
