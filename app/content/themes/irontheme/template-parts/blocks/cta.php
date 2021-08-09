<?php
$title = get_sub_field( 'title' );
$text = get_sub_field( 'text' );
$btn = get_sub_field( 'button' );
$bg_image = get_sub_field( 'background_image' );
?>

<section class="cta"<?php echo $bg_image ? ' style="background-image: url(' . $bg_image . ');"' : ''; ?>>
	<div class="container">
		<div class="cta__wrap">
			<?php if ( $title ): ?>
				<h2 class="cta__title"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php if ( $text ): ?>
				<div class="cta__text"><?php echo $text; ?></div>
			<?php endif; ?>

			<?php if ( $btn ): ?>
				<a href="<?php echo $btn['url']; ?>" class="btn btn--light"><?php echo $btn['title']; ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
