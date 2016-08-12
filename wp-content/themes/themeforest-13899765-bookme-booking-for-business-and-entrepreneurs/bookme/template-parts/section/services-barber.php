<?php 
/*
 * Services Barber
 *
 */
 
$sect_small_text = get_post_meta(get_the_ID(), '_BookmeMB_barber_services_small_text', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_barber_services_title', true);
$sect_content = get_post_meta(get_the_ID(), '_BookmeMB_barber_services_desc', true);
if ( $sect_small_text || $sect_title || $sect_content ) : ?>
	<section id="services">
		<div class="container-fluid">
			<div class="row wow fadeInUp">
				<div class="col-md-3 col-sm-12">
					<div class="services-wrapper">	
						<?php 
							if ( $sect_small_text ) 
								echo '<div class="small-title"><h3>' . esc_attr($sect_small_text) . '</h3></div>';
							if ( $sect_title )
									echo '<h2 class="title">' . $sect_title . '</h2>';
							if ( $sect_content ) 
								echo wp_kses_post($sect_content);
						?>
					</div>
				</div>
				<?php 
					$barber_cat = get_post_meta(get_the_ID(), '_BookmeMB_barber_services_cat', true);
					if ( $barber_cat ) {
						$term_ids = array($barber_cat);
					} else {
						$terms = get_terms( 'service_category' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$barber_args = array(
						'post_type' => 'bookme_service',
						'posts_per_page' => 6,
						'tax_query' => array(
							array(
								'taxonomy' => 'service_category',
								'field' => 'term_id',
								'terms' => $term_ids,
							),
						),
					);
					$barber = new WP_Query($barber_args);
					if ( $barber->have_posts() ) : 
						echo '<div class="col-md-9 col-sm-12"><div class="main-services-item row">';
						$count = '0';
						while ($barber->have_posts()) : $barber->the_post(); ?>
							<div class="col-md-4 col-sm-6">
								<div class="row">
									<div class="services-item">
										<div class="services-item-hover">
											<div class="services-btn"><a class="btn" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More', 'bokme'); ?></a></div>
										</div>
										<div class="service-content">
											<?php 
												$icon = get_post_meta(get_the_ID(), '_BookmeMB_service_post_icon', true);
												$icon_img = get_post_meta(get_the_ID(), '_BookmeMB_service_post_icon_img', true);
												if ( $icon_img ) 
													echo '<div class="icon-img"><img src="' . esc_url($icon_img) . '" alt=""></div>';
												elseif ( $icon )
													echo '<i class="fa '.$esc_attr($icon).'"></i>';
											?>
											<h5 class="title"><?php the_title(); ?></h5>
											<?php the_excerpt(); ?>
										</div>
									</div>
								</div>
							</div><?php 
							$count = $count+0.5;
						endwhile;
						echo '</div></div>';
					endif; wp_reset_postdata();  
				?>
			</div>
		</div>
	</section><?php 
endif;
