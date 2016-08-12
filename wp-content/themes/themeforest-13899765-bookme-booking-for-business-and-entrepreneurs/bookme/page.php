<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BookMe Theme
 */

get_header(); global $bookme_option; ?>

	<?php bookme_before_page(); ?>
				
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			
		<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>