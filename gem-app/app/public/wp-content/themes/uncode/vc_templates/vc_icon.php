<?php

global $adaptive_images, $dynamic_srcset_active, $enable_adaptive_dynamic_img;

$title = $heading_semantic = $text_font = $text_size = $text_weight = $text_height = $text_space = $text_lead = $icon = $icon_image = $icon_automatic = $position = $space_reduced = $icon_color = $background_style = $size = $outline = $display = $shadow = $add_margin = $text_reduced = $el_id = $el_class = $link = $link_text = $media_lightbox = $css_animation = $animation_delay = $animation_speed = $background_color = $a_title = $a_target = $a_rel = $lightbox_data = $lightbox_data_title = $title_aligned_icon = $linked_title = $media_size = $lbox_skin = $lbox_transparency = $lbox_dir = $lbox_title = $lbox_caption = $lbox_social = $lbox_deep = $lbox_deep_id = $lbox_no_tmb = $lbox_no_arrows = $lbox_gallery_arrows = $lbox_gallery_arrows_bg = $lbox_zoom_origin = $lbox_connected = $lbox_actual_size = $lbox_full = $lbox_download = $lbox_counter = $lbox_transition = $lb_video_advanced = $lb_autoplay = $lb_muted = '';

$defaults = array(
	'uncode_shortcode_id' => '',
	'title' => '',
	'heading_semantic' => 'h3',
	'text_font' => '',
	'text_size' => 'h3',
	'text_weight' => '',
	'text_height' => '',
	'text_space' => '',
	'icon' => 'fa fa-adjust',
	'icon_image' => '',
	'icon_automatic' => '',
	'position' => 'top',
	'space_reduced' => '',
	'icon_color' => 'default',
	'icon_color_type' => '',
	'icon_color_solid' => '',
	'icon_color_gradient' => '',
	'background_style' => '',
	'size' => 'fa-1x',
	'outline' => '',
	'display' => '',
	'shadow' => '',
	'add_margin' => '',
	'text_lead' => '',
	'text_reduced' => '',
	'el_class' => '',
	'link' => '',
	'link_text' => '',
	'media_lightbox' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'parallax_intensity' => '',
	'parallax_centered' => '',
	'title_aligned_icon' => '',
	'media_size' => '',
	'lbox_skin' => '',
	'lbox_transparency' => '',
	'lbox_dir' => '',
	'lbox_title' => '',
	'lbox_caption' => '',
	'lbox_social' => '',
	'lbox_deep' => '',
	'lbox_deep_id' => '',
	'lbox_no_tmb' => '',
	'lbox_no_arrows' => '',
	'lbox_gallery_arrows' => '',
	'lbox_gallery_arrows_bg' => '',
	'lbox_zoom_origin' => '',
	'lbox_connected' => '',
	'lbox_actual_size' => '',
	'lbox_full' => '',
	'lbox_download' => '',
	'lbox_counter' => '',
	'lbox_transition' => '',
	'lb_video_advanced' => '',
	'lb_autoplay' => '',
	'lb_muted' => ''
);
/** @var array $atts - shortcode attributes */
$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

global $adaptive_images, $adaptive_images_async;

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_icon',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'icon_color'          => $icon_color,
		'icon_color_type'     => $icon_color_type,
		'icon_color_solid'    => $icon_color_solid,
		'icon_color_gradient' => $icon_color_gradient,
	)
) );

$icon_color = uncode_get_shortcode_color_attribute_value( 'icon_color', $uncode_shortcode_id, $icon_color_type, $icon_color, $icon_color_solid, $icon_color_gradient );

// Prepare icon classes
$container_class = array();
$icon_container_class = array();
$title_class = array();
$wrapper_class = array();
$automatic_class = array();
$classes = array();
$div_data = array();
$div_data_attributes = array();

if ($icon_color === '') {
	$icon_color = 'default';
}
if ($position === '') {
	$position = 'top';
}

$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

