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

$data[ 'name' ]             = esc_html__( 'News Sticky Wide Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'news' ];
$data[ 'custom_class' ]     = 'news';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'news/News-Sticky-Wide-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="100" override_padding="yes" h_padding="0" top_padding="1" bottom_padding="0" back_color="color-wvjs" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="402448" back_color_type="uncode-palette"][vc_column column_width_percent="100" gutter_size="3"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="177507"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" equal_height="yes" gutter_size="1" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="397500"][vc_column_inner column_width_percent="100" align_horizontal="align_center" gutter_size="4" override_padding="yes" column_padding="3" back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" el_class="remove-top-padding" uncode_shortcode_id="204817" back_color_type="uncode-palette"][uncode_index el_id="index-147013" loop="size:6|order_by:date|post_type:post|taxonomy_count:10" screen_lg="1000" screen_md="600" screen_sm="480" gutter_size="4" post_items="media|featured|onpost|poster,date,category|transparentbg|topright|display-icon,title,text|excerpt|150" images_size="four-five" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_padding="1"  single_title_dimension="h2" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="alpha-anim" single_animation_speed="1000" post_matrix="matrix" matrix_amount="4" custom_cursor="blur" pagination_per_page="0" offset="9" uncode_shortcode_id="183454" matrix_items="eyIwX2kiOnsiaW1hZ2VzX3NpemUiOiJvbmUtb25lIn0sIjNfaSI6eyJpbWFnZXNfc2l6ZSI6Im9uZS1vbmUifX0="][vc_button size="link" btn_link_size="h5" btn_link_underline="btn-underline-out" custom_typo="yes"  uncode_shortcode_id="133091"]Show More[/vc_button][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" override_padding="yes" column_padding="3"  back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" sticky="yes" width="1/2" uncode_shortcode_id="158490" back_color_type="uncode-palette"][uncode_index el_id="index-147013" loop="size:1|order_by:date|post_type:post|taxonomy_count:10" style_preset="metro" single_height_viewport="yes" screen_lg="100" screen_md="100" screen_sm="100" gutter_size="0" post_items="media|featured|onpost|original,date,title" single_text="overlay" single_width="12" single_fluid_height="100" single_overlay_opacity="50" single_overlay_anim="no" single_text_visible="yes" single_text_anim="no" single_image_magnetic="yes" single_v_position="bottom" single_reduced="three_quarter" single_padding="3"  single_title_dimension="fontsize-155944" single_meta_custom_typo="yes" single_meta_size="large" single_border="yes" single_css_animation="alpha-anim" single_animation_speed="1000" custom_cursor="blur" pagination_per_page="0" uncode_shortcode_id="304400" offset="15"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
