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

$data[ 'name' ]             = esc_html__( 'Login-Register Four', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Login-Register-One.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="75" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" equal_height="yes" gutter_size="0" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="100" shape_bottom_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" shape_bottom_opacity="100" shape_bottom_index="0"][vc_column column_width_use_pixel="yes" position_horizontal="right" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="4" overlay_alpha="50" border_color="color-gyho" border_style="solid" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" column_width_pixel="460" css=".vc_custom_1592238782028{border-right-width: 1px !important;}"][uncode_woocommerce_account_forms custom_titles_typography="yes" titles_size="h1" bold_text="yes" account_forms_activate_custom_buttons="yes" account_forms_button_wide="yes" account_forms_button_border_width="0" form_style="no-labels-default" account_forms_manual_button_adjust="yes" account_forms_button_scale_mobile="no" account_forms_manual_button_adjust_value="20"][/vc_column][vc_column column_width_use_pixel="yes" position_horizontal="left" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" column_width_pixel="460"][uncode_woocommerce_account_forms account_forms_form_type="register" custom_titles_typography="yes" titles_size="h1" titles_transform="capitalize" bold_text="yes" account_forms_activate_custom_buttons="yes" account_forms_button_wide="yes" account_forms_button_border_width="0" form_style="no-labels-default" account_forms_button_scale_mobile="no"][/vc_column][/vc_row]
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
