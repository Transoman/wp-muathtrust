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

				<form action="https://muathtrust.us5.list-manage.com/subscribe/post?u=e5461e3cc923b6a7bdfb41f9e&amp;id=046a618b01" method="post" class="subscribe-form">
					<div class="form-group">
						<input type="email" name="EMAIL" placeholder="Email" required>
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e5461e3cc923b6a7bdfb41f9e_046a618b01" tabindex="-1" value=""></div>
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