if ($css_animation !== '' && uncode_animations_enabled()) {
	if ( $css_animation === 'parallax' ) {
		$container_class[] = 'parallax-el';
		$div_data = array_merge( $div_data, uncode_get_parallax_div_data( $parallax_intensity, $parallax_centered ) );
	} else {
		$container_class[] = 'animate_when_almost_visible ' . $css_animation;
		if ($animation_delay !== '') {
			$div_data['data-delay'] = $animation_delay;
		}
		if ($animation_speed !== '') {
			$div_data['data-speed'] = $animation_speed;
		}
	}
}

$container_class[] = 'icon-box';
$container_class[] = 'icon-box-' . $position;
if ( ( $position === 'left' || $position === 'right' ) && $space_reduced === 'yes' ) {
	$container_class[] = 'icon-box-space-reduced';
}
$container_class[] = $css_class;
$icon_container_class[] = 'icon-box-icon fa-container';

if ($display === 'inline') {
	$container_class[] = 'icon-inline';
}

if ($display === 'absolute-center') {
	$container_class[] = 'absolute-center';
}

$classes[] = $icon;

if ( strlen( $background_style ) > 0 ) {
	$has_style = true;
	$wrapper_class[] = 'fa fa-stack';
	$wrapper_class[] = $size;
	$wrapper_class[] = 'btn-' . $icon_color;
	$wrapper_class[] = $background_style;
	if ($outline === 'yes') {
		$wrapper_class[] = 'btn-outline';
	}
	if ( $icon_automatic !== '' ) {
		$wrapper_class[] = 'icon-animated';
		$automatic_class[] = 'icon-animated';
		if ($outline === 'yes') {
			$automatic_class[] = 'btn-outline';
		}
		if ($shadow === 'yes') {
			$automatic_class[] = 'btn-shadow';
		}
		$automatic_class[] = 'btn-' . $icon_color;
	} else {
		if ($shadow === 'yes') {
			$wrapper_class[] = 'btn-shadow';
		}
	}
} else {
	$wrapper_class[] = 'text-' . $icon_color . '-color';
	$classes[] = $size;
	$classes[] = 'fa-fw';
}

$title_class[] = $text_font;
$title_class[] = $text_size;
if ($text_weight !== '') {
	$title_class[] = 'font-weight-' . $text_weight;
}
if ($text_height !== '') {
	$title_class[] = $text_height;
}
if ($text_space !== '') {
	$title_class[] = $text_space;
}


$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
if ($link['title'] !== '') {
	$a_title = ' title="' . esc_attr( $link['title'] ) . '" aria-label="' . esc_attr( $link['title'] ) . '"';
}
if ($link['target'] !== '') {
	$a_target = ' target="' . esc_attr( trim($link['target']) ) . '"';
}
if ($link['rel'] !== '') {
	$a_rel = ' rel="' . esc_attr( trim($link['rel']) ) . '"';
}

$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

if ( $lbox_enhance && $lbox_deep === 'yes' && $lbox_deep_id !== '') {
	$lightbox_id_rand = esc_attr($lbox_deep_id);
} else {
	$lightbox_id_rand = uncode_big_rand();
}

