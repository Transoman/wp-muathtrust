<div class="news-card">
	<div class="news-card__image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'news' ); ?>
		</a>
	</div>

	<time class="news-card__date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'd F Y' ); ?></time>

	<h4 class="news-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

	<div class="news-card__excerpt"><?php the_excerpt(); ?></div>

	<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
</div>