<?php get_header();

if ( count($_POST) > 0 ) {
	if ( isset( $_POST['title'] ) ) {
		$_SESSION['checkout_fields']['title'] = $_POST['title'];
	} else {
		unset($_SESSION['checkout_fields']['title']);
	}

	if ( isset( $_POST['first_name'] ) ) {
		$_SESSION['checkout_fields']['first_name'] = $_POST['first_name'];
	} else {
		unset($_SESSION['checkout_fields']['first_name']);
	}

	if ( isset( $_POST['last_name'] ) ) {
		$_SESSION['checkout_fields']['last_name'] = $_POST['last_name'];
	} else {
		unset($_SESSION['checkout_fields']['last_name']);
	}

	if ( isset( $_POST['email'] ) ) {
		$_SESSION['checkout_fields']['email'] = $_POST['email'];
	} else {
		unset($_SESSION['checkout_fields']['email']);
	}

	if ( isset( $_POST['address_1'] ) ) {
		$_SESSION['checkout_fields']['address_1'] = $_POST['address_1'];
	} else {
		unset($_SESSION['checkout_fields']['address_1']);
	}

	if ( isset( $_POST['address_2'] ) ) {
		$_SESSION['checkout_fields']['address_2'] = $_POST['address_2'];
	} else {
		unset($_SESSION['checkout_fields']['address_2']);
	}

	if ( isset( $_POST['city'] ) ) {
		$_SESSION['checkout_fields']['city'] = $_POST['city'];
	} else {
		unset($_SESSION['checkout_fields']['city']);
	}

	if ( isset( $_POST['province'] ) ) {
		$_SESSION['checkout_fields']['province'] = $_POST['province'];
	} else {
		unset($_SESSION['checkout_fields']['province']);
	}

	if ( isset( $_POST['zip'] ) ) {
		$_SESSION['checkout_fields']['zip'] = $_POST['zip'];
	} else {
		unset($_SESSION['checkout_fields']['zip']);
	}

	if ( isset( $_POST['country'] ) ) {
		$_SESSION['checkout_fields']['country'] = $_POST['country'];
	} else {
		unset($_SESSION['checkout_fields']['country']);
	}

	if ( isset( $_POST['gift_aid'] ) ) {
		$_SESSION['checkout_fields']['gift_aid'] = $_POST['gift_aid'];
	} else {
		unset($_SESSION['checkout_fields']['gift_aid']);
	}

	if ( isset( $_POST['updates_via_email'] ) ) {
		$_SESSION['checkout_fields']['updates_via_email'] = $_POST['updates_via_email'];
	} else {
		unset($_SESSION['checkout_fields']['updates_via_email']);
	}

	if ( isset( $_POST['updates_via_post'] ) ) {
		$_SESSION['checkout_fields']['updates_via_post'] = $_POST['updates_via_post'];
	} else {
		unset($_SESSION['checkout_fields']['updates_via_post']);
	}
}

$title = isset($_SESSION['checkout_fields']['title']) ? $_SESSION['checkout_fields']['title'] : '';
$first_name = isset($_SESSION['checkout_fields']['first_name']) ? $_SESSION['checkout_fields']['first_name'] : '';
$last_name = isset($_SESSION['checkout_fields']['last_name']) ? $_SESSION['checkout_fields']['last_name'] : '';
$last_name = isset($_SESSION['checkout_fields']['last_name']) ? $_SESSION['checkout_fields']['last_name'] : '';
$email = isset($_SESSION['checkout_fields']['email']) ? $_SESSION['checkout_fields']['email'] : '';
$address_1 = isset($_SESSION['checkout_fields']['address_1']) ? $_SESSION['checkout_fields']['address_1'] : '';
$address_2 = isset($_SESSION['checkout_fields']['address_2']) ? $_SESSION['checkout_fields']['address_2'] : '';
$city = isset($_SESSION['checkout_fields']['city']) ? $_SESSION['checkout_fields']['city'] : '';
$province = isset($_SESSION['checkout_fields']['province']) ? $_SESSION['checkout_fields']['province'] : '';
$zip = isset($_SESSION['checkout_fields']['zip']) ? $_SESSION['checkout_fields']['zip'] : '';
$country = isset($_SESSION['checkout_fields']['country']) ? $_SESSION['checkout_fields']['country'] : '';
$gift_aid = isset($_SESSION['checkout_fields']['gift_aid']) ? $_SESSION['checkout_fields']['gift_aid'] : '';
$updates_via_email = isset($_SESSION['checkout_fields']['updates_via_email']) ? $_SESSION['checkout_fields']['updates_via_email'] : '';
$updates_via_post = isset($_SESSION['checkout_fields']['updates_via_post']) ? $_SESSION['checkout_fields']['updates_via_post'] : '';

