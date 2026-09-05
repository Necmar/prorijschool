<?php
/**
 * Header template.
 *
 * @package NecmarRijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) : ?>
<?php return; ?>
<?php endif; ?>
<header class="pr-topbar">
	<div class="pr-container pr-topbar-inner">
		<a class="pr-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( necmar_rijschool_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<span class="pr-brand-name"><?php bloginfo( 'name' ); ?></span>
		</a>
		<nav class="pr-main-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'necmar-rijschool' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
</header>
