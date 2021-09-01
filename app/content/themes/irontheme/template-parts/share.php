<div class="share">
	<div class="share__label">Share</div>
	<div class="share__items">
		<a href="mailto:info@example.com?&subject=&cc=&bcc=&body=<?php the_permalink(); ?>%0A" class="share__item" target="_blank"><?php ith_the_icon( 'mail' ); ?></a>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="share__item" target="_blank"><?php ith_the_icon( 'facebook' ); ?></a>
		<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="share__item" target="_blank"><?php ith_the_icon( 'twitter' ); ?></a>
	</div>
</div>