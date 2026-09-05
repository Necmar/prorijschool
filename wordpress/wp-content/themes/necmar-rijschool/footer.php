<?php
/**
 * Footer template.
 *
 * @package NecmarRijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) : ?>
	<?php wp_footer(); ?>
</body>
</html>
	<?php return; ?>
<?php endif; ?>
<footer class="pr-footer">
	<div class="pr-container">
		<div class="pr-grid">
			<div>
				<h2><?php bloginfo( 'name' ); ?></h2>
				<p><?php esc_html_e( 'Moderne rijschool in Haarlemmermeer en omgeving.', 'necmar-rijschool' ); ?></p>
			</div>
			<div>
				<h3><?php esc_html_e( 'Snelle links', 'necmar-rijschool' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
			<div>
				<h3><?php esc_html_e( 'Contact', 'necmar-rijschool' ); ?></h3>
				<p><?php echo esc_html( get_option( 'prp_whatsapp_number', '+31600000000' ) ); ?></p>
				<p><?php esc_html_e( '©', 'necmar-rijschool' ); ?> <?php echo esc_html( gmdate( 'Y' ) ); ?> Pro Rijschool</p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
