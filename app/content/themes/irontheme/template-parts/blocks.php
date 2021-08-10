<?php
if ( have_rows( 'layouts' ) ):
	$blocks = [
		'hero' => 'hero',
		'about_block' => 'about-block',
		'list_50x50' => 'list-50x50',
		'cta' => 'cta',
		'widget_50x50' => 'widget-50x50',
		'upcoming_event' => 'upcoming-event',
		'news_slider' => 'news-slider',
		'logos_block' => 'logos-block',
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
