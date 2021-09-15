<?php
$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$image = get_sub_field( 'image' );

if ( ! $title ) {
	$title = get_the_title();
}

?>

<section class="article">
	<div class="container">
		<div class="article__wrap">
			<div class="article__left">
				<h1 class="article__title"><?php echo $title; ?></h1>

				<div class="article__text"><?php echo $text; ?></div>
			</div>

			<?php if ( $image ): ?>
				<div class="article__right">
					<?php echo wp_get_attachment_image( $image, 'news' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
