<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<?php
$page_background_type = get_field( 'page_background_type' );
$body_class = '';

if ( $page_background_type == 'inherit' ) {
	$body_class = 'no-bg';
}
?>

<body <?php body_class( $body_class ); ?>>

	<div class="wrapper">
		<header class="header">
			<div class="container">
				<div class="header__wrap">

					<a href="<?php echo home_url( '/' ); ?>" class="logo header__logo">
						<img src="<?php echo THEME_URL; ?>/images/general/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" width="94">
					</a>

					<nav class="nav header__nav">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'nav-list',
							'menu_id'         => '',
						) );
						?>
					</nav>

					<div class="widget-cart header__widget-cart">
						<a href="#" class="widget-cart__toggle">
							<div class="widget-cart__cart">
								<?php ith_the_icon( 'cart', 'widget-cart__cart-icon' ); ?>
								<span class="widget-cart__cart-count">1</span>
							</div>
						</a>

						<div class="widget-cart__body">
							<div class="widget-cart__body-top">
								<div class="widget-cart__cart">
									<?php ith_the_icon( 'cart', 'widget-cart__cart-icon' ); ?>
									<span class="widget-cart__cart-count">1</span>
								</div>

								<a href="#" class="widget-cart__close"></a>
							</div>

							<h4 class="widget-cart__title">Donation Basket</h4>

							<div class="widget-cart__total-wrap">
								<div class="widget-cart__total-text">Your Donation</div>
								<div class="widget-cart__total">£<span>2100</span></div>
							</div>

							<ul class="widget-cart-items">
								<li class="widget-cart-items__item">
									<div class="widget-cart-items__name">Donation</div>
									<div class="widget-cart-items__period">Monthly</div>
									<div class="widget-cart-items__price">£2100</div>
									<a href="#" class="widget-cart-items__remove">Remove</a>
								</li>
							</ul>

							<div class="widget-cart__body-bottom">
								<a href="#" class="btn btn--light">Checkout</a>
							</div>
						</div>
					</div>

					<?php $donate_btn_class = '';
					if ( is_home() || is_front_page() ) {
						$donate_btn_class = 'btn--lighten';
					} elseif ( is_page_template( 'templates/tpl-mosque.php' ) ) {
						$donate_btn_class = 'btn--lighten';
					}
					?>
					<a href="<?php echo home_url( 'donate' ); ?>" class="btn header__btn-donate <?php echo $donate_btn_class; ?>">Donate</a>

					<button type="button" class="nav-toggle">
						<span class="nav-toggle__line"></span>
					</button>

				</div>
			</div>
		</header><!-- /.header-->

		<div class="mobile-menu">
			<div class="container">
				<div class="mobile-menu__wrap">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'nav-list',
						'menu_id'         => '',
					) );
					?>

					<div class="mobile-menu__bottom">
						<a href="#" class="btn btn--lighten mobile-menu__btn-donate">Donate</a>
					</div>
				</div>
			</div>
		</div>

		<div class="content">