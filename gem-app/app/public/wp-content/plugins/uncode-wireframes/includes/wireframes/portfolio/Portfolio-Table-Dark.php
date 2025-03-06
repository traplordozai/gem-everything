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

$data[ 'name' ]             = esc_html__( 'Portfolio Table Dark', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'portfolio' ];
$data[ 'custom_class' ]     = 'portfolio';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'portfolio/Portfolio-Table-Dark.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="167332" back_color_type="uncode-palette" shape_dividers=""][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="237046"][uncode_index el_id="index-45678765" index_type="table" loop="size:12|order_by:date|post_type:portfolio|taxonomy_count:10" gutter_size="3" table_v_align="middle" table_border="yes" table_click_row="yes" table_hover="opacity-inverted" post_table_items="date,col-one|2,title,spacer|two,text|excerpt,col-two|10" portfolio_table_items="col-five|1,media|featured|onpost|original,col-one|3,title,col-two|3,date,col-three|3,category|nobg|relative|display-icon,col-four|1,icon|md" table_images_size="four-three" single_overlay_opacity="10" single_image_anim="no" single_h_align="center" single_table_last_align="right" single_padding="3" single_title_dimension="h6" table_general_typo="yes" single_border="yes" single_css_animation="bottom-t-top" single_animation_speed="1000" custom_cursor="dark" uncode_shortcode_id="132672" single_icon="fa fa-arrow-right2"][/vc_column][/vc_row]
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
