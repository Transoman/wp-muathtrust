<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mytheme
 */

get_header();

get_template_part( 'template-parts/breadcrumbs' );
?>

<div class="head">
	<div class="container">
		<h1 class="head__title">Events</h1>
	</div>
</div>

<section class="events-page">
	<?php
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => 3,
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => 'event_details_date'
	);

	$events = new WP_Query( $args );

	if ( $events->have_posts() ):
	?>
		<div class="events-list" id="response">
			<?php while ( $events->have_posts() ): $events->the_post() ; ?>
				<div class="events-list__item">
					<?php $details = get_field( 'event_details' ); ?>
					<div class="events-list__wrap">
						<div class="events-list__image">
							<?php the_post_thumbnail( '50x50' ); ?>
						</div>

						<div class="events-list__content">
							<time class="events-list__date" datetime="<?php echo date( 'Y-m-d', strtotime( $details['date'] ) ); ?>"><?php echo $details['date']; ?></time>
							<h2 class="events-list__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<div class="events-list__text"><?php the_excerpt(); ?></div>

							<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
						</div>
					</div>
					<div class="container">
						<hr>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php if (  $events->max_num_pages > 1 ) : ?>
			<div class="load-more-wrap">
				<script>
					var posts = '<?php echo json_encode($events->query_vars); ?>';
					var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
					var max_page = '<?php echo $events->max_num_pages; ?>';
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

</section>
<?php
get_footer();
