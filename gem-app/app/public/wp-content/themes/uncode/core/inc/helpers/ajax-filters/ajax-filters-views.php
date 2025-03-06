<?php
/**
 * Ajax Filters views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Output term filter in list/checkbox mode
 */
if ( ! function_exists( "uncode_ajax_term_filter_list_html" ) ) {
	function uncode_ajax_term_filter_list_html( $key_to_query, $filter_terms, $query_args, $args = array(), $is_checkbox = false ) {
		$multiple    = isset( $args['multiple'] ) ? $args['multiple'] : false;
		$show_count  = isset( $args['show_count'] ) ? $args['show_count'] : false;
		$hierarchy   = isset( $args['hierarchy'] ) ? $args['hierarchy'] : false;
		$display     = isset( $args['display'] ) ? $args['display'] : false;
		$columns_num = isset( $args['columns_num'] ) ? $args['columns_num'] : false;
		$is_logo     = isset( $args['is_logo'] ) && $args['is_logo'] ? true : false;

		$filter_list_class = $is_logo ? 'term-filters-list--logo' : '';

		?>
		<?php if ( $hierarchy === 'yes' && ! $display && ! in_array( $key_to_query, uncode_get_special_filter_keys() ) ) : ?>
			<?php
			$args['filter_terms'] = $filter_terms;
			$sort_by = $args['sort_by'] === 'desc' ? 'DESC' : 'ASC';

			$wp_list_args = array(
				'title_li'   => '',
				'style'      => 'list',
				'echo'       => false,
				'taxonomy'   => $key_to_query,
				'depth'      => 100,
				'show_count' => $show_count,
				'include'    => array_keys( $filter_terms ),
				'order'      => $sort_by,
				'walker'     => new Uncode_Walker_Filters( $query_args, $args, $is_checkbox )
			);

			if ( $args['order_by'] === 'count' ) {
				$wp_list_args['order_by'] = 'count';
			} else if ( $args['order_by'] === 'custom' ) {
				$wp_list_args['orderby'] = 'meta_value_num';
				$wp_list_args['meta_key'] = 'order';
			}

			$terms_list = wp_list_categories( $wp_list_args );
			?>
			<ul class="term-filters-list <?php echo esc_attr( $filter_list_class ); ?>">
				<?php echo uncode_switch_stock_string( $terms_list ); ?>
			</ul>
		<?php else : ?>
			<?php
			$filter_list_class = $display === 'inline' ? 'term-filters-list--inline' : ( $display === 'columns' ? 'term-filters-list--columns term-filters-list--columns-' . $columns_num : '' );

			if ( $is_logo ) {
				$filter_list_class .= ' term-filters-list--logo';
			}
			?>
			<ul class="term-filters-list <?php echo esc_attr( $filter_list_class ); ?>">
				<?php
				if ( ! $multiple ) {
					$has_checked = false;
				}
				?>

				<?php foreach ( $filter_terms as $filter_term_key => $filter_term_value ) : ?>
					<?php
					if ( in_array( $key_to_query, uncode_get_special_filter_keys() ) || $key_to_query === 'custom_price' ) {
						$term             = $filter_term_key;
						$term_id          = $term;
						$term_name        = $filter_term_value['name'];
						$term_slug        = $term;
						$term_description = '';
						$is_taxonomy      = false;
					} else {
						$term             = $filter_term_value['term'];
						$term_id          = $term->term_id;
						$term_name        = $term->name;
						$term_slug        = $term->slug;
						$term_description = $term->description;
						$is_taxonomy      = true;
					}

					$filter_id           = 'filter_' . rand() . '_' . $term_id;
					$current_filter_atts = uncode_get_filter_link_attributes( $term, $key_to_query, $query_args, $args, $filter_terms );

					list( $filter_url, $filter_atts ) = $current_filter_atts;
					$checked = $filter_atts['checked'];

					if ( ! $multiple ) {
						if ( $has_checked ) {
							$checked = false;
						}

						if ( $checked ) {
							$has_checked = true;
						}
					}

					if ( $key_to_query === 'rating' ) {
						$display_value = wc_get_rating_html( $term );
					} else if ( $key_to_query === 'custom_price' ) {
						$display_value = $term_name;
					} else {
						$display_value = esc_html( $term_name );
					}

					$term_param = $is_taxonomy ? $term : false;

					if ( apply_filters( 'uncode_show_term_description', false, $term_param ) && $term_description ) {
						$display_value .= '<span class="term-filter-description">' . $term_description . '</span>';
					}
					?>
					<li class="term-filter">
						<?php if ( $is_checkbox ) : ?>
							<label for="<?php echo esc_attr( $filter_id ); ?>"><input type="checkbox" name="<?php echo esc_attr( $filter_id ); ?>" id="<?php echo esc_attr( $filter_id ); ?>" value="<?php echo esc_attr( $term_slug ); ?>" <?php checked( $checked, true ); ?>><a href="<?php echo esc_url( $filter_url ); ?>" class="term-filter-link" title="<?php echo esc_attr( strip_tags( $term_description ) ); ?>"><?php echo uncode_switch_stock_string( $display_value ); ?></a></label>
						<?php else : ?>
							<a href="<?php echo esc_url( $filter_url ); ?>" class="term-filter-link <?php echo esc_attr( $checked ? 'term-filter-link--active' : '' );  ?>" title="<?php echo esc_attr( strip_tags( $term_description ) ); ?>"><?php echo uncode_switch_stock_string( $display_value ); ?></a>
						<?php endif; ?>

						<?php if ( $show_count ) : ?>
							<span class="term-filter-count">(<?php echo number_format_i18n( $filter_term_value['count'] ); ?>)</span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php
	}
}

