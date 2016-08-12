<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BookMe Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-post">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-media">
				<?php the_post_thumbnail('bookme_gallery_slider'); ?>
			</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php bookme_post_tag(); ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>

		<?php bookme_post_meta(); ?>

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
	</div>

	<?php bookme_related(); ?>

</article><!-- #post-## -->

