<?php
/**
 * Template Name: Faq
 *
 */

get_header(); global $bookme_option; ?>

	<?php bookme_before_page(); ?>
				
		<?php while ( have_posts() ) : the_post(); ?>
				
				<section id="faqs">
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
							<?php 
								$faqs = get_post_meta(get_the_ID(), '_BookmeMB_faq_details', true);
								if ( $faqs ) : 
									echo '<div class="row">';
									$row = 0;
									foreach ( (array) $faqs as $key => $faq ) {
										$title = $content = '';
										if ( isset( $faq['title'] ) ) 
											$title = $faq['title'];
										if ( isset( $faq['content'] ) ) 
											$content = $faq['content']; 
											
										if ( $row == 2 ) {
											echo '</div><div class="row">';
											$row = 0;
										} ?>
										
										<div class="col-md-6">
											<div class="faqs-wrapper">
												<div class="question">Q</div>
												<div class="title">
													<h4><?php echo esc_attr( $title ); ?></h4>
												</div>
												<p><?php echo esc_attr( $content ); ?></p>
											</div>
										</div><?php $row++;
									}
									echo '</div>';
								endif; 
							?>

				</section>
		<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>