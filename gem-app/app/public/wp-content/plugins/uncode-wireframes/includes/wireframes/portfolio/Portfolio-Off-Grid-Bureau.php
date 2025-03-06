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

$data[ 'name' ]             = esc_html__( 'Portfolio Bureau', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Bureau.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="0" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0"][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="7/12"][uncode_index el_id="index-133104" loop="size:1|order_by:date|post_type:portfolio" gutter_size="3" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" images_size="four-three" single_overlay_opacity="50" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h1" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="600"][/vc_column][vc_column column_width_percent="100" position_vertical="bottom" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" width="5/12"][uncode_index el_id="index-133104" loop="size:1|order_by:date|post_type:portfolio" gutter_size="3" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" images_size="three-two" single_overlay_opacity="50" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h2" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="200" offset="1"][/vc_column][/vc_row][vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="2" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column column_width_percent="100" override_padding="yes" column_padding="4" style="dark" back_color="accent" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="5" shift_y="-5" shift_y_down="0" z_index="2" width="5/12"][vc_custom_heading heading_semantic="h3" sub_lead="yes"]Change the color to match your brand or vision, add your logo, choose the perfect layout, modify menu settings, add animations, add shape dividers, increase engagement with call to action and more.[/vc_custom_heading][/vc_column][vc_column column_width_percent="100" overlay_alpha="50" gutter_size="3" medium_width="0" mobile_width="0" shift_x="-5" shift_y="0" shift_y_down="0" z_index="0" width="7/12"][uncode_index el_id="index-133104" loop="size:1|order_by:date|post_type:portfolio" gutter_size="3" portfolio_items="title,media|featured|onpost|original" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" images_size="four-three" single_overlay_opacity="50" single_image_anim="no" single_h_align="center" single_padding="2" single_title_dimension="h1" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="200" single_animation_delay="600" offset="2"][/vc_column][/vc_row]
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
