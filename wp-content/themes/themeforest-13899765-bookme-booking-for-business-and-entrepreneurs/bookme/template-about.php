<?php
/**
 * Template Name: About Page
 *
 */

get_header(); global $bookme_option;

		if ( have_posts() ) : 
		
		bookme_entry_header();

			while ( have_posts() ) : the_post(); 
						
				get_template_part('template-parts/section/about');
				get_template_part('template-parts/section/facts'); ?>				
				
				<!-- === Section Teams === -->
				<?php 
					$team_small_text = get_post_meta(get_the_ID(), '_BookmeMB_team_small_text', true);
					$team_title = get_post_meta(get_the_ID(), '_BookmeMB_team_title', true);
					$team_desc = get_post_meta(get_the_ID(), '_BookmeMB_team_desc', true);
					if ( $team_small_text || $team_title || $team_desc ) : ?>
						<section id="teams">
							<div class="container wow fadeInDown">
								<div class="row">
									<div class="col-md-12">
										<div class="post header-section text-center">
											<?php if ( $team_small_text ) : ?>
												<div class="small-title">
													<h3><?php echo esc_attr($team_small_text); ?></h3>
												</div>
											<?php endif; ?>
											<?php if ( $team_title ) : ?>
												<h2 class="title"><?php echo esc_attr($team_title); ?></h2>
											<?php endif; ?>
											<?php if ( $team_desc ) : ?>
											<p><?php echo esc_attr($team_desc); ?></p>
										<?php endif; ?>
										</div>
									</div>
									<?php 
										$team_cat = get_post_meta(get_the_ID(), '_BookmeMB_team_cat', true);
										if ( $team_cat ) {
											$term_ids = array($team_cat);
										} else {
											$terms = get_terms( 'team_category' ); 
											$term_ids = wp_list_pluck( $terms, 'term_id' );
										}
										$team_args = array(
											'post_type' => 'bookme_team',
											'posts_per_page' => -1,
											'tax_query' => array(
												array(
													'taxonomy' => 'team_category',
													'field' => 'term_id',
													'terms' => $term_ids,
												),
											),
										);
										$team = new WP_Query( $team_args );
										if ( $team->have_posts() ) : ?>
											<div class="col-md-12">
												<div class="row">
													<?php $count = 0; ?>
													<?php while ( $team->have_posts() ) : $team->the_post(); ?>
														<div class="col-md-3 col-sm-6">
															<div class="teams-item">
																<?php if ( has_post_thumbnail() ) the_post_thumbnail('bookme_team_thumbnail'); ?>
																<div class="teams-entry">
																	<div class="title">
																		<h3><?php the_title(); ?></h3>
																	</div>
																	<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_team_email', true) != '' ) : ?>
																		<div class="small-title">
																			<?php echo get_post_meta(get_the_ID(), '_BookmeMB_team_email', true); ?>
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
								</div><!--/.row-->
							</div><!--/.container-->
						</section><!--#teams-->
				<?php endif; 
				
				get_template_part('template-parts/section/about', 'details');
							
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		
	get_template_part('template-parts/section/footer', 'quote');
		
get_footer(); ?>
