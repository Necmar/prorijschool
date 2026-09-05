<?php
/**
 * Page template.
 *
 * @package NecmarRijschool
 */

get_header();
?>
<?php if ( necmar_rijschool_is_elementor_built() ) : ?>
	<main>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</main>
<?php else : ?>
	<main class="pr-page">
		<div class="pr-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'pr-card' ); ?>>
					<h1 class="pr-section-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		</div>
	</main>
<?php endif; ?>
<?php
get_footer();
