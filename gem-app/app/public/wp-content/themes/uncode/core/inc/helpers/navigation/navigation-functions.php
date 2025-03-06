<?php
/**
 * Navigation related functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get post IDs for the navigation.
 */
function uncode_vc_module_navigation_ids( $post_id, $post_type, $navigation_index, $generic_index, $no_loop ) {
	$ids = array();

	// We'll print fake navigation
	if ( $post_type === 'uncodeblock' ) {
		return $ids;
	}

	if ( $navigation_index !== '' && ! $generic_index ) {
		global $adjacent_index;
		$adjacent_index = $navigation_index;
		add_filter( 'get_next_post_join', 'uncode_get_adjacent_post_join_filter' );
		add_filter( 'get_previous_post_join', 'uncode_get_adjacent_post_join_filter' );
		add_filter( 'get_next_post_where', 'uncode_get_adjacent_post_where_filter' );
		add_filter( 'get_previous_post_where', 'uncode_get_adjacent_post_where_filter' );
	}

	$previous          = get_adjacent_post( false, '', true );
	$previous_id_found = false;

	if ( isset( $previous->post_title ) ) {
		$ids[]             = $previous->ID;
		$previous_id_found = true;
	} else {
		if ( $no_loop === 'yes' ) {
			$ids[]             = 0;
			$previous_id_found = true;
		} else if ( $post_type ) {
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
				$ids[]             = $p->ID;
				$previous_id_found = true;
			}

			wp_reset_query();
		}
	}

	if ( ! $previous_id_found ) {
		$ids[] = $post_id;
	}

	$next          = get_adjacent_post( false, '', false );
	$next_id_found = false;

	if ( isset( $next->post_title ) ) {
		$ids[]         = $next->ID;
		$next_id_found = true;
	} else {
		if ( $no_loop === 'yes' ) {
			$ids[]         = 0;
			$next_id_found = true;
		} else if ( $post_type ) {
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
				$ids[]         = $p->ID;
				$next_id_found = true;
			}

			wp_reset_query();
		}
	}

	if ( ! $next_id_found ) {
		$ids[] = $post_id;
	}

	if ( $navigation_index !== '' && ! $generic_index ) {
		if ( function_exists( 'uncode_core_unhook' ) ) {
			uncode_core_unhook( 'get_next_post_join', 'uncode_get_adjacent_post_join_filter' );
			uncode_core_unhook( 'get_previous_post_join', 'uncode_get_adjacent_post_join_filter' );
			uncode_core_unhook( 'get_next_post_where', 'uncode_get_adjacent_post_where_filter' );
			uncode_core_unhook( 'get_previous_post_where', 'uncode_get_adjacent_post_where_filter' );
		}
	}

	return $ids;
}

function uncode_post_module_navigation_label( $html, $block_data, $no_margin = false ) {
	$nav_label_classes = array();
	$nav_label_size    = 'h6';
	if ( isset( $block_data['navigation_label_custom_typo'] ) && $block_data['navigation_label_custom_typo'] === 'yes' ) {
		if ( isset( $block_data['navigation_label_font'] ) && $block_data['navigation_label_font'] ) {
			$nav_label_classes[] = $block_data['navigation_label_font'];
		}
		if ( isset( $block_data['navigation_label_size'] ) && $block_data['navigation_label_size'] ) {
			$nav_label_size = $block_data['navigation_label_size'];
		}
		if ( isset( $block_data['navigation_label_weight'] ) && $block_data['navigation_label_weight'] ) {
			$nav_label_classes[] = 'font-weight-' . $block_data['navigation_label_weight'];
		}
		if ( isset( $block_data['navigation_label_transform'] ) && $block_data['navigation_label_transform'] ) {
			$nav_label_classes[] = 'text-' . $block_data['navigation_label_transform'];
		}
		if ( isset( $block_data['navigation_label_height'] ) && $block_data['navigation_label_height'] ) {
			$nav_label_classes[] = $block_data['navigation_label_height'];
		}
		if ( isset( $block_data['navigation_label_space'] ) && $block_data['navigation_label_space'] ) {
			$nav_label_classes[] = $block_data['navigation_label_space'];
		}
	}
	$nav_label_classes[] = $nav_label_size;

	if ( $no_margin ) {
		$nav_label_classes[] = 'no-top-margin';
	}

	$nav_label_text = '';
	$nav_label_icon = '';

	if ( $block_data['navigation_index'] === 'prev' && $block_data['navigation_prev_label'] ) {
		$nav_label_text = $block_data['navigation_prev_label'];

		if ( $block_data['navigation_icon_position'] === 'label' && $block_data['navigation_prev_icon'] ) {
			$nav_label_icon = $block_data['navigation_prev_icon'];
			if ( $nav_label_icon ) {
				$nav_label_icon .= ' t-entry-nav-icon t-entry-nav-icon--prev';
			}
		}
	} else if ( $block_data['navigation_index'] === 'next' && $block_data['navigation_next_label'] ) {
		$nav_label_text = $block_data['navigation_next_label'];

		if ( $block_data['navigation_icon_position'] === 'label' && $block_data['navigation_next_icon'] ) {
			$nav_label_icon = $block_data['navigation_next_icon'];
			if ( $nav_label_icon ) {
				$nav_label_icon .= ' t-entry-nav-icon t-entry-nav-icon--next';
			}
		}
	}

	if ( $nav_label_text ) {
		$html .= '<p class="t-entry-nav-label"><span class="' . esc_attr( trim( implode( ' ', $nav_label_classes ) ) ) . '">';
		if ( $nav_label_icon && $block_data['navigation_index'] === 'prev' ) {
			$html .= '<i class="' . $nav_label_icon . '"></i>';
		}
		$html .= $nav_label_text;
		if ( $nav_label_icon && $block_data['navigation_index'] === 'next' ) {
			$html .= '<i class="' . $nav_label_icon . '"></i>';
		}
		$html .= '</span></p>';
	}

	return $html;
}
