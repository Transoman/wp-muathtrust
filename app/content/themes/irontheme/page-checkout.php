<?php get_header();

$page_title = get_field( 'checkout_title' );
$page_text = get_field( 'checkout_text' );
$bg_image = get_field( 'checkout_background_image' );

$step = isset($_GET['step']) ? $_GET['step'] : '';
$form_url = get_permalink();
$countries = [
	'Afghanistan',
	'Albania',
	'Algeria',
	'Andorra',
	'Angola',
	'Antigua and Barbuda',
	'Argentina',
	'Armenia',
	'Australia',
	'Austria',
	'Azerbaijan',
	'The Bahamas',
	'Bahrain',
	'Bangladesh',
	'Barbados',
	'Belarus',
	'Belgium',
	'Belize',
	'Benin',
	'Bhutan',
	'Bolivia',
	'Bosnia and Herzegovina',
	'Botswana',
	'Brazil',
	'Brunei',
	'Bulgaria',
	'Burkina Faso',
	'Burundi',
	'Cabo Verde',
	'Cambodia',
	'Cameroon',
	'Canada',
	'Central African Republic',
	'Chad',
	'Chile',
	'China',
	'Colombia',
	'Comoros',
	'Congo, Democratic Republic of the',
	'Congo, Republic of the',
	'Costa Rica',
	'Côte d’Ivoire',
	'Croatia',
	'Cuba',
	'Cyprus',
	'Czech Republic',
	'Denmark',
	'Djibouti',
	'Dominica',
	'Dominican Republic',
	'East Timor (Timor-Leste)',
	'Ecuador',
	'Egypt',
	'El Salvador',
	'Equatorial Guinea',
	'Eritrea',
	'Estonia',
	'Eswatini',
	'Ethiopia',
	'Fiji',
	'Finland',
	'France',
	'Gabon',
	'The Gambia',
	'Georgia',
	'Germany',
	'Ghana',
	'Greece',
	'Grenada',
	'Guatemala',
	'Guinea',
	'Guinea-Bissau',
	'Guyana',
	'Haiti',
	'Honduras',
	'Hungary',
	'Iceland',
	'India',
	'Indonesia',
	'Iran',
	'Iraq',
	'Ireland',
	'Israel',
	'Italy',
	'Jamaica',
	'Japan',
	'Jordan',
	'Kazakhstan',
	'Kenya',
	'Kiribati',
	'Korea, North',
	'Korea, South',
	'Kosovo',
	'Kuwait',
	'Kyrgyzstan',
	'Laos',
	'Latvia',
	'Lebanon',
	'Lesotho',
	'Liberia',
	'Libya',
	'Liechtenstein',
	'Lithuania',
	'Luxembourg',
	'Madagascar',
	'Malawi',
	'Malaysia',
	'Maldives',
	'Mali',
	'Malta',
	'Marshall Islands',
	'Mauritania',
	'Mauritius',
	'Mexico',
	'Micronesia, Federated States of',
	'Moldova',
	'Monaco',
	'Mongolia',
	'Montenegro',
	'Morocco',
	'Mozambique',
	'Myanmar (Burma)',
	'Namibia',
	'Nauru',
	'Nepal',
	'Netherlands',
	'New Zealand',
	'Nicaragua',
	'Niger',
	'Nigeria',
	'North Macedonia',
	'Norway',
	'Oman',
	'Pakistan',
	'Palau',
	'Panama',
	'Papua New Guinea',
	'Paraguay',
	'Peru',
	'Philippines',
	'Poland',
	'Portugal',
	'Qatar',
	'Romania',
	'Russia',
	'Rwanda',
	'Saint Kitts and Nevis',
	'Saint Lucia',
	'Saint Vincent and the Grenadines',
	'Samoa',
	'San Marino',
	'Sao Tome and Principe',
	'Saudi Arabia',
	'Senegal',
	'Serbia',
	'Seychelles',
	'Sierra Leone',
	'Singapore',
	'Slovakia',
	'Slovenia',
	'Solomon Islands',
	'Somalia',
	'South Africa',
	'Spain',
	'Sri Lanka',
	'Sudan',
	'Sudan, South',
	'Suriname',
	'Sweden',
	'Switzerland',
	'Syria',
	'Taiwan',
	'Tajikistan',
	'Tanzania',
	'Thailand',
	'Togo',
	'Tonga',
	'Trinidad and Tobago',
	'Tunisia',
	'Turkey',
	'Turkmenistan',
	'Tuvalu',
	'Uganda',
	'Ukraine',
	'United Arab Emirates',
	'United Kingdom',
	'United States',
	'Uruguay',
	'Uzbekistan',
	'Vanuatu',
	'Vatican City',
	'Venezuela',
	'Vietnam',
	'Yemen',
	'Zambia',
	'Zimbabwe',
];

