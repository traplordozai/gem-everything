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

$data[ 'name' ]             = esc_html__( 'News Architect Parallax', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Architect-Parallax-B.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="7" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="279570" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="4"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="110400"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'fontsize-338686' ) .'" uncode_shortcode_id="198597"]Headline[/vc_custom_heading][uncode_index el_id="index-871681" index_type="sticky-scroll" loop="size:5|order_by:date|post_type:post|taxonomy_count:10" sticky_thumb_size="one-one" sticky_th_grid_lg="3" sticky_th_grid_md="2" sticky_th_grid_sm="1" gutter_size="4" sticky_scroll_v_align="bottom" post_items="media|featured|onpost|original,date,title" single_overlay_opacity="50" single_overlay_anim="no" single_image_magnetic="yes" single_padding="2" single_title_dimension="h4" single_title_height="fontheight-357766" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="parallax" single_parallax_intensity="1" post_matrix="matrix" matrix_amount="3" horizontal_th_size="grid" uncode_shortcode_id="194249" matrix_items="eyIxX2kiOnsic2luZ2xlX2Nzc19hbmltYXRpb24iOiJwYXJhbGxheCIsInNpbmdsZV9wYXJhbGxheF9pbnRlbnNpdHkiOiIyIn0sIjJfaSI6eyJzaW5nbGVfY3NzX2FuaW1hdGlvbiI6InBhcmFsbGF4Iiwic2luZ2xlX3BhcmFsbGF4X2ludGVuc2l0eSI6IjQifSwiMF9pIjp7InNpbmdsZV9jc3NfYW5pbWF0aW9uIjoiIn19"][/vc_column][/vc_row]
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
