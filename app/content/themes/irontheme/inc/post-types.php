<?php
// Register Custom Post Type
function event_post_type() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', TEXTDOMAIN ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', TEXTDOMAIN ),
		'menu_name'             => __( 'Events', TEXTDOMAIN ),
		'name_admin_bar'        => __( 'Events', TEXTDOMAIN ),
	);
	$rewrite = array(
		'slug'                  => 'events',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Event', TEXTDOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-tickets',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'event', $args );

}
add_action( 'init', 'event_post_type', 0 );

function accommodation_post_type() {

	$labels = array(
		'name'                  => _x( 'Accommodations', 'Post Type General Name', TEXTDOMAIN ),
		'singular_name'         => _x( 'Accommodation', 'Post Type Singular Name', TEXTDOMAIN ),
		'menu_name'             => __( 'Accommodations', TEXTDOMAIN ),
		'name_admin_bar'        => __( 'Accommodations', TEXTDOMAIN ),
	);
	$rewrite = array(
		'slug'                  => 'accommodation',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Accommodation', TEXTDOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-building',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'accommodation', $args );

}
add_action( 'init', 'accommodation_post_type', 0 );

function booking_post_type() {

	$labels = array(
		'name'                  => _x( 'Bookings', 'Post Type General Name', TEXTDOMAIN ),
		'singular_name'         => _x( 'Booking', 'Post Type Singular Name', TEXTDOMAIN ),
		'menu_name'             => __( 'Bookings', TEXTDOMAIN ),
		'name_admin_bar'        => __( 'Bookings', TEXTDOMAIN ),
	);
	$rewrite = array(
		'slug'                  => 'booking',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Booking', TEXTDOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-building',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'booking', $args );

}
add_action( 'init', 'booking_post_type', 0 );

function appeals_post_type() {

	$labels = array(
		'name'                  => _x( 'Appeals', 'Post Type General Name', TEXTDOMAIN ),
		'singular_name'         => _x( 'Appeal', 'Post Type Singular Name', TEXTDOMAIN ),
		'menu_name'             => __( 'Appeals', TEXTDOMAIN ),
		'name_admin_bar'        => __( 'Appeals', TEXTDOMAIN ),
	);
	$rewrite = array(
		'slug'                  => 'appeals',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Appeal', TEXTDOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-money-alt',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'appeals', $args );

}
add_action( 'init', 'appeals_post_type', 0 );