<?php
/**
 * Custom Post Types functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Flush rules when the theme is set up.
 */
function uncode_custom_flush_rules() {
	//defines the post type so the rules can be flushed.
	uncode_custom_post_type();
	//and flush the rules.
	flush_rewrite_rules();
}
register_activation_hook( UNCODE_CORE_FILE, 'uncode_custom_flush_rules' );

/**
 * Flush portfolio slug when saving theme options.
 */
function uncode_custom_portfolio_slug() {
	$portfolio_cpt = (function_exists('ot_get_option')) ? ot_get_option('_uncode_portfolio_cpt') : '';
	if ($portfolio_cpt === '') $portfolio_cp = 'portfolio';
	$rules = get_option( 'rewrite_rules' );
	if (is_array($rules)) {
  	$index_found = 0;
		foreach ($rules as $key => $value) {
			if (strpos($key, $portfolio_cpt . '/') !== false) $index_found++;
		}
		if ($index_found === 0) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
  }
}
add_action( 'ot_after_theme_options_save','uncode_custom_portfolio_slug' );

/**
 * Add page category filter.
 */
function uncode_page_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'page'; // change to your post type
	$taxonomy  = 'page_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode-core'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'uncode_page_filter_post_type_by_taxonomy');

function uncode_page_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'page'; // change to your post type
	$taxonomy  = 'page_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'uncode_page_convert_id_to_term_in_query');

/**
 * Add portfolio category filter.
 */
function uncode_portfolio_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'portfolio'; // change to your post type
	$taxonomy  = 'portfolio_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode-core'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'uncode_portfolio_filter_post_type_by_taxonomy');

function uncode_portfolio_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'portfolio'; // change to your post type
	$taxonomy  = 'portfolio_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'uncode_portfolio_convert_id_to_term_in_query');

/**
 * Add content block category filter.
 */
function uncode_cblock_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'uncodeblock'; // change to your post type
	$taxonomy  = 'uncodeblock_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(esc_html__("Show All %s", 'uncode-core'), $info_taxonomy->label),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
add_action('restrict_manage_posts', 'uncode_cblock_filter_post_type_by_taxonomy');

function uncode_cblock_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'uncodeblock'; // change to your post type
	$taxonomy  = 'uncodeblock_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
add_filter('parse_query', 'uncode_cblock_convert_id_to_term_in_query');
