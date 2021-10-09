<?php
$bottom_text = get_sub_field( 'bottom_text' );
$btn = get_sub_field( 'button' );
?>
<section class="accommodation-block">
	<div class="container">
		<div class="accommodation-block__wrap">
			<?php
			$args = array(
				'post_type' => 'conferencing',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'order' => 'ASC',
			);

			$conferencing = new WP_Query( $args );

			if ( $conferencing->have_posts() ):
			?>
				<div class="accommodation-grid">
					<?php $i = 1; while ( $conferencing->have_posts() ): $conferencing->the_post(); ?>
					<?php
						$item_class = '';
						$image_size = 'acm';

						if ( $i++ % 3 == 0 ) {
							$item_class = ' accommodation-grid__item--full';
							$image_size = 'acm-wide';
						}
					?>
					<a href="<?php the_permalink(); ?>" class="accommodation-grid__item<?php echo $item_class; ?>">
						<div class="accommodation-grid__image"><?php the_post_thumbnail( $image_size ); ?></div>
						<div class="accommodation-grid__body">
							<div class="accommodation-grid__name"><?php the_title(); ?></div>
							<?php if ( $excerpt = get_the_excerpt() ): ?>
								<p class="accommodation-grid__desc"><?php echo $excerpt; ?></p>
							<?php endif; ?>
						</div>
					</a>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>

			<?php if ( $bottom_text ): ?>
				<div class="accommodation-block__text"><?php echo $bottom_text; ?></div>
			<?php endif; ?>

			<?php if ( $btn ): ?>
				<div class="accommodation-block__btn text-center">
					<a href="<?php echo $btn['url']; ?>" class="btn"><?php echo $btn['title']; ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
