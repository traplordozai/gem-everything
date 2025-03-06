<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce, $gallery_id, $vc_column_inner_width;

if ( ! $product ) {
	$product = uncode_populate_post_object();
}

$product_id = $product->get_id();

$_uncode_thumb_layout = ot_get_option('_uncode_product_image_layout');
$_uncode_thumb_layout = get_post_meta($product_id, '_uncode_product_image_layout', 1) !== '' ? get_post_meta($product_id, '_uncode_product_image_layout', 1) : $_uncode_thumb_layout;
$_uncode_thumb_layout = isset( $vc_thumb_layout ) ? $vc_thumb_layout : $_uncode_thumb_layout;
$_uncode_thumb_layout = $_uncode_thumb_layout === 'std' ? '' : $_uncode_thumb_layout;
$_uncode_product_thumb_margin = ( $_uncode_thumb_layout == 'stack' || $_uncode_thumb_layout === 'stack-lateral' ) ? ' single-bottom-margin' : '';
$_uncode_product_thumb_margin = isset( $vc_margin ) ? ' ' . $vc_margin : $_uncode_product_thumb_margin;
$columns = isset( $vc_columns ) && $vc_columns !== '' ? $vc_columns : 3;
$nav = false;

$col_size = ot_get_option('_uncode_product_media_size') == '' ? 6 : ot_get_option('_uncode_product_media_size');
$col_size = isset($vc_column_inner_width) && $vc_column_inner_width !== '' ? $vc_column_inner_width : $col_size;
if ( $_uncode_thumb_layout == 'grid' ) {
	$col_size = $col_size / 2;
} elseif ( isset($vc_nav) && $vc_nav === 'lateral' ) {
	$nav = $vc_nav;
	$col_size = 1;
}

$attachment_ids = apply_filters( 'uncode_product_gallery_thumb_ids_fronted_editor', $product->get_gallery_image_ids(), $product_id, $_uncode_thumb_layout, $nav );
$attachment_ids = apply_filters( 'uncode_product_gallery_thumb_ids', $attachment_ids, $product_id );

if ( $_uncode_thumb_layout == 'stack' || $_uncode_thumb_layout === 'stack-lateral' || $_uncode_thumb_layout == 'grid' ) {
	$th_val = $col_size;
} else {
	$th_val = 2;
}

// Thumb size and crop
$th_crop = false;
$th_size = 'uncode_woocommerce_nav_thumbnail_regular';
if ( isset( $vc_ratio ) && $vc_ratio === 'one-one' ) {
	$th_size = 'uncode_woocommerce_nav_thumbnail_crop';
	$th_crop = true;
} else if ( ! isset( $vc_ratio ) ) {
	// Default gallery (no page builder)
	global $uncode_vc_product_gallery_thumb_ratio;
	$uncode_vc_product_gallery_thumb_ratio = 'one-one';
	$th_size = 'uncode_woocommerce_nav_thumbnail_crop';
	$th_crop = true;
}
$thumb_ratio = $th_crop ? 1 : null;

