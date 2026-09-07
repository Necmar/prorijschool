<?php
/**
 * Idempotente site-opbouw voor de Nederlandse publieke pagina's.
 *
 * De inhoud blijft gewone Elementor-data in WordPress. Deze migratie maakt
 * ontbrekende pagina's aan en werkt alleen door ons beheerde templates bij
 * wanneer de manifestversie verandert.
 *
 * @package Prorijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Prorijschool_Site_Setup {
	const OPTION = 'prorijschool_site_manifest_version';
	const DIR    = '/assets/templates/pages/';

	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'maybe_run' ), 20 );
	}

	public static function maybe_run() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$manifest = self::read_json( 'manifest.json' );
		if ( empty( $manifest['version'] ) || empty( $manifest['pages'] ) || ! is_array( $manifest['pages'] ) ) {
			return;
		}

		if ( get_option( self::OPTION ) === $manifest['version'] ) {
			return;
		}

		$page_ids = array();
		foreach ( $manifest['pages'] as $page ) {
			$page_id = self::upsert_page( $page );
			if ( $page_id ) {
				$page_ids[ $page['slug'] ] = $page_id;
			}
		}

		self::build_navigation( $page_ids );
		self::build_blog_structure();

		if ( class_exists( '\Elementor\Plugin' ) ) {
			\Elementor\Plugin::$instance->files_manager->clear_cache();
		}

		update_option( self::OPTION, sanitize_text_field( $manifest['version'] ), false );
	}

	private static function read_json( $filename ) {
		$path = trailingslashit( get_stylesheet_directory() ) . ltrim( self::DIR, '/' ) . basename( $filename );
		if ( ! is_readable( $path ) ) {
			return null;
		}
		$data = json_decode( file_get_contents( $path ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		return is_array( $data ) ? $data : null;
	}

	private static function upsert_page( $definition ) {
		if ( empty( $definition['slug'] ) || empty( $definition['title'] ) || empty( $definition['template'] ) ) {
			return 0;
		}

		$template = self::read_json( $definition['template'] );
		if ( empty( $template['content'] ) || ! is_array( $template['content'] ) ) {
			return 0;
		}

		$existing = get_page_by_path( sanitize_title( $definition['slug'] ), OBJECT, 'page' );
		$postarr  = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => sanitize_title( $definition['slug'] ),
			'post_title'   => sanitize_text_field( $definition['title'] ),
			'post_excerpt' => sanitize_text_field( $definition['description'] ?? '' ),
			'menu_order'   => absint( $definition['menu_order'] ?? 0 ),
		);
		if ( $existing ) {
			$postarr['ID'] = $existing->ID;
		}

		$page_id = wp_insert_post( wp_slash( $postarr ), true );
		if ( is_wp_error( $page_id ) ) {
			return 0;
		}

		update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $template['content'] ) ) );
		update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
		update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
		update_post_meta( $page_id, '_wp_page_template', 'elementor_header_footer' );
		update_post_meta( $page_id, '_elementor_page_settings', array( 'hide_title' => 'yes' ) );
		update_post_meta( $page_id, '_yoast_wpseo_title', sanitize_text_field( $definition['title'] ) . ' %%sep%% %%sitename%%' );
		update_post_meta( $page_id, '_yoast_wpseo_metadesc', sanitize_text_field( $definition['description'] ?? '' ) );
		update_post_meta( $page_id, 'rank_math_title', sanitize_text_field( $definition['title'] ) . ' %sep% %sitename%' );
		update_post_meta( $page_id, 'rank_math_description', sanitize_text_field( $definition['description'] ?? '' ) );

		return $page_id;
	}

	private static function build_navigation( $page_ids ) {
		$menu = wp_get_nav_menu_object( 'Hoofdnavigatie' );
		if ( ! $menu ) {
			$menu_id = wp_create_nav_menu( 'Hoofdnavigatie' );
		} else {
			$menu_id = $menu->term_id;
			foreach ( wp_get_nav_menu_items( $menu_id ) ?: array() as $item ) {
				wp_delete_post( $item->ID, true );
			}
		}

		$add = static function ( $label, $slug, $parent = 0 ) use ( $menu_id, $page_ids ) {
			if ( empty( $page_ids[ $slug ] ) ) {
				return 0;
			}
			return wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $label,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page_ids[ $slug ],
					'menu-item-parent-id' => $parent,
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				)
			);
		};

		$lessons = $add( 'Rijlessen', 'autorijles' );
		$add( 'Automaat rijles', 'automaat-rijles', $lessons );
		$add( 'Taxilessen', 'taxilessen', $lessons );
		$add( 'Aanhanger', 'aanhangwagenrijlessen', $lessons );
		$add( 'Pakketten', 'pakketten' );
		$theory = $add( 'Theorie', 'theorie' );
		$add( 'Online theorie', 'online-theorie', $theory );
		$add( 'Theoriecursus', 'theoriecursus', $theory );
		$add( 'Over ons', 'over-prorijschool' );
		$add( 'Blog', 'blog' );
		$add( 'Contact', 'contact' );

		$locations = get_theme_mod( 'nav_menu_locations', array() );
		foreach ( array( 'menu-1', 'primary', 'header-menu' ) as $location ) {
			if ( has_nav_menu( $location ) || 'menu-1' === $location ) {
				$locations[ $location ] = $menu_id;
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	private static function build_blog_structure() {
		foreach ( array( 'Rijlessen', 'Theorie', 'Praktijkexamen', 'Kosten en pakketten', 'Rijden in de regio' ) as $category ) {
			if ( ! term_exists( $category, 'category' ) ) {
				wp_insert_term( $category, 'category' );
			}
		}
	}
}

Prorijschool_Site_Setup::init();
