<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ith
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function ith_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'ith_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ith_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'ith_pingback_header' );

function get_timetable_line( $class = '' ) {
	get_template_part( 'template-parts/timetable', 'line', array( 'class' => $class ) );
}

function validateDate( $date, $format = 'Y-m-d' ) {
	$d = DateTime::createFromFormat( $format, $date );

	return $d && $d->format( $format ) == $date;
}

add_filter( 'set_screen_option_'.'booking_services_table_per_page', function( $status, $option, $value ){
	return (int) $value;
}, 10, 3 );

function register_menu_page() {
	$hook = add_submenu_page( 'services', 'Bookings', 'Bookings', 'edit_posts', 'booking-services', 'booking_services_page' );

	add_action( "load-$hook", 'booking_services_page_load' );
}

add_action( 'admin_menu', 'register_menu_page', 105 );

function booking_services_page_load() {
	require_once __DIR__ . '/Booking_Services_List_Table.php';

	$GLOBALS['Example_List_Table'] = new Booking_Services_List_Table();
}

function booking_services_page() {
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<?php
		// выводим таблицу на экран где нужно
		echo '<form action="" method="POST">';
		$GLOBALS['Example_List_Table']->display();
		echo '</form>';
		?>

	</div>
	<?php
}