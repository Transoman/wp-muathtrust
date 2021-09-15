<?php
$title = get_sub_field( 'title' );
$gallery = get_sub_field( 'gallery' );

if ( $gallery ):
?>
<section class="gallery-slider-section">
	<div class="container">
		<?php if ( $title ): ?>
			<h2 class="gallery-slider-section__title text-center"><?php echo $title; ?></h2>
		<?php endif; ?>

		<div class="gallery-slider-wrap">
			<div class="swiper-btns">
				<div class="swiper-button-prev"><?php ith_the_icon( 'arrow-left' ); ?></div>
				<div class="swiper-button-next"><?php ith_the_icon( 'arrow-right' ); ?></div>
			</div>

			<div class="gallery-slider swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ( $gallery as $image ): ?>
						<div class="gallery-slider__item swiper-slide">
							<?php echo wp_get_attachment_image( $image, 'gallery' ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif;
