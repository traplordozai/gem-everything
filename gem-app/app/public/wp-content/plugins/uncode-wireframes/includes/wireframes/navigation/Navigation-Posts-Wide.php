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

$data[ 'name' ]             = esc_html__( 'Navigation Posts Wide', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'navigation' ];
$data[ 'custom_class' ]     = 'navigation';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'navigation/Navigation-Posts-Wide.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = true;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="0" top_padding="0" bottom_padding="0" back_color="'. uncode_wf_print_color( 'color-nhtu' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="110455" back_color_type="uncode-palette" el_class="demo-section demo-dark-background" row_height_pixel="200" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="509899"][uncode_index el_id="index-01" loop="size:10|order_by:date|post_type:post,page,portfolio,product|taxonomy_count:10" auto_query="yes" auto_query_type="navigation" style_preset="metro" gutter_size="0" post_items="media|featured|onpost|original,title" page_items="title,media|featured|onpost|original" product_items="title,media|featured|onpost|original|hide-sale|inherit-atc|inherit-w-atc|atc-typo-default|show-atc" portfolio_items="media|featured|onpost|original,title" screen_lg="1000" screen_md="600" screen_sm="480" single_text="overlay" single_width="12" single_overlay_color="color-jevc" single_overlay_opacity="20" single_overlay_visible="yes" single_text_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_h_align="center" single_padding="2" single_title_dimension="h6" single_title_weight="400" single_title_transform="uppercase" single_title_space="fontspace-210350" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" navigation_type="next" navigation_label_custom_typo="yes" navigation_label_size="fontsize-338686" navigation_label_weight="500" uncode_shortcode_id="989322" navigation_next_label="Next Project"][/vc_column][/vc_row]
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
