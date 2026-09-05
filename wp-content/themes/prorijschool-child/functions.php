<?php
/**
 * Prorijschool Child Theme
 *
 * Alle maatwerk staat hier en in assets/. Elementor blijft
 * verantwoordelijk voor de opbouw van pagina's; dit thema levert
 * het designsysteem, de componentklassen en de rekenhulp.
 *
 * @package Prorijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PRORIJSCHOOL_VERSIE', '0.2.0' );

/**
 * Stylesheets laden. Volgorde is bewust: tokens, componenten, child.
 */
function prorijschool_styles() {
	$dir = get_stylesheet_directory_uri();
	$pad = get_stylesheet_directory();

	wp_enqueue_style(
		'hello-elementor',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( 'hello-elementor' )->get( 'Version' )
	);

	wp_enqueue_style(
		'prorijschool-tokens',
		$dir . '/assets/css/tokens.css',
		array( 'hello-elementor' ),
		file_exists( $pad . '/assets/css/tokens.css' ) ? filemtime( $pad . '/assets/css/tokens.css' ) : PRORIJSCHOOL_VERSIE
	);

	wp_enqueue_style(
		'prorijschool-componenten',
		$dir . '/assets/css/componenten.css',
		array( 'prorijschool-tokens' ),
		file_exists( $pad . '/assets/css/componenten.css' ) ? filemtime( $pad . '/assets/css/componenten.css' ) : PRORIJSCHOOL_VERSIE
	);

	wp_enqueue_style(
		'prorijschool-child',
		$dir . '/style.css',
		array( 'prorijschool-componenten' ),
		PRORIJSCHOOL_VERSIE
	);
}
add_action( 'wp_enqueue_scripts', 'prorijschool_styles', 20 );

/**
 * Preconnect voor lettertypen. Scheelt merkbaar op mobiel (zie 59).
 */
function prorijschool_font_hints( $urls, $relatie ) {
	if ( 'preconnect' === $relatie ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'prorijschool_font_hints', 10, 2 );

/**
 * Rekenhulp. Tarieven staan hier en niet in JavaScript, zodat een
 * prijswijziging op een plek gebeurt en niet in de Elementor-opmaak.
 */
function prorijschool_rekenhulp() {
	$dir = get_stylesheet_directory_uri();
	$pad = get_stylesheet_directory();

	wp_register_script(
		'prorijschool-rekenhulp',
		$dir . '/assets/js/rekenhulp.js',
		array(),
		file_exists( $pad . '/assets/js/rekenhulp.js' ) ? filemtime( $pad . '/assets/js/rekenhulp.js' ) : PRORIJSCHOOL_VERSIE,
		true
	);

	wp_localize_script(
		'prorijschool-rekenhulp',
		'proRekenhulp',
		array(
			'tarief'  => array(
				60  => (int) get_option( 'prorijschool_tarief_60', 62 ),
				90  => (int) get_option( 'prorijschool_tarief_90', 89 ),
				120 => (int) get_option( 'prorijschool_tarief_120', 116 ),
			),
			'examen'  => (int) get_option( 'prorijschool_examen', 380 ),
			'teksten' => array(
				'detail' => __( 'ongeveer %lessen% lessen van %duur% minuten, inclusief examen', 'prorijschool-child' ),
			),
		)
	);

	wp_enqueue_script( 'prorijschool-rekenhulp' );
}
add_action( 'wp_enqueue_scripts', 'prorijschool_rekenhulp', 21 );

/**
 * Zelfde stijlen binnen de Elementor-editor, zodat de redacteur ziet
 * wat de bezoeker straks ziet.
 */
function prorijschool_editor_stijl() {
	$dir = get_stylesheet_directory_uri();
	wp_enqueue_style( 'prorijschool-tokens-editor', $dir . '/assets/css/tokens.css', array(), PRORIJSCHOOL_VERSIE );
	wp_enqueue_style( 'prorijschool-componenten-editor', $dir . '/assets/css/componenten.css', array( 'prorijschool-tokens-editor' ), PRORIJSCHOOL_VERSIE );
}
add_action( 'elementor/editor/after_enqueue_styles', 'prorijschool_editor_stijl' );
add_action( 'elementor/preview/enqueue_styles', 'prorijschool_editor_stijl' );

/**
 * Locaties registreren voor Elementor Theme Builder.
 */
function prorijschool_locaties( $beheer ) {
	$beheer->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'prorijschool_locaties' );

/**
 * Huidige taal als body-klasse, bruikbaar zodra de meertalige plugin
 * toegevoegd wordt (zie 36).
 */
function prorijschool_taal_klasse( $klassen ) {
	$taal      = function_exists( 'pll_current_language' ) ? pll_current_language() : substr( get_locale(), 0, 2 );
	$klassen[] = 'pro-taal-' . sanitize_html_class( $taal );
	return $klassen;
}
add_filter( 'body_class', 'prorijschool_taal_klasse' );