if ( $step == '' || $step == 1 ) {
	$form_url .= '?step=2';
} elseif ( $step == 2 ) {
	$form_url = home_url( 'confirm' );
}

if ( count($_POST) > 0 ) {
	if ( isset( $_POST['amount'] ) ) {
		$_SESSION['checkout_fields']['amount'] = sanitize_text_field( $_POST['amount'] );
	}

	if ( isset( $_POST['category'] ) ) {
		$_SESSION['checkout_fields']['category'] = sanitize_text_field( $_POST['category'] );
	}

	if ( isset( $_POST['notes'] ) ) {
		$_SESSION['checkout_fields']['notes'] = sanitize_text_field( $_POST['notes'] );
	}

	if ( isset( $_POST['title'] ) ) {
		$_SESSION['checkout_fields']['title'] = sanitize_text_field( $_POST['title'] );
	}

	if ( isset( $_POST['first_name'] ) ) {
		$_SESSION['checkout_fields']['first_name'] = sanitize_text_field( $_POST['first_name'] );
	}

	if ( isset( $_POST['last_name'] ) ) {
		$_SESSION['checkout_fields']['last_name'] = sanitize_text_field( $_POST['last_name'] );
	}

	if ( isset( $_POST['email'] ) ) {
		$_SESSION['checkout_fields']['email'] = sanitize_email( $_POST['email'] );
	}

	if ( isset( $_POST['address_1'] ) ) {
		$_SESSION['checkout_fields']['address_1'] = sanitize_text_field( $_POST['address_1'] );
	}

	if ( isset( $_POST['address_2'] ) ) {
		$_SESSION['checkout_fields']['address_2'] = sanitize_text_field( $_POST['address_2'] );
	}

	if ( isset( $_POST['city'] ) ) {
		$_SESSION['checkout_fields']['city'] = sanitize_text_field( $_POST['city'] );
	}

	if ( isset( $_POST['zip'] ) ) {
		$_SESSION['checkout_fields']['zip'] = sanitize_text_field( $_POST['zip'] );
	}

	if ( isset( $_POST['country'] ) ) {
		$_SESSION['checkout_fields']['country'] = sanitize_text_field( $_POST['country'] );
	}

	if ( isset( $_POST['gift_aid'] ) ) {
		$_SESSION['checkout_fields']['gift_aid'] = sanitize_text_field( $_POST['gift_aid'] );
	}

	if ( isset( $_POST['updates_via_email'] ) ) {
		$_SESSION['checkout_fields']['updates_via_email'] = sanitize_text_field( $_POST['updates_via_email'] );
	}

	if ( isset( $_POST['updates_via_post'] ) ) {
		$_SESSION['checkout_fields']['updates_via_post'] = sanitize_text_field( $_POST['updates_via_post'] );
	}
}

