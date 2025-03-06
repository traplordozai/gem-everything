<?php
global $uncode_vc_gallery;
$uncode_vc_gallery = true;

$el_id = $isotope_mode = $gallery_back_color = $items = $random = $medias = $explode_albums = $filtering = $filter_style = $filter_background = $filter_back_color = $filtering_full_width = $filtering_position = $filtering_uppercase = $filter_all_opposite = $filter_all_text = $filter_mobile = $filter_mobile_align = $filter_mobile_dropdown = $filter_mobile_dropdown_text = $filter_scroll = $filter_sticky = $style_preset = $images_size = $thumb_size = $gutter_size = $stage_padding = $carousel_overflow = $carousel_half_opacity = $carousel_scaled = $carousel_pointer_events = $inner_padding = $single_width = $single_height = $single_back_color = $single_shape = $radius = $single_elements_click = $single_text = $single_text_visible = $single_text_visible = $single_text_anim = $single_text_anim_type = $single_overlay_visible = $single_overlay_anim = $single_image_coloration = $single_image_color_anim = $single_image_anim = $single_image_magnetic = $single_reduced = $single_reduced_mobile = $single_padding = $single_text_reduced = $single_h_align = $single_v_position = $single_h_position = $single_style = $single_overlay_color = $single_overlay_coloration = $single_overlay_blend = $single_overlay_opacity = $single_link = $single_shadow = $shadow_weight = $shadow_darker = $single_border = $single_icon = $single_title_transform = $single_animation_first = $single_title_family = $single_title_dimension = $single_title_weight = $single_title_semantic = $single_title_height = $single_title_space = $single_text_lead = $single_css_animation = $single_animation_delay = $single_animation_speed = $carousel_fluid = $carousel_type = $carousel_interval = $carousel_navspeed = $carousel_loop = $carousel_nav = $carousel_dots = $carousel_dots_space = $carousel_nav_mobile = $carousel_nav_skin = $carousel_dots_mobile = $carousel_dots_inside = $carousel_dot_position = $carousel_dot_padding = $carousel_autoh = $carousel_lg = $carousel_md = $carousel_sm = $carousel_textual = $hide_quotes = $carousel_height = $carousel_v_align = $off_grid = $off_grid_element = $off_grid_val = $off_grid_all = $screen_lg = $screen_md = $screen_sm = $lbox_skin = $lbox_transparency = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_no_tmb = $lbox_no_arrows = $lbox_gallery_arrows = $lbox_gallery_arrows_bg = $lbox_zoom_origin = $lbox_counter = $lbox_actual_size = $lbox_full = $lbox_download = $lbox_transition = $no_double_tap = $nested = $media_items = $output = $title = $type = $el_class = $justify_row_height = $justify_max_row_height = $justify_last_row = $sticky_dir = $sticky_wrap = $sticky_th_size = $sticky_th_vh_lg = $sticky_th_vh_md = $sticky_th_vh_sm = $sticky_th_grid_lg = $sticky_th_grid_md = $sticky_th_grid_sm = $dynamic = $dynamic_source = $filter_typography = $custom_cursor = $skew = $container_style = $sticky_scroll_v_align = $sticky_thumb_size = $no_sticky_scroll_tablet = $no_sticky_scroll_mobile = $sticky_th_vh_minus = $sticky_scroll_mobile_safe_height = $oembed_params = $advanced_videos = $play_hover = $play_pause = $mobile_videos = $lb_video_advanced = $lb_autoplay = $lb_muted = $heading_custom_size = $linear_orientation = $linear_animation = $linear_speed = $linear_hover = $draggable = $marquee_clone = $linear_width = $linear_height = $linear_v_alingment = $linear_h_alingment = $marquee_freeze = $marquee_freeze_desktop = $marquee_freeze_mobile = $marquee_blur = '';

extract( shortcode_atts( array(
		'uncode_shortcode_id' => '',
		'title' => '',
		'el_id' => '',
		'col_width' => '12',
		'type' => 'isotope',
		'isotope_mode' => 'masonry',
		'custom_grid_content_block_id' => '',
		'gallery_back_color' => '',
		'gallery_back_color_type' => '',
		'gallery_back_color_solid' => '',
		'gallery_back_color_gradient' => '',
		'post_matrix' => '',
		'matrix_amount' => 5,
		'matrix_items' => '',
		'items' => '',
		'random' => '',
		'medias' => '',
		'explode_albums' => '',
		'filtering' => '',
		'filter_style' => 'light',
		'filter_typography' => 'light',
		'filter_back_color' => '',
		'filter_back_color_type' => '',
		'filter_back_color_solid' => '',
		'filter_back_color_gradient' => '',
		'filtering_full_width' => '',
		'filtering_position' => 'left',
		'filtering_uppercase' => '',
		'filter_all_opposite' => '',
		'filter_all_text' => '',
		'filter_mobile' => '',
		'filter_mobile_align' => 'center',
		'filter_mobile_dropdown' => '',
		'filter_mobile_dropdown_text' => esc_html__( 'Categories', 'uncode' ),
		'filter_scroll' => '',
		'filter_sticky' => '',
		'style_preset' => 'masonry',
		'images_size' => '',
		'custom_grid_images_size' => '',
		'css_grid_images_size' => '',
		'thumb_size' => '',
		'gutter_size' => 3,
		'stage_padding' => 0,
		'carousel_overflow' => '',
		'advanced_nav' => '',
		'carousel_half_opacity' => '',
		'carousel_scaled' => '',
		'carousel_pointer_events' => '',
		'inner_padding' => '',
		'single_width' => '4',
		'single_height' => '4',
		'single_back_color' => '',
		'single_shape' => '',
		'radius' => '',
		'single_elements_click' => '',
		'single_text' => 'overlay',
		'single_text_visible' => '',
		'single_text_visible' => 'no',
		'single_text_anim' => 'yes',
		'single_text_anim_type' => '',
		'single_overlay_visible' => 'no',
		'single_overlay_anim' => 'yes',
		'single_image_coloration' => '',
		'single_image_color_anim' => '',
		'single_image_anim' => 'yes',
		'single_image_magnetic' => '',
		'single_reduced' => '',
		'single_reduced_mobile' => '',
		'single_padding' => '',
		'single_text_reduced' => '',
		'single_h_align' => 'left',
		'single_v_position' => 'middle',
		'single_h_position' => 'left',
		'single_style' => 'light',
		'single_overlay_color' => '',
		'single_overlay_coloration' => '',
		'single_overlay_blend' => '',
		'single_overlay_opacity' => 50,
		'single_link' => '',
		'single_shadow' => '',
		'shadow_weight' => '',
		'shadow_darker' => '',
		'shadow_darker' => '',
		'single_border' => '',
		'single_icon' => '',
		'single_title_transform' => '',
		'single_animation_first' => '',
		'single_title_family' => '',
		'single_title_dimension' => '',
		'heading_custom_size' => '',
		'single_title_weight' => '',
		'single_title_semantic' => 'h3',
		'single_title_height' => '',
		'single_title_space' => '',
		'single_title_scale_mobile' => '',
		'single_text_lead' => '',
		'single_meta_custom_typo' => '',
		'single_meta_size' => '',
		'single_meta_weight' => '',
		'single_meta_transform' => '',
		'single_css_animation' => '',
		'single_animation_delay' => '',
		'single_animation_speed' => '',
		'single_animation_sequential' => '',
		'single_parallax_intensity' => '',
		'single_parallax_centered' => '',
		'carousel_fluid' => '',
		'carousel_type' => '',
		'carousel_interval' => 3000,
		'carousel_navspeed' => 400,
		'carousel_loop' => '',
		'carousel_nav' => '',
		'carousel_nav_mobile' => '',
		'carousel_nav_skin' => 'light',
		'carousel_dots' => '',
		'carousel_dots_space' => '',
		'carousel_dots_mobile' => '',
		'carousel_dots_inside' => '',
		'carousel_dot_position' => '',
		'carousel_dot_padding' => '2',
		'carousel_autoh' => '',
		'carousel_lg' => '',
		'carousel_md' => '',
		'carousel_sm' => '',
		'carousel_textual' => '',
		'hide_quotes' => '',
		'carousel_height' => 'auto',
		'carousel_v_align' => '',
		'off_grid' => '',
		'off_grid_element' => 'odd',
		'off_grid_custom' => '0,2',
		'off_grid_val' => '2',
		'off_grid_all' => '',
		'screen_lg' => 1000,
		'screen_md' => 600,
		'screen_sm' => 480,
		'grid_items' => '4',
		'screen_lg_breakpoint' => 1000,
		'screen_lg_items' => '3',
		'screen_md_breakpoint' => 600,
		'screen_md_items' => '2',
		'screen_sm_breakpoint' => 480,
		'screen_sm_items' => '1',
		'lbox_skin' => '',
		'lbox_transparency' => '',
		'lbox_dir' => '',
		'lbox_title' => '',
		'lbox_caption' => '',
		'lbox_social' => '',
		'lbox_deep' => '',
		'lbox_no_tmb' => '',
		'lbox_no_arrows' => '',
		'lbox_gallery_arrows' => '',
		'lbox_gallery_arrows_bg' => '',
		'lbox_zoom_origin' => '',
		'lbox_counter' => '',
		'lbox_actual_size' => '',
		'lbox_full' => '',
		'lbox_download' => '',
		'lbox_transition' => '',
		'no_double_tap' => '',
		'nested' => '',
		'media_items' => 'media,icon',
		'el_class' => '',
		'justify_row_height' => '250',
		'justify_max_row_height' => '',
		'justify_last_row' => 'nojustify',
		'sticky_dir' => '',
		'sticky_wrap' => '',
		'sticky_th_vh_lg' => '80',
		'sticky_th_vh_md' => '80',
		'sticky_th_vh_sm' => '80',
		'sticky_th_vh_minus' => '',
		'sticky_th_grid_lg' => '3',
		'sticky_th_grid_md' => '3',
		'sticky_th_grid_sm' => '1',
		'dynamic' => '',
		'dynamic_source' => '',
		'custom_cursor' => '',
		'cursor_title' => '',
		'custom_tooltip' => '',
		'cursor_title_boing' => '',
		'hide_cursor_bg' => '',
		'hide_title_tooltip' => '',
		'tooltip_class' => '',
		'skew' => '',
		'infinite' => '',
		'infinite_preloaded_items' => '',
		'infinite_loading_items' => '',
		'infinite_hover_fx' => '',
		'infinite_button' => '',
		'infinite_button_text' => '',
		'infinite_button_shape' => '',
		'infinite_button_outline' => '',
		'infinite_button_color' => '',
		'infinite_button_color_type' => '',
		'infinite_button_color_solid' => '',
		'infinite_button_color_gradient' => '',
		'footer_style' => 'light',
		'footer_back_color' => '',
		'footer_back_color_type' => '',
		'footer_back_color_solid' => '',
		'footer_back_color_gradient' => '',
		'footer_full_width' => '',
		'sticky_scroll_v_align' => '',
		'sticky_thumb_size' => '',
		'no_sticky_scroll_tablet' => '',
		'no_sticky_scroll_mobile' => '',
		'sticky_scroll_mobile_safe_height' => '',
		'css_grid_equal_height' => '',
		'oembed_params' => '',
		'max_w_ajax_filters' => '',
		'advanced_videos' => '',
		'play_hover' => '',
		'play_pause' => '',
		'mobile_videos' => '',
		'lb_video_advanced' => '',
		'lb_autoplay' => '',
		'lb_muted' => '',
		'css_grid_v_align' => '',
		'linear_orientation' => '',
		'linear_animation' => 'marquee',
		'linear_speed' => '',
		'linear_hover' => '',
		'marquee_clone' => '',
		'draggable' => '',
		'size_by' => '',
		'linear_width' => 'clamp(100px, 20vw, 450px)',
		'linear_height' => 'clamp(100px, 20vw, 450px)',
		'linear_v_alingment' => '',
		'linear_h_alingment' => '',
		'marquee_freeze' => '',
		'marquee_freeze_desktop' => '',
		'marquee_freeze_mobile' => '',
		'marquee_blur' => ''
), $atts ) );

