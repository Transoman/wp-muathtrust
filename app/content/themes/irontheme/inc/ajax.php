<?php
function load_more_posts() {

	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'load_more_nonce' ) ) {
		exit;
	}

	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
	$post_type = $args['post_type'];

	query_posts( $args );

	if ( have_posts() ):

		while ( have_posts() ) : the_post();

			if ( $post_type === 'event' ) {
			?>
				<div class="events-list__item">
					<?php $details = get_field( 'event_details' ); ?>
					<div class="events-list__wrap">
						<div class="events-list__image">
							<?php the_post_thumbnail( '50x50' ); ?>
						</div>

						<div class="events-list__content">
							<time class="events-list__date" datetime="<?php echo date( 'Y-m-d', strtotime( $details['date'] ) ); ?>"><?php echo $details['date']; ?></time>
							<h2 class="events-list__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

							<div class="events-list__text"><?php the_excerpt(); ?></div>

							<a href="<?php the_permalink(); ?>" class="btn-stroke">Read more</a>
						</div>
					</div>
					<div class="container">
						<hr>
					</div>
				</div>
			<?php
			}

		endwhile;

	endif;

	die;
}

add_action('wp_ajax_load_more', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more', 'load_more_posts');