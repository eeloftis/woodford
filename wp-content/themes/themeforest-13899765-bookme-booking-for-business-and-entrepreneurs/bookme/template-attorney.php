<?php
/**
 * Template Name: Attorney Template
 *
 */

get_header(); 

		if ( have_posts() ) : 

			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<div id="page-attorney">

					<?php 
						get_template_part('template-parts/section/slider');
						get_template_part('template-parts/section/about', 'details');
						get_template_part('template-parts/section/services');
						get_template_part('template-parts/section/news', 'attorney'); 
						get_template_part('template-parts/section/facts');
						get_template_part('template-parts/section/testi', 'attorney');
						get_template_part('template-parts/section/about', 'attorney'); 
						get_template_part('template-parts/section/parallax'); ?>
									
				</div><!-- #page-attorney -->
			
		<?php	// End the loop.
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif; 
		
get_footer(); ?>