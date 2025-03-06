<?php

/**
 * Build background HTML
 */
if (!function_exists('uncode_get_back_html')) {
	function uncode_get_back_html($background = array() , $overlay_color = '', $overlay_color_alpha = '', $overlay_pattern = '', $type = '', $multi = false)
	{

		global $front_background_colors, $adaptive_images, $adaptive_images_async, $dynamic_srcset_active, $dynamic_srcset_bg_mobile_size, $activate_webp, $enable_adaptive_dynamic_bg;

		$back_color = $back_url = $back_repeat = $back_position = $back_attachment = $back_size = $background_mime = $background_url = $header_background_video = $header_background_selfvideo = $back_mime_css = $back_html = $content_html = $carousel_html = $overlay_html = $adaptive_async_data = $adaptive_async_class = '';
		$poster_id = $is_carousel = $content_only_text = $back_attributes = $do_bg_replace = false;
		if (!empty($background['background-image'])) {
			$media_ids = explode(',', $background['background-image']);
			if (count($media_ids) === 1) {
				$back_attributes = uncode_get_media_info($background['background-image']);
				if (isset($back_attributes->post_mime_type)) {
					$background_mime = $back_attributes->post_mime_type;
				}

				$back_repeat = (isset($background['background-repeat']) && $background['background-repeat'] !== '') ? 'background-repeat: ' . $background['background-repeat'] . ';' : '';
				$back_position = (isset($background['background-position']) && $background['background-position'] !== '') ? 'background-position: ' . $background['background-position'] . ';' : '';
				$back_attachment = (isset($background['background-attachment']) && $background['background-attachment'] !== '') ? 'background-attachment: ' . $background['background-attachment'] . ';' : '';
				$back_size = (isset($background['background-size']) && $background['background-size'] !== '') ? 'background-size: ' . $background['background-size'] . ';' : '';

				$consent_id = str_replace( 'oembed/', '', $background_mime );
				uncode_privacy_check_needed( $consent_id );

				if ( wp_is_mobile() && ( $background_mime === 'oembed/vimeo' || $background_mime === 'oembed/youtube' ) ) {
					$background_mime = 'mobile_no_video';
				}

				$background_mobile_attr = '';
				if (strpos($background_mime, 'video/') !== false) {
					$video_mobile = get_post_meta($back_attributes->id, "_uncode_video_mobile_bg", true);
					if ( !$video_mobile && wp_is_mobile() ) {
						$background_mime = 'mobile_no_video';
					} else {
						$background_mobile_attr = 'playsinline ';
					}
				}

				if (strpos($background_mime, 'image/') !== false) {
					$back_metavalues = unserialize($back_attributes->metadata);
					$image_orig_w = isset( $back_metavalues['width'] ) ? $back_metavalues['width'] : 1;
					$image_orig_h = isset( $back_metavalues['height'] ) ? $back_metavalues['height'] : 1;
					if ($background_mime === 'image/gif' || $background_mime === 'image/url') {
						$background_url = $back_attributes->guid;
					} else {
						$resized_back = uncode_resize_image($back_attributes->id, $back_attributes->guid, $back_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
						$background_url = $resized_back['url'];
						$background_url = $background_url && $back_attributes->id ? apply_filters( 'wp_get_attachment_url', $background_url, $back_attributes->id)  : $background_url;
					}
					if ( $background_mime !== 'image/gif' && $background_mime !== 'image/url' ) {
						// Backgrounds in headers and rows
						if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
							$adaptive_async_class = uncode_get_adaptive_async_class();
							if ( $adaptive_async_class ) {
								$adaptive_async_data = uncode_get_adaptive_async_data( $background['background-image'], $back_attributes, $image_orig_w, $image_orig_h, 12, 'null', '' );
							}
						} else if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg ) {
							$adaptive_async_data_all = uncode_get_srcset_bg_async_data( $dynamic_srcset_bg_mobile_size, $back_attributes, $resized_back, $image_orig_w, $image_orig_h, array( 'activate_webp' => $activate_webp ) );
							$adaptive_async_data     = $adaptive_async_data_all['string'];
							$do_bg_replace           = $adaptive_async_data_all['do_replace'];
							$adaptive_async_class    = uncode_get_srcset_bg_async_class( $adaptive_async_data_all );
						}
					}
					if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) {
						$back_url = '';
					} else {
						$back_url = ($background_url != '') ? 'background-image: url(' . str_replace(' ', '%20', $background_url) . ');' : '';
					}
				} elseif (strpos($background_mime, 'video/') !== false) {
					$poster = get_post_meta($background['background-image'], "_uncode_poster_image", true);
					if ($poster !== '') {
						$poster_attributes = uncode_get_media_info($poster);
						$media_metavalues = unserialize($poster_attributes->metadata);
						$image_orig_w = $media_metavalues['width'];
						$image_orig_h = $media_metavalues['height'];
						$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
						$poster_url = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
						if (isset($poster_attributes->post_mime_type)) {
							$background_mime = $poster_attributes->post_mime_type;
						}
						if (strpos($background_mime, 'image/') !== false) {
							$background_url = $poster_url;
							$background_url = $background_url && $poster_attributes->id ? apply_filters( 'wp_get_attachment_url', $background_url, $poster_attributes->id)  : $background_url;
							if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) {
								$back_url = '';
							} else {
								$back_url = ($background_url != '') ? 'background-image: url(' . $background_url . ');' : '';
							}
						} else {
							$back_oembed = wp_oembed_get($poster_attributes->guid);
							preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
							if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) {
								$back_url = '';
							} else {
								$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
							}
						}
						$poster_id = $background['background-image'];
						if ( $background_mime !== 'image/gif' && $background_mime !== 'image/url' ) {
							// Poster for videos in row backgrounds
							if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
								$adaptive_async_class = uncode_get_adaptive_async_class();
								if ( $adaptive_async_class ) {
									$adaptive_async_data = uncode_get_adaptive_async_data( $poster_id, $poster_attributes, $image_orig_w, $image_orig_h, 12, 'null', '' );
								}
							} else if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg ) {
								$adaptive_async_data_all = uncode_get_srcset_bg_async_data( $dynamic_srcset_bg_mobile_size, $poster_attributes, $resized_image, $image_orig_w, $image_orig_h, array( 'activate_webp' => $activate_webp ) );
								$adaptive_async_data     = $adaptive_async_data_all['string'];
								$do_bg_replace           = $adaptive_async_data_all['do_replace'];
								$adaptive_async_class    = uncode_get_srcset_bg_async_class( $adaptive_async_data_all );
							}
						}
					}

					$videos = array();
					$exloded_url = explode(".", strtolower($back_attributes->guid));
					$ext = end($exloded_url);
					$videos[(String) $ext] = $back_attributes->guid;
					$alt_videos = get_post_meta($background['background-image'], "_uncode_video_alternative", true);

					if (!empty($alt_videos)) {
						foreach ($alt_videos as $key => $value) {
							$value = apply_filters( 'uncode_self_video_src', $value );
							$exloded_url = explode(".", strtolower($value));
							$ext = end($exloded_url);
							$videos[(String) $ext] = $value;
						}
					} else {
						$videos = array(
							'src' => '"' . $back_attributes->guid . '"'
						);
					}

					$video_src = '';
					foreach ($videos as $key => $value) {
						$value = apply_filters( 'uncode_self_video_src', $value );
						$video_src.= ' ' . $key . '=' . $value;
					}

					$back_mime_css = ' self-video uncode-video-container';

					$header_background_selfvideo = do_shortcode('[video' . $video_src . ' class="background-video-shortcode"]');
					$header_background_selfvideo = str_replace('controls="controls"','', $header_background_selfvideo);
					$header_background_selfvideo = str_replace('<video','<video onloadeddata="this.play();" loop '. $background_mobile_attr . 'muted', $header_background_selfvideo);

					$get_video_meta = unserialize($back_attributes->metadata);
					$get_video_meta = unserialize($back_attributes->metadata);
					$get_video_w = (int) $get_video_meta['width'];
					$get_video_w = !$get_video_w ? 16 : $get_video_w;
					$get_video_h = (int) $get_video_meta['height'];
					$get_video_h = !$get_video_h ? 9 : $get_video_h;
					$video_ratio = $get_video_w / $get_video_h;
					$header_background_selfvideo = str_replace('class="background-video-shortcode"','class="background-video-shortcode" data-ratio="'.$video_ratio.'"', $header_background_selfvideo);
				} else {
					switch ($background_mime) {
						case 'oembed/flickr':
						case 'oembed/Imgur':
						case 'oembed/photobucket':
							$back_oembed = wp_oembed_get($back_attributes->guid);
							preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
							$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
							if ($background_mime === 'oembed/flickr') {
								$back_url = str_replace(array('_n.','_z.'), '_b.', $back_url);
							}
							$background_url = $back_url;
							$background_mime = 'image';
						break;
						case 'oembed/vimeo':
						case 'oembed/youtube':
							$back_metavalues = unserialize($back_attributes->metadata);
							$video_orig_w = absint($back_metavalues['width']);
							$video_orig_h = absint($back_metavalues['height']);
							$video_ratio = ($video_orig_h === 0) ? 1.777 : $video_orig_w / $video_orig_h;
							$parse_video_url = parse_url(html_entity_decode($back_attributes->guid));
							$video_url = strtok($back_attributes->guid, '?');
							if (isset($parse_video_url['query'])) {
								parse_str($parse_video_url['query'], $query_params);
								if (isset($query_params) && count($query_params) > 0) {
									foreach ($query_params as $key => $value) {
										$header_background_video .= ' data-' . $key . '="' . $value . '"';
									}
									if ($background_mime === 'oembed/youtube' && isset($query_params['v'])) {
										$video_url = 'https://youtu.be/' . $query_params['v'];
									}
								}
							}

							$header_background_video .= ' data-ignore data-ratio="'.$video_ratio.'" data-provider="'.($background_mime === 'oembed/vimeo' ? 'vimeo' : 'youtube' ).'" data-video="' . $video_url . '" data-id="' . rand(10000, 99999) . '"';

							//Check for consent and replace with poster image in case
							if (
								( uncode_privacy_allow_content( 'youtube' ) === false && $background_mime === 'oembed/youtube' )
								||
								( uncode_privacy_allow_content( 'vimeo' ) === false && $background_mime === 'oembed/vimeo' )
							) {
								$back_mime_css = '';
								$back_url_id = get_post_meta($back_attributes->id, "_uncode_poster_image", true);
								if ( $back_url_id ) {
									$back_url = 'background-image: url(' . wp_get_attachment_url($back_url_id) . ');';
								}
							} else {
								$back_mime_css = ' video uncode-video-container';
							}

						break;
						case 'oembed/soundcloud':
							$url = $back_attributes->guid;
							$accent_color = $front_background_colors['accent'];
							$accent_color = str_replace('#', '', $accent_color);
							$getValues = wp_remote_fopen('http://soundcloud.com/oembed?format=js&url=' . $url . '&iframe=true');
							$decodeiFrame = substr($getValues, 1, -2);
							$decodeiFrame = json_decode($decodeiFrame);
							preg_match('/src="([^"]+)"/', $decodeiFrame->html, $iframe_src);
							$iframe_url = str_replace('visual=true', 'visual=false', $iframe_src[1]);
							if ( uncode_privacy_allow_content( 'soundcloud' ) === false ) {
								$content_html = '';
								$back_url_id = get_post_meta($back_attributes->id, "_uncode_poster_image", true);
								if ( $back_url_id ) {
									$back_url = 'background-image: url(' . wp_get_attachment_url($back_url_id) . ');';
								}
							} else {
								$content_html = '<iframe width="100%" scrolling="no" frameborder="no" src="' . $iframe_url . '&color='.$accent_color.'&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"></iframe>';
							}
						break;
						case 'oembed/twitter':
							$url = 'https://api.twitter.com/1/statuses/oembed.json?id=' . basename($back_attributes->guid);
							$json = wp_remote_fopen($url);
							$json_data = json_decode($json, true);
							$id = basename($json_data['url']);
							$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $json_data['html']);
							$html = str_replace("&mdash; ", '', $html);
							if (function_exists('mb_encode_numericentity')) {
								$html = mb_encode_numericentity( $html, [0x80, 0x10FFFF, 0, ~0], 'UTF-8' );
							}
							$dom = new domDocument;
							$dom->loadHTML($html);
							$dom->preserveWhiteSpace = false;
							$twitter_content = $dom->getElementsByTagname('blockquote');
							$twitter_blockquote = '';
							$twitter_footer = '';
							foreach ($twitter_content as $item) {
								$twitter_content_inner = $item->getElementsByTagname('p');
								foreach ($twitter_content_inner as $item_inner) {
									foreach ($item_inner->childNodes as $child) {
										$twitter_blockquote .= $child->ownerDocument->saveXML( $child );
									}
									$item_inner->parentNode->removeChild($item_inner);
								}
								foreach ($item->childNodes as $child) {
									$twitter_footer .= $child->ownerDocument->saveXML( $child );
								}
								$item->parentNode->removeChild($item);
							}
							$content_html = 	'<div class="twitter-item">
																	<div class="twitter-item-data">
																		<blockquote class="tweet-text pullquote">
																			<p>' . $twitter_blockquote . '</p>';
							$content_html .= 				'<p class="twitter-footer"><small>' . $twitter_footer . '</small></p>';
							$content_html .= 			'</blockquote>
																	</div>
																</div>';
							$poster = get_post_meta($background['background-image'], "_uncode_poster_image", true);
							if ($poster !== '') {
								$poster_attributes = uncode_get_media_info($poster);
								$media_metavalues = unserialize($poster_attributes->metadata);
								$image_orig_w = $media_metavalues['width'];
								$image_orig_h = $media_metavalues['height'];
								$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
								$poster_url = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
								if (isset($poster_attributes->post_mime_type)) {
									$background_mime = $poster_attributes->post_mime_type;
								}
								if (strpos($background_mime, 'image/') !== false) {
									$background_url = $poster_url;
									$background_url = $background_url && $poster_attributes->id ? apply_filters( 'wp_get_attachment_url', $background_url, $poster_attributes->id)  : $background_url;
									$back_url = ($background_url !== '') ? 'background-image: url(' . $background_url . ');' : '';
								} else {
									$back_oembed = wp_oembed_get($poster_attributes->guid);
									preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
									$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
								}
								$poster_id = $background['background-image'];
							}
							$content_only_text = true;
						break;
						case 'oembed/html':
							if (isset($back_attributes->post_excerpt) && $back_attributes->post_excerpt !== '') {
								$author = '<p><small>' . $back_attributes->post_excerpt . '</small></p>';
							} else {
								$author = '';
							}
							$content_html = '<blockquote class="pullquote"><p>' . $back_attributes->post_content . '</p>' . $author . '</blockquote>';
							$poster = get_post_meta($background['background-image'], "_uncode_poster_image", true);
							if ($poster !== '') {
								$poster_attributes = uncode_get_media_info($poster);
								$media_metavalues = unserialize($poster_attributes->metadata);
								$image_orig_w = $media_metavalues['width'];
								$image_orig_h = $media_metavalues['height'];
								$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
								$poster_url = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
								if (isset($poster_attributes->post_mime_type)) {
									$background_mime = $poster_attributes->post_mime_type;
								}
								if (strpos($background_mime, 'image/') !== false) {
									$background_url = $poster_url;
									$background_url = $background_url && $poster_attributes->id ? apply_filters( 'wp_get_attachment_url', $background_url, $poster_attributes->id)  : $background_url;
									$back_url = ($background_url !== '') ? 'background-image: url(' . $background_url . ');' : '';
								} else {
									$back_oembed = wp_oembed_get($poster_attributes->guid);
									preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
									$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
								}
								$poster_id = $background['background-image'];
							}
							$content_only_text = true;
						break;
						case 'oembed/svg':
							$content_html = $back_attributes->post_content;
							$content_html = preg_replace('#\s(xmlns)="([^"]+)"#', '', $content_html);
							$content_html = preg_replace('#\s(xmlns:svg)="([^"]+)"#', '', $content_html);
							$content_html = preg_replace('#\s(xmlns:xlink)="([^"]+)"#', '', $content_html);
						break;
						case 'oembed/iframe':
							$content_html = $back_attributes->post_content;
						break;
						default:
							if (strpos($background_mime, 'audio/') !== false) {
								$content_html = do_shortcode('[audio src="' . $back_attributes->guid . '"]');
							} elseif ($background_mime === 'oembed/spotify') {
								if ( uncode_privacy_allow_content( 'spotify' ) === false ) {
									$content_html = '';
									$back_url_id = get_post_meta($back_attributes->id, "_uncode_poster_image", true);
									if ( $back_url_id ) {
										$back_url = 'background-image: url(' . wp_get_attachment_url($back_url_id) . ');';
									}
								} else {
									$content_html = wp_oembed_get($back_attributes->guid);
								}
							}
							$poster = get_post_meta($background['background-image'], "_uncode_poster_image", true);
							if ($poster !== '') {
								$poster_attributes = uncode_get_media_info($poster);
								$media_metavalues = unserialize($poster_attributes->metadata);
								$image_orig_w = $media_metavalues['width'];
								$image_orig_h = $media_metavalues['height'];
								$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, '', false);
								$poster_url = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
								if (isset($poster_attributes->post_mime_type)) {
									$background_mime = $poster_attributes->post_mime_type;
								}
								if (strpos($background_mime, 'image/') !== false) {
									$background_url = $poster_url;
									$background_url = $background_url && $poster_attributes->id ? apply_filters( 'wp_get_attachment_url', $background_url, $poster_attributes->id)  : $background_url;
									if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) {
										$back_url = '';
									} else {
										$back_url = ($background_url != '') ? 'background-image: url(' . $background_url . ');' : '';
									}
								} else {
									$back_oembed = wp_oembed_get($poster_attributes->guid);
									preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
									if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) {
										$back_url = '';
									} else {
										$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
									}
								}
								$poster_id = $background['background-image'];
								if ( $background_mime !== 'image/gif' && $background_mime !== 'image/url' ) {
									if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
										$adaptive_async_class = uncode_get_adaptive_async_class();
										if ( $adaptive_async_class ) {
											$adaptive_async_data = uncode_get_adaptive_async_data( $poster_id, $poster_attributes, $image_orig_w, $image_orig_h, 12, 'null', '' );
										}
									} else if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg ) {
										$adaptive_async_data_all = uncode_get_srcset_bg_async_data( $dynamic_srcset_bg_mobile_size, $poster_attributes, $resized_image, $image_orig_w, $image_orig_h, array( 'activate_webp' => $activate_webp ) );
										$adaptive_async_data     = $adaptive_async_data_all['string'];
										$do_bg_replace           = $adaptive_async_data_all['do_replace'];
										$adaptive_async_class    = uncode_get_srcset_bg_async_class( $adaptive_async_data_all );
									}
								}
							}
						break;
					}
				}
			} else {
				$carousel_html = do_shortcode('[vc_gallery el_id="gallery-'.rand().'" medias="'.$background['background-image'].'" type="carousel" style_preset="metro" single_padding="0" carousel_fluid="yes" carousel_lg="1" carousel_md="1" carousel_sm="1" gutter_size="0" media_items="media" carousel_interval="0" carousel_dots="yes" carousel_autoh="no" carousel_type="fade" carousel_nav="no" carousel_dots_inside="yes" single_text="overlay" single_border="yes" single_width="12" single_height="12" single_text_visible="no" single_text_anim="no" single_overlay_visible="no" single_overlay_anim="no" single_image_anim="no"]');
				$is_carousel = true;
			}
		}

		if (isset($background['background-color']) && $background['background-color'] !== '') {
			$back_color = ' style-' . $background['background-color'] . '-bg';
		}

		if ($overlay_color !== '') {
			$overlay_color = ' style-' . $overlay_color . '-bg';
		}

		$overlay_animated_noise = '';
		$noise_bgs = 0;
		if ( ( isset($background['overlay-animated-1']) && $background['overlay-animated-1'] !== '' ) || ( isset($background['overlay-animated-2']) && $background['overlay-animated-2'] !== '' ) ) {
			if ( isset($background['overlay-animated-1']) && $background['overlay-animated-1'] !== '' ) {
				$noise_bgs++;
				$overlay_animated_noise .= ' data-bg-noise-' . $noise_bgs . '="' . $background['overlay-animated-1'] . '"';
			}
			if ( isset($background['overlay-animated-2']) && $background['overlay-animated-2'] !== '' ) {
				$noise_bgs++;
				$overlay_animated_noise .= ' data-bg-noise-' . $noise_bgs . '="' . $background['overlay-animated-2'] . '"';
			}
			if ( isset($background['overlay-animated-speed']) && $background['overlay-animated-speed'] !== '' ) {
				$overlay_animated_noise .= ' data-bg-noise-speed="' . $background['overlay-animated-speed'] . '"';
			}
			if ( isset($background['overlay-animated-size']) && $background['overlay-animated-size'] !== '' ) {
				$overlay_animated_noise .= ' data-bg-noise-size="' . $background['overlay-animated-size'] . '"';
			}
		}

		$overlay_color_alpha_css = $overlay_color_alpha;

		if ($overlay_color_alpha !== '' && ($overlay_color !== '' || $noise_bgs > 0)) {
			$overlay_color_alpha = ' style="opacity: ' . ($overlay_color_alpha / 100) . ';"';
		} else {
			$overlay_color_alpha = '';
		}
		if ( isset($background['mix-blend-mode']) && $background['mix-blend-mode']!=='' ){
			$overlay_color_alpha_blend = ' style="mix-blend-mode:' . $background['mix-blend-mode'] . ';';
			// if ($overlay_color_alpha_css !== '') {
			// 	$overlay_color_alpha_blend .= 'opacity: ' . ($overlay_color_alpha_css / 100) . ';';
			// }
			$overlay_color_alpha_blend .= '"';
		} else {
			$overlay_color_alpha_blend = $overlay_color_alpha;
		}
		if (!empty($overlay_pattern)) {
			$overlay_pattern = ' uncode-' . $overlay_pattern;
		}

		$back_image = ($back_url != '' || $back_repeat != '' || $back_position != '' || $back_attachment != '' || $back_size != '') ? ' style="' . $back_url . $back_repeat . $back_position . $back_attachment . $back_size . '"' : '';
		if ( $overlay_color !== '' || $overlay_animated_noise !== '' ) {
			$overlay_html = '<div class="block-bg-overlay' . $overlay_color . '"' . $overlay_color_alpha . $overlay_animated_noise . '>';
			if ( $overlay_animated_noise !== '' ) {
				$overlay_html .= '<span class="uncode-canvas-bg-noise-wrap"></span>';
			}
			$overlay_html .= '</div>';
			if ( isset($background['mix-blend-mode']) && $background['mix-blend-mode']!=='' ){
				$overlay_html = '<div class="block-bg-overlay block-bg-blend-mode for-ie' . $overlay_color . '"' . $overlay_color_alpha . '></div>';
				$overlay_html .= '<div class="block-bg-overlay block-bg-blend-mode not-ie' . $overlay_color . '"' . $overlay_color_alpha_blend . $overlay_animated_noise . '>';
				if ( $overlay_animated_noise !== '' ) {
					$overlay_html .= '<span class="uncode-canvas-bg-noise-wrap"></span>';
				}
				$overlay_html .= '</div>';
			}
		}

		$wrap_bg_class = '';
		if ( $multi !== false ) {
			$wrap_bg_class = ' ' . esc_html( $multi );
		}

		if ($type === 'row') {
			$back_html = '<div class="row-background background-element' . $wrap_bg_class . '"'.(($back_mime_css === '' && $header_background_video === '' && $back_image === '' && $header_background_selfvideo === '' && $content_html === '') ? ' style="opacity: 1;"' : '').'>
											<div class="background-wrapper">
												<div class="background-inner' . $back_mime_css . $adaptive_async_class . '"' . $header_background_video . $back_image . $adaptive_async_data . '>' . $header_background_selfvideo . $content_html . '</div>
												'.$overlay_html.'
											</div>
										</div>';
		} elseif ($type === 'column') {
			$data_o_src = $back_attributes && $back_attributes->guid !== '' ? ' data-o_src="' . $back_attributes->guid . '"' : '';
			$back_html = '<div class="column-background background-element' . $wrap_bg_class . '"'.(($back_mime_css === '' && $header_background_video === '' && $back_image === '' && $header_background_selfvideo === '' && $content_html === '') ? ' style="opacity: 1;"' : '').'>
											<div class="background-wrapper">
												<div class="background-inner' . $back_mime_css . $adaptive_async_class . '"' . $header_background_video . $back_image . $adaptive_async_data . $data_o_src . '>' . $header_background_selfvideo . $content_html . '</div>
												'.$overlay_html.'
											</div>
										</div>';
		} elseif ($type === 'div') {
			if ($header_background_video !== '' || $back_image !== '' || $header_background_selfvideo !== '' || $content_html !== '') {
				$back_html = '<div class="main-background background-element' . $wrap_bg_class . '">
												<div class="' . $back_mime_css . $adaptive_async_class . '"' . $header_background_video . $back_image . $adaptive_async_data . '>' . $header_background_selfvideo . $content_html . '</div>
											</div>';
			}
		} elseif ($type === 'multi' || $type === 'multi-hidden' ) {
			$back_html = '<div class="multi-background background-element' . ($type === 'multi' ? ' multi-show' : '' ) . ' ">
											<div class="background-wrapper">
												<div class="background-inner' . $back_mime_css . $adaptive_async_class . '"' . $header_background_video . $back_image . $adaptive_async_data . '>' . $header_background_selfvideo . $content_html . '</div>
											</div>
										</div>';
		} else {
			if ( $overlay_html !== '' || $header_background_video !== '' || $back_image !== '' || $header_background_selfvideo !== '' || $carousel_html !== '' || ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg && $do_bg_replace ) ) {
				$back_html = 	'<div class="header-bg-wrapper' . ($carousel_html !=='' ? ' header-carousel-wrapper' : '') . $wrap_bg_class . '">
											<div class="header-bg' . $back_mime_css . $adaptive_async_class . '"' . $header_background_video . $back_image . $adaptive_async_data . '>' . $header_background_selfvideo . $carousel_html . '</div>
											'.$overlay_html.'
										</div>';
			}
		}

		return array(
			'back_color' => $back_color,
			'back_html' => $back_html,
			'content_html' => $content_html,
			'content_only_text' => $content_only_text,
			'back_url' => $background_url,
			'poster_id' => $poster_id,
			'is_carousel' => $is_carousel,
			'mime' => $background_mime,
			'async_class' => $adaptive_async_class,
			'async_data' => $adaptive_async_data,
		);
	}
}

