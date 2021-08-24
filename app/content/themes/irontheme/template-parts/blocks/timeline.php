<?php if ( have_rows( 'list' ) ): ?>
<section class="timeline">
	<?php while ( have_rows( 'list' ) ): the_row(); ?>
		<?php
		$image = get_sub_field( 'image' );
		$image_style = get_sub_field( 'image_style' );
		$text_1 = get_sub_field( 'text_1' );
		$text_2 = get_sub_field( 'text_2' );
		$year = get_sub_field( 'year' );
		$image_size = '';

		if ( $image_style == 'style_1' ) {
			$image_size = 'opening_time';
		} elseif ( $image_style == 'style_2' ) {
			$image_size = 'style_2';
		} elseif ( $image_style == 'style_3' ) {
			$image_size = 'news';
		}
		?>
		<div class="timeline__item timeline__item--<?php echo $image_style; ?>">
			<div class="container">
				<div class="timeline__wrap">
					<div class="timeline__image">
						<?php echo wp_get_attachment_image( $image, $image_size ); ?>
					</div>

					<div class="timeline__content">
						<?php if ( $text_1 ): ?>
							<div class="timeline__text-1"><?php echo $text_1; ?></div>
						<?php endif; ?>

						<?php if ( $year ): ?>
							<div class="timeline__year"><?php echo $year; ?></div>
						<?php endif; ?>

						<?php if ( $text_2 ): ?>
							<div class="timeline__text-2"><?php echo $text_2; ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</section>
<?php endif;
