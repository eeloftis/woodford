<?php 
/*
 * Section Testimonials Therapy
 *
 */

	$testi_small_text = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_small_text', true);
	$testi_title = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_title', true);
	if ( $testi_small_text || $testi_title ) : ?>
		<section id="testimonials">
			<div class="testimonials-wrapper">
				<div class="container wow fadeInDown">
					<div class="col-md-12">
						<div class="post header-section text-center">
							<?php if ($testi_small_text) : ?>
								<div class="small-title">
									<h4><?php echo esc_attr($testi_small_text); ?></h4>
								</div>
							<?php endif; ?>
							<?php if ($testi_title) : ?>
								<h2 class="title"><?php echo esc_attr($testi_title); ?></h2>
							<?php endif; ?>
						</div>
					</div>
					<?php 
						$testi_cat = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testi_cat', true);
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
						$testi_post = new WP_Query($testi_args);
						if ( $testi_post->have_posts() ) : ?>
							<div class="col-md-12">
								<div id="testimonial-therapy" class="owl-carousel owl-theme">
									<?php $count = '0'; ?>
									<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?>
										<div class="item col-md-12">
											<div class="testimonials-content">
												<?php echo bookme_excerpt(25); ?>
											</div>
											<div class="row testimonials-author">
												<div class="triangles">
													<div class="triangle-topleft"></div>
												</div>
												<?php if ( has_post_thumbnail() ) : ?>
													<div class="col-md-1 col-sm-2 col-xs-2">
														<div class="row">
															<?php the_post_thumbnail('bookme_testimonial_thumbnail'); ?>
														</div> 
													</div>
												<?php endif; ?>
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
							</div>
					<?php endif; wp_reset_postdata(); ?>
				</div><!--/.container-->
			</div>
		</section><!-- #testimonials -->
<?php endif; ?>
