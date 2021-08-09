<?php
if ( have_rows( 'layouts' ) ):
	$blocks = [
		'hero' => 'hero',
		'about_block' => 'about-block',
		'list_50x50' => 'list-50x50',
		'cta' => 'cta',
	];

	while ( have_rows( 'layouts' ) ) : the_row();

		foreach ( $blocks as $layout => $file ) {
			if ( get_row_layout() == $layout ) {
				get_template_part( 'template-parts/blocks/' . $file );
			}
		}

		// End loop.
	endwhile;

// No value.
else:
// Do something...
endif;
