<?php 
/*
 * Barber Testi
 *
 */

$sect_bg_img = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonials_bg_img', true);
$sect_bg_color = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonials_bg_color', true);
$bg_img = $bg_color = '';
if ( $sect_bg_img )
	$bg_img = 'style="background-image: url('.esc_url($sect_bg_img).'); background-repeat: no-repeat; background-size: cover;"';
if ( $sect_bg_color ) 
	$bg_color = 'style="background-color: '.$sect_bg_color.';"';
$sect_small_text = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_small_text', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonial_title', true);
if ( $sect_small_text || $sect_title ) : ?>
	<section id="testimonials" <?php echo $bg_img; ?>>
		<div class="barber-testimonials-wrapper" <?php echo $bg_color; ?>>
			<div class="container wow fadeInDown">
				<div class="row">
					<div class="col-md-12">
						<div class="post header-section text-center">
							<?php 
								if ( $sect_small_text ) echo '<div class="small-title"><h4>' . esc_attr($sect_small_text). '</h4></div>';
								if ( $sect_title ) echo '<h3 class="title">' . $sect_title . '</h3>';
							?>
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
							'posts_per_page' => 5,
							'tax_query' => array(
								array(
									'taxonomy' => 'testi_category',
									'field' => 'term_id',
									'terms' => $term_ids,
								),
							),
						);
						$testi = new WP_Query($testi_args);
						if ($testi->have_posts()) :
							echo '<div class="col-md-12"><div class="row">';
							echo '<div class="col-md-4 col-md-push-4">';
							$post_count = 1;
							while ($testi->have_posts()) : $testi->the_post();
								if ( $post_count == 1 ) : ?>
										<div class="testimonials-item row">
											<div class="col-md-12 col-sm-6">
												<?php if (has_post_thumbnail()) the_post_thumbnail('bookme_barber_testi_thumb'); ?>
											</div>
											<div class="col-md-12 col-sm-6">
            									<div class="content-center">
													<h5 class="title"><?php the_title(); ?></h5>
													<p><?php echo bookme_excerpt(14); ?></p>
												</div>
											</div>
										</div>
									</div><div class="col-md-4 col-md-pull-4 testi-left"><?php
								else : 
									if ( $post_count == 4 ) {
										echo '</div><div class="col-md-4 testi-right">';
									} ?>
										<div class="col-md-12 col-sm-6">
											<div class="testimonials-item row">
												<?php if ( $post_count < 4 ) : ?>
													<div class="col-md-6 col-sm-6">
														<div class="row">
															<?php if (has_post_thumbnail()) the_post_thumbnail('bookme_barber_testi_small_thumb'); ?>
				            							</div>
				            						</div>
				            					<?php endif; ?>
				            					<?php if ( $post_count < 4 ) : ?>
													<div class="col-md-6 col-sm-6 text-left">
												<?php else : ?>
													<div class="col-md-6 col-sm-6 text-right">
												<?php endif; ?>
													<h5 class="title"><?php the_title(); ?></h5>
													<div class="testi-entry"><p><?php echo bookme_excerpt(14); ?></p></div>
												</div>
												<?php if ( $post_count > 3 ) : ?>
													<div class="col-md-6 col-sm-6">
														<div class="row">
															<?php if (has_post_thumbnail()) the_post_thumbnail('bookme_barber_testi_small_thumb'); ?>
														</div>
				            						</div>
				            					<?php endif; ?>
											</div>
										</div><?php 
								endif; $post_count++;
							endwhile;
							echo '</div></div></div>';
						endif; wp_reset_postdata(); 
					?>
				</div>
			</div>
		</div>
	</section><?php
endif;
