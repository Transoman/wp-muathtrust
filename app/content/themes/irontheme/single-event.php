<?php get_header();

get_template_part( 'template-parts/breadcrumbs' );

$details = get_field( 'event_details' );
?>

<section class="event-hero">
	<div class="event-hero__image">
		<?php the_post_thumbnail( 'page_hero' ); ?>
	</div>

	<div class="event-hero__content">
		<div class="container">
			<p class="event-hero__type">Event</p>
			<h1 class="event-hero__title"><?php the_title(); ?></h1>
		</div>
	</div>
</section>

	<section class="event">
		<div class="container">
			<div class="event__wrap">
				<div class="event__details">
					<div class="event__details-item">
						<div class="event__details-label">Date:</div>
						<div class="event__details-value"><?php echo $details['date']; ?></div>
					</div>
					<div class="event__details-item">
						<div class="event__details-label">Time:</div>
						<div class="event__details-value"><?php echo $details['time']; ?></div>
					</div>

					<div class="event__details-btns">
						<a href="#" class="btn-stroke btn-stroke--dark">Register</a>
						<a href="#" class="btn-stroke btn-stroke--dark">Pay for entry</a>
					</div>
				</div>

				<div class="event__content">
					<div class="event__text"><?php the_content(); ?></div>

					<div class="share">
						<div class="share__label">Share</div>
						<div class="share__items">
							<a href="mailto:info@example.com?&subject=&cc=&bcc=&body=<?php the_permalink(); ?>%0A" class="share__item" target="_blank"><?php ith_the_icon( 'mail' ); ?></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="share__item" target="_blank"><?php ith_the_icon( 'facebook' ); ?></a>
							<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="share__item" target="_blank"><?php ith_the_icon( 'twitter' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer();
