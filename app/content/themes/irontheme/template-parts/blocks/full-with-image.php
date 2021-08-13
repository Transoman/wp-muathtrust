<?php if ( $image = get_sub_field( 'image' ) ): ?>
	<figure class="full-with-image">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	</figure>
<?php endif;
