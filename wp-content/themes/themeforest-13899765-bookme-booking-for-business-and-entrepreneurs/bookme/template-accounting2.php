<?php
/**
 * Template Name: Accounting 2 Template
 *
 */
get_header(); 
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 
			
				get_template_part('template-parts/section/slider'); 
				get_template_part('template-parts/section/about');
				get_template_part('template-parts/section/services');
				get_template_part('template-parts/section/news');
				get_template_part('template-parts/section/facts');
				get_template_part('template-parts/section/testi');
				get_template_part('template-parts/section/about', 'details');
				get_template_part('template-parts/section/clients');
				get_template_part('template-parts/section/parallax');

			endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;
		
get_footer(); ?>