<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product, $vc_column_inner_width, $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur;

if ( uncode_is_quick_view() ) {
	uncode_setup_globals();

	if ( $adaptive_images === 'on' ) {
		$adaptive_images = 'off';
	}
}

$post_type = uncode_get_current_post_type();

if ( ! $product ) {
	$product = uncode_populate_post_object();
}

$product_id = $product->get_id();

$product_gallery_globals['vc_column_inner_width'] = $vc_column_inner_width;

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

$_uncode_thumb_layout = ot_get_option('_uncode_product_image_layout');
$_uncode_thumb_layout = get_post_meta($product_id, '_uncode_product_image_layout', 1) !== '' ? get_post_meta($product_id, '_uncode_product_image_layout', 1) : $_uncode_thumb_layout;
$_uncode_thumb_layout = isset( $vc_thumb_layout ) ? $vc_thumb_layout : $_uncode_thumb_layout;
$_uncode_thumb_layout = $_uncode_thumb_layout === 'std' ? '' : $_uncode_thumb_layout;

$_uncode_product_thumb_cols = ot_get_option('_uncode_product_thumb_cols');
$_uncode_product_thumb_cols = get_post_meta($product_id, '_uncode_thumb_cols', 1) !== '' ? get_post_meta($product_id, '_uncode_thumb_cols', 1) : $_uncode_product_thumb_cols;
$_uncode_product_thumb_cols = isset( $vc_columns ) ? $vc_columns : $_uncode_product_thumb_cols;
$_uncode_product_thumb_margin = ( $_uncode_thumb_layout == 'stack' || $_uncode_thumb_layout === 'stack-lateral' ) ? ' single-bottom-margin' : '';
$_uncode_product_thumb_margin = isset( $vc_margin ) ? ' ' . $vc_margin : $_uncode_product_thumb_margin;

$col_size = ot_get_option('_uncode_product_media_size') == '' ? 6 : ot_get_option('_uncode_product_media_size');
$col_size = isset($vc_column_inner_width) && $vc_column_inner_width !== '' ? $vc_column_inner_width : $col_size;
if ( $_uncode_thumb_layout == 'grid' ) {
	$col_size = $col_size / 2;
}

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', $_uncode_product_thumb_cols == '' ? 3 : $_uncode_product_thumb_cols );
$post_thumbnail_id = apply_filters( 'uncode_product_image_id', $product->get_image_id(), $product_id );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$placeholder       = $post_thumbnail_id ? 'with-images' : 'without-images';

$wrapper_classes = array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'woocommerce-layout-images-' . $_uncode_thumb_layout,
	'images',
);

if ( $_uncode_thumb_layout == 'grid' && isset( $vc_gutter_grid ) ) {
	$wrapper_classes[] = 'grid-gutter-' . $vc_gutter_grid;
}

$wrapper_classes[] = uncode_woocommerce_single_product_zoom_enabled( true ) ? 'woocommerce-product-gallery--zoom-enabled' : 'woocommerce-product-gallery--zoom-disabled';

$woo_carousel = false;
$gallery_images_ids = apply_filters( 'uncode_product_gallery_thumb_ids', $product->get_gallery_image_ids(), $product_id );

if (
	(
		( uncode_woocommerce_single_product_slider_enabled(true) && ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) )
		||
		( $_uncode_thumb_layout === 'stack-lateral' && isset( $vc_nav ) && $vc_nav === 'lateral' )
	)
	&&
	(
		( is_array( $gallery_images_ids ) && !empty( $gallery_images_ids ) )
		||
		( function_exists('vc_is_page_editable') && vc_is_page_editable() )
	)
) {

	foreach( $gallery_images_ids as $_gallery_img_id ) {
		if ( get_post($_gallery_img_id) ) {
			$woo_carousel = true;
		}
	}
	if ( $woo_carousel === true && ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) ) {
		$wrapper_classes[] = 'owl-carousel-wrapper';
	}
	if ( isset( $vc_nav ) && $vc_nav === 'lateral' ) {
		$wrapper_classes[] = 'woocommerce-product-gallery-lateral';
	}

}

$wrapper_classes = apply_filters( 'woocommerce_single_product_image_gallery_classes', $wrapper_classes);

