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

$data[ 'name' ]             = esc_html__( 'Content our History', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Our-History.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="3" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="251946"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="892757"][vc_custom_heading  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" foreword="yes" uncode_shortcode_id="211815" heading_custom_size="clamp(20px, 3vw, 30px)" subheading="OUR STORY"]Founded in 1948 by Pino Delmonte, Chef Marco Delmonte grandfather, Twilight Savor stands as a testament to a rich and enduring family tradition. This revered Manhattan institution has flourished through generations, with each dish reflecting the Delmonte family unwavering passion and dedication to culinary excellence and innovation throughout all these years.[/vc_custom_heading][vc_separator sep_color=",Default"][/vc_column][/vc_row][vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="0" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" enable_bottom_divider="default" bottom_divider="gradient" shape_bottom_h_use_pixel="true" shape_bottom_height_percent="10" shape_bottom_opacity="100" shape_bottom_index="0" uncode_shortcode_id="625792" shape_bottom_color_type="uncode-solid" shape_bottom_color_solid="#fef9f3"][vc_column column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="3/12" uncode_shortcode_id="892757"][vc_single_image media="'. uncode_wf_print_single_image( '84155' ) .'" media_width_percent="100" media_ratio="four-five" uncode_shortcode_id="119613"][/vc_column][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="9/12" uncode_shortcode_id="157127"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="3" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="155949"][vc_column_inner column_width_percent="100" position_vertical="justify" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/2" uncode_shortcode_id="861394"][vc_column_text text_lead="yes" uncode_shortcode_id="600929"]In the heart of Manhattan, Twilight Savor emerged from the dreams of Pino Delmonte, Chef Marco Delmonte grandfather. Pino, a visionary chef with a profound respect for culinary traditions, believed in creating dishes that tell a story, blending old-world techniques with a sprinkle of modern innovation.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text text_lead="yes" uncode_shortcode_id="143903"]His philosophy was simple yet profound: use only the freshest, locally-sourced ingredients to craft meals that not only nourish the body but also captivate the soul. Today, under Marco guidance, the restaurant continues to honor Pino legacy, serving as a beacon of gastronomic excellence.[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text uncode_shortcode_id="137442"]<strong>Pino Delmonte</strong>
Twilight Savor Founder[/vc_column_text][/vc_column][/vc_row]
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
