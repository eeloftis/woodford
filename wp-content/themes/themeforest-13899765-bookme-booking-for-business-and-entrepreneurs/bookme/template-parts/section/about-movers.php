<?php 
/*
 * Section About Movers
 *
 */
	$abt_title = get_post_meta(get_the_ID(), '_BookmeMB_movers_about_small_title', true);
	$abt_content = get_post_meta(get_the_ID(), '_BookmeMB_movers_about_content', true);
	if ( $abt_title || $abt_content ) : ?>
		<section id="about">
			<div class="container wow fadeInDown">
				<div class="row">
					<div class="col-md-7">
						<div class="post">
							<?php 
								if ( $abt_title ) { 
									echo '<div class="small-title">';
									echo '<h4>' . esc_attr( $abt_title ) . '</h4>';
									echo '</div>';
								}
												
								if ( $abt_content ) {
									echo '<div class="about-desc clearfix">' . $abt_content . '</div>';
								}
							?>
						</div>
					</div>
					<?php 
						$quote_small_title = get_post_meta(get_the_ID(), '_BookmeMB_about_quote_small_text', true);
						$quote_title = get_post_meta(get_the_ID(), '_BookmeMB_about_quote_title', true);
						if ( $quote_title ) : ?>
							<div class="col-md-5">
								<div class="quote-form">
									<?php if ( $quote_small_title ) : ?>
										<div class="small-title">
											<h4><?php echo esc_attr( $quote_small_title ); ?></h4>
										</div>
										<?php endif; ?>
										<?php if ( $quote_title ) : ?>
											<div class="title">
												<h2><?php echo esc_attr( $quote_title ); ?></h2>
											</div> 
									<?php endif; ?>
								
									<?php 
									$cf7_id = get_post_meta(get_the_ID(), '_BookmeMB_about_cf7_form', true);
									if ( $cf7_id != '' ) {
										$cf7_title = get_the_title($cf7_id);
										echo do_shortcode('[contact-form-7 id="'.$cf7_id.'" title="'.$cf7_title.'"]');
									} else { ?>
										<form action="" class="form-request">
											<input type="text" placeholder="Full Name/ Company Name">
											<input type="email" placeholder="Email Address">
											<input type="tel" placeholder="Phone">
											<textarea placeholder="Message"></textarea>
											<input type="submit" href="" value="Get a Quote">
										</form>
									<?php } ?>
								</div>
							</div>
					<?php endif; ?>
				</div>
			</div><!--/.container-->
		</section><!-- #about -->
<?php endif; ?>
