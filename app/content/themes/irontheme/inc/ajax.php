<?php
function load_more_posts() {

	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'load_more_nonce' ) ) {
		exit;
	}

	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
	$post_type = $args['post_type'] ? $args['post_type'] : 'post';

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
			} elseif ( $post_type == 'post' ) {
			?>
				<div class="news-list__item">
					<?php get_template_part( 'template-parts/news', 'card' ); ?>
				</div>
			<?php
			}

		endwhile;

	endif;

	die;
}

add_action('wp_ajax_load_more', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more', 'load_more_posts');

function get_service_days() {
	$select_day = isset( $_POST['selectDay'] ) ? sanitize_text_field( $_POST['selectDay'] ) : null;

	if ( ! validateDate( $select_day ) ) {
		wp_send_json_error( 'The date not selected or the date is incorrect!' );
	}

	$name_day = strtolower( date( 'l', strtotime( $select_day ) ) );
	$days = get_field( 'days', 'option' );
	$block_booking = get_field( 'block_booking', 'option' )['hours'];
	$result = [];
	$disable_times = [];

	$args = [
		'post_type' => 'booking_service',
		'posts_per_page' => -1,
		'meta_query' => [
			'relation' => 'OR',
			[
				'key' => 'one_date',
				'value' => $select_day
			],
			[
				'key' => 'block_date',
				'value' => $select_day,
				'compare' => 'LIKE'
			]
		]
	];

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$one_time = get_post_meta( get_the_ID() , 'one_time', true );
			$block_date = get_post_meta( get_the_ID() , 'block_date', true );

			if ( $one_time ) {
				$disable_times[] = $one_time;
			}

			if ( $block_date ) {
				foreach ( explode( ', ', $block_date ) as $item ) {
					if ( date( 'Y-m-d', strtotime( $item )) == $select_day ) {
						$disable_times[] = date( 'H:i', strtotime( $item ) );
					}
				}
			}
		}
	}
	wp_reset_postdata();

	if ( $name_day ) {
		if ( is_countable( $days[$name_day] ) ) {
			$result[] = [
				'value' => '',
				'label' => 'Select time',
				'disabled' => true,
				'selected' => true,
				'placeholder' => true
			];

			foreach ( $days[$name_day] as $day ) {
				$disabled = false;
				$selected = false;

				if ( in_array( $day['hour'] . ':00', $disable_times ) ) {
					$disabled = true;
				}

				if ( isset( $_SESSION['hire_service_fields']['one_date'] ) && $_SESSION['hire_service_fields']['one_date'] == $select_day ) {
					if ( $day['hour'] . ':00' == $_SESSION['hire_service_fields']['one_time'] ) {
						$selected = true;
					}
				}

				$result[] = [
					'value' => $day['hour'] . ':00',
					'label' => $day['hour'] . ':00',
					'disabled' => $disabled,
					'selected' => $selected,
					'customProperties' => '{"price": "' .$day['price'] . '"}',
				];
			}

			wp_send_json_success( $result );
		}
	}

	wp_send_json_success( [] );

	wp_die();
}

add_action('wp_ajax_get_service_days', 'get_service_days');
add_action('wp_ajax_nopriv_get_service_days', 'get_service_days');

