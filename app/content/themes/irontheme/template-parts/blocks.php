<?php
if ( have_rows( 'layouts' ) ):
	$blocks = [
		'hero' => 'hero',
		'hero_v2' => 'hero-v2',
		'about_block' => 'about-block',
		'list_50x50' => 'list-50x50',
		'cta' => 'cta',
		'widget_50x50' => 'widget-50x50',
		'upcoming_event' => 'upcoming-event',
		'news_slider' => 'news-slider',
		'logos_block' => 'logos-block',
		'subscribe' => 'subscribe',
		'quick_donate' => 'quick-donate',
		'widget_upcoming_events' => 'widget-upcoming-events',
		'full_with_image' => 'full-with-image',
		'businesses_block' => 'businesses-block',
		'quote' => 'quote',
		'timeline' => 'timeline',
		'teams_block' => 'teams-block',
		'outdoor_area' => 'outdoor-area',
		'age_of_children' => 'age-of-children',
		'opening_time' => 'opening-time',
		'fees_and_payment' => 'fees-and-payment',
		'big_image' => 'big-image',
		'staff' => 'staff',
		'sign_up_child' => 'sign-up-child',
		'policies_and_forms' => 'policies-and-forms',
		'vacancies' => 'vacancies',
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