$amount = isset($_SESSION['checkout_fields']['amount']) ? $_SESSION['checkout_fields']['amount'] : '';
$category = isset($_SESSION['checkout_fields']['category']) ? $_SESSION['checkout_fields']['category'] : '';
$notes = isset($_SESSION['checkout_fields']['notes']) ? $_SESSION['checkout_fields']['notes'] : '';
$title = isset($_SESSION['checkout_fields']['title']) ? $_SESSION['checkout_fields']['title'] : '';
$first_name = isset($_SESSION['checkout_fields']['first_name']) ? $_SESSION['checkout_fields']['first_name'] : '';
$last_name = isset($_SESSION['checkout_fields']['last_name']) ? $_SESSION['checkout_fields']['last_name'] : '';
$last_name = isset($_SESSION['checkout_fields']['last_name']) ? $_SESSION['checkout_fields']['last_name'] : '';
$email = isset($_SESSION['checkout_fields']['email']) ? $_SESSION['checkout_fields']['email'] : '';
$address_1 = isset($_SESSION['checkout_fields']['address_1']) ? $_SESSION['checkout_fields']['address_1'] : '';
$address_2 = isset($_SESSION['checkout_fields']['address_2']) ? $_SESSION['checkout_fields']['address_2'] : '';
$city = isset($_SESSION['checkout_fields']['city']) ? $_SESSION['checkout_fields']['city'] : '';
$zip = isset($_SESSION['checkout_fields']['zip']) ? $_SESSION['checkout_fields']['zip'] : '';
$country = isset($_SESSION['checkout_fields']['country']) ? $_SESSION['checkout_fields']['country'] : '';
$gift_aid = isset($_SESSION['checkout_fields']['gift_aid']) ? $_SESSION['checkout_fields']['gift_aid'] : '';
$updates_via_email = isset($_SESSION['checkout_fields']['updates_via_email']) ? $_SESSION['checkout_fields']['updates_via_email'] : '';
$updates_via_post = isset($_SESSION['checkout_fields']['updates_via_post']) ? $_SESSION['checkout_fields']['updates_via_post'] : '';


$basket_items = get_basket_items();

$total = 0;
foreach ( $basket_items as $basket_item ) {
	$total += $basket_item['amount'];
}
?>

