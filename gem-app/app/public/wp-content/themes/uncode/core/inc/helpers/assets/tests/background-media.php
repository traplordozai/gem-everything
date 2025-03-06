<?php
/**
 * Background Media test
 */

function uncode_page_require_asset_background_media( $content_array ) {
	global $uncode_check_asset;

	// We need to search each background media ID to check if it is a video
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'back_image' ) !== false ) {
			uncode_asset_check_attribute_medias( 'back_image', $content );
		}

		if ( strpos( $content, 'medias' ) !== false ) {
			uncode_asset_check_attribute_medias( 'medias', $content );
		}

		if ( strpos( $content, 'media' ) !== false ) {
			uncode_asset_check_attribute_medias( 'media', $content );
		}

		$dynamic_bg = false;

		if ( strpos( $content, 'back_image_auto="yes"' ) !== false ) {
			$dynamic_bg = 'featured';
		}

		if ( strpos( $content, 'back_image_auto="secondary"' ) !== false ) {
			$dynamic_bg = 'secondary';
		}

		// If a module has a dynamic background, check the post featured images
		if ( $dynamic_bg ) {
			global $uncode_post_data;

			if ( uncode_post_data_is_singular() ) {
				if ( isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) ) {
					$media = uncode_asset_check_post_media( $uncode_post_data['ID'], $dynamic_bg );

					if ( $media ) {
						$back_attributes = uncode_get_media_info( $media );

						if ( isset( $back_attributes->post_mime_type ) && strpos( $back_attributes->post_mime_type, 'video/' ) !== false ) {
							$uncode_check_asset['mediaelement'] = true;
							$uncode_check_asset['bg_video'] = true;
						}

						if ( isset( $back_attributes->post_mime_type ) && ( $back_attributes->post_mime_type === 'oembed/youtube' || $back_attributes->post_mime_type === 'oembed/vimeo' ) ) {
							$uncode_check_asset['okvideo'] = true;
						}
					}
				}
			}
		}

		// Check the posts module to get a list of all posts
		// displayed in a page and then check their media type
		if ( class_exists( 'uncode_index' ) && strpos( $content, '[uncode_index' ) !== false ) {
			global $uncode_index_query;

			$regex = '/\[uncode_index(.*?)\]/';
			$regex_attr = '/(.*?)=\"(.*?)\"/';
			preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				$has_auto_query       = false;
				$has_pagintation      = false;
				$has_infinite_loading = false;
				$has_media_displayed  = true;
				$post_items           = false;

				if ( isset( $value[0] ) && isset( $value[1] ) ) {
					preg_match_all( $regex_attr, trim( $value[1] ), $matches_attr, PREG_SET_ORDER );

					$loop = false;

					foreach ( $matches_attr as $key_attr => $value_attr ) {
						if ( trim( $value_attr[1] ) === 'loop' ) {
							$loop = $value_attr[2];

							// Return early if posts are random ordered
							if ( strpos( $loop, 'order_by:rand' ) !== false ) {
								$uncode_check_asset['mediaelement'] = true;
								$uncode_check_asset['bg_video'] = true;
								return true;
							}
						}

						switch ( trim( $value_attr[1] ) ) {
							case 'auto_query':
								if ($value_attr[2] === 'yes') {
									$has_auto_query = true;
								}
								break;
							case 'pagination':
								if ($value_attr[2] === 'yes') {
									$has_pagintation = true;
								}
								break;
							case 'infinite':
								if ($value_attr[2] === 'yes') {
									$has_infinite_loading = true;
								}
								break;
							case 'post_items':
								$post_items = $value_attr[2];
								break;
						}
					}

					// Return early if has an infinite loading
					if ( $has_infinite_loading ) {
						$uncode_check_asset['mediaelement'] = true;
						$uncode_check_asset['carousel'] = true;
						$uncode_check_asset['bg_video'] = true;
						return true;
					}

					// Return early if has a pagination
					if ( $has_pagintation ) {
						$uncode_check_asset['mediaelement'] = true;
						$uncode_check_asset['carousel'] = true;
						$uncode_check_asset['bg_video'] = true;
						return true;
					}

					// Media not displayed, so we can skip this module
					if ( $post_items && strpos( $post_items, 'media' ) === false ) {
						$has_media_displayed = false;
					}

					if ( $has_media_displayed ) {
						$media_type = strpos( $post_items, 'media|media' ) !== false ? 'medias' : 'featured';

						if ( $media_type === 'featured' && strpos( $value[0], 'single_secondary="yes"' ) !== false ) {
							$media_type = 'secondary';
						}

						$uncode_index_string = str_replace('[uncode_index', '[uncode_index run_dry="yes"', $value[0] );

						do_shortcode( $uncode_index_string );

						if ( $uncode_index_query && $uncode_index_query instanceof WP_Query ) {
							while ( $uncode_index_query->have_posts() ) {
								$uncode_index_query->the_post();
								global $post;

								$media = uncode_asset_check_post_media( $post->id, $media_type );

								if ( is_array( $media ) ) {
									// This is a carousel
									$uncode_check_asset['carousel'] = true;

									foreach ( $media as $media_id ) {
										$media_attributes = uncode_get_media_info( $media_id );

										if ( isset( $media_attributes->post_mime_type ) && strpos( $media_attributes->post_mime_type, 'video/' ) !== false ) {
											$uncode_check_asset['mediaelement'] = true;
											$uncode_check_asset['bg_video'] = true;
										}
									}
								} else if ( $media ) {
									$media_attributes = uncode_get_media_info( $media );

									if ( isset( $media_attributes->post_mime_type ) && strpos( $media_attributes->post_mime_type, 'video/' ) !== false ) {
										$uncode_check_asset['mediaelement'] = true;
										$uncode_check_asset['bg_video'] = true;
									}
								}
							}
							wp_reset_query();
						}
					}
				}
			}
		}
	}
}

