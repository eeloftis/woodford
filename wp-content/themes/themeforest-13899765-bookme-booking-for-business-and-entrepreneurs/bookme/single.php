<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BookMe Theme
 */

get_header(); ?>

	<?php bookme_before_page(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				if ( is_singular('bookme_service') ) {
					get_template_part( 'template-parts/content', 'service' ); 
					bookme_post_navigation();
				} elseif ( is_singular('bookme_portfolio') ) {
					get_template_part( 'template-parts/content', 'portfolio' ); 
				} else {
					get_template_part( 'template-parts/content', 'single' ); 
					bookme_post_navigation();  
					bookme_author_info(); 
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				} ?>

		<?php endwhile; // End of the loop. ?>

	<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>
