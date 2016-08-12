<?php 
/* 
 * Section Testimonials Movers
 *
 */
 
 	$testi_small_text = get_post_meta(get_the_ID(), '_BookmeMB_attorney_testimonial_small_text', true);
 	$testi_title = get_post_meta(get_the_ID(), '_BookmeMB_attorney_testimonial_title', true);
 	if ( $testi_small_text || $testi_title ) : ?>
		<section id="testimonials">
			<div class="testimonial-wrapper">
			     <div class="testimonials-content wow fadeInDown">
			      	<div class="container">
						<div class="row">
							<div class="testimonials-entry col-md-12">
								<div class="header-section text-center">
									<?php if ( $testi_small_text ) : ?>
										<div class="small-title">
											<h4><?php echo esc_attr( $testi_small_text ); ?></h4>
										</div>
									<?php endif; ?>
									<?php if ( $testi_title ) echo '<h2 class="title">' . esc_attr( $testi_title ) . '</h2>'; ?>
								</div>
								<?php 
									$testi_cat = get_post_meta(get_the_ID(), '_BookmeMB_attorney_testi_cat', true);
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
										<div id="testimonial-movers">
											<div class="owl-carousel owl-theme">
												<?php $count = '0'; ?>
												<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?>
													<div class="item col-md-12">
														<div class="main-post">
															<i class="fa fa-4x fa-quote-left"></i>
															<p><?php echo bookme_excerpt(25); ?></p>
														</div>
														<div class="row testimonials-author">
															<div class="col-md-1 col-sm-2 col-xs-2">
																<div class="row">
																	<?php if ( has_post_thumbnail() ) the_post_thumbnail('bookme_testimonial_thumbnail'); ?>
																</div>
															</div>
															<div class="col-md-11 col-sm-10 col-xs-10">
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
													<?php $count = $count+0.5; ?>
												<?php endwhile; ?>
											</div>
										</div><!-- #testimonial-movers -->
								<?php endif; wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php 
					$callout_img = get_post_meta(get_the_ID(), '_BookmeMB_attorney_testimonial_callout_img', true);
					$callout_content = get_post_meta(get_the_ID(), '_BookmeMB_attorney_testimonial_callout_content', true);
					if ( $callout_content ) : ?>
						<div class="container">
							<div class="testimonials-callout">
								<div class="container">
									<div class="row">
										<div class="testimonials-callout-entry col-md-12">
											<?php 
												if ( $callout_content ) 
													echo '<div class="testimonials-callout-post-content">' . $callout_content . '</div>';
											?>
											<?php 
												
												if ( $callout_img )
													echo '<div class="testimonials-callout-img"><img src="' . esc_url($callout_img) . '" alt="" /></div>';
											?>
										</div>
									</div>
								</div>
							</div><!-- /.testimonials-callout -->
						</div><!-- /.container -->
				<?php endif; ?>
			</div><!-- /.testimonial-wrapper -->
		</section><!-- #testimonials -->
<?php endif; ?>
