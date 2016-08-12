<?php
/**
 * Template Name: Trainer Template
 *
 */

get_header(); 

		if ( have_posts() ) : 
			echo '<div id="page-trainer">';

			while ( have_posts() ) : the_post(); 
			
				get_template_part('template-parts/section/slider');
				get_template_part('template-parts/section/about', 'trainer');
				get_template_part('template-parts/section/facts');
				get_template_part('template-parts/section/news', 'trainer');
				get_template_part('template-parts/section/testi', 'trainer');
				get_template_part('template-parts/section/about', 'details');
				get_template_part('template-parts/section/services', 'trainer');
				get_template_part('template-parts/section/clients', 'trainer');
				get_template_part('template-parts/section/parallax');
				
			endwhile;
			
			echo '</div>';
		else :
			get_template_part( 'content', 'none' );

		endif;
		
		
get_footer(); ?>