<form action="<?php echo $form_url; ?>" method="post" class="checkout-form">
	<section class="checkout" style="background-image: url(<?php echo $bg_image; ?>)">
		<div class="container">
			<div class="checkout__wrap">
				<div class="checkout__left">
					<h3 class="checkout__title"><?php echo $page_title; ?></h3>
					<div class="checkout__text"><?php echo $page_text; ?></div>
				</div>

				<div class="checkout__right">
					<?php if ( $step == '' || $step == 1 ): ?>
						<div class="checkout-form-box checkout-form-box--step-1">
							<div class="form-group">
								<label for="amount" class="form-label">Amount</label>
								<input type="number" name="amount" id="amount" required value="<?php echo $amount; ?>">
							</div>

							<div class="form-group">
								<label for="category" class="form-label">Category</label>
								<?php
								$args = array(
									'post_type' => 'appeals',
									'posts_per_page' => -1
								);

								$appeals = new WP_Query( $args );

								if ( $appeals->have_posts() ):
								?>
									<select name="category" id="category">
										<?php while ( $appeals->have_posts() ): $appeals->the_post();
											$appeals_details = get_field( 'appeals_details' );
										?>
											<option value="<?php echo get_the_ID(); ?>" data-custom-properties='{"price": "<?php echo $appeals_details['price']; ?>", "title": "<?php the_title(); ?>"}' <?php selected( get_the_ID(), $category )?>><?php the_title(); ?></option>
										<?php endwhile; wp_reset_postdata(); ?>
									</select>
								<?php endif; ?>
							</div>

							<div class="form-group">
								<label for="notes" class="form-label">Notes</label>
								<textarea name="notes" id="notes"><?php echo $notes; ?></textarea>
							</div>

							<div class="form-group form-group--last text-center">
								<button type="submit" class="btn">Next</button>
							</div>
						</div>
					<?php elseif ( $step == 2 ): ?>
						<div class="checkout-form-box checkout-form-box--step-2">
							<h3 class="checkout-form__title">Customer details</h3>

							<div class="form-group">
								<label for="title" class="form-label">Title</label>
								<select name="title" id="title">
									<option value="Mr" <?php selected( 'Mr', $title ); ?>>Mr</option>
									<option value="Mrs" <?php selected( 'Mrs', $title ); ?>>Mrs</option>
									<option value="Miss" <?php selected( 'Miss', $title ); ?>>Miss</option>
									<option value="Ms" <?php selected( 'Ms', $title ); ?>>Ms</option>
									<option value="Dr" <?php selected( 'Dr', $title ); ?>>Dr</option>
									<option value="Prof" <?php selected( 'Prof', $title ); ?>>Prof</option>
								</select>
							</div>

							<div class="form-group">
								<label for="first_name" class="form-label">First name <sup>*</sup></label>
								<input type="text" name="first_name" id="first_name" required value="<?php echo $first_name; ?>">
							</div>

							<div class="form-group">
								<label for="last_name" class="form-label">Last name <sup>*</sup></label>
								<input type="text" name="last_name" id="last_name" required value="<?php echo $last_name; ?>">
							</div>

							<div class="form-group">
								<label for="email" class="form-label">Email <sup>*</sup></label>
								<input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
							</div>

							<div class="form-group">
								<label for="address_1" class="form-label">Address 1</label>
								<input type="text" name="address_1" id="address_1" value="<?php echo $address_1; ?>">
							</div>

							<div class="form-group">
								<label for="address_2" class="form-label">Address 2</label>
								<input type="text" name="address_2" id="address_2" value="<?php echo $address_2; ?>">
							</div>

							<div class="form-group">
								<label for="city" class="form-label">City</label>
								<input type="text" name="city" id="city" value="<?php echo $city; ?>">
							</div>

							<div class="form-group">
								<label for="zip" class="form-label">Post Code</label>
								<input type="text" name="zip" id="zip" value="<?php echo $zip; ?>">
							</div>

							<div class="form-group form-group--last">
								<label for="country" class="form-label">Country</label>
								<select name="country" id="country">
									<?php foreach ( $countries as $item_country ): ?>
										<option value="<?php echo $item_country; ?>" <?php selected( $item_country, $country ); ?>><?php echo $item_country; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $step == 2 ): ?>
		<section class="gift-aid">
			<div class="container">
				<div class="gift-aid__wrap">
					<h2 class="section-title text-center">Gift aid</h2>
					<div class="gift-aid__top text-center">
						<h3>Increase the value of your donation by 25%</h3>
						<p>Your donation of £<span class="put_price_current"><?php echo $total; ?></span> will become £<span class="put_price"><?php echo $total*0.25+$total; ?></span> at not extra cost to you. </p>
					</div>

					<div class="gift-aid__body">
						<p>By ticking the box below, you give The Muath Trust permission to claim Gift Aid on this donation and all future donations. You also confirm that you are a UK taxpayer and would like the charity to reclaim tax on all donations you have made within the last four years and all donations that you make hereafter.</p>
						<p>I understand that if I pay less Income Tax and/or Capital Gains Tax than amount of Gift Aid claimed on all my donations in that tax year it is my responsibility to pay any difference. If you want to cancel this declaration, change your name or home address or no longer pay sufficient tax on your income and/or capital gains. </p>

						<label class="circle-check">
							<input type="checkbox" name="gift_aid" value="1" <?php checked( 1, $gift_aid ); ?>>
							<span class="circle-check__box">I agree</span>
						</label>
					</div>
				</div>
			</div>
		</section>

		<section class="save-lives">
			<div class="container">
				<div class="save-lives__wrap">
					<h2 class="section-title blue-color">Save lives by staying in touch</h2>
					<div class="save-lives__text">
						<p>With your permission, The Muath Trust will use this information you provide on this form to be in touch with you and to provide updates and marketing. You can change your mind at any time by clicking the unsubscribe link in the footer og any emails you receive from us.</p>
						<p>Please choose whether you’re happy to be contacted by us via email, post or both:</p>

						<div class="save-lives__checkboxes">
							<label class="circle-check circle-check--white">
								<input type="checkbox" name="updates_via_email" value="1" <?php checked( 1, $updates_via_email ); ?>>
								<span class="circle-check__box">Email</span>
							</label>

							<label class="circle-check circle-check--white">
								<input type="checkbox" name="updates_via_post" value="1" <?php checked( 1, $updates_via_post ); ?>>
								<span class="circle-check__box">Post</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="checkout-form__actions">
			<div class="container">
				<a href="<?php echo get_permalink(); ?>"><?php ith_the_icon( 'arrow-left' ); ?> Category details</a>

				<button type="submit" class="btn">Submit</button>
			</div>
		</div>
	<?php endif; ?>
</form>

<?php get_footer();
