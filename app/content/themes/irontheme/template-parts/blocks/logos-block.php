<?php
$title = get_sub_field( 'title' );

if ( have_rows( 'logos_list' ) ):
?>
	<section class="logos-block">
		<div class="container">
			<?php if ( $title ): ?>
				<h2 class="logos-block__title"><?php echo $title; ?></h2>
			<?php endif; ?>

			<div class="logos-list">
				<?php while ( have_rows( 'logos_list' ) ): the_row(); ?>
					<div class="logos-list__item">
						<?php $url = get_sub_field( 'url' );
						if ( $url ): ?>
							<a href="<?php echo $url; ?>">
						<?php endif; ?>
						<?php echo wp_get_attachment_image( get_sub_field( 'logo' ), 'full' ); ?>
						<?php if ( $url ): ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
