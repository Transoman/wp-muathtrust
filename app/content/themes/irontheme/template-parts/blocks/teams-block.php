<?php
$title = get_sub_field( 'title' );
$quote = get_sub_field( 'quote' );
?>
<section class="teams-block">
	<div class="container">
		<?php if ( $title ): ?>
			<h2 class="teams-block__title"><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php if ( $quote ): ?>
			<div class="teams-block__quote"><?php echo $quote; ?></div>
		<?php endif; ?>

		<?php if ( have_rows( 'teams' ) ): ?>
			<div class="teams">
				<?php $i = 0; while ( have_rows( 'teams' ) ): the_row(); ?>
					<?php
					$photo = get_sub_field( 'photo' );
					$first_name = get_sub_field( 'first_name' );
					$last_name = get_sub_field( 'last_name' );
					$position = get_sub_field( 'position' );
					$bio = get_sub_field( 'bio' );
					$email = get_sub_field( 'email' );
					?>
					<div class="teams__item">
						<?php echo wp_get_attachment_image( $photo, 'team', '', array('class' => 'teams__photo') ); ?>

						<div class="teams__info">
							<div class="teams__name"><?php echo $first_name; ?></div>
							<div class="teams__position"><?php echo $position; ?></div>
						</div>

						<a href="#" class="teams__link team-<?php echo $i; ?>_open">
							<span class="teams__link-text">Read Bio</span>
						</a>
					</div>

					<div class="modal modal-team" id="team-<?php echo $i; ?>">
						<div class="container">
							<div class="modal-team__top">
								<div class="modal-team__name"><?php echo "$first_name $last_name"; ?></div>
								<button type="button" class="modal__close team-<?php echo $i++; ?>_close"></button>
							</div>

							<div class="modal-team__wrap">
								<div class="modal-team__photo">
									<?php echo wp_get_attachment_image( $photo, 'team'); ?>
								</div>

								<div class="modal-team__content">
									<div class="modal-team__info"><?php echo $bio; ?></div>

									<a href="mailto:<?php echo $email; ?>" class="btn-stroke btn-stroke--white">Contact</a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
