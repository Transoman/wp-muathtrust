<?php
/**
 * Template Name: Hire Service
 */
get_header();

get_template_part( 'template-parts/breadcrumbs' );

$step = isset( $_GET['step'] ) ? $_GET['step'] : '';

if ( count($_POST) > 0 ) {
	if ( $step == 2 ) {
		if ( isset( $_POST['hs_type'] ) ) {
			$_SESSION['hire_service_fields']['type'] = sanitize_text_field( $_POST['hs_type'] );
		} else {
			unset( $_SESSION['hire_service_fields']['type'] );
		}

		if ( isset( $_POST['one_date'] ) ) {
			$_SESSION['hire_service_fields']['one_date'] = sanitize_text_field( $_POST['one_date'] );
		} else {
			unset( $_SESSION['hire_service_fields']['one_date'] );
		}

		if ( isset( $_POST['one_time'] ) ) {
			$_SESSION['hire_service_fields']['one_time'] = sanitize_text_field( $_POST['one_time'] );
		} else {
			unset( $_SESSION['hire_service_fields']['one_time'] );
		}

		if ( isset( $_POST['block_date'] ) ) {
			$_SESSION['hire_service_fields']['block_date'] = $_POST['block_date'];
		} else {
			unset( $_SESSION['hire_service_fields']['block_date'] );
		}

		if ( isset( $_POST['block_time'] ) ) {
			$_SESSION['hire_service_fields']['block_time'] = $_POST['block_time'];
		} else {
			unset( $_SESSION['hire_service_fields']['block_time'] );
		}
	}

	if ( $step == 3 ) {
		if ( isset( $_POST['hs_name'] ) ) {
			$_SESSION['hire_service_fields']['name'] = sanitize_text_field( $_POST['hs_name'] );
		} else {
			unset( $_SESSION['hire_service_fields']['name'] );
		}

		if ( isset( $_POST['hs_email'] ) ) {
			$_SESSION['hire_service_fields']['email'] = sanitize_text_field( $_POST['hs_email'] );
		} else {
			unset( $_SESSION['hire_service_fields']['email'] );
		}

		if ( isset( $_POST['hs_phone'] ) ) {
			$_SESSION['hire_service_fields']['phone'] = sanitize_text_field( $_POST['hs_phone'] );
		} else {
			unset( $_SESSION['hire_service_fields']['phone'] );
		}

		if ( isset( $_POST['hs_street'] ) ) {
			$_SESSION['hire_service_fields']['street'] = sanitize_text_field( $_POST['hs_street'] );
		} else {
			unset( $_SESSION['hire_service_fields']['street'] );
		}

		if ( isset( $_POST['hs_area'] ) ) {
			$_SESSION['hire_service_fields']['area'] = sanitize_text_field( $_POST['hs_area'] );
		} else {
			unset( $_SESSION['hire_service_fields']['area'] );
		}

		if ( isset( $_POST['hs_city'] ) ) {
			$_SESSION['hire_service_fields']['city'] = sanitize_text_field( $_POST['hs_city'] );
		} else {
			unset( $_SESSION['hire_service_fields']['city'] );
		}

		if ( isset( $_POST['hs_postcode'] ) ) {
			$_SESSION['hire_service_fields']['postcode'] = sanitize_text_field( $_POST['hs_postcode'] );
		} else {
			unset( $_SESSION['hire_service_fields']['postcode'] );
		}

		if ( isset( $_POST['hs_company'] ) ) {
			$_SESSION['hire_service_fields']['company'] = sanitize_text_field( $_POST['hs_company'] );
		} else {
			unset( $_SESSION['hire_service_fields']['company'] );
		}
	}
}

$days = get_field( 'days', 'option' );

