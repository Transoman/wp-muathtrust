<?php
// Register Custom Taxonomy
function event_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', TEXTDOMAIN ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', TEXTDOMAIN ),
		'menu_name'                  => __( 'Categories', TEXTDOMAIN )
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event_category', array( 'event' ), $args );

}
add_action( 'init', 'event_category_taxonomy', 0 );

function accommodation_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', TEXTDOMAIN ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', TEXTDOMAIN ),
		'menu_name'                  => __( 'Categories', TEXTDOMAIN )
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'accommodation_category', array( 'accommodation' ), $args );

}
add_action( 'init', 'accommodation_category_taxonomy', 0 );