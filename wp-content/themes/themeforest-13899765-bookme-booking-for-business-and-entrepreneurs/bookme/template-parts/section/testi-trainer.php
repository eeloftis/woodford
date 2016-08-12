<?php 
/*
 * Section Testimonials Trainer
 *
 */

	$testi_small_text = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_small_text', true);
	$testi_title = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_title', true);
	if ( $testi_small_text || $testi_title ) : ?>
		<!-- === Section Testimonials === -->
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
			$testi_post = new WP_Query( $testi_args );
		?>
				<section id="testimonials">
					<div class="testimonials-wrapper wow fadeInDown">
					<?php if ( $testi_post->have_posts() ) : ?>
						<div class="col-md-6">
							<div class="row">
								<div id="testimonial-trainer-img" class="owl-carousel owl-theme">
									<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?>
										<div class="item">
											<?php 
												if ( has_post_thumbnail() ) :
													the_post_thumbnail('bookme_trainer_testi');
												else : ?>
												<img src="http://lorempixel.com/925/420" alt="">
											<?php endif; ?>
										</div>
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					<?php endif; wp_reset_postdata(); ?>
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="testimonials-item">
									<div class="post">
										<?php if ($testi_small_text) : ?>
											<div class="small-title">
												<h4><?php echo esc_attr($testi_small_text); ?></h4>
											</div>
										<?php endif; ?>
										<?php if ($testi_title) : ?>
											<h2 class="title"><?php echo esc_attr($testi_title); ?></h2>
										<?php endif; ?>
										<?php if ( $testi_post->have_posts() ) : ?>
											<div id="testimonial-trainer-content" class="owl-carousel owl-theme">
												<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?>
													<div class="item">
														<div class="title">
															<h4><?php the_title(); ?></h4>
														</div>
														<p><?php echo bookme_excerpt(25); ?></p>
													</div>
												<?php endwhile; ?>
											</div>
										<?php endif; wp_reset_postdata(); ?>
									</div>
								</div>
							</div>
						</div><!--/.row-->
					</div><!--/.container-->
					</div>
				</section><!-- #testimonials -->
<?php endif; ?>
