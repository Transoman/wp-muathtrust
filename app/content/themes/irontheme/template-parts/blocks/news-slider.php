<?php
$title = get_sub_field( 'title' );

$args = array(
	'post_type' => 'post',
	'orderby' => 'date',
);

$news = new WP_Query( $args );

if ( $news->have_posts() ):
?>
	<section class="news-slider-section">
		<div class="container">
			<div class="news-slider-section__top">
				<h2 class="news-slider-section__title"><?php echo $title; ?></h2>
				<div class="swiper-btns">
					<div class="swiper-button-prev"><?php ith_the_icon( 'arrow-left' ); ?></div>
					<div class="swiper-button-next"><?php ith_the_icon( 'arrow-right' ); ?></div>
				</div>
			</div>

			<div class="news-slider swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $news->have_posts() ): $news->the_post(); ?>
						<div class="news-slider__item swiper-slide">
							<div class="news-card">
								<div class="news-card__image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'news' ); ?>
									</a>
								</div>

								<time class="news-card__date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>

								<h4 class="news-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

								<div class="news-card__excerpt"><?php the_excerpt(); ?></div>

								<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
