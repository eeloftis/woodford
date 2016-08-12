<?php 
/* 
 * Pricing Barber
 *
 */
 
$sect_small_text = get_post_meta(get_the_ID(), '_BookmeMB_barber_pricing_small_text', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_barber_pricing_subtitle', true); 
if ( $sect_small_text || $sect_title ) : ?>
	<section id="prices">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="header-section text-center">
						<?php 
							if ( $sect_small_text ) echo '<div class="small-title"><h4>' . esc_attr( $sect_small_text) . '</h4></div>';
							if ( $sect_title ) echo '<h3 class="title">' . esc_attr( $sect_title) . '<i class="dot">&nbsp;</i></h3>';
						?>
					</div>
				</div>
				<?php 
					$barber_cat = get_post_meta(get_the_ID(), '_BookmeMB_barber_pricing_cat', true);
					if ( $barber_cat ) {
						$term_ids = array($barber_cat);
					} else {
						$terms = get_terms( 'pricing_category' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$barber_args = array(
						'post_type' => 'bookme_pricing',
						'posts_per_page' => 6,
						'tax_query' => array(
							array(
								'taxonomy' => 'pricing_category',
								'field' => 'term_id',
								'terms' => $term_ids,
							),
						),
					);
					$barber = new WP_Query($barber_args);
					$count = '0';
					while ( $barber->have_posts() ) : $barber->the_post(); ?>
						<div class="col-md-3">
							<div class="row">
								<div class="prices-item text-center">
									<div class="prices-item-hover">
										<?php 
											$btn_text = get_post_meta(get_the_ID(), '_BookmeMB_pricing_btn_text', true);
											$btn_url = get_post_meta(get_the_ID(), '_BookmeMB_pricing_btn_url', true);
											if ( $btn_url ) : ?>
												<div class="prices-btn">
													<a class="btn btn-two" href="<?php echo esc_url($btn_url); ?>">
														<?php if ( $btn_text ) { echo esc_attr($btn_text); } else { echo esc_html__('Book Me', 'bookme'); } ?>
													</a>
												</div>
										<?php endif; ?>
									</div>
									<div class="prices-content">
										<?php 
											$barber_price = get_post_meta(get_the_ID(), '_BookmeMB_pricing_price', true);
											$price = mb_substr($barber_price, 0, -3);
											if ( $price ) echo '<h4 class="title price-number">' . $price . '</h4>';
										?>
										<h5 class="title"><?php the_title(); ?></h5>
										<?php 
											$desc = get_post_meta(get_the_ID(), '_BookmeMB_pricing_desc', true);
											if ( $desc ) echo '<p>' . $desc . '</p>';
										?>
									</div>
								</div>
							</div>
						</div><?php 
						$count = $count+0.5;
					endwhile; wp_reset_postdata(); 
				?>
			</div>
		</div>
	</section><?php 
endif;
