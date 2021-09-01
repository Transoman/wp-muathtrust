<?php get_header();

$title = get_field( 'hire_title' );
$text = get_field( 'hire_text' );
$important_text = get_field( 'hire_important_text' );

$step = isset( $_GET['step'] ) ? $_GET['step'] : '';

var_dump($_POST);

if ( count($_POST) > 0 ) {
	if ( $step == 2 ) {
		if ( isset( $_POST['hire_accommodation'] ) ) {
			$_SESSION['hire_fields']['accommodation'] = sanitize_text_field( $_POST['hire_accommodation'] );
		} else {
			unset( $_SESSION['hire_fields']['accommodation'] );
		}
	}

	if ( $step == 3 ) {
		if ( isset( $_POST['hire_title_event'] ) ) {
			$_SESSION['hire_fields']['title_event'] = sanitize_text_field( $_POST['hire_title_event'] );
		} else {
			unset( $_SESSION['hire_fields']['title_event'] );
		}

		if ( isset( $_POST['hire_day'] ) ) {
			$_SESSION['hire_fields']['day'] = sanitize_text_field( $_POST['hire_day'] );
		} else {
			unset( $_SESSION['hire_fields']['day'] );
		}

		if ( isset( $_POST['hire_date']['day'] ) ) {
			$_SESSION['hire_fields']['date']['day'] = sanitize_text_field( $_POST['hire_date']['day'] );
		} else {
			unset( $_SESSION['hire_fields']['date']['day'] );
		}

		if ( isset( $_POST['hire_date']['month'] ) ) {
			$_SESSION['hire_fields']['date']['month'] = sanitize_text_field( $_POST['hire_date']['month'] );
		} else {
			unset( $_SESSION['hire_fields']['date']['month'] );
		}

		if ( isset( $_POST['hire_date']['year'] ) ) {
			$_SESSION['hire_fields']['date']['year'] = sanitize_text_field( $_POST['hire_date']['year'] );
		} else {
			unset( $_SESSION['hire_fields']['date']['year'] );
		}

		if ( isset( $_POST['hire_start_time'] ) ) {
			$_SESSION['hire_fields']['start_time'] = sanitize_text_field( $_POST['hire_start_time'] );
		} else {
			unset( $_SESSION['hire_fields']['start_time'] );
		}

		if ( isset( $_POST['hire_end_time'] ) ) {
			$_SESSION['hire_fields']['end_time'] = sanitize_text_field( $_POST['hire_end_time'] );
		} else {
			unset( $_SESSION['hire_fields']['end_time'] );
		}

		if ( isset( $_POST['hire_delegate_numbers'] ) ) {
			$_SESSION['hire_fields']['delegate_numbers'] = sanitize_text_field( $_POST['hire_delegate_numbers'] );
		} else {
			unset( $_SESSION['hire_fields']['delegate_numbers'] );
		}

		if ( isset( $_POST['hire_landmarks'] ) ) {
			$_SESSION['hire_fields']['landmarks'] = $_POST['hire_landmarks'];
		} else {
			unset( $_SESSION['hire_fields']['landmarks'] );
		}

		if ( isset( $_POST['hire_equipment'] ) ) {
			$_SESSION['hire_fields']['equipment'] = $_POST['hire_equipment'];
		} else {
			unset( $_SESSION['hire_fields']['equipment'] );
		}
	}

	if ( $step == 4 ) {
		if ( isset( $_POST['hire_speaker'] ) ) {
			$_SESSION['hire_fields']['speaker'] = sanitize_text_field( $_POST['hire_speaker'] );
		} else {
			unset( $_SESSION['hire_fields']['speaker'] );
		}

		if ( isset( $_POST['hire_aim_objective_event'] ) ) {
			$_SESSION['hire_fields']['aim_objective_event'] = sanitize_text_field( $_POST['hire_aim_objective_event'] );
		} else {
			unset( $_SESSION['hire_fields']['aim_objective_event'] );
		}

		if ( isset( $_POST['hire_attendees'] ) ) {
			$_SESSION['hire_fields']['attendees'] = sanitize_text_field( $_POST['hire_attendees'] );
		} else {
			unset( $_SESSION['hire_fields']['attendees'] );
		}

		if ( isset( $_POST['hire_organisation_event'] ) ) {
			$_SESSION['hire_fields']['organisation_event'] = sanitize_text_field( $_POST['hire_organisation_event'] );
		} else {
			unset( $_SESSION['hire_fields']['organisation_event'] );
		}

		if ( isset( $_POST['hire_distributing_literature'] ) ) {
			$_SESSION['hire_fields']['distributing_literature'] = sanitize_text_field( $_POST['hire_distributing_literature'] );
		} else {
			unset( $_SESSION['hire_fields']['distributing_literature'] );
		}
	}

	if ( $step == 5 ) {
		if ( isset( $_POST['hire_timecoffee']['break_1'] ) ) {
			$_SESSION['hire_fields']['timecoffee']['break_1'] = sanitize_text_field( $_POST['hire_timecoffee']['break_1'] );
		} else {
			unset( $_SESSION['hire_fields']['timecoffee']['break_1'] );
		}

		if ( isset( $_POST['hire_timecoffee']['break_2'] ) ) {
			$_SESSION['hire_fields']['timecoffee']['break_2'] = sanitize_text_field( $_POST['hire_timecoffee']['break_2'] );
		} else {
			unset( $_SESSION['hire_fields']['timecoffee']['break_2'] );
		}

		if ( isset( $_POST['hire_timecoffee']['break_3'] ) ) {
			$_SESSION['hire_fields']['timecoffee']['break_3'] = sanitize_text_field( $_POST['hire_timecoffee']['break_3'] );
		} else {
			unset( $_SESSION['hire_fields']['timecoffee']['break_3'] );
		}

		if ( isset( $_POST['hire_timewater']['break_1'] ) ) {
			$_SESSION['hire_fields']['timewater']['break_1'] = sanitize_text_field( $_POST['hire_timewater']['break_1'] );
		} else {
			unset( $_SESSION['hire_fields']['timewater']['break_1'] );
		}

		if ( isset( $_POST['hire_timewater']['break_2'] ) ) {
			$_SESSION['hire_fields']['timewater']['break_2'] = sanitize_text_field( $_POST['hire_timewater']['break_2'] );
		} else {
			unset( $_SESSION['hire_fields']['timewater']['break_2'] );
		}

		if ( isset( $_POST['hire_timewater']['break_3'] ) ) {
			$_SESSION['hire_fields']['timewater']['break_3'] = sanitize_text_field( $_POST['hire_timewater']['break_3'] );
		} else {
			unset( $_SESSION['hire_fields']['timewater']['break_3'] );
		}

		if ( isset( $_POST['hire_numbers_lunch'] ) ) {
			$_SESSION['hire_fields']['numbers_lunch'] = sanitize_text_field( $_POST['hire_numbers_lunch'] );
		} else {
			unset( $_SESSION['hire_fields']['numbers_lunch'] );
		}

		if ( isset( $_POST['hire_time_lunch'] ) ) {
			$_SESSION['hire_fields']['time_lunch'] = sanitize_text_field( $_POST['hire_time_lunch'] );
		} else {
			unset( $_SESSION['hire_fields']['time_lunch'] );
		}
	}

	if ( $step == 6 ) {
		if ( isset( $_POST['hire_booking_name'] ) ) {
			$_SESSION['hire_fields']['booking_name'] = sanitize_text_field( $_POST['hire_booking_name'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_name'] );
		}

		if ( isset( $_POST['hire_booking_organisation'] ) ) {
			$_SESSION['hire_fields']['booking_organisation'] = sanitize_text_field( $_POST['hire_booking_organisation'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_organisation'] );
		}

		if ( isset( $_POST['hire_booking_street'] ) ) {
			$_SESSION['hire_fields']['booking_street'] = sanitize_text_field( $_POST['hire_booking_street'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_street'] );
		}

		if ( isset( $_POST['hire_booking_area'] ) ) {
			$_SESSION['hire_fields']['booking_area'] = sanitize_text_field( $_POST['hire_booking_area'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_area'] );
		}

		if ( isset( $_POST['hire_booking_zip'] ) ) {
			$_SESSION['hire_fields']['booking_zip'] = sanitize_text_field( $_POST['hire_booking_zip'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_zip'] );
		}

		if ( isset( $_POST['hire_booking_phone'] ) ) {
			$_SESSION['hire_fields']['booking_phone'] = sanitize_text_field( $_POST['hire_booking_phone'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_phone'] );
		}

		if ( isset( $_POST['hire_booking_mobile'] ) ) {
			$_SESSION['hire_fields']['booking_mobile'] = sanitize_text_field( $_POST['hire_booking_mobile'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_mobile'] );
		}

		if ( isset( $_POST['hire_booking_email'] ) ) {
			$_SESSION['hire_fields']['booking_email'] = sanitize_email( $_POST['hire_booking_email'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_email'] );
		}

		if ( isset( $_POST['hire_booking_charity_number'] ) ) {
			$_SESSION['hire_fields']['booking_charity_number'] = sanitize_text_field( $_POST['hire_booking_charity_number'] );
		} else {
			unset( $_SESSION['hire_fields']['booking_charity_number'] );
		}

		if ( isset( $_POST['hire_paying_name'] ) ) {
			$_SESSION['hire_fields']['paying_name'] = sanitize_text_field( $_POST['hire_paying_name'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_name'] );
		}

		if ( isset( $_POST['hire_paying_organisation'] ) ) {
			$_SESSION['hire_fields']['paying_organisation'] = sanitize_text_field( $_POST['hire_paying_organisation'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_organisation'] );
		}

		if ( isset( $_POST['hire_paying_street'] ) ) {
			$_SESSION['hire_fields']['paying_street'] = sanitize_text_field( $_POST['hire_paying_street'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_street'] );
		}

		if ( isset( $_POST['hire_paying_area'] ) ) {
			$_SESSION['hire_fields']['paying_area'] = sanitize_text_field( $_POST['hire_paying_area'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_area'] );
		}

		if ( isset( $_POST['hire_paying_zip'] ) ) {
			$_SESSION['hire_fields']['paying_zip'] = sanitize_text_field( $_POST['hire_paying_zip'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_zip'] );
		}

		if ( isset( $_POST['hire_paying_phone'] ) ) {
			$_SESSION['hire_fields']['paying_phone'] = sanitize_text_field( $_POST['hire_paying_phone'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_phone'] );
		}

		if ( isset( $_POST['hire_paying_mobile'] ) ) {
			$_SESSION['hire_fields']['paying_mobile'] = sanitize_text_field( $_POST['hire_paying_mobile'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_mobile'] );
		}

		if ( isset( $_POST['hire_paying_email'] ) ) {
			$_SESSION['hire_fields']['paying_email'] = sanitize_email( $_POST['hire_paying_email'] );
		} else {
			unset( $_SESSION['hire_fields']['paying_email'] );
		}
	}
}

$accommodation = isset( $_SESSION['hire_fields']['accommodation'] ) ? $_SESSION['hire_fields']['accommodation'] : '';

$title_event = isset( $_SESSION['hire_fields']['title_event'] ) ? $_SESSION['hire_fields']['title_event'] : '';
$day = isset( $_SESSION['hire_fields']['day'] ) ? $_SESSION['hire_fields']['day'] : '';
$date_day = isset( $_SESSION['hire_fields']['date']['day'] ) ? $_SESSION['hire_fields']['date']['day'] : '';
$date_month = isset( $_SESSION['hire_fields']['date']['month'] ) ? $_SESSION['hire_fields']['date']['month'] : '';
$date_year = isset( $_SESSION['hire_fields']['date']['year'] ) ? $_SESSION['hire_fields']['date']['year'] : '';
$start_time = isset( $_SESSION['hire_fields']['start_time'] ) ? $_SESSION['hire_fields']['start_time'] : '';
$end_time = isset( $_SESSION['hire_fields']['end_time'] ) ? $_SESSION['hire_fields']['end_time'] : '';
$delegate_numbers = isset( $_SESSION['hire_fields']['delegate_numbers'] ) ? $_SESSION['hire_fields']['delegate_numbers'] : '';
$landmarks = isset( $_SESSION['hire_fields']['landmarks'] ) ? $_SESSION['hire_fields']['landmarks'] : [];
$equipment = isset( $_SESSION['hire_fields']['equipment'] ) ? $_SESSION['hire_fields']['equipment'] : [];

$speaker = isset( $_SESSION['hire_fields']['speaker'] ) ? $_SESSION['hire_fields']['speaker'] : '';
$aim_objective_event = isset( $_SESSION['hire_fields']['aim_objective_event'] ) ? $_SESSION['hire_fields']['aim_objective_event'] : '';
$attendees = isset( $_SESSION['hire_fields']['attendees'] ) ? $_SESSION['hire_fields']['attendees'] : '';
$organisation_event = isset( $_SESSION['hire_fields']['organisation_event'] ) ? $_SESSION['hire_fields']['organisation_event'] : '';
$distributing_literature = isset( $_SESSION['hire_fields']['distributing_literature'] ) ? $_SESSION['hire_fields']['distributing_literature'] : '';

$timecoffee_break_1 = isset( $_SESSION['hire_fields']['timecoffee']['break_1'] ) ? $_SESSION['hire_fields']['timecoffee']['break_1'] : '';
$timecoffee_break_2 = isset( $_SESSION['hire_fields']['timecoffee']['break_2'] ) ? $_SESSION['hire_fields']['timecoffee']['break_2'] : '';
$timecoffee_break_3 = isset( $_SESSION['hire_fields']['timecoffee']['break_3'] ) ? $_SESSION['hire_fields']['timecoffee']['break_3'] : '';
$timewater_break_1 = isset( $_SESSION['hire_fields']['timewater']['break_1'] ) ? $_SESSION['hire_fields']['timewater']['break_1'] : '';
$timewater_break_2 = isset( $_SESSION['hire_fields']['timewater']['break_2'] ) ? $_SESSION['hire_fields']['timewater']['break_2'] : '';
$timewater_break_3 = isset( $_SESSION['hire_fields']['timewater']['break_3'] ) ? $_SESSION['hire_fields']['timewater']['break_3'] : '';
$numbers_lunch = isset( $_SESSION['hire_fields']['numbers_lunch'] ) ? $_SESSION['hire_fields']['numbers_lunch'] : '';
$time_lunch = isset( $_SESSION['hire_fields']['time_lunch'] ) ? $_SESSION['hire_fields']['time_lunch'] : '';

$booking_name = isset( $_SESSION['hire_fields']['booking_name'] ) ? $_SESSION['hire_fields']['booking_name'] : '';
$booking_organisation = isset( $_SESSION['hire_fields']['booking_organisation'] ) ? $_SESSION['hire_fields']['booking_organisation'] : '';
$booking_street = isset( $_SESSION['hire_fields']['booking_street'] ) ? $_SESSION['hire_fields']['booking_street'] : '';
$booking_area = isset( $_SESSION['hire_fields']['booking_area'] ) ? $_SESSION['hire_fields']['booking_area'] : '';
$booking_zip = isset( $_SESSION['hire_fields']['booking_zip'] ) ? $_SESSION['hire_fields']['booking_zip'] : '';
$booking_phone = isset( $_SESSION['hire_fields']['booking_phone'] ) ? $_SESSION['hire_fields']['booking_phone'] : '';
$booking_mobile = isset( $_SESSION['hire_fields']['booking_mobile'] ) ? $_SESSION['hire_fields']['booking_mobile'] : '';
$booking_email = isset( $_SESSION['hire_fields']['booking_email'] ) ? $_SESSION['hire_fields']['booking_email'] : '';
$booking_charity_number = isset( $_SESSION['hire_fields']['booking_charity_number'] ) ? $_SESSION['hire_fields']['booking_charity_number'] : '';
$paying_name = isset( $_SESSION['hire_fields']['paying_name'] ) ? $_SESSION['hire_fields']['paying_name'] : '';
$paying_organisation = isset( $_SESSION['hire_fields']['paying_organisation'] ) ? $_SESSION['hire_fields']['paying_organisation'] : '';
$paying_street = isset( $_SESSION['hire_fields']['paying_street'] ) ? $_SESSION['hire_fields']['paying_street'] : '';
$paying_area = isset( $_SESSION['hire_fields']['paying_area'] ) ? $_SESSION['hire_fields']['paying_area'] : '';
$paying_zip = isset( $_SESSION['hire_fields']['paying_zip'] ) ? $_SESSION['hire_fields']['paying_zip'] : '';
$paying_phone = isset( $_SESSION['hire_fields']['paying_phone'] ) ? $_SESSION['hire_fields']['paying_phone'] : '';
$paying_mobile = isset( $_SESSION['hire_fields']['paying_mobile'] ) ? $_SESSION['hire_fields']['paying_mobile'] : '';
$paying_email = isset( $_SESSION['hire_fields']['paying_email'] ) ? $_SESSION['hire_fields']['booking_email'] : '';
?>

<section class="hire">
	<div class="container">
		<div class="hire__top">
			<h3 class="hire__top-title"><?php echo $title; ?></h3>

			<div class="hire__top-text"><?php echo $text; ?></div>
		</div>

		<?php if ( $step == 1 || $step == '' ): ?>
			<form action="<?php echo get_permalink(); ?>?step=2" method="post" class="hire-form hire-form--step-1">
				<div class="hire-form__row">
					<div class="hire-form__col">
						<h3 class="hire-form__title">Room</h3>

						<div class="form-group">
							<select name="hire_accommodation">
								<option value="Amanah House" data-custom-properties='{"price": 100}' <?php selected( 'Amanah House', $accommodation ); ?>>Amanah House</option>
								<option value="Recently refurbished AccommodationBlock" data-custom-properties='{"price": 150}' <?php selected( 'Recently refurbished AccommodationBlock', $accommodation ); ?>>Recently refurbished AccommodationBlock</option>
								<option value="Fully fitted One Bedroom Flat" data-custom-properties='{"price": 300}' <?php selected( 'Fully fitted One Bedroom Flat', $accommodation ); ?>>Fully fitted One Bedroom Flat</option>
							</select>
							<span class="select-price">£<span>0</span></span>
						</div>
					</div>
				</div>

				<div class="hire-form__bottom">
					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php elseif ( $step == 2 ): ?>
			<form action="<?php echo get_permalink(); ?>?step=3" method="post" class="hire-form hire-form--step-2">
				<div class="hire-form__row">
					<div class="hire-form__col">
						<h3 class="hire-form__title">Room requirements</h3>

						<div class="form-group">
							<label for="title_event" class="form-label">Title of Event</label>
							<input type="text" name="hire_title_event" id="title_event" value="<?php echo $title_event; ?>">
						</div>

						<div class="form-group">
							<label for="day" class="form-label">Day</label>
							<input type="text" name="hire_day" id="day" class="js-datepicker" autocomplete="off" value="<?php echo $day; ?>">
						</div>

						<div class="form-group">
							<label for="dd" class="form-label">Date</label>
							<div class="hire-form__grid">
								<div class="form-group">
									<input type="text" name="hire_date[day]" id="dd" value="<?php echo $date_day; ?>">
									<span>DD</span>
								</div>
								<div class="form-group">
									<input type="text" name="hire_date[month]" value="<?php echo $date_month; ?>">
									<span>MM</span>
								</div>
								<div class="form-group">
									<input type="text" name="hire_date[year]" value="<?php echo $date_year; ?>">
									<span>YYYY</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="start_time" class="form-label">Start Time</label>
							<input type="text" name="hire_start_time" id="start_time" value="<?php echo $start_time; ?>">
						</div>

						<div class="form-group">
							<label for="end_time" class="form-label">End Time</label>
							<input type="text" name="hire_end_time" id="end_time" value="<?php echo $end_time; ?>">
						</div>

						<div class="form-group">
							<label for="delegate_numbers" class="form-label">Delegate Numbers</label>
							<input type="text" name="hire_delegate_numbers" id="delegate_numbers" value="<?php echo $delegate_numbers; ?>">
						</div>

						<div class="form-group">
							<label class="form-label">Layout Required</label>

							<div class="hire-form__checkboxes">
								<label class="check">
									<input type="checkbox" name="hire_landmarks[]" class="check__input" value="Cabaret" <?php echo in_array( 'Cabaret', $landmarks ) ? ' checked' : ''; ?>>
									<span class="check__box">Cabaret</span>
								</label>
								<label class="check">
									<input type="checkbox" name="hire_landmarks[]" class="check__input" value="Theatre" <?php echo in_array( 'Theatre', $landmarks ) ? ' checked' : ''; ?>>
									<span class="check__box">Theatre</span>
								</label>
								<label class="check">
									<input type="checkbox" name="hire_landmarks[]" class="check__input" value="Boardroom" <?php echo in_array( 'Boardroom', $landmarks ) ? ' checked' : ''; ?>>
									<span class="check__box">Boardroom</span>
								</label>
							</div>
						</div>
					</div>

					<div class="hire-form__col">
						<h3 class="hire-form__title">Audio/ Visual Equipment</h3>

						<div class="form-group">
							<label class="form-label">Layout Required</label>

							<div class="hire-form__checkboxes">
								<label class="check">
									<input type="checkbox" name="hire_equipment[]" class="check__input" value="PA System" <?php echo in_array( 'PA System', $equipment ) ? ' checked' : ''; ?>>
									<span class="check__box">PA System</span>
								</label>
								<label class="check">
									<input type="checkbox" name="hire_equipment[]" class="check__input" value="Projector" <?php echo in_array( 'Projector', $equipment ) ? ' checked' : ''; ?>>
									<span class="check__box">Projector</span>
								</label>
								<label class="check">
									<input type="checkbox" name="hire_equipment[]" class="check__input" value="Laptop" <?php echo in_array( 'Laptop', $equipment ) ? ' checked' : ''; ?>>
									<span class="check__box">Laptop</span>
								</label>
								<label class="check">
									<input type="checkbox" name="hire_equipment[]" class="check__input" value="Flipchart" <?php echo in_array( 'Flipchart', $equipment ) ? ' checked' : ''; ?>>
									<span class="check__box">Flipchart</span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="hire-form__bottom">
					<a href="<?php echo get_permalink(); ?>" class="hire-form__back"><?php echo ith_the_icon( 'arrow-left' ); ?>Room</a>

					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php elseif ( $step == 3 ): ?>
			<form action="<?php echo get_permalink(); ?>?step=4" method="post" class="hire-form hire-form--step-3">
				<h3 class="hire-form__title">Event details</h3>

				<div class="form-group">
					<label class="form-label">Outline of Event</label>
					<p>(Please note booking will only be processed once management authorise this event)</p>
				</div>

				<div class="form-group">
					<label for="hire_speaker" class="form-label">Who will your speakers be?</label>
					<input type="text" name="hire_speaker" id="hire_speaker" value="<?php echo $speaker; ?>">
				</div>

				<div class="form-group">
					<label for="hire_aim_objective_event" class="form-label">What is the aim/objective of your event?</label>
					<input type="text" name="hire_aim_objective_event" id="hire_aim_objective_event" value="<?php echo $aim_objective_event; ?>">
				</div>

				<div class="form-group">
					<label for="hire_attendees" class="form-label">Who will your attendees be?</label>
					<input type="text" name="hire_attendees" id="hire_attendees" value="<?php echo $attendees; ?>">
				</div>

				<div class="form-group">
					<label for="hire_organisation_event" class="form-label">Any other organisation involved in the event?</label>
					<input type="text" name="hire_organisation_event" id="hire_organisation_event" value="<?php echo $organisation_event; ?>">
				</div>

				<div class="form-group">
					<label for="hire_distributing_literature" class="form-label">Will you be distributing literature at the event?</label>
					<input type="text" name="hire_distributing_literature" id="hire_distributing_literature" value="<?php echo $distributing_literature; ?>">
				</div>

				<div class="hire-form__bottom">
					<a href="<?php echo get_permalink(); ?>?step=2" class="hire-form__back"><?php echo ith_the_icon( 'arrow-left' ); ?>Room Requirements</a>

					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php elseif ( $step == 4 ): ?>
			<form action="<?php echo get_permalink(); ?>?step=5" method="post" class="hire-form hire-form--step-4">
				<h3 class="hire-form__title">Refreshments</h3>

				<div class="hire-form__row">
					<div class="hire-form__col">
						<h4>Time Coffee/ Tea & Biscuits required:</h4>

						<div class="form-group">
							<label for="hire_timecoffee_break_1" class="form-label">Break 1</label>
							<input type="text" name="hire_timecoffee[break_1]" id="hire_timecoffee_break_1" value="<?php echo $timecoffee_break_1; ?>">
						</div>

						<div class="form-group">
							<label for="hire_timecoffee_break_2" class="form-label">Break 2</label>
							<input type="text" name="hire_timecoffee[break_2]" id="hire_timecoffee_break_2" value="<?php echo $timecoffee_break_2; ?>">
						</div>

						<div class="form-group">
							<label for="hire_timecoffee_break_3" class="form-label">Break 3</label>
							<input type="text" name="hire_timecoffee[break_3]" id="hire_timecoffee_break_3" value="<?php echo $timecoffee_break_3; ?>">
						</div>
					</div>

					<div class="hire-form__col">
						<h4>Times water & juice required:</h4>

						<div class="form-group">
							<label for="hire_timewater_break_1" class="form-label">Break 1</label>
							<input type="text" name="hire_timewater[break_1]" id="hire_timewater_break_1" value="<?php echo $timewater_break_1; ?>">
						</div>

						<div class="form-group">
							<label for="hire_timewater_break_2" class="form-label">Break 2</label>
							<input type="text" name="hire_timewater[break_2]" id="hire_timewater_break_2" value="<?php echo $timewater_break_2; ?>">
						</div>

						<div class="form-group">
							<label for="hire_timewater_break_3" class="form-label">Break 3</label>
							<input type="text" name="hire_timewater[break_3]" id="hire_timewater_break_3" value="<?php echo $timewater_break_3; ?>">
						</div>
					</div>
				</div>

				<div class="hire-form__row">
					<div class="hire-form__col">
						<hr>

						<h3 class="hire-form__title">Catering</h3>

						<div class="form-group">
							<label class="form-label">Finger Buffett</label>
							<p>Mini individual starters, Wraps and sandwiches, Mini individual cakes £8.50 per head</p>
						</div>

						<div class="form-group">
							<label for="hire_numbers_lunch" class="form-label">Delegate numbers lunch required?</label>
							<input type="text" name="hire_numbers_lunch" id="hire_numbers_lunch" value="<?php echo $numbers_lunch; ?>">
						</div>

						<div class="form-group">
							<label for="hire_time_lunch" class="form-label">Time lunch required?</label>
							<input type="text" name="hire_time_lunch" id="hire_time_lunch" value="<?php echo $time_lunch; ?>">
						</div>
					</div>
				</div>

				<div class="hire-form__bottom">
					<a href="<?php echo get_permalink(); ?>?step=3" class="hire-form__back"><?php echo ith_the_icon( 'arrow-left' ); ?>event details</a>

					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php elseif ( $step == 5 ): ?>
			<form action="<?php echo get_permalink(); ?>?step=6" method="post" class="hire-form hire-form--step-5">
				<div class="hire-form__row">
					<div class="hire-form__col">
						<h3 class="hire-form__title">Details of person booking</h3>

						<div class="form-group">
							<label for="hire_booking_name" class="form-label">Name</label>
							<input type="text" name="hire_booking_name" id="hire_booking_name" value="<?php echo $booking_name; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_organisation" class="form-label">Organisation</label>
							<input type="text" name="hire_booking_organisation" id="hire_booking_organisation" value="<?php echo $booking_organisation; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_street" class="form-label">Street</label>
							<input type="text" name="hire_booking_street" id="hire_booking_street" value="<?php echo $booking_street; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_area" class="form-label">Area</label>
							<input type="text" name="hire_booking_area" id="hire_booking_area" value="<?php echo $booking_area; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_zip" class="form-label">Postcode</label>
							<input type="text" name="hire_booking_zip" id="hire_booking_zip" value="<?php echo $booking_zip; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_phone" class="form-label">Telephone Number</label>
							<input type="tel" name="hire_booking_phone" id="hire_booking_phone" value="<?php echo $booking_phone; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_mobile" class="form-label">Mobile Number</label>
							<input type="tel" name="hire_booking_mobile" id="hire_booking_mobile" value="<?php echo $booking_mobile; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_email" class="form-label">Email</label>
							<input type="email" name="hire_booking_email" id="hire_booking_email" value="<?php echo $booking_email; ?>">
						</div>

						<div class="form-group">
							<label for="hire_booking_charity_number" class="form-label">Charity Number (Required to be applicable for 25% discount will not apply to catering)</label>
							<input type="text" name="hire_booking_charity_number" id="hire_booking_charity_number" value="<?php echo $booking_charity_number; ?>">
						</div>

					</div>

					<div class="hire-form__col">
						<h3 class="hire-form__title">Details of person paying invoice</h3>

						<div class="form-group">
							<label for="hire_paying_name" class="form-label">Name</label>
							<input type="text" name="hire_paying_name" id="hire_paying_name" value="<?php echo $paying_name; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_organisation" class="form-label">Organisation</label>
							<input type="text" name="hire_paying_organisation" id="hire_paying_organisation" value="<?php echo $paying_organisation; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_street" class="form-label">Street</label>
							<input type="text" name="hire_paying_street" id="hire_paying_street" value="<?php echo $paying_street; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_area" class="form-label">Area</label>
							<input type="text" name="hire_paying_area" id="hire_paying_area" value="<?php echo $paying_area; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_zip" class="form-label">Postcode</label>
							<input type="text" name="hire_paying_zip" id="hire_paying_zip" value="<?php echo $paying_zip; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_phone" class="form-label">Telephone Number</label>
							<input type="tel" name="hire_paying_phone" id="hire_paying_phone" value="<?php echo $paying_phone; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_mobile" class="form-label">Mobile Number</label>
							<input type="tel" name="hire_paying_mobile" id="hire_paying_mobile" value="<?php echo $paying_mobile; ?>">
						</div>

						<div class="form-group">
							<label for="hire_paying_email" class="form-label">Email</label>
							<input type="email" name="hire_paying_email" id="hire_paying_email" value="<?php echo $paying_email; ?>">
						</div>
					</div>
				</div>

				<div class="hire-form__bottom">
					<a href="<?php echo get_permalink(); ?>?step=4" class="hire-form__back"><?php echo ith_the_icon( 'arrow-left' ); ?>Catering</a>

					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php elseif ( $step == 6 ): ?>
			<form action="<?php echo get_permalink(); ?>?step=6" method="post" class="hire-form hire-form--step-6">
				<h3 class="hire-form__title">Important</h3>

				<div class="form-group">
					<?php echo $important_text; ?>
				</div>

				<div class="form-group">
					<div class="hire-form__checkboxes">
						<label class="check">
							<input type="checkbox" name="hire_statemant" class="check__input" value="1" required>
							<span class="check__box">I agree to the above statement</span>
						</label>
					</div>
				</div>

				<div class="hire-form__bottom">
					<a href="<?php echo get_permalink(); ?>?step=5" class="hire-form__back"><?php echo ith_the_icon( 'arrow-left' ); ?>person details</a>

					<button type="submit" class="btn">Next</button>
				</div>
			</form>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
