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

$data[ 'name' ]             = esc_html__( 'Blog Grid Fullwidth Alt', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'blogs' ];
$data[ 'custom_class' ]     = 'blogs';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'blogs/Blog-Grid-Fullwidth-Alt.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="3" top_padding="3" bottom_padding="3" back_color="'. uncode_wf_print_color( 'color-lxmt' ) .'" overlay_alpha="100" gutter_size="100" column_width_percent="100" shift_y="0" z_index="0" style="inherited"][vc_column column_width_percent="100" position_horizontal="left" overlay_alpha="100" gutter_size="3" medium_width="0" shift_x="0" shift_y="0" zoom_width="0" zoom_height="0" width="1/1"][uncode_index el_id="index-17465098822" loop="size:12|order_by:date|post_type:post" filtering="yes" filtering_full_width="yes" filter_all_opposite="yes" filtering_uppercase="yes" gutter_size="2" post_items="media|media|onpost|original,title,text|excerpt|140,sep-one|extra,icon|sm,author|md_size|display_qualification" page_items="title,media,text,category" product_items="title,media,text,category,price" portfolio_items="title,media,text,category" screen_lg="1480" screen_md="1000" screen_sm="480" single_width="2" images_size="three-two" single_back_color="'. uncode_wf_print_color( 'color-xsdn' ) .'" single_overlay_opacity="50" single_padding="2" single_title_dimension="h5" single_border="yes" single_css_animation="bottom-t-top" single_animation_delay="400" single_half_padding="" single_title_uppercase="" single_title_bold="yes" single_title_serif="" single_title_divider="" single_no_background="" footer_position="left" carousel_rtl="" single_icon="fa fa-plus2" items="eyIyNDg5X2kiOnsic2luZ2xlX3dpZHRoIjoiNiJ9fQ==" filtering_transform="uppercase"][/vc_column][/vc_row]
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
