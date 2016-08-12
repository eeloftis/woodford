<?php
/**
 * Template Name: Accounting 3 Template
 *
 */
get_header(); 
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 
			
				get_template_part('template-parts/section/slider', 'acc3');
				get_template_part('template-parts/section/about', 'details');
				get_template_part('template-parts/section/services');
				get_template_part('template-parts/section/news', 'attorney'); 
				get_template_part('template-parts/section/facts');
				get_template_part('template-parts/section/testi', 'attorney');
				get_template_part('template-parts/section/about', 'attorney'); 
				get_template_part('template-parts/section/parallax');

			endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;
		
get_footer(); ?>