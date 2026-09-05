<?php
/**
 * Necmar Rijschool theme functions.
 *
 * @package NecmarRijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function necmar_rijschool_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 280, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'necmar-rijschool' ),
			'footer'  => __( 'Footer Menu', 'necmar-rijschool' ),
		)
	);
}
add_action( 'after_setup_theme', 'necmar_rijschool_theme_setup' );

function necmar_rijschool_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'necmar-rijschool-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'necmar-rijschool-style',
		get_stylesheet_uri(),
		array( 'necmar-rijschool-fonts' ),
		$theme->get( 'Version' )
	);

	wp_enqueue_script(
		'necmar-rijschool-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		$theme->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'necmar_rijschool_assets' );

function necmar_rijschool_logo_url() {
	$option_id = absint( get_option( 'prp_brand_logo_id', 0 ) );
	if ( $option_id > 0 ) {
		$logo = wp_get_attachment_image_url( $option_id, 'full' );
		if ( $logo ) {
			return $logo;
		}
	}

	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo    = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		if ( $custom_logo ) {
			return $custom_logo;
		}
	}

	return get_template_directory_uri() . '/assets/img/logo-light.svg';
}

/**
 * Detect whether the current post uses Elementor builder.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function necmar_rijschool_is_elementor_built( $post_id = 0 ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	if ( $post_id <= 0 ) {
		return false;
	}

	if ( did_action( 'elementor/loaded' ) ) {
		return 'builder' === get_post_meta( $post_id, '_elementor_edit_mode', true );
	}

	return false;
}
