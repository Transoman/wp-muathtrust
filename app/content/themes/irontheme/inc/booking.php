<?php
function booking_insert() {
	$form_fields = $_SESSION['hire_fields'];

	if ( is_countable( $form_fields ) ) {

		$post_data = array(
			'post_type'     => 'booking',
			'post_status'   => 'publish',
			'post_author'   => 1,
		);

		$post_id = wp_insert_post( $post_data );

		if( is_wp_error($post_id) ){
			echo $post_id->get_error_message();
		}
		else {
			wp_update_post( [
				'ID' => $post_id,
				'post_title' => 'Order #' . $post_id,
			] );

			update_field( 'accommodation', $form_fields['accommodation'], $post_id );
			update_field( 'title_event', $form_fields['title_event'], $post_id );
			update_field( 'day', $form_fields['day'], $post_id );
			update_field( 'date_day', $form_fields['date']['day'], $post_id );
			update_field( 'date_month', $form_fields['date']['month'], $post_id );
			update_field( 'date_year', $form_fields['date']['year'], $post_id );
			update_field( 'start_time', $form_fields['start_time'], $post_id );
			update_field( 'end_time', $form_fields['end_time'], $post_id );
			update_field( 'delegate_numbers', $form_fields['delegate_numbers'], $post_id );
			update_field( 'landmarks', $form_fields['landmarks'], $post_id );
			update_field( 'equipment', $form_fields['equipment'], $post_id );
			update_field( 'speaker', $form_fields['speaker'], $post_id );
			update_field( 'aim_objective_event', $form_fields['aim_objective_event'], $post_id );
			update_field( 'attendees', $form_fields['attendees'], $post_id );
			update_field( 'organisation_event', $form_fields['organisation_event'], $post_id );
			update_field( 'distributing_literature', $form_fields['distributing_literature'], $post_id );
			update_field( 'timecoffee_break_1', $form_fields['timecoffee']['break_1'], $post_id );
			update_field( 'timecoffee_break_2', $form_fields['timecoffee']['break_2'], $post_id );
			update_field( 'timecoffee_break_3', $form_fields['timecoffee']['break_3'], $post_id );
			update_field( 'timewater_break_1', $form_fields['timewater']['break_1'], $post_id );
			update_field( 'timewater_break_2', $form_fields['timewater']['break_2'], $post_id );
			update_field( 'timewater_break_3', $form_fields['timewater']['break_3'], $post_id );
			update_field( 'numbers_lunch', $form_fields['numbers_lunch'], $post_id );
			update_field( 'time_lunch', $form_fields['time_lunch'], $post_id );

			update_field( 'booking_info_booking_name', $form_fields['booking_name'], $post_id );
			update_field( 'booking_info_booking_organisation', $form_fields['booking_organisation'], $post_id );
			update_field( 'booking_info_booking_street', $form_fields['booking_street'], $post_id );
			update_field( 'booking_info_booking_area', $form_fields['booking_area'], $post_id );
			update_field( 'booking_info_booking_zip', $form_fields['booking_zip'], $post_id );
			update_field( 'booking_info_booking_phone', $form_fields['booking_phone'], $post_id );
			update_field( 'booking_info_booking_mobile', $form_fields['booking_mobile'], $post_id );
			update_field( 'booking_info_booking_email', $form_fields['booking_email'], $post_id );
			update_field( 'booking_info_booking_charity_number', $form_fields['booking_charity_number'], $post_id );

			update_field( 'paying_info_paying_name', $form_fields['paying_name'], $post_id );
			update_field( 'paying_info_paying_organisation', $form_fields['paying_organisation'], $post_id );
			update_field( 'paying_info_paying_street', $form_fields['paying_street'], $post_id );
			update_field( 'paying_info_paying_area', $form_fields['paying_area'], $post_id );
			update_field( 'paying_info_paying_zip', $form_fields['paying_zip'], $post_id );
			update_field( 'paying_info_paying_phone', $form_fields['paying_phone'], $post_id );
			update_field( 'paying_info_paying_mobile', $form_fields['paying_mobile'], $post_id );
			update_field( 'paying_info_paying_email', $form_fields['paying_email'], $post_id );

			// Send to admin email
			if ( booking_send_email_admin() ) {
				unset( $_SESSION['hire_fields'] );

				wp_send_json_success( '<h3>Thank you!</h3><p>Your message has been successfully sent. We will contact you very soon!</p>' );
			}
		}
	}

	wp_die();
}

add_action('wp_ajax_booking_insert', 'booking_insert');
add_action('wp_ajax_nopriv_booking_insert', 'booking_insert');

