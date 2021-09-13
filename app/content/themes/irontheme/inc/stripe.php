<?php
require_once get_template_directory() . '/inc/libs/stripe/init.php';

$stripe_pk = 'pk_test_51JXoKCG3CZkpXfTwJRAQvg3BVJxhyPRTePgRGms0tCrpFTVtEE8HAgRzqSJw3X8AvLdFO3tC2o5vGRrT5semutri00oA9Gj8fY';
$stripe_sk = 'sk_test_51JXoKCG3CZkpXfTw2SQmmhmrnK049DN1VIVVCHBA3cVW5NpauqsxrDfIBD94sbSBI36MAxnI26mgn7JETukqCo4H00AbHr4JvK';

\Stripe\Stripe::setApiKey($stripe_sk);

function enqueue_script() {
	global $stripe_pk;
	wp_localize_script( 'ith-donate', 'stripe_keys',
		array(
			'public' => $stripe_pk
		)
	);
}

add_action( 'wp_enqueue_scripts', 'enqueue_script', 99 );

function submit_donation() {
	$form_fields = isset( $_SESSION['checkout_fields'] ) ? $_SESSION['checkout_fields'] : [];

	if ( ! $form_fields ) {
		wp_send_json_error( 'Undefined donation' );
	}

	$result = stripe_submit_donation($form_fields, $_POST['token']);

	// Return only success result. It will break when fail
	echo json_encode($result);

//	die();

	// Mark Donation as Paid
//	$this->wpdb->update($this->table('donation_orders'), [
//		'paid' => 1,
//		'stripe_customer_id' => $result['customer_id'],
//	], ['id' => $donation_order->id]);


	$to = $form_fields['email'];
	$subject = 'Thank you for your Donation.';
	$body = get_field('email_confirmation','options');
	$headers = array('Content-Type: text/html; charset=UTF-8');

	wp_mail( $to, $subject, $body, $headers );

	die();
}
add_action('wp_ajax_submit_donation', 'submit_donation');
add_action('wp_ajax_nopriv_submit_donation', 'submit_donation');

function stripe_submit_donation($donation_order, $stripe_token = null) {
	$basket = get_basket_items();
	$general_metadata = stripe_get_metadata_array($donation_order);
	$customer = null;
	$customer_id = null;

	try {
		$list = \Stripe\Customer::all([
			'email' => $donation_order['email'],
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

	}

	if ( ! $customer_id ) {
		try {
			$customer = \Stripe\Customer::create([
				'source' => $stripe_token,
				'email' => $donation_order['email'],
				'name' => $donation_order['first_name'].' '.$donation_order['last_name'],
				'address' => [
					'line1' => $donation_order['address_1'],
					'line2' => $donation_order['address_2'],
					'city' => $donation_order['city'],
					'country' => $donation_order['country'],
					'postal_code' => $donation_order['zip'],
				],
				'metadata' => $general_metadata,
			]);

			$card_id = $customer['default_source'];

			\Stripe\Customer::updateSource(
				$customer->id,
				$card_id,
				[
					"address_city"  => $donation_order['city'],
					"address_country" => $donation_order['country'],
					"address_line1" => $donation_order['address_1'],
					"address_line2" => $donation_order['address_2'],
					"address_zip" => $donation_order['zip'],
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

	$charges = stripe_execute_charges($customer, $basket, $donation_order, $general_metadata);

	$result = array(
		'res' => true,
		'customer_id' => $customer->id,

	);

	unset( $_SESSION['checkout_fields'] );

	return $result;
}

function stripe_get_metadata_array($user_info, $additional = array(), $donation_order = array()) {

	$general_metadata = array(
		'title' => $user_info['title'],
		'first_name' => $user_info['first_name'],
		'last_name' => $user_info['last_name'],
		'address_country' => $user_info['country'],
		'address_town' => $user_info['city'],
		'address_street' => $user_info['address_1'],
		'address_house' => $user_info['address_2'],
		'address_postcode' => $user_info['zip'],
//		'source' => 'One Ummah website',
		'gift_aid' => (isset($user_info['gift_aid']) && $user_info['gift_aid'] == 1) ? 'Yes' : 'No',
		'email_contact' => ($user_info['updates_via_email'] == 1) ? 'Yes' : 'No',
		'post_contact' => ($user_info['updates_via_post'] == 1) ? 'Yes' : 'No',
		'notes' => $user_info['notes']
	);

	return array_merge($general_metadata, $additional);
}

function stripe_execute_charges($customer, $basket, $form_data, $general_metadata) {

	$stripe_plan_default = get_field( 'stripe_plan_default', 'option' );
	$i = 0;
	foreach ($basket as $bakset_item) { $i++;
		$item = array();

		if($bakset_item['type']=='once') {

			$description = $bakset_item['title'];

			$metadata = array(
				'type' => 'one-time'
			);

			if(isset($form_data['gift_aid']) && $form_data['gift_aid']==1) {
				$description .= ' | Gift Aid';
			}

			$metadata = array_merge($general_metadata,$metadata);

			try {
				$amount = ceil(intval($bakset_item['amount'])*100);
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
					'description' => $description,
					'customer' => $customer->id,
					"metadata" => $metadata,
				]);
			} catch(\Stripe\Exception\CardException $e) {
				echo json_encode([
					'res' => fasle,
					'message' => $e->getError()->message,
					'error' => $e->getJsonBody(),
				]);
				die();
			}

		} else {

			$appeal_id = $bakset_item['item_id'];

			if ( ! is_numeric( $appeal_id ) ) {
				$item['plan_id'] = $stripe_plan_default;
				$plan_id = $stripe_plan_default;
			} else {
				$plan_id = get_field( 'appeals_details', $appeal_id )['stripe_plan_id'];
				if ( $plan_id == '' ) {
					$plan_id = $stripe_plan_default;
				}
			}

			$metadata = array(
				'type' => 'monthly',
				'appeal_id' => $appeal_id,
				'appeal_name' => $bakset_item['title'],
			);

			$metadata = array_merge($general_metadata,$metadata);

			$amount = ceil(intval($bakset_item['amount']));
			if($amount < 1) {
				echo json_encode([
					'res' => fasle,
					'message' => 'Error with amount',
				]);
				die();
			}


			$subscription = \Stripe\Subscription::create([
				'customer' => $customer->id,
				'items' => array(
					Array(
						'plan' => $plan_id,
						'quantity' => $amount,
					)
				),
				'metadata' => $metadata,
			]);

		}

	}
}