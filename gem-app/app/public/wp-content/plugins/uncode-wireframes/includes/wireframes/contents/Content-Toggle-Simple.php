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

$data[ 'name' ]             = esc_html__( 'Content Toggle Simple', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-Toggle-Simple.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="4" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="965969"][vc_column column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="5/12" uncode_shortcode_id="191305"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="five-four" shape="img-round" uncode_shortcode_id="172790"][/vc_column][vc_column column_width_percent="100" position_vertical="middle" gutter_size="2"  overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" toggle="yes" max_height="230" closed_txt="Read More" btn_margin="std" open_txt="Read Less" btn_align="left" width="7/12" uncode_shortcode_id="129590" toggle_classes="h5 btn-underline-out btn-custom-typo font-136269 font-weight-600 text-capitalize no-letterspace border-width-0 text-default-color"][vc_custom_heading text_size="'. uncode_wf_print_font_size( 'h1' ) .'" uncode_shortcode_id="357560"]Medium length headline[/vc_custom_heading][vc_column_text text_lead="yes" uncode_shortcode_id="154372"]Dutch design stands as a testament to innovation, functionality, and minimalistic elegance. Rooted in a rich cultural heritage and characterized by a blend of pragmatism and creativity, it has carved a distinctive niche in the global design landscape, at the heart of Dutch design philosophy lies a commitment.

Clean lines, thoughtful craftsmanship, and a focus on usability define its aesthetic. The Dutch designers mantra revolves around "form follows function," where every element serves a purpose while exuding an understated beauty. The legacy of Dutch design finds its roots in the early 20th century, with movements like De Stijl paving the way for geometric abstraction and the use of primary colors.

The influential works of artists like Piet Mondrian and Gerrit Rietveld laid the foundation for the minimalist yet impactful design language that continues to inspire contemporary Dutch designers. Functionality reigns supreme in Dutch design, with an emphasis on practicality and problem-solving. Whether it is furniture, architecture, fashion, or graphic design, the Dutch approach focuses on creating objects and spaces that seamlessly integrate into daily life while retaining a sense of timeless elegance.[/vc_column_text][/vc_column][/vc_row]
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
