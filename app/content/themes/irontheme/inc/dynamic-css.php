<?php
$header_style = get_field( 'header_style' );
$header_background_color = get_field( 'header_background_color' );
$header_font_color = get_field( 'header_font_color' );

$page_background_type = get_field( 'page_background_type' );
$page_background_color = get_field( 'page_background_color' );

ob_start();

if ( $page_background_color && $page_background_type != 'inherit' ) {
	echo 'body {
		background-color: ' . $page_background_color . '
	}';
}

if ( $header_background_color && $header_style != 'inherit' ) {
	echo '.header {
		background-color: ' . $header_background_color . '
	}';
}

if ( $header_font_color && $header_style != 'inherit' ) {
	echo '.header .nav-list a {
		color: ' . $header_font_color . '
	}
	.header .nav-list a::after {
		background-color: ' . $header_font_color . '
	}
	.header .nav-list a:hover,
	.header .nav-list a:focus {
		color: ' . $header_font_color . '
	}
	body:not(.menu-open) .widget-cart__toggle .widget-cart__cart {
		color: ' . $header_font_color . '
	}
	.nav-toggle:not(.is-active) .nav-toggle__line {
		background-color: ' . $header_font_color . '
	}
	.nav-toggle:not(.is-active) .nav-toggle__line::after,
	.nav-toggle:not(.is-active) .nav-toggle__line::before {
		background-color: ' . $header_font_color . '
	}
	';
}

$dynamic_style = ob_get_clean();

wp_add_inline_style( 'ith-style', $dynamic_style );
