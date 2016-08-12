<?php
/**
 * Template Name: Architect Template 
 *
 */
get_header(); 
		if ( have_posts() ) : 
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<div id="page-architect">
				
				<?php
					get_template_part('template-parts/section/slider');
					get_template_part('template-parts/section/about', 'details-architect');
					get_template_part('template-parts/section/services', 'architect');
					get_template_part('template-parts/section/project', 'architect');
					get_template_part('template-parts/section/quote', 'architect');
					get_template_part('template-parts/section/testi', 'architect');
					get_template_part('template-parts/section/clients', 'architect');
					get_template_part('template-parts/section/facts');
					get_template_part('template-parts/section/news');
					get_template_part('template-parts/section/callout');
					get_template_part('template-parts/section/parallax');
				?>

                </div>
		<?php	// End the loop.
			endwhile;
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;
		
get_footer(); ?>
