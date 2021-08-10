<?php
$title = get_sub_field( 'title' );
$image = get_sub_field( 'image' );
?>
<section class="subscribe">
	<div class="container">
		<div class="subscribe__wrap">
			<div class="subscribe__left">
				<?php if ( $title ): ?>
					<h3 class="subscribe__title"><?php echo $title; ?></h3>
				<?php endif; ?>

				<form class="subscribe-form">
					<div class="form-group">
						<input type="email" name="email" placeholder="Email" required>
						<button type="submit" class="btn-round btn-round--light"><?php ith_the_icon( 'arrow-right' ); ?></button>
					</div>
				</form>
			</div>

			<div class="subscribe__right">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
		</div>
	</div>
</section>
