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

$data[ 'name' ]             = esc_html__( 'Portfolio Classic Photographer', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Classic-Photographer.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="90" gutter_size="3" column_width_use_pixel="yes" shift_y="0" z_index="2" top_divider="gradient" bottom_divider="step" uncode_shortcode_id="305182" column_width_pixel="1700"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="6" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="209450"][uncode_index el_id="index-9623217" loop="size:6|order_by:date|post_type:portfolio|taxonomy_count:10" screen_lg="700" screen_md="480" screen_sm="480" gutter_size="3" post_items="media|featured|onpost|poster,title,category|nobg" single_text="overlay" images_size="one-one" single_overlay_color="color-jevc" single_overlay_coloration="bottom_gradient" single_overlay_opacity="30" single_overlay_visible="yes" single_text_visible="yes" single_text_anim_type="btt" single_h_align="center" single_v_position="bottom" single_padding="2" single_title_dimension="h4" single_border="yes" post_matrix="matrix" matrix_amount="6" matrix_items="eyIxX2kiOnsiaW1hZ2VzX3NpemUiOiJmb3VyLWZpdmUifSwiM19pIjp7ImltYWdlc19zaXplIjoiZm91ci1maXZlIn0sIjRfaSI6eyJpbWFnZXNfc2l6ZSI6ImZvdXItZml2ZSJ9fQ==" uncode_shortcode_id="200327"][/vc_column][/vc_row]
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
