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

$data[ 'name' ]             = esc_html__( 'Icon Lists', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'icons' ];
$data[ 'custom_class' ]     = 'icons';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'icons/Icon-Lists.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row row_height_percent="0" override_padding="yes" h_padding="2" top_padding="5" bottom_padding="5" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" shape_dividers=""][vc_column width="1/4"][uncode_list icon="fa fa-check-circle" icon_color="accent"]
<ul>
 	<li>Highly Customizable Design</li>
 	<li>Pre-Built Pages and Sections</li>
 	<li>Clean Design</li>
 	<li>Extensive Theme Options</li>
 	<li>Top Notch Quality</li>
 	<li>Responsive Design</li>
 	<li>Tailored advanced Page Builder</li>
 	<li>Seo Optimised</li>
 	<li>Outstanding Customer Support</li>
</ul>
[/uncode_list][/vc_column][vc_column width="1/4"][uncode_list icon="fa fa-check-circle" icon_color="accent"]
<ul>
 	<li>Highly Customizable Design</li>
 	<li>Pre-Built Pages and Sections</li>
 	<li>Clean Design</li>
 	<li>Extensive Theme Options</li>
 	<li>Top Notch Quality</li>
 	<li>Responsive Design</li>
 	<li>Tailored advanced Page Builder</li>
 	<li>Seo Optimised</li>
 	<li>Outstanding Customer Support</li>
</ul>
[/uncode_list][/vc_column][vc_column width="1/4"][uncode_list icon="fa fa-check-circle" icon_color="accent"]
<ul>
 	<li>Highly Customizable Design</li>
 	<li>Pre-Built Pages and Sections</li>
 	<li>Clean Design</li>
 	<li>Extensive Theme Options</li>
 	<li>Top Notch Quality</li>
 	<li>Responsive Design</li>
 	<li>Tailored advanced Page Builder</li>
 	<li>Seo Optimised</li>
 	<li>Outstanding Customer Support</li>
</ul>
[/uncode_list][/vc_column][vc_column width="1/4"][uncode_list icon="fa fa-check-circle" icon_color="accent"]
<ul>
 	<li>Highly Customizable Design</li>
 	<li>Pre-Built Pages and Sections</li>
 	<li>Clean Design</li>
 	<li>Extensive Theme Options</li>
 	<li>Top Notch Quality</li>
 	<li>Responsive Design</li>
 	<li>Tailored advanced Page Builder</li>
 	<li>Seo Optimised</li>
 	<li>Outstanding Customer Support</li>
</ul>
[/uncode_list][/vc_column][/vc_row]
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