function booking_service() {
	if ( is_countable( $_POST ) ) {
		parse_str( $_POST['data'], $data );
		$name       = isset( $data['hs_name'] ) ? sanitize_text_field( $data['hs_name'] ) : '';
		$email      = isset( $data['hs_email'] ) ? sanitize_text_field( $data['hs_email'] ) : '';
		$phone      = isset( $data['hs_phone'] ) ? sanitize_text_field( $data['hs_phone'] ) : '';
		$address    = isset( $data['hs_address'] ) ? sanitize_text_field( $data['hs_address'] ) : '';
		$company    = isset( $data['hs_company'] ) ? sanitize_text_field( $data['hs_company'] ) : '';
		$type       = isset( $data['hs_type'] ) ? sanitize_text_field( $data['hs_type'] ) : '';
		$one_date   = isset( $data['one_date'] ) ? sanitize_text_field( $data['one_date'] ) : '';
		$one_time   = isset( $data['one_time'] ) ? sanitize_text_field( $data['one_time'] ) : '';
		$block_date = isset( $data['block_date'] ) ? $data['block_date'] : '';
		$block_time = isset( $data['block_time'] ) ? $data['block_time'] : '';
		$total      = isset( $_POST['total'] ) ? sanitize_text_field( $_POST['total'] ) : 0;

		$customer = null;
		$customer_id = null;

//		var_dump($one_date, $one_time);

		$post_data = array(
			'post_type'   => 'booking_service',
			'post_status' => 'publish',
			'post_author' => 1,
			'meta_input'  => [
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
			],
		);

		if ( $address ) {
			$post_data['meta_input']['address'] = $address;
		}

		if ( $company ) {
			$post_data['meta_input']['company'] = $company;
		}

		if ( $one_date ) {
			$post_data['meta_input']['one_date'] = $one_date;
		}

		if ( $one_time ) {
			$post_data['meta_input']['one_time'] = $one_time;
		}

		if ( $block_date ) {
			$combined_date = [];
			$i = 0;
			foreach ( $block_date as $item ) {
				$combined_date[] = $item . ' ' . $block_time[$i++];
			}

			$post_data['meta_input']['block_date'] = implode( ', ', $combined_date );
		}

//		if ( $block_time ) {
//			$post_data['meta_input']['block_time'] = implode( ', ', $block_time );
//		}

		$str_date = '';

		if ( $one_date ) {
			$str_date .= $one_date . ' ' . $one_time;
		}

		if ( $block_date ) {
			for( $i = 0; $i < count($block_date); $i++ ) {
				$str_date .= ' | ' . $block_date[$i] . ' ' . $block_time[$i];
			}
		}

		try {
			$list = \Stripe\Customer::all([
				'email' => $email,
				'limit' => 1
			]);

			if ( ! empty( $list->data ) ) {
				foreach ( $list->data as $item ) {
					if ( $item->id ) {
						$customer_id = $item->id;
						break;
					}
				}
			}

		} catch (Exception $e) {
			echo json_encode([
				'res' => fasle,
				'message' => $e->getError()->message,
				'error' => $e->getJsonBody(),
			]);
			die();
		}

		if ( ! $customer_id ) {
			try {
				$customer = \Stripe\Customer::create([
					'source' => $_POST['token'],
					'email' => $email,
					'name' => $name,
					'address' => [
						'line1' => $address,
					],
					'metadata' => [
						'company' => $company,
					],
				]);

				$card_id = $customer['default_source'];

				\Stripe\Customer::updateSource(
					$customer->id,
					$card_id,
					[
						"address_line1" => $address,
					]
				);

			} catch(\Stripe\Exception\CardException $e) {
				echo json_encode([
					'res' => fasle,
					'message' => $e->getError()->message,
					'error' => $e->getJsonBody(),
				]);
				die();
			}

		} else {
			$customer = \Stripe\Customer::retrieve($customer_id);
		}

		try {
			$amount = ceil(intval($total)*100);
			if($amount < 1) {
				echo json_encode([
					'res' => fasle,
					'message' => 'Error with amount',
				]);
				die();
			}
			$charge = \Stripe\Charge::create([
				'amount' => $amount,
				'currency' => 'gbp',
				'description' => $str_date,
				'customer' => $customer->id,
				"metadata" => [
					'type' => $type
				],
			]);
		} catch(\Stripe\Exception\CardException $e) {
			echo json_encode([
				'res' => fasle,
				'message' => $e->getError()->message,
				'error' => $e->getJsonBody(),
			]);
			die();
		}

		$result = array(
			'res' => true,
			'customer_id' => $customer->id,

		);

		$post_id = wp_insert_post( $post_data );

		if ( is_wp_error( $post_id ) ) {
			echo $post_id->get_error_message();
		} else {
			wp_send_json_success( $result );
		}
	}

	wp_die();
}

add_action('wp_ajax_booking_service', 'booking_service');
add_action('wp_ajax_nopriv_booking_service', 'booking_service');

function update_booking_date() {
	var_dump($_POST);

	if ( is_countable( $_POST['data']['oneTime'] ) ) {
		$_SESSION['hire_service_fields']['oneTime'] = $_POST['data']['oneTime'];
	}

	if ( is_countable( $_POST['data']['blockTime'] ) ) {
		$_SESSION['hire_service_fields']['blockTime'] = $_POST['data']['blockTime'];
	}

	wp_die();
}

add_action('wp_ajax_update_booking_date', 'update_booking_date');
add_action('wp_ajax_nopriv_update_booking_date', 'update_booking_date');