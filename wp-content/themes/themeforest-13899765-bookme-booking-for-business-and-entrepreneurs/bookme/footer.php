<?php
/**
 * The template for displaying the footer
 */
 global $bookme_option;
 bookme_before_footer();
?>

	<?php if ( is_home() && ! is_front_page() ) get_template_part('template-parts/section/footer', 'quote'); ?>

		<footer id="colophon" class="site-footer">


      <div class="container">
				<div class="row">
					<div class="col-sm-2 col-md-1">
            contact

					</div>
					<div class="col-sm-4 col-md-3">
            new york    917.574.3870


					</div>
					<div class="col-sm-4 col-md-3">
              miami    305.590.8473
					</div>
					<div class="col-sm-12 col-md-2 col-md-offset-3">
            <div class="social">

              visit us: <img src="<?php echo esc_url( home_url() ); ?>wp-content/themes/themeforest-13899765-bookme-booking-for-business-and-entrepreneurs/bookme/images/social-sharing.png" >

            </div>
					</div>
				</div><!--/.row-->
			</div><!--/.container-->


		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>

			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-md-2">
						<div class="footer-widget">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
					</div>
					<div class="col-sm-4 col-md-3">
						<div class="footer-widget">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					</div>
					<div class="col-sm-4 col-md-2">
						<div class="footer-widget">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					</div>
					<div class="col-sm-12 col-md-5">
						<div class="footer-widget">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					</div>
				</div><!--/.row-->
			</div><!--/.container-->

		<?php endif; ?>

		</footer><!-- #colophon -->

		<?php bookme_footer(); ?>

	</div>

	<?php wp_footer(); ?>

  <script>

   rightHeight.init();
  </script>
</body>
</html>
