<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BookMe Theme
 */

get_header(); ?>

	<?php bookme_entry_header(); ?>

	<div id="page-entry" class="container">
		<div class="row">

			<?php 
				$page_layout = '';
				$site_layout = $bookme_option['site_layout'];
				if ( $site_layout == 'sb_left' ) {
					$page_layout = 'col-md-8 col-sm-8';
					get_sidebar();
				} elseif ( $site_layout == 'sb_right' ) {
					$page_layout = 'col-md-8 col-sm-8';
				} else {
					$page_layout = 'col-md-12 col-sm-12';
				}
			?>

			<div id="primary" class="content-area <?php echo $page_layout; ?>">
				<main id="main" class="site-main" role="main">

					<?php 
						if ( have_posts() ) : 
						
								while ( have_posts() ) : the_post(); 
								
									get_template_part( 'template-parts/content', 'search' );
									
								endwhile; 
							
								the_posts_navigation(); 

						 else :

							get_template_part( 'template-parts/content', 'none' ); 

						endif; 
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			
			<?php if ( $site_layout == 'sb_right' ) get_sidebar(); ?>
			
		</div>
	</div>

	<?php get_template_part('template-parts/section/footer', 'quote'); ?>
	
<?php get_footer(); ?>
