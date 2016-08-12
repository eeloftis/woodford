<?php
/**
 * Template Name: Corporate Trainer Template
 *
 */

get_header(); 

		if ( have_posts() ) : 
			echo '<div id="page-corporate-trainer">';

			while ( have_posts() ) : the_post(); 
				
				get_template_part('template-parts/section/slider');
				get_template_part('template-parts/section/clients', 'corp-trainer');
				get_template_part('template-parts/section/about', 'corp-trainer');
				get_template_part('template-parts/section/services');
				get_template_part('template-parts/section/news', 'corporate-trainer');
				get_template_part('template-parts/section/tab'); 
				get_template_part('template-parts/section/facts'); 
				get_template_part('template-parts/section/testi', 'therapy'); 
				get_template_part('template-parts/section/parallax'); 

			endwhile;

            echo '</div>';

		else :
		
			get_template_part( 'content', 'none' );
			

		endif;
		
get_footer(); ?>