?>
	<?php
		if ( $post_thumbnail_id ) {
			$media_id = $post_thumbnail_id;
			$image_title = esc_attr( get_the_title( $media_id ) );
			$image_attributes = uncode_get_media_info($media_id);
			$image_metavalues = unserialize($image_attributes->metadata);
			$image_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], $col_size, null, false);
			$small_image_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], 1, 1, true); //lightbox thumbs

			$image_link = wp_get_attachment_image_src( $media_id, 'full' )[0];

			$attributes = array(
				//'title'                   => $image_title,
				'data-src'                => $image_link,
	            'data-caption'            => $image_title,
				'data-large_image'        => $image_link,
				'data-large_image_width'  => $image_metavalues['width'],
				'data-large_image_height' => $image_metavalues['height'],
			);

			if ( $adaptive_images === 'on' && uncode_woocommerce_single_product_slider_enabled(true) && ( ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) || ( isset( $vc_nav ) && $vc_nav === 'lateral' ) ) && is_array( $gallery_images_ids ) && !empty( $gallery_images_ids ) ) {
				$attributes['src'] = $image_resized['url'];
			}

			if ($adaptive_images === 'on') {
				$attributes['data-singlew'] = $col_size;
				$attributes['data-singleh'] = null;
				$attributes['data-crop'] = false;
			}

			if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
				$attributes['class'] = 'woocommerce-product-gallery__image-first__img';
			}

			if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
				$adaptive_async_class = uncode_get_adaptive_async_class();
				if ( $adaptive_async_class ) {
					$attributes['class']        .= $adaptive_async_class;
					$attributes['data-uniqueid'] = $media_id.'-'.uncode_big_rand();
					$attributes['data-guid']     = $image_attributes->guid;
					$attributes['data-path']     = $image_attributes->path;
					$attributes['data-width']    = $image_metavalues['width'];
					$attributes['data-height']   = $image_metavalues['height'];
				}
			}

			global $gallery_id;
			$gallery_id = uncode_big_rand();

			$data_lbox = isset( $vc_lightbox ) && $vc_lightbox === 'yes' ? '' : ' data-lbox="ilightbox_gallery-' . $gallery_id . '" data-lb-index="0"';
			$data_lbox .= isset( $vc_lbox_skin ) && $vc_lbox_skin !== '' ? ' data-skin="' . $vc_lbox_skin . '"' : '';
			$lb_disabled = $data_lbox == '' ? ' lb-disabled' : '';

			$th_animation = $th_delay = $th_speed = '';
			if ( isset( $vc_animation ) ) {
				$th_animation .= ' ' . $vc_animation;
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
			$html .= '<div class="woocommerce-product-gallery__image woocommerce-product-gallery__image-first' . $_uncode_product_thumb_margin . $th_animation . '"' . $th_delay . $th_speed . '><span class="zoom-overlay"></span><a href="' . esc_url( $image_link ) . '" itemprop="image" class="woocommerce-main-image' . $lb_disabled . '" data-transparency="transparent" data-counter="on" data-caption="' . get_post_field( 'post_excerpt', $post_thumbnail_id ) . '" data-options="thumbnail: \''.$small_image_resized['url'].'\'"' . $data_lbox . '>';
			$html .= get_the_post_thumbnail( $product_id, 'full', $attributes );
			$html .= '</a></div>';
			if ( $_uncode_thumb_layout == 'grid' ) {
				$html .= '</div>';
			}

		} else {

			$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			$html              = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
			$html             .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html             .= '</div>';
		}
	?>

<?php
	if ( ! isset( $vc_thumb_layout ) ) {
		$uncode_wrapper_class = 'uncode-wrapper uncode-single-product-gallery';
		if ( $_uncode_thumb_layout === 'grid' ) {
			$uncode_wrapper_class .= ' uncode-wrapper-layout-grid';
		}

?>
<div class="<?php echo esc_attr( $uncode_wrapper_class ); ?>">
<?php
	}
?>

