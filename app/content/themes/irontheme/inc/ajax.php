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

			$one_time_meta = get_post_meta( get_the_ID() , 'one_time', true );
			$block_date_meta = get_post_meta( get_the_ID() , 'block_date', true );

			if ( $one_time_meta ) {
				$disable_times[] = $one_time_meta;
			}

			if ( $block_date_meta ) {
				foreach ( explode( ', ', $block_date_meta ) as $item ) {
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
				'id' => '-1',
				'text' => 'Select time',
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
				} elseif ( isset( $_SESSION['hire_service_fields']['block_date'] ) ) {
					foreach ( $_SESSION['hire_service_fields']['block_date'] as $item ) {
						if ( $item == $select_day ) {
							if ( $day['hour'] . ':00' == $item ) {
								$selected = true;
							}
						}
					}
				}

				$result[] = [
					'id' => $day['hour'] . ':00',
					'text' => $day['hour'] . ':00',
					'disabled' => $disabled,
					'selected' => $selected,
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

function get_service_data() {
	parse_str( $_POST['data'], $data );

	$type = isset( $data['hs_type'] ) ? sanitize_text_field( $data['hs_type'] ) : null;
	$one_date = isset( $data['one_date'] ) ? sanitize_text_field( $data['one_date'] ) : '';
	$one_time = isset( $data['one_time'] ) ? sanitize_text_field( $data['one_time'] ) : '';

	if ( ! $type ) {
		wp_send_json_error( 'Error! Not all data transferred' );
	}

	$days = get_field( 'days', 'option' );
	$block_booking = get_field( 'block_booking', 'option' )['hours'];
	$result = [];
	$str = '';
	$total = 0;

	if ( $type == 'one-time' ) {
		$name_day = strtolower( date( 'l', strtotime( $one_date ) ) );

		if ( $name_day ) {
			if ( is_countable( $days[ $name_day ] ) ) {
				foreach ( $days[ $name_day ] as $day ) {
					if ( $day['hour'] == str_replace( ':00', '', $one_time ) ) {
						$str .= "<div class=\"confirm__items-item\">$one_date {$one_time} <span>£{$day['price']}</span></div>" . PHP_EOL;

						$total += $day['price'];
					}
				}
			}
		}

	} elseif ( $type == 'block-time' ) {
		if ( is_countable( $data['block_date'] ) ) {
			$i = 0;
			$count = count( $data['block_date'] );

			foreach ( $data['block_date'] as $date ) {
				$name_day = strtolower( date( 'l', strtotime( $date ) ) );

				if ( !empty( $data['block_time'][$i] ) ) {
					if ( $name_day ) {
						if ( $count >= 5 ) {
							foreach ( $block_booking as $block ) {
								if ( $block['hour'] == str_replace( ':00', '', $data['block_time'][ $i ] ) ) {
									if ( (($i + 1) % 10) === 0 ) {
										$str .= "<div class=\"confirm__items-item\">$date {$data['block_time'][$i]} <span>£0</span></div>" . PHP_EOL;
									} else {
										$str .= "<div class=\"confirm__items-item\">$date {$data['block_time'][$i]} <span>£{$block['price']}</span></div>" . PHP_EOL;
										$total += $block['price'];
									}
								}
							}
						} else {
							if ( is_countable( $days[ $name_day ] ) ) {
								foreach ( $days[ $name_day ] as $day ) {
									if ( $day['hour'] == str_replace( ':00', '', $data['block_time'][ $i ] ) ) {
										$str .= "<div class=\"confirm__items-item\">$date {$data['block_time'][$i]} <span>£{$day['price']}</span></div>" . PHP_EOL;

										$total += $day['price'];
									}
								}
							}
						}
					}
				}

				$i++;
			}
		}
	}

	$result['prices'] = $str;
	$result['total'] = $total;

	wp_send_json_success( $result );

	wp_die();
}

add_action('wp_ajax_get_service_data', 'get_service_data');
add_action('wp_ajax_nopriv_get_service_data', 'get_service_data');

function booking_service() {
	if ( is_countable( $_POST ) ) {
		parse_str( $_POST['data'], $data );
		$name          = null;
		$email         = null;
		$phone         = null;
		$type          = isset( $_SESSION['hire_service_fields']['type'] ) ? $_SESSION['hire_service_fields']['type'] : '';
		$one_date      = null;
		$one_time      = null;
		$block_date    = null;
		$block_time    = null;
		$total         = 0;
		$customer      = null;
		$customer_id   = null;
		$street        = isset( $_SESSION['hire_service_fields']['street'] ) ? $_SESSION['hire_service_fields']['street'] : '';
		$area          = isset( $_SESSION['hire_service_fields']['area'] ) ? $_SESSION['hire_service_fields']['area'] : '';
		$city          = isset( $_SESSION['hire_service_fields']['city'] ) ? $_SESSION['hire_service_fields']['city'] : '';
		$postcode      = isset( $_SESSION['hire_service_fields']['postcode'] ) ? $_SESSION['hire_service_fields']['postcode'] : '';
		$company       = isset( $_SESSION['hire_service_fields']['company'] ) ? $_SESSION['hire_service_fields']['company'] : '';
		$days          = get_field( 'days', 'option' );
		$block_booking = get_field( 'block_booking', 'option' )['hours'];

		if ( $type == 'one-time' ) {
			if ( empty( $_SESSION['hire_service_fields']['one_date'] ) ) {
				wp_send_json_error( 'Date field is required' );
			} else {
				$one_date = $_SESSION['hire_service_fields']['one_date'];
			}

			if ( empty( $_SESSION['hire_service_fields']['one_time'] ) ) {
				wp_send_json_error( 'Time field is required' );
			} else {
				$one_time = $_SESSION['hire_service_fields']['one_time'];
			}

			$name_day = strtolower( date( 'l', strtotime( $one_date ) ) );

			if ( $name_day ) {
				if ( is_countable( $days[ $name_day ] ) ) {
					foreach ( $days[ $name_day ] as $day ) {
						if ( $day['hour'] == str_replace( ':00', '', $one_time ) ) {
							$total += $day['price'];
						}
					}
				}
			}
		} elseif ( $type == 'block-time' ) {
			if ( empty( $_SESSION['hire_service_fields']['block_date'] ) ) {
				wp_send_json_error( 'Date field is required' );
			} else {
				$block_date = $_SESSION['hire_service_fields']['block_date'];
			}

			if ( empty( $_SESSION['hire_service_fields']['block_time'] ) ) {
				wp_send_json_error( 'Time field is required' );
			} else {
				$block_time = $_SESSION['hire_service_fields']['block_time'];
			}

			if ( is_countable( $block_date ) ) {
				$i = 0;
				$count = count( $block_date );

				foreach ( $block_date as $date ) {
					$name_day = strtolower( date( 'l', strtotime( $date ) ) );

					if ( !empty( $block_time[$i] ) ) {
						if ( $name_day ) {
							if ( $count >= 5 ) {
								foreach ( $block_booking as $block ) {
									if ( $block['hour'] == str_replace( ':00', '', $block_time[ $i ] ) ) {
										if ( (($i + 1) % 10) === 0 ) {
											$total += 0;
										} else {
											$total += $block['price'];
										}
									}
								}
							} else {
								if ( is_countable( $days[ $name_day ] ) ) {
									foreach ( $days[ $name_day ] as $day ) {
										if ( $day['hour'] == str_replace( ':00', '', $block_time[ $i ] ) ) {
											$total += $day['price'];
										}
									}
								}
							}
						}
					}

					$i++;
				}
			}
		}

		if ( empty( $_SESSION['hire_service_fields']['name'] ) ) {
			wp_send_json_error( 'Name field is required' );
		} else {
			$name = $_SESSION['hire_service_fields']['name'];
		}

		if ( empty( $_SESSION['hire_service_fields']['email'] ) ) {
			wp_send_json_error( 'Email field is required' );
		} else {
			$email = $_SESSION['hire_service_fields']['email'];
		}

		if ( empty( $_SESSION['hire_service_fields']['phone'] ) ) {
			wp_send_json_error( 'Phone field is required' );
		} else {
			$phone = $_SESSION['hire_service_fields']['phone'];
		}

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

		if ( $street ) {
			$post_data['meta_input']['street'] = $street;
		}

		if ( $area ) {
			$post_data['meta_input']['area'] = $area;
		}

		if ( $city ) {
			$post_data['meta_input']['city'] = $city;
		}

		if ( $postcode ) {
			$post_data['meta_input']['postcode'] = $postcode;
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
						'line1' => $street,
						'city' => $city,
						'postal_code' => $postcode,
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
						"address_city"  => $city,
						"address_line1" => $street,
						"address_zip" => $postcode,
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
					'type' => $type,
					'first_name' => $name,
					'address_town' => $city,
					'address_street' => $street,
					'address_postcode' => $postcode
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
			// Send to admin email
			if ( hire_service_send_email_admin() && hire_service_send_email_customer() ) {
				unset( $_SESSION['hire_service_fields'] );

				wp_send_json_success( $result );
			} else {
				wp_send_json_error( 'Errors sending message' );
			}
		}
	}

	wp_die();
}

add_action('wp_ajax_booking_service', 'booking_service');
add_action('wp_ajax_nopriv_booking_service', 'booking_service');

function hire_service_send_email_admin() {
	$form_fields = $_SESSION['hire_service_fields'];

	$headers = array(
		'From: ' . $form_fields['name'] . ' <' . $form_fields['email'] . '>',
		'content-type: text/html',
	);
	$to = get_bloginfo( 'admin_email' );
	$subject = 'Muath Trust - Sports Hall Hire';
	$message = "<p>Mr/Mrs {$form_fields['name']} has a confirmed booking for the Muath Trust Sports Hall on ";

	if ( $form_fields['type'] == 'one-time' ) {
		$start_date = date( 'Ymd', strtotime( $form_fields['one_date'] ) );
		$start_time = date( 'Hi', strtotime( $form_fields['one_time'] ) );
		$end_time = date( 'Hi', strtotime( $form_fields['one_time'] . ' +1 hour' )  );
		$details = urlencode( 'Booking for the Muath Trust Sports Hall' );
		$name = urlencode($form_fields['name']);
		$message .= "{$form_fields['one_date']} at {$form_fields['one_time']}";
		$message .= " - <a href=\"http://www.google.com/calendar/event?action=TEMPLATE&text={$name}&dates={$start_date}T{$start_time}00Z/{$start_date}T{$end_time}00Z&details=$details\">Add to Google Calendar</a>";
	} elseif ( $form_fields['type'] == 'block-time' ) {
		$i = 0;
		$count = count( $form_fields['block_date'] );

		foreach ( $form_fields['block_date'] as $date ) {
			$start_date = date( 'Ymd', strtotime( $date ) );
			$start_time = date( 'Hi', strtotime( $form_fields['block_time'][$i] ) );
			$end_time = date( 'Hi', strtotime( $form_fields['block_time'][$i] . ' +1 hour' )  );
			$details = urlencode( 'Booking for the Muath Trust Sports Hall' );
			$name = urlencode($form_fields['name']);
			$message .= "$date at {$form_fields['block_time'][$i]}";
			$message .= " - <a href=\"http://www.google.com/calendar/event?action=TEMPLATE&text={$name}&dates={$start_date}T{$start_time}00Z/{$start_date}T{$end_time}00Z&details=$details\">Add to Google Calendar</a>";

			if ( ($i + 1) < $count) {
				$message .= ', ';
			}

			$i++;
		}
	}

	return wp_mail( $to, $subject, $message, $headers );
}

function hire_service_send_email_customer() {
	$form_fields = $_SESSION['hire_service_fields'];

	$headers = array(
		'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>',
		'content-type: text/html',
	);
	$to = $form_fields['email'];
	$subject = 'Muath Trust - Sports Hall Hire';
	$message = "<p>Thank you for booking the Muath Trust Sports Hall on ";

	if ( $form_fields['type'] == 'one-time' ) {
		$start_date = date( 'Ymd', strtotime( $form_fields['one_date'] ) );
		$start_time = date( 'Hi', strtotime( $form_fields['one_time'] ) );
		$end_time = date( 'Hi', strtotime( $form_fields['one_time'] . ' +1 hour' )  );
		$details = urlencode( 'Booking for the Muath Trust Sports Hall' );
		$name = urlencode( 'Muath Trust Sports Hall hire' );
		$message .= "{$form_fields['one_date']} at {$form_fields['one_time']}";
		$message .= " - <a href=\"http://www.google.com/calendar/event?action=TEMPLATE&text={$name}&dates={$start_date}T{$start_time}00Z/{$start_date}T{$end_time}00Z&details=$details\">Add to Google Calendar</a>";
	} elseif ( $form_fields['type'] == 'block-time' ) {
		$i = 0;
		$count = count( $form_fields['block_date'] );

		foreach ( $form_fields['block_date'] as $date ) {
			$start_date = date( 'Ymd', strtotime( $date ) );
			$start_time = date( 'Hi', strtotime( $form_fields['block_time'][$i] ) );
			$end_time = date( 'Hi', strtotime( $form_fields['block_time'][$i] . ' +1 hour' )  );
			$details = urlencode( 'Booking for the Muath Trust Sports Hall' );
			$name = urlencode( 'Muath Trust Sports Hall hire' );
			$message .= "$date at {$form_fields['block_time'][$i]}";
			$message .= " - <a href=\"http://www.google.com/calendar/event?action=TEMPLATE&text={$name}&dates={$start_date}T{$start_time}00Z/{$start_date}T{$end_time}00Z&details=$details\">Add to Google Calendar</a>";

			if ( ($i + 1) < $count) {
				$message .= ', ';
			}

			$i++;
		}
	}

	return wp_mail( $to, $subject, $message, $headers );
}