/**
 * Row template
 */
if (!function_exists('uncode_get_row_template')) {
	function uncode_get_row_template($content, $limit_width, $limit_content_width, $style, $row_class = '', $padding_top = true, $padding_lr = true, $padding_bottom = true, $row_style = '') {

		if ($content === '') {
			return;
		}

		if (!$padding_top) {
			$row_padding_top = ' no-top-padding';
		} elseif ($padding_top === 'quad') {
			$row_padding_top = ' quad-top-padding';
		} elseif ($padding_top === 'triple') {
			$row_padding_top = ' triple-top-padding';
		} elseif ($padding_top === 'double') {
			$row_padding_top = ' double-top-padding';
		} elseif ($padding_top === 'std') {
			$row_padding_top = ' std-top-padding';
		} else {
			$row_padding_top = '';
		}

		if (!$padding_lr) {
			$row_padding_lr = ' no-h-padding';
		} else {
			$row_padding_lr = '';
		}

		if (!$padding_bottom) {
			$row_padding_bottom = ' no-bottom-padding';
		} elseif ($padding_bottom === 'quad') {
			$row_padding_bottom = ' quad-bottom-padding';
		} elseif ($padding_bottom === 'triple') {
			$row_padding_bottom = ' triple-bottom-padding';
		} elseif ($padding_bottom === 'double') {
			$row_padding_bottom = ' double-bottom-padding';
		} elseif ($padding_bottom === 'std') {
			$row_padding_bottom = ' std-bottom-padding';
		} else {
			$row_padding_bottom = '';
		}

		if ( function_exists('vc_is_page_editable') && vc_is_page_editable() && $row_class == 'page_editable' ) {
			return $content;
		} else {
			return 	'<div class="row-container'.$limit_width.$row_class.'">
		  					<div class="row row-parent style-'.$style.$limit_content_width.$row_padding_top.$row_padding_lr.$row_padding_bottom.'"'.$row_style.'>
									'.$content.'
								</div>
							</div>';
		}
	}
}

/**
 * Thumbnail HTML creation, base for index and other components
 * @param  [type]  $block_data
 * @param  [type]  $el_id
 * @param  [type]  $style_preset
 * @param  [type]  $layout
 * @param  [type]  $lightbox_classes
 * @param  [type]  $carousel_textual
 * @param  boolean $with_html
 * @return [type]
 */
