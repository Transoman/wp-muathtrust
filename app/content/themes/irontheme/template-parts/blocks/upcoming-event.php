<?php
$args = array(
	'post_type' => 'event',
	'posts_per_page' => 1,
	'orderby' => 'meta_value_num',
	'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'event_details_date',
			'value' => date('Ymd'),
			'compare' => '>='
		)
	)
);

$event = new WP_Query( $args );

if ( $event->have_posts() ):
	while ( $event->have_posts() ): $event->the_post();
	$details = get_field( 'event_details' );
?>
	<section class="upcoming-event">
		<div class="container">
			<div class="upcoming-event__wrap">
				<div class="upcoming-event__top">
					<time class="upcoming-event__date" datetime="<?php echo date( 'Y-m-d', strtotime( $details['date'] ) ); ?>">Upcoming event: <?php echo $details['date']; ?></time>

					<h2 class="upcoming-event__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>

				<a href="<?php the_permalink(); ?>" class="upcoming-event__image">
					<?php the_post_thumbnail( 'upcoming_event' ); ?>
				</a>

				<div class="upcoming-event__text"><?php the_excerpt(); ?></div>

				<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
			</div>
		</div>
	</section>
	<?php
	endwhile;
	wp_reset_postdata();
endif;