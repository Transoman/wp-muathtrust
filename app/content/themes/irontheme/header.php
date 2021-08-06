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

<body <?php body_class(); ?>>

	<div class="wrapper">
		<header class="header">
			<div class="container">

				<nav class="nav">
					<button type="button" class="nav__close"></button>
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

				<div class="nav-overlay"></div>

				<button type="button" class="nav-toggle">
					<span class="nav-toggle__line"></span>
				</button>

			</div>
		</header><!-- /.header-->

		<div class="content">