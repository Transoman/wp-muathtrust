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
		'label'                 => __( 'Event', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
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