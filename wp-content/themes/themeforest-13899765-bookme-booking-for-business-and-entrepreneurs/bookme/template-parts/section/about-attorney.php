<?php 
/*
 * Section About Attorney
 *
 */

	$about_small_title = get_post_meta(get_the_ID(), '_BookmeMB_attorney_about_small_title', true);
	$about_content = get_post_meta(get_the_ID(), '_BookmeMB_attorney_about_content', true);
	if ( $about_small_title || $about_content ) : ?>
		<section id="about">
			<div class="container wow fadeInDown">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="post">
							<?php if ( $about_small_title ) : ?>
								<div class="small-title">
									<h4><?php echo esc_attr( $about_small_title ); ?></h4>
								</div>
							<?php endif; ?>
							<?php if ( $about_content ) : ?>
								<?php echo wp_kses_post($about_content); ?>
								<?php 
									$more_text = get_post_meta(get_the_ID(), '_BookmeMB_attorney_abt_more_text', true);
									$more_url = get_post_meta(get_the_ID(), '_BookmeMB_attorney_abt_more_url', true);
									if ( $more_url ) : ?>
										<a class="btn btn-two" href="<?php echo esc_url($more_url); ?>">
											<?php 
												if ( $more_text ) { 
													echo esc_attr( $more_text );
												} else { 
													echo esc_html__('Read More', 'bookme');
												}
											?>
										</a>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
					<?php 
						$client_cat = get_post_meta(get_the_ID(), '_BookmeMB_attorney_clients_cat', true);
						if ( $client_cat ) {
							$term_ids = array($client_cat);
						} else {
							$terms = get_terms( 'client_category' ); 
							$term_ids = wp_list_pluck( $terms, 'term_id' );
						}
						$clients = array(
							'post_type' => 'bookme_client',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'client_category',
									'field' => 'term_id',
									'terms' => $term_ids,
								),
							),
						);
						$client = new WP_Query( $clients );
						$row = 1;									
						if ( $client->have_posts() ) : ?>
							<div class="col-md-6 col-sm-6">
								<div class="row">
									<div class="clients-item-wrap clearfix">
										<?php 
											while ( $client->have_posts() ) : $client->the_post(); 
												if($row==4):// cut the row and add new one if row limit reached
													echo '</div><div class="clients-item-wrap clearfix">';
													$row=1;
												endif; ?>

												<div class="border-left col-md-4 col-sm-4 col-xs-4">
													<div class="clients-item">
														<?php 
															$client_url = get_post_meta(get_the_ID(), '_BookmeMB_clients_url_detil', true);
															if ( $client_url ) 
																echo '<a href="' . esc_url( $client_url ) . '">';
															if ( has_post_thumbnail() )
																the_post_thumbnail();
															if ( $client_url ) 
																echo '</a>';
														?>
													</div>
												</div>
										<?php $row++; endwhile; ?>
									</div>
								</div>
							</div>
					<?php endif; wp_reset_postdata(); ?>
				
				</div>
			</div><!--/.container-->
		</section><!-- #about -->

<?php endif;
