<?php
/**
 * Template Name: Barber Template
 *
 */

get_header(); 

		if ( have_posts() ) : 
			echo '<div id="page-barber">';

			while ( have_posts() ) : the_post(); 
			
				get_template_part('template-parts/section/slider');
				get_template_part('template-parts/section/about', 'barber');
				get_template_part('template-parts/section/services', 'barber');
				get_template_part('template-parts/section/schedule', 'barber');
				get_template_part('template-parts/section/testi', 'barber');
				get_template_part('template-parts/section/pricing', 'barber');
				get_template_part('template-parts/section/gallery', 'barber');
				get_template_part('template-parts/section/parallax');

			endwhile;

			echo '</div>';
		else :
			get_template_part( 'content', 'none' );

		endif;
		
get_footer(); ?>