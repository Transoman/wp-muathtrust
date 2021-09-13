<?php
$text = get_sub_field( 'text' );
?>
<section class="vacancies">
	<div class="container">
		<div class="vacancies__text"><?php echo $text; ?></div>

		<?php if ( have_rows( 'list' ) ): ?>
			<div class="vacancies-list">
				<?php while ( have_rows( 'list' ) ): the_row(); ?>
					<div class="vacancies-list__item">
						<div class="vacancies-list__left">
							<h2 class="vacancies-list__name"><?php the_sub_field( 'name' ); ?></h2>
							<div class="vacancies-list__location"><?php the_sub_field( 'location' ); ?></div>
						</div>

						<div class="vacancies-list__right">
							<div class="vacancies-list__desc">
								<?php the_sub_field( 'description' ); ?>
							</div>

							<a href="mailto:<?php echo get_option( 'admin_email' ); ?>" class="btn-stroke">Register Interest</a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
