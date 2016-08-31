<?php
/*
 * Section Parallax
 *
 */


	$paralax_small_text = get_post_meta(get_the_ID(), '_BookmeMB_paralax_small_text', true);
	$paralax_content = get_post_meta(get_the_ID(), '_BookmeMB_paralax_content', true);

	if ( $paralax_small_text || $paralax_content ) :
		$paralax_bg_img = get_post_meta(get_the_ID(), '_BookmeMB_paralax_bg_img', true);
		$paralax_bg_color = get_post_meta(get_the_ID(), '_BookmeMB_paralax_bg_color', true);
		$style_img = '';
		$style_color = '';
		$bg_img = 'background-image: url(' . $paralax_bg_img . '); ';
		$bg_color = 'background-color: '. $paralax_bg_color . '; ';
		if ( $paralax_bg_img ) {
			$style_img = 'style="' . $bg_img . '"';
		}
		if ( $paralax_bg_color ) {
			$style_color = 'style="' . $bg_color . '"';
		} ?>
 <a name="features" />
		<section id="features" class="hidden-md-up">
			<div <?php echo $style_img; ?>></div>

		</section>

			<section id="features" <?php echo $style_img; ?> class="hidden-sm hidden-xs">
				<div class="features-wrapper" <?php echo $style_color; ?>>
					<div class="container wow fadeInDown">
						<div class="row">
							<div class="col-md-7 col-md-offset-5 col-sm-8 col-sm-offset-4">
								<div class="main-post">
									<?php if ( $paralax_small_text ) : ?>
										<div class="small-title">
											<h3><?php echo esc_attr( $paralax_small_text ); ?></h3>
										</div>
									<?php endif; ?>
									<?php if ( $paralax_content ) echo wp_kses_post($paralax_content); ?>
								</div>
								<?php
									$featured_logo_text = get_post_meta(get_the_ID(), '_BookmeMB_paralax_featured_logo_text', true);
									$featured_logo_img = get_post_meta(get_the_ID(), '_BookmeMB_paralax_featured_logo', true);
									if ( $featured_logo_text || $featured_logo_img ) { ?>
										<div class="title">
											<?php if ( $featured_logo_text ) echo '<h4>' . esc_attr( $featured_logo_text ) . '</h4>'; ?>
												<?php
													if ( $featured_logo_img ) {
														echo '<div class="row">';

														foreach ( (array) $featured_logo_img as $attachment_id => $attachment_url ) {
															echo '<div class="featured-logo col-md-4 col-sm-4 col-xs-4">';
															echo wp_get_attachment_image( $attachment_id );
															echo '</div>';
														}

														echo '</div>';
													}
												?>
										</div>
								<?php } ?>
							</div>
							<!-- <div class="col-md-6">
								<?php
									if ( class_exists( 'booked_plugin' ) ) {
										$parallax_booked_title = get_post_meta(get_the_ID(), '_BookmeMB_parallax_booked_title', true);
										$parallax_booked_shortcode = get_post_meta(get_the_ID(), '_BookmeMB_parallax_booked_shortcode', true);
										if ( $parallax_booked_title )
											echo wp_kses_post($parallax_booked_title);
										if ( $parallax_booked_shortcode )
											echo '<div class="booked-wrapper">' . do_shortcode(esc_attr($parallax_booked_shortcode) ) . '</div>';
									}
								?>
							</div> -->
						</div>
					</div><!--/.container-->
				</div>
			</section><!-- #features -->

	<?php endif; ?>
