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

					<?php if ( $details['buttons'] ): ?>
						<div class="event__details-btns">
							<?php foreach ( $details['buttons'] as $button ): ?>
								<a href="<?php echo $button['button']['url']; ?>" class="btn-stroke btn-stroke--dark" <?php echo $button['button']['target'] ? 'target="_blank"' : ''; ?>><?php echo $button['button']['title']; ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="event__content">
					<div class="event__text"><?php the_content(); ?></div>

					<?php get_template_part( 'template-parts/share' ); ?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer();
