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

$data[ 'name' ]             = esc_html__( 'Products Marquee', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'products' ];
$data[ 'custom_class' ]     = 'products';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'products/Products-Marquee.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_use_pixel="yes" border_color="color-gyho" border_style="solid" shift_y="0" z_index="0" content_parallax="0" uncode_shortcode_id="252633" css=".vc_custom_1725892789663{border-top-width: 1px !important;}" border_color_type="uncode-palette" column_width_pixel="1500" shape_dividers=""][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="4"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="522319"][uncode_index el_id="index-663620" index_type="linear" loop="size:7|order_by:date|post_type:product|taxonomy_count:10" gutter_size="4" linear_width="clamp(240px, 20vw, 300px)" linear_speed="0" linear_hover="pause" draggable="yes" post_items="media|featured|onpost|poster,title,category|transparentbg|topright|display-icon,text|excerpt|120" single_overlay_color="color-jevc" single_overlay_opacity="20" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="2" single_title_dimension="h4" single_title_weight="500" single_title_height="fontheight-357766" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" post_matrix="matrix" matrix_amount="6" uncode_shortcode_id="193270" matrix_items="eyIxX2kiOnsiY3VzdG9tX2dyaWRfaW1hZ2VzX3NpemUiOiJvbmUtb25lIn0sIjNfaSI6eyJjdXN0b21fZ3JpZF9pbWFnZXNfc2l6ZSI6Im9uZS1vbmUifSwiMl9pIjp7ImN1c3RvbV9ncmlkX2ltYWdlc19zaXplIjoib25lLW9uZSJ9LCI1X2kiOnsiY3VzdG9tX2dyaWRfaW1hZ2VzX3NpemUiOiJvbmUtb25lIn19"][/vc_column][/vc_row]
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
