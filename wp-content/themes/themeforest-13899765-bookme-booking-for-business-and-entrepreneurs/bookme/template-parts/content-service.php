<?php
/**
 * Template part for displaying single service posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BookMe Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
			$terms = get_the_terms( get_the_ID(), 'service_category' );
			if ( $terms && ! is_wp_error( $terms ) ) : 
				$cat = array();

				foreach ( $terms as $term ) {
					$cat[] = $term->name;
				}
						
				$service_cat = join( ", ", $cat ); ?>
					
				<div class="small-title">
					<h4><span><?php echo $service_cat; ?></span></h4>
				</div>
		<?php endif; ?>
		<h1 class="entry-title"><?php the_title(); ?></h1> 
	</header>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-media">
			<?php the_post_thumbnail('bookme_gallery_slider'); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
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
</article><!-- #post-## -->