/**
 * Check attribute medias
 */
function uncode_asset_check_attribute_medias( $attr, $content ) {
	global $uncode_check_asset;

	$regex_attr = sprintf( '/%s=\"(.*?)\"/', $attr );
	preg_match_all( $regex_attr, $content, $matches, PREG_SET_ORDER );

	$medias_to_check = array();

	foreach ( $matches as $key => $value ) {
		if ( is_array( $value ) && isset( $value[1] ) && $value[1] ) {
			if ( strpos( $value[1], ',' ) !== false ) {
				$_medias_ids = explode( ',', $value[1] );

				foreach ( $_medias_ids as $_medias_id ) {
					$medias_to_check[] = $_medias_id;
				}

			} else {
				$medias_to_check[] = $value[1];
			}
		}
	}

	if ( is_array( $medias_to_check ) ) {
		foreach ( $medias_to_check as $media_id_to_check ) {
			$back_attributes = uncode_get_media_info( $media_id_to_check );

			if ( isset( $back_attributes->post_mime_type ) && $back_attributes->post_mime_type === 'oembed/gallery' ) {
				uncode_asset_check_oembed_gallery_medias( $media_id_to_check );
				continue;
			}

			if ( isset( $back_attributes->post_mime_type ) && strpos( $back_attributes->post_mime_type, 'video/' ) !== false ) {
				$uncode_check_asset['mediaelement'] = true;
				$uncode_check_asset['bg_video'] = true;
			}

			if ( isset( $back_attributes->post_mime_type ) && ( $back_attributes->post_mime_type === 'oembed/youtube' || $back_attributes->post_mime_type === 'oembed/vimeo' ) ) {
				$uncode_check_asset['okvideo'] = true;
			}

			if ( isset( $back_attributes->post_mime_type ) && $back_attributes->post_mime_type === 'oembed/twitter' ) {
				$uncode_check_asset['twitter'] = true;
			}
		}
	}
}

/**
 * Check oembed gallery medias
 */
function uncode_asset_check_oembed_gallery_medias( $gallery ) {
	global $uncode_check_asset;

	$parent_id           = wp_get_post_parent_id( $gallery );
	$media_album_ids     = get_post_meta( $parent_id, '_uncode_featured_media', true );
	$media_album_ids_arr = explode( ',', $media_album_ids );

	if ( is_array( $media_album_ids_arr ) && ! empty( $media_album_ids_arr ) ) {
		foreach ( $media_album_ids_arr as $media_album_id => $media_album_value ) {
			$back_attributes = uncode_get_media_info( $media_album_value );

			if ( isset( $back_attributes->post_mime_type ) && strpos( $back_attributes->post_mime_type, 'video/' ) !== false ) {
				$uncode_check_asset['mediaelement'] = true;
				$uncode_check_asset['bg_video'] = true;
			}

			if ( isset( $back_attributes->post_mime_type ) && ( $back_attributes->post_mime_type === 'oembed/youtube' || $back_attributes->post_mime_type === 'oembed/vimeo' ) ) {
				$uncode_check_asset['okvideo'] = true;
			}

			if ( isset( $back_attributes->post_mime_type ) && $back_attributes->post_mime_type === 'oembed/twitter' ) {
				$uncode_check_asset['twitter'] = true;
			}
		}
	}
}

/**
 * Check post media
 */
function uncode_asset_check_post_media( $post_id, $media_type ) {
	$media = false;

	if ( $media_type === 'featured' ) {
		$media = apply_filters( 'uncode_featured_image_id', get_post_thumbnail_id( $post_id ), $post_id );

		// Check page medias if the feautured image is missing
		if ( ! $media ) {
			$medias = get_post_meta( $post_id, '_uncode_featured_media', 1 );

			if ( $medias ) {
				$media_ids = explode( ',', $medias );

				if ( is_array( $media_ids ) ) {
					$media = absint( $media_ids[0] );
				}
			}
		}
	} else if ( $media_type === 'medias' ) {
		$medias = get_post_meta( $post_id, '_uncode_featured_media', 1 );

		if ( $medias ) {
			$media_ids = explode( ',', $medias );

			if ( is_array( $media_ids ) ) {
				$media = $media_ids;
			}
		} else {
			$media = apply_filters( 'uncode_featured_image_id', get_post_thumbnail_id( $post_id ), $post_id );
		}
	} else if ( $media_type === 'secondary' ) {
		// Get secondary image
		$media = uncode_get_secondary_featured_thumbnail_id( $post_id );
	}

	return $media;
}
