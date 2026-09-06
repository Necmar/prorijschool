<?php
/**
 * Prorijschool — templates importeren vanuit het thema
 *
 * Elementor bewaart pagina-opbouw in de database, niet in bestanden.
 * Een Git-deploy zet alleen bestanden neer. Deze klasse overbrugt dat:
 * de JSON-templates worden meegedeployd in assets/templates/ en met
 * een klik op een pagina gezet.
 *
 * Gereedschap → Prorijschool templates
 *
 * @package Prorijschool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Prorijschool_Template_Import {

	const MAP   = '/assets/templates/';
	const ACTIE = 'prorijschool_import_template';
	const RECHT = 'manage_options';

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
		add_action( 'admin_post_' . self::ACTIE, array( __CLASS__, 'verwerk' ) );
	}

	public static function menu() {
		add_management_page(
			__( 'Prorijschool templates', 'prorijschool-child' ),
			__( 'Prorijschool templates', 'prorijschool-child' ),
			self::RECHT,
			'prorijschool-templates',
			array( __CLASS__, 'pagina' )
		);
	}

	/**
	 * Alle JSON-bestanden in de themamap.
	 */
	public static function bestanden() {
		$pad   = trailingslashit( get_stylesheet_directory() ) . ltrim( self::MAP, '/' );
		$lijst = glob( $pad . '*.json' );

		if ( ! is_array( $lijst ) ) {
			return array();
		}

		return array_map( 'basename', $lijst );
	}

	private static function titel( $bestandsnaam ) {
		$data = self::lees( $bestandsnaam );
		if ( is_array( $data ) && ! empty( $data['title'] ) ) {
			return $data['title'];
		}
		return $bestandsnaam;
	}

	/**
	 * Template inlezen. Geeft null bij een onbekend of ongeldig bestand.
	 */
	private static function lees( $bestandsnaam ) {
		$bestandsnaam = basename( $bestandsnaam );

		if ( ! in_array( $bestandsnaam, self::bestanden(), true ) ) {
			return null;
		}

		$pad = trailingslashit( get_stylesheet_directory() ) . ltrim( self::MAP, '/' ) . $bestandsnaam;

		if ( ! is_readable( $pad ) ) {
			return null;
		}

		$ruw  = file_get_contents( $pad ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$data = json_decode( $ruw, true );

		if ( ! is_array( $data ) || empty( $data['content'] ) || ! is_array( $data['content'] ) ) {
			return null;
		}

		return $data;
	}

	/**
	 * Nieuwe element-id's toekennen. Elementor eist unieke id's binnen
	 * een pagina; zonder dit kun je dezelfde template niet twee keer plaatsen.
	 */
	private static function vernieuw_ids( $elementen ) {
		foreach ( $elementen as &$element ) {
			if ( is_array( $element ) ) {
				$element['id'] = substr( md5( uniqid( '', true ) ), 0, 7 );

				if ( ! empty( $element['elements'] ) && is_array( $element['elements'] ) ) {
					$element['elements'] = self::vernieuw_ids( $element['elements'] );
				}
			}
		}
		unset( $element );

		return $elementen;
	}

	public static function pagina() {
		if ( ! current_user_can( self::RECHT ) ) {
			wp_die( esc_html__( 'Geen toegang.', 'prorijschool-child' ) );
		}

		$bestanden = self::bestanden();
		$paginas   = get_pages( array( 'sort_column' => 'menu_order,post_title' ) );
		$melding   = isset( $_GET['pro_melding'] ) ? sanitize_text_field( wp_unslash( $_GET['pro_melding'] ) ) : '';
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Prorijschool templates', 'prorijschool-child' ); ?></h1>

			<?php if ( 'ok' === $melding ) : ?>
				<div class="notice notice-success is-dismissible"><p>
					<?php esc_html_e( 'Template geplaatst. Open de pagina met Elementor om hem te bekijken.', 'prorijschool-child' ); ?>
				</p></div>
			<?php elseif ( $melding ) : ?>
				<div class="notice notice-error is-dismissible"><p><?php echo esc_html( $melding ); ?></p></div>
			<?php endif; ?>

			<p>
				<?php esc_html_e( 'Deze templates komen uit het child theme en worden meegeleverd via Git. Kies een template, kies een pagina en plaats hem.', 'prorijschool-child' ); ?>
			</p>

			<?php if ( empty( $bestanden ) ) : ?>
				<div class="notice notice-warning"><p>
					<?php
					printf(
						/* translators: %s: mappad */
						esc_html__( 'Geen templates gevonden in %s. Controleer of de deploy geslaagd is.', 'prorijschool-child' ),
						'<code>' . esc_html( 'wp-content/themes/prorijschool-child' . self::MAP ) . '</code>'
					);
					?>
				</p></div>
				<?php return; ?>
			<?php endif; ?>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="<?php echo esc_attr( self::ACTIE ); ?>">
				<?php wp_nonce_field( self::ACTIE ); ?>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="pro_template"><?php esc_html_e( 'Template', 'prorijschool-child' ); ?></label></th>
						<td>
							<select name="pro_template" id="pro_template">
								<?php foreach ( $bestanden as $bestand ) : ?>
									<option value="<?php echo esc_attr( $bestand ); ?>">
										<?php echo esc_html( self::titel( $bestand ) ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="pro_pagina"><?php esc_html_e( 'Plaatsen op pagina', 'prorijschool-child' ); ?></label></th>
						<td>
							<select name="pro_pagina" id="pro_pagina">
								<?php foreach ( $paginas as $p ) : ?>
									<option value="<?php echo esc_attr( $p->ID ); ?>">
										<?php echo esc_html( $p->post_title ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Manier', 'prorijschool-child' ); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="radio" name="pro_modus" value="toevoegen" checked>
									<?php esc_html_e( 'Onderaan toevoegen - bestaande inhoud blijft staan', 'prorijschool-child' ); ?>
								</label><br>
								<label>
									<input type="radio" name="pro_modus" value="vervangen">
									<?php esc_html_e( 'Vervangen - bestaande inhoud van deze pagina gaat verloren', 'prorijschool-child' ); ?>
								</label>
							</fieldset>
						</td>
					</tr>
				</table>

				<?php submit_button( __( 'Template plaatsen', 'prorijschool-child' ) ); ?>
			</form>
		</div>
		<?php
	}

	public static function verwerk() {
		if ( ! current_user_can( self::RECHT ) ) {
			wp_die( esc_html__( 'Geen toegang.', 'prorijschool-child' ) );
		}

		check_admin_referer( self::ACTIE );

		$bestand   = isset( $_POST['pro_template'] ) ? sanitize_file_name( wp_unslash( $_POST['pro_template'] ) ) : '';
		$pagina_id = isset( $_POST['pro_pagina'] ) ? absint( $_POST['pro_pagina'] ) : 0;
		$modus     = isset( $_POST['pro_modus'] ) && 'vervangen' === $_POST['pro_modus'] ? 'vervangen' : 'toevoegen';

		$data = self::lees( $bestand );

		if ( null === $data ) {
			self::terug( __( 'Template kon niet gelezen worden.', 'prorijschool-child' ) );
		}

		if ( ! $pagina_id || ! get_post( $pagina_id ) ) {
			self::terug( __( 'Pagina niet gevonden.', 'prorijschool-child' ) );
		}

		$nieuw = self::vernieuw_ids( $data['content'] );

		if ( 'toevoegen' === $modus ) {
			$bestaand = get_post_meta( $pagina_id, '_elementor_data', true );
			$bestaand = is_string( $bestaand ) && '' !== $bestaand ? json_decode( $bestaand, true ) : array();

			if ( is_array( $bestaand ) && ! empty( $bestaand ) ) {
				$nieuw = array_merge( $bestaand, $nieuw );
			}
		}

		update_post_meta( $pagina_id, '_elementor_data', wp_slash( wp_json_encode( $nieuw ) ) );
		update_post_meta( $pagina_id, '_elementor_edit_mode', 'builder' );
		update_post_meta( $pagina_id, '_elementor_template_type', 'wp-page' );

		if ( class_exists( '\\Elementor\\Plugin' ) ) {
			\Elementor\Plugin::$instance->files_manager->clear_cache();
		}

		self::terug( 'ok' );
	}

	private static function terug( $melding ) {
		wp_safe_redirect(
			add_query_arg(
				array(
					'page'        => 'prorijschool-templates',
					'pro_melding' => rawurlencode( $melding ),
				),
				admin_url( 'tools.php' )
			)
		);
		exit;
	}
}

Prorijschool_Template_Import::init();