$stylesArray = array(
		'light',
		'dark'
);

if ( $type === 'custom_grid' && $custom_grid_content_block_id ) {
	$custom_matrix_objects = array();
	ob_start();
}

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_gallery',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'gallery_back_color'             => $gallery_back_color,
		'gallery_back_color_type'        => $gallery_back_color_type,
		'gallery_back_color_solid'       => $gallery_back_color_solid,
		'gallery_back_color_gradient'    => $gallery_back_color_gradient,
		'filter_back_color'              => $filter_back_color,
		'filter_back_color_type'         => $filter_back_color_type,
		'filter_back_color_solid'        => $filter_back_color_solid,
		'filter_back_color_gradient'     => $filter_back_color_gradient,
		'infinite_button_color'          => $infinite_button_color,
		'infinite_button_color_type'     => $infinite_button_color_type,
		'infinite_button_color_solid'    => $infinite_button_color_solid,
		'infinite_button_color_gradient' => $infinite_button_color_gradient,
		'footer_back_color'              => $footer_back_color,
		'footer_back_color_type'         => $footer_back_color_type,
		'footer_back_color_solid'        => $footer_back_color_solid,
		'footer_back_color_gradient'     => $footer_back_color_gradient,
	)
) );

$gallery_back_color = uncode_get_shortcode_color_attribute_value( 'gallery_back_color', $uncode_shortcode_id, $gallery_back_color_type, $gallery_back_color, $gallery_back_color_solid, $gallery_back_color_gradient );
$filter_back_color = uncode_get_shortcode_color_attribute_value( 'filter_back_color', $uncode_shortcode_id, $filter_back_color_type, $filter_back_color, $filter_back_color_solid, $filter_back_color_gradient );
$infinite_button_color = uncode_get_shortcode_color_attribute_value( 'infinite_button_color', $uncode_shortcode_id, $infinite_button_color_type, $infinite_button_color, $infinite_button_color_solid, $infinite_button_color_gradient );
$footer_back_color = uncode_get_shortcode_color_attribute_value( 'footer_back_color', $uncode_shortcode_id, $footer_back_color_type, $footer_back_color, $footer_back_color_solid, $footer_back_color_gradient );

global $previous_blend;

$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

switch ($gutter_size) {
		case 0:
				$gutter_size = 'no-gutter';
				break;
		case 1:
				$gutter_size = 'px-gutter';
				break;
		case 2:
				$gutter_size = 'half-gutter';
				break;
		case 3:
		default:
				$gutter_size = 'single-gutter';
				break;
		case 4:
				$gutter_size = 'double-gutter';
				break;
		case 5:
			$gutter_size = 'triple-gutter';
			break;
		case 6:
			$gutter_size = 'quad-gutter';
			break;
}
$main_container_classes = array();
$parent_container_classes = array();
$container_classes = array();
$fixer_classes = array();

if ( $off_grid === 'yes' ){
	$container_classes[] = 'off-grid-layout';
	$container_classes[] = 'off-grid-item-' . $off_grid_element;
	$container_classes[] = 'off-grid-val-' . $off_grid_val;

	if ( $off_grid_all === 'yes' ) {
		$container_classes[] = 'off-grid-forced';
	}

	if ( $off_grid_element === 'custom' ) {
		$off_grid_arr = explode(',', $off_grid_custom);
	}
}

$general_width = $single_width;
$general_height = $single_height;
$general_shape = $single_shape;
$general_iso_style = $single_style;
$general_overlay_color = $single_overlay_color;
$general_overlay_coloration = $single_overlay_coloration;
$general_overlay_opacity = $single_overlay_opacity;
$general_overlay_blend = $single_overlay_blend;
$general_text = $single_text;
$general_elements_click = $single_elements_click;
$general_text_visible = $single_text_visible;
$general_text_anim = $single_text_anim;
$general_text_anim_type = $single_text_anim_type;
$general_overlay_visible = $single_overlay_visible;
$general_overlay_anim = $single_overlay_anim;
$general_image_coloration = $single_image_coloration;
$general_image_color_anim = $single_image_color_anim;
$general_image_anim = $single_image_anim;
$general_image_magnetic = $single_image_magnetic;
$general_reduced = $single_reduced;
$general_reduced_mobile = $single_reduced_mobile;
$general_padding = $single_padding;
$general_text_reduced = $single_text_reduced;
$general_h_align = $single_h_align;
$general_v_position = $single_v_position;
$general_h_position = $single_h_position;
$general_link = $single_link;
$general_shadow = $single_shadow;
$general_shadow_weight = $shadow_weight;
$general_shadow_darker = $shadow_darker;
$general_border = $single_border;
$general_icon = $single_icon;
$general_back_color = $single_back_color;
$general_title_transform = $single_title_transform;
$general_title_family = $single_title_family;
$general_title_dimension = $single_title_dimension;
$general_title_custom = $heading_custom_size;
$general_title_weight = $single_title_weight;
$general_title_semantic = $single_title_semantic;
$general_title_height = $single_title_height;
$general_title_space = $single_title_space;
$general_title_scale_mobile = $single_title_scale_mobile;
$general_text_lead = $single_text_lead;
$general_meta_custom_typo = $single_meta_custom_typo;
$general_meta_size = $single_meta_size;
$general_meta_weight = $single_meta_weight;
$general_meta_transform = $single_meta_transform;
$general_css_animation = $single_css_animation;
$general_animation_delay = $single_animation_delay;
$general_animation_speed = $single_animation_speed;
$general_parallax_intensity = $single_parallax_intensity;
$general_parallax_centered = $single_parallax_centered;

$items        = function_exists( 'uncode_core_decode' ) ? json_decode( uncode_core_decode( strip_tags( $items ) ), true) : array();
$matrix_items = function_exists( 'uncode_core_decode' ) ? json_decode( uncode_core_decode( strip_tags( $matrix_items ) ), true) : array();

$medias = explode( ',', $medias );

if ( $dynamic !== '' ) {
	$featured_id = get_post_thumbnail_id();
	if ( function_exists( 'is_product' ) && is_product() ) {
		global $product;
		$featured_id = apply_filters( 'uncode_product_image_id', $product->get_image_id(), $product->get_id() );
		$medias = apply_filters( 'uncode_product_gallery_thumb_ids', $product->get_gallery_image_ids(), $product->get_id() );
		$medias = array_values($medias);
	} else {
		global $post;
		$medias = get_post_meta($post->ID, '_uncode_featured_media', 1);
		$medias = explode(',', $medias);
	}
	if ( $dynamic_source === 'featured' ) {
		array_unshift( $medias, $featured_id );
	}
}

$medias = apply_filters( 'uncode_vc_gallery_medias', $medias, $el_id );

$detect_albums = array();//create array to check if an album has passed
$album_parents = array();//pas the album parents
$old_medias = $medias;//store $medias
$medias = array();//reinit $medias

