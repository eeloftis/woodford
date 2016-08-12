<?php
/**
 * Template Name: Portfolio 
 *
 */

get_header(); ?>

	<?php bookme_before_page(); ?>
				
		<?php while ( have_posts() ) : the_post(); ?>
		
			<section id="portfolios">
				<div class="galleries">
       				<div class="post header-section text-center">
       					<?php 
       						$subtitle = get_post_meta(get_the_ID(), '_BookmeMB_portfolio_page_subtitle', true);
       						if ( $subtitle ) 
           						echo '<div class="title"><h2>' . esc_attr( $subtitle ) . '</h2></div>';
           				
           					the_content();
           				?>
					</div>
					<?php 
						$portfolio_args = array(
							'post_type' => 'bookme_portfolio',
						);
						$portfolio = new WP_Query( $portfolio_args );
						if ( $portfolio->have_posts() ) {
							echo '<div class="gallery-block"><div class="row">';
							$row = 0;
							$colclass = '';
							$colrow = '';
							$column = get_post_meta(get_the_ID(), '_BookmeMB_portfolio_column', true);
							if ( $column == 2 ) {
								$colclass = 'col-md-6 two-row';
								$colrow = 2;
							} else {
								$colclass = 'col-md-4 three-row';
								$colrow = 3;
							}
							while ( $portfolio->have_posts() ) : $portfolio->the_post(); 
								if ( $row == $column ) {
									echo '</div><div class="row">';
									$row = 0;
								} ?>
								<div class="<?php echo $colclass; ?>">
									<div class="galleries-wrapper">
										<div class="galleries-img">
											<?php 
												if ( has_post_thumbnail() ) {
													the_post_thumbnail('bookme_att_news_big_thumbnail');
												} else {
													echo '<img src="http://placehold.it/555x363" alt="">';
												}
											?>
										</div>
										<div class="title">
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										</div>
										<div class="galleries-category"><?php bookme_post_cat(); ?></div>
										<div class="clearfix"></div>
										<?php 
											$shortdesc = get_post_meta(get_the_ID(), '_BookmeMB_portfolio_shortdesc', true);
											if ( $shortdesc ) echo esc_attr($shortdesc); ?>
									</div>
								</div><?php $row++;
							endwhile;						
							
							echo '</div></div>';
						} 
						wp_reset_postdata(); 
					?>
   				</div>
			</section>
			
		<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>
