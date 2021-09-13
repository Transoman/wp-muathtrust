<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package mytheme
 */

get_header();
?>

<section class="error-404 not-found">
	<div class="container text-center">
		<h1 class="section-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', TEXTDOMAIN ); ?></h1>

		<p><?php esc_html_e( 'It looks like nothing was found at this location.', TEXTDOMAIN ); ?></p>
	</div>
</section><!-- .error-404 -->

<?php
get_footer();
