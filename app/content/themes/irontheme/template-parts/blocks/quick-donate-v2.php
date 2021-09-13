<?php
$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$show_cover = get_sub_field( 'show_cover' );
?>
<section class="quick-donate-v2<?php echo $show_cover ? ' quick-donate-v2--cover' : ''; ?>">
	<div class="container">
		<div class="quick-donate-v2__wrap">
			<h2 class="quick-donate-v2__title"><?php echo $title; ?></h2>
			<?php if ( $text ): ?>
				<div class="quick-donate-v2__text"><?php echo $text; ?></div>
			<?php endif; ?>

			<?php
			$args = array(
				'post_type' => 'appeals',
				'posts_per_page' => 3
			);

			$appeals = new WP_Query( $args );

			if ( $appeals->have_posts() ):
			?>
				<form action="" class="quick-donate-v2-form">
					<div class="quick-donate-v2-form__items">
						<?php while ( $appeals->have_posts() ): $appeals->the_post();
						$appeals_details = get_field( 'appeals_details' );
						?>
						<label class="quick-donate-v2-form__item">
							<input type="radio" name="appeal" value="<?php echo get_the_ID(); ?>" data-name="<?php the_title(); ?>" data-price="<?php echo $appeals_details['price']; ?>" required>
							<span class="quick-donate-v2-form__item-inner">
								<span class="quick-donate-v2-form__item-price">£<?php echo $appeals_details['price']; ?></span>
								<span class="quick-donate-v2-form__item-name"><?php the_title(); ?></span>
							</span>
						</label>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>

					<div class="quick-donate-v2-form__bottom">
						<button type="submit" class="btn">Donate now</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
	</div>
</section>