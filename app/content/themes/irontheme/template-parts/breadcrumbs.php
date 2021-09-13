<?php
$breadcrumbs_visibility = get_field( 'breadcrumbs_visibility' );

if ( function_exists( 'bcn_display' ) ): ?>
	<?php if ( $breadcrumbs_visibility != 'hide' && ! is_front_page() ): ?>
		<div class="breadcrumbs">
			<div class="container">
				<?php bcn_display(); ?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>