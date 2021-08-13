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
	<section class="widget-upcoming-events">
		<div class="container">
			<h2 class="widget-upcoming-events__section-title blue-color">Upcoming Events</h2>

			<div class="widget-upcoming-events__list">
				<?php while ( $events->have_posts() ): $events->the_post() ; ?>
					<div class="widget-upcoming-events__item">
						<?php $details = get_field( 'event_details' ); ?>

						<time class="widget-upcoming-events__date" datetime="<?php echo date( 'Y-m-d', strtotime( $details['date'] ) ); ?>"><?php echo $details['date']; ?></time>

						<div class="widget-upcoming-events__image">
							<?php the_post_thumbnail( 'widget_upcoming_events' ); ?>
						</div>

						<div class="widget-upcoming-events__content">
							<h4 class="widget-upcoming-events__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

							<div class="widget-upcoming-events__text"><?php the_excerpt(); ?></div>
						</div>

						<div class="widget-upcoming-events__btn">
							<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
<?php endif; ?>