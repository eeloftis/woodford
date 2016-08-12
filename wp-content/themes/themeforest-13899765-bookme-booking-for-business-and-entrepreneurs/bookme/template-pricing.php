<?php
/**
 * Template Name: Pricing
 *
 */

get_header(); global $bookme_option; ?>

	<?php bookme_before_page(); ?>

	<?php if ( have_posts() ) : 

			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
			
				<section id="pricing">
					<div class="post header-section text-center">
						<?php 
							$sub_title = get_post_meta(get_the_ID(), '_BookmeMB_pricing_page_subtitle', true);
							if ( $sub_title ) echo '<div class="title"><h2>' . esc_attr( $sub_title ) . '</h2></div>';
							echo '<div class="page-entry">' . the_content() . '</div>';
						?>
					</div>
					<?php 
						$price_cat = get_post_meta(get_the_ID(), '_BookmeMB_pricing_cat', true);
						if ( $price_cat ) {
							$term_ids = array($price_cat);
						} else {
							$terms = get_terms( 'pricing_category' ); 
							$term_ids = wp_list_pluck( $terms, 'term_id' );
						}
						$pricing_args = array(
							'post_type' => 'bookme_pricing',
							'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'pricing_category',
										'field' => 'term_id',
										'terms' => $term_ids,
									),
								),
						);
						$pricing = new WP_Query( $pricing_args );
						$row = 0;
						if ( $pricing->have_posts() ) :
							echo '<div class="row">';
							
							while ( $pricing->have_posts() ) : $pricing->the_post(); 
								if ( $row == 2 ) {
									echo '</div><div class="row">';
									$row = 0;
								} 
								
								$box_style = $value_style = $header_style = '';
								$box_bg = get_post_meta(get_the_ID(), '_BookmeMB_pricing_box_bg_color', true); 
								if ( $box_bg )
									$box_style = 'style="background-color: ' . $box_bg . ';"';
								$header_bg = get_post_meta(get_the_ID(), '_BookmeMB_pricing_header_bg_color', true); 
								if ( $header_bg )
									$header_style = 'style="background-color: ' . $header_bg . ';"';
								$value_bg = get_post_meta(get_the_ID(), '_BookmeMB_pricing_value_bg_color', true); 
								if ( $value_bg )
									$value_style = 'style="background-color: ' . $value_bg . ';"';
								?>
								<div class="col-md-6">
									<div class="pricing-box" <?php echo $box_style; ?>>
										<div class="pricing-header" <?php echo $header_style; ?>>
											<div class="title">
												<h2><?php the_title(); ?></h2>
											</div>
											<?php 
												$pricing_desc = get_post_meta(get_the_ID(), '_BookmeMB_pricing_desc', true);
												$pricing_value = get_post_meta(get_the_ID(), '_BookmeMB_pricing_price', true);
												if ( $pricing_desc ) echo '<p>' . esc_attr( $pricing_desc ) . '</p>';
												if ( $pricing_value ) echo '<div class="pricing-value" ' . $value_style . '><span>' . round( esc_attr( $pricing_value ) ). '</span></div>';
											?>
										</div>
										<div class="pricing-content">
											<?php 
												$pricing_feature = get_post_meta(get_the_ID(), '_BookmeMB_pricing_feature', true);
												if ( $pricing_feature ) {
													echo '<ul>';
													foreach( $pricing_feature as $feature ) {
														echo '<li>' . esc_attr($feature) . '</li>';
													}
													echo '</ul>';
												}
												$book_text = get_post_meta(get_the_ID(), '_BookmeMB_pricing_btn_text', true);
												$book_url = get_post_meta(get_the_ID(), '_BookmeMB_pricing_btn_url', true);
												if ( $book_url ) {
													echo '<a href="' . esc_attr( $book_url ) . '" class="btn btn-two">';
													if ( $book_text ) {
														echo esc_attr( $book_text );
													} else {
														echo esc_html__('Book Now', 'bookme');
													}
													echo '</a>';
												}
											?>
										</div>
									</div>
								</div><?php 
								$row++;
							endwhile;
							
							echo '</div>';
						endif; wp_reset_postdata(); ?>

				</section>
				
		<?php	
			endwhile;

		else :
			get_template_part( 'content', 'none' );

		endif; 
		
		bookme_after_page(); 
	
	get_template_part('template-parts/section/footer', 'quote'); 
		
get_footer(); ?>