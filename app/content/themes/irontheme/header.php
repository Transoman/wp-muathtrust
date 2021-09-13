<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo THEME_URL; ?>/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_URL; ?>/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_URL; ?>/images/favicon/favicon-16x16.png">
	<link rel="mask-icon" href="<?php echo THEME_URL; ?>/images/favicon/safari-pinned-tab.svg" color="#1c3e9a">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#1c3e9a">
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<?php
$page_background_type = get_field( 'page_background_type' );
$page_background_color = get_field( 'page_background_color' );
$body_class = '';
$header_style = '';

if ( $page_background_type == 'inherit' ) {
	$body_class = 'no-bg';
} elseif ( $page_background_type !== 'inherit' && $page_background_color ) {
	$header_style = ' style="background-color: ' . $page_background_color . '"';
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
								<span class="widget-cart__cart-count"><?php echo get_basket_items_count(); ?></span>
							</div>
						</a>

						<?php get_template_part( 'template-parts/widget-cart' ); ?>
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