foreach ($old_medias as $key => $value) {//check if albums are set among medias
	if ( get_post_mime_type($value) == 'oembed/gallery' && wp_get_post_parent_id($value) ) {
		$parent_id = wp_get_post_parent_id($value);
		$media_album_ids = get_post_meta($parent_id, '_uncode_featured_media', true);//string of images in the album
		$media_album_ids_arr = explode(',', $media_album_ids);//array of images in the album

		if ( $explode_albums != 'yes' ) {
			$media_id = get_post_thumbnail_id($parent_id);
			//array_splice($medias, $key, 0, $media_id);
			if ( $media_id !== '' && $media_id != 0 ) {
				$album_parents[$media_id] = $parent_id;
				$medias[] = $media_id;
				$detect_albums[$media_id] = $media_album_ids_arr;
				$detect_albums[$media_id] = $media_album_ids_arr;
			}
		} else {
			if ( is_array($media_album_ids_arr) && !empty($media_album_ids_arr) ) {
				foreach ($media_album_ids_arr as $_key => $_value) {
					$th_url = wp_get_attachment_image_src($_value);
					//if ( $_value !== '' && $th_url[0]!='' )
						$medias[] = $_value;
				}
			}
			$detect_albums[$_value] = 'expand';
		}
	} else {
		if ( $value !== '') {
			$medias[] = $value;
			$detect_albums[$value] = false;
		}
	}

}

if ($random === 'yes') {
	shuffle($medias);
}

// Add fake pagination functionality for the load more
$paged = 1;

if ( isset( $_GET['upage'] ) ) {
	$paged = absint( $_GET['upage'] );
}

if ( $type === 'carousel' || $type === 'custom_grid' || $random === 'yes' ) {
	$infinite = '';
}

if ( $infinite === 'yes' ) {
	$infinite_preloaded_items = absint( $infinite_preloaded_items );
	$infinite_preloaded_items = $infinite_preloaded_items ? $infinite_preloaded_items : 10;
	$infinite_loading_items   = absint( $infinite_loading_items );
	$infinite_loading_items   = $infinite_loading_items ? $infinite_loading_items : 10;
	$per_page                 = $infinite_loading_items;
	$paginated_medias         = uncode_vc_gallery_paginate_medias( $medias, $paged, $infinite_preloaded_items, $infinite_loading_items );
	$medias                   = $paginated_medias['medias'];
}

$posts_counter = count( $medias );

$posts = array();
$categories = array();
$categories_array = get_terms('media-category' , array('orderby' => 'name', 'hide_empty' => true));

if ($posts_counter) {
	foreach ($album_parents as $key_item => $item_thumb_id) {
		$album_categories_array = wp_get_post_terms($item_thumb_id, 'uncode_gallery_category', array('orderby' => 'name', 'hide_empty' => true));
		if ( ! empty( $album_categories_array ) && ! is_wp_error( $album_categories_array ) ) {
			foreach ( $album_categories_array as $cat ) {
				if (!isset($categories[$cat->term_id][$cat->name])) {
					$categories[$cat->term_id][$cat->name] = array($item_thumb_id);
				} else {
					array_push($categories[$cat->term_id][$cat->name],$item_thumb_id);
				}
			}
		}
	}
	if ( ! empty( $categories_array ) ) {
		if ( ! is_wp_error( $categories_array ) ) {
			foreach ( $categories_array as $cat ) {
				foreach ($medias as $key_item => $item_thumb_id) {
					if ( isset($album_parents[$item_thumb_id]) ) {
						continue;
					}
					if (has_term( $cat->term_id, 'media-category', $item_thumb_id )) {
						if (!isset($categories[$cat->term_id][$cat->name])) {
							$categories[$cat->term_id][$cat->name] = array($item_thumb_id);
						} else {
							array_push($categories[$cat->term_id][$cat->name],$item_thumb_id);
						}
					}
				}
			}
		}
	}
}

/*** init classes ***/

// if ($posts_counter === 1) {
// 		$gutter_size = 'no-gutter';
// }

$general_style = ot_get_option('_uncode_general_style');

