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

$data[ 'name' ]             = esc_html__( 'Content About Architect', 'uncode-wireframes' );
$data[ 'cat_name' ]         = $wireframe_categories[ 'contents' ];
$data[ 'custom_class' ]     = 'contents';
$data[ 'image_path' ]       = UNCDWF_THUMBS_URL . 'contents/Content-About-Architect.jpg';
$data[ 'dependency' ]       = array();
$data[ 'is_content_block' ] = false;

// Wireframe content

$data[ 'content' ]      = '
[vc_row unlock_row_content="yes" row_height_percent="0" override_padding="yes" h_padding="5" top_padding="5" bottom_padding="7" overlay_alpha="50" gutter_size="3" column_width_percent="100" shift_y="0" z_index="0" uncode_shortcode_id="151831"][vc_column column_width_percent="100" position_vertical="bottom" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/1" uncode_shortcode_id="130768"][vc_row_inner row_inner_height_percent="0" overlay_alpha="50" gutter_size="4" shift_y="0" z_index="0" limit_content="" uncode_shortcode_id="132244"][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="2" mobile_width="4" width="3/12" uncode_shortcode_id="171229"][vc_single_image media="'. uncode_wf_print_single_image( '80471' ) .'" media_width_percent="100" media_ratio="one-one" uncode_shortcode_id="153809"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="3" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="0" mobile_width="0" width="1/12" uncode_shortcode_id="905052"][/vc_column_inner][vc_column_inner column_width_percent="100" gutter_size="4" overlay_alpha="50" shift_x="0" shift_y="0" shift_y_down="0" z_index="0" medium_width="6" mobile_width="7" toggle="yes" max_height="60vh" closed_txt="Read More" btn_margin="lg" open_txt="Read Less" btn_margin_open="lg" fade="sm" btn_align="left" toggle_scroll="yes" toggle_navbar="yes" toggle_navbar_mobile="yes" trigger_resize="yes" width="8/12" uncode_shortcode_id="916216" toggle_classes="h3 btn-underline-in btn-custom-typo font-846016 font-weight-400 text-initial no-letterspace btn-no-scale"][vc_custom_heading heading_semantic="p"  text_size="'. uncode_wf_print_font_size( 'custom' ) .'" text_height="'. uncode_wf_print_font_height( 'fontheight-357766' ) .'" uncode_shortcode_id="104991" heading_custom_size="clamp(18px,4vw,29px)"]We are a design and architectural firm that believes that spaces can have a positive effect on society and the environment. Space brings us together, inspires our imaginations, and forces us to reconnect with our planet. In order to make giant leaps that will propel us all forward, architecture and design mean looking in a different direction and making connections that you did not expect.<br />
We always incorporate a design that is sustainable and considerate of the environment because we place an emphasis on pursuing disruptive aesthetics in each of our projects.<br />
Our team, consisting of highly skilled and passionate professionals, takes immense pride in our extensive knowledge base and proficiency in several key areas. Our expertise spans the broad spectrum of design innovation, mastery in navigating the intricacies of planning permissions, and unparalleled experience in project management. With over 15 years in the industry, our journey has taught us the invaluable lesson that each project we undertake is as unique as the clients we serve. This diversity drives our commitment to tailor our services to meet the specific demands and aspirations of every client, ensuring that their vision is brought to life in the most efficient and effective manner possible.<br />
The process of transforming spaces is at the heart of what we do. We believe that each space, regardless of its current state or intended use, holds the potential to significantly enhance the quality of life for its occupants. Through our innovative design process, we aim to unlock this potential, creating spaces that are not only aesthetically pleasing but also highly functional and sustainable. Our approach is holistic, considering every aspect of the space from the ground up, to ensure that the final product is a true reflection of our client vision and the project unique requirements.<br />
At every level of our organizational hierarchy, from junior designers to senior project managers, we are committed to pushing the boundaries of what is possible. We strive to create built environments that are not only groundbreaking in terms of their design and functionality but also in their ability to enrich the lives of those who interact with them. Our work spans a wide range of projects, from residential to commercial, each designed with the goal of creating meaningful experiences and lasting value. Through our innovative solutions and creative problem-solving, we aim to address the challenges of the modern world, ensuring that our projects contribute positively to the communities they serve and the environment as a whole.[/vc_custom_heading][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
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
