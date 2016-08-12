<?php
/**
 * Template Name: Galleries 
 *
 */

get_header(); ?>

	<?php bookme_before_page(); ?>
				
		<?php while ( have_posts() ) : the_post(); ?>
		
			<section id="galleries">
				<div class="galleries">
       				<div class="post header-section text-center">
       					<?php 
       						$subtitle = get_post_meta(get_the_ID(), '_BookmeMB_gallery_page_subtitle', true);
       						if ( $subtitle ) 
           						echo '<div class="title"><h2>' . esc_attr( $subtitle ) . '</h2></div>';
           				
           					the_content();
           				?>
					</div>
					<?php 
						$galleries = get_post_meta(get_the_ID(), '_BookmeMB_gallery_page_imgs', true);
						if ( $galleries ) {
							echo '<div class="gallery-block"><div class="row">';
							$row = 0;
							$colclass = '';
							$colrow = '';
							$column = get_post_meta(get_the_ID(), '_BookmeMB_gallery_column', true);
							if ( $column == 3 ) {
								$colclass = 'col-md-4';
								$colrow = 3;
							} else {
								$colclass = 'col-md-3';
								$colrow = 4;
							}
							foreach ( (array) $galleries as $attachment_id => $attachment_url ) {
								if ( $row == $column ) {
									echo '</div><div class="row">';
									$row = 0;
								} ?>
								<div class="<?php echo $colclass; ?>">
									<div class="galleries-wrapper">
										<div class="galleries-img">
											<div class="galleries-hover">
												<a href="<?php echo esc_url($attachment_url); ?>" rel="prettyPhoto">
                									<i class="fa fa-search-plus"></i>
               									</a>
											</div>
											<?php echo wp_get_attachment_image( $attachment_id, 'bookme_gallery_thumb' ); ?>
										</div>
										<?php 
											$attachment_title = get_the_title($attachment_id);
											if ( $attachment_title )
												echo '<div class="title"><h4>' . esc_attr( $attachment_title ) . '</h4></div>';
										?>
									</div>
								</div><?php $row++;
							}
							
							
							echo '</div></div>';
						}
					?>
   				</div>
			</section>
			
		<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>
