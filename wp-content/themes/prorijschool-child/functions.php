<?php
/**
 * Prorijschool Child Theme - functions.php
 *
 * Fase 1A: alleen de basis. Geen designkeuzes, geen extra
 * functionaliteit. Die volgen in latere fases.
 *
 * @package Prorijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Directe toegang blokkeren.
}

/**
 * Stylesheets van parent en child theme laden.
 */
function prorijschool_enqueue_styles() {
	$parent_style = 'hello-elementor';

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( 'hello-elementor' )->get( 'Version' )
	);

	wp_enqueue_style(
		'prorijschool-child',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'prorijschool_enqueue_styles', 20 );
