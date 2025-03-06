<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

extract(
	shortcode_atts(
		array(
			'product_att' => '',
			'link' => '',
			'max_width' => '',
			'el_id' => '',
			'el_class' => '',
		),
		$atts
	)
);

if ( ! $product_att ) {
	return;
}

// Extra settings
$el_id    = $el_id ? $el_id : false;
$el_class = $el_class ? $el_class : false;

// Custom ID
if ( $el_id ) {
	$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$container_id = '';
}

// Custom classes
$container_classes = array( 'uncode-wrapper', 'uncode-wc-attribute-image-module' );

if ( $el_class ) {
	$extra_classes = explode( ' ', $el_class );

	foreach ( $extra_classes as $extra_class ) {
		$container_classes[] = $extra_class;
	}
}

// Max width
$max_width = absint( $max_width );
$max_width = $max_width ? $max_width . 'px' : '';

$post_type = uncode_get_current_post_type();

if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
	?>
	<div <?php echo esc_attr( $container_id ); ?> class="<?php echo esc_attr(  trim( implode( ' ', $container_classes ) ) ); ?>">
		<?php
		$image_url = false;
		$shop_url  = get_permalink( wc_get_page_id( 'shop' ) );

		$thumbnail_size = 'uncode_woocommerce_nav_thumbnail_regular';
		$image          = wc_placeholder_img( $thumbnail_size );

		if ( $link === 'shop' ) {
			$image_url = $shop_url;
		} else if ( $link === 'archive' ) {
			$image_url = $shop_url;
		}
		?>

		<?php if ( $image_url ) : ?>
			<a class="attribute-image-wrapper" href="<?php echo esc_url( $image_url ) ?>" style="max-width: <?php echo esc_attr( $max_width ) ?>">
		<?php else : ?>
			<span class="attribute-image-wrapper" style="max-width: <?php echo esc_attr( $max_width ) ?>">
		<?php endif; ?>

		<?php echo uncode_switch_stock_string( $image ); ?>

		<?php if ( $image_url ) : ?>
			</a>
		<?php else : ?>
			</span>
		<?php endif; ?>
	</div>
<?php
} else {
	global $product;

	if ( ! $product ) {
		$product_object = uncode_populate_post_object();
	} else {
		$product_object = $product;
	}

	$product_id = $product_object->get_id();

	$tax_props = uncode_wc_get_taxonomy_props( $product_att );

	if ( isset( $tax_props->attribute_type ) && $tax_props->attribute_type === 'image' ) {
		$att_terms = wc_get_product_terms( $product_id, $product_att );

		if ( is_array( $att_terms ) && count( $att_terms ) > 0 ) {
			?>
			<div <?php echo esc_attr( $container_id ); ?> class="<?php echo esc_attr(  trim( implode( ' ', $container_classes ) ) ); ?>">
				<?php
				$image_url = false;
				$shop_url  = get_permalink( wc_get_page_id( 'shop' ) );

				foreach ( $att_terms as $term ) {
					$thumbnail_id   = absint( get_term_meta( $term->term_id, 'uncode_pa_thumbnail_id', true ) );
					$thumbnail_id   = $thumbnail_id ? $thumbnail_id : false;
					$image_size     = uncode_wc_get_image_swatch_size( $product_att );
					$thumbnail_size = $image_size === 'regular' ? 'uncode_woocommerce_nav_thumbnail_regular' : 'uncode_woocommerce_nav_thumbnail_crop';
					$image          = $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, $thumbnail_size ) : wc_placeholder_img( $thumbnail_size );

					if ( $link === 'shop' ) {
						$image_url = add_query_arg(
							array(
								uncode_get_filter_pa_key( $product_att) => $term->slug,
								UNCODE_FILTER_PREFIX => 1
							),
							$shop_url
						);
					} else if ( $link === 'archive' ) {
						$image_url = get_term_link( $term, $product_att );
					}
					?>

					<?php if ( $image_url ) : ?>
						<a class="attribute-image-wrapper" href="<?php echo esc_url( $image_url ) ?>" style="max-width: <?php echo esc_attr( $max_width ) ?>">
					<?php else : ?>
						<span class="attribute-image-wrapper" style="max-width: <?php echo esc_attr( $max_width ) ?>">
					<?php endif; ?>

					<?php echo uncode_switch_stock_string( $image ); ?>

					<?php if ( $image_url ) : ?>
						</a>
					<?php else : ?>
						</span>
					<?php endif; ?>
				<?php } ?>
			</div>
			<?php
		}
	}
}