$type = isset( $_SESSION['hire_service_fields']['type'] ) ? $_SESSION['hire_service_fields']['type'] : '';
$one_date = isset( $_SESSION['hire_service_fields']['one_date'] ) ? $_SESSION['hire_service_fields']['one_date'] : '';
$one_time = isset( $_SESSION['hire_service_fields']['one_time'] ) ? $_SESSION['hire_service_fields']['one_time'] : '';
$block_date = isset( $_SESSION['hire_service_fields']['block_date'] ) ? $_SESSION['hire_service_fields']['block_date'] : [];
$block_time = isset( $_SESSION['hire_service_fields']['block_time'] ) ? $_SESSION['hire_service_fields']['block_time'] : [];
$name = isset( $_SESSION['hire_service_fields']['name'] ) ? $_SESSION['hire_service_fields']['name'] : '';
$email = isset( $_SESSION['hire_service_fields']['email'] ) ? $_SESSION['hire_service_fields']['email'] : '';
$phone = isset( $_SESSION['hire_service_fields']['phone'] ) ? $_SESSION['hire_service_fields']['phone'] : '';
$street = isset( $_SESSION['hire_service_fields']['street'] ) ? $_SESSION['hire_service_fields']['street'] : '';
$area = isset( $_SESSION['hire_service_fields']['area'] ) ? $_SESSION['hire_service_fields']['area'] : '';
$city = isset( $_SESSION['hire_service_fields']['city'] ) ? $_SESSION['hire_service_fields']['city'] : '';
$postcode = isset( $_SESSION['hire_service_fields']['postcode'] ) ? $_SESSION['hire_service_fields']['postcode'] : '';
$company = isset( $_SESSION['hire_service_fields']['company'] ) ? $_SESSION['hire_service_fields']['company'] : '';

