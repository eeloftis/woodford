<?php 
/*
 * Architect Testimonials
 *
 */
 
$testimonials = get_post_meta(get_the_ID(), '_BookmeMB_architect_testimonials');
if ( $testimonials == true ) : 
	$testi_cat = get_post_meta(get_the_ID(), '_BookmeMB_architect_testi_cat', true);
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
		<div id="testimonials">
			<div class="container">
				<div class="col-md-12">
					<div class="text-center">
						<div class="box-testimonials">
						</div>
						<div class="row">
							<div id="testimonial-architect" class="owl-carousel owl-theme wow zoomIn animated">
								<?php while ( $testi_post->have_posts() ) : $testi_post->the_post(); ?> 
									<div class="item">
										<div class="testimonials-author">
											<?php if (has_post_thumbnail()) the_post_thumbnail('bookme_arc_testi'); ?>		
											<div class="title"><?php the_title(); ?></div>
											<?php
												$client_pos = get_post_meta(get_the_ID(), '_BookmeMB_clients_position', true); 
												if ($client_pos) echo '<div class="small-title">' . esc_attr($client_pos) . '</div>';
											?>
											<?php echo bookme_content(30); ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.container-->
		</div><?php
	endif; wp_reset_postdata(); 
endif;
