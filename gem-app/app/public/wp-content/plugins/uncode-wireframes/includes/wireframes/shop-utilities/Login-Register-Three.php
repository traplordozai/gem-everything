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

$data[ 'name' ]             = esc_html__( 'Login-Register Three', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'shop-utilities' ];
$data[ 'custom_class' ]     = 'shop-utilities';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'shop-utilities/Login-Register-Three.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" gutter_size="3" style="dark" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1"][/vc_column][/vc_row][vc_row row_height_percent="95" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" back_image="'. uncode_wf_print_single_image( '84889' ) .'" overlay_color="accent" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_use_pixel="yes" position_vertical="middle" gutter_size="3" override_padding="yes" column_padding="4" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" shadow="xl" shadow_darker="yes" width="1/1" column_width_pixel="600"][vc_accordion history="yes" sign="plus"][vc_accordion_tab icon="fa fa-heart3" column_padding="2" title="LOGIN" tab_id="1581593232-1-541590072727353" slug="login"][vc_empty_space empty_h="2"][uncode_woocommerce_account_forms custom_titles_typography="yes" titles_size="h4" account_forms_activate_custom_buttons="yes" account_forms_button_button_color="accent" account_forms_button_size="btn-lg" account_forms_button_wide="yes" account_forms_button_hover_fx="full-colored" account_forms_button_border_width="0" form_style="no-labels-default" account_forms_button_scale_mobile="no"][vc_empty_space empty_h="2"][/vc_accordion_tab][vc_accordion_tab icon="fa fa-head" column_padding="2" title="REGISTER" tab_id="1581593232-2-211590072727353" slug="register"][vc_empty_space empty_h="2"][uncode_woocommerce_account_forms account_forms_form_type="register" custom_titles_typography="yes" titles_size="h4" account_forms_activate_custom_buttons="yes" account_forms_button_button_color="accent" account_forms_button_size="btn-lg" account_forms_button_wide="yes" account_forms_button_hover_fx="full-colored" account_forms_button_border_width="0" form_style="no-labels-default" account_forms_button_scale_mobile="no"][vc_empty_space empty_h="2"][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
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
