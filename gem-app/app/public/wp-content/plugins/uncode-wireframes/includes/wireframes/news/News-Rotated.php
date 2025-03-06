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

$data[ 'name' ]             = esc_html__( 'News Rotated', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Rotated.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="5" bottom_padding="5" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" gutter_size="2" column_width_use_pixel="yes" shift_y="0" z_index="0" uncode_shortcode_id="170712" back_color_type="uncode-palette" column_width_pixel="1600"][vc_column column_width_percent="100" align_horizontal="align_center" gutter_size="5"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" css_animation="alpha-anim" animation_speed="1600" width="1/1" uncode_shortcode_id="110406"][vc_custom_heading heading_semantic="h3" text_size="'. uncode_wf_print_font_size( 'custom' ) .'" uncode_shortcode_id="764562" heading_custom_size="clamp(35px,6vw,80px)"]Medium length headline[/vc_custom_heading][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="5" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="594214"][vc_column_inner column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="761701" el_class="rotate-minus-beta"][uncode_index el_id="index-581094100-544-709-453" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="2" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="4" css_grid_v_align="middle" post_items="media|featured|onpost|poster,date,title,text|excerpt|140" css_grid_images_size="five-four" single_overlay_opacity="10" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="1"  single_title_dimension="h3" single_title_weight="800" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" uncode_shortcode_id="180048"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="436869" el_class="rotate-plus-beta"][uncode_index el_id="index-581094100-544-709-453" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="4" css_grid_v_align="middle" post_items="media|featured|onpost|poster,date,title,text|excerpt|140" css_grid_images_size="three-two" single_overlay_opacity="10" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="1"  single_title_dimension="h3" single_title_weight="800" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" uncode_shortcode_id="123141" offset="1"][/vc_column_inner][vc_column_inner column_width_percent="100" position_vertical="middle" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="854062" el_class="rotate-minus-beta"][uncode_index el_id="index-581094100-544-709-453" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="4" css_grid_v_align="middle" post_items="media|featured|onpost|poster,date,title,text|excerpt|140" css_grid_images_size="five-four" single_overlay_opacity="10" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="1"  single_title_dimension="h3" single_title_weight="800" single_meta_custom_typo="yes" single_meta_size="large"  single_border="yes" uncode_shortcode_id="192213" offset="2"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="4" mobile_width="0" width="1/4" uncode_shortcode_id="254930" el_class="rotate-plus-beta"][uncode_index el_id="index-581094100-544-709-453" index_type="css_grid" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" grid_items="1" screen_lg_items="1" screen_lg_breakpoint="1000" screen_md_items="1" screen_md_breakpoint="600" screen_sm_items="1" screen_sm_breakpoint="480" gutter_size="4" css_grid_v_align="middle" post_items="media|featured|onpost|poster,date,title,text|excerpt|140" css_grid_images_size="four-three" single_overlay_opacity="10" single_text_visible="yes" single_text_anim="no" single_image_anim="no" single_padding="1"  single_title_dimension="h3" single_title_weight="800" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" uncode_shortcode_id="148388" offset="3"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
