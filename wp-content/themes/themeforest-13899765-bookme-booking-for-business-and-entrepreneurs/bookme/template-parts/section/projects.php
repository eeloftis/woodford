<?php 
/*
 * Section Projects
 *
 */

	$pro_small_text = get_post_meta(get_the_ID(), '_BookmeMB_project_small_text', true);
	$pro_title = get_post_meta(get_the_ID(), '_BookmeMB_project_title', true);
	if ( $pro_small_text || $pro_title ) : ?>
		<!-- === Section Projects === -->
		<section id="projects" class="clearfix">
			<div class="projects-wrapper wow fadeInDown">
				<div class="col-md-6">
					<div class="row">
						<div class="projects-item">
							<?php 
								if ( $pro_small_text ) { 
									echo '<div class="title">';
									echo '<h4>' . esc_attr( $pro_small_text ) . '</h4>';
									echo '</div>';
								}
								if ( $pro_title ) { 
									echo '<h2 class="title">' . esc_attr( $pro_title ) . '</h2>';
								}
							?>
							<?php
								$project_type = get_post_meta(get_the_ID(), '_BookmeMB_projects_type', true);
								if ( $project_type ) {
									$term_ids = array($project_type);
								} else {
									$terms = get_terms( 'project_type' ); 
									$term_ids = wp_list_pluck( $terms, 'term_id' );
								}
								$projects = array(
									'post_type' => 'bookme_project',
									'posts_per_page' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'project_type',
											'field' => 'term_id',
											'terms' => $term_ids,
										),
									),
								);
								$project = new WP_Query( $projects );
							?>
							<?php if ( $project->have_posts() ) : ?>
								<div id="project-mover-content" class="owl-carousel owl-theme">
									<?php 		
										while ( $project->have_posts() ) : $project->the_post(); 
									?>
										<div class="item">
											<h3><?php the_title(); ?></h3>
											<?php echo bookme_content(70); ?>
										</div>
									<?php endwhile; ?>
								</div>
								<?php echo '<div class="link-more"><a href="' . get_the_permalink() . '">' . __('View Gallery ', 'bookme') . '<span class="lnr lnr-arrow-right"></span></a></div>'; ?>
							<?php endif;
							wp_reset_postdata(); ?>
									
						</div>
					</div>
				</div><!--/.col-md-6-->
				<div class="col-md-6">
					<div class="row">
						<?php if ( $project->have_posts() ) : ?>
							<div id="project-mover-img" class="owl-carousel owl-theme">
								<?php 		
									while ( $project->have_posts() ) : $project->the_post(); 
								?>
									<div class="item">
										<?php if ( has_post_thumbnail() ) the_post_thumbnail('bookme_project_slide'); ?>
									</div>
									<?php endwhile; ?>
							</div>
						<?php endif;
							wp_reset_postdata(); 
						?>
					</div>
				</div><!--/.col-md-6-->
			</div><!--/.projects-wrapper-->
		</section><!-- #projects -->
	<?php endif; ?>
