<?php
$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
//$image = get_sub_field( 'image' );
?>

<section class="about-block">
	<div class="container">
		<div class="about-block__wrap">
			<div class="about-block__left">
				<?php if ( $title ): ?>
					<h1 class="about-block__title"><?php echo $title; ?></h1>
				<?php endif; ?>

				<?php if ( $text ): ?>
					<div class="about-block__text"><?php echo $text; ?></div>
				<?php endif; ?>

				<?php if ( have_rows( 'links' ) ): ?>
					<div class="about-block__links">
						<?php while ( have_rows( 'links' ) ): the_row(); ?>
						<?php $link = get_sub_field( 'link' ); ?>
							<a href="<?php echo $link['url']; ?>" class="about-block__links-item" data-hover-id="img-<?php the_sub_field( 'image' ); ?>">
								<span class="about-block__links-title"><?php echo $link['title']; ?></span>
								<?php ith_the_icon( 'arrow-right' ); ?>
							</a>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="about-block__right">
				<?php while ( have_rows( 'links' ) ): the_row(); ?>
					<?php $image = get_sub_field( 'image' ); ?>
					<?php echo wp_get_attachment_image( $image, 'text_block', '', array('class' => 'img-' . $image) ); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</section>
