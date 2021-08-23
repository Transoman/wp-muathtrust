<?php
function change_mce_options($init) {
	$custom_colours = '
        "DDE2E6", "Color 1",
        "9EBCDC", "Color 2",
        "5F89C1", "Color 3",
        "1C3E9A", "Color 4",
        "2C2C2C", "Color 5",
        "F1F1F1", "Color 6",
        "FFFFFF", "Color 7",
    ';

	// build colour grid default+custom colors
	$init['textcolor_map'] = '['.$custom_colours.']';

	// change the number of rows in the grid if the number of colors changes
	// 8 swatches per row
	$init['textcolor_rows'] = 1;

	return $init;
}
add_filter('tiny_mce_before_init', 'change_mce_options');

add_filter( 'mce_external_plugins', 'tinymce_add_buttons' );
add_filter( 'mce_buttons', 'tinymce_register_buttons' );

function tinymce_add_buttons( $plugin_array ) {
	$plugin_array['textupb'] = get_stylesheet_directory_uri().'/js/tinymce.js';
	return $plugin_array;
}

function tinymce_register_buttons( $buttons ) {
	array_push( $buttons, 'textupb' );
	return $buttons;
}
