<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>

<section class="contact">
	<div class="container">
		<div class="contact__top">
			<div class="contact__info">
				<div class="contact__info-text">
					<?php the_field( 'content' ); ?>
				</div>

				<?php if ( $phone = get_field( 'phone' ) ): ?>
					<div class="contact__info-item">Tel: <?php echo $phone; ?></div>
				<?php endif; ?>

				<?php if ( $fax = get_field( 'fax' ) ): ?>
					<div class="contact__info-item">Fax: <?php echo $fax; ?></div>
				<?php endif; ?>

				<?php if ( $email = get_field( 'email' ) ): ?>
					<div class="contact__info-item">Email: <?php echo $email; ?></div>
				<?php endif; ?>

				<?php if ( $address = get_field( 'address' ) ): ?>
					<div class="contact__info-item contact__info-item--address"><?php echo $address; ?></div>
				<?php endif; ?>
			</div>

			<div class="contact__image">
				<?php echo wp_get_attachment_image( get_field( 'image' ), '50x50' ); ?>
			</div>
		</div>

		<?php if ( $map = get_field( 'map' ) ): ?>
			<div class="contact__map"><?php echo $map; ?></div>
		<?php endif; ?>

		<div class="contact__form">
			<?php
			$contact_form = get_field( 'contact_form' );
			$contact_form_title = $contact_form['title'];
			$contact_form_text = $contact_form['text'];
			$contact_form_form = $contact_form['form'];
			?>

			<div class="contact__form-left">
				<h2 class="contact__form-title blue-color"><?php echo $contact_form_title; ?></h2>

				<div class="contact__form-text"><?php echo $contact_form_text; ?></div>
			</div>

			<div class="contact__form-right">
				<?php if ( $contact_form_form ) {
					echo do_shortcode( '[contact-form-7 id="' . $contact_form_form . '"]' );
				} ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
