<?php
$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$link = get_sub_field( 'link' );
$image = get_sub_field( 'image' );
?>
<section class="widget-50x50">
	<div class="container">
		<div class="widget-50x50__wrap">
			<div class="widget-50x50__image">
				<?php if ( $image ): ?>
					<div class="widget-50x50__image-wrap">
						<?php echo wp_get_attachment_image( $image, 'text_block' ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="widget-50x50__content">
				<h2 class="widget-50x50__title"><?php echo $title; ?></h2>

				<?php if ( $text ): ?>
					<div class="widget-50x50__text"><?php echo $text; ?></div>
				<?php endif; ?>

				<?php if ( $link ): ?>
					<a href="<?php echo $link['url']; ?>" class="btn-stroke"><?php echo $link['title']; ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