$basket_items = get_basket_items();
$count_items = count($basket_items);

if ( $count_items == 0 ) {
	wp_redirect( home_url( 'checkout' ) );
}

$total = 0;
foreach ( $basket_items as $basket_item ) {
	$total += $basket_item['amount'];
}

?>

<section class="confirm">
	<div class="container">
		<div class="confirm__wrap">
			<div class="confirm__left">
				<div class="confirm__total">Your donation so far... <span>£<?php echo $total; ?></span></div>

				<div class="confirm__items">
					<?php foreach ( $basket_items as $item ): ?>
						<div class="confirm__items-item">Donate bread to feed 5,000 people <span>£<?php echo $item['amount']; ?></span></div>
					<?php endforeach; ?>
				</div>

				<div class="confirm__customer">
					<?php if ( $first_name ): ?>
						<div class="confirm__customer-item">
							<span class="confirm__customer-label">First name:</span> <?php echo $first_name; ?>
						</div>
					<?php endif; ?>

					<?php if ( $last_name ): ?>
						<div class="confirm__customer-item">
							<span class="confirm__customer-label">Last name:</span> <?php echo $last_name; ?>
						</div>
					<?php endif; ?>

					<?php if ( $address_1 ): ?>
						<div class="confirm__customer-item">
							<span class="confirm__customer-label">Address:</span> <?php echo $address_1; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="confirm__right">
				<form class="confirm-form checkout-form-box">
					<h3 class="checkout-form__title">Payment details</h3>

					<div class="form-group">
						<label for="card-element" class="form-label">Card Number</label>
						<div id="card-element" class="stripe-field"></div>
						<div class="card-error wpcf7-not-valid-tip"></div>
<!--						<div id="card-number" class="stripe-field"></div>-->
					</div>

<!--					<div class="form-group">-->
<!--						<label for="expiry" class="form-label">Expiry</label>-->
<!--						<div id="expiry" class="stripe-field"></div>-->
<!--					</div>-->
<!---->
<!--					<div class="form-group">-->
<!--						<label for="security-code" class="form-label">Security code</label>-->
<!--						<div id="security-code" class="stripe-field"></div>-->
<!--					</div>-->
<!---->
<!--					<div class="form-group">-->
<!--						<label for="cardholder-name" class="form-label">Cardholder Name</label>-->
<!--						<input type="text" name="cardholder_name" id="cardholder-name" required>-->
<!--					</div>-->

					<div class="form-group form-group--last text-center">
						<button type="submit" class="btn">Pay now</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script>
	// var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
	// var styles = {
	// 	base: {
	// 		iconColor: '#2C2C2C',
	// 		color: '#2C2C2C',
	// 		fontFamily: 'inherit',
	// 		fontSize: '21px',
	// 		fontSmoothing: 'antialiased',
	// 		':-webkit-autofill': {
	// 			color: '#fce883',
	// 		},
	// 		'::placeholder': {
	// 			color: '#C8CBCD',
	// 		},
	// 	},
	// 	invalid: {
	// 		iconColor: '#f00',
	// 		color: '#f00',
	// 	},
	// };
	// var elements = stripe.elements();
	// var cardElement = elements.create('card', {
	// 	style: styles,
	// 	hidePostalCode: true
	// });
	// var card = elements.getElement('card');
	//
	// card.mount('#card-element');

	// var cardNumberElement = elements.create('cardNumber', {
	// 	style: styles
	// });
	// var cardExpiryElement = elements.create('cardExpiry', {
	// 	style: styles
	// });
	// var cardCvcElement = elements.create('cardCvc', {
	// 	style: styles
	// });
	//
	// var cardNumber = elements.getElement('cardNumber');
	// var cardExpiry = elements.getElement('cardExpiry');
	// var cardCvc = elements.getElement('cardCvc');
	//
	// cardNumber.mount('#card-number');
	// cardExpiry.mount('#expiry');
	// cardCvc.mount('#security-code');
	//
	// cardNumberElement.on('change', function(event) {
	// 	if (event.error) {
	// 		console.log(event.error);
	// 	}
	// });
</script>

<?php get_footer();
