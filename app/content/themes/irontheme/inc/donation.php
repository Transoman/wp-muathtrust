<?php
add_action('wp_ajax_donation_summary', 'get_donation_summary');
add_action('wp_ajax_nopriv_donation_summary', 'get_donation_summary');

function get_donation_summary() {
	get_template_part( 'template-parts/widget-cart' );

	wp_die();
}

function get_basket_items() {
	$data = isset( $_COOKIE['basket_items'] ) ? stripslashes( $_COOKIE['basket_items'] ) : '';

	if ( $data != '' ) {
		$data = json_decode( $data, true );
	} else {
		return array();
	}

	foreach ( $data as $key => $value ) {
		foreach ( $value as $inner_k => $inner_v ) {
			if ( ! is_array( $inner_v ) ) {
				$data[ $key ][ $inner_k ] = htmlspecialchars( $inner_v );
			}
		}
	}

	return $data;
}

function get_basket_items_count() {
	return count( get_basket_items() );
}

function get_donation_type_label( $type ) {
	$donation_types_labels = get_donation_type_labels();

	return $donation_types_labels[ $type ];
}

function get_donation_type_labels() {
	$donation_types_labels = [
		'monthly' => 'Monthly',
		'once'    => 'One-off',
	];

	return $donation_types_labels;
}