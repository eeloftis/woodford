<?php
/**
 * Template Name: Movers Template
 *
 */

get_header(); 

		if ( have_posts() ) : 

			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<div id="page-movers">

				<?php 
						get_template_part('template-parts/section/slider');
						get_template_part('template-parts/section/about', 'movers');
						get_template_part('template-parts/section/projects');
						get_template_part('template-parts/section/news');
						get_template_part('template-parts/section/facts');
						get_template_part('template-parts/section/testi', 'movers');
						get_template_part('template-parts/section/clients');
						get_template_part('template-parts/section/parallax');
				?>
				
				</div><!-- #page-attorney -->
			
		<?php	// End the loop.
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		
get_footer(); ?>