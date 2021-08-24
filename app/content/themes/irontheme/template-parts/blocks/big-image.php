<?php if ( $big_image = get_sub_field( 'image' ) ): ?>
	<figure class="big-image">
		<?php echo wp_get_attachment_image( $big_image, 'full' ); ?>
	</figure>
<?php endif; ?>