if ( $attachment_ids ) {
	if ( !uncode_woocommerce_single_product_slider_enabled(true) && ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) ) {
		$vc_padding = isset( $vc_padding ) ? ' ' . $vc_padding : '';
		echo '<div class="thumbnails' . $vc_padding . '">';
	}

	foreach ( $attachment_ids as $at_key => $attachment_id ) {

		$classes = array( 'zoom' );

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link ) {
			continue;
		}

		$image_attributes = uncode_get_media_info($attachment_id);
		$image_metavalues = unserialize($image_attributes->metadata);
		if ($image_attributes->post_mime_type === 'image/gif' || $image_attributes->post_mime_type === 'image/url') {
			$th_crop = false;
		}
		$image_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], $col_size, null, false);
		$small_image_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], 1, 1, true); //lightbox thumbs
		global $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur, $dynamic_srcset_active;

		$image_link = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
		$image_class = esc_attr( implode( ' ', $classes ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );

		$thumbnail = wp_get_attachment_image_src( $attachment_id, 'full' );

		$attributes = array(
			'data-caption'            => esc_attr( get_post_field( 'post_excerpt', $attachment_id ) ),
			'data-src'                => $image_link,
			'data-large_image'        => $image_link,
			'data-large_image_width'  => $image_metavalues['width'],
			'data-large_image_height' => $image_metavalues['height'],
		);

		if ($adaptive_images === 'on') {
			$attributes['data-singlew'] = $col_size;
			$attributes['data-singleh'] = $col_size;
			$attributes['data-crop'] = $th_crop;
			$attributes['sizes'] = 'false';
		}

		if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
			$adaptive_async_class = uncode_get_adaptive_async_class();
			if ( $adaptive_async_class ) {
				$attributes['class'] = $adaptive_async_class;
				$attributes['data-uniqueid'] = $attachment_id.'-'.uncode_big_rand();
				$attributes['data-guid'] = $image_attributes->guid;
				$attributes['data-path'] = $image_attributes->path;
				$attributes['data-width'] = $image_metavalues['width'];
				$attributes['data-height'] = $image_metavalues['height'];
			}
		}

		$thumb_carousel_atts = $attributes;

		$attach_size = $th_size;

		if ( $adaptive_images === 'on' && $_uncode_thumb_layout !== 'stack' && $_uncode_thumb_layout === 'stack-lateral' ) {
			$attributes['src'] = $image_resized['url'];
			$carousel_thumb_cols = ( 12 / $columns ) / ( 12 / $col_size );
			$thumb_carousel_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], $carousel_thumb_cols, ($th_crop ? $carousel_thumb_cols / $thumb_ratio : null), $th_crop);
			$thumb_carousel_atts['src'] = $thumb_carousel_resized['url'];
			$thumb_carousel_atts['data-singleh'] = ($th_crop ? $col_size / $thumb_ratio : null);
			$thumb_carousel_atts['data-crop'] = $th_crop;
		}

		if ( $nav === 'lateral' ) {
			$attach_size = $th_size;
			$thumb_carousel_atts = false;
		}

		$attachment_id = apply_filters( 'uncode_product_gallery_thumb_id', $attachment_id, $product_id );

		if ( isset( $slider_nav ) && $slider_nav === true ) {

			$html  = '<li class="' . esc_attr( $image_class ) . ' woocommerce-product-gallery__thumb">';
			$html .= wp_get_attachment_image( $attachment_id, $attach_size, false, $thumb_carousel_atts );
	 		$html .= '</li>';

		} else {

			if ( !uncode_woocommerce_single_product_slider_enabled(true) && $_uncode_thumb_layout === '' ) {
				$attributes = $thumb_carousel_atts;
			}

			$data_lbox = isset( $vc_lightbox ) && $vc_lightbox === 'yes' ? '' : ' data-lbox="ilightbox_gallery-' . $gallery_id . '" data-lb-index="' . ($at_key + 1) . '"';
			$data_lbox .= isset( $vc_lbox_skin ) && $vc_lbox_skin !== '' ? ' data-skin="' . $vc_lbox_skin . '"' : '';
	
			$image_class .= $data_lbox == '' ? ' lb-disabled' : '';

			$th_animation = $th_delay = $th_speed = '';
			if ( isset( $vc_animation ) ) {
				$th_animation .= ' ' . $vc_animation;
				$vc_delay = 100 * ($at_key + 1);
			}
			if ( isset( $vc_delay ) ) {
				$th_delay .= ' data-delay="' . esc_attr( $vc_delay ) . '"';
			}
			if ( isset( $vc_speed ) ) {
				$th_speed .= ' data-speed="' . esc_attr( $vc_speed ) . '"';
			}

			$html = '';
			if ( $_uncode_thumb_layout == 'grid' ) {
				$html = '<div class="woocommerce-product-gallery__image-wrap">';
			}
			$html .= '<div class="woocommerce-product-gallery__image' . $_uncode_product_thumb_margin . $th_animation . '"' . $th_delay . $th_speed . '"><span class="zoom-overlay"></span><a href="' . esc_url( $image_link ) . '" class="' . esc_attr( $image_class ) . '" data-options="thumbnail: \''.$small_image_resized['url'].'\'"' . $data_lbox . ' data-caption="' . get_post_field( 'post_excerpt', $attachment_id ) . '">';
			$html .= wp_get_attachment_image( $attachment_id, 'full', false, $attributes );
	 		$html .= '</a></div>';
			if ( $_uncode_thumb_layout == 'grid' ) {
		 		$html .= '</div>';
			}

		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

	}

	if ( !uncode_woocommerce_single_product_slider_enabled(true) && ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) ) {

		echo '</div>';//.thumbnails
	}
}