if ($type == 'isotope') {
	$main_container_classes[] = 'isotope-system';
	$main_container_classes[] = 'isotope-general-' . $general_style;
	$main_container_classes[] = 'grid-general-' . $general_style;
	$parent_container_classes[] = 'isotope-wrapper grid-wrapper';
	$parent_container_classes[] = $gutter_size;
	$container_classes[] = 'isotope-container';
	$container_classes[] = 'isotope-layout';
	$container_classes[] = 'style-' . $style_preset;
	if ($inner_padding === 'yes') {
		$parent_container_classes[] = 'isotope-inner-padding grid-inner-padding';
	}
	if ($gallery_back_color !== '') {
		$parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
} elseif ($type == 'css_grid') {
	$main_container_classes[] = 'cssgrid-system';
	$main_container_classes[] = 'cssgrid-general-' . $general_style;
	$main_container_classes[] = 'grid-general-' . $general_style;
	$parent_container_classes[] = 'cssgrid-wrapper grid-wrapper';
	$parent_container_classes[] = 'cssgrid-' . $gutter_size;
	$container_classes[] = 'cssgrid-container grid-container';
	$container_classes[] = 'cssgrid-layout';
	if ( $css_grid_equal_height === 'yes' && $single_text === 'under' ) {
		$container_classes[] = 'cssgrid-equal-height';
	}
	$main_container_classes[] = 'cssgrid-' . esc_attr( $uncode_shortcode_id );
	if ($inner_padding === 'yes') {
		$parent_container_classes[] = 'isotope-inner-padding grid-inner-padding';
	}
	if ($gallery_back_color !== '') {
		$parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
	if ( uncode_animations_enabled() && $single_css_animation !== '' ) {
		if ( $single_animation_sequential !== 'no' ) {
			$main_container_classes[] = 'cssgrid-animate-sequential';
		}
	}
	if ( $css_grid_v_align !== '' ) {
		$container_classes[] = 'cssgrid-align-' . $css_grid_v_align;
	}
	if ( function_exists( 'uncode_get_dynamic_css_grids_css_from_shortcode' ) ) {
		$shortcode_data = array(
			'id'       => $uncode_shortcode_id,
			'items'    => $grid_items ? $grid_items : 4,
			'lg'       => $screen_lg_breakpoint ? $screen_lg_breakpoint : 1000,
			'lg_items' => $screen_lg_items ? $screen_lg_items : 3,
			'md'       => $screen_md_breakpoint ? $screen_md_breakpoint : 600,
			'md_items' => $screen_md_items ? $screen_md_items : 2,
			'sm'       => $screen_sm_breakpoint ? $screen_sm_breakpoint : 480,
			'sm_items' => $screen_sm_items ? $screen_sm_items : 1,
		);
		$inline_style_css .= uncode_get_dynamic_css_grids_css_from_shortcode( $shortcode_data );
	}
} elseif ($type == 'justified') {
	$main_container_classes[] = 'justified-system';
	$main_container_classes[] = 'grid-general-' . $general_style;
	$parent_container_classes[] = 'justified-wrapper';
	$parent_container_classes[] = $gutter_size;
	$fixer_classes[] = 'justified-fixer';
	$container_classes[] = 'justified-container';
	$container_classes[] = 'justified-gallery';
	$container_classes[] = 'justified-layout';
	$container_classes[] = 'style-' . $style_preset;
	if ($inner_padding === 'yes') {
		$parent_container_classes[] = 'justified-inner-padding grid-inner-padding';
	}
	if ($gallery_back_color !== '') {
		$parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
} elseif ($type == 'carousel') {
	if ( $advanced_nav === 'yes' ) {
		$carousel_nav = $carousel_nav_mobile = $carousel_dots = $carousel_dots_space = $carousel_dots_mobile = $carousel_dots_inside = $carousel_dot_position = $carousel_dot_padding = '';
	}
	$main_container_classes[] = 'owl-carousel-wrapper';
	if ($carousel_overflow === 'yes') {
		$main_container_classes[] = 'carousel-overflow-visible';
		if ( $carousel_half_opacity === 'yes' ) {
			$main_container_classes[] = 'carousel-not-active-opacity';
		}
		if ( $carousel_scaled === 'yes' ) {
			$main_container_classes[] = 'carousel-scaled';
		}
		if ( $carousel_pointer_events === 'yes' ) {
			$main_container_classes[] = 'carousel-not-clickable';
		}
	}
	if ( $single_animation_first === 'yes' ) {
		$main_container_classes[] = 'carousel-animation-first';
	}
	$parent_container_classes[] = 'owl-carousel-container owl-carousel-loading';
	$parent_container_classes[] = $gutter_size;
	$container_classes[] = 'owl-carousel owl-element';
	if ($nested !== 'yes') {
		$style_preset = 'masonry';
	}
	$images_size = $thumb_size;
	if ($inner_padding === 'yes') {
		$parent_container_classes[] = 'carousel-inner-padding';
	}
	if ($carousel_textual === 'yes') {
		$main_container_classes[] = 'textual-carousel';

		if ($hide_quotes === 'yes') {
			$main_container_classes[] = 'hide-quotes';
		}
	}
	if ($carousel_fluid === 'yes') {
			$main_container_classes[] = 'style-metro';
			$style_preset = 'metro';
	}
	if ($carousel_v_align !== '') {
		$container_classes[] = 'owl-valign-' . $carousel_v_align;
	}
	if ($carousel_height !== '') {
		$container_classes[] = 'owl-height-' . $carousel_height;
	}
	if ($gallery_back_color !== '') {
		$container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
} elseif ($type == 'sticky-scroll') {
	$main_container_classes[] = 'index-scroll';
	if ( $sticky_thumb_size !== 'fluid' && $sticky_thumb_size !== 'relative' ) {
		$sticky_th_size = 'grid';
	} else {
		$sticky_th_size = 'vh';
	}
	$main_container_classes[] = 'index-scroll-width-' . $sticky_th_size;
	$parent_container_classes[] = 'index-wrapper index-scroll-wrapper clearfix';
	$parent_container_classes[] = $gutter_size;
	$container_classes[] = 'index-row';
	if ( $no_sticky_scroll_tablet === 'yes' ) {
		$main_container_classes[] = 'row-scroll-no-md';
	}
	if ( $no_sticky_scroll_mobile === 'yes' ) {
		$main_container_classes[] = 'row-scroll-no-sm';
	}
	if ($gallery_back_color !== '') {
		$parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
	$main_container_classes[] = 'hor-scroll-' . esc_attr( $uncode_shortcode_id );
	if ( $sticky_thumb_size === 'relative' ) {
		$main_container_classes[] = 'hor-scroll-' . esc_attr( $sticky_thumb_size );
		$main_container_classes[] = 'hor-scroll-vh';
		$images_size = $thumb_size = '';
	} else {
		$images_size = $thumb_size = $sticky_thumb_size;
		if ( function_exists('uncode_get_single_dynamic_sticky_scroll_css') ) {
			$shortcode_data = array(
				'size' => esc_attr( $sticky_th_size ),
				'id' => esc_attr( $uncode_shortcode_id ),
				'lg' => intval( $sticky_th_grid_lg ),
				'md' => intval( $sticky_th_grid_md ),
				'sm' => intval( $sticky_th_grid_sm ),
			);
			$inline_style_css .= uncode_get_dynamic_sticky_scroll_css_from_shortcode( $shortcode_data );
		}
	}
	if ( $thumb_size === 'fluid' ){
		$main_container_classes[] = 'hor-scroll-vh';
		$style_preset = 'metro';
	} else {
		$style_preset = 'masonry';
	}
	if ($sticky_scroll_v_align !== '') {
		$main_container_classes[] = 'hor-scroll-valign-' . $sticky_scroll_v_align;
	}
} elseif ($type == 'linear') {
	$main_container_classes[] = 'linear-system';
	$main_container_classes[] = 'linear-' . ( $linear_orientation === '' ? 'horizontal' : 'vertical');
	$main_container_classes[] = 'linear-general-' . $general_style;
	$main_container_classes[] = $size_by === 'height' ? 'linear-by-h' : 'linear-by-w';
	$main_container_classes[] = 'grid-general-' . $general_style;
	if ( $linear_v_alingment !== '' ) {
		$main_container_classes[] = 'linear-v-align-' . $linear_v_alingment;
	}
	if ( $linear_h_alingment !== '' ) {
		$main_container_classes[] = 'linear-h-align-' . $linear_h_alingment;
	}
	$parent_container_classes[] = 'linear-wrapper grid-wrapper';
	$parent_container_classes[] = $gutter_size;
	$container_classes[] = 'linear-container';
	$container_classes[] = 'linear-layout';
	$container_classes[] = 'linear-or-' . ( $linear_orientation === '' ? 'horizontal' : 'vertical');
	$main_container_classes[] = 'lineargrid-' . esc_attr( $uncode_shortcode_id );
	if ( function_exists( 'uncode_get_dynamic_linear_grids_css_from_shortcode' ) ) {
		$shortcode_data = array(
			'id' => $uncode_shortcode_id,
			'by' => $size_by,
			'w' => $linear_width,
			'h' => $linear_height,
		);
		$inline_style_css .= uncode_get_dynamic_linear_grids_css_from_shortcode( $shortcode_data );
	}
} else {
	$main_container_classes[] = 'index-system';
	$main_container_classes[] = $gutter_size;
	$parent_container_classes[] = 'index-wrapper clearfix';
	$parent_container_classes[] = 'style-' . $style_preset;
	$container_classes[] = 'index-row';
	if ($gallery_back_color !== '') {
		$parent_container_classes[] = 'style-'.$gallery_back_color.'-bg';
	}
}

// if ( $infinite === 'yes' )  {
// 	$parent_container_classes[] = 'index-infinite';
// 	if ($infinite_button === 'yes') {
// 		$parent_container_classes[] = 'index-infinite-button';
// 	}
// }

if ( $infinite === 'yes' )  {
	$infinite_selector = $type === 'css_grid' ? 'cssgrid' : 'isotope';
	$container_classes[] = $infinite_selector . '-infinite grid-infinite';
	if ($infinite_button === 'yes') {
		$container_classes[] = $infinite_selector . '-infinite-button grid-infinite-button';
	}
}

if ( $type === 'custom_grid' ) {
	$images_size = $custom_grid_images_size;
} else if ( $type === 'css_grid' || $type === 'linear' ) {
	$images_size = $css_grid_images_size;
}

if ( $skew === 'yes' ) {
	$main_container_classes[] = 'uncode-skew';
}

$general_images_size = $images_size;

$main_container_classes[] = $this->getExtraClass( $el_class );

$media_blocks = uncode_flatArray(vc_sorted_list_parse_value( $media_items ));

/*** data module preparation ***/
$div_data_cont = array();
$div_data = array();
$div_pattern_data = array();
switch ($type) {
	case 'isotope':
			$div_data['data-type'] = $style_preset;
			$div_data['data-layout'] = $isotope_mode;
			$div_data['data-lg'] = $screen_lg;
			$div_data['data-md'] = $screen_md;
			$div_data['data-sm'] = $screen_sm;
			break;
	case 'justified':
			$div_data['data-gutter'] = $gutter_size;
			$div_data['data-row-height'] = $justify_row_height;
			$div_data['data-max-row-height'] = $justify_max_row_height;
			$div_data['data-last-row'] = $justify_last_row;
			break;
	case 'sticky-scroll':
			if ( $sticky_thumb_size !== 'relative' ) {
				$div_data['data-lg'] = $sticky_th_grid_lg;
				$div_data['data-md'] = $sticky_th_grid_md;
				$div_data['data-sm'] = $sticky_th_grid_sm;
			}
			if ( $sticky_dir === 'left' ) {
				$div_data['data-direction'] = 'left';
			} else {
				$div_data['data-direction'] = 'right';
			}
			if ( $sticky_wrap !== '' ) {
				$div_data['data-wrap'] = esc_attr($sticky_wrap);
			}
			if ( $sticky_th_size === 'vh' ) {
				$div_data['data-vp-height'] = $sticky_th_vh_lg;
				$div_data['data-vp-height-md'] = $sticky_th_vh_md;
				$div_data['data-vp-height-sm'] = $sticky_th_vh_sm;
				if ( $sticky_th_vh_minus === 'yes' ) {
					$div_data['data-vp-menu'] = 'true';
				}
			}
			if ( $sticky_scroll_mobile_safe_height === 'yes' ) {
				$div_data['data-safe-height'] = 'true';
			}
			break;
	case 'carousel':
			if ($carousel_type === 'fade') {
				$div_data['data-fade'] = 'true';
			}
			if ($carousel_loop === 'yes' ) {
				$div_data['data-loop'] = 'true';
			}
			if ($carousel_dots === 'yes' || $carousel_dots_mobile === 'yes') {
				if ($carousel_dots_space === 'yes') {
					$container_classes[] = 'owl-dots-db-space';
				}
				if ($carousel_dots_inside === 'yes') {
					$container_classes[] = 'owl-dots-inside';
				} else {
					$container_classes[] = 'owl-dots-outside';
				}

				switch ($carousel_dot_padding) {
			  		case 0:
						$container_classes[] = 'owl-dots-no-block-padding';
						break;
					case 1:
						$container_classes[] = 'owl-dots-half-block-padding';
						break;
					case 2:
					default:
						$container_classes[] = 'owl-dots-single-block-padding';
						break;
					case 3:
						$container_classes[] = 'owl-dots-double-block-padding';
						break;
					case 4:
						$container_classes[] = 'owl-dots-triple-block-padding';
						break;
					case 5:
						$container_classes[] = 'owl-dots-quad-block-padding';
						break;
				}

				$carousel_dot_position = $carousel_dot_position === '' ? 'center' : $carousel_dot_position;
				$container_classes[] = 'owl-dots-align-'.esc_attr($carousel_dot_position);

			}
			if ($carousel_dots === 'yes') {
				$div_data['data-dots'] = 'true';
			}
			if ($carousel_dots_mobile === 'yes') {
				$div_data['data-dotsmobile'] = 'true';
			}
			if ($carousel_nav === 'yes') {
				$div_data['data-nav'] = 'true';
			}
			if ($carousel_nav_mobile === 'yes') {
				$div_data['data-navmobile'] = 'true';
			} else {
				$div_data['data-navmobile'] = 'false';
			}
			if ($carousel_nav === 'yes' || $carousel_nav_mobile === 'yes') {
				$div_data['data-navskin'] = $carousel_nav_skin;
			}
			if ($carousel_navspeed !== '') {
				$div_data['data-navspeed'] = $carousel_navspeed;
			}
			if ((int)$carousel_interval === 0 || $carousel_interval === '' ) {
				$div_data['data-autoplay'] = 'false';
			} else {
				$div_data['data-autoplay'] = 'true';
				$div_data['data-timeout'] = $carousel_interval;
			}
			if ($carousel_autoh === 'yes') {
				$div_data['data-autoheight'] = 'true';
			}
			if ($stage_padding !== '' && $stage_padding !== 0) {
				$div_data['data-stagepadding'] = $stage_padding;
			}

			$carousel_lg = floatval( $carousel_lg );
			$carousel_lg = $carousel_lg > 0 ? $carousel_lg : 3;
			$carousel_md = floatval( $carousel_md );
			$carousel_md = $carousel_md > 0 ? $carousel_md : 3;
			$carousel_sm = floatval( $carousel_sm );
			$carousel_sm = $carousel_sm > 0 ? $carousel_sm : 1;
			$div_data['data-lg'] = $carousel_lg;
			$div_data['data-md'] = $carousel_md;
			$div_data['data-sm'] = $carousel_sm;
	break;
	case 'linear':
		$div_data_cont['data-animation'] = $linear_animation;
		$div_data_cont['data-infinite'] = $linear_animation === 'marquee' || $linear_animation === 'marquee-opposite' ? 'yes' : $marquee_clone;
		$div_data_cont['data-draggable'] = $draggable;
		$div_data_cont['data-speed'] = $linear_speed;
		$div_data_cont['data-hover'] = $linear_hover;
		if ( $marquee_freeze !== '' ) {
			if ( $marquee_freeze_desktop !== '' && $marquee_freeze_mobile !== '' ) {
				$div_data_cont['data-freeze'] = 'always';
			} elseif ( $marquee_freeze_desktop !== '' ) {
				$div_data_cont['data-freeze'] = 'desktop';
			} elseif ( $marquee_freeze_mobile !== '' ) {
				$div_data_cont['data-freeze'] = 'mobile';
			}
		}
		if ( $marquee_blur === 'yes' ) {
			$main_container_classes[] = 'un-marquee-blur';
		}
		break;
}

if ( $lb_video_advanced === 'yes' ) {
	if ( $lb_autoplay !== '' ) {
		$div_pattern_data['data-lb-autoplay'] = $lb_autoplay;
	}
	if ( $lb_muted !== '' ) {
		$div_pattern_data['data-lb-muted'] = $lb_muted;
	}
}

?>
<div<?php if ($type === 'isotope' || $type === 'justified' || $type === 'css_grid') { echo ' id="' . esc_attr($el_id) .'"'; } ?> class="<?php echo esc_attr(trim(implode(' ', $main_container_classes))); ?>">
	<?php if ( $posts_counter > 0 && ( $type === 'isotope' || $type === 'justified' || $type === 'css_grid' )):  ?>
		<?php if ( $filtering === 'yes' ) :
			if (count($categories) > 1) :
				if ($filter_back_color !== '') {
					$filter_background .= ' style-'.$filter_back_color.'-bg with-bg';
				}
				$filters_container_class = array();
				$filters_container_class[] = $gutter_size;
				$filters_container_class[] = $filter_background;

				if ( $filter_mobile === 'yes' ) {
					$filters_container_class[] = 'mobile-hidden tablet-hidden';
				}

				if ( $filter_mobile_dropdown === 'yes' ) {
					$filters_container_class[] = 'mobile-dropdown';
				}

				if ( $filter_scroll === 'yes' ) {
					$filters_container_class[] = 'filter-scroll';
				}

				if ( $inner_padding === 'yes' ) {
					$filters_container_class[] = 'filters-inner-padding';
				}

				if ( $filter_sticky === 'yes' ) {
					$filters_container_class[] = 'sticky-element';
				}

				if ( $filter_typography ) {
					$filters_container_class[] = 'filter-typography-' . $filter_typography;
				}

				if ( $type === 'css_grid' ) {
					$filters_container_class[] = 'cssgrid-filters';
				}
				?>

				<div class="isotope-filters grid-filters menu-container <?php echo esc_attr( implode( ' ', $filters_container_class ) ); ?>">
					<div class="menu-horizontal<?php if ($filtering_full_width !== 'yes') { echo ' limit-width'; } ?> menu-<?php echo esc_attr($filter_style); ?> text-<?php echo esc_attr($filtering_position); ?> text-mobile-<?php echo esc_attr($filter_mobile_align); ?>">
						<?php if ($filter_mobile_dropdown === 'yes') { ?>
							<div class="menu-smart--filter-cats_mobile-toggle desktop-hidden mobile-toggle">
								<a href="#" class="menu-smart--filter-cats_mobile-toggle-trigger mobile-toggle-trigger no-isotope-filter no-grid-filter menu-smart-toggle"><?php echo esc_html( $filter_mobile_dropdown_text !== '' ? esc_html( $filter_mobile_dropdown_text ) : $filter_all_text ); ?></a>
							</div>
						<?php } ?>
						<ul class="menu-smart sm<?php echo esc_attr( ($filtering_uppercase === 'yes') ? ' text-uppercase' : ' no-text-uppercase' ); ?> menu-smart--filter-cats <?php echo esc_attr( $filter_mobile_dropdown === 'yes' ? 'menu-smart--filter-cats-mobile-dropdown ul-mobile-dropdown' : '' ); ?>">
							<?php
								$show_all_class = 'filter-show-all';
								if ($filter_all_opposite === 'yes') {
									if ($filtering_position === 'left') {
										$show_all_class = ' float-right';
									}
									if ($filtering_position === 'right') {
										$show_all_class = ' float-left';
									}
								} ?>
							<li class="<?php echo esc_attr($show_all_class); ?>">
								<span>
									<a href="#" data-filter="*" class="active<?php if ($filtering_uppercase !== 'yes') echo ' no-letterspace'; ?> isotope-nav-link grid-nav-link"><?php
										echo esc_html( $filter_all_text === '' ? __('Show all' , 'uncode') : $filter_all_text );
									?></a>
									</a>
								</span>
							</li>
							<?php
							foreach ( $categories as $key => $cat ): ?>
								<li class="filter-cat-<?php echo esc_attr($key); ?> filter-cat"><span><a href="#" data-filter="grid-cat-<?php echo esc_attr($key); ?>" class="<?php if (isset($_GET['ucat']) && $_GET['ucat'] == $key) { echo 'active'; if ($filtering_uppercase !== 'yes') echo ' no-letterspace'; } ?> isotope-nav-link grid-nav-link"><?php echo esc_attr( key($cat) ) ?></a></span></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php $div_data_cont_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data_cont, array_keys($div_data_cont)); ?>

	<div class="<?php echo esc_attr(trim(implode(' ', $parent_container_classes))); ?>" <?php echo implode(' ', $div_data_cont_attributes); ?>>
		<?php if ($type == 'justified') { ?><div class="<?php echo esc_attr(trim(implode(' ', $fixer_classes))); ?>"><?php } ?>
		<?php
		$div_data = array_merge($div_data, $div_pattern_data);
		$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

		if ( $container_style !== '' ) {
			$container_style = ' style="' . $container_style . '"';
		}
		?>
	<?php $linear_count = 0;
	$linear_class = '';
	$or_id = $el_id;
	if ( $type === 'linear' && ( $marquee_clone === 'yes' || $linear_animation === 'marquee' || $linear_animation === 'marquee-opposite' ) && ( !function_exists('vc_is_page_editable') || !vc_is_page_editable() ) ) { 
		$linear_count = 2;
	}
	for ($x = 0; $x <= $linear_count; $x++) { ?>
		<?php if ( $type === 'linear' ) {
			if ( $x === 0 && $linear_count === 2 && ( !function_exists('vc_is_page_editable') || !vc_is_page_editable() ) ){
				$linear_class = ' first-child';
				$el_id = $or_id . '_first';
			} elseif ( $x === 2 && $linear_count === 2 && ( !function_exists('vc_is_page_editable') || !vc_is_page_editable() ) ){
				$linear_class = ' last-child';
				$el_id = $or_id . '_last';
			} else {
				$linear_class = ' cont-leader';
				$el_id = $or_id;
			}  
		} ?>
		<div<?php if ($type === 'carousel') { echo ' id="' . esc_attr($el_id) .'"'; } ?> class="<?php echo esc_attr(trim(implode(' ', $container_classes)) . $linear_class ); ?>" <?php echo implode(' ', $div_data_attributes); ?><?php echo uncode_switch_stock_string( $container_style ); ?>>
<?php
/**
 * init loop
 */

if (count($medias) > 0) {

	$no_album_counter = 0;
	$i_matrix = 0;

	foreach ($medias as $key_item => $item_thumb_id) {

		$categories_css = '';
		$categories_name = array();
		$categories_id = array();

		$block_data = array();
		$block_data['template'] = 'vc_gallery';
		if ( $type === 'linear' ) {
			$block_data['type'] = 'linear';
		}
		$tmb_data = array();

		if ( $oembed_params !== '' ) {
			$_oembed_params = json_decode($oembed_params, true);
			foreach ($_oembed_params as $param => $pvalue) {
				$block_data[$param] = ($pvalue === 'true' || $pvalue === '1') ? true : $pvalue;
			}
		}

		//pass the album params (array of images)
		if ( isset($detect_albums[$item_thumb_id]) ) {
			$block_data['explode_album'] = $detect_albums[$item_thumb_id];
			if ( isset($album_parents[$item_thumb_id]) ) {
				$block_data['album_id'] = $album_parents[$item_thumb_id];
			}

			if ( $lb_video_advanced === 'yes' ) {
				if ( $lb_autoplay !== '' ) {
					$block_data['data-lb-autoplay'] = $lb_autoplay;
				}
				if ( $lb_muted !== '' ) {
					$block_data['data-lb-muted'] = $lb_muted;
				}
			}
		}

		if ( count($categories) > 1 ) {
			foreach ($categories as $key => $cat) {
				if (in_array($item_thumb_id, $cat[key($cat)]) || ( isset($block_data['album_id']) && in_array($block_data['album_id'], $cat[key($cat)]) ) ) {
					$categories_css.= ' grid-cat-' . $key;
					$categories_name[] = key($cat);
					$categories_id[] = $key;
				}
			}
		}

		if ( $post_matrix === 'matrix' ) {
			$matrix_amount = intval($matrix_amount) == 0 ? 1 : intval($matrix_amount);
			$item_prop_or = $item_prop = (isset($matrix_items[($i_matrix % $matrix_amount) . '_i'])) ? $matrix_items[($i_matrix % $matrix_amount) . '_i'] : array();
		} else if ( ! in_array( 'expand', $detect_albums ) ) {
			$item_prop = (isset($items[$old_medias[$key_item] . '_i'])) ? $items[$old_medias[$key_item] . '_i'] : array();
			$item_prop_or = (isset($items[$item_thumb_id . '_i'])) ? $items[$item_thumb_id . '_i'] : array();
		}

		$typeLayout = $typeLayout_or = $media_blocks;

		if (isset($item_prop['single_layout_media_items'])) {
			if (function_exists('uncode_flatArray')) {
				$typeLayout = uncode_flatArray(vc_sorted_list_parse_value($item_prop['single_layout_media_items']));
			} else {
				$typeLayout = array();
			}
		}

		if (isset($item_prop_or['single_layout_media_items'])) {
			if (function_exists('uncode_flatArray')) {
				$typeLayout_or = uncode_flatArray(vc_sorted_list_parse_value($item_prop_or['single_layout_media_items']));
			} else {
				$typeLayout_or = array();
			}
		}

		// Store single values for CSS Grid, then reset matrix
		if ( $type === 'css_grid' ) {
			$item_prop_single_link    = isset( $item_prop['single_link'] ) ? $item_prop['single_link'] : '';
			$item_prop_or_single_link = isset( $item_prop_or['single_link'] ) ? $item_prop_or['single_link'] : '';
			$item_prop                = array( 'single_link' => $item_prop_single_link );
			$item_prop_or             = array( 'single_link' => $item_prop_or_single_link );
		}

		if (!isset($typeLayout['media'][0]) || $typeLayout['media'][0] === '') $typeLayout['media'][0] = 'lightbox';

		$single_text = (isset($item_prop['single_text'])) ? $item_prop['single_text'] : $general_text;

		if ($type === 'carousel') {
			if ($nested) {
				$block_classes = array('tmb-carousel');
			} else {
				$block_classes = array('tmb tmb-carousel');
			}
		} else {
			$block_classes = array('tmb');
		}

		if ( isset( $off_grid_arr ) && is_array( $off_grid_arr ) && !empty( $off_grid_arr ) && in_array( $key_item % ( 12 / $single_width ), $off_grid_arr ) ) {
			$block_classes[] = 'off-grid-custom-item';
		}

		if (apply_filters( 'uncode_index_no_double_tap', false ) || $no_double_tap === 'yes') {
			$block_classes[] = 'tmb-no-double-tap';
		}

		$title_classes = array();
		$lightbox_classes = array();

		if ( $type === 'css_grid' ) {
			$single_width = uncode_get_css_grid_columns_width( $grid_items );
			$block_classes[] = 'tmb-grid';
		} else if ($type !== 'carousel') {
			$single_width = (isset($item_prop['single_width'])) ? $item_prop['single_width'] : $general_width;
			$block_classes[] = 'tmb-iso-w' . $single_width;
			if ( $single_width == 15 ) {
				$single_width = 3;
			}
		} else {
			if (!$nested) {
				$single_width = floor( ( intval( $col_width ) / 12 ) * ( 1 / intval( $carousel_lg ) ) * 12 );
			}
		}

		$single_height = (isset($item_prop['single_height'])) ? $item_prop['single_height'] : $general_height;
		$block_classes[] = 'tmb-iso-h' . $single_height;

		$images_size = (isset($item_prop['images_size'])) ? $item_prop['images_size'] : $general_images_size;

		if ( $type === 'custom_grid' ) {
			$images_size = (isset($item_prop['custom_grid_images_size'])) ? $item_prop['custom_grid_images_size'] : $general_images_size;
		} else if ( $type === 'css_grid' ) {
			$images_size = $general_images_size;
		}

		$single_back_color = (isset($item_prop['single_back_color'])) ? $item_prop['single_back_color'] : $general_back_color;

		$single_shape = (isset($item_prop['single_shape'])) ? $item_prop['single_shape'] : $general_shape;
		if ($single_shape !== '') {
			$block_classes[] = ($single_back_color === '' || (count($typeLayout) === 1 && array_key_exists('media',$typeLayout))) ? 'img-' . $single_shape : 'tmb-' . $single_shape;
		}

		if ( $single_shape === 'round' && $radius !== '' ) {
			$block_classes[] = 'img-round-' . $radius;
		}

		$single_style = (isset($item_prop['single_style'])) ? $item_prop['single_style'] : $general_iso_style;
		$block_classes[] = 'tmb-' . $single_style;

		$single_overlay_color = (isset($item_prop['single_overlay_color']) && $item_prop['single_overlay_color'] !== '') ? $item_prop['single_overlay_color'] : $general_overlay_color;
		$overlay_style = $stylesArray[!array_search($single_style, $stylesArray) ];

		if ($single_overlay_color === '') {
			if ($overlay_style === 'light') {
				$single_overlay_color = 'light';
			} else {
				$single_overlay_color = 'dark';
			}
		}

		$single_overlay_color = 'style-' . $single_overlay_color .'-bg';

		$single_overlay_coloration = (isset($item_prop['single_overlay_coloration'])) ? $item_prop['single_overlay_coloration'] : $general_overlay_coloration;
		switch ($single_overlay_coloration) {
			case 'top_gradient':
				$block_classes[] = 'tmb-overlay-gradient-top';
			break;
			case 'bottom_gradient':
				$block_classes[] = 'tmb-overlay-gradient-bottom';
			break;
		}

		$single_overlay_opacity = (isset($item_prop['single_overlay_opacity'])) ? $item_prop['single_overlay_opacity'] : $general_overlay_opacity;

		$single_overlay_blend = (isset($item_prop['single_overlay_blend'])) ? $item_prop['single_overlay_blend'] : $general_overlay_blend;

		$single_elements_click = (isset($item_prop['single_elements_click'])) ? $item_prop['single_elements_click'] : $general_elements_click;

		$single_h_align = (isset($item_prop['single_h_align'])) ? $item_prop['single_h_align'] : $general_h_align;

		$single_text_visible = (isset($item_prop['single_text_visible'])) ? $item_prop['single_text_visible'] : $general_text_visible;
		if ($single_text_visible === 'yes') {
			$block_classes[] = 'tmb-text-showed';
		}

		$single_text_anim = (isset($item_prop['single_text_anim'])) ? $item_prop['single_text_anim'] : $general_text_anim;
		if ($single_text_anim === 'yes') {
			$block_classes[] = 'tmb-overlay-text-anim';
		}

		$single_text_anim_type = (isset($item_prop['single_text_anim_type'])) ? $item_prop['single_text_anim_type'] : $general_text_anim_type;
		if ($single_text_anim_type === 'btt') {
			$block_classes[] = 'tmb-reveal-bottom';
		}

		$single_overlay_visible = (isset($item_prop['single_overlay_visible'])) ? $item_prop['single_overlay_visible'] : $general_overlay_visible;
		if ($single_overlay_visible === 'yes') {
			$block_classes[] = 'tmb-overlay-showed';
		}

		$single_overlay_anim = (isset($item_prop['single_overlay_anim'])) ? $item_prop['single_overlay_anim'] : $general_overlay_anim;
		if ($single_overlay_anim === 'yes') {
			$block_classes[] = 'tmb-overlay-anim';
		}

		if ($single_text === 'overlay') {

			$single_h_position = (isset($item_prop['single_h_position'])) ? $item_prop['single_h_position'] : $general_h_position;

			$single_reduced = (isset($item_prop['single_reduced'])) ? $item_prop['single_reduced'] : $general_reduced;
			$single_reduced_mobile = (isset($item_prop['single_reduced_mobile'])) ? $item_prop['single_reduced_mobile'] : $general_reduced_mobile;
			if ($single_reduced !== '') {
				switch ($single_reduced) {
					case 'three_quarter':
						$block_classes[] = 'tmb-overlay-text-reduced';
					break;
					case 'half':
						$block_classes[] = 'tmb-overlay-text-reduced-2';
					break;
					case 'limit-width':
						$block_data['limit-width'] = true;
						break;
				}
				if ($single_h_position !== '') {
					$block_classes[] = 'tmb-overlay-' . $single_h_position;
				}
				if ($single_reduced_mobile !== '') {
					$block_classes[] = 'tmb-overlay-text-wide-sm';
				}
			}

			$single_v_position = (isset($item_prop['single_v_position'])) ? $item_prop['single_v_position'] : $general_v_position;
			if ($single_v_position !== '') {
				$block_classes[] = 'tmb-overlay-' . $single_v_position;
			}
			if ($single_h_align !== '') {
				$block_classes[] = 'tmb-overlay-text-' . $single_h_align;
			}
		} else {
			$block_classes[] = 'tmb-content-' . $single_h_align;
		}

		$single_text_reduced = (isset($item_prop['single_text_reduced'])) ? $item_prop['single_text_reduced'] : $general_text_reduced;
		if ($single_text_reduced === 'yes') {
			$block_classes[] = 'tmb-text-space-reduced';
		}

		$single_image_coloration = (isset($item_prop['single_image_coloration'])) ? $item_prop['single_image_coloration'] : $general_image_coloration;
		if ($single_image_coloration === 'desaturated') {
			$block_classes[] = 'tmb-desaturated';
		}

		$single_image_color_anim = (isset($item_prop['single_image_color_anim'])) ? $item_prop['single_image_color_anim'] : $general_image_color_anim;
		if ($single_image_color_anim === 'yes') {
			$block_classes[] = 'tmb-image-color-anim';
		}

		$single_image_anim = (isset($item_prop['single_image_anim'])) ? $item_prop['single_image_anim'] : $general_image_anim;
		if ($single_image_anim === 'yes') {
			$single_image_magnetic = (isset($item_prop['single_image_magnetic'])) ? $item_prop['single_image_magnetic'] : $general_image_magnetic;
			if ($single_image_magnetic === 'yes') {
				$block_classes[] = 'tmb-image-anim-magnetic';
			} else {
				$block_classes[] = 'tmb-image-anim';
			}
		}

		$single_icon = (isset($item_prop['single_icon'])) ? $item_prop['single_icon'] : $general_icon;

		$single_shadow = (isset($item_prop['single_shadow'])) ? $item_prop['single_shadow'] : $general_shadow;
        $shadow_weight = (isset($item_prop['shadow_weight'])) ? $item_prop['shadow_weight'] : $general_shadow_weight;
        $shadow_darker = (isset($item_prop['shadow_darker'])) ? $item_prop['shadow_darker'] : $general_shadow_darker;
        if ($single_shadow === 'yes') {
			$block_classes[] = 'tmb-shadowed';

			$shadow_out = $shadow_weight;
			if ( $shadow_weight === '' ){
				$shadow_out = 'xs';
			}
			if ( $shadow_darker !== '' ) {
				$shadow_out = 'darker-' . $shadow_out;
			}

			$block_classes[] = 'tmb-media-shadowed-' . $shadow_out;
        }

		$single_border = (isset($item_prop['single_border'])) ? $item_prop['single_border'] : $general_border;
		if ($single_border !== 'yes' && $carousel_textual !== 'yes') {
			$block_classes[] = 'tmb-bordered';
		}

		$single_title_transform = (isset($item_prop['single_title_transform'])) ? $item_prop['single_title_transform'] : $general_title_transform;
		if ($single_title_transform !== '') {
			$block_classes[] = 'tmb-entry-title-' . $single_title_transform;
		}

		$single_title_semantic = (isset($item_prop['single_title_semantic'])) ? $item_prop['single_title_semantic'] : $general_title_semantic;
		if ($single_title_semantic !== '') {
			$block_data['tag'] = $single_title_semantic;
		}

		$single_title_family = (isset($item_prop['single_title_family'])) ? $item_prop['single_title_family'] : $general_title_family;
		if ($single_title_family !== '') {
			$title_classes[] = $single_title_family;
		}

		$single_title_dimension = (isset($item_prop['single_title_dimension'])) ? $item_prop['single_title_dimension'] : $general_title_dimension;
		$heading_custom_size = (isset($item_prop['heading_custom_size'])) ? $item_prop['heading_custom_size'] : $general_title_custom;

		if ($single_title_dimension !== '') {
			$title_classes[] = $single_title_dimension;
			if ( $single_title_dimension === 'custom' && $heading_custom_size !== '' ) {
				if ( $single_title_dimension === 'custom' && isset($item_prop['heading_custom_size']) && isset($item_prop['heading_custom_size']) !== '' ) {
					$block_data['title_style'] = 'font-size:' . $item_prop['heading_custom_size'] . ';';
				} else {
					$title_classes[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
					$inline_style_css .= uncode_get_dynamic_css_font_size_shortcode( array(
						'id'         => $uncode_shortcode_id,
						'font_size'  => $heading_custom_size
					) );
				}
			}
		} else {
			if ($style_preset === 'metro') {
				switch ($single_width) {
					case 1:
					case 2:
						$title_classes[] = 'h6';
					break;
					case 3:
						$title_classes[] = 'h5';
					break;
					case 4:
						$title_classes[] = 'h4';
					break;
					case 6:
					case 7:
					case 8:
						$title_classes[] = 'h3';
					break;
					case 9:
					case 10:
						$title_classes[] = 'h2';
					break;
					case 11:
					case 12:
						$title_classes[] = 'h1';
					break;
				}
			} else {
				$title_classes[] = 'h6';
			}
		}

		$single_title_weight = (isset($item_prop['single_title_weight'])) ? $item_prop['single_title_weight'] : $general_title_weight;
		if ($single_title_weight !== '') {
			$title_classes[] = 'font-weight-' . $single_title_weight;
		}

		$single_title_height = (isset($item_prop['single_title_height'])) ? $item_prop['single_title_height'] : $general_title_height;
		if ($single_title_height !== '') {
			$title_classes[] = $single_title_height;
		}

		$single_title_space = (isset($item_prop['single_title_space'])) ? $item_prop['single_title_space'] : $general_title_space;
		if ($single_title_space !== '') {
			$title_classes[] = $single_title_space;
		}

		$single_title_scale_mobile = (isset($item_prop['single_title_scale_mobile'])) ? $item_prop['single_title_scale_mobile'] : $general_title_scale_mobile;
		if ($single_title_scale_mobile !== 'no') {
			$title_classes[] = 'title-scale';
		}

		$single_text_lead = (isset($item_prop['single_text_lead'])) ? $item_prop['single_text_lead'] : $general_text_lead;
		if ($single_text_lead === 'yes') {
			$block_data['text_lead'] = 'yes';
		} else if ($single_text_lead === 'small') {
			$block_data['text_lead'] = 'small';
		}

		$single_meta_custom_typo = (isset($item_prop['single_meta_custom_typo'])) ? $item_prop['single_meta_custom_typo'] : $general_meta_custom_typo;

		if ( $single_meta_custom_typo === 'yes' ) {

			$single_meta_size = (isset($item_prop['single_meta_size'])) ? $item_prop['single_meta_size'] : $general_meta_size;
			if ( $single_meta_size !== '' ) {
				$block_classes[] = 'tmb-meta-size-' . $single_meta_size;
			}

			$single_meta_weight = (isset($item_prop['single_meta_weight'])) ? $item_prop['single_meta_weight'] : $general_meta_weight;
			if ( $single_meta_weight !== '' ) {
				$block_classes[] = 'tmb-meta-weight-' . $single_meta_weight;
			}

			$single_meta_transform = (isset($item_prop['single_meta_transform'])) ? $item_prop['single_meta_transform'] : $general_meta_transform;
			if ( $single_meta_transform !== '' ) {
				$block_classes[] = 'tmb-meta-transform-' . $single_meta_transform;
			}
		}

		$single_animation_delay = (isset($item_prop['single_animation_delay'])) ? $item_prop['single_animation_delay'] : $general_animation_delay;

		$single_animation_speed = (isset($item_prop['single_animation_speed'])) ? $item_prop['single_animation_speed'] : $general_animation_speed;

		$single_css_animation = (isset($item_prop['single_css_animation'])) ? $item_prop['single_css_animation'] : $general_css_animation;
		if ($single_css_animation !== '' && uncode_animations_enabled()) {
			if ( $single_css_animation === 'parallax' ) {
				$single_parallax_intensity = ( isset( $item_prop['single_parallax_intensity'] ) ) ? $item_prop['single_parallax_intensity'] : $general_parallax_intensity;
				$single_parallax_centered = ( isset( $item_prop['single_parallax_centered'] ) ) ? $item_prop['single_parallax_centered'] : $general_parallax_centered;
				$block_data['parallax'] = $single_parallax_intensity;
				$block_data = array_merge( $block_data, uncode_get_parallax_div_data( $single_parallax_intensity, $single_parallax_centered ) );
			} else {
				$block_data['animation'] = ' animate_when_almost_visible ' . $single_css_animation;
				if ($single_animation_delay !== '') {
					$tmb_data['data-delay'] = $single_animation_delay;
				}
				if ($single_animation_speed !== '') {
					$tmb_data['data-speed'] = $single_animation_speed;
				}
			}
		} else {
			$block_data['animation'] = ' no-anim';
		}

		if ( $custom_cursor !== '' ) {

			$tmb_data['data-cursor'] = 'icon-' . esc_attr( $custom_cursor );

			if ( $cursor_title === 'yes' ) {
				$tmb_data['data-cursor-title'] = 'true';
				if ( $hide_cursor_bg === 'yes' ) {
					$tmb_data['data-cursor-transparent'] = 'true';
				}
				if ($tooltip_class !== '') {
					$tmb_data['data-tooltip-class'] = $tooltip_class;
				}
				if ( $custom_tooltip !== '' ) {
					$tmb_data['data-tooltip-text'] = wp_kses_post( $custom_tooltip );
				}
				if ( $hide_title_tooltip !== '' ) {
					$block_classes[] = 'show-title-' . esc_attr( $hide_title_tooltip );
				} else {
					$block_classes[] = 'hide-title-tooltip';
				}
				if ( $cursor_title_boing !== '' ) {
					$tmb_data['data-cursor-title'] = 'boing';
				}
			}
		}

		$block_classes[] = 'tmb-id-' . $item_thumb_id;

		$block_classes[] = $categories_css;
		$block_data['classes'] = $block_classes;
		$block_data['tmb_data'] = $tmb_data;
		$block_data['media_id'] = apply_filters('uncode_vc_gallery_thumb_id', $item_thumb_id);
		$block_data['images_size'] = $images_size;
		$block_data['single_style'] = $single_style;
		$block_data['single_text'] = $single_text;
		$block_data['single_elements_click'] = $single_elements_click;
		$block_data['overlay_opacity'] = $single_overlay_opacity;
		$block_data['overlay_blend'] = $single_overlay_blend;
		$block_data['overlay_color'] = $single_overlay_color;
		$block_data['single_width'] = $sticky_thumb_size === 'relative' ? '12' : $single_width;
		$block_data['single_height'] = $single_height;
		$block_data['single_back_color'] = $single_back_color;
		$block_data['single_icon'] = $single_icon;
		$block_data['title_classes'] = $title_classes;
		$block_data['single_categories'] = $categories_name;
		$block_data['single_categories_id'] = $categories_id;

		if ( $single_overlay_blend !== '' ) {
			$back_array['mix-blend-mode'] = $single_overlay_blend;
			$previous_blend = true;
		}

		if ($type == 'justified') {
			$block_data['justify_row_height'] = $justify_row_height;
		}

		$block_data['block_gallery_type'] = $type;

		$single_padding = (isset($item_prop['single_padding'])) ? $item_prop['single_padding'] : $general_padding;

		switch ($single_padding) {
			case 0:
				$block_data['text_padding'] = 'no-block-padding';
			break;
			case 1:
				$block_data['text_padding'] = 'half-block-padding';
			break;
			case 2:
			default:
				$block_data['text_padding'] = 'single-block-padding';
			break;
			case 3:
				$block_data['text_padding'] = 'double-block-padding';
			break;
			case 4:
				$block_data['text_padding'] = 'triple-block-padding';
			break;
			case 5:
				$block_data['text_padding'] = 'quad-block-padding';
			break;
		}

		if (isset($typeLayout_or['media'][0]) && $typeLayout_or['media'][0] === 'custom_link') {
			if (isset($item_prop_or['single_link']) && $item_prop_or['single_link'] != '') {
				$block_data['link'] = vc_build_link($item_prop_or['single_link']);
			} else {
				$block_data['link'] = vc_build_link($general_link);
			}
		}
		elseif (isset($typeLayout['media'][0]) && $typeLayout['media'][0] === 'nolink') {
			$block_data['link_class'] = 'inactive-link';
			$block_data['link'] = '#';
		} else {
			if ($lbox_skin !== '') {
				$lightbox_classes['data-skin'] = $lbox_skin;
			}
			if ($lbox_transparency !== '') {
				$lightbox_classes['data-transparency'] = $lbox_transparency;
			}
			if ($lbox_title !== '') {
				$lightbox_classes['data-title'] = true;
			}
			if ($lbox_caption !== '') {
				$lightbox_classes['data-caption'] = true;
			}
			if ($lbox_dir !== '') {
				$lightbox_classes['data-dir'] = $lbox_dir;
			}
			if ($lbox_social !== '') {
				$lightbox_classes['data-social'] = true;
			}
			if ($lbox_deep !== '') {
				$lightbox_classes['data-deep'] = $el_id;
			}
			if ($lbox_no_tmb !== '') {
				$lightbox_classes['data-notmb'] = true;
			}
			if ($lbox_no_arrows !== '') {
				$lightbox_classes['data-noarr'] = true;
			}
			if ($lbox_gallery_arrows !== '') {
				$lightbox_classes['data-arrows'] = $lbox_gallery_arrows;
			}
			if ($lbox_gallery_arrows_bg !== '') {
				$lightbox_classes['data-arrows-bg'] = $lbox_gallery_arrows_bg;
			}
			if ($lbox_zoom_origin !== '') {
				$lightbox_classes['data-zoom-origin'] = true;
			}
			if ($lbox_counter !== '') {
				$lightbox_classes['data-counter'] = true;
			}
			if ($lbox_actual_size !== '') {
				$lightbox_classes['data-actual-size'] = true;
			}
			if ($lbox_full !== '') {
				$lightbox_classes['data-full'] = true;
			}
			if ($lbox_download !== '') {
				$lightbox_classes['data-download'] = true;
			}
			if ( $lbox_transition !== '' ) {
				$lightbox_classes['data-transition'] = esc_attr($lbox_transition);
			}
			if (count($lightbox_classes) === 0) {
				$lightbox_classes['data-active'] = true;
			}
		}

		$block_data['poster'] = false;
		if (isset($typeLayout['media'][1]) && $typeLayout['media'][1] === 'poster') {
			$block_data['poster'] = true;
		}

		$block_data['no-control'] = false;
		if ( $advanced_videos === 'yes' ) {
			$block_data['no-control'] = true;
			$block_data['play_hover'] = $play_hover;
			$block_data['play_pause'] = $play_pause;
			$block_data['mobile_videos'] = $mobile_videos;
		}

		if (isset($typeLayout['icon'][0]) && $typeLayout['icon'][0] !== '') {
			$block_data['icon_size'] = ' t-icon-size-' . $typeLayout['icon'][0];
		}

		if ( isset($block_data['explode_album']) && is_array($block_data['explode_album']) && !empty($block_data['explode_album']) && !apply_filters('uncode_avoid_deep_link', false) ) {//keep album lightbox separated
			$_el_id = $el_id . '_' . $block_data['media_id'];
			$lightbox_classes['data-deep'] = $_el_id;
			$block_data['lb_index'] = 0;
		} else {
			$_el_id = $el_id;
			$block_data['lb_index'] = $no_album_counter;
			$no_album_counter++;
		}

		$block_data['data-lbsplit'] = false;
		if ( apply_filters('uncode_avoid_deep_link', false) ) {
			$_el_id = $el_id . '_' . $block_data['media_id'];
			$block_data['data-lbsplit'] = true;
			unset($block_data['lb_index']);
		}

		// Pass layout type
		$block_data['is_isotope']   = $type === 'isotope' ? true : false;
		$block_data['is_carousel']  = $type === 'carousel' ? true : false;
		$block_data['is_justified'] = $type === 'justified' ? true : false;

		if ( $type === 'custom_grid' && $custom_grid_content_block_id ) {
			$custom_matrix_objects[] = array( 'block_data' => $block_data, 'id' => $_el_id, 'style_preset' => $style_preset, 'layout' => $typeLayout, 'lightbox_classes' => $lightbox_classes, 'carousel_textual' => $carousel_textual, 'with_html' => true );
		} else {
			echo uncode_create_single_block( $block_data, $_el_id, $style_preset, $typeLayout, $lightbox_classes, $carousel_textual );
		}

	$i_matrix++;
	}
} ?>
			</div>
<?php } ?>
			<?php if ($type == 'justified') { ?></div><?php } ?>
		</div>

	<?php if ( $infinite === 'yes' ):
		$page_url = explode("?", get_pagenum_link(1, false));
		$footer_classes = '';
		$footer_background = ' style-' . $footer_style;
		if ($footer_back_color !== '') {
			$footer_background .= ' style-'.$footer_back_color.'-bg with-bg';
		} else {
			$footer_background .= ' without-bg';
		}
		$footer_classes .= $footer_background;
		if ( $infinite === 'yes' || $pagination === 'yes' ) {
			$footer_classes .= ' with-content';
		}
		?>
		<div class="<?php echo esc_attr( $type === 'css_grid' ? 'cssgrid' : $type ); ?>-footer grid-footer<?php echo esc_attr($footer_classes) . ' ' . esc_attr($gutter_size); ?>">
			<?php if ( $infinite === 'yes' && $paginated_medias['max_pages'] != 1 && $paged < $paginated_medias['max_pages'] ): ?>
				<div class="<?php echo esc_attr( $type === 'css_grid' ? 'cssgrid' : $type ); ?>-footer-inner grid-footer-inner<?php if ($footer_full_width !== 'yes') { echo ' limit-width'; ?> menu-<?php echo esc_attr($footer_style); } ?> text-center">
					<nav class="loadmore-button<?php if ($infinite_button === 'icon') { echo ' loadmore-button--icon'; } ?>"<?php if ($infinite_button !== 'yes' && $infinite_button !== 'icon') { echo ' style="display: none;"'; } ?>>
						<?php
						if ($infinite_button_text === '') {
							$infinite_button_text = ($infinite_button === 'yes') ? esc_html__('Load more' , 'uncode') : esc_html__('Loading…' , 'uncode');
						}
						$nextpage = intval($paged) + 1;
						if (isset($page_url[1]) && $page_url[1] !== '') {
							parse_str($page_url[1], $output);
							$output['upage'] = $nextpage;
						} else {
							$output = array('upage' => $nextpage);
						}

						$next_page_url = $page_url[0] . add_query_arg( $output, '?' );

						$load_more_classes = '';
						if ( $infinite_button === 'icon' ) {
							$load_more_classes .= ' loadmore-icon';
						} else {
							$load_more_classes .= ' btn';

							if ($infinite_button_color !== '') {
								$load_more_classes .= ' btn-' . $infinite_button_color;
							} else {
								$load_more_classes .= ' btn-default';
							}
						}

						// Hover effect
						$infinite_hover_fx = $infinite_hover_fx=='' ? ot_get_option('_uncode_button_hover') : $infinite_hover_fx;

						// Outlined and flat classes
						if ( $infinite_button !== 'icon' ) {
							if ( $infinite_hover_fx == '' || $infinite_hover_fx == 'outlined' ) {
								if ($infinite_button_outline === 'yes' ) {
									$load_more_classes .= ' btn-outline';
								}
							} else {
								$load_more_classes .= ' btn-flat';
							}

							if ($infinite_button_shape !== '') {
								$load_more_classes .= ' ' . $infinite_button_shape;
							}
						}
						$load_more_button = '<a data-page="' . esc_attr( $nextpage ) . '" data-pages="' . esc_attr( $paginated_medias['max_pages'] ) .'" href="' . esc_url($next_page_url) . '" class="' . esc_attr( $load_more_classes ) . '" data-label="' . esc_attr($infinite_button_text) . '"><span>' . $infinite_button_text . '</span></a>';
						echo uncode_remove_p_tag($load_more_button);
						?>
					</nav>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php echo uncode_print_dynamic_inline_style( $inline_style_css ); ?>

</div>

<?php
if ( $type === 'custom_grid' && $custom_grid_content_block_id ) {
	ob_end_clean();
	$custom_grid_wrapper_class   = array();
	$custom_grid_wrapper_class[] = $this->getExtraClass( $el_class );
	if ($gallery_back_color !== '') {
		$custom_grid_wrapper_class[] = 'style-'.$gallery_back_color.'-bg';
	}

	$pattern_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_pattern_data, array_keys($div_pattern_data));

	echo '<div class="custom-grid-container uncont ' . esc_attr( trim( implode( ' ', $custom_grid_wrapper_class ) ) ) . '" ' . 'id="' . esc_attr( $el_id ) . '" ' , implode(' ', $pattern_data_attributes) . '>';
	echo uncode_remove_p_tag( uncode_get_custom_grid_output( $custom_matrix_objects, $custom_grid_content_block_id ) );
	echo '</div>';

	echo uncode_print_dynamic_inline_style( $inline_style_css );
}

$uncode_vc_gallery = false;
