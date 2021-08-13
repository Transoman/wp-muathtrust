<?php
$title = get_sub_field( 'title' );
?>

<div class="businesses-block">
	<div class="container">
		<?php if ( $title ): ?>
			<h2 class="businesses-block__title"><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php if ( have_rows( 'list' ) ): ?>
			<div class="businesses-block-list">
				<?php while ( have_rows( 'list' ) ): the_row(); ?>
					<?php
						$name = get_sub_field( 'name' );
						$location = get_sub_field( 'location' );
						$text = get_sub_field( 'text' );
						$logo = get_sub_field( 'logo' );
						$url = get_sub_field( 'website_url' );
					?>
					<div class="businesses-block-list__item">
						<div class="businesses-block-list__left">
							<h2 class="businesses-block-list__name"><?php echo $name; ?></h2>
							<p class="businesses-block-list__location"><?php echo $location; ?></p>
						</div>

						<div class="businesses-block-list__right">
							<div class="businesses-block-list__text"><?php echo $text; ?></div>

							<div class="businesses-block-list__right-bottom">
								<?php echo wp_get_attachment_image( $logo, 'full', '', array( 'class' => 'businesses-block-list__logo' ) ); ?>

								<?php if ( $url ): ?>
									<a href="<?php echo $url; ?>" class="businesses-block-list__url" target="_blank"><?php echo preg_replace( '!(http://|https://)!', '', $url ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