<?php
$product_gallery_options   = array(
	'globals'        => $product_gallery_globals,
	'default_images' => uncode_woocommerce_get_default_product_images( $product ),
);
if ( isset( $product_gallery_shortcode_atts ) ) {
	$product_gallery_options['shortcode_atts'] = $product_gallery_shortcode_atts;
}
$product_gallery_json_data = wp_json_encode( $product_gallery_options );
$product_gallery_data      = function_exists( 'wc_esc_json' ) ? wc_esc_json( $product_gallery_json_data ) : _wp_specialchars( $product_gallery_json_data, ENT_QUOTES, 'UTF-8', true );
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>"<?php if ( ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) && $post_type !== 'uncodeblock' ) { ?> style="opacity: 0; transition: opacity .05s ease-in-out;"<?php } ?> data-gallery-options="<?php echo uncode_switch_stock_string( $product_gallery_data ); ?>">
	<?php
		$woo_carousel_atts = '';
		if ( $woo_carousel ) {
			if ( $_uncode_thumb_layout === '' ) {
				$woo_carousel_atts = ' owl-carousel';
			} elseif ( $_uncode_thumb_layout === 'std-lateral' ) {
				$woo_carousel_atts = ' owl-carousel owl-dots-outside" data-dots="true" data-dotsmobile="true';
			}
		}
	?>
	<?php
		$data_skin = isset( $vc_lbox_skin ) && $vc_lbox_skin !== '' ? $vc_lbox_skin : 'black';
	?>
	<div class="woocommerce-product-gallery__wrapper<?php echo uncode_switch_stock_string( $woo_carousel_atts ); ?>" data-skin="<?php echo apply_filters( 'uncode_single_product_thumbs_lbox_skin', $data_skin ); ?>">

	<?php echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); ?>

	<?php if ( ! isset( $vc_thumb_layout ) ) {
		do_action( 'woocommerce_product_thumbnails' );
	} else {
		$images_arr = array(
			'vc_thumb_layout' => $vc_thumb_layout,
			//'vc_nav' => $vc_nav,
			'vc_lightbox' => $vc_lightbox,
			'vc_ratio' => $vc_ratio,
			'vc_padding' => $vc_padding,
			'vc_animation' => $vc_animation,
			'vc_delay' => $vc_delay,
			'vc_speed' => $vc_speed,
			'vc_lbox_skin' => $vc_lbox_skin,
		);
		if ( ( $vc_thumb_layout == 'stack' || $vc_thumb_layout === 'stack-lateral' ) && isset( $vc_margin ) ) {
			$images_arr['vc_margin'] = $vc_margin;
		}
		if ( apply_filters( 'uncode_woocommerce_show_product_thumbnails', true ) ) {
			wc_get_template( 'single-product/product-thumbnails.php', $images_arr );
		}
	} ?>

	</div>
</div>

<?php
	if ( isset( $vc_thumb_layout ) && isset( $vc_nav ) && $vc_nav !== 'thumbs' && $vc_nav !== 'lateral' ) {
		$woo_carousel = false;
	} elseif ( isset( $vc_nav ) && $vc_nav === 'lateral' && function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
		$woo_carousel = true;
	}

	if ( $woo_carousel ) {

		$nav_layout = isset( $vc_nav ) && $vc_nav === 'lateral' ? 'lateral-nav' : ( ( $_uncode_thumb_layout === '' || $_uncode_thumb_layout === 'std-lateral' ) ? 'owl-carousel' : '' );
		$sticky_nav = isset( $vc_nav ) && $vc_nav === 'lateral' && $_uncode_thumb_layout === 'stack-lateral' && ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) ? 'sticky-element ' : '';
?>

<?php if ( apply_filters( 'uncode_woocommerce_show_product_thumbnails', true ) ) : ?>

