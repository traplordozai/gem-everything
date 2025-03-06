<?php
/**
 * VC Uncode Index (Posts Module) Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_index extends WPBakeryShortCode
{
	protected $filter_categories = array();
	protected $query = false;
	protected $loop_args = array();
	protected $taxonomies = false;
	protected $auto_query = false;
	protected $auto_query_type = 'default';
	protected $is_tax_query = false;
	protected $current_post_id = 0;
	protected $query_options = array();

	function __construct($settings)
	{
		parent::__construct($settings);
	}

	protected function getFileName()
	{
		return 'uncode_index';
	}

	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}

	public function getCategoriesLink( $post_id ) {
		$categories_link = array();
		$args = apply_filters( 'uncode_core_get_thumb_categories_args', array('orderby' => 'taxonomy', 'order' => 'DESC', 'fields' => 'all') );
		$post_categories = wp_get_object_terms( $post_id, $this->getTaxonomies(), $args);
		$not_allowed_taxonomies = apply_filters( 'uncode_core_not_allowed_post_taxonomies', array() );
		foreach ( $post_categories as $cat ) {
			if ( in_array( $cat->taxonomy, $not_allowed_taxonomies ) ) {
				continue;
			}
			if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
				$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
			} else if ($cat->taxonomy === 'post_tag') {
				$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
			}
		}
		return $categories_link;
	}

	public function getCategoriesCss($post_id) {
		$categories_css = '';
		$categories_name = array();
		$tag_name = array();
		$categories_id = array();
		$taxonomy_type = array();
		$args = apply_filters( 'uncode_core_get_thumb_categories_args', array('orderby' => 'taxonomy', 'order' => 'DESC', 'fields' => 'all') );
		$post_categories = wp_get_object_terms($post_id, $this->getTaxonomies(), $args);
		$not_allowed_taxonomies = apply_filters( 'uncode_core_not_allowed_post_taxonomies', array( 'translation_priority' ) );
		foreach ($post_categories as $cat) {
			if ( in_array( $cat->taxonomy, $not_allowed_taxonomies ) ) {
				continue;
			}
			$_taxonomy_type = $cat->taxonomy;
			if ($cat->taxonomy)
			if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
				if (!in_array($cat->term_id, $this->filter_categories)) {
					$this->filter_categories[] = $cat->term_id;
				}
				if ($cat->taxonomy !== 'post_tag') $categories_css.= ' grid-cat-' . $cat->term_id;
				$categories_name[] = $cat->name;
				$categories_id[] = $cat->term_id;
			} else if ($cat->taxonomy === 'post_tag') {
				$categories_id[] = $cat->term_id;
				$categories_name[] = $cat->name;
				$tag_name[] = $cat->name;
			}
			$taxonomy_type[] = $cat->taxonomy;
		}


		return array('cat_css' => $categories_css, 'cat_name' => $categories_name, 'cat_id' => $categories_id, 'tag' => $tag_name, 'taxonomy' => $taxonomy_type );
	}
	protected function resetTaxonomies()
	{
		$this->taxonomies = false;
	}
	protected function getTaxonomies()
	{
		if ($this
			->taxonomies === false)
		{
			$this
				->taxonomies = get_object_taxonomies(!empty($this
				->loop_args['post_type']) ? $this->loop_args['post_type'] : get_post_types(array(
				'public' => false,
				'name' => 'attachment'
			) , 'names', 'NOT'));
		}

		return $this->taxonomies;
	}

	protected function getFilterCategories()
	{
		return get_terms($this
			->getTaxonomies() , array(
			'orderby' => 'name',
			'include' => implode(',', $this->filter_categories)
		));
	}

	protected function getPostContent()
	{
		remove_filter('the_content', 'wpautop');
		$content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
		return $content;
	}

	protected function getPostExcerpt()
	{
		remove_filter('the_excerpt', 'wpautop');
		$content = apply_filters('the_excerpt', get_the_excerpt());
		return $content;
	}

	public function buildWpQuery($query, $exclude_id = false, $offset = false)
	{
		$data = self::parseData($query);
		$data['auto_query'] = $this->auto_query;
		$data['auto_query_type'] = $this->auto_query_type;
		$data['is_tax_query'] = $this->is_tax_query;
		$data['tax_query_args'] = $data;
		$data['current_post_id'] = $this->current_post_id;
		$data['query_options'] = $this->query_options;
		$query_builder = new UncodeLoopQueryBuilder( $data );
		if ($exclude_id){
			$query_builder->excludeId($exclude_id);
		}
		return $query_builder->build($offset);
	}
	public function vc_build_loop_query($query, $exclude_id = false, $offset = false)
	{
		return self::buildWpQuery($query, $exclude_id, $offset);
	}
	protected function parseData($value)
	{
		if (is_array($value)) return $value;
		$data = array();
		$values_pairs = preg_split('/\|/', $value);
		foreach ($values_pairs as $pair)
		{
			if (!empty($pair))
			{
				list($key, $value) = preg_split('/\:/', $pair);
				$data[$key] = $value;
			}
		}
		return $data;
	}
	public function callGetLoop($loop)
	{
		$this->getLoop( $loop );
	}
	protected function getLoop($loop, $offset = false, $auto_query = false, $auto_query_type = 'default', $options = array())
	{
		$this->query_options = $options;

		if ( $auto_query ) {
			$this->auto_query = true;

			if ( $auto_query_type ) {
				$this->auto_query_type = $auto_query_type;
			} else {
				$this->auto_query_type = 'default';
			}
		} else {
			$this->auto_query = false;
		}

		$this->is_tax_query = $this->is_tax_query( $loop );

		$data = self::parseData($loop);
		foreach ($data as $key => $value)
		{
			$method = 'parse_' . $key;
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}

		$exclude_post = ( is_single() || is_page() ) && ! is_front_page() ? get_the_ID() : '';
		$this->current_post_id = $exclude_post ? $exclude_post : 0;
		list($this->loop_args, $this->query) = $this->vc_build_loop_query($loop, $exclude_post, $offset);
	}

	public function is_tax_query( $loop ) {
		if ( function_exists( 'uncode_parse_loop_data' ) ) {
			$loop_data = uncode_parse_loop_data( $loop );

			if ( isset( $loop_data['taxonomy_query'] ) && $loop_data['taxonomy_query'] ) {
				return true;
			}
		}

		return false;
	}
}

require_once vc_path_dir('PARAMS_DIR', 'loop/loop.php');

class UncodeLoopQueryBuilder extends VcLoopQueryBuilder
{
	protected $is_top_rated = false;
	protected $wc_query = null;
	protected $auto_query = false;
	protected $auto_query_type = 'default';
	protected $is_tax_query = false;
	protected $tax_query_args = array();
	protected $current_post_id = 0;
	protected $query_options = array();

	protected function parse_is_tax_query( $value )
	{
		$this->is_tax_query = $value ? $value : false;
	}

	protected function parse_tax_query_args( $args ) {
		if ( ! $this->is_tax_query ) {
			return $args;
		}

		$number = 10;

		if ( isset( $args['taxonomy_count'] ) ) {
			$number = $args['taxonomy_count'] === 'All' ? 0 : absint( $args['taxonomy_count'] );
		}

		$tax_args = array(
			'taxonomy'     => isset( $args['taxonomy_query'] ) ? $args['taxonomy_query'] : '',
			'order'        => isset( $args['taxonomy_sort'] ) ? $args['taxonomy_sort'] : 'ASC',
			'orderby'      => isset( $args['taxonomy_order'] ) ? $args['taxonomy_order'] : 'name',
			'number'       => $number,
			'hide_empty'   => isset( $args['taxonomy_show_empty'] ) && $args['taxonomy_show_empty'] === 'yes' ? false : true,
		);

		if ( isset( $args['taxonomy_hierarchical'] ) && $args['taxonomy_hierarchical'] === 'parents' ) {
			$tax_args['parent'] = 0;
		}

		if ( isset( $args['taxonomy_include_ids'] ) ) {
			$ids = explode( ',', trim( $args['taxonomy_include_ids'] ) );

			if ( is_array( $ids ) ) {
				$ids = array_map( 'absint', $ids );

				$tax_args['include'] = $ids;
			}
		}

		// Category Order and Taxonomy Terms Order
		if ( defined( 'TOPATH' ) ) {
			if ( $tax_args['orderby'] !== 'term_order' ) {
				$tax_args['ignore_term_order'] = true;
				add_filter( 'to/get_terms_orderby/ignore', '__return_true' );
			}
		} else {
			if ( class_exists( 'WooCommerce' ) && $tax_args['taxonomy'] === 'product_cat' && $tax_args['orderby'] === 'term_order' ) {
				$tax_args['orderby'] = 'menu_order';
			}
		}

		$this->tax_query_args = $tax_args;
	}

	protected function parse_auto_query( $value )
	{
		$this->auto_query = $value ? $value : false;
	}

	protected function parse_auto_query_type( $value )
	{
		$this->auto_query_type = $value ? $value : 'default';
	}

	protected function parse_query_options( $value )
	{
		$this->query_options = $value ? $value : array();
	}

	protected function parse_current_post_id( $value )
	{
		$this->current_post_id = $value ? $value : 0;
	}

	protected function parse_paged($value)
	{
		$this->args['paged'] = $value;
	}
	protected function parse_category($value)
	{
		global $wpdb;
		$term_query = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->term_taxonomy WHERE term_id = %d",$value ));
		$term_type = $term_query->taxonomy;

		if ( empty( $this->args['tax_query'] ) ) {
			$this->args['tax_query'] = array(
				'relation' => 'AND'
			);
		} else {
			$this->args['tax_query']['relation'] = 'AND';
		}

		$this->args['tax_query'][] = array(
			'field' => 'term_id',
			'taxonomy' => $term_type,
			'terms' => $value,
			'operator' => 'IN'
		);
	}

	protected function parse_tax_query( $value ) {
		$terms = $this->stringToArray( $value );
		$negative_term_list = array();
		foreach ( $terms as $term ) {
			if ( (int) $term < 0 ) {
				$negative_term_list[] = abs( $term );
			}
		}

		$not_in = array();
		$in = array();

		$_args = array( 'include' => array_map( 'abs', $terms ) );
		if ( apply_filters( 'uncode_vc_show_empty_categories_on_query_builder', false ) ) {
			$_args['hide_empty'] = false;
		}

		if ( defined( 'POLYLANG_VERSION' ) ) {
			if ( apply_filters( 'uncode_js_composer_suppress_polylang_term_args', true ) ) {
				$_args['lang'] = '';
			}
		}

		$terms = get_terms( VcLoopSettings::getTaxonomies(), $_args );
		foreach ( $terms as $t ) {
			if ( in_array( (int) $t->term_id, $negative_term_list ) ) {
				$not_in[ $t->taxonomy ][] = $t->term_id;
			} else {
				$in[ $t->taxonomy ][] = $t->term_id;
			}
		}

		if ( empty( $this->args['tax_query'] ) ) {
			if ( empty( $not_in ) )//workaround to include and exclude custom tax at the same time (not compatible with multiple post types)
				$this->args['tax_query'] = array( 'relation' => 'OR' );
			else
				$this->args['tax_query'] = array( 'relation' => 'AND' );
		}

		foreach ( $in as $taxonomy => $terms ) {
			$this->args['tax_query'][] = array(
				'field' => 'term_id',
				'taxonomy' => $taxonomy,
				'terms' => $terms,
				'operator' => 'IN',
			);
		}
		foreach ( $not_in as $taxonomy => $terms ) {
			$this->args['tax_query'][] = array(
				'field' => 'term_id',
				'taxonomy' => $taxonomy,
				'terms' => $terms,
				'operator' => 'NOT IN',
			);
		}
	}

	protected function parse_order_ids( $value ) {
	}

	protected function parse_search($value) {
		$this->args['s'] = $value;
	}

	protected function parse_year($value)
	{
		$this->args['year'] = $value;
	}

	protected function parse_month($value)
	{
		$this->args['monthnum'] = $value;
	}

	protected function parse_day($value)
	{
		$this->args['day'] = $value;
	}

	protected function parse_meta_key($value) {
		if ( $value ) {
			$this->args['meta_key'] = $value;
		}
	}

	protected function parse_product_type($value) {
		// Ensure that WC is installed
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		/**
		 * VERY IMPORTANT!
		 *
		 * WooCommerce caches the output of the products shortcode in a
		 * transient. So if there are inconsistences between the output of this
		 * module and the default WC shortcode remember to clear the cache
		 * of WC (just delete the transients "wc_product_loop_xxxxx").
		 * Then test again.
		 */
		switch ( $value ) {
			case 'on_sale':
				$this->args['post__in'] = wc_get_product_ids_on_sale();
				break;

			case 'featured':
				$this->args['tax_query'][] = array(
					'field' => 'name',
					'taxonomy' => 'product_visibility',
					'terms' => 'featured',
					'operator' => 'IN'
				);
				break;

			case 'best_selling':
				$this->args['meta_key'] = 'total_sales';
				$this->args['order']    = 'DESC';
				$this->args['orderby']  = 'meta_value_num';
				break;

			case 'top_rated':
				$this->is_top_rated = true;
				break;

			case 'cross_sells':
				if ( ! is_null( WC() ) && ! is_null( WC()->cart ) ) {
					$cross_sells_ids = WC()->cart->get_cross_sells();

					if ( ( is_array( $cross_sells_ids ) && count( $cross_sells_ids ) > 0 ) || apply_filters( 'uncode_index_fill_cross_sells', false ) ) {
						$this->args['post__in'] = $cross_sells_ids;
					} else {
						$this->args['post__in'] = array(0);
					}

				} else {
					$this->args['post__in'] = array(0);
				}

				$this->args = apply_filters( 'uncode_get_uncode_index_cross_sells_args', $this->args );

				break;
		}
	}

	/**
	 * @return array
	 */
	public function build($offset = false) {
		if ( $this->is_tax_query ) {
			$query = new WP_Term_Query( apply_filters( 'uncode_get_uncode_index_tax_query_args', $this->tax_query_args ) );
			$result = array( $this->tax_query_args, $query );
		} else {
			$post_types = isset( $this->args[ 'post_type' ] ) ? $this->args[ 'post_type' ] : array();

			if ( isset( $this->args['category__in']) ) {
				$this->args['cat'] = $this->args['category__in'];
				unset($this->args['category__in']);
			}

			// Search parameters
			if ( is_array( $this->query_options ) ) {
				if ( isset( $this->query_options['s'] ) ) {
					$this->args['s'] = $this->query_options['s'];
				}
			}

			// Single product variations
			if ( is_array( $this->query_options ) && class_exists( 'WooCommerce' ) && function_exists( 'uncode_single_variations_enabled' ) && uncode_single_variations_enabled() && isset( $this->query_options['single_variations'] ) && $this->query_options['single_variations'] && in_array( 'product', $post_types ) ) {
				$this->args['post_type'][] = 'product_variation';

				add_filter( 'posts_clauses', array( $this, 'single_variations_main_clause' ), 10, 2 );


				if ( isset( $this->query_options['single_variations_hide_parent'] ) && $this->query_options['single_variations_hide_parent'] ) {
					add_filter( 'posts_clauses', array( $this, 'single_variations_hide_parent' ), 10, 2 );
				}

				if ( isset( $this->args['post__in'] ) ) {
					add_filter( 'posts_clauses', array( $this, 'single_variations_include_by_id_childs' ), 10, 2 );
				}

				if ( isset( $this->args['post__not_in'] ) ) {
					add_filter( 'posts_clauses', array( $this, 'single_variations_exclude_by_id_childs' ), 10, 2 );
				}

				if ( ot_get_option( '_uncode_woocommerce_single_variations_excluded_atts' ) !== '' ) {
					if ( isset( $this->args['post__not_in'] ) ) {
						$this->args['post__not_in'] = array_merge( $this->args['post__not_in'], get_option( 'uncode_variable_product_parent_ids', array() ) );
					} else {
						$this->args['post__not_in'] = get_option( 'uncode_variable_product_parent_ids', array() );
					}
				}
			}

			// Get IDs only
			if ( is_array( $this->query_options ) && isset( $this->query_options['fields_ids'] ) && $this->query_options['fields_ids'] === true ) {
				$this->args['fields'] = 'ids';
			}

			// Special auto query
			if ( $this->auto_query && $this->auto_query_type !== 'default' ) {
				$this->args = $this->get_special_auto_query_args( $this->args );

				if ( isset( $this->args['post__not_in'] ) && ot_get_option( '_uncode_woocommerce_single_variations_excluded_atts' ) !== '' ) {
					$variable_product_parent_ids = get_option( 'uncode_variable_product_parent_ids', array() );

					if ( $this->args['post__in'] && count( $this->args['post__in'] ) > 0 && count( $variable_product_parent_ids ) > 0 ) {
						$this->args['post__not_in'] = array_diff( $this->args['post__not_in'], $this->args['post__in'] );
					}
				}
			} else {

				if ( class_exists( 'WooCommerce' ) && in_array( 'product', $post_types ) ) {
					// Handle single product variations by IDs (only when it is not a dynamic query)
					if ( is_array( $this->query_options ) ) {
						if ( isset( $this->query_options['single_variations'] ) && $this->query_options['single_variations'] ) {
							if ( isset( $this->args['post__in'] ) ) {
								add_filter( 'posts_clauses', array( $this, 'single_variations_include_by_id_childs' ), 10, 2 );
							}
							if ( isset( $this->args['post__not_in'] ) ) {
								add_filter( 'posts_clauses', array( $this, 'single_variations_exclude_by_id_childs' ), 10, 2 );
							}
						}
					}

					if ( $this->auto_query && is_main_query() && ( is_shop() || is_product_category() || is_product_tag() ) ) {

						// WC shop page
						$this->args = $this->get_default_wc_order( $this->args );

					} else if ( isset( $_GET['orderby'] ) ) {

						// Normal page: if we have a custom order via GET, change it
						$orderby = wc_clean( (string) wp_unslash( $_GET['orderby'] ) );

						if ( $orderby ) {
							$wc_order_args = $this->get_wc_order_args( $orderby );

							$this->args['order']   = $wc_order_args['order'];
							$this->args['orderby'] = $wc_order_args['orderby'];
						}
					}
				}

				if ( class_exists( 'WooCommerce' ) ) {
					$has_special_clause = false;

					if ( isset( $this->args['orderby'] ) && ( $this->args['orderby'] === 'popularity' || $this->args['orderby'] === 'rating' || $this->args['orderby'] === 'price' ) ) {
						$has_special_clause = true;
					}

					if ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) ) {
						if ( ! ( is_array( $this->query_options ) && isset( $this->query_options['no_filters'] ) ) ) {
							$has_special_clause = true;
						}
					}

					if ( $has_special_clause && is_null( $this->wc_query ) ) {
						$this->wc_query = new WC_Query();
					}
				}

				if ( class_exists( 'WooCommerce' ) && in_array( 'product', $post_types ) ) {
					// Remove hidden products only when there are products in the query
					$terms_to_exclude = ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) ? array( 'exclude-from-catalog', 'outofstock' ) : array( 'exclude-from-catalog' );

					$product_visibility_terms  = wc_get_product_visibility_term_ids();
					$product_visibility_not_in = array( is_search() && is_main_query() ? $product_visibility_terms['exclude-from-search'] : $product_visibility_terms['exclude-from-catalog'] );

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
						$product_visibility_not_in[] = $product_visibility_terms['outofstock'];
					}

					if ( ! empty( $product_visibility_not_in ) ) {
						$this->args[ 'tax_query' ][] = array(
							'taxonomy' => 'product_visibility',
							'field'    => 'term_taxonomy_id',
							'terms'    => $product_visibility_not_in,
							'operator' => 'NOT IN'
						);
					}

					$this->args[ 'tax_query' ]['relation'] = 'AND';

					if ( ( apply_filters( 'uncode_use_woocommerce_nav_attributes_query', true ) && ! isset( $this->query_options['no_filters'] ) ) || ! isset( $_GET[UNCODE_FILTER_PREFIX] ) ) {
						$chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
						$can_use_lookup = function_exists( 'uncode_single_variations_enabled' ) && uncode_single_variations_enabled() && isset( $this->query_options['single_variations'] ) && $this->query_options['single_variations'] ? false: true;

						if ( get_option( 'woocommerce_attribute_lookup_enabled' ) === 'yes' && $can_use_lookup ) {
							if ( is_array( $chosen_attributes ) && count( $chosen_attributes ) > 0 ) {
								add_filter( 'posts_clauses', array( $this, 'add_filtering_args' ), 10, 2 );
							}
						} else {
							foreach ( WC_Query::get_layered_nav_chosen_attributes() as $taxonomy => $data ) {
								$operator = 'and' === $data['query_type'] ? 'AND' : 'IN';

								if ( function_exists( 'uncode_filter_woocommerce_layered_nav_default_query_type' ) ) {
									$operator = uncode_filter_woocommerce_layered_nav_default_query_type( $operator, $taxonomy, $data );
								}

								$this->args[ 'tax_query' ][] = array(
									'taxonomy'         => $taxonomy,
									'field'            => 'slug',
									'terms'            => $data['terms'],
									'operator'         => $operator,
									'include_children' => false,
								);
							}
						}
					}
				}

				if ($offset){
					$offset_args = $this->args;
					$offset_args['posts_per_page'] = $offset;
					$offset_args['paged'] = 1;

					if ( class_exists( 'WooCommerce' ) ) {
						$this->add_ordering_args();
					}

					$limit_posts = new WP_Query( apply_filters( 'uncode_get_uncode_index_offset_args', $offset_args, $this->query_options ) );

					if ( class_exists( 'WooCommerce' ) ) {
						$this->remove_ordering_args();
						$this->remove_filtering_args();
					}

					$this->add_cat_tax_order();

					$offset_array = array();
					foreach ($limit_posts->posts as $off_post) {
						if ( isset( $this->args['fields'] ) && $this->args['fields'] === 'ids' ) {
							$offset_array[] = $off_post;
						} else {
							$offset_array[] = $off_post->ID;
						}
					}
					if (isset($this->args['post__not_in'])) {
						$this->args['post__not_in'] = array_merge($this->args['post__not_in'], $offset_array);
					} else $this->args['post__not_in'] = $offset_array;
				}

				if ( class_exists( 'WooCommerce' ) ) {
					$this->add_ordering_args();
				}
			}

			$uncode_index_args = apply_filters( 'uncode_get_uncode_index_args', $this->args );
			$uncode_index_args = apply_filters( 'uncode_get_uncode_index_args_for_filters', $uncode_index_args, $this->query_options );

			$query = new WP_Query( $uncode_index_args );

			if ( class_exists( 'WooCommerce' ) ) {
				$this->remove_ordering_args();
				$this->remove_filtering_args();
				$this->remove_single_variations_args();
			}

			$this->add_cat_tax_order();

			$result = array( $this->args, $query );
		}

		return $result;
	}

	/**
	 * Add filtering queries.
	 */
	public function add_filtering_args( $clauses, $query ) {
		$is_ajax_filter = isset( $_GET[UNCODE_FILTER_PREFIX] ) ? true : false;
		$clauses = $this->get_filtering_clauses( $clauses, $is_ajax_filter );

		return $clauses;
	}

	/**
	 * Get filtering clauses.
	 *
	 * Copy of Automattic\WooCommerce\Internal\ProductAttributesLookup\Filterer\filter_by_attribute_post_clauses()
	 */
	public function get_filtering_clauses( $args, $is_ajax_filter ) {
		global $wpdb;

		if ( 'yes' !== get_option( 'woocommerce_attribute_lookup_enabled' ) ) {
			return $args;
		}

		// The extra derived table ("SELECT product_or_parent_id FROM") is needed for performance
		// (causes the filtering subquery to be executed only once).
		$clause_root = " {$wpdb->posts}.ID IN ( SELECT product_or_parent_id FROM (";
		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$in_stock_clause = ' AND in_stock = 1';
		} else {
			$in_stock_clause = '';
		}

		$attribute_ids_for_and_filtering = array();

		$attributes_to_filter_by = WC_Query::get_layered_nav_chosen_attributes();
		$lookup_table_name = $wpdb->prefix . 'wc_product_attributes_lookup';

		// Edited by Uncode (flag that checks if we need to filter the query)
		$needs_filtering = false;

		foreach ( $attributes_to_filter_by as $taxonomy => $data ) {
			$all_terms                  = get_terms( $taxonomy, array( 'hide_empty' => false ) );
			$term_ids_by_slug           = wp_list_pluck( $all_terms, 'term_id', 'slug' );
			$term_ids_to_filter_by      = array_values( array_intersect_key( $term_ids_by_slug, array_flip( $data['terms'] ) ) );

			// Edited by Uncode (exclude unknown terms)
			if ( $is_ajax_filter ) {
				$has_known_terms = false;
				foreach ( $data['terms'] as $single_term_slug ) {
					$_term = get_term_by( 'slug', $single_term_slug, $taxonomy );
					if ( ! is_wp_error( $_term ) && $_term ) {
						$has_known_terms = true;
					}
				}
				if ( ! $has_known_terms ) {
					continue;
				}
				$needs_filtering = true;
			}

			$term_ids_to_filter_by      = array_map( 'absint', $term_ids_to_filter_by );
			$term_ids_to_filter_by_list = '(' . join( ',', $term_ids_to_filter_by ) . ')';
			$is_and_query               = 'and' === $data['query_type'];

			$count = count( $term_ids_to_filter_by );

			if ( 0 !== $count ) {
				if ( $is_and_query && $count > 1 ) {
					$attribute_ids_for_and_filtering = array_merge( $attribute_ids_for_and_filtering, $term_ids_to_filter_by );
				} else {
					$clauses[] = "
							{$clause_root}
							SELECT product_or_parent_id
							FROM {$lookup_table_name} lt
							WHERE term_id in {$term_ids_to_filter_by_list}
							{$in_stock_clause}
						)";
				}
			}
		}

		if ( ! empty( $attribute_ids_for_and_filtering ) ) {
			$count                      = count( $attribute_ids_for_and_filtering );
			$term_ids_to_filter_by_list = '(' . join( ',', $attribute_ids_for_and_filtering ) . ')';
			$clauses[]                  = "
				{$clause_root}
				SELECT product_or_parent_id
				FROM {$lookup_table_name} lt
				WHERE is_variation_attribute=0
				{$in_stock_clause}
				AND term_id in {$term_ids_to_filter_by_list}
				GROUP BY product_id
				HAVING COUNT(product_id)={$count}
				UNION
				SELECT product_or_parent_id
				FROM {$lookup_table_name} lt
				WHERE is_variation_attribute=1
				{$in_stock_clause}
				AND term_id in {$term_ids_to_filter_by_list}
			)";
		}

		// Edited by Uncode (all unknown terms, just exit)
		if ( $is_ajax_filter && ! $needs_filtering ) {
			return $args;
		}

		if ( ! empty( $clauses ) ) {
			// "temp" is needed because the extra derived tables require an alias.
			$args['where'] .= ' AND (' . join( ' temp ) AND ', $clauses ) . ' temp ))';
		} elseif ( ! empty( $attributes_to_filter_by ) ) {
			$args['where'] .= ' AND 1=0';
		}

		return $args;
	}

	/**
	 * Add ordering queries.
	 */
	public function add_ordering_args() {
		if ( isset( $this->args['orderby'] ) ) {
			if ( $this->args['orderby'] === 'popularity' ) {
				add_filter( 'posts_clauses', array( $this->wc_query, 'order_by_popularity_post_clauses' ) );
			} else if ( $this->args['orderby'] === 'rating' ) {
				add_filter( 'posts_clauses', array( $this->wc_query, 'order_by_rating_post_clauses' ) );
			} else if ( $this->args['orderby'] === 'price' ) {
				$callback = isset( $this->args['order'] ) && 'DESC' === $this->args['order'] ? 'order_by_price_desc_post_clauses' : 'order_by_price_asc_post_clauses';
				add_filter( 'posts_clauses', array( $this->wc_query, $callback ) );
			} else if ( $this->is_top_rated ) {
				add_filter( 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
			}
		}

		if ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) ) {
			if ( ! ( is_array( $this->query_options ) && isset( $this->query_options['no_filters'] ) ) ) {
				add_filter( 'posts_clauses', array( $this, 'price_filter_post_clauses' ), 10, 2 );
			}
		}
	}

	/**
	 * Remove single variations clauses.
	 */
	public function remove_single_variations_args() {
		remove_filter( 'posts_clauses', array( $this, 'single_variations_hide_parent' ), 10, 2 );
		remove_filter( 'posts_clauses', array( $this, 'single_variations_include_by_id_childs' ), 10, 2 );
		remove_filter( 'posts_clauses', array( $this, 'single_variations_exclude_by_id_childs' ), 10, 2 );
	}

	/**
	 * Remove filtering queries.
	 */
	public function remove_filtering_args() {
		remove_filter( 'posts_clauses', array( $this, 'add_filtering_args' ), 10, 2 );
	}

	/**
	 * Remove ordering queries.
	 */
	public function remove_ordering_args() {
		remove_filter( 'posts_clauses', array( $this->wc_query, 'order_by_popularity_post_clauses' ) );
		remove_filter( 'posts_clauses', array( $this->wc_query, 'order_by_rating_post_clauses' ) );
		remove_filter( 'posts_clauses', array( $this->wc_query, 'order_by_price_desc_post_clauses' ) );
		remove_filter( 'posts_clauses', array( $this->wc_query, 'order_by_price_asc_post_clauses' ) );
		remove_filter( 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
		remove_filter( 'posts_clauses', array( $this, 'price_filter_post_clauses' ) );
	}

	public function get_default_wc_order( $args ) {
		if ( is_search() ) {
			$orderby = 'relevance';
		} else if ( isset( $_GET['orderby'] ) ) {
			$orderby_value = wc_clean( (string) wp_unslash( $_GET['orderby'] ) );

			if ( ! $orderby_value ) {
				$orderby = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
			} else {
				$orderby = $orderby_value;
			}
		} else {
			$orderby = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
		}

		$wc_order_args = $this->get_wc_order_args( $orderby );

		$args['order']   = $wc_order_args['order'];
		$args['orderby'] = $wc_order_args['orderby'];

		return $args;
	}

	public function get_wc_order_args( $orderby ) {
		// Default ASC
		$args['order'] = 'ASC';

		switch ( $orderby ) {
			case 'menu_order':
				$args['orderby'] = 'menu_order title';
				break;

			case 'date':
				$args['orderby'] = 'date ID';
				$args['order']   = 'DESC';
				break;

			case 'popularity':
			case 'relevance':
			case 'rating':
				$args['orderby'] = $orderby;
				$args['order']   = 'DESC';
				break;

			case 'price':
				$args['orderby'] = $orderby;
				break;

			case 'price-desc':
				$args['orderby'] = 'price';
				$args['order']   = 'DESC';
				break;

			case 'alphabetical':
				$args['orderby'] = 'title';
				break;
		}

		return apply_filters( 'uncode_core_get_wc_order_args', $args, $orderby );
	}

	public function get_special_auto_query_args( $args ) {
		switch ( $this->auto_query_type ) {
			case 'related':
				$args = $this->get_related_posts_query_args( $args );
				break;

			case 'navigation':
				$args = $this->get_navigation_posts_query_args( $args );
				break;

			case 'up-sells-products':
				$args = $this->get_upsells_products_query_args( $args );
				break;
		}

		return $args;
	}

	public function get_related_posts_query_args( $args ) {
		$ids = array();

		if ( function_exists( 'uncode_get_related_post_ids' ) ) {
			$per_page  = $args['posts_per_page'] ? $args['posts_per_page'] : 10;
			$post_type = get_post_type( $this->current_post_id );

			if ( ! $post_type || $post_type === 'uncodeblock' ) {
				return $args;
			}

			$ids = uncode_get_related_post_ids( $this->current_post_id, $per_page );

			if ( ! is_array( $ids ) ) {
				return $args;
			}

			// Pass found IDs
			if ( apply_filters( 'uncode_disable_random_posts_on_related', false ) && count( $ids ) < 1 ) {
				$args['post__in'] = array(0);
			} else {
				$args['post__in'] = $ids;
				$args['orderby']  = 'post__in';
			}

			$args['post_type'] = $post_type;

			$args = apply_filters( 'uncode_related_posts_query_final_args', $args );
		}

		return $args;
	}

	public function get_navigation_posts_query_args( $args ) {
		$unique_id         = isset( $this->query_options['index_id'] ) ? $this->query_options['index_id'] : rand();
		$current_post_id   = apply_filters( 'uncode_navigation_current_post_id', $this->current_post_id, $unique_id );
		$original_post_id  = $this->current_post_id;

		// Populate post object if we have a custom post id via filter
		if ( has_filter( 'uncode_navigation_current_post_id' ) ) {
			$original_post_object = get_post( $original_post_id );
			$current_post_object  = get_post( $current_post_id );
			$GLOBALS['post']      = $current_post_object;
		}

		$ids                = array();
		$post_type          = get_post_type( $current_post_id );
		$is_next_navigation = is_array( $this->query_options ) && isset( $this->query_options['navigation_type'] ) && $this->query_options['navigation_type'] === 'next' ? true : false;
		$is_prev_navigation = is_array( $this->query_options ) && isset( $this->query_options['navigation_type'] ) && $this->query_options['navigation_type'] === 'prev' ? true : false;

		if ( ! $post_type ) {
			return $args;
		}

		// When we are inside a content block, make a fake query
		// and get the first 2 posts
		if ( $post_type === 'uncodeblock' ) {
			$post_type_needed = isset( $args['post_type'] ) ? $args['post_type'] : array();

			if ( is_array( $post_type_needed ) && count( $post_type_needed ) > 0 ) {
				$post_type_needed = $post_type_needed[0];
			}

			$post_type_needed = $post_type_needed ? $post_type_needed : 'post';

			$fake_args = array(
				'post_status'    => 'publish',
				'posts_per_page' => $is_next_navigation || $is_prev_navigation ? 1 : 2,
				'order'          => 'ASC',
				'post_type'      => $post_type_needed,
			);

			$fake_posts = new WP_Query( $fake_args );

			foreach ( $fake_posts->posts as $p ) {
				$ids[] = $p->ID;
			}

			$args['post__in'] = $ids;
			$args['orderby']  = 'post__in';
			$args['post_type'] = $post_type_needed;

			return $args;
		}

		$generic_index = true;
		$specific_index = get_post_meta( $current_post_id, '_uncode_specific_navigation_index', true );
		if ( $specific_index !== '' ) {
			$navigation_index = $specific_index;
			$generic_navigation_index = ot_get_option('_uncode_' . $post_type . '_navigation_index');

			if ( absint( $navigation_index ) === absint( $generic_navigation_index ) ) {
				$navigation_index = $generic_navigation_index;
			} else {
				$generic_index = false;
			}
		} else {
			$navigation_index = ot_get_option( '_uncode_' . $post_type . '_navigation_index' );
		}

		if ( $navigation_index !== '' && ! $generic_index ) {
			global $adjacent_index;
			$adjacent_index = $navigation_index;
			add_filter( 'get_next_post_join', 'uncode_get_adjacent_post_join_filter' );
			add_filter( 'get_previous_post_join', 'uncode_get_adjacent_post_join_filter' );
			add_filter( 'get_next_post_where', 'uncode_get_adjacent_post_where_filter' );
			add_filter( 'get_previous_post_where', 'uncode_get_adjacent_post_where_filter' );
		}

		if ( ! $is_next_navigation ) {
			$previous = get_adjacent_post( false, '', true );
			if ( isset( $previous->post_title ) ) {
				$ids[] = $previous->ID;
			} else {
				if ( $post_type ) {
					$first_args = array(
						'post_status'    => 'publish',
						'posts_per_page' => 1,
						'order'          => 'DESC',
						'post_type'      => $post_type,
					);

					if ( $navigation_index !== '' && ! $generic_index ) {
						$first_args['meta_key']   = '_uncode_specific_navigation_index';
						$first_args['meta_value'] = $navigation_index;
					}

					$first = new WP_Query( $first_args );

					foreach ( $first->posts as $p ) {
						$ids[] = $p->ID;
					}

					wp_reset_query();
				}
			}
		}

		if ( ! $is_prev_navigation ) {
			$next = get_adjacent_post( false, '', false );
			if ( isset( $next->post_title ) ) {
				$ids[] = $next->ID;
			} else {
				if ( $post_type ) {
					$last_args = array(
						'post_status'    => 'publish',
						'posts_per_page' => 1,
						'order'          => 'ASC',
						'post_type'      => $post_type,
					);

					if ( $navigation_index !== '' && ! $generic_index ) {
						$last_args['meta_key']   = '_uncode_specific_navigation_index';
						$last_args['meta_value'] = $navigation_index;
					}

					$last = new WP_Query( $last_args );

					foreach ( $last->posts as $p ) {
						$ids[] = $p->ID;
					}

					wp_reset_query();
				}
			}
		}

		if ( $navigation_index !== '' && ! $generic_index ) {
			remove_filter( 'get_next_post_join', 'uncode_get_adjacent_post_join_filter' );
			remove_filter( 'get_previous_post_join', 'uncode_get_adjacent_post_join_filter' );
			remove_filter( 'get_next_post_where', 'uncode_get_adjacent_post_where_filter' );
			remove_filter( 'get_previous_post_where', 'uncode_get_adjacent_post_where_filter' );
		}

		if ( count( $ids ) === 0 ) {
			$ids = array( 0 );
		}

		$args['post__in'] = $ids;
		$args['orderby']  = 'post__in';
		$args['post_type'] = $post_type;

		// Add original post object if we have a custom post id via filter
		if ( has_filter( 'uncode_navigation_current_post_id' ) ) {
			$original_post_object = get_post( $original_post_id );
			$GLOBALS['post'] = $original_post_object;
		}

		return $args;
	}

	public function get_upsells_products_query_args( $args ) {
		$post_type = get_post_type( $this->current_post_id );

		if ( ! $post_type || $post_type === 'uncodeblock' ) {
			return $args;
		}

		if ( function_exists( 'uncode_get_upsell_product_ids' ) && class_exists( 'WooCommerce' ) ) {
			// Force empty query when there are no upsells
			$args_no_products = array( 'post__in' => array(0) );

			// Get upsells
			$upsells_ids = uncode_get_upsell_product_ids( $this->current_post_id );
			$per_page    = $args['posts_per_page'] ? $args['posts_per_page'] : 10;

			if ( ! ( is_array( $upsells_ids ) && count( $upsells_ids ) > 0 ) ) {
				return $args_no_products;
			}

			$upsells_ids = $per_page > 0 ? array_slice( $upsells_ids, 0, $per_page ) : $upsells_ids;

			// Pass found IDs
			$args['post__in']  = $upsells_ids;
			$args['orderby']   = 'post__in';
			$args['post_type'] = 'product';

			if ( function_exists( 'uncode_single_variations_enabled' ) && uncode_single_variations_enabled() ) {
				$args['post_type'] = array( 'product', 'product_variation' );
			}
		}

		return $args;
	}

	/**
	 * Show only enabled variations.
	 */
	public function single_variations_main_clause( $args, $wp_query ) {
		global $wpdb;

		$args['where'] .= " AND {$wpdb->posts}.ID NOT IN (
			    SELECT {$wpdb->posts}.ID
			    FROM {$wpdb->posts}
			    left JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id)
			    WHERE $wpdb->postmeta.meta_key = '_uncode_show_single_variation' AND $wpdb->postmeta.meta_value = 'no'
			)";

		return $args;
	}

	/**
	 * Hide parent products from single variations loops.
	 */
	public function single_variations_hide_parent( $args, $wp_query ) {
		global $wpdb;

		$add_parent_clause = true;

		if ( ot_get_option( '_uncode_woocommerce_single_variations_excluded_atts' ) !== '' ) {
			$add_parent_clause = false;
		}

		if ( $this->auto_query_type === 'up-sells-products' || $this->auto_query_type === 'related' ) {
			$add_parent_clause = true;
		}

		if ( $add_parent_clause ) {
			// We still need this clause for support older versions - so if we are not excluding an attribute
			// filter parent products in the old way
			$args['where'] .= " AND  0 = (select count(*) as variationcount from {$wpdb->posts} as uncode_products where uncode_products.post_parent = {$wpdb->posts}.ID and uncode_products.post_type= 'product_variation' and uncode_products.post_status = 'publish') ";
		}

		return $args;
	}

	/**
	 * Include child variations when querying by product IDs.
	 */
	public function single_variations_include_by_id_childs( $args, $wp_query ) {
		global $wpdb;

		if ( isset( $wp_query->query_vars['post__in'] ) && is_array( $wp_query->query_vars['post__in'] ) && count( $wp_query->query_vars['post__in'] ) > 0 ) {
			$excluded_ids = isset( $wp_query->query_vars['post__not_in'] ) && is_array( $wp_query->query_vars['post__not_in'] ) && count( $wp_query->query_vars['post__not_in'] ) > 0 ? $wp_query->query_vars['post__not_in'] : array();

			foreach ( $wp_query->query_vars['post__in'] as $product_id ) {
				if ( ! in_array( $product_id, $excluded_ids ) ) {
					$args['where'] .= " OR ({$wpdb->posts}.post_parent = $product_id AND $wpdb->posts.post_type IN ('product', 'product_variation') AND (($wpdb->posts.post_status = 'publish')))";
				}
			}
		}

		if ( apply_filters( 'uncode_group_single_variations_by_parent_id', false ) ) {
			$args['orderby'] = "FIELD( {$wpdb->posts}.post_parent," . implode( ', ', array_map( 'absint', $wp_query->query_vars['post_parent__in'] ) ) . ' )';
		}

		return $args;
	}

	/**
	 * Exclude child variations when querying by product IDs.
	 */
	public function single_variations_exclude_by_id_childs( $args, $wp_query ) {
		global $wpdb;

		if ( isset( $wp_query->query_vars['post__not_in'] ) && is_array( $wp_query->query_vars['post__not_in'] ) && count( $wp_query->query_vars['post__not_in'] ) > 0 ) {
			$excluded_ids = $wp_query->query_vars['post__not_in'];

			if ( ot_get_option( '_uncode_woocommerce_single_variations_excluded_atts' ) !== '' ) {
				$variable_product_parent_ids = get_option( 'uncode_variable_product_parent_ids', array() );

				$include_ids = array();

				if ( isset( $wp_query->query_vars['post__in'] ) && is_array( $wp_query->query_vars['post__in'] ) && count( $wp_query->query_vars['post__in'] ) > 0 ) {
					$include_ids = $wp_query->query_vars['post__in'];
				}

				if ( count( $include_ids ) > 0 ) {
					$variable_product_parent_ids = array_diff( $variable_product_parent_ids, $include_ids );
				}

				$excluded_ids = array_diff( $excluded_ids, $variable_product_parent_ids );
			}

			$excluded_ids = implode( ",", $excluded_ids );

			if ( $excluded_ids ) {
				$args['where'] .= " AND ({$wpdb->posts}.post_parent NOT IN ($excluded_ids))";
			}
		}

		return $args;
	}

	/**
	 * Custom query used to filter products by price.
	 *
	 * (copy of WC_Query::append_product_sorting_table_join()
	 * without the ! $wp_query->is_main_query() check)
	 */
	public function price_filter_post_clauses( $args, $wp_query ) {
		global $wpdb;

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( ( ! isset( $_GET['max_price'] ) && ! isset( $_GET['min_price'] ) ) ) {
			return $args;
		}

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$current_min_price = isset( $_GET['min_price'] ) ? floatval( wp_unslash( $_GET['min_price'] ) ) : 0;
		$current_max_price = isset( $_GET['max_price'] ) ? floatval( wp_unslash( $_GET['max_price'] ) ) : PHP_INT_MAX;
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		/**
		 * Adjust if the store taxes are not displayed how they are stored.
		 * Kicks in when prices excluding tax are displayed including tax.
		 */
		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
			$tax_rates = WC_Tax::get_rates( $tax_class );

			if ( $tax_rates ) {
				$current_min_price -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $current_min_price, $tax_rates ) );
				$current_max_price -= WC_Tax::get_tax_total( WC_Tax::calc_inclusive_tax( $current_max_price, $tax_rates ) );
			}
		}

		$args['join']   = $this->append_product_sorting_table_join( $args['join'] );
		$args['where'] .= $wpdb->prepare(
			' AND NOT (%f<wc_product_meta_lookup.min_price OR %f>wc_product_meta_lookup.max_price ) ',
			$current_max_price,
			$current_min_price
		);
		return $args;
	}

	/**
	 * Join wc_product_meta_lookup to posts if not already joined.
	 *
	 * (copy of WC_Query::append_product_sorting_table_join())
	 */
	private function append_product_sorting_table_join( $sql ) {
		global $wpdb;

		if ( ! strstr( $sql, 'wc_product_meta_lookup' ) ) {
			$sql .= " LEFT JOIN {$wpdb->wc_product_meta_lookup} wc_product_meta_lookup ON $wpdb->posts.ID = wc_product_meta_lookup.product_id ";
		}
		return $sql;
	}

	/**
	 * Add again "Category Order and Taxonomy Terms Order" filter
	 */
	private function add_cat_tax_order() {
		if ( defined( 'TOPATH' ) ) {
			add_filter( 'to/get_terms_orderby/ignore', '__return_false' );
		}
	}
}
