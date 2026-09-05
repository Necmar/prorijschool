<?php
/**
 * Main template file.
 *
 * @package NecmarRijschool
 */

get_header();
?>
<main class="pr-page">
	<div class="pr-container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'pr-card' ); ?>>
					<h1 class="pr-section-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="pr-card">
				<h1 class="pr-section-title"><?php esc_html_e( 'Geen content gevonden', 'necmar-rijschool' ); ?></h1>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
