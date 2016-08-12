<?php 
/*
 * Section Architect Services
 *
 */

$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_architect_small_text', true);
$sect_content = get_post_meta(get_the_ID(), '_BookmeMB_architect_content', true);
if ( $sect_title || $sect_content ) : ?>
	<section id="services">
		<div class="container pull-center">
			<div class="row">
				<div class="col-md-12 wow fadeInDown">
					<div class="header-section text-center">
						<?php if ( $sect_title ) echo '<div class="small-title"><h3>' . esc_attr($sect_title) . '</h3></div>'; ?>
						<?php if ( $sect_content ) echo wp_kses_post($sect_content); ?>
					</div>
				</div>
				<?php 
					$service_cat = get_post_meta(get_the_ID(), '_BookmeMB_architect_service_cat', true);
					if ( $service_cat ) {
						$term_ids = array($service_cat);
					} else {
						$terms = get_terms( 'service_category' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$service_args = array(
						'post_type' => 'bookme_service',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'service_category',
								'field' => 'term_id',
								'terms' => $term_ids,
							),
						),
					); 
					$service = new WP_Query( $service_args );
					if ( $service->have_posts() ) : 
						echo '<div class="col-md-12 wow fadeInUp"><div class="row">';
						$row = 0;
						
						while( $service->have_posts() ) : $service->the_post();
							if ( $row == 4 ) {
								echo '</div><div class="row">';
								$row = 0;
							} ?>
							<div class="services-wrapper">
								<div class="services-item">
									<div class="post text-center">
										<?php 
											$icon = get_post_meta(get_the_ID(), '_BookmeMB_service_post_icon', true);
											$icon_img = get_post_meta(get_the_ID(), '_BookmeMB_service_post_icon_img', true);
											if ( $icon_img ) {
												echo '<div class="icon-img"><img src="'.esc_url($icon_img).'" alt=""></div>';
											} elseif ( $icon ) {
												echo '<i class="fa '.esc_attr($icon).'"></i>';
											}
										?>
										<div class="title-regular">
											<h5><?php the_title(); ?></h5>
										</div>
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink(); ?>"><span class="lnr lnr-arrow-right-circle"></span></a>
									</div>
								</div>
							</div><?php $row++;
						endwhile; 
								
						echo '</div></div>';
					endif; wp_reset_postdata(); 
				?>
			</div>
		</div>
	</section><?php 
endif;
