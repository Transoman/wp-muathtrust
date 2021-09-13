<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mytheme
 */

get_header();

get_template_part( 'template-parts/breadcrumbs' );
?>

	<article class="article">
		<div class="container">

			<?php
			while ( have_posts() ) :
				the_post();
			?>

			<div class="article__wrap">
				<div class="article__left">
					<time class="article__date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'd F Y' ); ?></time>

					<h1 class="article__title"><?php the_title(); ?></h1>

					<div class="article__text"><?php the_content(); ?></div>

				</div>

				<div class="article__right">
					<?php the_post_thumbnail( 'news' ); ?>

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

			<?php if ( $gallery = get_field( 'gallery' ) ): ?>
				<div class="news-gallery-wrap">
					<div class="swiper-btns">
						<div class="swiper-button-prev"><?php ith_the_icon( 'arrow-left' ); ?></div>
						<div class="swiper-button-next"><?php ith_the_icon( 'arrow-right' ); ?></div>
					</div>

					<div class="news-gallery-slider swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $image ): ?>
								<div class="news-gallery-slider__item swiper-slide">
									<?php echo wp_get_attachment_image( $image, 'gallery' ); ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php
			endwhile; // End of the loop.
			?>

			<?php $args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'post__not_in' => array( get_the_ID() )
			);

			$latest_news = new WP_Query( $args );

			if ( $latest_news->have_posts() ):
			?>
				<div class="latest-news">
					<h2 class="latest-news__title section-title">Latest News</h2>

					<div class="latest-news-list">
						<?php while ( $latest_news->have_posts() ): $latest_news->the_post(); ?>
							<div class="latest-news-list__item">
								<?php get_template_part( 'template-parts/news', 'card' ); ?>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</article>

<?php
get_footer();