if (!function_exists('uncode_create_single_block')) {
	function uncode_create_single_block($block_data, $el_id, $style_preset, $layout, $lightbox_classes, $carousel_textual, $with_html = true, $is_default_product_content = false)
	{
		global $adaptive_images, $adaptive_images_async, $dynamic_srcset_active, $dynamic_srcset_sizes, $post, $activate_webp, $enable_adaptive_dynamic_img, $enable_adaptive_dynamic_bg, $dynamic_srcset_bg_mobile_size;

		$image_orig_w = $image_orig_h = $crop = $item_media = $media_code = $media_mime = $create_link = $title_link = $media_attributes = $big_image = $lightbox_data = $single_height = $single_fixed = $single_title = $nested = $media_poster = $dummy_oembed = $images_size = $single_family = $object_class = $single_back_color = $single_animation = $is_product = $single_icon = $icon_size = $single_text = $single_image_size = $single_style = $single_elements_click = $single_secondary = $overlay_color = $overlay_opacity = $overlay_blend = $adaptive_async_class = $adaptive_async_data = $sep_extra = $but_media_poster = $data_lb = '';
		$tmb_data_parent = $tmb_data = array();
		$media_type = 'image';
		$multiple_items = $lightbox_code = false;

		$block_data = apply_filters( 'uncode_elements_block_data', $block_data, $el_id, $style_preset, $layout, $lightbox_classes, $carousel_textual, $with_html, $is_default_product_content );

		$is_tax_block = isset( $block_data['is_tax_block'] ) && $block_data['is_tax_block'] ? true : false;

		$is_titles = isset( $block_data['is_titles'] ) && $block_data['is_titles'] === true;
		$is_table = isset( $block_data['is_table'] ) && $block_data['is_table'] === true;

		$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

		$or_post = $post;
		if ( isset($block_data['id'])) {
			$post = get_post($block_data['id']);
		}

		if (isset($block_data['media_id'])) {
			$item_thumb_id = apply_filters('wpml_object_id', $block_data['media_id'], 'attachment');
			if ($item_thumb_id === '' || empty($item_thumb_id)) {
				$item_thumb_id = $block_data['media_id'];
			}
		}

		$parent_id = isset( $block_data['parent_id'] ) ? $block_data['parent_id'] : false;
		$block_data_id = isset( $block_data['id'] ) ? $block_data['id'] : $item_thumb_id;
		$item_thumb_id = apply_filters( 'uncode_single_block_thumb_id', $item_thumb_id, $block_data_id, $parent_id);

		if (isset($block_data['classes'])) {
			$block_classes = $block_data['classes'];
		}
		if (isset($block_data['tmb_data_parent'])) {
			$tmb_data_parent = $block_data['tmb_data_parent'];
		}
		if (isset($block_data['drop_classes'])) {
			$drop_classes = $block_data['drop_classes'];
		}
		if (isset($block_data['tmb_data'])) {
			$tmb_data = $block_data['tmb_data'];
		}
		if (isset($block_data['images_size'])) {
			$images_size = $block_data['images_size'];
		}
		if (isset($block_data['single_style'])) {
			$single_style = $block_data['single_style'];
		}
		if (isset($block_data['single_text'])) {
			$single_text = $block_data['single_text'];
		}
		if (isset($block_data['single_image_size'])) {
			$single_image_size = $block_data['single_image_size'];
		}
		if (isset($block_data['single_elements_click'])) {
			$single_elements_click = $block_data['single_elements_click'];
		}
		if (isset($block_data['single_secondary'])) {
			$single_secondary = $block_data['single_secondary'];
		}
		if (isset($block_data['overlay_color'])) {
			$overlay_color = $block_data['overlay_color'];
		}
		if (isset($block_data['overlay_opacity'])) {
			$overlay_opacity = ' style="opacity: ' . ((int) ($block_data['overlay_opacity'])) / 100 . ';"';
		}
		if (isset($block_data['overlay_blend']) && $block_data['overlay_blend']!=='' ) {
			$overlay_blend = ' style="mix-blend-mode: ' . esc_attr( $block_data['overlay_blend'] ) . ';"';
			$overlay_opacity = '';
		}
		if (isset($block_data['single_width'])) {
			$single_width = $block_data['single_width'];
		} else {
			$single_width = 12;
		}
		if (isset($block_data['single_height'])) {
			$single_height = $block_data['single_height'];
		}
		if (isset($block_data['single_back_color'])) {
			$single_back_color = $block_data['single_back_color'];
		}
		if (isset($block_data['single_title'])) {
			$single_title = $block_data['single_title'];
			$single_title = apply_filters( 'uncode_single_block_title', $single_title, $block_data['id'], $parent_id);
		}
		if (isset($block_data['single_icon'])) {
			$single_icon = $block_data['single_icon'];
		}
		if (isset($block_data['icon_size'])) {
			$icon_size = $block_data['icon_size'];
		}
		if (isset($block_data['no-control'])) {
			$oembed_no_control = $block_data['no-control'];
		}
		if (isset($block_data['mobile_videos'])) {
			$oembed_mobile_videos = $block_data['mobile_videos'];
		}
		if (isset($block_data['poster']) || (isset( $oembed_no_control ) && $oembed_no_control === true) ) {
			if ( isset( $oembed_mobile_videos ) && $oembed_mobile_videos === '' ) {
				$media_poster = true;
				$but_media_poster = $block_data['poster'];
			} else {
				if ( isset($block_data['poster']) ) {
					$media_poster = $but_media_poster = $block_data['poster'];
				}
			}
			if ( $media_poster ) {
				$item_thumb_id = explode(',', $item_thumb_id);
				$item_thumb_id = $item_thumb_id[0];
			}
		}

		if (!isset($block_data['template'])) {
			$block_data['template'] = '';
		}

		$title_classes = array();
		if (isset($block_data['title_classes'])) {
			$title_classes = (!$block_data['title_classes']) ? array('h3') : $block_data['title_classes'];
		}
		$title_style = '';
		if (isset($block_data['title_style'])) {
			$title_style = (!$block_data['title_style']) ? '' : ' style="' . $block_data['title_style'] . '"';
		}
		if (uncode_animations_enabled() && isset($block_data['animation'])) {
			$single_animation = $block_data['animation'];
			if ( ot_get_option( '_uncode_dynamic_srcset_lazy_animations' ) == 'on' && $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img && $single_animation !== '' ) {
				$single_animation .= ' srcset-lazy-animations';
			}
		}

		if (!isset($block_classes)) {
			$block_classes = array();

		}

		$is_product = false;

		if ( class_exists( 'WooCommerce' ) && isset( $block_data['product'] ) && $block_data['product'] === true ) {
			global $product;
			$or_product = $product;

			$product = wc_get_product( $block_data['id'] );

			if ( $product ) {
				$is_product = true;
			}
		}

		if ( ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product && class_exists( 'Woo_Variation_Swatches_Pro' ) ) {
			$block_classes[] = esc_attr( implode( ' ', wc_get_product_class( '', $product->get_id() ) ) );
		}

		$single_fixed = (isset($block_data['single_fixed'])) ? $block_data['single_fixed'] : null;

		if (isset($block_data['link'])) {
			$create_link = is_array($block_data['link']) ? $block_data['link']['url'] : $block_data['link'];
			$title_link = $read_more_link = $create_link;
		}

		$a_classes = array();
		if (isset($block_data['link_class'])) {
			$a_classes[] = $block_data['link_class'];
		}

		/*** MEDIA SECTION ***/
		if ( isset($images_size) && $images_size !== '' && $style_preset !== 'metro' && !$is_table ) {
			switch ($images_size) {
				case ('one-one'):
					$single_height = $single_width;
					break;

				case ('ten-three'):
					$single_height = $single_width / (10 / 3);
					break;

				case ('four-three'):
					$single_height = $single_width / (4 / 3);
					break;

				case ('four-five'):
					$single_height = $single_width / (4 / 5);
					break;

				case ('five-four'):
					$single_height = $single_width / (5 / 4);
					break;

				case ('three-two'):
					$single_height = $single_width / (3 / 2);
					break;

				case ('two-one'):
					$single_height = $single_width / (2 / 1);
					break;

				case ('sixteen-nine'):
					$single_height = $single_width / (16 / 9);
					break;

				case ('twentyone-nine'):
					$single_height = $single_width / (21 / 9);
					break;

				case ('one-two'):
					$single_height = $single_width / (1 / 2);
					break;

				case ('three-four'):
					$single_height = $single_width / (3 / 4);
					break;

				case ('two-three'):
					$single_height = $single_width / (2 / 3);
					break;

				case ('nine-sixteen'):
					$single_height = $single_width / (9 / 16);
					break;

				case ('three-ten'):
					$single_height = $single_width / (3 / 10);
					break;
			}
			$block_classes[] = $has_ratio = 'tmb-img-ratio';
		}

		$items_thumb_id = explode(',', $item_thumb_id);
		$media_attributes = uncode_get_media_info($item_thumb_id);

		$entry = $inner_entry = $cat_over = $cat_over_class = $drop_image_extra_price = $drop_image_extra = $title_extra_before = $title_extra_after = $inline_price = $inline_count = '';
		$meta_class = $title_classes;
		$meta_class[] = 't-entry-table-typography';

		if ( $with_html  ) {

			if ( ! isset( $layout['title'] ) ) {
				if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] ) {
					$inner_entry = uncode_post_module_navigation_label( $inner_entry, $block_data, true );
				}
			}

			$col_counter = 0;

			foreach ($layout as $key => $value) {
				switch ($key) {
					case 'col-one':
					case 'col-two':
					case 'col-three':
					case 'col-four':
					case 'col-five':
					case 'col-six':
						$table_col = floatval($value[0]);
						$table_resp_class = '';
						if ( $inner_entry !== '' ) {
							$inner_entry .= '</div>';
						}
						if ( isset($block_data['table_on_tablet']) && $block_data['table_on_tablet'] === true ) {
							$table_resp_class .= ' col-md-' . $table_col;
						}
						if ( isset($block_data['table_on_mobile']) && $block_data['table_on_mobile'] === true ) {
							$table_resp_class .= ' col-sm-' . $table_col;
						}
						$col_counter++;
						$inner_entry .= '<div class="uncode-post-table-column post-table-column-' . $col_counter . ' t-entry t-' . $key . ' col-lg-' . $table_col . $table_resp_class . '">';
					break;

					case 'icon':
						if ($single_icon !== '' && $single_text === 'overlay') {
							$inner_entry.= '<i class="' . $single_icon . $icon_size . ' t-overlay-icon"></i>';
						} elseif ( $is_table ) {
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' t-table-icon">';
								$inner_icon = '<i class="' . $single_icon . $icon_size . ' t-icon-button"></i>';
							} else {
								$inner_icon = '<i class="' . $single_icon . $icon_size . ' t-icon-button"></i>';
							}
							$data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
							$data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';
							if ($title_link === '') {
								$inner_entry .= $inner_icon;
							} else {
								$inner_entry .= '<a href="'.$title_link.'"'.$data_values.'>'.$inner_icon.'</a>';
							}
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '</p>';
							}
						}
					break;

					case 'media':
						if ( $is_table ) {
							$inner_entry .= '[uncode_type_media_output]';

							if ( isset($images_size) && $images_size !== '' && isset( $table_col ) ) {
								$single_width = $table_col;
								switch ($images_size) {
									case ('one-one'):
										$single_height = $single_width;
										break;

									case ('ten-three'):
										$single_height = $single_width / (10 / 3);
										break;

									case ('four-three'):
										$single_height = $single_width / (4 / 3);
										break;

									case ('four-five'):
										$single_height = $single_width / (4 / 5);
										break;

									case ('five-four'):
										$single_height = $single_width / (5 / 4);
										break;

									case ('three-two'):
										$single_height = $single_width / (3 / 2);
										break;

									case ('two-one'):
										$single_height = $single_width / (2 / 1);
										break;

									case ('sixteen-nine'):
										$single_height = $single_width / (16 / 9);
										break;

									case ('twentyone-nine'):
										$single_height = $single_width / (21 / 9);
										break;

									case ('one-two'):
										$single_height = $single_width / (1 / 2);
										break;

									case ('three-four'):
										$single_height = $single_width / (3 / 4);
										break;

									case ('two-three'):
										$single_height = $single_width / (2 / 3);
										break;

									case ('nine-sixteen'):
										$single_height = $single_width / (9 / 16);
										break;

									case ('three-ten'):
										$single_height = $single_width / (3 / 10);
										break;
								}
								$block_classes[] = $has_ratio = 'tmb-img-ratio';
							}
						}
					break;

					case 'title':
						if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] && $block_data['navigation_label_position'] !== 'after' ) {
							$inner_entry = uncode_post_module_navigation_label( $inner_entry, $block_data, true );
						}

						$get_title = (isset($media_attributes->post_title)) ? $media_attributes->post_title : '';
						$title_tag = isset($block_data['tag']) ? $block_data['tag'] : 'h3';

						if ( isset( $block_data['drop_image_extra'] ) ) {
							if ( $block_data['drop_image_extra'] !== true ) {
								$drop_image_extra = $block_data['drop_image_extra'];
							}
						}

						if ( !$is_table ) {
							$title_extra_before = '[uncode_drop_image_extra_before]';
							$title_extra_after = '[uncode_drop_image_extra_after]';
						}

						if ( $is_product && isset($layout['price']) && isset( $block_data['price_inline'] ) && $block_data['price_inline'] === 'yes' ) {
							$redirect_to_product = uncode_single_variations_redirect_to_product( $product );

							if ( $redirect_to_product ) {
								$parent_product = wc_get_product( $product->get_parent_id() );
								$price_html = $parent_product->get_price_html();
							} else {
								$price_html = $product->get_price_html();
							}

							$price_case = '<span class="price '.trim(implode(' ', $title_classes)).'"' . $title_style . '>'.$price_html.'</span>';
						} else {
							$price_case = '';
						}

						if ( $is_tax_block && isset($layout['count']) && isset( $block_data['count_inline'] ) && $block_data['count_inline'] === 'yes' ) {
							$count = uncode_get_posts_element_term_count( $block_data, $layout['count'] );
							if ( $count ) {
								$count_case = ' <span class="inline-count '.trim(implode(' ', $title_classes)).'"' . $title_style . '>' . $count . '</span>';
							} else {
								$count_case = '';
							}
						} else {
							$count_case = '';
						}

						if (($single_text === 'overlay' && $single_elements_click !== 'yes') || (isset($media_attributes->team) && $media_attributes->team) || $title_link === '#') {
							$print_title = $single_title ? $single_title : ( isset($media_attributes->post_title) ? $media_attributes->post_title : '' );

							if ( isset($block_data['album_id']) && $block_data['album_id']!='' ) {//is Grouped Album
								$print_title = get_the_title( $block_data['album_id'] );
							}

							if ( isset($block_data['media_title_custom']) && $block_data['media_title_custom']!=='' ) {
								$print_title = esc_attr( $block_data['media_title_custom'] );
							}

							if ($print_title !== '') {
								$nav_label_icon = '';
								if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] ) {
									if ( $block_data['navigation_index'] === 'prev' ) {
										if ( $block_data['navigation_icon_position'] !== 'label' && $block_data['navigation_prev_icon'] ) {
											$nav_label_icon = $block_data['navigation_prev_icon'];
										}
									}
									if ( $nav_label_icon ) {
										$nav_label_icon = '<i class="t-entry-nav-icon t-entry-nav-icon--prev ' . $nav_label_icon . '"></i>';
									}
								}

								$print_title = $title_extra_before . $nav_label_icon . $print_title;
								$print_title .= $price_case;
								$print_title .= $count_case;

								ob_start();
								do_action( 'uncode_inner_entry_after_title', $block_data, $layout, $is_default_product_content );
								$custom_inner_entry_after_title = ob_get_clean();

								if ( $custom_inner_entry_after_title !== '' ) {
									$print_title .= $custom_inner_entry_after_title;
								}

								$nav_label_icon = '';
								if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] ) {
									if ( $block_data['navigation_index'] === 'next' ) {
										if ( $block_data['navigation_icon_position'] !== 'label' && $block_data['navigation_next_icon'] ) {
											$nav_label_icon = $block_data['navigation_next_icon'];
										}
									}
									if ( $nav_label_icon ) {
										$nav_label_icon = '<i class="t-entry-nav-icon t-entry-nav-icon--next ' . $nav_label_icon . '"></i>';
										$print_title   .= $nav_label_icon;
									}
								}

								$print_title .= $title_extra_after;

								$inner_entry .= '<' . $title_tag . ' class="t-entry-title '. trim(implode(' ', $title_classes)) . '"' . $title_style . '>'.$print_title.'</' . $title_tag . '>';
							}
						} else {
							$print_title = $single_title ? $single_title : $get_title;

							if ( isset($block_data['album_id']) && $block_data['album_id']!='' ) { //is Grouped Album
								$print_title = get_the_title( $block_data['album_id'] );
							}

							if ($print_title !== '') {
								$nav_label_icon = '';
								if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] ) {
									if ( $block_data['navigation_index'] === 'prev' ) {
										if ( $block_data['navigation_icon_position'] !== 'label' && $block_data['navigation_prev_icon'] ) {
											$nav_label_icon = $block_data['navigation_prev_icon'];
										}
									}
									if ( $nav_label_icon ) {
										$nav_label_icon = '<i class="t-entry-nav-icon t-entry-nav-icon--prev ' . $nav_label_icon . '"></i>';
									}
								}

								$print_title = $title_extra_before . $nav_label_icon . $print_title;
								$print_title .= $price_case;
								$print_title .= $count_case;

								ob_start();
								do_action( 'uncode_inner_entry_after_title', $block_data, $layout, $is_default_product_content );
								$custom_inner_entry_after_title = ob_get_clean();

								if ( $custom_inner_entry_after_title !== '' ) {
									$print_title.= $custom_inner_entry_after_title;
								}

								$nav_label_icon = '';
								if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] ) {
									if ( $block_data['navigation_index'] === 'next' ) {
										if ( $block_data['navigation_icon_position'] !== 'label' && $block_data['navigation_next_icon'] ) {
											$nav_label_icon = $block_data['navigation_next_icon'];
										}
									}
									if ( $nav_label_icon ) {
										$nav_label_icon = '<i class="t-entry-nav-icon t-entry-nav-icon--next ' . $nav_label_icon . '"></i>';
										$print_title   .= $nav_label_icon;
									}
								}

								$print_title .= $title_extra_after;

								$data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
								$data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';
								if ($title_link === '') {
									$inner_entry .= '<' . $title_tag . ' class="t-entry-title '. trim(implode(' ', $title_classes)) . '"' . $title_style . '>'.$print_title.'</' . $title_tag . '>';
								} else {
									$inner_entry .= '<' . $title_tag . ' class="t-entry-title '. trim(implode(' ', $title_classes)) . '"' . $title_style . '><a href="'.$title_link.'"'.$data_values.'>'.$print_title.'</a></' . $title_tag . '>';
								}
							}
						}

						if ( ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
							ob_start();
							do_action( 'woocommerce_shop_loop_item_title');
							$inner_entry .= ob_get_clean();
						}

						if ( isset( $block_data['is_navigation'] ) && $block_data['is_navigation'] && $block_data['navigation_label_position'] === 'after' ) {
							$inner_entry = uncode_post_module_navigation_label( $inner_entry, $block_data );
						}
					break;

					case 'type':
						$get_the_post_type = get_post_type($block_data['id']);
						if ( ! $is_tax_block ) {
							if ($get_the_post_type === 'portfolio') {
								$portfolio_cpt_name = ot_get_option('_uncode_portfolio_cpt');
								if ($portfolio_cpt_name !== '') {
									$get_the_post_type = $portfolio_cpt_name;
								}
							}
							if ( !isset($portfolio_cpt_name) ) {
								$get_the_post_type = get_post_type_object($get_the_post_type);
								$get_the_post_type = $get_the_post_type->labels->singular_name;
							}
							if ( isset( $block_data['drop_image_extra'] ) ) {
								$drop_image_extra = $get_the_post_type;
							} elseif ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' t-entry-type"><span>' . $get_the_post_type . '</span></p>';
							} else {
								$inner_entry .= '<p class="t-entry-meta t-entry-type"><span>' . $get_the_post_type . '</span></p>';
							}
						}
					break;

					case 'category':
					case 'meta':

						$cat_over_bool = false;

						if ($key === 'category') {

							if (isset($value[0]) && $value[0] === 'bordered') {
								$border_cat = true;
							} else {
								$border_cat = false;
							}

							if (isset($value[0]) && $value[0] === 'colorbg') {
								$colorbg = true;
							} else {
								$colorbg = false;
							}

							if (isset($value[0]) && $value[0] === 'transparentbg') {
								$transparentbg = true;
							} else {
								$transparentbg = false;
							}

							if (isset($value[1]) && ( $value[1] === 'topleft' || $value[1] === 'topright' || $value[1] === 'bottomleft' || $value[1] === 'bottomright' ) ) {
								$cat_over_class = 't-cat-over-' . $value[1];
								$cat_over_bool = true;
							}

						}

						if (isset($value[0]) && $value[0] === 'yesbg') {
							$with_bg = true;
						} else {
							$with_bg = false;
						}

						$meta_inner = '';

						if (is_sticky()) {
							$meta_inner .= '<span class="t-entry-category t-entry-sticky"><i class="fa fa-ribbon fa-push-right"></i>' . esc_html__('Sticky','uncode').'</span><span class="small-spacer"></span>';
						}

						if ($key === 'meta') {
							$year = get_the_time( 'Y' );
							$month = get_the_time( 'm' );
							$day = get_the_time( 'd' );
							$date = get_the_date( '', $block_data['id'] );
							$date_link = '<a href="' . get_day_link( $year, $month, $day ) .'">';
							$date_link_end = '</a>';
							if (($single_text === 'overlay' && $single_elements_click !== 'yes') || (isset($media_attributes->team) && $media_attributes->team) || $title_link === '#') {
								$date_link = $date_link_end = '';
							}
							$clock_icon = '<i class="fa fa-clock fa-push-right"></i>';
							if ( isset($value[0]) && $value[0] === 'hide-icon') {
								$clock_icon = '';
							}
							$meta_inner .= '<span class="t-entry-category t-entry-date">' . $clock_icon . $date_link . $date . $date_link_end . '</span>';
							if ( !$is_table ) {
								$meta_inner .= '<span class="small-spacer"></span>';
							}
						}

						$categories_array = isset($block_data['single_categories_id']) ? $block_data['single_categories_id'] : array();

						$cat_icon = $tag_icon = $cat_break = $tag_break = $first_cat = $first_tag = false;

						$cat_count = count($categories_array);
						$cat_counter = 0;
						$cat_counter_tot = 0;
						$only_cat_counter = 0;

						if ($cat_count === 0) {
							continue 2;
						}

						$first_taxonomy = is_array($block_data['single_categories'][0]) && isset($block_data['single_categories'][0]['tax']) ? $block_data['single_categories'][0]['tax'] : '';

						foreach ($block_data['single_categories'] as $cat_key => $cat) {
							if (isset($cat['tax']) && $cat['tax'] === $first_taxonomy) {
								$only_cat_counter++;
							}
						}

						foreach ($categories_array as $t_key => $tax) {
							$category = $term_color = '';

							if (isset($block_data['single_categories'][$t_key]) || $block_data['single_categories_id'][$t_key]) {
								$single_cat = $block_data['single_categories'][$t_key];
								if (gettype($single_cat) !== 'string' && isset($single_cat['link'])) {
									if ($key === 'category' && $block_data['single_categories'][$t_key]['tax'] === 'post_tag') {
										continue;
									}
								} else {
									if (isset($block_data['single_tags']) && $key === 'category' && ( isset($block_data['taxonomy_type']) && isset($block_data['taxonomy_type'][$t_key]) && $block_data['taxonomy_type'][$t_key] !== 'category' && $block_data['taxonomy_type'][$t_key] !== 'portfolio_category' && $block_data['taxonomy_type'][$t_key] !== 'product_cat' && $block_data['taxonomy_type'][$t_key] !== 'page_category' ) ) {
										if ( apply_filters( 'uncode_skip_custom_tax_in_single_block', true, $block_data, $t_key, $tax ) ) {
											continue;
										}
									}
									if (isset($block_data['single_tags']) && $key === 'post_tag' && ( isset($block_data['taxonomy_type']) && isset($block_data['taxonomy_type'][$t_key]) && $block_data['taxonomy_type'][$t_key] !== 'post_tag' ) ) {
										continue;
									}
								}
							}

							$cat_counter_tot++;
						}

						foreach ($categories_array as $t_key => $tax) {
							$category = $term_color = '';

							if ($t_key !== $cat_count - 1 && $t_key !== $only_cat_counter - 1) {
								$add_comma = true;
							} else {
								$add_comma = false;
							}

							if ( $is_table && isset($value[0]) && $value[0] === 'block' ) {
								$add_comma = false;
							}

							if ( isset( $block_data['table_heading'] ) ) {
								$cat_classes = 't-entry-table-category';
							} else {
								$cat_classes = 't-entry-category';
							}
							if (isset($block_data['single_categories'][$t_key]) || $block_data['single_categories_id'][$t_key]) {
								$single_cat = $block_data['single_categories'][$t_key];
								if (gettype($single_cat) !== 'string' && isset($single_cat['link'])) {
									if ($key === 'category' && $block_data['single_categories'][$t_key]['tax'] === 'post_tag') {
										continue;
									}
									$cat_link = $block_data['single_categories'][$t_key]['link'];

									$hide_icon = false;
									if ( isset( $block_data['drop_image_extra'] ) ) {
										$hide_icon = true;
									}
									if ($key === 'meta') {
										if ( isset($value[0]) && $value[0] === 'hide-icon') {
											$hide_icon = true;
										}
									}
									if ($key === 'category') {
										if ( ( isset($value[2]) && $value[2] === 'hide-icon' ) || $is_table ) {
											$hide_icon = true;
										}
									}

									if ( !$cat_over_bool ) {

										if ($block_data['single_categories'][$t_key]['tax'] === 'category') {
											$cat_classes .= ' t-entry-tax';
											if ( apply_filters( 'uncode_display_category_icon', true ) && !$cat_icon && !$hide_icon ) {
												$category .= '<i class="fa fa-archive2 fa-push-right"></i>';
												$cat_icon = true;
											}
											$first_cat = true;
										}
										if ($block_data['single_categories'][$t_key]['tax'] === 'post_tag') {
											$cat_classes .= ' t-entry-tag';
											if ( apply_filters( 'uncode_display_tag_icon', true ) && !$tag_icon && !$hide_icon ) {
												$category .= '<i class="fa fa-tag2 fa-push-right"></i>';
												$tag_icon = true;
											}
											$first_tag = true;
										}
									}
								} else {
									$cat_link = '<span class="t-entry-cat-single"><span>' . $block_data['single_categories'][$t_key] . '</span></span>';
									if (isset($block_data['single_tags']) && $key === 'category' && ( isset($block_data['taxonomy_type']) && isset($block_data['taxonomy_type'][$t_key]) && $block_data['taxonomy_type'][$t_key] !== 'category' && $block_data['taxonomy_type'][$t_key] !== 'portfolio_category' && $block_data['taxonomy_type'][$t_key] !== 'product_cat' && $block_data['taxonomy_type'][$t_key] !== 'page_category' ) ) {
										if ( apply_filters( 'uncode_skip_custom_tax_in_single_block', true, $block_data, $t_key, $tax ) ) {
											continue;
										}
									}
									if (isset($block_data['single_tags']) && $key === 'post_tag' && ( isset($block_data['taxonomy_type']) && isset($block_data['taxonomy_type'][$t_key]) && $block_data['taxonomy_type'][$t_key] !== 'post_tag' ) ) {
										continue;
									}
								}

								$no_link_cat = '';
								if ($key === 'category') {
									if (isset($block_data['single_categories'][$t_key]['cat_id'])) {
										$term_color = get_option( '_uncode_taxonomy_' . $block_data['single_categories'][$t_key]['cat_id'] );
										if (isset($term_color['term_color']) && $term_color['term_color'] !== '' && $with_bg) {
											$term_color = 'text-' . $term_color['term_color'] . '-color';
										} elseif ( $colorbg ) {
											if ( isset($term_color['term_color']) && $term_color['term_color'] !== '' ) {
												$term_color_id = $term_color['term_color'];
											} else {
												$term_color_id = 'accent';
											}
											$term_color = 'style-' . $term_color_id . '-bg tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										} elseif ( $transparentbg ) {
											$term_color = 'transparent-cat tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										} elseif ( $border_cat ) {
											$term_color = 'bordered-cat tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										}

										if ( !is_array($term_color) ) {
											$cat_link = str_replace('<a ', '<a class="'.$term_color.'" ', $cat_link);
										}
									} else {
										$term_color = get_option( '_uncode_taxonomy_' . $block_data['single_categories_id'][$t_key] );
										if (isset($term_color['term_color']) && $term_color['term_color'] !== '' && $with_bg) {
											$term_color = 'text-' . $term_color['term_color'] . '-color';
										} elseif ( $colorbg ) {
											if ( isset($term_color['term_color']) && $term_color['term_color'] !== '' ) {
												$term_color_id = $term_color['term_color'];
											} else {
												$term_color_id = 'accent';
											}
											$term_color = 'style-' . $term_color_id . '-bg tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										} elseif ( $transparentbg ) {
											$term_color = 'transparent-cat tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										} elseif ( $border_cat ) {
											$term_color = 'bordered-cat tmb-term-evidence font-ui';
											$add_comma = 'none';
											$category = '';
										}

										$no_link_cat .= ' t-cat-no-link';
										if ( !is_array($term_color) ) {
											$cat_link = str_replace('<span>', '<span class="'.$term_color.'">', $cat_link);
										}
									}
								}

								$comma_space = $block_after = '';
								if ( $cat_counter+1 < $cat_counter_tot ) {
									$comma_space = '';
									if ($add_comma === true) {
										if ( isset( $block_data['table_heading'] ) ) {
											$comma_space = '<span class="cat-dash"> - </span>';
										} else {
											$comma_space = '<span class="cat-comma">,</span>';
										}
									} elseif ($add_comma === false) {
										if ( !$is_table || !isset($value[0]) || $value[0] !== 'block' ) {
											$comma_space = '<span class="small-spacer"></span>';
										} elseif ( $is_table && isset($value[0]) && $value[0] === 'block' ) {
											$block_after = '<br>';
										}
									}
								}

								$category .= $cat_link . $comma_space;

								$add_comma = true;
							} else {
								$category = '';
							}

							if ( isset($block_data['single_categories'][$t_key]['cat_id']) ) {
								$cat_classes = apply_filters( 'uncode_posts_loop_cat_classes', $cat_classes, $block_data['single_categories'][$t_key]['cat_id'] );
							}

							if ( !$cat_over_bool || ( isset( $block_data['single_categories'][$t_key]['tax'] ) && $block_data['single_categories'][$t_key]['tax'] === 'post_tag' ) || ( ( empty($item_thumb_id) || FALSE === get_post_mime_type( $item_thumb_id )) && !is_array($items_thumb_id) ) ) {
								if ( $is_table && $key === 'meta' ) {
									if ( $first_cat === true  && $cat_break === false ) {
										$meta_inner .= '<br>';
										$cat_break = true;
									}
									if ( $first_tag === true  && $tag_break === false ) {
										$meta_inner .= '<br>';
										$tag_break = true;
									}
								}
								$meta_inner .= '<span class="' . $cat_classes . '">' . $category . '</span>' . $block_after;
							} else {
								$cat_over .= '<span class="' . $cat_classes . ' t-cat-over-inner">' . $category . '</span>';
							}

							$cat_counter++;
							$category = '';
						}

						if ( isset( $block_data['drop_image_extra'] ) ) {
							$drop_image_extra = $meta_inner;
							$meta_inner = '';
						}

						if ($meta_inner !== '') {
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $meta_inner . '</p>';
							} else {
								$inner_entry .= '<p class="t-entry-meta">';
								$inner_entry .= $meta_inner;
								$inner_entry .= '</p>';
							}
						}

					break;

					case 'count':
						if ( $is_tax_block ) {
							if ( isset( $block_data['count_inline'] ) && $block_data['count_inline'] === 'yes' ) {
								continue 2;
							}

							$count = uncode_get_posts_element_term_count( $block_data, $value );

							if ( $count ) {
								$cat_over_bool = false;
								$meta_inner    = '';
								$count_classes = 't-entry-category';

								if (isset($value[1]) && ( $value[1] === 'topleft' || $value[1] === 'topright' || $value[1] === 'bottomleft' || $value[1] === 'bottomright' ) ) {
									$cat_over_class = 't-cat-over-' . $value[1];
									$cat_over_bool = true;
								}

								if ( isset( $block_data['drop_image_extra'] ) ) {
									$drop_image_extra = $count;
								} else {
									$no_link_cat = '';

									if ( !$cat_over_bool || ( ( empty($item_thumb_id) || FALSE === get_post_mime_type( $item_thumb_id )) && !is_array($items_thumb_id) ) ) {
										$meta_inner .= '<span class="' . $count_classes . '">' . $count . '</span>';
									} else {
										$cat_over .= '<span class="' . $count_classes . ' t-cat-over-inner">' . $count . '</span>';
									}

									if ($meta_inner !== '') {
										if ( isset( $block_data['table_heading'] ) ) {
											$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $meta_inner . '</p>';
										} else {
											$inner_entry .= '<p class="t-entry-meta">';
											$inner_entry .= $meta_inner;
											$inner_entry .= '</p>';
										}
									}
								}
							}
						}

					break;

					case 'date':
						if ( ! $is_tax_block ) {
							$date = get_the_date( '', $block_data['id'] );

							if ( isset( $block_data['drop_image_extra'] ) ) {
								$drop_image_extra = $date;
							} elseif ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $date . '</p>';
							} else {
								$inner_entry .= '<p class="t-entry-meta">';
								$inner_entry .= '<span class="t-entry-date">'.$date.'</span>';
								$inner_entry .= '</p>';
							}
						}

					break;

					case 'text':

						if ( $is_tax_block ) {
							$block_text = '';
							$term       = get_term( $block_data['id'] );

							if ( $term->description && $term->description ) {
								$block_text = $term->description;
							}
						} else {
							$post_format = get_post_format($block_data['id']);
							if (isset($value[0]) && ($value[0] === 'full')) {
								$block_text = (($post_format === 'link') ? '<i class="fa fa-link fa-push-right"></i>' : '') . $block_data['content'];
								$block_text .= wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uncode' ),
									'after'  => '</div>',
									'link_before'	=> '<span>',
			    				'link_after'	=> '</span>',
									'echo'	=> 0
								));
							} else {
								if ( $is_product && $product->get_type() === 'variation' ) {
									$variation_description = $product->get_description();
									if ( $variation_description ) {
										$block_text = $variation_description;
									} else {
										$block_text = get_post_field( 'post_excerpt', $product->get_parent_id() );
									}
								} else {
									$block_text = get_post_field( 'post_excerpt', $block_data['id'] );
								}
							}
						}

						$block_text = apply_filters('uncode_block_data_content', $block_text, $block_data['id']);

						$block_text = apply_filters( 'uncode_filter_for_translation', $block_text );
						$block_text = uncode_remove_p_tag($block_text, true);

						$text_size = '';

						if ( isset( $block_data[ 'text_lead' ] ) ) {
							if ( $block_data[ 'text_lead' ] === 'yes' ) {
								$text_size = 'text-lead';
							} else if ( $block_data[ 'text_lead' ] === 'small' ) {
								$text_size = 'text-small';
							}
						}

						$text_class = $text_size !== '' ? ' class="' . $text_size . '"' : '';

						$block_text = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $block_text);
						$block_data_text_length = isset( $block_data['text_length'] ) ? $block_data['text_length'] : '';
						$block_data_text_length = apply_filters( 'uncode_block_data_text_length', $block_data_text_length );
						if ($block_data_text_length !== '') {
							$block_text = preg_replace('#<a class="more-link(.*?)</a>#', '', $block_text);
							$block_text = '<p'.$text_class.'>' . uncode_truncate($block_text, $block_data_text_length) . '</p>';
						} elseif ($is_tax_block && isset($value[0]) && !empty($value[0])) {
							$block_text = preg_replace('#<a class="more-link(.*?)</a>#', '', $block_text);
							$block_text = '<p'.$text_class.'>' . uncode_truncate($block_text, $value[0]) . '</p>';
						} elseif (isset($value[1]) && !empty($value[1])) {
							$block_text = preg_replace('#<a class="more-link(.*?)</a>#', '', $block_text);
							$block_text = '<p'.$text_class.'>' . uncode_truncate($block_text, $value[1]) . '</p>';
						}

						if ($block_text !== '') {
							$block_text = apply_filters( 'uncode_block_text_out', $block_text, $block_data['id'] );
							if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
								$inner_entry .= '<div class="t-entry-excerpt '.$text_size.'">'.preg_replace('/<\/?a(.|\s)*?>/', '', $block_text).'</div>';
							} else {
								if (isset($value[0]) && ($value[0] === 'full')) {
									$inner_entry .= $block_text;
								} else {
									$inner_entry .='<div class="t-entry-excerpt '.$text_size.'">'.$block_text.'</div>';
								}
							}
						}

					break;

					case 'link':
						$btn_shape = ' btn-default';
						$btn_has_style = false;
						$btn_has_2_9_0_fields = false;

						if ( isset($value[2]) ) {
							if ( $value[2] === 'outline_inv') {
								$btn_shape .= ' btn-outline';
								$btn_has_style = true;
							} elseif ( $value[2] === 'flat') {
								$btn_shape .= ' btn-flat';
								$btn_has_style = true;
							} elseif ( $value[2] === 'outline') {
								$btn_has_style = true;
							}
						}

						if (isset($value[1]) && $value[1] === 'small_size') {
							$btn_shape .= ' btn-sm';
						}

						if (isset($value[1]) && $value[1] === 'large_size') {
							$btn_shape .= ' btn-lg';
						}

						if (isset($value[2]) && $value[2] === 'not_scale_mobile') {
							$btn_shape .= ' btn-no-scale';
						}

						if (isset($value[3]) && $value[3] === 'fluid_width') {
							$btn_shape .= ' btn-block';
							$btn_has_2_9_0_fields = true;
						} else if ( isset($value[3]) && $value[3] === 'default_width' ) {
							$btn_has_2_9_0_fields = true;
						}

						if (isset($value[4]) && $value[4] === 'outline_inverse') {
							$btn_shape .= ' btn-outline';
							$btn_has_2_9_0_fields = true;
						} else if ( isset($value[3]) && $value[3] === 'default_outline' ) {
							$btn_has_2_9_0_fields = true;
						}

						if (isset($value[0]) && $value[0] !== 'default') {
							if ($value[0] === 'link') {
								$btn_shape = ' btn-link';
							} else {
								$btn_shape .= ' btn-' . $value[0];
							}
						}
						if ( uncode_btn_style() !== '' ) {
							$btn_shape .= ' ' . uncode_btn_style();
						}

	                    $data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
	                    $data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';
	                    $read_more_text = esc_html__('Read More','uncode');

						if (isset($block_data['read_more_text']) && $block_data['read_more_text'] !== '') {
							$read_more_text = $block_data['read_more_text'];
						} elseif (isset($value[5]) && !empty($value[5])) {
							$read_more_text = $value[5];
						} elseif (isset($value[4]) && !empty($value[4]) && $btn_has_2_9_0_fields === false) {
							$read_more_text = $value[4];
						} elseif (isset($value[3]) && !empty($value[3]) && $btn_has_style === false && $btn_has_2_9_0_fields === false) {
							$read_more_text = $value[3];
						} elseif (isset($value[1]) && !empty($value[1]) && $value[1]!== 'default_size' && $value[1]!== 'small_size' && $value[1]!== 'large_size') {
							$read_more_text = $value[1];
						}

						$btn_shape = 'btn' . $btn_shape;

						if ( $block_data['button_class'] ) {
							$btn_shape = $block_data['button_class'];

							$data_values .= ' class="' . $block_data['button_class'] . '"';
						}

						if ( isset( $block_data['table_heading'] ) ) {
							$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' "><a href="'.$read_more_link.'"' . $data_values . '>' . $read_more_text . '</a></p>';
						} else {
							if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
								$inner_entry .= '<p class="t-entry-readmore btn-container"><span class="'.$btn_shape.'">' . $read_more_text . '</span></p>';
							} else {
								$inner_entry .= '<p class="t-entry-readmore btn-container"><a href="'.$read_more_link.'" class="'.$btn_shape.'"' . $data_values . '>' . $read_more_text . '</a></p>';
							}
						}
					break;

					case 'add_to_cart':
						if ( $is_product ) {
							$btn_shape = ' btn-default btn-no-scale';
							$btn_has_style = false;

							if (isset($value[1]) && $value[1] === 'small_size') {
								$btn_shape .= ' btn-sm';
							}

							if (isset($value[1]) && $value[1] === 'large_size') {
								$btn_shape .= ' btn-lg';
							}

							if (isset($value[0]) && $value[0] !== 'default') {
								if ($value[0] === 'link') {
									$btn_shape = ' btn-link';
								} else {
									$btn_shape .= ' btn-' . $value[0];
								}
							}
							if ( uncode_btn_style() !== '' ) {
								$btn_shape .= ' ' . uncode_btn_style();
							}

							if (isset($value[2]) && $value[2] === 'fluid_width') {
								$btn_shape .= ' btn-block';
							}

							if (isset($value[3]) && $value[3] === 'outline_inverse') {
								$btn_shape .= ' btn-outline';
							}

							if ( $block_data['button_class'] ) {
								$btn_shape = $block_data['button_class'];
							}

							$redirect_to_product = uncode_single_variations_redirect_to_product( $product );

							ob_start();
							$add_to_cart_args = array();

							if ( $redirect_to_product ) {
								$add_to_cart_url = isset ( $block_data['link']['url'] ) ? $block_data['link']['url'] : get_permalink( $product->get_parent_id() );

								$add_to_cart_args['uncode_add_to_cart_url'] = $add_to_cart_url;
							}

							woocommerce_template_loop_add_to_cart( $add_to_cart_args );
							$add_to_cart_button_html = ob_get_clean();

							if ( $add_to_cart_button_html ) {
								if ( $redirect_to_product ) {
									$add_to_cart_button_html = str_replace( 'ajax_add_to_cart', '', $add_to_cart_button_html );
								}

								if ( isset( $block_data['table_heading'] ) ) {
									$add_to_cart_button_html = str_replace( ' btn-default', ' t-table-add-to-cart', $add_to_cart_button_html );
									$add_to_cart_button_html = str_replace( ' btn', ' t-table-add-to-cart', $add_to_cart_button_html );
									$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $add_to_cart_button_html . '</p>';
								} else {
									if ( $block_data['button_class'] ) {
										$add_to_cart_button_html = str_replace( 'btn ', ' ', $add_to_cart_button_html );
									}

									$add_to_cart_button_html = str_replace( 'btn-default', $btn_shape, $add_to_cart_button_html );

									if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
										$add_to_cart_button_html = str_replace( '<a', '<span', $add_to_cart_button_html );
										$add_to_cart_button_html = str_replace( '</a>', '</span>', $add_to_cart_button_html );
										$add_to_cart_button_html = apply_filters( 'uncode_loop_add_to_cart_button_html', $add_to_cart_button_html, 'extra' );
									}

									$inner_entry .= '<p class="t-entry-readmore t-entry-extra-add-to-cart btn-container">' . $add_to_cart_button_html . '</p>';
								}
							}
						}
					break;

					case 'author':
					case 'date-author':
						if ( ! $is_tax_block ) {
							$author = get_post_field( 'post_author', $block_data['id'] );
							$author_name = get_the_author_meta( 'display_name', $author );
							$author_link = get_author_posts_url( $author );
							$avatar_size = 20;
							$avatar_size_class = 'sm';
							$qualification = false;
							if (isset($value[0]) && !empty($value[0]) && $value[0]!== '' && $value[0]!== 'display_qualification') {
								if ( $value[0] === 'md_size' ){
									$avatar_size = $avatar_size*2;
									$avatar_size_class = 'md';
								} elseif ( $value[0] === 'lg_size' ){
									$avatar_size = $avatar_size*3;
									$avatar_size_class = 'lg';
								} elseif ( $value[0] === 'xl_size' ){
									$avatar_size = $avatar_size*4;
									$avatar_size_class = 'xl';
								}
							}
							if ( ( isset($value[0]) && $value[0]=== 'display_qualification' ) || ( isset($value[1]) && $value[1]=== 'display_qualification' ) ) {
								$qualification = '<span class="tmb-user-qualification">' . esc_html( get_the_author_meta( 'user_qualification', $author ) ) . '</span>';
							}

							$get_avatar = '';
							$un_wrap_class = 'tmb-username-wrap';

							if ( !$is_table || !isset($value[2]) || $value[2] !== 'hidden_avatar' ) {
								$get_avatar = get_avatar( $author, $avatar_size, '', '', array( 'loading' => 'lazy' ) );
							}

							$get_avatar = apply_filters( 'uncode_posts_module_get_avatar', $get_avatar, $author, $block_data['id'] );

							if ( $is_table && isset($value[2]) && $value[2] !== 'avatar_inline' ) {
								$un_wrap_class .= ' tmb-username-wrap-block';
							}

							$author_text = esc_html__('by','uncode') . ' ' . $author_name . '</span>' . $qualification;
							$author_text = apply_filters( 'uncode_posts_module_get_author_text', $author_text, $author, $block_data['id'] );

							if ( isset( $block_data['drop_image_extra'] ) ) {
								$drop_image_extra = '<span class="' . $un_wrap_class . '"><span class="tmb-username-text">' . $author_text . '</span>';
								if ( $key === 'date-author' ) {
									$drop_image_extra = '<span class="tmb-date-wrap">' . get_the_date( '', $block_data['id'] ) . '</span><span class="tmb-date-author-separator"></span>' . $drop_image_extra;
								}
							} elseif ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' t-table-author"><a href="'.$author_link.'" class="tmb-avatar-size-' . $avatar_size_class . '">' . $get_avatar . '<span class="' . $un_wrap_class . '"><span class="tmb-username-text">' . $author_text . '</span></a></p>';
							} else {
								$inner_entry .= '<p class="t-entry-meta t-entry-author">';
								if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
									$inner_entry .= '<span class="tmb-avatar-size-' . $avatar_size_class . '">' . $get_avatar. '<span class="' . $un_wrap_class . '"><span class="tmb-username-text">' . $author_text . '</span>';
								} else {
									$inner_entry .= '<a href="'.$author_link.'" class="tmb-avatar-size-' . $avatar_size_class . '">' . $get_avatar . '<span class="' . $un_wrap_class . '"><span class="tmb-username-text">' . $author_text . '</span></a>';
								}
								$inner_entry .= '</p>';
							}
						}
					break;

					case 'extra':
						if ( isset( $block_data['table_heading'] ) ) {
							$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">';
						} else {
							$inner_entry .= '<p class="t-entry-comments entry-small"><span class="extras">';
						}

						if( function_exists('uncode_dot_irecommendthis') && apply_filters('uncode_dot_irecommendthis', false) ) {
							global $uncode_dot_irecommendthis;
							if ($single_text !== 'overlay') {
								$inner_entry .= $uncode_dot_irecommendthis->dot_recommend($block_data['id'], true);
							} else {
								if ($single_elements_click === 'yes') {
									$inner_entry .= $uncode_dot_irecommendthis->dot_recommend($block_data['id'], true);
								} else {
									$inner_entry .= $uncode_dot_irecommendthis->dot_recommend($block_data['id'], false);
								}
							}
						}

						$num_comments = get_comments_number( $block_data['id'] );
						$entry_comments = '';
						if ( !$is_table || !isset($value[0]) || $value[0] !== 'hide-icon' ) {
							$entry_comments .= '<i class="fa fa-speech-bubble"></i>';
						}
						$entry_comments .= '<span>'.$num_comments.' '._nx( 'Comment', 'Comments', $num_comments, 'comments', 'uncode' ).'</span>';
						if ($single_text === 'overlay' && $single_elements_click !== 'yes') {
							$inner_entry .= '<span class="extras-wrap">' . $entry_comments . '</span>';
						} else {
							$inner_entry .= '<a class="extras-wrap" href="'.get_comments_link($block_data['id']).'" title="title">'.$entry_comments.'</a>';
						}
						if ( $is_table ) {
							$inner_entry .= '<br>';
						}
						$inner_entry .= '<span class="extras-wrap">';
						if ( !$is_table || !isset($value[0]) || $value[0] !== 'hide-icon' ) {
							$inner_entry .= '<i class="fa fa-watch"></i>';
						}
						$inner_entry .= '<span>'.uncode_estimated_reading_time($block_data['id']).'</span></span></span></p>';
					break;

					case 'price':
						if ( $is_product && ( !isset( $block_data['price_inline'] ) || $block_data['price_inline'] !== 'yes' ) ) {
							$redirect_to_product = uncode_single_variations_redirect_to_product( $product );

							if ( $redirect_to_product ) {
								$parent_product = wc_get_product( $product->get_parent_id() );
								$price_html = $parent_product->get_price_html();
							} else {
								$price_html = $product->get_price_html();
							}

							if ( $is_titles && isset( $block_data['drop_image_extra'] ) ) {
								$drop_image_extra = preg_replace( "/<ins .*?>(.*?)<\/ins>/", "<ins>$1</ins>", $price_html );
							} else {
								$inner_entry .= '<span class="price '.trim(implode(' ', $title_classes)).'"' . $title_style . '>'.$price_html.'</span>';
							}
						}
					break;

					case 'stars':
						if ( $is_product ) {
							ob_start();
							$templ_arr = array(
								'no_wrapper_class' => true,
								'vc_only_stars'    => true,
							);
							wc_get_template( 'single-product/rating.php', $templ_arr );
							$stars_output = ob_get_clean();

							if ( $stars_output ) {
								$stars_output_class = $single_text === 'overlay' ? 't-entry-meta' : 't-entry-stars';
								$inner_entry .= '<div class="' . $stars_output_class . '">' . $stars_output . '</div>';
							}
						}
					break;

					case 'variations':
						if ( $is_product && isset( $value[0] ) && ( $value[0] === 'under' || ( $value[0] === 'over' && isset( $value[1] ) && $value[1] === '_all' ) ) ) {
							$inner_entry .= uncode_wc_print_variations_element( $product, $value, $single_text );
						}
					break;

					case 'attribute_image':
						if ( $is_product && isset( $value[0] ) ) {
							$inner_entry .= uncode_wc_print_attribute_image_element( $product, $value, $single_text, $single_elements_click );
						}
					break;

					case 'stock':
						if ( $is_product ) {
							$stock = wc_get_stock_html( $product );
							if ( $stock ) {
								$stock_class = '';
								if ( isset( $value[0] ) && $value[0] === 'out_of_stock' && strpos( $stock, 'in-stock' ) !== false ) {
									$stock_class = ' t-entry-stock--in-stock';
								}

								$text_size = '';

								if ( isset( $block_data[ 'text_lead' ] ) ) {
									if ( $block_data[ 'text_lead' ] === 'yes' ) {
										$text_size = 'text-lead';
									} else if ( $block_data[ 'text_lead' ] === 'small' ) {
										$text_size = 'text-small';
									}
								}

								if ( $text_size ) {
									$stock_class .= ' ' . $text_size;
								}

								$inner_entry.= '<div class="t-entry-meta t-entry-stock' . $stock_class . '">' . wc_get_stock_html( $product ) . '</div>';
							}
						}
					break;

					case 'caption':
						$caption_class = isset( $block_data['table_heading'] ) ? trim(implode(' ', $meta_class)) : 't-entry-meta';
						if ( isset($block_data['album_id']) && $block_data['album_id']!='' ) { //is Grouped Album
							$inner_entry.= '<p class="' . $caption_class . '"><span>' . get_the_excerpt( $block_data['album_id'] ) . '</span></p>';
						} elseif (isset($media_attributes->post_excerpt) && $media_attributes->post_excerpt !== '' && !( isset($block_data['media_caption_custom']) && $block_data['media_caption_custom'] ) ) {
							$inner_entry.= '<p class="' . $caption_class . '"><span>' . $media_attributes->post_excerpt . '</span></p>';
						} elseif ( isset($block_data['media_caption_custom']) && $block_data['media_caption_custom'] ) {
							$inner_entry .= '<p class="' . $caption_class . '"><span>' . esc_attr( $block_data['media_caption_custom'] ) . '</span></p>';
						}
					break;

					case 'description':
						$text_size = '';

						if ( isset( $block_data[ 'text_lead' ] ) ) {
							if ( $block_data[ 'text_lead' ] === 'yes' ) {
								$text_size = 'text-lead';
							} else if ( $block_data[ 'text_lead' ] === 'small' ) {
								$text_size = 'text-small';
							}
						}

						if ( isset($block_data['album_id']) && $block_data['album_id']!='' ) { //is Grouped Album
							$album_post = get_post($block_data['album_id']);
							$album_content = $album_post->post_content;
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $album_content . '</p>';
							} else {
								$inner_entry.= '<p class="t-entry-excerpt '.$text_size.'">' . $album_content . '</p>';
							}
						} elseif ( isset($block_data['media_subtitle_custom']) && $block_data['media_subtitle_custom'] !== '' ) {
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . esc_attr( $block_data['media_subtitle_custom'] ) . '</p>';
							} else {
								$inner_entry .= '<p class="t-entry-excerpt '.$text_size.'">' . esc_attr( $block_data['media_subtitle_custom'] ) . '</p>';
							}
						} elseif (isset($media_attributes->post_content) && $media_attributes->post_content !== '') {
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' ">' . $media_attributes->post_content . '</p>';
							} else {
								$inner_entry.= '<p class="t-entry-excerpt '.$text_size.'">' . $media_attributes->post_content . '</p>';
							}
						}
					break;

					case 'team-social':
						// WPML Workaround
						if ( class_exists( 'SitePress' ) ) {
							if ( ! $media_attributes->team && ! $media_attributes->team_social ) {

							$my_default_lang = apply_filters( 'wpml_default_language', NULL );
							$translated_media_id = apply_filters( 'wpml_object_id', $item_thumb_id, 'attachment', true, $my_default_lang );

							$media_attributes = uncode_get_media_info( $translated_media_id );
							}
						}

						if ($media_attributes->team) {
							$team_socials = explode("\n", $media_attributes->team_social);
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<p class="' . trim(implode(' ', $meta_class)) . ' "><span class="extras">';
							} else {
								$inner_entry .= '<p class="t-entry-comments t-entry-member-social"><span class="extras">';
							}

							foreach ($team_socials as $key => $value) {
								$value = trim($value);
								if ($value !== '') {
									if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
										$inner_entry .= '<a href="mailto:'.$value.'"><i class="fa fa-envelope-o"></i></a>';
									} else {
										$get_host = parse_url($value);
										if( is_numeric( $value ) ) {
											$inner_entry .= '<a href="tel:'.$value.'"><i class="fa fa-phone"></i></a>';
										} else {
											// Fix URLs without scheme
											if ( ! isset( $get_host[ 'scheme' ] ) ) {
												$value    = 'http://' . $value;
												$get_host = parse_url( $value );
											}

											$host = str_replace("www.", "", $get_host['host']);
											$host = explode('.', $host);
											if ( strpos( get_site_url(), $host[0] ) !== false ) {
												$inner_entry.= '<a href="'.esc_url($value).'"><i class="fa fa-user"></i></a>';
											} else {
												if ($host[0] === 'plus') {
													$host[0] = 'google-' . $host[0];
												} elseif ($host[0] === 'twitter') {
													$host[0] = 'square-x-' . $host[0];
												}
												$inner_entry.= '<a href="'.esc_url($value).'" target="_blank"><i class="fa fa-'.esc_attr($host[0]).'"></i></a>';
											}
										}
									}
								}
							}
							$inner_entry .= '</span></p>';
						}
					break;

					case 'quick-view-button':
						if ( $is_table && $is_product ) {
							ob_start();
							do_action( 'uncode_element_special_buttons', $block_data, $key );
							$qv_out = ob_get_clean();
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<div class="quick-view-icon-button ' . trim(implode(' ', $meta_class)) . ' ">' . $qv_out . '</div>';
							} else {
								$inner_entry .= $qv_out;
							}
						}
					break;

					case 'wishlist-button':
						if ( $is_table && $is_product ) {
							ob_start();
							do_action( 'uncode_element_special_buttons', $block_data, $key );
							$wish_out = ob_get_clean();
							if ( isset( $block_data['table_heading'] ) ) {
								$inner_entry .= '<div class="add-to-wishlist-icon-button ' . trim(implode(' ', $meta_class)) . ' ">' . $wish_out . '</div>';
							} else {
								$inner_entry .= $wish_out;
							}
						}
					break;

					case 'spacer':
						if (isset($value[0])) {
							switch ($value[0]) {
								case 'half':
									$spacer_class = 'half-space';
									break;
								case 'one':
									$spacer_class = 'single-space';
									break;
								case 'two':
									$spacer_class = 'double-space';
									break;
							}
							$inner_entry.= '<div class="spacer spacer-one '.$spacer_class.'"></div>';
						}
					break;

					case 'spacer_two':
						if (isset($value[0])) {
							switch ($value[0]) {
								case 'half':
									$spacer_class = 'half-space';
									break;
								case 'one':
									$spacer_class = 'single-space';
									break;
								case 'two':
									$spacer_class = 'double-space';
									break;
							}
							$inner_entry.= '<div class="spacer spacer-two '.$spacer_class.'"></div>';
						}
					break;

					case 'sep-one':
					case 'sep-two':
						$sep_class = '';
						if ( isset($value[0]) ) {
							if ( $value[0] === 'reduced' ) {
								$sep_class = ' class="separator-reduced"';
							} elseif ( $value[0] === 'extra' ) {
								if ( isset( $block_data['media_full_width'] ) && $block_data['media_full_width'] ) {
									$sep_extra = ' separator-extra-child';
								}
								$sep_class = ' class="separator-extra"';
							}
						}
						$inner_entry.= '<hr'.$sep_class.' />';
					break;

					default:
						if ($key !== 'media' && isset($block_data['id'])) {
							$get_cf_value = get_post_meta($block_data['id'], $key, true);
							if (isset($get_cf_value) && $get_cf_value !== '') {
								$inner_entry.= '<div class="t-entry-cf-'.$key;
								if ( isset( $block_data['table_heading'] ) ) {
									$inner_entry .= ' ' . trim(implode(' ', $meta_class));
								}
								$inner_entry.= '">' . apply_filters( 'uncode_get_layout_cf_val', $get_cf_value, $key, $value, $block_data, $layout ) . '</div>';
							}
						}

						ob_start();
						do_action( 'uncode_inner_entry', $key, $value, $block_data, $layout, $is_default_product_content );
						$custom_entry = ob_get_clean();

						if ( $custom_entry !== '' ) {
							$inner_entry.= $custom_entry;
						}
					break;
				}
			}

			if ( $is_table ) {

				$entry .= $inner_entry . '</div>';

			} else {

				$drop_image_extra = preg_replace( "/<a .*?>(.*?)<\/a>/", "$1", $drop_image_extra );
				$drop_image_extra_before = '';
				$drop_position_space_before = $drop_position_space_after = '';
				$drop_position_array = array(
					'before-top','left-top','center-top','right-top','before-bottom',
				);
				if ( isset( $block_data['drop_extra_position'] ) && strpos( $block_data['drop_extra_position'], 'before') !== false ) {
					$drop_position_space_before = '&nbsp;&nbsp;';
				}
				if ( isset( $block_data['drop_extra_position'] ) && strpos( $block_data['drop_extra_position'], 'after') !== false ) {
					$drop_position_space_after = '&nbsp;&nbsp;';
				}
				if ( $drop_image_extra !== '' ) {
					$drop_image_extra_class = $block_data['drop_image_extra_class'];

					if ( isset( $block_data['drop_image_extra_size'] ) ) {
						$drop_image_extra_class[] = 'drop-extra-size-' . esc_attr( $block_data['drop_image_extra_size'] );
					}

					if ( isset( $block_data['drop_image_extra_weight'] ) && $block_data['drop_image_extra_weight'] !== '' ) {
						$drop_image_extra_class[] = 'drop-extra-weight-' . esc_attr( $block_data['drop_image_extra_weight'] );
					}

					if ( isset( $block_data['drop_extra_position'] ) ) {
						$drop_image_extra_class[] = 'drop-extra-pos-' . esc_attr( $block_data['drop_extra_position'] );
					}

					if ( isset( $block_data['drop_extra_position'] ) && in_array( $block_data['drop_extra_position'], $drop_position_array ) ) {
						$drop_image_extra_before = '<span class="' . trim(implode(' ', $drop_image_extra_class)) . '">' . $drop_position_space_after . $drop_image_extra . $drop_position_space_before . '</span>';
						$drop_image_extra = '';
					} else {
						$drop_image_extra = '<span class="' . trim(implode(' ', $drop_image_extra_class)) . '">' . $drop_position_space_after . $drop_image_extra . $drop_position_space_before . '</span>';
					}
				}
				$drop_image_extra = preg_replace( "/<a .*?>(.*?)<\/a>/", "$1", $drop_image_extra_price ) . $drop_image_extra;

				$inner_entry = str_replace( '[uncode_drop_image_extra_before]', $drop_image_extra_before, $inner_entry );
				$inner_entry = str_replace( '[uncode_drop_image_extra_after]', $drop_image_extra, $inner_entry );

				if (isset($media_attributes->team) && $media_attributes->team) {
					$single_elements_click = 'yes';
				}

				if (!empty($layout) && !(count($layout) === 1 && array_key_exists('media',$layout)) && $inner_entry !== '') {

					if ( isset( $block_data['price_inline'] ) && $block_data['price_inline'] === 'yes' ) {
						$inline_price = ' t-entry-inline-price';
						if ( isset( $block_data['price_inline_responsive'] ) && $block_data['price_inline_responsive'] === 'yes' ) {
							$inline_price .= ' t-entry-inline-price-responsive';
						}
					}

					if ( $is_tax_block && isset( $block_data['count_inline'] ) && $block_data['count_inline'] === 'yes' ) {
						$inline_count = ' t-entry-inline-count';
					}

					if ($single_text !== 'overlay') {
						$entry.= '<div class="t-entry-text">
									<div class="t-entry-text-tc ' . $block_data['text_padding'] . $inline_price . $inline_count . '">';
					}

					$entry.= '<div class="t-entry">';

					$entry .= $inner_entry;

					$entry.= '</div>';

					if ($single_text !== 'overlay') {
						$entry.= '</div>
							</div>';
					}
				}
			}
		}

		$block_data['layout'] = $layout;

		if ( $is_product && $product->get_type() === 'variable' ) {
			$block_classes[] = 'tmb-woocommerce-variable-product';
		}

		if ( apply_filters( 'uncode_woocommerce_use_parent_image_if_redirect_to_product', false ) ) {
			if ( $is_product && $product->get_type() === 'variation' ) {
				$use_parent_image = uncode_single_variations_use_parent_image( $product );

				if ( $use_parent_image ) {
					$product_parent_thumb_id = $parent_product->get_image_id();

					if ( $product_parent_thumb_id ) {
						$item_thumb_id = $product_parent_thumb_id;
					}
				}
			}
		}

		if ( empty( $item_thumb_id ) && $is_product && $product->get_type() === 'variation' ) {
			if ( apply_filters( 'uncode_woocommerce_use_get_image_id_original_hook', false ) ) {
				$parent_product = wc_get_product( $product->get_parent_id() );
				$product_parent_thumb_id = $parent_product->get_image_id();
			} else {
				$product_parent_thumb_id = get_post_thumbnail_id( $product->get_parent_id() );
			}

			if ( $product_parent_thumb_id ) {
				$item_thumb_id = $product_parent_thumb_id;
			}
		}

		if ( empty( $item_thumb_id ) && $is_product && $product->get_type() === 'variation' ) {
			$product_parent_thumb_id = get_post_thumbnail_id( $product->get_parent_id() );

			if ( $product_parent_thumb_id ) {
				$item_thumb_id = $product_parent_thumb_id;
			}
		}

		if ((empty($item_thumb_id) || !get_post_mime_type( $item_thumb_id )) && ( !is_array($items_thumb_id) || $items_thumb_id[0] === '' || $items_thumb_id[0] == '0' ) ) {
			$media_attributes = new stdClass();
			$media_attributes->metadata = '';
			$media_attributes->post_mime_type = '';
			$media_attributes->post_excerpt = '';
			$media_attributes->post_content = '';
			$media_attributes->guid = '';
			if (isset($layout['media']) && isset($layout['media'][0]) && $layout['media'][0] === 'placeholder') {
				$item_media = wc_placeholder_img_src();
				$content_url = content_url();
				$item_media_path = str_replace($content_url, WP_CONTENT_DIR, $item_media);
				if ( file_exists($item_media_path) ) {
					$get_size_item_media = getimagesize($item_media_path);
					$image_orig_w = isset($get_size_item_media[0]) ? $get_size_item_media[0] : 500;
					$image_orig_h = isset($get_size_item_media[1]) ? $get_size_item_media[0] : 500;
				} else {
					$image_orig_w = 500;
					$image_orig_h = 500;
				}
			} else {
				$item_media = get_template_directory_uri() . '/library/img/blank.png';
				$image_orig_w = 500;
				$image_orig_h = 500;
			}
			// Add adaptive data
			if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
				$adaptive_async_data = apply_filters( 'uncode_adaptive_get_async_data', '', 'ai_async', $block_data, array(), $item_thumb_id, $media_attributes, array(), $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
			} else if ( $adaptive_images === 'off' && $dynamic_srcset_active ) {
				$adaptive_async_data_all = apply_filters( 'uncode_adaptive_get_async_data', array( 'string' => '' ), 'srcset', $block_data, $dynamic_srcset_sizes, $item_thumb_id, $media_attributes, array(), $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
				$adaptive_async_data     = $adaptive_async_data_all['string'];
			} else {
				// Empty by default but it can be filtered
				$adaptive_async_data = apply_filters( 'uncode_adaptive_get_async_data', '', 'ai', $block_data, array(), $item_thumb_id, $media_attributes, array(), $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
			}
			$consent_id = 'image/jpeg';
		} else {
			/** get media info **/
			if (count($items_thumb_id) > 1 ) {
				if ($media_poster) {
					$media_attributes = uncode_get_media_info($items_thumb_id[0]);
					$media_metavalues = unserialize($media_attributes->metadata);
					$media_mime = $media_attributes->post_mime_type;
				} else {
					$multiple_items = true;
				}
			} else {
				$media_attributes = uncode_get_media_info($item_thumb_id);
				if (!isset($media_attributes)) {
					$media_attributes = new stdClass();
					$media_attributes->metadata = '';
					$media_attributes->post_mime_type = '';
					$media_attributes->post_excerpt = '';
					$media_attributes->post_content = '';
					$media_attributes->guid = '';

					if ( isset($items_thumb_id[0]) && filter_var($items_thumb_id[0], FILTER_VALIDATE_EMAIL) ) {
						$media_attributes->guid = filter_var($items_thumb_id[0], FILTER_SANITIZE_EMAIL);
					}
				}
				$media_metavalues = unserialize($media_attributes->metadata);
				$media_mime = $media_attributes->post_mime_type;
			}

			$consent_id = str_replace( 'oembed/', '', $media_mime );
			uncode_privacy_check_needed( $consent_id );
			if ( uncode_privacy_allow_content( $consent_id ) === false ) {
				$block_classes[] = 'tmb-consent-blocked';
			}

			$media_alt = (isset($media_attributes->alt)) ? $media_attributes->alt : '';

			$oembed_no_control_allowed = true;
			switch ($media_attributes->post_mime_type) {
				case 'oembed/youtube':
					if ( uncode_privacy_allow_content( 'youtube' ) === false ) {
						$oembed_no_control = false;
						$oembed_no_control_allowed = false;
					}
				break;
				case 'oembed/vimeo':
					if ( uncode_privacy_allow_content( 'vimeo' ) === false ) {
						$oembed_no_control = false;
						$oembed_no_control_allowed = false;
					}
				break;
			}

			/** shortcode carousel  **/
			if ($multiple_items) {
				if ( isset( $oembed_no_control ) && $oembed_no_control === true ) {
					$oembed_params = ' oembed_params=\'{"no-control":"true"';
					$oembed_params .= ',"play_hover":"' . $block_data['play_hover'] . '"';
					$oembed_params .= ',"play_pause":"' . $block_data['play_pause'] . '"';
					$oembed_params .= ',"mobile_videos":"' . $block_data['mobile_videos'] . '"';
					$oembed_params .= ',"media_poster":"' . $media_poster . '"';
					$oembed_params .= '}\'';
				} else {
					$oembed_params = '';
				}

				$lb_adv_videos = '';
				if ( isset( $block_data['data-lb-autoplay'] ) || isset( $block_data['data-lb-muted'] ) ) {
					$lb_adv_videos .= ' lb_video_advanced="yes"';
					if ( isset( $block_data['data-lb-autoplay'] ) ) {
						$lb_adv_videos = ' lb_autoplay="' . esc_attr($block_data['data-lb-autoplay']) . '"';
					}

					if ( isset( $block_data['data-lb-muted'] ) ) {
						$lb_adv_videos = ' lb_muted="' . esc_attr($block_data['data-lb-muted']) . '"';
					}
				}

				$shortcode = '[vc_gallery nested="yes" el_id="gallery-'.rand().'" medias="'.$item_thumb_id.'" type="carousel" style_preset="'.$style_preset.'" single_padding="0" thumb_size="'.$images_size.'" carousel_lg="1" carousel_md="1" carousel_sm="1" gutter_size="0" media_items="media" carousel_interval="0" carousel_dots="yes" carousel_dots_mobile="yes" carousel_autoh="yes" carousel_type="fade" carousel_nav="no" carousel_nav_mobile="no" carousel_dots_inside="yes" single_text="overlay" single_border="yes" single_width="'.$single_width.'" single_height="'.$single_height.'" single_text_visible="no" single_text_anim="no" single_overlay_visible="no" single_overlay_anim="no" single_image_anim="no" lbox_skin="'.(isset($lightbox_classes['data-skin']) ? $lightbox_classes['data-skin'] : '' ).'" lbox_transparency="'.(isset($lightbox_classes['data-transparency']) ? $lightbox_classes['data-transparency'] : '').'" lbox_title="'.(isset($lightbox_classes['data-title']) && $lightbox_classes['data-title'] === true).'" lbox_caption="'.(isset($lightbox_classes['data-caption']) && $lightbox_classes['data-caption'] === true).'" lbox_dir="'.(isset($lightbox_classes['data-dir']) ? $lightbox_classes['data-dir'] : '').'" lbox_social="'.(isset($lightbox_classes['data-social']) && $lightbox_classes['data-social'] === true).'" lbox_no_tmb="'.(isset($lightbox_classes['data-notmb']) && $lightbox_classes['data-notmb'] === true).'" lbox_no_arrows="'.(isset($lightbox_classes['data-noarr']) && $lightbox_classes['data-noarr'] === true).'" lbox_actual_size="'.(isset($lightbox_classes['data-actual-size']) && $lightbox_classes['data-actual-size'] === true).'" lbox_full="'.(isset($lightbox_classes['data-full']) && $lightbox_classes['data-full'] === true).'" lbox_counter="'.(isset($lightbox_classes['data-counter']) && $lightbox_classes['data-counter'] === true).'" lbox_download="'.(isset($lightbox_classes['data-download']) && $lightbox_classes['data-download'] === true).'" ' . $oembed_params . $lb_adv_videos . ']';

				$media_oembed = uncode_get_oembed($item_thumb_id, $shortcode, 'shortcode', false);
				$media_code = $media_oembed['code'];
				$media_type = $media_oembed['type'];
				if(($key = array_search('tmb-overlay-anim', $block_classes)) !== false) {
				    unset($block_classes[$key]);
				}
				if(($key = array_search('tmb-overlay-text-anim', $block_classes)) !== false) {
				    unset($block_classes[$key]);
				}
				if(($key = array_search('tmb-image-anim', $block_classes)) !== false) {
				    unset($block_classes[$key]);
				}
				$image_orig_w = $single_width;
				$image_orig_h = $single_height;
				$object_class = 'nested-carousel object-size';
			} else {
				/** check if open to lightbox **/
				if ($lightbox_classes && !( isset($block_data['explode_album']) && is_array($block_data['explode_album']) && !empty($block_data['explode_album']) ) ) {
					if ( isset($lightbox_classes['data-title']) && $lightbox_classes['data-title'] === true && isset($media_attributes->post_title) ) {
						$lightbox_classes['data-title'] = apply_filters( 'uncode_media_attribute_title', $media_attributes->post_title, $items_thumb_id[0]);

						if ( isset($block_data['id']) ) {
							$lbox_permalink = get_permalink($block_data['id']);

							if ( ( apply_filters('uncode_lightbox_permalink', false) || ( isset($lightbox_classes['data-title-link']) && $lightbox_classes['data-title-link'] === true ) ) && $lbox_permalink ) {
								$lightbox_classes['data-title'] = '<a href=\'' . esc_url($lbox_permalink) . '\'>' . $lightbox_classes['data-title'] . '</a>';
							}
						}
					}
					if ( isset($lightbox_classes['data-caption']) && $lightbox_classes['data-caption'] === true && isset($media_attributes->post_excerpt) ) {
						$lightbox_classes['data-caption'] = apply_filters( 'uncode_media_attribute_excerpt', $media_attributes->post_excerpt, $items_thumb_id[0]);
					}
				}

				/** This is a self-hosted image **/
				if ($media_mime !== 'image/svg+xml' && strpos($media_mime, 'image/') !== false && $media_mime !== 'image/url' && isset($media_metavalues['width']) && isset($media_metavalues['height'])) {

					$image_orig_w = $media_metavalues['width'];
					$image_orig_h = $media_metavalues['height'];

					/** check if open to lightbox **/
					if ($lightbox_classes) {
						global $adaptive_images, $adaptive_images_async;
						if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
							$create_link = (is_array($media_attributes->guid) ? $media_attributes->guid['url'] : $media_attributes->guid);
						} else {
							$big_image = uncode_resize_image($media_attributes->id, (is_array($media_attributes->guid) ? $media_attributes->guid['url'] : $media_attributes->guid), $media_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
							$create_link = $big_image['url'];
						}
						$create_link = strtok($create_link, '?');
					}

					/** calculate height ratio if masonry and thumb size **/
					if ($style_preset === 'masonry') {
						if ($images_size !== '') {
							$crop = true;
						} else {
							$crop = false;
						}
					} else {
						$crop = true;
					}

					if ($media_mime === 'image/gif' || $media_mime === 'image/url') {
						$resized_image = array(
							'url' => $media_attributes->guid,
							'width' => $image_orig_w,
							'height' => $image_orig_h,
						);
					} else {
						if ( isset( $block_data['justify_row_height'] ) ) { //if Justified-Gallery is the case
							$single_width_check = '';
							$single_height = $block_data['justify_row_height'];
							$img_ratio = $image_orig_w/$image_orig_h;
							if ( $img_ratio < 1 ) { //portrait orientation
								$single_height = $single_height * 2;
							}

						}
						if ( $single_image_size !== '' && $single_text === 'lateral' ) {
							$single_width = $single_width / ( 12 / $single_image_size );
							if ( $style_preset !== 'metro') {
								$single_height = $single_height / ( 12 / $single_image_size );
							}
						}
						global $woocommerce_loop, $uncode_vc_index, $uncode_vc_gallery, $is_footer, $is_header_cb;
 						if ( !$uncode_vc_index && !$uncode_vc_gallery && !$is_footer && !$is_header_cb && ( !function_exists('is_product') || !is_product() ) && ( ( isset($woocommerce_loop['is_shortcode']) && $woocommerce_loop['is_shortcode'] ) || ( function_exists('is_product_category') && is_product_category() ) || ( function_exists('is_product_tag') && is_product_tag() ) || apply_filters( 'uncode_wc_apply_customizer_sizes', false, $block_data ) ) ) {
							$WC_vers = uncode_get_WC_version();
							if ( version_compare( $WC_vers, '3.3', '<' ) ) {
								$wc_catalog_image_size = get_option('shop_catalog_image_size');
								$wc_crop = $wc_catalog_image_size['crop'];
								$wc_height = $wc_catalog_image_size['height'];
								$wc_width = $wc_catalog_image_size['width'];
							} else {
								$wc_crop = get_option('woocommerce_thumbnail_cropping') != 'uncropped';
								$wc_height = get_option('woocommerce_thumbnail_cropping') == '1:1' ? 1 : get_option('woocommerce_thumbnail_cropping_custom_height');
								$wc_width = get_option('woocommerce_thumbnail_cropping') == '1:1' ? 1 : get_option('woocommerce_thumbnail_cropping_custom_width');
							}

							$wc_catalog_image_size = get_option('shop_catalog_image_size');
							if ( $wc_crop ) {
								$crop = true;
								$wc_height = max($wc_height, 1);
								$wc_width = max($wc_width, 1);
								$single_height = ( $single_width * $wc_height ) / $wc_width;
							}
						}
						global $col_size_gl;
						$col_size_gl = array(
							'single_width' => $single_width,
							'single_height' => $single_height,
							'crop' => $crop
						);
						$resized_image = uncode_resize_image( $media_attributes->id, $media_attributes->guid, $media_attributes->path, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
					}
					if ( isset( $block_data['id'] ) && $single_secondary !== '' ) {
						// $image_orig_w and $image_orig_h in this case are placeholder since they'll be extracted then in the function
						// PS. Since the introduction of the new SRCSET system, we need $image_orig_w and $image_orig_h to
						// calculate the ratio of the main featured image and pass it to the secondary image
						// So they are not merely placeholders now.
						$secondary_featured_image = uncode_adaptive_secondary_featured_image( $block_data['id'], $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed, $is_tax_block, $block_data );
					}
					$item_media = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
					if (strpos($media_mime, 'image/') !== false && $media_mime !== 'image/gif' && $media_mime !== 'image/url') {
						// Single media, media gallery, masonry backgrounds
						if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
							$adaptive_async_class = uncode_get_adaptive_async_class();
							if ( $adaptive_async_class ) {
								$adaptive_async_data = uncode_get_adaptive_async_data( $item_thumb_id, $media_attributes, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
								$adaptive_async_data = apply_filters( 'uncode_adaptive_get_async_data', $adaptive_async_data, 'ai_async', $block_data, array(), $item_thumb_id, $media_attributes, $resized_image, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
							}
						} else if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img ) {
							if ( $activate_webp ) {
								$block_data['activate_webp'] = true;
							}
							$adaptive_async_class    = uncode_get_srcset_async_class( $block_data );
							$adaptive_async_data_all = uncode_get_srcset_async_data( $block_data, $dynamic_srcset_sizes, $item_thumb_id, $media_attributes, $resized_image, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
							$adaptive_async_data_all = apply_filters( 'uncode_adaptive_get_async_data', $adaptive_async_data_all, 'srcset', $block_data, $dynamic_srcset_sizes, $item_thumb_id, $media_attributes, $resized_image, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
							$adaptive_async_data     = $adaptive_async_data_all['string'];
						} else {
							// Empty by default but it can be filtered
							$adaptive_async_data = apply_filters( 'uncode_adaptive_get_async_data', '', 'ai', $block_data, array(), $item_thumb_id, $media_attributes, $resized_image, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop, $single_fixed );
						}
					}
					$image_orig_w = isset( $resized_image['width'] ) ? $resized_image['width'] : 0;
					$image_orig_h = isset( $resized_image['height'] ) ? $resized_image['height'] : 0;
				} elseif ($media_mime === 'oembed/svg') {
					$media_type = 'html';
					$media_code = $media_attributes->post_content;
					if ($media_mime === 'oembed/svg') {
						$media_code = preg_replace('#\s(id)="([^"]+)"#', ' $1="$2-' .uncode_big_rand() .'"', $media_code);
						$media_code = preg_replace('#\s(xmlns)="([^"]+)"#', '', $media_code);
						$media_code = preg_replace('#\s(xmlns:svg)="([^"]+)"#', '', $media_code);
						$media_code = preg_replace('#\s(xmlns:xlink)="([^"]+)"#', '', $media_code);
						if (isset($media_metavalues['width']) && $media_metavalues['width'] !== '1') {
							$icon_width = ' style="width:'.$media_metavalues['width'].'px"';
						} else {
							$icon_width = ' style="width:100%"';
						}
						$media_code = '<span'.$icon_width.' class="icon-media">'.$media_code.'</span>';
						if ($media_attributes->animated_svg) {
							$media_metavalues = unserialize($media_attributes->metadata);
							$icon_time = (isset($media_attributes->animated_svg_time) && $media_attributes->animated_svg_time !== '') ? $media_attributes->animated_svg_time : 100;
							preg_match('/(id)=("[^"]*")/i', $media_code, $id_attr);
							if (isset($id_attr[2])) {
								$id_icon = str_replace('"', '', $id_attr[2]);
							} else {
								$id_icon = 'icon-' . uncode_big_rand();
								$media_code = preg_replace('/<svg/', '<svg id="' . $id_icon . '"', $media_code);
							}
							if (isset($block_data['delay']) && $block_data['delay'] !== '') {
								$icon_delay = $block_data['delay'];
							} else {
								$icon_delay = false;
							}
							if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
								$media_code .= '<div data-id="' . $id_icon . '" data-time="' . $icon_time .'" data-delay="' . $icon_delay . '"></div>';
							} else {
								$media_code .= "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function(event) { UNCODE.vivus('".$id_icon."', '".$icon_time."', '".$icon_delay."', false); });</script>";
							}
						}
					}
				} elseif ($media_mime === 'image/svg+xml') {
					$media_type = 'other';
					$media_code = $media_attributes->guid;
					$image_orig_w = isset( $media_metavalues['width'] ) ? $media_metavalues['width'] : '';
					$image_orig_h = isset( $media_metavalues['width'] ) ? $media_metavalues['height'] : '';
					if (isset($media_metavalues['width']) && $media_metavalues['width'] !== '1') {
						$icon_width = ' style="width:'.$media_metavalues['width'].'px"';
					} else {
						$icon_width = ' style="width:100%"';
					}
					$id_icon = 'icon-' . uncode_big_rand();
					if ($media_attributes->animated_svg) {
						$media_metavalues = unserialize($media_attributes->metadata);
						$icon_time = (isset($media_attributes->animated_svg_time) && $media_attributes->animated_svg_time !== '') ? $media_attributes->animated_svg_time : 100;
						$media_code = '<span id="'.$id_icon.'"'.$icon_width.' class="icon-media"></span>';
						if (isset($block_data['delay']) && $block_data['delay'] !== '') {
							$icon_delay = $block_data['delay'];
						} else {
							$icon_delay = false;
						}
						if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
							$media_code .= '<div data-id="' . $id_icon . '" data-time="' . $icon_time .'" data-delay="' . $icon_delay . '" data-thumb="' . $media_attributes->guid . '"></div>';
						} else {
							$media_code .= "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function(event) { UNCODE.vivus('".$id_icon."', '".$icon_time."', '".$icon_delay."', '".$media_attributes->guid."'); });</script>";
						}
					} else {
						$media_code = '<span id="'.$id_icon.'"'.$icon_width.' class="icon-media"><img src="'.$media_code.'" alt="' . $media_alt . '" /></span>';
					}
				} else { // This is an oembed
					$object_class = 'object-size';
					/** external image **/
					if ($media_mime === 'image/gif' || $media_mime === 'image/url') {
						$item_media = $media_attributes->guid;
						$image_orig_w = $media_metavalues['width'];
						$image_orig_h = $media_metavalues['height'];
						if ($lightbox_classes) {
							$create_link = $item_media;
						}
					} else { // any other oembed
						if ( !isset($has_ratio) || ( $lightbox_classes && $media_poster ) ) {
							$single_height_oembed = null;
						} else {
							$single_height_oembed = $single_height;
						}
						$is_metro = ($style_preset === 'metro');
						$is_text_carousel = $carousel_textual === 'yes' ? true : false;
						$oembed_params = array();
						if ( isset( $oembed_no_control ) && $oembed_no_control === true ) {
							$oembed_params['no-control'] = true;
							$oembed_params['play_hover'] = false;
							$oembed_params['play_pause'] = false;
							if ( isset( $block_data['play_hover'] ) && $block_data['play_hover'] !== '' ) {
								$oembed_params['play_hover'] = true;
								$oembed_params['play_pause'] = isset( $block_data['play_pause'] ) && $block_data['play_pause'] !== '';
							}
							$oembed_params['mobile_videos'] = isset( $block_data['mobile_videos'] ) ? $block_data['mobile_videos'] : '';
							$oembed_params['media_poster'] = $but_media_poster;
							$lightbox_code = true;
						}
						$media_oembed = uncode_get_oembed($item_thumb_id, $media_attributes->guid, $media_attributes->post_mime_type, $media_poster, $media_attributes->post_excerpt, $media_attributes->post_content, $lightbox_code, $single_width, $single_height_oembed, $single_fixed, $is_metro, $is_text_carousel, $oembed_params);
						/** check if is an image oembed  **/
						if ($media_oembed['type'] === 'image') {
							$item_media = esc_attr($media_oembed['code']);
							$image_orig_w = $media_oembed['width'];
							$image_orig_h = $media_oembed['height'];
							$media_type = 'image';
							if ($lightbox_classes) {
								$create_link = $media_oembed['code'];
							}
						} else {
							/** check if there is a poster  **/
							if ( ( isset($media_oembed['poster']) && $media_oembed['poster'] !== '' && $media_poster && $oembed_no_control_allowed === true ) || ( isset( $oembed_no_control ) && $oembed_no_control === true ) ) {
								/** calculate height ratio if masonry and thumb size **/
								if ($style_preset === 'masonry') {
									if ($images_size !== '') {
										$crop = true;
									} else {
										$crop = false;
									}
								} else {
									$crop = true;
								}

								if ( isset( $oembed_no_control ) && $oembed_no_control === true && !$media_poster ) {
									$media_oembed['poster'] = $item_thumb_id;
									$poster_th_id = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
									$poster_th_src = wp_get_attachment_image_src($poster_th_id, 'thumbnail');
									if ( isset($poster_th_src[0]) && $poster_th_src[0] !== '' ) {
										$data_lb .= ' data-external-thumb-image="' . esc_url($poster_th_src[0]) . '"';
									}
								}

								if (!empty($media_oembed['poster']) && $media_oembed['poster'] !== '') {
									$poster_attributes = uncode_get_media_info($media_oembed['poster']);
									if ( ! is_null( $poster_attributes ) ) {
										$media_metavalues = unserialize($poster_attributes->metadata);
										$image_orig_w = $media_metavalues['width'];
										$image_orig_h = $media_metavalues['height'];
										$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop);
										$item_media = isset( $resized_image['url'] ) ? esc_attr($resized_image['url']) : false;
										if (strpos($poster_attributes->post_mime_type, 'image/') !== false && $poster_attributes->post_mime_type !== 'image/gif' && $poster_attributes->post_mime_type !== 'image/url') {
											// Poster oembed
											if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
												$adaptive_async_class = uncode_get_adaptive_async_class();
												if ( $adaptive_async_class ) {
													$adaptive_async_data = uncode_get_adaptive_async_data( $item_thumb_id, $poster_attributes, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop );
												}
											} else if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img ) {

												if ( $media_poster ) {
													$poster_th_id = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
												}

												if ( $activate_webp ) {
													$block_data['activate_webp'] = true;
												}

												$adaptive_async_class    = uncode_get_srcset_async_class( $block_data );
												$adaptive_async_data_all = uncode_get_srcset_async_data( $block_data, $dynamic_srcset_sizes, $poster_th_id, $poster_attributes, $resized_image, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop );
												$adaptive_async_data     = $adaptive_async_data_all['string'];
											}
										}
										$image_orig_w = isset( $resized_image['width'] ) ? $resized_image['width'] : 0;
										$image_orig_h = isset( $resized_image['height'] ) ? $resized_image['height'] : 0;
										$media_type = 'image';
										if ($lightbox_classes) {
											switch ($media_attributes->post_mime_type) {
							    				case 'oembed/twitter':
							    				case 'oembed/html':
							    					global $adaptive_images, $adaptive_images_async;
														if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
															$poster_url = $poster_attributes->guid;
														} else {
															$big_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, 12, null, false);
															$create_link = $big_image['url'];
														}
								    			break;
								    			case 'oembed/iframe':
													$create_link = '#inline-'.$item_thumb_id.'" data-type="inline" target="#inline' . $item_thumb_id;
													$inline_hidden = '<div id="inline-' . esc_attr( $item_thumb_id ) . '" class="ilightbox-html" style="display: none;">' . $media_attributes->post_content . '</div>';
								    			break;
								    			case 'oembed/youtube':
								    				if ( uncode_privacy_allow_content( 'youtube' ) === false ) {
									    				$create_link = '#inline-' . esc_attr( $item_thumb_id ) . '" data-type="inline" target="#inline' . esc_attr( $item_thumb_id );
									    				$inline_hidden = '<div id="inline-' . esc_attr( $item_thumb_id ) . '" class="ilightbox-html" style="display: none;">' . $media_oembed['code'] . '</div>';
								    				} else {
									    				$create_link = $media_oembed['code'];
								    				}
								    			break;
								    			case 'oembed/vimeo':
								    				if ( uncode_privacy_allow_content( 'vimeo' ) === false ) {
									    				$create_link = '#inline-' . esc_attr( $item_thumb_id ) . '" data-type="inline" target="#inline' . esc_attr( $item_thumb_id );
									    				$inline_hidden = '<div id="inline-' . esc_attr( $item_thumb_id ) . '" class="ilightbox-html" style="display: none;">' . $media_oembed['code'] . '</div>';
								    				} else {
									    				$create_link = $media_oembed['code'];
								    				}
								    			break;
								    			case 'oembed/soundcloud':
								    				if ( uncode_privacy_allow_content( 'soundcloud' ) === false ) {
									    				$create_link = '#inline-' . esc_attr( $item_thumb_id ) . '" data-type="inline" target="#inline' . esc_attr( $item_thumb_id );
									    				$inline_hidden = '<div id="inline-' . esc_attr( $item_thumb_id ) . '" class="ilightbox-html" style="display: none;">' . $media_oembed['code'] . '</div>';
								    				} else {
									    				$create_link = $media_oembed['code'];
								    				}
								    			break;
								    			case 'oembed/spotify':
								    				if ( uncode_privacy_allow_content( 'spotify' ) === false ) {
									    				$create_link = '#inline-' . esc_attr( $item_thumb_id ) . '" data-type="inline" target="#inline' . esc_attr( $item_thumb_id );
									    				$inline_hidden = '<div id="inline-' . esc_attr( $item_thumb_id ) . '" class="ilightbox-html" style="display: none;">' . $media_oembed['code'] . '</div>';
								    				} else {
									    				$create_link = $media_oembed['code'];
								    				}
								    			break;
								    			default;
								    				$create_link = $media_oembed['code'];
								    			break;
								    		}
										}
									}
								}
							} else {
								$media_code = $media_oembed['code'];
								if ( isset($media_oembed['poster']) && $media_oembed['poster'] !== '' && isset( $oembed_no_control ) && $oembed_no_control === true) {
									$media_type = 'image';
								} else {
									$media_type = $media_oembed['type'];
								}
								$object_class = $media_oembed['class'];
								if ($style_preset === 'metro' || $images_size != '') {
									$image_orig_w = $single_width;
									$image_orig_h = $single_height;
								} else {
									$image_orig_w = $media_oembed['width'];
									$image_orig_h = $media_oembed['height'];
								}

								if (strpos($media_mime,'audio/') !== false && isset($media_oembed['poster']) && $media_oembed['poster'] !== '') {
					      			$poster_attributes = uncode_get_media_info($media_oembed['poster']);
						    		$media_metavalues = unserialize($poster_attributes->metadata);
						    		$image_orig_w = $media_metavalues['width'];
									$image_orig_h = $media_metavalues['height'];
						    		$resized_image = uncode_resize_image($poster_attributes->id, $poster_attributes->guid, $poster_attributes->path, $image_orig_w, $image_orig_h, $single_width, $single_height, $crop);
						    		$media_oembed['dummy'] = ($image_orig_h / $image_orig_w) * 100;
					      		}

			      				/** This is an iframe **/
								if ($media_mime === 'oembed/iframe') {
									$media_type = 'other';
									$media_code = $media_attributes->post_content;
									$image_orig_w = $media_metavalues['width'];
									$image_orig_h = $media_metavalues['height'];
								}

								if ($image_orig_h === 0) {
									$image_orig_h = 1;
								}

								if ($media_oembed['dummy'] !== 0 && $style_preset !== 'metro' && uncode_privacy_allow_content( $consent_id ) !== false) {
									$dummy_oembed = ' style="padding-top: ' . $media_oembed['dummy'] . '%"';
								}
								if ($lightbox_classes && $media_type === 'image') {
									if ( ! isset( $oembed_no_control ) || $oembed_no_control !== true ) {
										$create_link = $media_oembed['code'];
									}
								}
							}
						}
					}
				}
			}
		}

		if ( $block_data['template'] === 'inline-image' && strpos($media_attributes->post_mime_type, 'image/') === false ) {
			return;
		}

		if ($item_media === '' && !isset($media_attributes->guid) && !$multiple_items) {
			$media_type = 'image';
			$item_media = 'http://placehold.it/500&amp;text=media+not+available';
			$image_orig_w = 500;
			$image_orig_h = 500;
		}

		if (!$with_html) {
			return array(
				'code' => (($media_type === 'image') ? esc_url($item_media) : $media_code),
				'type' => $media_type,
				'width' => $image_orig_w,
				'height' => $image_orig_h,
				'alt' => $media_alt,
				'async' => ($adaptive_async_data === '' ? false : array('class'=>$adaptive_async_class,'data'=>$adaptive_async_data))
			);
		}

		if ($lightbox_classes) {
			$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $lightbox_classes, array_keys($lightbox_classes));
			$lightbox_data = ' ' . implode(' ', $div_data_attributes);
			$lightbox_data .= ' data-lbox="ilightbox_' . $el_id . '"';
			$video_src = $video_enhanced = '';
			if (isset($media_attributes->post_mime_type) && strpos($media_attributes->post_mime_type, 'video/') !== false) {
				$video_src .= 'html5video:{preload:\'true\',';
				$video_autoplay = get_post_meta($item_thumb_id, "_uncode_video_autoplay", true);
				if ($video_autoplay) {
					$video_src .= 'autoplay:\'true\',';
					$video_enhanced .= ' data-autoplay="true"';
				}
				$video_loop = get_post_meta($item_thumb_id, "_uncode_video_loop", true);
				if ($video_loop) {
					$video_src .= 'loop:\'true\',';
					$video_enhanced .= ' data-loop="true"';
				}
				$alt_videos = get_post_meta($item_thumb_id, "_uncode_video_alternative", true);
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


			if (isset($media_attributes->metadata)) {
				$media_metavalues = unserialize($media_attributes->metadata);
				if ( uncode_privacy_allow_content( $consent_id ) === false ) {
					$poster_th_id = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
					$poster_attributes = uncode_get_media_info($poster_th_id);
					if ( is_object($poster_attributes) ) {
						$poster_metavalues = unserialize($poster_attributes->metadata);
						$media_dimensions = 'width:' . esc_attr($poster_metavalues['width']) . ',';
						$media_dimensions .= 'height:' . esc_attr($poster_metavalues['height']) . ',';
					} else {
						$media_dimensions = '';
					}
				} else {
					if (isset($media_metavalues['width']) && isset($media_metavalues['height']) && $media_metavalues['width'] !== '' && $media_metavalues['height'] !== '') {
						$media_dimensions = 'width:' . $media_metavalues['width'] . ',';
						$media_dimensions .= 'height:' . $media_metavalues['height'] . ',';
					} else {
						$media_dimensions = '';
					}
				}

				$th_size = $lbox_enhance ? 'thumbnail' : 'medium';
				if ( isset($poster_attributes->id) ) {
					$data_options_th = wp_get_attachment_image_src($poster_attributes->id, $th_size);
				} else {
					if ( isset($media_attributes->id) ) {
						$data_options_th = wp_get_attachment_image_src($media_attributes->id, $th_size);
					}
				}

				if ( $lbox_enhance ) {
					if ( $media_attributes->post_mime_type !== 'oembed/flickr' && isset( $data_options_th[0] ) ) {
						$lightbox_data .= ' data-external-thumb-image="'. $data_options_th[0] .'"';
					}
					if ( strpos($media_attributes->post_mime_type, 'video/') !== false ) {
						$lightbox_data .= 'data-video=\'{"source": [{"src":"' . $create_link . '", "type":"' . $media_attributes->post_mime_type . '"}]}\' data-icon="video"';
					} elseif ( $media_attributes->post_mime_type === 'oembed/youtube' || $media_attributes->post_mime_type === 'oembed/vimeo' ) {
						$lightbox_data .= 'data-icon="video"';
					} elseif ( $media_attributes->post_mime_type === 'oembed/spotify' || $media_attributes->post_mime_type === 'oembed/soundcloud' ) {
						if ( uncode_privacy_allow_content( $consent_id ) === false ) {
							$lightbox_data .= 'data-src="' . $create_link . '"';
						} else {
							$lightbox_data .= 'data-src="' . $create_link . '" data-iframe="true"';
						}
					}
					$lightbox_data .= $video_enhanced;
					if ( isset($media_metavalues['width']) && isset($media_metavalues['height']) ) {
						$lightbox_data .= ' data-lg-size="' . $media_metavalues['width'] . '-' . $media_metavalues['height'] . '"';
					}
				} else {
					if ( isset( $data_options_th ) && is_array( $data_options_th ) && ( !isset( $block_data['data-lbsplit'] ) || $block_data['data-lbsplit'] === false ) ) {
						$lightbox_data .= ' data-options="'.$media_dimensions.$video_src.'thumbnail: \''. $data_options_th[0] .'\'"';
					}
				}
			}
		}

		$layoutArray = array_keys($layout);
		foreach ($layoutArray as $key => $value) {
			if ($value === 'icon') {
				unset($layoutArray[$key]);
			}
		}

		if (!array_key_exists('media',$layout)) {
			$block_classes[] = 'tmb-only-text';
			$with_media = false;
		} else {
			$with_media = true;
		}

		if ($single_text === 'overlay') {
			if ($with_media) {
				$block_classes[] = 'tmb-media-first';
				$block_classes[] = 'tmb-media-last';
			}
			$block_classes[] = 'tmb-content-overlay';
		} else {
			if ( $single_text === 'lateral' ) {
				$block_classes[] = 'tmb-content-lateral';
			} else {
				$block_classes[] = 'tmb-content-under';
			}

			$layoutLast = (string) array_pop($layoutArray);
			if ($with_media) {
				if (($layoutLast === 'media' || $layoutLast === '') && $with_media) {
					$block_classes[] = 'tmb-media-last';
				} else {
					$block_classes[] = 'tmb-media-first';
				}
			}
		}

		if ($single_back_color === '') {
			$block_classes[] = 'tmb-no-bg';
		} else {
			$single_back_color = ' style-' . $single_back_color . '-bg';
		}

		if ( uncode_animations_enabled() && isset( $block_data['parallax'] ) ) {
			if ( isset( $block_data['data-rellax-speed'] ) ) {
				$tmb_data['data-rellax-speed'] = $block_data['data-rellax-speed'];

				if ( apply_filters( 'uncode_mobile_parallax_animation_allowed', false ) ) {
					$tmb_data['data-rellax-xs-speed'] = $block_data['data-rellax-xs-speed'];
					$tmb_data['data-rellax-mobile-speed'] = $block_data['data-rellax-mobile-speed'];
				}
			}

			if ( isset( $block_data['data-rellax-percentage'] ) ) {
				$tmb_data['data-rellax-percentage'] = $block_data['data-rellax-percentage'];
			}

			$single_animation .= ' parallax-el';
		}

		$drop_rand_id = $data_drop_target = '';

		if ( $is_titles ) {
			$drop_rand_id = 'drop-'.uncode_big_rand();
			$tmb_data_parent['data-drop-target'] = $drop_rand_id;
		}

		$div_data_attributes_parent = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $tmb_data_parent, array_keys($tmb_data_parent));
		$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $tmb_data, array_keys($tmb_data));

		$output = '';
		if ( ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
			ob_start();
			do_action( 'woocommerce_before_shop_loop_item');
			$output .= ob_get_clean();
		}

		if ( $lightbox_classes ) {
			$block_classes[] = 'tmb-lightbox';
		}

		if ( isset( $oembed_no_control ) && $oembed_no_control === true ) {
			$block_classes[] = 'has-no-control';

			if ( $media_poster === true ) {
				$block_classes[] = 'no-control-lazy-poster';
			}
		}

		if ( $block_data['template'] === 'inline-image' ) {
			$output .= '<span class="'.implode(' ', $block_classes).'"';
			if ( isset($block_data['inline-img-link']) ) {
				foreach ($block_data['inline-img-link'] as $att => $val) {
					$output .= ' data-link-' . trim($att) . '="' . $val . '"';
				}
			}
			$output .= 	implode(' ', $div_data_attributes) .'><span>';
		} else {
			$output .= '<div class="'.implode(' ', $block_classes).'" '.implode(' ', $div_data_attributes_parent) .'>';
		}

		if ( $is_titles ) {
			$data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
			$data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';
			$output .= 	'<a href="' . esc_url( $title_link ) . '" class="drop-hover-link"' . $data_values . '></a>';
		}

		if ( isset( $block_data['drop_image_separator'] ) && !isset( $block_data['drop_image_separator_first'] ) ) {
			$drop_image_separator_classes = isset( $block_data['drop_image_separator_classes'] ) ? $block_data['drop_image_separator_classes'] : array();
			$output .= '<span class="drop-image-separator drop-image-separator-before '. trim(implode(' ', $drop_image_separator_classes)) . ' ' . trim(implode(' ', $title_classes)) . $single_animation . '"' . $title_style . ' '.implode(' ', $div_data_attributes) .'><span class="drop-image-separator-inner">' . esc_attr( $block_data['drop_image_separator'] ) . '</span></span>';
		}

		if ( isset( $block_data['table_click_row'] ) ) {
			$data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
			$data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';
			$output .= 	'<a href="' . esc_url( $title_link ) . '" class="table-click-row"' . $data_values . '></a>';
		}

		if ( $block_data['template'] !== 'inline-image' ) {
			$output .= 	'<div class="' . (($nested !== 'yes') ? 't-inside' : '').$single_back_color . $single_animation . '" '.implode(' ', $div_data_attributes) .'>';
		}

		if ( $is_table ) {
			if ( isset( $block_data['price_inline'] ) && $block_data['price_inline'] === 'yes' ) {
				$inline_price = ' t-entry-inline-price';
			}
			$output .= 	'<div class="t-inside-post-table t-entry-text' . $inline_price . '">';
		}

		if ( ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
			ob_start();
			do_action( 'woocommerce_before_shop_loop_item_title');
			$output .= ob_get_clean();
		}

		if ($single_text === 'under' && ( $layoutLast === 'media' && !$is_table ) ) {
			$output .= $entry;
		}

		if (array_key_exists('media',$layout) || $single_text === 'overlay') {

			$media_output = '';

			if ( !$is_titles && $block_data['template'] !== 'inline-image' ) {
				$media_output .= 		'<div class="t-entry-visual"><div class="t-entry-visual-tc"><div class="t-entry-visual-cont">';

				//Over image categories
				if ( isset($cat_over) && $cat_over !== '' ) {
					$media_output .= '<span class="t-cat-over' . $no_link_cat . ' ' . $block_data['text_padding'] . ' ' . $cat_over_class . '">' . $cat_over . '</span>';
				}

				if ($style_preset === 'masonry' && ($images_size !== '' || ($single_text !== 'overlay' || $single_elements_click !== 'yes')) && array_key_exists('media',$layout)) {

					if ( uncode_privacy_allow_content( $consent_id ) === false && !isset($has_ratio) ) {
						$poster_th_id = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
						$poster_attributes = uncode_get_media_info($poster_th_id);
						if ( is_object($poster_attributes) ) {
							$poster_metavalues = unserialize($poster_attributes->metadata);
							$image_orig_w = esc_attr($poster_metavalues['width']);
							$image_orig_h = esc_attr($poster_metavalues['height']);
						}
					}

					$image_orig_w = absint( $image_orig_w );
					$image_orig_h = absint( $image_orig_h );

					if ( isset( $oembed_no_control ) && $oembed_no_control === true && isset($media_oembed['width']) && isset($media_oembed['height']) && !$media_poster ) {
						$image_orig_w = $media_oembed['width'];
						$image_orig_h = $media_oembed['height'];
					}

					if ( ( $media_type === 'image' || $media_type === 'email' || uncode_privacy_allow_content( $consent_id ) === false ) && $image_orig_w != 0 && $image_orig_h != 0) {
						$dummy_padding = round( ( $image_orig_h / $image_orig_w ) * 100, 1 );
						if ( strpos($dummy_padding, ',' ) !== false ) {
							$dummy_padding = str_replace(',', '.', $dummy_padding);
						}
						$dummy_style = 'padding-top: '.$dummy_padding.'%;';
						$dummy_class = 'dummy';
						$dummy_content = '';
						$dummy_async_data = '';

						if ( isset( $secondary_featured_image ) && $secondary_featured_image !== false ) {
							$dummy_class          .= ' secondary-dummy-image';
							$adaptive_async_class .= ' has-secondary-featured-image';

							// When dynamic SRCSET is active, we use images
							// instead of backgrounds for the secondary image
							if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img ) {
								$secondary_featured_image_html = '';

								if ( isset( $secondary_featured_image['id'] ) && $secondary_featured_image['id'] > 0 ) {
									$secondary_adaptive_async_class = uncode_get_srcset_async_class( $block_data );
									$secondary_adaptive_async_class .= ' wp-image-' . $secondary_featured_image['id'];

									$secondary_async_data = $secondary_featured_image['data_async'];
									$secondary_url        = isset( $secondary_featured_image['url'] ) ? $secondary_featured_image['url'] : '';
									$secondary_orig_w     = isset( $secondary_featured_image['width'] ) ? $secondary_featured_image['width'] : '';
									$secondary_orig_h     = isset( $secondary_featured_image['height'] ) ? $secondary_featured_image['height'] : '';
									$secondary_alt        = isset( $secondary_featured_image['alt'] ) ? $secondary_featured_image['alt'] : '';

									$secondary_featured_image_html = apply_filters( 'uncode_secondary_post_thumbnail_html', '<img' . ( $secondary_adaptive_async_class !== '' ? ' class="' . trim( $secondary_adaptive_async_class ) . '"' : '' ) . ' src="' . $secondary_url . '" width="' . $secondary_orig_w . '" height="' . $secondary_orig_h . '" alt="' . $secondary_alt . '"' . ( $secondary_async_data !== '' ? $secondary_async_data : '' ) . ' />', $secondary_featured_image['id'] );
								}

								$dummy_content = $secondary_featured_image_html;
							} else {
								if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
									$adaptive_async_class = uncode_get_adaptive_async_class();
									if ( $adaptive_async_class ) {
										$dummy_async_data = $secondary_featured_image['data_async'];
										$dummy_class .= $adaptive_async_class; // Secondary dummy image
									}
									$adaptive_async_class .= ' has-secondary-featured-image';
								}

								$dummy_style .= 'background-image:url(' . esc_attr( $secondary_featured_image['url'] ) . ');';
							}
						}

						if ( $block_data['template'] !== 'inline-image' ) {
							$media_output .= 			'<div class="' . esc_attr( $dummy_class ) . '" style="' . $dummy_style . '"' . $dummy_async_data . '>' . $dummy_content . '</div>';
						}
					}

				}

				if (($single_text !== 'overlay' || $single_elements_click !== 'yes') && ( ( isset( $oembed_no_control ) && $oembed_no_control === true ) || $media_type === 'image' || ( $media_mime === 'image/svg+xml' && apply_filters( 'uncode_use_svgs_for_links', false ) ) ) && !isset($block_data['is_avatar'])) {

					if ($style_preset === 'masonry') {
						$a_classes[] = 'pushed';
					}

					$data_values = (isset($block_data['link']['target']) && !empty($block_data['link']['target']) && is_array($block_data['link'])) ? ' target="'.trim($block_data['link']['target']).'"' : '';
					$data_values .= (isset($block_data['link']['rel']) && !empty($block_data['link']['rel']) && is_array($block_data['link'])) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';

					//Albums
					if ( isset($block_data['explode_album']) && is_array($block_data['explode_album']) && !empty($block_data['explode_album']) ) {
						$create_link = '#';
						$album_item_dimensions = '';
						$inline_hidden = '';
						foreach ($block_data['explode_album'] as $key_album => $album_item_id) {
							$album_item_id = apply_filters( 'wpml_object_id', $album_item_id, 'attachment' );
							$album_item_attributes = uncode_get_album_item($album_item_id);

							if ( $album_item_attributes === null ) {
								continue;
							}

							if ( $album_item_attributes['mime_type'] === 'oembed/twitter' ) {
								continue;
							}

							if ( $media_poster ) {
								$album_th_id = $album_item_attributes['poster'];
							} else {
								$album_th_id = $album_item_id;
							}

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
											$subHtml .= '<h6>' . esc_attr(addslashes($album_item_title)) . '</h6>';
										}
										if ( $album_item_caption !== '' ) {
											$subHtml .= '<p>' . esc_html(addslashes($album_item_caption)) . '</p>';
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
										$poster_th_id = get_post_meta($album_th_id, "_uncode_poster_image", true);
										$poster_attributes = uncode_get_media_info($poster_th_id);
										$poster_metavalues = unserialize($poster_attributes->metadata);
										$album_item_dimensions .= '"width":"' . esc_attr($album_item_attributes['width']) . '",';
										$album_item_dimensions .= '"height":"' . esc_attr($album_item_attributes['height']) . '",';
										$resize_album_item = wp_get_attachment_image_src($poster_th_id, 'medium');
										if ( $lbox_enhance ) {
											$album_item_dimensions .= '"thumb":"' . esc_url($resize_album_item[0]) . '",';
											$album_item_dimensions .= '"src":"' . esc_attr('#inline-' . $el_id . '-' . $album_th_id) . '",';
											$album_item_dimensions .= '"size":"' .  esc_attr($album_item_attributes['width']) . '-' . esc_attr($album_item_attributes['height']) . '",';
										} else {
											$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
											$album_item_dimensions .= '"url":"' . esc_attr('#inline-' . $el_id . '-' . $album_th_id) . '",';
										}
										if ( $album_item_attributes['mime_type'] === 'oembed/vimeo' || $album_item_attributes['mime_type'] === 'oembed/youtube' ) {
											$album_item_dimensions .= '"oembed":"video",';
										}
										$album_item_dimensions .= '"type":"inline"';
										if ( isset( $block_data['data-lbsplit'] ) && $block_data['data-lbsplit'] === true ) {
											$create_link = esc_attr('#inline-' . $el_id . '-' . $album_th_id);
											$media_dimensions = 'width:' . $album_item_attributes['width'] . ',';
											$media_dimensions .= 'height:' . $album_item_attributes['height'] . ',';
											$lightbox_data .= ' data-options="'.$media_dimensions.$video_src.'"';
										}
										$inline_hidden .= '<div id="inline-' . esc_attr( $el_id . '-' . $album_th_id ) . '" class="ilightbox-html" style="display: none;">' . $album_item_attributes['url'] . '</div>';
										apply_filters( 'uncode_before_checking_consent', true, $album_item_attributes['mime_type'] );
									} else {
										$is_poster = isset( $block_data['poster'] ) && $block_data['poster'] ? true : false;
										if (
											$album_item_attributes['mime_type'] === 'oembed/vimeo'
											||
											$album_item_attributes['mime_type'] === 'oembed/youtube'
											||
											$album_item_attributes['mime_type'] === 'oembed/spotify'
											||
											$album_item_attributes['mime_type'] === 'oembed/soundcloud'
											||
											strpos( $album_item_attributes['mime_type'], 'video/' ) !== false && ! $is_poster
										) {
											$poster_th_id = get_post_meta($album_th_id, "_uncode_poster_image", true);
											if ( !$poster_th_id ) {
												$poster_th_id = $album_th_id;
											}
											$poster_attributes = uncode_get_media_info($poster_th_id);
											$resize_album_item = wp_get_attachment_image_src($poster_th_id, 'medium');
											if ( $lbox_enhance ) {
												$album_item_dimensions .= '"thumb":"' . esc_url($resize_album_item[0]) . '",';
												$album_item_dimensions .= '"size":"' .  esc_attr($album_item_attributes['width']) . '-' . esc_attr($album_item_attributes['height']) . '",';
											} else {
												$album_item_dimensions .= '"width":"' . esc_attr($album_item_attributes['width']) . '",';
												$album_item_dimensions .= '"height":"' . esc_attr($album_item_attributes['height']) . '",';
												$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
											}
										} else {
											$resize_album_item = wp_get_attachment_image_src($thumb_attributes->id, 'medium');
											if ( $lbox_enhance ) {
												$album_item_dimensions .= '"thumb":"' . esc_url($resize_album_item[0]) . '",';
												$album_item_dimensions .= '"size":"' .  esc_attr($album_item_attributes['width']) . '-' . esc_attr($album_item_attributes['height']) . '",';
											} else {
												$album_item_dimensions .= '"width":"' . esc_attr($album_item_attributes['width']) . '",';
												$album_item_dimensions .= '"height":"' . esc_attr($album_item_attributes['height']) . '",';
												$album_item_dimensions .= '"thumbnail":"' . esc_url($resize_album_item[0]) . '",';
											}
										}

										if ( $lbox_enhance ) {
											if ( strpos($album_item_attributes['mime_type'], 'video/') !== false ) {
												$album_item_dimensions .= '"video":{"source":[{"src":"' . esc_url($album_item_attributes['url']) . '","type":"' . $album_item_attributes['mime_type'] . '"}],"attributes":{"preload":"false","controls":"true"}},';
											} elseif ( $album_item_attributes['mime_type'] === 'oembed/vimeo' || $album_item_attributes['mime_type'] === 'oembed/youtube' ) {
												$album_item_dimensions .= '"oembed":"video",';
											}
											$album_item_dimensions .= '"src":"' . esc_url($album_item_attributes['url']) . '"';
										} else {
											$album_item_dimensions .= '"url":"' . esc_url($album_item_attributes['url']) . '"';
										}
										if ( isset( $block_data['data-lbsplit'] ) && $block_data['data-lbsplit'] === true ) {
											$create_link = esc_url($album_item_attributes['url']);
											$media_dimensions = 'width:' . $album_item_attributes['width'] . ',';
											$media_dimensions .= 'height:' . $album_item_attributes['height'] . ',';
											$lightbox_data .= ' data-options="'.$media_dimensions.$video_src.'"';
										}
									}
									$album_item_dimensions .= '},';
								}
							}
						}
						$album_item_dimensions = trim(preg_replace('/\t+/', '', $album_item_dimensions));//remove tabs from string
						if ( !isset( $block_data['data-lbsplit'] ) || $block_data['data-lbsplit'] === false ) {
							$data_values .= ' data-album=\'[' . rtrim($album_item_dimensions, ',') . ']\'';

							if ( isset( $block_data['data-lb-autoplay'] ) ) {
								$data_values .= ' data-lb-autoplay="' . esc_attr($block_data['data-lb-autoplay']) . '"';
							}

							if ( isset( $block_data['data-lb-muted'] ) ) {
								$data_values .= ' data-lb-muted="' . esc_attr($block_data['data-lb-muted']) . '"';
							}
						}
					}
					if ( isset($block_data['lb_index']) ) {
						$data_values .= ' data-lb-index="' . $block_data['lb_index'] . '"';
					}

					if ( isset( $inline_hidden ) ) {
						$media_output .= $inline_hidden;
					}

					if ( $lbox_enhance && $lightbox_classes ) {
						if ( strpos($media_attributes->post_mime_type, 'video/') === false && $media_attributes->post_mime_type !== 'oembed/spotify' && ( ! isset($block_data['album_id']) || $block_data['album_id'] === '' ) ) {
							$href_att = ' href="'. ( ($media_type === 'image' || ( $media_mime === 'image/svg+xml' && apply_filters( 'uncode_use_svgs_for_links', false ) ) ) ? $create_link : '').'"';
						} else {
							$href_att = '';
						}
					} else {
						$href_att = ' href="'. ( ($media_type === 'image' || ( $media_mime === 'image/svg+xml' && apply_filters( 'uncode_use_svgs_for_links', false ) ) ) ? $create_link : '').'"';
					}

					if ( $block_data['template'] !== 'inline-image' ) {
						$media_output .= '<a tabindex="-1"' . $href_att .((count($a_classes) > 0 ) ? ' class="'.trim(implode(' ', $a_classes)).'"' : '').$lightbox_data.$data_values.$data_lb.'>';
					}

				}

				if (is_object($media_attributes) && $media_attributes->post_mime_type !== 'oembed/twitter' && !$is_titles && $block_data['template'] !== 'inline-image' ) {

					$single_limit_width = isset($block_data['limit-width']) && $block_data['limit-width'] === true ? ' limit-width' : '';

					$media_output .= 	'<div class="t-entry-visual-overlay"' . $overlay_blend . '><div class="t-entry-visual-overlay-in '.$overlay_color.'"' . $overlay_opacity . '></div></div>';

					if ( !$is_table ) {
						$t_overlay_inner_output = '';
						$t_overlay_has_content = false;

						if ( $inline_price || $inline_count ) {
							$t_overlay_has_content = true;
						}

						$t_overlay_inner_output .= 	'<div class="t-overlay-inner">
														<div class="t-overlay-content">
															<div class="t-overlay-text '.$block_data['text_padding']. $sep_extra . $inline_price . $inline_count .'">';

						if ( $single_text === 'overlay' ) {

							if ( $entry ) {
								$t_overlay_has_content = true;
							}
							$t_overlay_inner_output .= $entry;

						} else {

							if ( !$is_table ) {

								$t_overlay_inner_output .=					'<div class="t-entry t-single-line">';

								if (array_key_exists('icon',$layout)) {

									if ($single_icon !== '') {

										$t_overlay_has_content = true;
										$t_overlay_inner_output .= 				'<i class="'.$single_icon. $icon_size . ' t-overlay-icon"></i>';

									}

								}

								$t_overlay_inner_output .= 						'</div>';

							}

						}

						$t_overlay_inner_output .= 						'</div></div></div>';

						if ( $t_overlay_has_content || $single_limit_width ) {
							$media_output .= 	'<div class="t-overlay-wrap' . $single_limit_width . '">';
							if ( $t_overlay_has_content ) {
								$media_output .= $t_overlay_inner_output;
							}
							$media_output .= 	'</div>';
						}
					}

				}
			}

			if (array_key_exists('media',$layout)) {

				if ( ( isset($layout['media'][3]) && $layout['media'][3] === 'show-sale' ) || ( is_archive() && !isset($layout['media'][3]) ) ) {
					global $woocommerce;
					if ( $is_product ) {
						if (isset($block_data['id'])) {
							if ( is_object($product) ) {
								if ( $product->is_on_sale() ) {
									$media_output .= apply_filters( 'woocommerce_sale_flash', '<div class="woocommerce"><span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span></div>', $post, $product );
								} elseif ( ! $product->is_in_stock() ) {
									$media_output .= apply_filters( 'uncode_woocommerce_out_of_stock', '<div class="font-ui"><div class="woocommerce"><span class="soldout">' . esc_html__( 'Out of stock', 'woocommerce' ) . '</span></div></div>', $post, $product );
								}
							}
						}
					}
				}

				$background_mime = $media_attributes ? $media_attributes->post_mime_type : '';
				/* Metro */
				if ($style_preset === 'metro' || ( $is_titles && ( isset($block_data['drop_image_position']) || ( !isset($block_data['drop_image_position']) && $media_type !== 'image' ) ) ) ) {
					$media_post_id = null;
					if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img ) {
						if ( $is_product ) {
							$media_post_id = $product->get_id();
						} elseif ( isset($block_data_id) ) {
							$media_post_id = $block_data_id;
						} else {
							$media_post_id = $post ? $post->ID : false;
						}
					}

					$secondary_bg_cover = $secondary_async_data = $secondary_picture_cover = '';

					if ( isset( $secondary_featured_image ) && $secondary_featured_image !== false && ! $is_titles ) {
						if ( $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_img ) {
							if ( isset( $media_post_id ) && isset( $secondary_featured_image['id'] ) && $secondary_featured_image['id'] > 0 ) {
								$secondary_adaptive_async_class = uncode_get_srcset_async_class( $block_data );
								$secondary_adaptive_async_class .= ' t-secondary-background-cover';

								$secondary_async_data = $secondary_featured_image['data_async'];
								$secondary_url        = isset( $secondary_featured_image['url'] ) ? $secondary_featured_image['url'] : '';
								$secondary_orig_w     = isset( $secondary_featured_image['width'] ) ? $secondary_featured_image['width'] : '';
								$secondary_orig_h     = isset( $secondary_featured_image['height'] ) ? $secondary_featured_image['height'] : '';
								$secondary_alt        = isset( $secondary_featured_image['alt'] ) ? $secondary_featured_image['alt'] : '';

								$secondary_picture_cover = uncode_get_picture_html( $media_post_id, $secondary_featured_image['id'], $secondary_url, $secondary_alt, $secondary_orig_w, $secondary_orig_h, $secondary_adaptive_async_class, $secondary_featured_image );
							}
						} else {
							if ( $adaptive_images === 'on' && $adaptive_images_async === 'on' ) {
								$secondary_async_data = $secondary_featured_image['data_async'];
							}

							$secondary_bg_cover = '<div class="t-secondary-background-cover'.($adaptive_async_class !== '' ? $adaptive_async_class : '').'" style="background-image:url(\''.$secondary_featured_image['url'].'\')"'.($secondary_async_data !== '' ? $secondary_async_data : '').'></div>';
						}
					}

					if ( isset( $media_post_id ) && $adaptive_images === 'off' && $dynamic_srcset_active && $enable_adaptive_dynamic_bg ) {
						$picture_cover_class = 't-background-cover'.($adaptive_async_class !== '' ? $adaptive_async_class : '');
						$media_alt     = isset( $media_alt ) ? $media_alt : '';
						$adaptive_async_data_all = isset( $adaptive_async_data_all ) ? $adaptive_async_data_all : array();
						$picture_cover = uncode_get_picture_html( $media_post_id, $item_thumb_id, $item_media, $media_alt, $image_orig_w, $image_orig_h, $picture_cover_class, $adaptive_async_data_all );
						$bg_cover      = $secondary_picture_cover . $picture_cover;
					} else {
						if ( $item_media != '' ) {
							$bg_cover = $secondary_bg_cover . '<div class="t-background-cover'.($adaptive_async_class !== '' ? $adaptive_async_class : '').'" style="background-image:url(\''.$item_media.'\')"'.($adaptive_async_data !== '' ? $adaptive_async_data : '').'></div>';
						} else {
							$bg_cover = $secondary_bg_cover;
						}
					}

					if ($single_elements_click === 'yes' && $media_type === 'image' && ! $is_titles ) {

						$a_classes[] = 't-background-click';

						$data_values = !empty($block_data['link']['target']) ? ' target="'.trim($block_data['link']['target']).'"' : '';
						$data_values .= !empty($block_data['link']['rel']) ? ' rel="'.trim($block_data['link']['rel']).'"' : '';

						$media_output .= 			'<a href="' . $create_link . '"'.((count($a_classes) > 0 ) ? ' class="'.trim(implode(' ', $a_classes)).'"' : '').$lightbox_data.$data_values.'>
												' . $bg_cover . '
											</a>';

					} else {

						if ( $is_titles ) {
							if ( $adaptive_images !== 'on' ) {
								$bg_srcset = wp_get_attachment_image_srcset( $item_thumb_id, 'full' );
							} else {
								$bg_srcset = wp_get_attachment_image_src( $item_thumb_id, 'full' );
								$bg_srcset = isset( $bg_srcset[0] ) ? $bg_srcset[0] : '';
							}
							$drop_data_bg_video = $drop_bg_video = '';

							if ( isset($block_data['drop_image_position']) ) {
								$drop_classes[] = 'drop-parent';
								$drop_classes[] = 'drop-parent-'. esc_attr( $block_data['drop_image_position'] );
								$drop_back = isset( $block_data['drop_back_array'] ) ? $block_data['drop_back_array'] : array();
								$back_repeat = (isset($drop_back['background-repeat']) && $drop_back['background-repeat'] !== '') ? 'background-repeat: ' . $drop_back['background-repeat'] . ';' : '';
								$back_position = (isset($drop_back['background-position']) && $drop_back['background-position'] !== '') ? 'background-position: ' . $drop_back['background-position'] . ';' : '';
								$back_attachment = (isset($drop_back['background-attachment']) && $drop_back['background-attachment'] !== '') ? 'background-attachment: ' . $drop_back['background-attachment'] . ';' : '';
								$back_size = (isset($drop_back['background-size']) && $drop_back['background-size'] !== '') ? 'background-size: ' . $drop_back['background-size'] . ';' : '';

								$drop_style = ($back_repeat != '' || $back_position != '' || $back_attachment != '' || $back_size != '') ? ' style="' . $back_repeat . $back_position . $back_attachment . $back_size . '"' : '';
								if ( $drop_back['background-attachment'] === 'fixed' ) {
									$drop_classes[] = 'fixed-attachment';
								}
							} else {
								$drop_classes[] = 'drop-move';
								$drop_style = '';
							}

							if ($media_type === 'image') {
								if ( isset( $resized_image ) ) {
									$adaptive_async_data_all = uncode_get_srcset_bg_async_data( $dynamic_srcset_bg_mobile_size, $media_attributes, $resized_image, $image_orig_w, $image_orig_h, array( 'activate_webp' => $activate_webp ) );
									$adaptive_async_data     = $adaptive_async_data_all['string'];
									$adaptive_async_class    = uncode_get_srcset_bg_async_class( $adaptive_async_data_all );
									if ( apply_filters( 'uncode_drop_mobile_image_original', false ) ) {
										$data_bg_or = wp_get_attachment_image_src( $item_thumb_id, 'full' );
										$data_bg_or = $data_bg_or[0];
										$adaptive_async_data = ' data-mobile-background-image="' . esc_url($data_bg_or) . '"';
									}
								}
								$media_output .= '<div class="t-entry-drop '. esc_html( implode(' ', $drop_classes) ) . $adaptive_async_class . '" data-drop="' . esc_attr( $drop_rand_id ) . '" data-w="' . esc_attr( $single_width ) . '" data-bgset="' . esc_attr( $bg_srcset ) . '"' . $drop_style . $adaptive_async_data . '>';
								$media_output .= '</div><!-- .t-entry-drop -->';
							} else {
								if ( strpos($background_mime, 'video/') !== false ) {
									$poster = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
									if ($poster !== '') {
										if ( $adaptive_images !== 'on' ) {
											$bg_srcset = wp_get_attachment_image_srcset( $poster, 'full' );
										} else {
											$bg_srcset = wp_get_attachment_image_src( $poster, 'full' );
											$bg_srcset = $bg_srcset[0];
										}
									} else {
										$bg_srcset = '';
									}

									$videos = array();
									$exloded_url = explode(".", strtolower($media_attributes->guid));
									$ext = end($exloded_url);
									$videos[(String) $ext] = $media_attributes->guid;
									$alt_videos = get_post_meta($item_thumb_id, "_uncode_video_alternative", true);

									if (!empty($alt_videos)) {
										foreach ($alt_videos as $key => $value) {
											$value = apply_filters( 'uncode_self_video_src', $value );
											$exloded_url = explode(".", strtolower($value));
											$ext = end($exloded_url);
											$videos[(String) $ext] = $value;
										}
									} else {
										$videos = array(
											'src' => '"' . $media_attributes->guid . '"'
										);
									}

									$video_src = '';
									foreach ($videos as $key => $value) {
										$value = apply_filters( 'uncode_self_video_src', $value );
										$video_src.= ' ' . $key . '=' . $value;
									}

									$back_mime_css = ' self-video uncode-video-container';

									$background_mobile_attr = '';
									$video_mobile = get_post_meta($media_attributes->id, "_uncode_video_mobile_bg", true);
									if ( !$video_mobile && wp_is_mobile() ) {
										$background_mime = 'mobile_no_video';
									} else {
										$background_mobile_attr = 'playsinline ';
									}

									$drop_bg_video = do_shortcode('[video' . $video_src . ' class="background-video-shortcode"]');
									$drop_bg_video = str_replace('controls="controls"','', $drop_bg_video);
									$drop_bg_video = str_replace('<video','<video loop '. $background_mobile_attr . 'muted', $drop_bg_video);

									$get_video_meta = unserialize($media_attributes->metadata);
									$video_ratio = $get_video_meta['width'] / $get_video_meta['height'];
									$drop_bg_video = str_replace('class="background-video-shortcode"','class="background-video-shortcode" data-width="' . esc_attr( $get_video_meta['width'] ) . '" data-height="' . esc_attr( $get_video_meta['height'] ) . '" data-ratio="' . esc_attr( $video_ratio ) . '"', $drop_bg_video);
									$drop_data_bg_video = '';

									$media_output .= '<div class="t-entry-drop '. esc_html( implode(' ', $drop_classes) ) . $back_mime_css . '" data-w="' . esc_attr( $single_width ) . '" data-drop="' . esc_attr( $drop_rand_id ) . '" data-bgset="' . esc_attr( $bg_srcset ) . '"' . $drop_data_bg_video . $drop_style . '>' . $drop_bg_video;
									$media_output .= '</div>';

								} elseif ( strpos($background_mime, 'oembed/youtube') !== false || strpos($background_mime, 'oembed/vimeo') !== false ) {

									$back_metavalues = unserialize($media_attributes->metadata);
									$video_orig_w = absint($back_metavalues['width']);
									$video_orig_h = absint($back_metavalues['height']);
									$video_ratio = ($video_orig_h === 0) ? 1.777 : $video_orig_w / $video_orig_h;
									$parse_video_url = parse_url(html_entity_decode($media_attributes->guid));
									$video_url = strtok($media_attributes->guid, '?');
									if (isset($parse_video_url['query'])) {
										parse_str($parse_video_url['query'], $query_params);
										if (isset($query_params) && count($query_params) > 0) {
											foreach ($query_params as $key => $value) {
												$drop_data_bg_video .= ' data-' . $key . '="' . $value . '"';
											}
											if ($background_mime === 'oembed/youtube' && isset($query_params['v'])) {
												$video_url = 'https://youtu.be/' . $query_params['v'];
											}
										}
									}

									$drop_data_bg_video .= ' data-ignore data-width="' . esc_attr( $video_orig_w ) . '" data-height="' . esc_attr( $video_orig_h ) . '" data-ratio="' . esc_attr( $video_ratio ) . '" data-provider="'.($background_mime === 'oembed/vimeo' ? 'vimeo' : 'youtube' ).'" data-video="' . $video_url . '" data-id="' . rand(10000, 99999) . '"';
									$drop_bg_video = '';

									//Check for consent and replace with poster image in case
									if (
										( uncode_privacy_allow_content( 'youtube' ) === false && $background_mime === 'oembed/youtube' )
										||
										( uncode_privacy_allow_content( 'vimeo' ) === false && $background_mime === 'oembed/vimeo' )
									) {
										$back_mime_css = '';
										$back_url_id = get_post_meta($media_attributes->id, "_uncode_poster_image", true);
										if ( $back_url_id ) {
											$back_url = 'background-image: url(' . wp_get_attachment_url($back_url_id) . ');';
										}
									} else {
										$back_mime_css = ' video uncode-video-container';
									}

									$media_output .= '<div class="t-entry-drop '. esc_html( implode(' ', $drop_classes) ) . $back_mime_css . '" data-w="' . esc_attr( $single_width ) . '" data-drop="' . esc_attr( $drop_rand_id ) . '"' . $bg_srcset . $drop_data_bg_video . $drop_style . '>' . $drop_bg_video;
									$media_output .= '</div>';
								}
							}
						} else {

							if ($media_type === 'image') {

								if ( isset( $oembed_no_control ) && $oembed_no_control === true ) {
									$crtl_videos_class = $title_classes;
									if ( $bg_cover !== '' ) {
										$crtl_videos_class[] = 'has-poster';
 									} else {
										$crtl_videos_class[] = 'hasnt-poster';
									}
									$oembed_params = array();
									$oembed_params['no-control'] = true;
									$oembed_params['play_hover'] = $block_data['play_hover'] !== '';
									if ( $bg_cover !== '' ) {
										$oembed_params['play_hover'] = true;
									}
									if ( isset( $block_data['play_hover'] ) && $block_data['play_hover'] !== '' ) {
										if ( isset( $block_data['play_pause'] ) && $block_data['play_pause'] !== '' ) {
											$oembed_params['play_pause'] = $block_data['play_pause'] !== '';
										}
									}
									if (isset($block_data['type']) && $block_data['type'] === 'linear') {
										$oembed_attributes = uncode_get_media_info($item_thumb_id);
										$back_metavalues = unserialize($oembed_attributes->metadata);
										$video_orig_w = $back_metavalues['width'];
										$video_orig_h = $back_metavalues['height'];
										$oembed_params['ratio'] = $video_orig_w . ' / ' . $video_orig_h;
										if ( $images_size !== '' ) {
											$dummy_padding = round( ( $single_height / $single_width ) * 100, 1 );
											$oembed_params['dummy_padding'] = $dummy_padding;
										}
									}
									$oembed_params['mobile_videos'] = isset( $block_data['mobile_videos'] ) ? $block_data['mobile_videos'] : '';
									$is_text_carousel = $carousel_textual === 'yes' ? true : false;
									$is_metro = ($style_preset === 'metro');
									$media_output .= uncode_no_ctrl_videos($item_thumb_id, $consent_id, $single_width, $single_height, $single_fixed, $is_metro, $is_text_carousel, $oembed_params, $style_preset, $crtl_videos_class, $background_mime);
								}

								$media_output .= $bg_cover;

							} else {

								if ( isset( $oembed_no_control ) && $oembed_no_control === true && $multiple_items !== true ) {
									$title_classes[] = 'is-no-control';
									if ( isset( $block_data['play_hover'] ) && $block_data['play_hover'] !== '' ) {
										$title_classes[] = 'play-on-hover';
										if ( isset( $block_data['play_pause'] ) && $block_data['play_pause'] !== '' ) {
											$title_classes[] = 'play-pause';
										}
									}
									if ( isset( $oembed_mobile_videos ) ) {
										$title_classes[] = 'no-control-mobile-' . $oembed_mobile_videos;
									}
								}

								if ( isset( $oembed_no_control ) && $oembed_no_control === true && isset($oembed_params) && $multiple_items !== true ) {
									if ( !isset($has_ratio) || ( $lightbox_classes && $media_poster ) ) {
										$single_height_oembed = null;
									} else {
										$single_height_oembed = $single_height;
									}
									$is_metro = ($style_preset === 'metro');
									$is_text_carousel = $carousel_textual === 'yes' ? true : false;
									if (isset($block_data['type']) && $block_data['type'] === 'linear') {
										$oembed_attributes = uncode_get_media_info($item_thumb_id);
										$back_metavalues = unserialize($oembed_attributes->metadata);
										$video_orig_w = $back_metavalues['width'];
										$video_orig_h = $back_metavalues['height'];
										$oembed_params['ratio'] = $video_orig_w . ' / ' . $video_orig_h;
										if ( $images_size !== '' ) {
											$dummy_padding = round( ( $single_height / $single_width ) * 100, 1 );
											$oembed_params['dummy_padding'] = $dummy_padding;
										}
									}
									$media_code = uncode_no_ctrl_videos($item_thumb_id, $consent_id, $single_width, $single_height_oembed, $single_fixed, $is_metro, $is_text_carousel, $oembed_params, $style_preset, $title_classes, $background_mime);
								}

								$media_output .= '<div class="fluid-object '. trim(implode(' ', $title_classes)) . ' '.$object_class.'"'.$dummy_oembed.'>'.$media_code.'</div>';

							}

						}
					}

				/* Thumbs */
				} else {

					/* Image */
					if ($media_type === 'image') {

                        global $post;
						$media_alt = (isset($media_attributes->alt)) ? $media_attributes->alt : '';
                        if ( $is_product ) {
                            $media_post_id = $product->get_id();
                        } elseif ( isset($block_data_id) ) {
                            $media_post_id = $block_data_id;
                        } else {
                            $media_post_id = $post ? $post->ID : false;
                        }

                        $extra_adaptive_async_class = '';

                        $_media_id = 0;

                        if ( isset( $item_thumb_id ) ) {

							$extra_adaptive_async_class = ' wp-image-' . $item_thumb_id;
							$_media_id = $item_thumb_id;
						}

						if ( $media_poster ) {
							$poster_th_id = get_post_meta($item_thumb_id, "_uncode_poster_image", true);
							$media_attributes = uncode_get_media_info($poster_th_id);

							if ( $poster_th_id ) {
								$extra_adaptive_async_class = ' wp-image-' . $poster_th_id;
								$_media_id = $poster_th_id;
							}

							if ( isset($media_attributes) && isset($media_attributes->alt) ) {
								$media_alt = $media_attributes->alt;
							}
						}

						$adaptive_async_class .= $extra_adaptive_async_class;

						add_filter( 'wp_img_tag_add_srcset_and_sizes_attr', 'uncode_remove_img_tag_add_srcset_and_sizes_attr' );

						$item_media = apply_filters( 'wp_get_attachment_url', $item_media, $_media_id );

						if ( $is_titles ) {
							$drop_classes[] = 'drop-move';
							$media_output .= '<div class="t-entry-drop '. esc_html( implode(' ', $drop_classes) ) . '" data-w="' . esc_attr( $single_width ) . '" data-drop="' . esc_attr( $drop_rand_id ) . '">';
						}

						//no control videos with poster
						if ( isset( $oembed_no_control ) && $oembed_no_control === true && isset($oembed_params) ) {
							$crtl_videos_class = $title_classes;
							//$crtl_videos_class[] = 'fluid-object';
							if ( $multiple_items !== true ) {
								$crtl_videos_class[] = 'is-no-control';

								if ( isset( $oembed_mobile_videos ) ) {
									$crtl_videos_class[] = 'no-control-mobile-' . $oembed_mobile_videos;
								}
							}
							if ( $but_media_poster && isset($poster_th_id) && $poster_th_id ) {
								$crtl_videos_class[] = 'has-poster';
								$crtl_videos_class[] = 'play-on-hover';

								if ( isset( $block_data['play_pause'] ) && $block_data['play_pause'] ) {
									$crtl_videos_class[] = 'play-pause';
								}
							} else {
								$crtl_videos_class[] = 'hasnt-poster';
								if ( $oembed_params['play_hover'] === true ) {
									$crtl_videos_class[] = 'play-on-hover';
									if ( isset( $block_data['play_pause'] ) && $block_data['play_pause'] ) {
										$crtl_videos_class[] = 'play-pause';
									}
								}
							}

							if (isset($block_data['type']) && $block_data['type'] === 'linear') {
								$oembed_attributes = uncode_get_media_info($item_thumb_id);
								$back_metavalues = unserialize($oembed_attributes->metadata);
								$video_orig_w = $back_metavalues['width'];
								$video_orig_h = $back_metavalues['height'];
								$oembed_params['ratio'] = $video_orig_w . ' / ' . $video_orig_h;
								if ( $images_size !== '' ) {
									$dummy_padding = round( ( $single_height / $single_width ) * 100, 1 );
									$oembed_params['dummy_padding'] = $dummy_padding;
								}
							}

							$is_text_carousel = $carousel_textual === 'yes' ? true : false;
							$media_output .= uncode_no_ctrl_videos($item_thumb_id, $consent_id, $single_width, $single_height, $single_fixed, false, $is_text_carousel, $oembed_params, $style_preset, $crtl_videos_class, $background_mime);
						}

						//here
						if ( $item_media !== '' && !( strpos($media_mime, 'image/') === false && $block_data['template'] === 'inline-image' ) ) {
							$media_output .= apply_filters( 'post_thumbnail_html', '<img' . ( $adaptive_async_class !== '' ? ' class="' . trim( $adaptive_async_class ) . '"' : '' ) . ' src="' . $item_media . '" width="' . $image_orig_w . '" height="' . $image_orig_h . '" alt="' . $media_alt . '"' . ( $adaptive_async_data !== '' ? $adaptive_async_data : '' ) . ' />', $media_post_id, $item_thumb_id, array($image_orig_w, $image_orig_h), '');
						}

						if ( function_exists( 'uncode_core_unhook' ) ) {
							uncode_core_unhook( 'wp_img_tag_add_srcset_and_sizes_attr', 'uncode_remove_img_tag_add_srcset_and_sizes_attr' );
						}

						if ( $is_titles ) {
							$media_output .= '</div>';
						}

					/* Email */
					} elseif ($media_type === 'email' && !$is_titles ) {

						$media_output .= get_avatar($media_attributes->guid, absint($image_orig_w)*2, '', '', array( 'loading' => 'lazy' ));

					/* Object */
					} else {
						if ($object_class !== '') {
							$title_classes[] = $object_class;
						}
						if (isset($media_attributes->post_mime_type)) {
							switch ($media_attributes->post_mime_type) {
								case 'oembed/svg':
								case 'image/svg+xml':
									$title_classes = array('fluid-svg');
								break;
								case 'oembed/twitter':
									$title_classes[] = 'social-object';
									if ($media_attributes->social_original) {
										$title_classes[] = 'twitter-object';
									} else {
										$title_classes[] = 'fluid-object';
										if ( isset( $oembed_no_control ) && $oembed_no_control === true && $multiple_items !== true ) {
											$title_classes[] = 'is-no-control';
											if ( isset( $oembed_mobile_videos ) ) {
												$title_classes[] = 'no-control-mobile-' . $oembed_mobile_videos;
											}
										}
									}
									$dummy_oembed = '';
								break;
								default:
									if ( uncode_privacy_allow_content( $consent_id ) !== false ) {
										$title_classes[] = 'fluid-object';
										if ( isset( $oembed_no_control ) && $oembed_no_control === true && $multiple_items !== true ) {
											$title_classes[] = 'is-no-control';
											if ( $oembed_params['play_hover'] === true ) {
												$title_classes[] = 'play-on-hover';
												if ( isset( $oembed_params['play_pause'] ) && $oembed_params['play_pause'] ) {
													$title_classes[] = 'play-pause';
												}
											}
											if ( isset( $oembed_mobile_videos ) ) {
												$title_classes[] = 'no-control-mobile-' . $oembed_mobile_videos;
											}
										}
									}
									break;
							}
						} else {
							$title_classes[] = 'fluid-object';
							if ( isset( $oembed_no_control ) && $oembed_no_control === true && $multiple_items !== true ) {
								$title_classes[] = 'is-no-control';
								if ( isset( $oembed_mobile_videos ) ) {
									$title_classes[] = 'no-control-mobile-' . $oembed_mobile_videos;
								}
							}
						}

						if ( uncode_privacy_allow_content( $consent_id ) === false ) {
							$title_classes[] = 'pushed';
						}

						if ( $is_titles ) {
							$drop_classes[] = 'drop-move';
							$media_output .= '<div class="t-entry-drop '. esc_html( implode(' ', $drop_classes) ) . '" data-w="' . esc_attr( $single_width ) . '">'. $media_code.'</div>';
						} else {
							if ( isset( $oembed_no_control ) && $oembed_no_control === true && isset($oembed_params) && $multiple_items !== true ) {
								if ( !isset($has_ratio) || ( $lightbox_classes && $media_poster ) ) {
									$single_height_oembed = null;
								} else {
									$single_height_oembed = $single_height;
								}
								$is_metro = ($style_preset === 'metro');
								$is_text_carousel = $carousel_textual === 'yes' ? true : false;
								if (isset($block_data['type']) && $block_data['type'] === 'linear') {
									$oembed_attributes = uncode_get_media_info($item_thumb_id);
									$back_metavalues = unserialize($oembed_attributes->metadata);
									$video_orig_w = $back_metavalues['width'];
									$video_orig_h = $back_metavalues['height'];
									$oembed_params['ratio'] = $video_orig_w . ' / ' . $video_orig_h;
									if ( $images_size !== '' ) {
										$dummy_padding = round( ( $single_height / $single_width ) * 100, 1 );
										$oembed_params['dummy_padding'] = $dummy_padding;
									}
								}
								$media_code = uncode_no_ctrl_videos($item_thumb_id, $consent_id, $single_width, $single_height_oembed, $single_fixed, $is_metro, $is_text_carousel, $oembed_params, $style_preset, $title_classes, $background_mime);
							}
							if (isset($block_data['type']) && $block_data['type'] === 'linear' && $images_size !== '') {
								$dummy_padding = round( ( $single_height / $single_width ) * 100, 1 );
								$dummy_oembed = ' style="padding-top: ' . $dummy_padding . '%"';
							}
							$media_output .= '<div class="'. trim(implode(' ', $title_classes)) . '"'.$dummy_oembed.'>'.$media_code.'</div>';
						}

					}

				}

			}

			if (($single_text !== 'overlay' || $single_elements_click !== 'yes') && ( ( isset( $oembed_no_control ) && $oembed_no_control === true ) || $media_type === 'image' || ( $media_mime === 'image/svg+xml' && apply_filters( 'uncode_use_svgs_for_links', false ) ) ) && !isset($block_data['is_avatar']) && $block_data['template'] !== 'inline-image' && !$is_titles ) {
				$media_output .= '</a>';
			}

			$has_add_to_cart_overlay = false;

			if ( !$is_titles && $is_product && ( !isset($block_data['show_atc']) || $block_data['show_atc'] == 'yes') ) {
				$redirect_to_product = uncode_single_variations_redirect_to_product( $product );

				ob_start();
				$add_to_cart_args = array();

				if ( $redirect_to_product ) {
					$add_to_cart_url = get_permalink( $product->get_parent_id() );

					$add_to_cart_args['uncode_add_to_cart_url'] = $add_to_cart_url;
				}

				woocommerce_template_loop_add_to_cart( $add_to_cart_args );

				$add_to_cart_button_html = ob_get_clean();

				if ( $add_to_cart_button_html ) {
					$add_to_cart_button_html = str_replace( ' btn ', ' ', $add_to_cart_button_html );
					$add_to_cart_button_html = str_replace( ' alt ', ' ', $add_to_cart_button_html );
					$add_to_cart_button_html = str_replace( '"button ', '"', $add_to_cart_button_html );
					$add_to_cart_button_html = str_replace( 'btn-default', 'product_button_loop', $add_to_cart_button_html );
					if ( isset( $block_data['atc_column_typography'] ) && $block_data['atc_column_typography'] === 'yes' ) {
						$add_to_cart_button_html = str_replace( 'product_button_loop', 'product_button_loop default-typography', $add_to_cart_button_html );
					}
					if ( $redirect_to_product ) {
						$add_to_cart_button_html = str_replace( 'ajax_add_to_cart', '', $add_to_cart_button_html );
					}
					$add_to_cart_button_html = apply_filters( 'uncode_loop_add_to_cart_button_html', $add_to_cart_button_html, 'default' );
					$media_output .= '<div class="add-to-cart-overlay">'.$add_to_cart_button_html.'</div>';
					$has_add_to_cart_overlay = true;
				}
			}
			if ( !$is_titles && $is_product && ( isset( $layout['variations'] ) && $layout['variations'] && isset( $layout['variations'][0] ) && ( $layout['variations'][0] === 'over' || $layout['variations'][0] === 'over_visible' ) ) && isset( $layout['variations'][1] ) && $layout['variations'][1] !== '_all' ) {

				$media_output .= uncode_wc_print_variations_element( $product, $layout['variations'], $single_text, $has_add_to_cart_overlay );
			}

			ob_start();
			do_action( 'uncode_entry_visual_after_image', $block_data, $layout, $is_default_product_content );
			$custom_entry_visual_after_image = ob_get_clean();

			if ( $custom_entry_visual_after_image !== '' ) {
				$media_output.= $custom_entry_visual_after_image;
			}

			if ( !$is_titles && $block_data['template'] !== 'inline-image' ) {
				$media_output .= '</div>
					</div>
				</div>';
			}

			if ( $is_table ) {
				$entry = str_replace('[uncode_type_media_output]', $media_output, $entry);
			} else {
				$output .= $media_output;
			}

		}

		if ( ( $single_text === 'under' && ( $layoutLast !== 'media' || $is_table ) ) || ( $single_text === 'lateral' ) ) {

			$output .= $entry;

		}

		if ( ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
			ob_start();
			do_action( 'woocommerce_after_shop_loop_item_title');
			$output .= ob_get_clean();
		}

		if ( $block_data['template'] !== 'inline-image' ) {
			$output .= '</div>';
		}

		if ( isset( $block_data['drop_image_separator'] ) && !isset( $block_data['drop_image_separator_last'] ) ) {
			$drop_image_separator_classes = isset( $block_data['drop_image_separator_classes'] ) ? $block_data['drop_image_separator_classes'] : array();
			$output .= '<span class="drop-image-separator drop-image-separator-after '. trim(implode(' ', $drop_image_separator_classes)) . ' ' . trim(implode(' ', $title_classes)) . $single_animation . '"' . $title_style . ' '.implode(' ', $div_data_attributes) .'><span class="drop-image-separator-inner">' . esc_attr( $block_data['drop_image_separator'] ) . '</span></span>';
		}

		if ( $is_table ) {
			$output .= 	'</div>'; //.t-inside-post-table
		}

		if ( apply_filters( 'uncode_move_woocommerce_after_shop_loop_item', false ) && ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
			ob_start();
			do_action( 'woocommerce_after_shop_loop_item');
			$output .= ob_get_clean();
		}

		if ( $block_data['template'] !== 'inline-image' ) {
			$output .= '</div>'; //.t-inside
		} else {
			$output .= '</span></span>';
		}

		if ( ! apply_filters( 'uncode_move_woocommerce_after_shop_loop_item', false ) && ot_get_option('_uncode_woocommerce_hooks') === 'on' && $is_product ) {
			ob_start();
			do_action( 'woocommerce_after_shop_loop_item');
			$output .= ob_get_clean();
		}

		do_action( 'uncode_create_single_block' );

		$post = $or_post;

		if ( $is_product ) {
			$product = $or_product;
		}

		return $output;
	}
}

