<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BookMe Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-post">
	
		<?php if ( get_post_format() != 'link' ) : ?>

			<div class="post-media">
				<?php if ( get_post_format() == 'gallery' ) : ?>
					<?php 
						$galleries = get_post_meta(get_the_ID(), '_BookmeMB_gallery_imgs', true);
						if ( $galleries ) { ?>
							<div id="gallery-slides">
								<div class="owl-carousel owl-theme">
									<?php foreach ( (array) $galleries as $attachment_id => $attachment_url ) { ?>
										<div class="item">
											<div class="post-media">
												<?php echo wp_get_attachment_image( $attachment_id, 'bookme_gallery_slider' ); ?>
											</div>
										</div>
									<?php } ?>	
								</div>
							</div>
					<?php } ?>

				<?php elseif ( get_post_format() == 'video' ) : ?>
					
					<?php 
						$video_url = get_post_meta(get_the_ID(), '_BookmeMB_format_video_url', true);
						if ( has_post_thumbnail() && !empty( $video_url ) ) { ?>
							<div class="abt-video">
								<div class="video-play">
									<a href="<?php echo esc_url($video_url); ?>" rel="prettyPhoto"><i class="fa fa-youtube-play"></i></a>
									<?php the_post_thumbnail('bookme_gallery_slider'); ?>
								</div>
							</div>
					<?php } ?>

				<?php elseif ( get_post_format() == 'quote' ) : ?>
					
					<?php 
						$quote = get_post_meta(get_the_ID(), '_BookmeMB_format_quote_content', true);
						if ( $quote )
							echo '<div class="content-post"><div class="text-quote"><i class="fa fa-5x fa-quote-left"></i><p>' . esc_attr( $quote ) . '</p></div></div>';
					?>
					
				<?php else : ?>
					<?php the_post_thumbnail('bookme_gallery_slider'); ?>
				<?php endif; ?>
			</div>

			<header class="entry-header">
				<?php bookme_post_tag(); ?>
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header>

			<?php bookme_post_meta(); ?>

			<div class="entry-content">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post.*/
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bookme' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bookme' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php bookme_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		
		<?php else : ?>
		
			<header class="entry-header">
				<?php 
					bookme_post_tag();
					
					$link = get_post_meta(get_the_ID(), '_BookmeMB_format_link_url', true);
					if ( $link ) {
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( $link ) ), '</a><span class="lnr lnr-arrow-right"></span></h2>' );
					} else {
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a><span class="lnr lnr-arrow-right"></span></h2>' );
					}
				?>
			</header>
		
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