<div class="woocommerce-product-gallery-nav-wrapper <?php echo esc_attr( $nav_layout ); ?>-parent" <?php if ( ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) && $post_type !== 'uncodeblock' && isset( $vc_nav ) && $vc_nav !== 'lateral' ) { ?> style="opacity: 0; transition: opacity .05s ease-in-out;"<?php } ?>>
	<div class="woocommerce-product-gallery-nav <?php echo esc_attr( $sticky_nav . $nav_layout ); ?>-wrapper">
		<ul class="woocommerce-product-gallery__wrapper-nav <?php echo esc_attr( $nav_layout ); ?>">

		<?php
			if ( $post_thumbnail_id ) {
				$media_id = $post_thumbnail_id;
				$image_title = esc_attr( get_the_title( $media_id ) );
				$image_attributes = uncode_get_media_info($media_id);
				$image_metavalues = unserialize($image_attributes->metadata);
				if ($image_attributes->post_mime_type === 'image/gif' || $image_attributes->post_mime_type === 'image/url') {
					$th_crop = false;
				}
				$carousel_thumb_cols = isset( $vc_nav ) && $vc_nav === 'lateral' ? 1 : ( 12 / $columns ) / ( 12 / $col_size );
				$image_resized = uncode_resize_image($image_attributes->id, $image_attributes->guid, $image_attributes->path, $image_metavalues['width'], $image_metavalues['height'], $carousel_thumb_cols, ($th_crop ? $carousel_thumb_cols / $thumb_ratio : null), $th_crop);

				$image_link = wp_get_attachment_image_src( $media_id, 'full' )[0];
				$image_srcset = wp_get_attachment_image_srcset( $media_id, 'full' );

				$attributes = array(
					'data-src'                => $image_link,
		            'data-caption'            => $image_title,
					'data-large_image'        => $image_link,
					'data-large_image_width'  => $image_metavalues['width'],
					'data-large_image_height' => $image_metavalues['height'],
				);

				$attach_size = $th_size;

				if ( $adaptive_images === 'on' && $_uncode_thumb_layout !== 'stack' && $_uncode_thumb_layout !== 'stack-lateral' ) {
					$attach_size = 'full';
					$attributes['src'] = $image_resized['url'];
				}

				if ($adaptive_images === 'on') {
					$attributes['data-singlew'] = $carousel_thumb_cols;
					$attributes['data-singleh'] = ($th_crop ? $carousel_thumb_cols / $thumb_ratio : null);
					$attributes['data-crop'] = $th_crop;
					$attributes['sizes'] = 'false';
				}

				if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
					$adaptive_async_class = uncode_get_adaptive_async_class();
					if ( $adaptive_async_class ) {
						$attributes['class']         = $adaptive_async_class;
						$attributes['data-uniqueid'] = $media_id.'-'.uncode_big_rand();
						$attributes['data-guid']     = $image_attributes->guid;
						$attributes['data-path']     = $image_attributes->path;
						$attributes['data-width']    = $image_metavalues['width'];
						$attributes['data-height']   = $image_metavalues['height'];
					}
				}

				$attributes['data-o_src'] = $image_link;
				$attributes['data-o_srcset'] = $image_srcset;

				if ( isset($vc_nav) && $vc_nav === 'lateral' ) {
					$attach_size = $th_size;
					$attributes = false;
				}

				global $gallery_id;
				$gallery_id = uncode_big_rand();

				$html = '<li class="woocommerce-product-gallery__thumb woocommerce-product-gallery__first-thumb">';
				$html .= wp_get_attachment_image( $post_thumbnail_id, $attach_size, false, $attributes );
				$html .= '</li>';

			} else {

				$html  = '<li class="woocommerce-product-gallery__thumb">';
				$html .= sprintf( '<img src="%s" alt="%s">', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</li>';

			}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html_nav', $html, $post_thumbnail_id );

		if ( isset( $vc_thumb_layout ) ) {
			$images_arr = array(
				'slider_nav' => true,
				'vc_thumb_layout' => $vc_thumb_layout,
				'vc_columns' => $vc_columns,
				'vc_nav' => $vc_nav,
				'vc_lightbox' => $vc_lightbox,
				'vc_ratio' => $vc_ratio,
				'vc_animation' => $vc_animation,
				'vc_delay' => $vc_delay,
				'vc_speed' => $vc_speed,
			);
		} else {
			$images_arr = array(
				'slider_nav' => true,
			);
		}
		wc_get_template( 'single-product/product-thumbnails.php', $images_arr );
		?>

		</ul>

	</div>

</div>

<?php endif; ?>

<?php
	}
?>

<?php if ( ! isset( $vc_thumb_layout ) ) {
echo '</div>'; // .uncode-wrapper.uncode-single-product-gallery
} ?>
