<?php
add_filter( 'acf/settings/save_json', 'ith_acf_json_save_point' );
function ith_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/inc/acf-json';

	// return
	return $path;
}

add_filter( 'acf/settings/load_json', 'ith_acf_json_load_point' );
function ith_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );
	// append path
	$paths[] = get_stylesheet_directory() . '/inc/acf-json';

	// return
	return $paths;
}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

	acf_add_options_page( array(
		'page_title' => 'Services',
		'menu_title' => 'Services',
		'menu_slug'  => 'services',
		'capability' => 'edit_posts',
		'position'   => '9',
		'icon_url'   => '',
		'redirect'   => false
	) );
}