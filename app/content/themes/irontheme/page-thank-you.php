<?php get_header();
$title = get_field( 'ty_title' );
$text = get_field( 'ty_text' );
$text_2 = get_field( 'ty_text_2' );
$bg_image = get_field( 'ty_background_image' );
?>

<section class="thank-you" style="background-image: url(<?php echo $bg_image; ?>)">
	<div class="container">
		<div class="thank-you__wrap">
			<div class="thank-you__right">
				<div class="thank-you__block">
					<h4 class="thank-you__title blue-color"><?php echo $title; ?></h4>

					<?php if ( $text ): ?>
						<div class="thank-you__text"><?php echo $text; ?></div>
					<?php endif; ?>

					<?php if ( $text_2 ): ?>
						<div class="thank-you__text-2"><?php echo $text_2; ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
