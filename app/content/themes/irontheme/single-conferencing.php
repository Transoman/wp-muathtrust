<?php get_header();

get_template_part( 'template-parts/breadcrumbs' );

$details = get_field( 'accommodation_details' );
?>

<section class="event-hero">
	<div class="event-hero__image">
		<?php the_post_thumbnail( 'page_hero' ); ?>
	</div>

	<div class="event-hero__content">
		<div class="container">
			<p class="event-hero__type">Conferencing</p>
			<h1 class="event-hero__title"><?php the_title(); ?></h1>
		</div>
	</div>
</section>

	<section class="event">
		<div class="container">
			<div class="event__wrap">
				<div class="event__details">
					<?php if ( $details['price'] ): ?>
						<div class="event__details-item">
							<div class="event__details-label">Price:</div>
							<div class="event__details-value">£<?php echo $details['price']; ?></div>
						</div>
					<?php endif; ?>

<!--					<div class="event__details-btns">-->
<!--						<a href="#" class="btn-stroke btn-stroke--dark">Book now</a>-->
<!--					</div>-->
				</div>

				<div class="event__content">
					<div class="event__text"><?php the_content(); ?></div>

					<?php get_template_part( 'template-parts/share' ); ?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer();
