<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$form = get_sub_field('form');
?>
<section class="form-block">
	<div class="container">
		<div class="form-block__wrap">
			<?php if ( $title ): ?>
				<h2 class="form-block__title text-center"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php if ( $text ): ?>
				<div class="form-block__text text-center"><?php echo $text; ?></div>
			<?php endif; ?>

			<?php if ( $form ) {
				echo do_shortcode( '[contact-form-7 id="' . $form . '"]' );
			} ?>

		</div>
	</div>
</section>