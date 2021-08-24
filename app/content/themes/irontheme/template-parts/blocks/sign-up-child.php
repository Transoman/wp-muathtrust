<?php
$sign_up_child_title = get_sub_field('title');
$sign_up_child_form = get_sub_field('form');
$sign_up_child_id = get_sub_field('id');
?>
<section class="sign-up-child" id="<?php echo $sign_up_child_id; ?>">
	<div class="container">
		<div class="sign-up-child__wrap">
			<h2 class="sign-up-child__title"><?php echo $sign_up_child_title; ?></h2>

			<?php if ( $sign_up_child_form ) {
				echo do_shortcode( '[contact-form-7 id="' . $sign_up_child_form . '"]' );
			} ?>

		</div>
	</div>
</section>