/**
 * Create post info HTML
 */
if (!function_exists('uncode_post_info')) {
	function uncode_post_info() {
		$categories = get_the_category();
		$separator = ', ';
		$output = array();
		$cat_output = '';

		$output[] = '<div class="date-info">' . get_the_date() . '</div>';

		if($categories){
			foreach($categories as $category) {
				$cat_output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'uncode' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
			$output[] = '<div class="category-info"><span>|</span>' . esc_html__('In','uncode') . ' ' . trim($cat_output, $separator) . '</div>';
		}

		$output[] = '<div class="author-info"><span>|</span>' . esc_html__('By','uncode') . ' ' . '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></div>';

		return '<div class="post-info">' . implode('', $output) . '</div>';
	}
}

/**
 * Create portfolio info HTML
 */
if (!function_exists('uncode_portfolio_info')) {
	function uncode_portfolio_info() {
		$categories = wp_get_object_terms( get_the_id(), 'portfolio_category' );
		$separator = ', ';
		$output = array();
		$cat_output = '';

		if($categories){

			foreach ( $categories as $cat ) {
				$cat_output .= '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'uncode' ), $cat->name ) ) . '">'.$cat->name.'</a>'.$separator;
			}
			$output[] = '<div class="category-info">' . esc_html__('In','uncode') . ' ' . trim($cat_output, $separator) . '</div>';
		}
		return '<div class="post-info">' . implode('', $output) . '</div>';
	}
}

/**
 * Create info box HTML
 */
if (!function_exists('uncode_get_info_box')) {
	function uncode_get_info_box($out, $atts) {
		global $post;
		$post_type = get_post_type();
		$separator = ', ';
		$author_id = !get_the_author_meta( 'ID' ) ? $post->post_author : get_the_author_meta( 'ID' );
		$output = '';

		switch ($out) {
			case 'date':
				return '<span class="date-info">' . get_the_date() . '</span>';
				break;

			case 'author':
				$output .= '<span class="author-wrap">';
				if ( $atts !== false && is_array( $atts ) && isset($atts['size']) && $atts['size'] !== false ) {
					$output .= '<a href="'.get_author_posts_url( $author_id ).'"><span class="uncode-ib-avatar uncode-ib-avatar-size-' . $atts['size'][1] . '">' . get_avatar( $author_id, $atts['size'][0], false, get_the_author_meta( 'display_name' , $author_id ), array( 'loading' => 'lazy' ) ) . '</span></a>';
				}
				$by_prefix = esc_html__('By','uncode');
				if ( $atts !== false && is_array( $atts ) && isset($atts['no_prefix']) && $atts['no_prefix'] === true ) {
					$by_prefix = '';
				}
				$output .= '<span class="author-info">' . $by_prefix . ' ' . '<a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' , $author_id ).'</a></span>';
				$output .= '</span>';
				return $output;
				break;

			case 'comments':
				$num_comments = get_comments_number( get_the_id() );
				if ( $num_comments > 0 ) {
					$output .= '<a href="#commenta-area">';
				} else {
					$output .= '<span>';
				}
				$output .= $num_comments.' '._nx( 'Comment', 'Comments', $num_comments, 'comments', 'uncode' );
				if ( $num_comments > 0 ) {
					$output .= '</a>';
				} else {
					$output .= '</span>';
				}
				return $output;
				break;

			case 'reading':
				$time = uncode_estimated_reading_time( get_the_id() );
				return $time;
				break;

			case 'tax':
			default:
				$tax_class = '';
				if ( $post_type === 'post' ) {
					$categories = get_the_category();
				} else {
					$custom_taxonomy = apply_filters( 'uncode_cpt_taxonomy_for_info_box', "{$post_type}_category" );
					$categories      = wp_get_object_terms( get_the_id(), $custom_taxonomy );

					if ( is_wp_error( $categories ) ) {
						// Fallback to native post categories if
						// the CPt has not a custom taxonomy
						$categories = get_the_category();
					}
				}
				if ( ! is_wp_error( $categories ) ) {
					foreach( $categories as $category ) {
						$output .= '<a href="'.get_term_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'uncode' ), $category->name ) ) . '" class="' . $tax_class . '">'.$category->name.'</a>'.$separator;
					}
				}
				if ( $output !== '' ) {
					$in_prefix = '';
					if ( $atts !== true ) {
						$in_prefix = esc_html__('In','uncode');
					}
					return '<span class="category-info">' . $in_prefix . ' ' . trim($output, $separator) . '</span>';
				}
				break;
		}

	}
}

/**
 * Get image size for the dummy space
 */
if (!function_exists('uncode_get_dummy_size')) {
	function uncode_get_dummy_size($id, $size = null) {
		$attachment_meta = get_post_meta($id, '_wp_attachment_metadata', true);
		if ($size != null && isset($attachment_meta['sizes']) && array_key_exists($size, $attachment_meta['sizes'])) {
			$attachment_meta = $attachment_meta['sizes'][$size];
		}
		$width = (isset($attachment_meta['width']) && $attachment_meta['width'] !== '') ? $attachment_meta['width'] : 1;
		$height = (isset($attachment_meta['height']) && $attachment_meta['height'] !== '') ? $attachment_meta['height'] : 0;

		$dummy = round(($height / $width) * 100, 2);

		return array(
			'dummy' => $dummy,
			'width' => $width,
			'height' => $height,
		);
	}
}