/**
 * Output term filter in select mode
 */
function uncode_ajax_term_filter_select_html( $key_to_query, $filter_terms, $query_args, $args = array() ) {
	$show_count   = isset( $args['show_count'] ) ? $args['show_count']: false;
	$display      = isset( $args['display'] ) ? $args['display']      : false;
	$filter_id    = 'filter_' . rand() . '_' . $key_to_query;
	$first_option = isset( $args['first_option'] ) && $args['first_option'] !== '' ? $args['first_option'] : false;
	$filter_terms = apply_filters( 'uncode_ajax_term_filter_select_html_terms', $filter_terms, $args, $key_to_query, $query_args );
	?>
	<select class="term-filters-list select--term-filters" name="<?php echo esc_attr( $filter_id ); ?>" id="<?php echo esc_attr( $filter_id ); ?>">
		<?php
		$has_checked = false;
		?>

		<?php if ( $first_option ) : ?>
			<option data-term-filter-url="<?php echo esc_url( uncode_clear_key_filters( $key_to_query, uncode_get_current_url(), $query_args ) ); ?>"><?php echo esc_html( $first_option ); ?></option>
		<?php endif; ?>

		<?php foreach ( $filter_terms as $filter_term_key => $filter_term_value ) : ?>
			<?php
			if ( in_array( $key_to_query, uncode_get_special_filter_keys() ) || $key_to_query === 'custom_price' ) {
				$term             = $filter_term_key;
				$term_id          = $term;
				$term_name        = $filter_term_value['name'];
				$term_slug        = $term;
				$term_description = '';
				$is_taxonomy      = false;
			} else {
				$term             = $filter_term_value['term'];
				$term_id          = $term->term_id;
				$term_name        = $term->name;
				$term_slug        = $term->slug;
				$term_description = $term->description;
				$is_taxonomy      = true;
			}

			$current_filter_atts = uncode_get_filter_link_attributes( $term, $key_to_query, $query_args, $args, $filter_terms );
			$filter_id           = 'filter_' . rand() . '_' . $term_id;

			list( $filter_url, $filter_atts ) = $current_filter_atts;
			$checked = $filter_atts['checked'];

			if ( $has_checked ) {
				$checked = false;
			}

			if ( $checked ) {
				$has_checked = true;
			}

			$term_param = $is_taxonomy ? $term : false;

			if ( apply_filters( 'uncode_show_term_description', false, $term_param ) && $term_description ) {
				$term_name .= '<span class="term-filter-description">' . $term_description . '</span>';
			}
			?>
			<option value="<?php echo esc_attr( $term_slug ); ?>" data-term-filter-url="<?php echo esc_url( $filter_url ); ?>" <?php selected( $checked, true ); ?>>
				<?php echo uncode_switch_stock_string( $term_name ); ?>
				<?php if ( $show_count ) : ?>
					<span class="term-filter-count">(<?php echo number_format_i18n( $filter_term_value['count'] ); ?>)</span>
				<?php endif; ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}

