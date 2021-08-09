<?php if ( have_rows( 'list' ) ): ?>
	<section class="list-50x50-section">
<!--		<div class="container">-->
			<div class="list-50x50">
				<?php while ( have_rows( 'list' ) ): the_row(); ?>
					<?php
					$title = get_sub_field( 'title' );
					$text = get_sub_field( 'text' );
					$link = get_sub_field( 'link' );
					$image = get_sub_field( 'image' );
					?>
					<div class="list-50x50__item">
						<div class="list-50x50__image">
							<?php if ( $image ) {
								echo wp_get_attachment_image( $image, '50x50' );
							} ?>
						</div>

						<div class="list-50x50__content">
							<h2 class="list-50x50__title"><a href="<?php echo $link['url']; ?>"><?php echo $title; ?></a></h2>

							<?php if ( $text ): ?>
								<div class="list-50x50__text"><?php echo $text; ?></div>
							<?php endif; ?>

							<a href="<?php echo $link['url']; ?>" class="btn-stroke btn-stroke--white"><?php echo $link['title']; ?></a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
<!--		</div>-->
	</section>
<?php endif; ?>