$days = get_field( 'days', 'option' );
$block_booking = get_field( 'block_booking', 'option' )['hours'];
$result = [];
$total = 0;
$str = '';

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
									$str .= "<div class=\"confirm__items-item\">$date {$block_time[$i]} <span>£0</span></div>" . PHP_EOL;
								} else {
									$str .= "<div class=\"confirm__items-item\">$date {$block_time[$i]} <span>£{$block['price']}</span></div>" . PHP_EOL;
									$total += $block['price'];
								}
							}
						}
					} else {
						if ( is_countable( $days[ $name_day ] ) ) {
							foreach ( $days[ $name_day ] as $day ) {
								if ( $day['hour'] == str_replace( ':00', '', $block_time[ $i ] ) ) {
									$str .= "<div class=\"confirm__items-item\">$date {$block_time[$i]} <span>£{$day['price']}</span></div>" . PHP_EOL;

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
?>

<section class="confirm">
	<div class="container">
		<div class="confirm__wrap">
			<div class="confirm__left">
				<div class="confirm__total">Your selected dates... <span>£<span><?php echo $total; ?></span></span></div>

				<div class="confirm__items">
					<?php echo $str; ?>
				</div>
			</div>

			<div class="confirm__right">
				<div class="checkout-form-box">
					<div class="hire-steps">
						<a href="<?php echo get_permalink(); ?>" class="hire-steps__item<?php echo ($step == 0 || $step == 1) ? ' is-active' : ''; ?><?php echo $step > 1 ? ' is-complete' : ''; ?>">
							<div class="hire-steps__number">1</div>
							<div class="hire-steps__label">Time slot</div>
						</a>
						<a href="<?php echo get_permalink(); ?>?step=2" class="hire-steps__item<?php echo $step == 2 ? ' is-active' : ''; ?><?php echo $step > 2 ? ' is-complete' : ''; ?>">
							<div class="hire-steps__number">2</div>
							<div class="hire-steps__label">Person Details</div>
						</a>
						<a href="<?php echo get_permalink(); ?>?step=3" class="hire-steps__item<?php echo $step == 3 ? ' is-active' : ''; ?><?php echo $step > 3 ? ' is-complete' : ''; ?>">
							<div class="hire-steps__number">3</div>
							<div class="hire-steps__label">Payment</div>
						</a>
					</div>

					<?php if ( $step == 1 || $step == '' ): ?>
						<form action="<?php echo get_permalink(); ?>?step=2" method="post" class="hire-service-form hire-service-form--step-1">
							<div class="form-group">
								<label class="form-label">Type booking</label>

								<div class="form-row">
									<div class="from-group">
										<label class="circle-check">
											<input type="radio" name="hs_type" class="circle-check__input" value="one-time" <?php echo $type == 'one-time' || $type == '' ? 'checked' : ''; ?>>
											<span class="circle-check__box">One time booking</span>
										</label>
									</div>
									<div class="from-group">
										<label class="circle-check">
											<input type="radio" name="hs_type" class="circle-check__input" value="block-time" <?php echo $type == 'block-time' ? 'checked' : ''; ?>>
											<span class="circle-check__box">Block booking</span>
										</label>
									</div>
								</div>
							</div>

							<div class="one-time">
								<div class="form-row hire-service-form__datetime">
									<div class="form-group">
										<label for="" class="form-label">Date</label>
										<input type="date" name="one_date" class="hire-service-form__datetime-date" min="<?php echo date( 'Y-m-d' ); ?>" data-id="one-time__id-1" value="<?php echo $one_date; ?>" required>
									</div>
									<div class="form-group">
										<label for="" class="form-label">Time</label>
										<select name="one_time" id="" class="js-not-init hire-service-form__datetime-time" data-id="one-time__id-1" disabled required>
											<option value="">Select time</option>
											<?php
											$disable_times = [];

											$name_day = strtolower( date( 'l', strtotime( $one_date ) ) );

											$args = [
												'post_type' => 'booking_service',
												'posts_per_page' => -1,
												'meta_query' => [
													'relation' => 'OR',
													[
														'key' => 'one_date',
														'value' => $one_date
													],
													[
														'key' => 'block_date',
														'value' => $one_date,
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
															if ( date( 'Y-m-d', strtotime( $item )) == $one_date ) {
																$disable_times[] = date( 'H:i', strtotime( $item ) );
															}
														}
													}
												}
											}
											wp_reset_postdata();

											if ( !empty( $one_time ) ) {
												if ( $name_day ) {
													if ( is_countable( $days[ $name_day ] ) ) {
														foreach ( $days[ $name_day ] as $day ):
															$disabled = false;

															if ( in_array( $day['hour'] . ':00', $disable_times ) ) {
																$disabled = true;
															} ?>
															<option value="<?php echo $day['hour']; ?>:00" <?php selected( $day['hour'] . ':00', $one_time ); disabled($disabled) ?> ><?php echo $day['hour']; ?>:00</option>
														<?php endforeach;
													}
												}
											}
											?>
										</select>
									</div>
								</div>
							</div>

							<div class="block-time">
								<div class="form-group">
									<p>If you block book 10 sessions you get the 10th one free <br>(so 10 for the price of 9)</p>
								</div>

								<?php if ( count( $block_date ) ):
									$i = 0;
									$count = count( $block_date );
									$disable_times = [];

									foreach ( $block_date as $date ) {
										$name_day = strtolower( date( 'l', strtotime( $date ) ) );

										$args = [
											'post_type' => 'booking_service',
											'posts_per_page' => -1,
											'meta_query' => [
												'relation' => 'OR',
												[
													'key' => 'one_date',
													'value' => $date
												],
												[
													'key' => 'block_date',
													'value' => $date,
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
														if ( date( 'Y-m-d', strtotime( $item )) == $date ) {
															$disable_times[] = date( 'H:i', strtotime( $item ) );
														}
													}
												}
											}
										}
										wp_reset_postdata();
										?>
										<div class="form-row hire-service-form__datetime">
											<div class="form-group">
												<label for="" class="form-label">Date</label>
												<input type="date" name="block_date[]" class="hire-service-form__datetime-date" value="<?php echo $date; ?>" min="<?php echo date( 'Y-m-d' ); ?>" required>
											</div>
											<div class="form-group">
												<label for="" class="form-label">Time</label>
												<select name="block_time[]" id="" class="js-not-init hire-service-form__datetime-time" disabled required>
													<option value="">Select time</option>
										<?php
										if ( !empty( $block_time[$i] ) ) {
											if ( $name_day ) {
												if ( is_countable( $days[ $name_day ] ) ) {
													foreach ( $days[ $name_day ] as $day ):
														$disabled = false;

														if ( in_array( $day['hour'] . ':00', $disable_times ) ) {
															$disabled = true;
														} ?>
														<option value="<?php echo $day['hour']; ?>:00" <?php selected( $day['hour'] . ':00', $block_time[$i] ); disabled($disabled) ?> ><?php echo $day['hour']; ?>:00</option>
													<?php endforeach;
												}
											}
										}
										?>
												</select>
											</div>
										</div>
										<?php
										$i++;
									}
									?>
								<?php else: ?>
									<div class="form-row hire-service-form__datetime">
										<div class="form-group">
											<label for="" class="form-label">Date</label>
											<input type="date" name="block_date[]" class="hire-service-form__datetime-date" value="" min="<?php echo date( 'Y-m-d' ); ?>" disabled required>
										</div>
										<div class="form-group">
											<label for="" class="form-label">Time</label>
											<select name="block_time[]" id="" class="js-not-init hire-service-form__datetime-time" disabled required>
												<option value="">Select time</option>
											</select>
										</div>
									</div>
								<?php endif; ?>

								<div class="form-group text-center">
									<a href="#" class="hire-service-form__add-date">Another booking</a>
								</div>

								<template class="block-time-clone">
									<div class="form-row hire-service-form__datetime">
										<div class="form-group">
											<label for="" class="form-label">Date</label>
											<input type="date" name="block_date[]" class="hire-service-form__datetime-date" value="" min="<?php echo date( 'Y-m-d' ); ?>">
										</div>
										<div class="form-group">
											<label for="" class="form-label">Time</label>
											<select name="block_time[]" id="" class="js-not-init hire-service-form__datetime-time" disabled>
												<option value="">Select time</option>
											</select>
										</div>
									</div>
								</template>
							</div>

							<div class="form-group form-group--last text-center">
								<button type="submit" class="btn">Next</button>
							</div>
						</form>
					<?php elseif ( $step == 2 ): ?>
						<form action="<?php echo get_permalink(); ?>?step=3" method="post" class="hire-service-form hire-service-form--step-2">
							<div class="form-group">
								<label for="hs_name" class="form-label">Name</label>
								<input type="text" name="hs_name" id="hs_name" value="<?php echo $name; ?>" required>
							</div>
							<div class="form-group">
								<label for="hs_email" class="form-label">Email</label>
								<input type="email" name="hs_email" id="hs_email" value="<?php echo $email; ?>" required>
							</div>

							<div class="form-group">
								<label for="hs_phone" class="form-label">Phone number</label>
								<input type="tel" name="hs_phone" id="hs_phone" value="<?php echo $phone; ?>" required>
							</div>

							<div class="form-group">
								<label for="hs_street" class="form-label">Street</label>
								<input type="text" name="hs_street" id="hs_street" value="<?php echo $street; ?>">
							</div>

							<div class="form-group">
								<label for="hs_area" class="form-label">Area</label>
								<input type="text" name="hs_area" id="hs_area" value="<?php echo $area; ?>">
							</div>

							<div class="form-group">
								<label for="hs_city" class="form-label">City</label>
								<input type="text" name="hs_city" id="hs_city" value="<?php echo $city; ?>">
							</div>

							<div class="form-group">
								<label for="hs_postcode" class="form-label">Postcode</label>
								<input type="text" name="hs_postcode" id="hs_postcode" value="<?php echo $postcode; ?>">
							</div>

							<div class="form-group">
								<label for="hs_company" class="form-label">Company name if applicable</label>
								<input type="text" name="hs_company" id="hs_company" value="<?php echo $company; ?>">
							</div>

							<div class="form-group form-group--last text-center">
								<button type="submit" class="btn">Next</button>
							</div>
						</form>
					<?php elseif ( $step == 3 ): ?>
						<form action="<?php echo get_permalink(); ?>?step=3" method="post" class="hire-service-form hire-service-form--step-3">

							<div class="form-group">
								<label for="card-element" class="form-label">Card Number</label>
								<div id="card-element" class="stripe-field"></div>
								<div class="card-error wpcf7-not-valid-tip"></div>
							</div>

							<div class="form-group form-group--last text-center">
								<button type="submit" class="btn">Submit</button>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/blocks' ); ?>

<script src="https://js.stripe.com/v3/"></script>

<?php get_footer();
