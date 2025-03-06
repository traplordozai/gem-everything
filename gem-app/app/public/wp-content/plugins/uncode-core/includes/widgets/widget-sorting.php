<?php
/**
 * Sorting Widget.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Widget cart class.
 */
class Uncode_WC_Widget_Sorting extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_sorting';
		$this->widget_description = __( 'Display a list or a dropdown to sort the products in the shop page.', 'uncode-core' );
		$this->widget_id          = 'uncode_woocommerce_widget_sorting';
		$this->widget_name        = __( 'WooCommerce Sorting', 'uncode-core' );
		$this->settings           = array(
			'title'         => array(
				'type'  => 'text',
				'std'   => __( 'Sort products', 'uncode-core' ),
				'label' => __( 'Title', 'uncode-core' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby',
			array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by latest', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
			)
		);

		$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
		$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

		if ( wc_get_loop_prop( 'is_search' ) ) {
			$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! $show_default_orderby ) {
			unset( $catalog_orderby_options['menu_order'] );
		}

		if ( ! wc_review_ratings_enabled() ) {
			unset( $catalog_orderby_options['rating'] );
		}

		if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
			$orderby = current( array_keys( $catalog_orderby_options ) );
		}

		$this->widget_start( $args, $instance );

		?>
		<ul>
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<li><a class="<?php echo $orderby === $id ? 'active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'orderby', $id ) ); ?>"><?php echo esc_html( $name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php

		$this->widget_end( $args );
	}
}