/**
 * Output term filter in label mode
 */
function uncode_ajax_term_filter_label_html( $key_to_query, $filter_terms, $query_args, $args = array() ) {
	$multiple    = isset( $args['multiple'] ) ? $args['multiple'] : false;
	$show_count  = isset( $args['show_count'] ) ? $args['show_count'] : false;
	$display     = isset( $args['display'] ) ? $args['display'] : false;
	$columns_num = isset( $args['columns_num'] ) ? $args['columns_num'] : false;
	$is_logo     = isset( $args['is_logo'] ) && $args['is_logo'] ? true : false;

	$filter_list_class = $display === 'inline' ? 'term-filters-list--inline' : ( $display === 'columns' ? 'term-filters-list--columns term-filters-list--columns-' . $columns_num : '' );

	if ( $is_logo ) {
		$filter_list_class .= ' term-filters-list--logo';
	}
	?>
	<ul class="term-filters-list <?php echo esc_attr( $filter_list_class ); ?>">
		<?php
		if ( ! $multiple ) {
			$has_checked = false;
		}
		?>

		<?php foreach ( $filter_terms as $filter_term_key => $filter_term_value ) : ?>
			<?php
			if ( in_array( $key_to_query, uncode_get_special_filter_keys() ) || $key_to_query === 'custom_price' ) {
				$term             = $filter_term_key;
				$term_id          = $term;
				$term_name        = $filter_term_value['name'];
				$term_slug        = $term;
				$term_description = '';
				$is_taxonomy      = false;
			} else {
				$term             = $filter_term_value['term'];
				$term_id          = $term->term_id;
				$term_name        = $term->name;
				$term_slug        = $term->slug;
				$term_description = $term->description;
				$is_taxonomy      = true;
			}

			$current_filter_atts = uncode_get_filter_link_attributes( $term, $key_to_query, $query_args, $args, $filter_terms );
			$filter_id           = 'filter_' . rand() . '_' . $term_id;

			list( $filter_url, $filter_atts ) = $current_filter_atts;
			$checked = $filter_atts['checked'];

			$swatch_classes = array(
				'swatch',
				'swatch--single',
				'swatch-type-label',
			);

			if ( ! $multiple ) {
				if ( $has_checked ) {
					$checked = false;
				}

				if ( $checked ) {
					$has_checked = true;
				}
			}

			$term_param = $is_taxonomy ? $term : false;

			if ( apply_filters( 'uncode_show_term_description', false, $term_param ) && $term_description ) {
				$term_name .= '<span class="term-filter-description">' . $term_description . '</span>';
			}
			?>
			<li class="term-filter">
				<a href="<?php echo esc_url( $filter_url ); ?>" class="term-filter-link <?php echo esc_attr( $checked ? 'term-filter-link--active' : '' );  ?>" title="<?php echo esc_attr( strip_tags( $term_description ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $swatch_classes ) ); ?>">
						<?php echo uncode_switch_stock_string( $term_name ); ?>

						<?php if ( $show_count ) : ?>
							<span class="term-filter-count">(<?php echo number_format_i18n( $filter_term_value['count'] ); ?>)</span>
						<?php endif; ?>
					</div>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Output term filter in color mode
 */
function uncode_ajax_term_filter_color_html( $key_to_query, $filter_terms, $query_args, $args = array() ) {
	$multiple    = isset( $args['multiple'] ) ? $args['multiple'] : false;
	$show_count  = isset( $args['show_count'] ) ? $args['show_count'] : false;
	$display     = isset( $args['display'] ) ? $args['display'] : false;
	$labels      = isset( $args['labels'] ) ? $args['labels'] : false;
	$columns_num = isset( $args['columns_num'] ) ? $args['columns_num'] : false;
	$is_logo     = isset( $args['is_logo'] ) && $args['is_logo'] ? true : false;

	$filter_list_class = $display === 'inline' ? 'term-filters-list--inline' : ( $display === 'columns' ? 'term-filters-list--columns term-filters-list--columns-' . $columns_num : '' );

	if ( $is_logo ) {
		$filter_list_class .= ' term-filters-list--logo';
	}
	?>
	<ul class="term-filters-list <?php echo esc_attr( $filter_list_class ); ?>">
		<?php
		if ( ! $multiple ) {
			$has_checked = false;
		}
		?>

		<?php foreach ( $filter_terms as $filter_term_key => $filter_term_value ) : ?>
			<?php
			$term                = $filter_term_value['term'];
			$term_id             = $term->term_id;
			$term_name           = $term->name;
			$term_slug           = $term->slug;
			$term_description    = $term->description;
			$filter_id           = 'filter_' . rand() . '_' . $term_id;
			$current_filter_atts = uncode_get_filter_link_attributes( $term, $key_to_query, $query_args, $args, $filter_terms );
			$color               = get_term_meta( $term->term_id, 'uncode_pa_color', true );
			$color               = $color ? $color: '#EEEEEF';

			list( $filter_url, $filter_atts ) = $current_filter_atts;
			$checked = $filter_atts['checked'];

			$swatch_classes = array(
				'swatch',
				'swatch--single',
				'swatch-type-color',
			);

			if ( $color === '#FFFFFF' || $color === '#ffffff' || $color === '#FFF' || $color === '#fff' ) {
				$swatch_classes[] = 'swatch--white';
			}

			if ( ! $multiple ) {
				if ( $has_checked ) {
					$checked = false;
				}

				if ( $checked ) {
					$has_checked = true;
				}
			}

			if ( apply_filters( 'uncode_show_term_description', false, $term ) && $term_description ) {
				$term_name .= '<span class="term-filter-description">' . $term_description . '</span>';
			}
			?>
			<li class="term-filter">
				<a href="<?php echo esc_url( $filter_url ); ?>" class="term-filter-link <?php echo esc_attr( $checked ? 'term-filter-link--active' : '' );  ?>" title="<?php echo esc_attr( strip_tags( $term_description ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $swatch_classes ) ); ?>" style="background-color:<?php echo  esc_attr( $color ); ?>">
						<?php echo uncode_switch_stock_string( $term_name ); ?>
					</div>

					<?php if ( $labels ) : ?>
						<span class="term-filter-label"><?php echo esc_html( $term_name ); ?></span>
					<?php endif; ?>
				</a>

				<?php if ( $show_count ) : ?>
					<span class="term-filter-count">(<?php echo number_format_i18n( $filter_term_value['count'] ); ?>)</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Output term filter in image mode
 */
function uncode_ajax_term_filter_image_html( $key_to_query, $filter_terms, $query_args, $args = array() ) {
	$multiple    = isset( $args['multiple'] ) ? $args['multiple'] : false;
	$show_count  = isset( $args['show_count'] ) ? $args['show_count'] : false;
	$display     = isset( $args['display'] ) ? $args['display'] : false;
	$labels      = isset( $args['labels'] ) ? $args['labels'] : false;
	$columns_num = isset( $args['columns_num'] ) ? $args['columns_num'] : false;
	$is_logo     = isset( $args['is_logo'] ) && $args['is_logo'] ? true : false;

	$filter_list_class = $display === 'inline' ? 'term-filters-list--inline' : ( $display === 'columns' ? 'term-filters-list--columns term-filters-list--columns-' . $columns_num : '' );

	if ( $is_logo ) {
		$filter_list_class .= ' term-filters-list--logo';
	}
	?>
	<ul class="term-filters-list <?php echo esc_attr( $filter_list_class ); ?>">
		<?php
		if ( ! $multiple ) {
			$has_checked = false;
		}
		?>

		<?php foreach ( $filter_terms as $filter_term_value ) : ?>
			<?php
			$term                = $filter_term_value['term'];
			$filter_id           = 'filter_' . rand() . '_' . $term->term_id;
			$current_filter_atts = uncode_get_filter_link_attributes( $term, $key_to_query, $query_args, $args, $filter_terms );
			$thumbnail_id        = absint( get_term_meta( $term->term_id, 'uncode_pa_thumbnail_id', true ) );
			$thumbnail_id        = $thumbnail_id ? $thumbnail_id : false;
			$image_size  	     = uncode_wc_get_image_swatch_size( $key_to_query );
			$thumbnail_size      = $image_size === 'regular' ? 'uncode_woocommerce_nav_thumbnail_regular' : 'uncode_woocommerce_nav_thumbnail_crop';
			$image               = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, $thumbnail_size ) : wc_placeholder_img_src( $thumbnail_size );
			$term_name           = $term->name;
			$term_description    = $term->description;

			list( $filter_url, $filter_atts ) = $current_filter_atts;
			$checked = $filter_atts['checked'];

			$swatch_classes = array(
				'swatch',
				'swatch--single',
				'swatch-type-image',
			);

			if ( ! $multiple ) {
				if ( $has_checked ) {
					$checked = false;
				}

				if ( $checked ) {
					$has_checked = true;
				}
			}

			if ( $is_logo ) {
				$swatch_classes[] = 'swatch--logo';
			}

			$swatch_classes[] = 'swatch--image-' . $image_size;

			if ( apply_filters( 'uncode_show_term_description', false, $term ) && $term_description ) {
				$term_name .= '<span class="swatch__description">' . $term_description . '</span>';
			}

			?>
			<li class="term-filter">
				<a href="<?php echo esc_url( $filter_url ); ?>" class="term-filter-link <?php echo esc_attr( $checked ? 'term-filter-link--active' : '' );  ?>" title="<?php echo esc_attr( strip_tags( $term_description ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $swatch_classes ) ); ?>" style="background-image:url(<?php echo  esc_url( $image ); ?>)">
						<?php echo esc_html( $term_name ); ?>
					</div>

					<?php if ( $labels ) : ?>
						<span class="term-filter-label"><?php echo esc_html( $term_name ); ?></span>
					<?php endif; ?>
				</a>

				<?php if ( $show_count ) : ?>
					<span class="term-filter-count">(<?php echo number_format_i18n( $filter_term_value['count'] ); ?>)</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Output term filter in search mode
 */
function uncode_ajax_term_filter_search_html( $key_to_query, $filter_terms, $query_args, $args = array() ) {
	$is_product_search  = isset( $args['search_type'] ) && $args['search_type'] === 'product' ? true : false;
	$search_placeholder = $is_product_search ? esc_html__('Search products…','uncode') : esc_html__('Search…','uncode');
	$search_value       = '';

	if ( isset( $query_args[$key_to_query] ) && is_array( $query_args[$key_to_query] ) && isset( $query_args[$key_to_query][0] ) ) {
		$search_value = $query_args[$key_to_query][0];
	}
	?>
	<div class="term-filters-search search-container-inner">
		<input type="search" name="term-filters-search-input" class="term-filters-search-input form-fluid" value="<?php echo esc_attr( $search_value ); ?>" placeholder="<?php echo esc_html( $search_placeholder ); ?>">
		<i class="fa fa-search3"></i>
	</div>
	<?php
}

/**
 * Show a list of active filters
 */
function uncode_show_active_ajax_filters( $align = 'left', $clear = '', $class = '', $display_type = false ) {
	$filters             = uncode_index_query_options_add_filters();
	$active_filters      = isset( $filters['filters_query'] ) ? $filters['filters_query'] : array();
	$query_args          = uncode_get_query_args_from_query( $active_filters );
	$original_query_args = $query_args;
	$out                 = '';
	$el_class            = $class !== '' ? ' ' . $class : '';

	$el_class .= $display_type === 'inline' ? ' filter-list--inline' : '';

	if ( ( is_array( $active_filters ) && count( $active_filters ) > 0 ) || isset( $original_query_args['min_price'] ) || isset( $original_query_args['max_price'] ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
	$out .= '<div class="filter-list item-align-' . esc_attr( $align ) . esc_attr( $el_class ) . '">
		<ul>';
			if ( $clear ) {
				$clear_class = 'filter-list__clear ' . $clear . '-hidden';
				$out .= '<li class="' . esc_attr( $clear_class ) . '"><a href="' . esc_url( uncode_filters_get_clear_all_url() ) . '" class="filter-list__link">' . esc_html__( 'Clear all', 'uncode' ) . '</a></li>';
			}
			foreach ( $active_filters as $key => $data ) {
				$prefix_pa = 'pa_';

				if ( ! in_array( $key, uncode_get_special_filter_keys() ) ) {
					if ( substr( $key, 0, strlen( $prefix_pa ) ) == $prefix_pa ) {
						$key_with_prefix = UNCODE_FILTER_PREFIX_PA . substr( $key, strlen( $prefix_pa ) );
					} else {
						$key_with_prefix = UNCODE_FILTER_PREFIX_TAX . $key;
					}
				} else {
					$key_with_prefix = $key;
				}

				$terms = isset( $data['terms'] ) ? $data['terms'] : array();
				if ( is_array( $terms ) && count( $terms ) > 0 ) {
					foreach ( $terms as $term ) {
						$query_args = $original_query_args;

						if ( $key === UNCODE_FILTER_KEY_STATUS ) {
							$term_name = uncode_filters_get_label( $term );
							$key_value = $term;
						} else if ( $key === UNCODE_FILTER_KEY_RATING ) {
							$term_name = uncode_filters_get_label( $key, $term );
							$key_value = $term;
						} else if ( $key === UNCODE_FILTER_KEY_AUTHOR ) {
							$term_name = uncode_filters_get_author_label( $term );
							$key_value = $term;
						} else if ( $key === UNCODE_FILTER_KEY_DATE ) {
							$term_name = uncode_filters_get_date_label( $term );
							$key_value = $term;
						} else if ( $key === UNCODE_FILTER_KEY_SEARCH ) {
							$key_value = sanitize_text_field( $term );
							$term_name = str_replace( '%20', ' ', $key_value );
							$term_name = str_replace( '+', ' ', $key_value );
						} else {
							$term_name = isset( $term->name ) ? $term->name : '';
							$key_value = isset( $term->slug ) ? $term->slug : '';
						}

						if ( $term_name ) {
							if ( isset( $query_args[$key_with_prefix] ) ) {
								if ( in_array( $key_value, $query_args[$key_with_prefix] ) ) {

									$taxonomy_values = $query_args[$key_with_prefix];
									if ( ( $_key = array_search( $key_value, $taxonomy_values ) ) !== false ) {
										unset( $taxonomy_values[$_key] );
									}
									$query_args[$key_with_prefix] = $taxonomy_values;
									$link = uncode_build_filter_link( uncode_get_current_url(), $query_args );

									$out .= '<li class="filter-list__item"><a href="' . esc_url( $link ) . '" class="filter-list__link">' . esc_html( $term_name ) . '</a></li>';
								}
							}
						}
					}
				}
			}

			if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
				$out .= '<li class="filter-list__item"><a href="#" class="filter-list__link">' . esc_html__( 'Active filter 1', 'uncode' ) . '</a></li>';
				$out .= '<li class="filter-list__item"><a href="#" class="filter-list__link">' . esc_html__( 'Active filter 2', 'uncode' ) . '</a></li>';
			}

			if ( isset( $original_query_args['min_price'] ) && isset( $original_query_args['max_price'] ) ) {
				$query_args = $original_query_args;
				unset( $query_args['min_price'] );
				unset( $query_args['max_price'] );
				$link = uncode_build_filter_link( uncode_get_current_url(), $query_args );

				if ( $original_query_args['min_price'] === $original_query_args['max_price'] ) {
					$out .= '<li class="filter-list__item"><a href="' . esc_url( $link ) . '" class="filter-list__link">' . wc_price( $original_query_args['min_price'] ) . '</a></li>';
				} else {
					$out .= '<li class="filter-list__item"><a href="' . esc_url( $link ) . '" class="filter-list__link">' . wc_price( $original_query_args['min_price'] ) . ' - ' . wc_price( $original_query_args['max_price'] ) . '</a></li>';
				}
			} else if ( isset( $original_query_args['min_price'] ) ) {
				$query_args = $original_query_args;
				unset( $query_args['min_price'] );
				$link = uncode_build_filter_link( uncode_get_current_url(), $query_args );

				$out .= '<li class="filter-list__item"><a href="' . esc_url( $link ) . '" class="filter-list__link">' . sprintf( _x( 'Over %s', 'ajax_price_filter', 'uncode' ), wc_price( $original_query_args['min_price'] ) ) . '</a></li>';
			} else if ( isset( $original_query_args['max_price'] ) ) {
				$query_args = $original_query_args;
				unset( $query_args['max_price'] );
				$link = uncode_build_filter_link( uncode_get_current_url(), $query_args );

				$out .= '<li class="filter-list__item"><a href="' . esc_url( $link ) . '" class="filter-list__link">' . sprintf( _x( 'Under %s', 'ajax_price_filter', 'uncode' ), wc_price( $original_query_args['max_price'] ) ) . '</a></li>';
			}
		$out .= '</ul>
	</div>';
	}

	return $out;
}