function booking_send_email_admin() {
	$form_fields = $_SESSION['hire_fields'];

	$headers = array(
		'From: ' . $form_fields['booking_name'] . ' <' . $form_fields['booking_email'] . '>',
		'content-type: text/html',
	);
	$to = get_bloginfo( 'admin_email' );
	$subject = 'Muath Trust Enquiry Form';
	$message = '<p><strong>Room:</strong> ' . $form_fields['accommodation'] . '</p>' . PHP_EOL;

	$message .= '<h3>Room requirements</h3>' . PHP_EOL;
	$message .= '<p><strong>Title of Event:</strong> ' . $form_fields['title_event'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Day:</strong> ' . $form_fields['day'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Date:</strong> ' . implode( ' ', $form_fields['date'] ) . '</p>' . PHP_EOL;
	$message .= '<p><strong>Start time:</strong> ' . $form_fields['start_time'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>End time:</strong> ' . $form_fields['end_time'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Delegate Numbers:</strong> ' . $form_fields['delegate_numbers'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Layout Required:</strong> ' . implode( ', ', $form_fields['landmarks'] ) . '</p>' . PHP_EOL;

	$message .= '<h3>Audio/ Visual Equipment</h3>' . PHP_EOL;
	$message .= '<p><strong>Layout Required:</strong> ' . implode( ', ', $form_fields['equipment'] ) . '</p>' . PHP_EOL;

	$message .= '<h3>Event details</h3>' . PHP_EOL;
	$message .= '<p><strong>Who will your speakers be?:</strong> ' . $form_fields['speaker'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>What is the aim/objective of your event?:</strong> ' . $form_fields['aim_objective_event'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Who will your attendees be?:</strong> ' . $form_fields['attendees'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Any other organisation involved in the event?:</strong> ' . $form_fields['organisation_event'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Will you be distributing literature at the event?:</strong> ' . $form_fields['distributing_literature'] . '</p>' . PHP_EOL;

	$message .= '<h3>Refreshments</h3>' . PHP_EOL;
	$message .= '<h4>Time Coffee/ Tea & Biscuits required:</h4>' . PHP_EOL;
	$message .= '<p><strong>Break 1:</strong> ' . $form_fields['timecoffee']['break_1'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Break 2:</strong> ' . $form_fields['timecoffee']['break_2'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Break 3:</strong> ' . $form_fields['timecoffee']['break_3'] . '</p>' . PHP_EOL;

	$message .= '<h4>Times water & juice required:</h4>' . PHP_EOL;
	$message .= '<p><strong>Break 1:</strong> ' . $form_fields['timewater']['break_1'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Break 2:</strong> ' . $form_fields['timewater']['break_2'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Break 3:</strong> ' . $form_fields['timewater']['break_3'] . '</p>' . PHP_EOL;

	$message .= '<h3>Refreshments</h3>' . PHP_EOL;
	$message .= '<p><strong>Delegate numbers lunch required?:</strong> ' . $form_fields['numbers_lunch'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Time lunch required?:</strong> ' . $form_fields['time_lunch'] . '</p>' . PHP_EOL;

	$message .= '<h3>Details of person booking</h3>' . PHP_EOL;
	$message .= '<p><strong>Name:</strong> ' . $form_fields['booking_name'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Organisation:</strong> ' . $form_fields['booking_organisation'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Street:</strong> ' . $form_fields['booking_street'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Area:</strong> ' . $form_fields['booking_area'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Postcode:</strong> ' . $form_fields['booking_zip'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Telephone Number:</strong> ' . $form_fields['booking_phone'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Mobile Number:</strong> ' . $form_fields['booking_mobile'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Email:</strong> ' . $form_fields['booking_email'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Charity Number (Required to be applicable for 25% discount will not apply to catering):</strong> ' . $form_fields['booking_charity_number'] . '</p>' . PHP_EOL;

	$message .= '<h3>Details of person paying invoice</h3>' . PHP_EOL;
	$message .= '<p><strong>Name:</strong> ' . $form_fields['paying_name'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Organisation:</strong> ' . $form_fields['paying_organisation'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Street:</strong> ' . $form_fields['paying_street'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Area:</strong> ' . $form_fields['paying_area'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Postcode:</strong> ' . $form_fields['paying_zip'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Telephone Number:</strong> ' . $form_fields['paying_phone'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Mobile Number:</strong> ' . $form_fields['paying_mobile'] . '</p>' . PHP_EOL;
	$message .= '<p><strong>Email:</strong> ' . $form_fields['paying_email'] . '</p>' . PHP_EOL;

	return wp_mail( $to, $subject, $message, $headers );
}

add_filter('acf/load_field/name=landmarks', 'landmarks_acf_load_field', 10, 3);

function landmarks_acf_load_field( $field ) {
	$field['choices'] = array();

	$landmarks = get_post_meta( get_the_ID(), 'landmarks', true );

	if ( $landmarks ) {
		foreach ( $landmarks as $landmark ) {
			$field['choices'][ $landmark ] = $landmark;
		}
	}

	return $field;
}

add_filter('acf/load_field/name=equipment', 'equipment_acf_load_field', 10, 3);

function equipment_acf_load_field( $field ) {
	$field['choices'] = array();

	$equipments = get_post_meta( get_the_ID(), 'equipment', true );

	if ( $equipments ) {
		foreach ( $equipments as $equipment ) {
			$field['choices'][ $equipment ] = $equipment;
		}
	}

	return $field;
}