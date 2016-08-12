<?php 
/*
 * Section Architect Projects
 *
 */

$pro_small_text = get_post_meta(get_the_ID(), '_BookmeMB_project_small_text', true);
$pro_title = get_post_meta(get_the_ID(), '_BookmeMB_project_title', true);
$pro_content = get_post_meta(get_the_ID(), '_BookmeMB_project_content', true);
if ( $pro_small_text || $pro_title || $pro_content ) : ?>
	<section id="projects">
		<div class="container">
			<div class="row">
				<div class="col-md-12 wow fadeInDown">
					<div class="header-section text-center">
						<?php if ($pro_small_text) : ?>
							<div class="small-title">
								<h3><?php echo wp_kses_post($pro_small_text); ?></h3>
							</div>
						<?php endif; ?>
						<?php if ($pro_title) : ?>
						<?php endif; ?>
						<?php if ($pro_content) echo wp_kses_post($pro_content); ?>
						<?php 
							$terms = get_terms( 'project_category', array('hide_empty' => 0) ); 
							if ( $terms ) {
								echo '<ol class="projects-category">';
								echo '<li><a href="#" class="active" data-filter="*">' . __('All', 'bookme') . '</a></li>';
								foreach($terms as $term) {
									echo '<li><a href="#' . $term->term_id . '" data-filter=".cat-'.$term->slug.'">'.$term->name.'</a></li>';
								}
								echo '</ol>';
							}
						?>
					</div>
				</div>
				<?php 
					$project_type = get_post_meta(get_the_ID(), '_BookmeMB_projects_type', true);
					if ( $project_type ) {
						$term_ids = array($project_type);
					} else {
						$terms = get_terms( 'project_type' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$project_args = array(
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
					$project = new WP_Query( $project_args );
					if ( $project->have_posts() ) :  
						echo '<div class="main-projects wow fadeInUp">';
						
						while ( $project->have_posts() ) : $project->the_post(); 
							$post_terms = get_the_terms( get_the_ID(), 'project_category' ); 
							$on_term = '';
							if ( $post_terms && ! is_wp_error( $post_terms ) ) : 
								$the_term = array();
								foreach ( $post_terms as $post_term ) {
									$the_term[] = 'cat-'.$post_term->slug;
								}
								$on_term = join( ' ', $the_term );
							endif; ?>
							
							<div class="projects-item col-sm-4 col-md-4 <?php echo $on_term; ?>">
								<div class="projects-item-inner">
									<div class="projects-item-hover">
										<div class="title">
											<h4><?php the_title(); ?></h4>
										</div>
										<?php echo bookme_content(16); ?>
										<a href="<?php the_permalink(); ?>"><?php echo esc_html__('View More', 'bookme'); ?> <span class="lnr lnr-arrow-right"></span></a>
									</div>
									<?php if ( has_post_thumbnail() ) { the_post_thumbnail('bookme_project_thumb'); } else { echo '<img src="http://placehold.it/350x150">'; } ?>
								</div>
							</div><?php 
						endwhile;
						echo '</div>';
					endif; wp_reset_postdata(); 
				?>
			</div>
		</div><!--/.container-->
	</section><!-- #projects --><?php 
endif;
