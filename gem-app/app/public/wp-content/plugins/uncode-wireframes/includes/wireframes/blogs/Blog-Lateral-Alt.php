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

$data[ 'name' ]             = esc_html__( 'Blog Lateral Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Lateral-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="7" top_padding="5" bottom_padding="5" overlay_alpha="100" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="0"  overlay_alpha="100" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1000" zoom_width="0" zoom_height="0" width="1/1" uncode_shortcode_id="211745"][uncode_index el_id="index-9876567" loop="size:12|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" footer_full_width="yes" gutter_size="6" post_items="media|featured|nolink|poster,date,title,text|excerpt|120,spacer|one,author|md_size|display_qualification" screen_lg="1000" screen_md="600" screen_sm="480" single_text="lateral" single_width="12" single_image_size="7" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_h_align_mobile="center" single_vertical_text="middle" single_padding="5" single_title_dimension="h1" single_meta_custom_typo="yes" single_meta_size="default" single_border="yes" post_matrix="matrix" matrix_amount="4" matrix_items="eyIyX2kiOnsic2luZ2xlX2ltYWdlX3Bvc2l0aW9uIjoicmlnaHQiLCJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiNiIsInNpbmdsZV9jc3NfYW5pbWF0aW9uIjoiIn0sIjNfaSI6eyJzaW5nbGVfaW1hZ2VfcG9zaXRpb24iOiJyaWdodCIsInNpbmdsZV9jc3NfYW5pbWF0aW9uIjoiIn0sIjBfaSI6eyJzaW5nbGVfcGFyYWxsYXhfaW50ZW5zaXR5IjoiNiIsInNpbmdsZV9wYXJhbGxheF9jZW50ZXJlZCI6Im5vIiwic2luZ2xlX2Nzc19hbmltYXRpb24iOiIifSwiMV9pIjp7InNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiIxIiwic2luZ2xlX2Nzc19hbmltYXRpb24iOiIifX0=" uncode_shortcode_id="168484"][/vc_column][/vc_row]
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
