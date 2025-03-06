<?php
/**
 * Template part for displaying a message that posts cannot be found whern using the Posts Module.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncode
 */

?>

<?php if ( uncode_is_filtering() ) : ?>
	<div class="tmb tmb-iso-w12 tmb-iso-h1"><p class="t-entry-title"><?php esc_html_e( "Nothing came up. Try adjusting your filters.", "uncode" ) ?></p></div>
<?php else : ?>
	<div class="tmb tmb-iso-w12 tmb-iso-h1"><p class="t-entry-title"><?php esc_html_e( "Nothing found.", "uncode" ) ?></p></div>
<?php endif; ?>