if ($media_lightbox !== '') {

	$media_data = wp_get_attachment_metadata( $media_lightbox );
	$media_meta = isset( $media_data[ 'image_meta' ] ) ? $media_data[ 'image_meta' ] : array();

	$lightbox_classes = array();
	if ($lbox_skin !== '') {
		$lightbox_classes['data-skin'] = $lbox_skin;
	}
	if ($lbox_title !== '') {
		$lightbox_classes['data-title'] = get_the_title($media_lightbox);
	}
	if ($lbox_caption !== '') {
		$lightbox_classes['data-caption'] = get_the_excerpt($media_lightbox);
	}
	if ($lbox_transparency !== '') {
		$lightbox_classes['data-transparency'] = $lbox_transparency;
	}
	if ($lbox_dir !== '') {
		$lightbox_classes['data-dir'] = $lbox_dir;
	}
	if ($lbox_social !== '') {
		$lightbox_classes['data-social'] = true;
	}
	if ($lbox_deep !== '') {
		$lightbox_classes['data-deep'] = $media_lightbox;
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
	if ($lbox_actual_size !== '') {
		$lightbox_classes['data-actual-size'] = true;
	}
	if ($lbox_full !== '') {
		$lightbox_classes['data-full'] = true;
	}
	if ($lbox_download !== '') {
		$lightbox_classes['data-download'] = true;
	}
	if ($lbox_counter !== '') {
		$lightbox_classes['data-counter'] = true;
	}
	if ( $lbox_transition !== '' ) {
		$lightbox_classes['data-transition'] = esc_attr($lbox_transition);
	}
	if ( $lbox_connected !== '' ) {
		$lightbox_classes['data-connect'] = true;
	}
	if (count($lightbox_classes) === 0) {
		$lightbox_classes['data-active'] = true;
	}
	if ($lbox_connected === 'yes') {
		if (!isset($lightbox_id) || $lightbox_id === '') {
			$lightbox_id = $lightbox_id_rand;
		}
		$lbox_id = $lightbox_id;
	} else {
		if ( $lbox_enhance ) {
			$lbox_id = $lightbox_id_rand;
		} else {
			$lbox_id = $media_lightbox;
		}
	}

	if ( get_post_mime_type($media_lightbox) == 'oembed/gallery' && wp_get_post_parent_id($media_lightbox) ) {

		$parent_id = wp_get_post_parent_id($media_lightbox);
		$media_album_ids = get_post_meta($parent_id, '_uncode_featured_media', true);//string of images in the album
		$media_album_ids_arr = explode(',', $media_album_ids);//array of images in the album
		$a_href = '#';
		$media_album = '';
		$media_dimensions = '';//it will stay empty
		$album_item_dimensions = '';
		$inline_hidden = '';

		foreach ($media_album_ids_arr as $_key => $_value) {
			$album_item_attributes = uncode_get_album_item($_value);
			$album_th_id = $album_item_attributes['poster'];
			if ( $album_th_id == '' ) {
				continue;
			}
			$thumb_attributes = uncode_get_media_info($album_th_id);
			$album_th_metavalues = unserialize($thumb_attributes->metadata);

			if ( !isset($album_th_metavalues['width']) || !isset($album_th_metavalues['height']) ) {
				continue;
			}

			$album_th_w = $album_th_metavalues['width'];
			$album_th_h = $album_th_metavalues['height'];
			if ($album_item_attributes) {
				$album_item_title = (isset($lightbox_classes['data-title']) && $lightbox_classes['data-title'] === true) ? $album_item_attributes['title'] : '';
				$album_item_caption = (isset($lightbox_classes['data-caption']) && $lightbox_classes['data-caption'] === true) ? $album_item_attributes['caption'] : '';
				if (isset($album_item_attributes['width']) && isset($album_item_attributes['height'])) {
					$album_item_dimensions .= '{';
					if ( ! $lbox_enhance ) {
						$album_item_dimensions .= '"title":"' . esc_attr($album_item_title) . '",';
						$album_item_dimensions .= '"caption":"' . esc_html($album_item_caption) . '",';
					} else {
						$subHtml = '';
						if ( $album_item_title !== '' ) {
							$subHtml .= '<h6>' . esc_attr($album_item_title) . '</h6>';
						}
						if ( $album_item_caption !== '' ) {
							$subHtml .= '<p>' . esc_html($album_item_caption) . '</p>';
						}
						if ( $subHtml !== '' ) {
							$album_item_dimensions .= '"subHtml":"' . $subHtml . '",';
						}
					}
					//$album_item_dimensions .= '"post_mime_type":"' . esc_attr($album_item_attributes['mime_type']) . '",';

					if (
						$album_item_attributes['mime_type'] === 'oembed/iframe'
						||
						$album_item_attributes['mime_type'] === 'oembed/vimeo' && uncode_privacy_allow_content( 'vimeo' ) === false
						||
						$album_item_attributes['mime_type'] === 'oembed/youtube' && uncode_privacy_allow_content( 'youtube' ) === false
						||
						$album_item_attributes['mime_type'] === 'oembed/spotify' && uncode_privacy_allow_content( 'spotify' ) === false
						||
						$album_item_attributes['mime_type'] === 'oembed/soundcloud' && uncode_privacy_allow_content( 'soundcloud' ) === false
					) {
						$poster_th_id = $album_th_id;
						$poster_attributes = uncode_get_media_info($poster_th_id);
						$poster_metavalues = unserialize($poster_attributes->metadata);
						$album_item_dimensions .= '"width":"' . esc_attr($poster_metavalues['width']) . '",';
						$album_item_dimensions .= '"height":"' . esc_attr($poster_metavalues['height']) . '",';
						$resize_album_item = wp_get_attachment_image_src($poster_th_id, 'medium');
						$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
						$album_item_dimensions .= '"url":"' . esc_attr('#inline-' . $el_id . '-' . $album_th_id) . '","type":"inline"';
						$inline_hidden .= '<div id="inline-' . esc_attr( $el_id . '-' . $album_th_id ) . '" class="ilightbox-html" style="display: none;">' . $album_item_attributes['url'] . '</div>';
						if ( $lb_video_advanced === 'yes' ) {
							if ( $lb_autoplay !== '' ) {
								$inline_hidden = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-autoplay="' . $lb_autoplay . '"', $inline_hidden);
							}
							if ( $lb_muted !== '' ) {
								$inline_hidden = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-muted="' . $lb_muted . '"', $inline_hidden);
							}
						}
						apply_filters( 'uncode_before_checking_consent', true, $album_item_attributes['mime_type'] );
					} else {
						if (
							$album_item_attributes['mime_type'] === 'oembed/vimeo'
							||
							$album_item_attributes['mime_type'] === 'oembed/youtube'
							||
							$album_item_attributes['mime_type'] === 'oembed/spotify'
							||
							$album_item_attributes['mime_type'] === 'oembed/soundcloud'
							||
							strpos( $album_item_attributes['mime_type'], 'video/' ) !== false
						) {
							$poster_th_id = $album_th_id;
							$poster_attributes = uncode_get_media_info($poster_th_id);
							$poster_metavalues = unserialize($poster_attributes->metadata);
							$resize_album_item = wp_get_attachment_image_src($poster_th_id, 'medium');
							if ( $lbox_enhance ) {
								$album_item_dimensions .= '"thumb":"' . esc_url($resize_album_item[0]) . '",';
							} else {
								$album_item_dimensions .= '"width":"' . esc_attr($poster_metavalues['width']) . '",';
								$album_item_dimensions .= '"height":"' . esc_attr($poster_metavalues['height']) . '",';
								$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
							}
						} else {
							$resize_album_item = wp_get_attachment_image_src($thumb_attributes->id, 'medium');
							if ( $lbox_enhance ) {
								$album_item_dimensions .= '"thumb":"' . esc_url($resize_album_item[0]) . '",';
							} else {
								$album_item_dimensions .= '"width":"' . esc_attr($album_item_attributes['width']) . '",';
								$album_item_dimensions .= '"height":"' . esc_attr($album_item_attributes['height']) . '",';
								$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
							}
						}

						if ( $lbox_enhance ) {
							if ( $album_item_attributes['mime_type'] === 'video/mp4' ) {
								$album_item_dimensions .= '"video":{"source":[{"src":"' . esc_url($album_item_attributes['url']) . '","type":"video/mp4"}],"attributes":{"preload":"false","controls":"true"}}';
							} else {
								$album_item_dimensions .= '"src":"' . esc_url($album_item_attributes['url']) . '"';
							}
						} else {
							$album_item_dimensions .= '"url":"' . esc_url($album_item_attributes['url']) . '"';
						}
					}
					$album_item_dimensions .= '}';
				}
			}

			if ( $_key+1 < count($media_album_ids_arr) ) {
				$album_item_dimensions .= ',';
			}
		}

		$lightbox_data .= ' data-album=\'[' . $album_item_dimensions . ']\'';

		$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $lightbox_classes, array_keys($lightbox_classes));

	} else {

		$media_attributes = uncode_get_media_info($media_lightbox);
		if (isset($media_attributes)) {
			$media_metavalues = unserialize($media_attributes->metadata);
			$media_mime = $media_attributes->post_mime_type;
			$media_dimensions = '';
			$video_src = $video_enhanced = '';
			if (isset($media_metavalues['width']) && isset($media_metavalues['height'])) {
				$media_dimensions = 'width:' . $media_metavalues['width'] . ',';
				$media_dimensions .= 'height:' . $media_metavalues['height'] . ',';
			}
			if (strpos($media_mime, 'image/') !== false && $media_mime !== 'image/url' && isset($media_metavalues['width']) && isset($media_metavalues['height'])) {
				$image_orig_w = $media_metavalues['width'];
				$image_orig_h = $media_metavalues['height'];
				if ($adaptive_images === 'on') {
					$adaptive_images = 'off';
					$big_image = uncode_resize_image($media_attributes->id, $media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
					$adaptive_images = 'on';
				} else {
					$big_image = uncode_resize_image($media_attributes->id, $media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
				}

				$a_href = $big_image['url'];
			} elseif ($media_mime === 'oembed/iframe') {
				$lightbox_classes['data-type'] = 'inline';
				$a_href = '#inline-' . $media_lightbox;
				$media_string = '<div id="inline-' . esc_attr( $media_lightbox ) . '" class="ilightbox-html" style="display: none;">' . $media_attributes->post_content . '</div>';
				if ( $lb_video_advanced === 'yes' ) {
					if ( $lb_autoplay !== '' ) {
						$media_string = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-autoplay="' . $lb_autoplay . '"', $media_string);
					}
					if ( $lb_muted !== '' ) {
						$media_string = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-muted="' . $lb_muted . '"', $media_string);
					}
				}
				echo uncode_switch_stock_string( $media_string );
			} else {
				if ($media_mime === 'image/url') {
					$a_href = $media_attributes->guid;
				} else {
					$media_oembed = uncode_get_oembed($media_lightbox, $media_attributes->guid, $media_attributes->post_mime_type, false, $media_attributes->post_excerpt, $media_attributes->post_content, true);
					$consent_id = str_replace( 'oembed/', '', $media_mime );
					if ( uncode_privacy_allow_content( $consent_id ) === false ) {
	    				$a_href = '#inline-' . esc_attr( $media_lightbox ) . '" data-type="inline" target="#inline' . esc_attr( $media_lightbox );
	    				$inline_hidden = '<div id="inline-' . esc_attr( $media_lightbox ) . '" class="ilightbox-html" style="display: none;">' . $media_oembed['code'] . '</div>';
						if ( $lb_video_advanced === 'yes' ) {
							if ( $lb_autoplay !== '' ) {
								$inline_hidden = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-autoplay="' . $lb_autoplay . '"', $inline_hidden);
							}
							if ( $lb_muted !== '' ) {
								$inline_hidden = preg_replace("/ class=\"(.*?)\"/", ' class="$1" data-lb-muted="' . $lb_muted . '"', $inline_hidden);
							}
						}
						$poster_th_id = get_post_meta($media_lightbox, "_uncode_poster_image", true);
						$poster_attributes = uncode_get_media_info($poster_th_id);
						if ( is_object($poster_attributes) ) {
							$poster_metavalues = unserialize($poster_attributes->metadata);
							$media_dimensions = 'width:' . esc_attr($poster_metavalues['width']) . ',';
							$media_dimensions .= 'height:' . esc_attr($poster_metavalues['height']) . ',';
						}
	    			} elseif ($media_mime === 'oembed/html' || $media_mime === 'oembed/iframe') {
						$frame_id = 'frame-' . uncode_big_rand();
						$a_href = '#' . $frame_id;
						echo '<div id="' . esc_attr( $frame_id ) . '" style="display: none;">' . $media_attributes->post_content . '</div>';
					} else {
						$a_href = $media_oembed['code'];
					}
				}
			}

			if (isset($media_attributes->post_mime_type) && strpos($media_attributes->post_mime_type, 'video/') !== false) {
				$video_src .= 'html5video:{preload:\'true\',';
				$video_autoplay = get_post_meta($media_lightbox, "_uncode_video_autoplay", true);
				if ($video_autoplay) {
					$video_src .= 'autoplay:\'true\',';
					$video_enhanced .= ' data-autoplay="true"';
				}
				$video_loop = get_post_meta($media_lightbox, "_uncode_video_loop", true);
				if ($video_loop) {
					$video_src .= 'loop:\'true\',';
					$video_enhanced .= ' data-loop="true"';
				}
				$alt_videos = get_post_meta($media_lightbox, "_uncode_video_alternative", true);
				if (!empty($alt_videos)) {
					foreach ($alt_videos as $key => $value) {
						$exloded_url = explode(".", strtolower($value));
						$ext = end($exloded_url);
						if ($ext !== '') {
							$video_src .= $ext . ":'" . $value."',";
						}
					}
				}
				$video_src .= '},';
			}

			if (count($lightbox_classes) === 0) {
				$lightbox_classes['data-active'] = true;
			}

			$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $lightbox_classes, array_keys($lightbox_classes));

		}

		$th_size = $lbox_enhance ? 'thumbnail' : 'medium';
		$poster_th_id = get_post_meta($media_lightbox, "_uncode_poster_image", true);
		$poster_attributes = uncode_get_media_info($poster_th_id);
		if ( isset($poster_attributes->id) ) {
			$data_options_th = wp_get_attachment_image_src($poster_attributes->id, $th_size);
		} else {
			if ( isset($media_attributes->id) ) {
				$data_options_th = wp_get_attachment_image_src($media_attributes->id, $th_size);
			}
		}

		if ( $lbox_enhance ) {
			if ( isset( $media_attributes->post_mime_type ) ) {
				if ( $media_attributes->post_mime_type !== 'oembed/flickr' && isset( $data_options_th[0] ) ) {
					$lightbox_data .= ' data-external-thumb-image="'. $data_options_th[0] .'"';
				}
				if ( $media_attributes->post_mime_type === 'video/mp4' ) {
					$lightbox_data .= 'data-video=\'{"source": [{"src":"' . $a_href . '", "type":"video/mp4"}]}\' data-icon="video"';
				} elseif ( $media_attributes->post_mime_type === 'oembed/youtube' || $media_attributes->post_mime_type === 'oembed/vimeo' ) {
					$lightbox_data .= 'data-icon="video"';
				} elseif ( $media_attributes->post_mime_type === 'oembed/spotify' || $media_attributes->post_mime_type === 'oembed/soundcloud' ) {
					$lightbox_data .= 'data-src="' . $a_href . '" data-iframe="true"';
				}
			}
			if ( isset( $video_enhanced ) ) {
				$lightbox_data .= $video_enhanced;
			}
			if ( isset($media_metavalues['width']) && isset($media_metavalues['height']) ) {
				$lightbox_data .= ' data-lg-size="' . $media_metavalues['width'] . '-' . $media_metavalues['height'] . '"';
			}
		} else {
			$lightbox_data .= ' data-options="' . esc_attr( $media_dimensions . $video_src ) . '"';
		}

	}

	$lightbox_data .= ' ' . implode(' ', $div_data_attributes);

	$lightbox_data = ' data-lbox="ilightbox_single-' . uncode_big_rand() . '"' . $lightbox_data;
	$lightbox_data_title = ' data-lbox="ilightbox_single-' . uncode_big_rand() . '"' . $lightbox_data;
}

if ($a_href === '') {
	$wrapper_class[] = 'btn-disable-hover';
}

// Prepare text area
$output_text = '';
$icon_box_size = ' icon-box-'.$size.((strlen( $background_style ) > 0) ? '-back' : '');
$icon_box_size = $title_aligned_icon == '' ? $icon_box_size : '';
if ($title !== '') {
	if ( $a_href !== '' && $linked_title !== '' ) {
		$title = '<a href="'. $a_href.'"'.$a_title.$a_target.$a_rel.$lightbox_data_title.'>' . $title . '</a>';
	}
	$output_text .= '<div class="icon-box-heading' . esc_attr( $icon_box_size ) . '"><' . esc_attr( $heading_semantic ) . ' class="' . esc_attr(trim(implode(' ', $title_class))) . '">' . $title . '</' . esc_attr( $heading_semantic ) . '></div>';
}

$content_stripped = strip_tags($content, '<p>');

$text_classes = ( $text_reduced === 'yes' ) ? 'text-top-reduced ' : '';
$text_classes .= ( $text_lead === 'yes' ) ? 'text-lead ' : '';
$text_classes .= ( $text_lead === 'small' ) ? 'text-small ' : '';

if ( $content_stripped === $content ) {
	if ( trim( $content ) !== '' && $content_stripped === $content ) {
		$content = trim( nl2br( $content ) );
		if ($add_margin === 'yes') {
			$add_margin = ' add-margin';
		} else {
			$add_margin = '';
		}

		if (strpos($content,'<p') !== false) {
			if ($text_classes !== '') {
				$content = preg_replace('/<p/', '<p class="' . esc_attr( trim($text_classes) ) . '"', $content, 1);
			}
			$output_text .= uncode_remove_p_tag($content, true);
		} else {
			if ($text_classes !== '') {
				$content = uncode_remove_p_tag($content, true);
				$content = preg_replace('/<p/', '<p class="' . esc_attr( trim($text_classes) ) . '"', $content, 1);
				$output_text .= $content;
			} else {
				$output_text .= uncode_remove_p_tag($content, true);
			}
		}
	}

} else {
	if (strpos($content,'<p') !== false) {
		if ($text_classes !== '') {
			$content = preg_replace('/<p/', '<p class="' . esc_attr( trim($text_classes) ) . '"', $content, 1);
		}
	} else {
		if ($text_classes !== '') {
			$content = uncode_remove_p_tag($content, true);
			$content = preg_replace('/<p/', '<p class="' . esc_attr( trim($text_classes) ) . '"', $content, 1);
		}
	}

	if ( $text_classes !== '' && apply_filters( 'uncode_vc_icon_format_with_html', false ) ) {
		$output_text .= '<div class="' . esc_attr( trim($text_classes) ) . '">' . uncode_remove_p_tag($content, true) . '</div>';
	} else {
		$output_text .= uncode_remove_p_tag($content, true);
	}
}

if ($link_text !== '' && $a_href !== '') {
	$output_text .= '<p class="text-bold"><a class="btn btn-link" href="'. $a_href.'"'.$a_title.$a_target.$a_rel.'>' . $link_text . '</a></p>' ;
}

if ($output_text !== '') {
	$output_text = '<div class="icon-box-content' . esc_attr( $add_margin ) . '">' . $output_text . '</div>';
}

// Prepare icon area
if ($position === 'right' || $position === 'left') {
	$media_size = floatval( $media_size ) == 0 ? 50 : $media_size;
} else {
	$media_size = floatval( $media_size ) == 0 ? '' : $media_size;
}
$icon_container_style = ( $media_size !== '' && floatval( $media_size ) != 0 && $icon_image !== '' ) ? 'width:' . floatval( $media_size ) . 'px;' : '';
$icon_container_style .= ( $content === '' && $title === '' ) ? 'margin-bottom: 0px;' : '';
$icon_container_style = $icon_container_style !== '' ? ' style="' . $icon_container_style . '"' : '';

$href_att = ' href="'. $a_href . '"';
if ( $lbox_enhance ) {
	if ( $media_lightbox && isset($media_attributes) ) {
		if ( $media_attributes->post_mime_type === 'video/mp4' ) {
			$href_att = '';
		}
	}
}

$tag_start = ($a_href !== '') ? 'a'. $href_att . $a_title . $a_target . $a_rel . $lightbox_data : 'span';
$tag_end = ($a_href !== '') ? 'a' : 'span';
$output_icon = '';
$output_icon = '<div class="'.esc_attr(trim(implode(' ', $icon_container_class))).'"' . $icon_container_style . $el_id . '>';
if ($a_href !== '') {
	$wrapper_class[] = 'custom-link';
}
$output_icon .=	'<'.$tag_start.' class="' . esc_attr(implode(' ', $wrapper_class)) . '">';
if ($icon_image === '') {
	if ( $icon_automatic !== '' ) {
		$output_icon .=	'<span class="icon-automatic-video icon-automatic-' . $size . ' ' . esc_attr(implode(' ', $automatic_class)) . '"><span class="icon-automatic-video-inner-bg"></span><span class="icon-automatic-video-outer-bg"></span></span>';
	}
	$output_icon .=	'<i class="' . esc_attr(trim(implode(' ', $classes))) . '"></i>';
} else {
	$block_data = array();
	$lightbox_classes = array();
	$block_data['template'] = 'vc_icon';
	$block_data['media_id'] = $icon_image;
	$block_data['single_width'] = 12;
	if (isset($div_data['data-delay']) && $div_data['data-delay'] !== '') {
		$block_data['delay'] = $animation_delay;
	}
	$media_code = uncode_create_single_block($block_data, rand(), 'masonry', '', $lightbox_classes, false, false);
	$media_alt = (isset($media_code['alt'])) ? $media_code['alt'] : '';

	if ( $icon_automatic !== '' ) {
		$output_icon .= $media_code['code'];
		if ($position === 'right' || $position === 'left') {
			if (strpos($media_code['code'], 'style="width:100%"') !== false) {
				$container_class[] = 'icon-expand';
			}
		}
	} elseif ($media_code['type'] === 'image') {
		$container_class[] = 'icon-media-image';
		if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img && isset( $media_code['async'] ) ) {
			$class = isset( $media_code['async']['class'] ) ? $media_code['async']['class'] : '';
			$async_data = isset( $media_code['async']['data'] ) ? $media_code['async']['data'] : '';
		} else {
			$class = '';
			$async_data = '';
		}
		$output_icon .= '<img class="' . esc_attr( $class ) . '" src="' . esc_attr( $media_code['code'] ) .'" width="' . esc_attr( $media_code['width'] ) .'" height="' . esc_attr( $media_code['height'] ) .'" alt="' . esc_attr( $media_alt ) . '" ' . $async_data . ' />';
	} else {
		$output_icon .= $media_code['code'];
		if ($position === 'right' || $position === 'left') {
			if (strpos($media_code['code'], 'style="width:100%"') !== false) {
				$container_class[] = 'icon-expand';
			}
		}
	}
}
$output_icon .=	'</'.$tag_end.'>';
$output_icon .='</div>';

if ( $lb_video_advanced === 'yes' ) {
	if ( $lb_autoplay !== '' ) {
		$div_data['data-lb-autoplay'] = $lb_autoplay;
	}
	if ( $lb_muted !== '' ) {
		$div_data['data-lb-muted'] = $lb_muted;
	}
}
$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

if ( isset( $inline_hidden ) && $inline_hidden !== '' ) {
	echo uncode_switch_stock_string( $inline_hidden );
}

$output ='<div class="' . esc_attr(trim(implode(' ', $container_class))) . '" ' . implode(' ', $div_data_attributes) . '>';
switch ($position) {
	case 'bottom':
	case 'right':
		$output .= $output_text . $output_icon;
		break;
	default:
		$output .= $output_icon . $output_text;
		break;
}
$output .= uncode_print_dynamic_inline_style( $inline_style_css );
$output .='</div>';

echo uncode_switch_stock_string( $output );
