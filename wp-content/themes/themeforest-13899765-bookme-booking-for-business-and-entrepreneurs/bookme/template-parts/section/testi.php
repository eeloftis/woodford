<?php
/*
 * Section Testimonials
 *
 */

	$testi_title = get_post_meta(get_the_ID(), '_BookmeMB_testimonial_title', true);
	if ( $testi_title ) : ?>

    	<section id="testimonials" class="clearfix wow fadeInLeft">
		   	<div class="testimonial-wrapper">
		   		<div class="testimonials-content">
		   			<div class="container">
						<div class="row">
							<div class="testimonials-entry col-md-7">
								<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_testimonial_small_text', true) ) : ?>
									<div class="small-title">
										<h4><?php echo esc_attr( get_post_meta(get_the_ID(), '_BookmeMB_testimonial_small_text', true) ); ?></h4>
									</div>
								<?php endif; ?>
								<?php if ( $testi_title ) : ?>
									<div class="title">
										<h2><?php echo esc_attr($testi_title); ?></h2>
									</div>
								<?php endif; ?>
								<?php 
									$testi_cat = get_post_meta(get_the_ID(), '_BookmeMB_accounting_testi_cat', true);
									if ( $testi_cat ) {
										$term_ids = array($testi_cat);
									} else {
										$terms = get_terms( 'testi_category' ); 
										$term_ids = wp_list_pluck( $terms, 'term_id' );
									}
									$testi_args = array(
										'post_type' => 'bookme_testimonial',
										'tax_query' => array(
											array(
												'taxonomy' => 'testi_category',
												'field' => 'term_id',
												'terms' => $term_ids,
											),
										),
									);
									$testi_post = new WP_Query( $testi_args );
									if ( $testi_post->have_posts() ) : ?>

										<div id="testimonial-slides"> 
											<div class="owl-carousel owl-theme">
												<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?>
													<div class="item">
														<div class="main-post">
															<i class="fa fa-4x fa-quote-left"></i>
															<p><?php echo bookme_excerpt(20); ?></p>
														</div>
														<div class="row testimonials-author">
															<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
																<div class="row">
																	<?php if ( has_post_thumbnail() ) the_post_thumbnail('bookme_testimonial_thumbnail'); ?>
																</div>
															</div>
															<div class="col-lg-11 col-md-10 col-sm-9 col-xs-8">
																<div class="title">
																	<?php the_title(); ?>
																</div>
																<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_clients_position', true) ) : ?>
																	<div class="small-title">
																		<?php echo esc_attr( get_post_meta(get_the_ID(), '_BookmeMB_clients_position', true) ); ?>
																	</div>
																<?php endif; ?>
															</div>
														</div>
													</div>
												<?php endwhile; ?>
											</div>
										</div><!-- #testimonial-slides -->
								<?php endif; wp_reset_postdata(); ?>
							</div>
						</div>
	      			</div>
				</div><!-- /.testimonials-content -->

				<?php 
					$callout = get_post_meta(get_the_ID(), '_BookmeMB_testimonial_callout_content', true);
					if ( $callout ) : ?>
						<div class="testimonials-callout">
							<div class="container">
								<div class="row">
									<div class="testimonials-callout-entry col-md-8">
										<?php 
											$callout_img = get_post_meta(get_the_ID(), '_BookmeMB_testimonial_callout_img', true);
											if ( $callout_img )  : ?>
												<div class="testimonials-callout-img">
													<img src="<?php echo esc_url( $callout_img ); ?>" alt="" />
												</div>
										<?php endif; ?>
										<div class="testimonials-callout-post-content">
											<?php echo wp_kses_post($callout); ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.testimonials-callout -->
				<?php endif; ?>
				
		   	</div>
		
		   	<?php 
		   		$quote_small_title = get_post_meta(get_the_ID(), '_BookmeMB_testimonial_quote_small_text', true);
		   		$quote_title = get_post_meta(get_the_ID(), '_BookmeMB_testimonial_quote_title', true);
		   		if ( $quote_title ) : ?>
		   			<div class="testimonials-quote">
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
		   				<div class="quote-form">
		   					<?php 
		   						$cf7_id = get_post_meta(get_the_ID(), '_BookmeMB_testimonials_cf7_form', true);
		   						if ( $cf7_id != '' ) {
									$cf7_title = get_the_title($cf7_id);
									echo do_shortcode('[contact-form-7 id="'.$cf7_id.'" title="'.$cf7_title.'"]');
								} else {
									echo do_shortcode('[bookme_contact subject="Request a Quote"]');
								} 
							?>
					  	</div>
					</div>
	     	<?php endif; ?>

	    </section><!-- #testimonials -->

<?php endif; ?>