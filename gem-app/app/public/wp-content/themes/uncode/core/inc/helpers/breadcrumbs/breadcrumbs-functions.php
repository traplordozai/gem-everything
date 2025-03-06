<?php
/**
 * Breadcrumbs related functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Build breadcrumb
 */
if (!function_exists('uncode_breadcrumbs')) {
	function uncode_breadcrumbs($navigation_index = '', $module = '') {

		if ( apply_filters( 'uncode_woocommerce_breadcrumbs', false ) && function_exists( 'is_woocommerce' ) && is_woocommerce() && function_exists( 'woocommerce_breadcrumb' ) ) {

			$args = apply_filters( 'woocommerce_breadcrumb_defaults', array(
				'delimiter'   => '',
				'wrap_before' => $module == '' ? '<ol class="breadcrumb header-subtitle">' : '<ol class="breadcrumb breadcrumb-' . esc_attr($module) . '">',
				'wrap_after'  => '</ol>',
				'before'      => '<li>',
				'after'       => '</li>',
				'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
			) );

			ob_start();
			woocommerce_breadcrumb($args);
			return ob_get_clean();

		}

		/* === OPTIONS === */
		$text['home'] = esc_html__('Home', 'uncode');

		// text for the 'Home' link
		$text['category'] = esc_html__('Archive by Category', 'uncode') . ' ' . '"%s"';

		// text for a category page
		$text['search'] = esc_html__('Search Results for', 'uncode') . ' ' . '"%s"';

		// text for a search results page
		$text['tag'] = esc_html__('Posts Tagged', 'uncode') . ' ' . '"%s"';

		// text for a tag page
		$text['author'] = esc_html__('Articles Posted by', 'uncode') . ' ' . '%s';

		// text for an author page
		$text['404'] = esc_html__('Error 404', 'uncode');

		// text for the 404 page

		$show_current = 1;

		// 1 - show current post/page/category title in breadcrumbs, 0 - don't show
		$show_on_home = 0;

		// 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_home_link = 1;

		// 1 - show the 'Home' link, 0 - don't show
		$show_title = 1;

		// 1 - show the title for the links, 0 - don't show
		$delimiter = '';

		// delimiter between crumbs
		$before = '<li class="current">';

		// tag before the current crumb
		$after = '</li>';

		// tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$home_link = esc_url( apply_filters( 'uncode_breadcrumbs_home_url', home_url( '/' ) ) );
		$link_before = '<li>';
		$link_after = '</li>';
		$link_attr = '';
		$link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;

		$parent_id = '';
		if (is_object($post) && isset($post->post_parent)) {
			$parent_id = $parent_id_2 = $post->post_parent;
		}

		$frontpage_id = get_option('page_on_front');
		$html = '';

		if (is_home() || is_front_page()) {

			if ($show_on_home == 1) {
				$html = '<ol><li><a href="' . $home_link . '">' . $text['home'] . '</a></li></ol>';
			}
		} else {

			$html = $module == '' ? '<ol class="breadcrumb header-subtitle">' : '<ol class="breadcrumb breadcrumb-' . esc_attr($module) . '">';
			if ($show_home_link == 1) {
				$html.= '<li><a href="' . $home_link . '">' . $text['home'] . '</a></li>';
				if ($frontpage_id == 0 || $parent_id != $frontpage_id) {
					$html.= $delimiter;
				}
			}

			if (is_category()) {
				$this_cat = get_category(get_query_var('cat') , false);
				if ($this_cat ->parent != 0) {
					$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
					if ($show_current == 0) {
						$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					}
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) {
						$cats = preg_replace('/ title="(.*?)"/', '', $cats);
					}
					$html.= $cats;
				}
				if ($show_current == 1) {
					$html.= $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				}
			} elseif (is_search()) {
				$html.= $before . sprintf($text['search'], get_search_query()) . $after;
			} elseif (is_day()) {
				$html.= sprintf($link, get_year_link(get_the_time('Y')) , get_the_time('Y')) . $delimiter;
				$html.= sprintf($link, get_month_link(get_the_time('Y') , get_the_time('m')) , get_the_time('F')) . $delimiter;
				$html.= $before . get_the_time('d') . $after;
			} elseif (is_month()) {
				$html.= sprintf($link, get_year_link(get_the_time('Y')) , get_the_time('Y')) . $delimiter;
				$html.= $before . get_the_time('F') . $after;
			} elseif (is_year()) {
				$html.= $before . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if (get_post_type() != 'post') {
					$parent_link = '';
					$parent_title = '';
					if ($navigation_index !== '') {
						$parent_link = get_permalink($navigation_index);
						$parent_title = get_the_title($navigation_index);
					} else {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;

						if ( apply_filters( 'uncode_breadcrumbs_use_custom_calculation_for_url', false ) ) {
							$parent_link = esc_url( $home_link . ltrim($slug['slug'],'/') . '/' );
						} else {
							$parent_link = get_post_type_archive_link(get_post_type());
						}

						$parent_title = $post_type->labels->name;
					}
					$html .= sprintf($link, $parent_link, $parent_title);

					if ( apply_filters( 'uncode_breadcrumbs_nested_enabled', false ) && $parent_id ) {
						$parent_ids = array_reverse( uncode_breadcrumbs_get_parents( $post ) );

						foreach ( $parent_ids as $_parent_id ) {
							$html .= uncode_breadcrumbs_parent_item( $_parent_id, $link );
						}
					}

					if ($show_current == 1) {
						$html .= $delimiter . $before . get_the_title() . $after;
					}
				} else {
					$cat = get_the_category();
					if (isset($cat[0])) {
						$cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);
						if ($show_current == 0) {
							$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						}
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) {
							$cats = preg_replace('/ title="(.*?)"/', '', $cats);
						}
						$html.= $cats;
						if ($show_current == 1) {
							$html.= $before . get_the_title() . $after;
						}
					}
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

				if (is_tax()) {
					$tax = get_taxonomy( get_queried_object()->taxonomy );
					if ($show_current == 1) {
						$html.= $before . sprintf(($tax->hierarchical ? $text['category'] : $text['tag']), single_cat_title('', false)) . $after;
					}
				} else {
					$post_type = get_post_type_object(get_post_type());

					if ( $post_type ) {
						$html.= $before . $post_type->labels->singular_name . $after;
					}
				}

			} elseif (is_attachment()) {
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID);
				$cat = isset($cat[0]) ? $cat[0] : false;
				if ($cat) {
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) {
						$cats = preg_replace('/ title="(.*?)"/', '', $cats);
					}
					$html.= $cats;
				}
				$html.= sprintf($link, get_permalink($parent) , $parent->post_title);
				if ($show_current == 1) {
					$html.= $delimiter . $before . get_the_title() . $after;
				}
			} elseif (is_page() && !$parent_id) {
				if ($show_current == 1) {
					$html.= $before . get_the_title() . $after;
				}
			} elseif (is_page() && $parent_id) {
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page
								->ID) , get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0;$i < count($breadcrumbs);$i++) {
						$html.= $breadcrumbs[$i];
						if ($i != count($breadcrumbs) - 1) {
							$html.= $delimiter;
						}
					}
				}
				if ($show_current == 1) {
					if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) {
						$html.= $delimiter;
					}
					$html.= $before . get_the_title() . $after;
				}
			} elseif (is_tag()) {
				$html.= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
			} elseif (is_author()) {
				global $author;
				$userdata = get_userdata($author);
				$html.= $before . sprintf($text['author'], $userdata->display_name) . $after;
			} elseif (is_404()) {
				$html.= $before . $text['404'] . $after;
			} elseif (has_post_format() && !is_singular()) {
				$html.= get_post_format_string(get_post_format());
			}

			if (get_query_var('paged')) {
				if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
					$html.= ' (';
				}
				$html.= '<li class="paged">' . esc_html__('Page', 'uncode' ) . ' ' . get_query_var('paged') . '</li>';
				if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
					$html.= ')';
				}
			}

			$html.= '</ol>';
		}

		return $html;
	}
}

/**
 * Get parent IDs of current breadcrumb item
 */
function uncode_breadcrumbs_get_parents( $post, $check_for_parent = true ) {
	$check_for_parent = true;
	$ids = array();

	while ( $check_for_parent ) {
		if ( is_object( $post ) && isset( $post->post_parent ) && $post->post_parent > 0 ) {
			$parent_id = $post->post_parent;
			$ids[]     = $post->post_parent;
			$post      = get_post( $parent_id );
		} else {
			$check_for_parent = false;
		}
	}

	return $ids;
}

/**
 * Print parent item
 */
function uncode_breadcrumbs_parent_item( $parent_id, $link ) {
	$parent_link  = get_permalink( $parent_id );
	$parent_title = get_the_title( $parent_id );

	$final_link = sprintf( $link, $parent_link, $parent_title );

	return $final_link;
}
