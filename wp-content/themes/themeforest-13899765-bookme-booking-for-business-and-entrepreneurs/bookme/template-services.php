<?php 
/*
 * Template Name: Services Archive Page
 *
 */

get_header(); global $bookme_option;

	if ( have_posts() ) : 
		
		bookme_entry_header();

		while ( have_posts() ) : the_post(); 
			get_template_part( 'template-parts/content', 'service_archive' );
		endwhile;
		
	endif;

get_footer(); ?>
