<?php
$title = get_sub_field( 'title' );

$args = array(
	'post_type' => 'post',
	'orderby' => 'date',
	'posts_per_page' => 6
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
							<?php get_template_part( 'template-parts/news', 'card' ); ?>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
