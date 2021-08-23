<?php
get_header();

global $wp_query;
?>

	<div class="head">
		<div class="container">
			<h1 class="head__title">Latest News</h1>
		</div>
	</div>

	<section class="news">
		<div class="container">

			<?php if ( have_posts() ): ?>
				<div class="news-list" id="response">
					<?php while ( have_posts() ): the_post(); ?>
						<div class="news-list__item">
							<?php get_template_part( 'template-parts/news', 'card' ); ?>
						</div>
					<?php endwhile; ?>
				</div>

				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div class="load-more-wrap">
						<script>
							var posts = '<?php echo json_encode($wp_query->query_vars); ?>';
							var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
							var max_page = '<?php echo $wp_query->max_num_pages; ?>';
							var nonce = '<?php echo wp_create_nonce('load_more_nonce'); ?>';
						</script>
						<div class="container">
							<div class="text-center">
								<a href="#" class="btn load-more">View more</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<div class="container">
					<h2 class="text-center">Nothing found</h2>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php

get_footer();
