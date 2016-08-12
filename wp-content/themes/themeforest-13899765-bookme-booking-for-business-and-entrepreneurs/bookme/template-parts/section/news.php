<?php 
/*
 * Section News
 *
 */
 
	$news_small_text = get_post_meta(get_the_ID(), '_BookmeMB_news_small_text', true);
	$news_title = get_post_meta(get_the_ID(), '_BookmeMB_news_title', true);
	$news_desc = get_post_meta(get_the_ID(), '_BookmeMB_news_desc', true);
	if ( $news_small_text || $news_title || $news_desc ) : ?>
		<section id="news">
			<div class="container">
				<div class="row wow fadeInLeft">
					<div class="col-md-4 col-sm-12 ">
								
						<div class="post">
									
							<?php if ( $news_small_text ) : ?>
								<div class="small-title">
									<h4><?php echo esc_attr( $news_small_text ); ?></h4>
								</div>
							<?php endif; ?>
											
							<?php if ( $news_title ) : ?>
								<div class="title">
									<h2><?php echo esc_attr( $news_title ); ?></h2>
								</div>
							<?php endif; ?>
											
							<?php if ( $news_desc ) : ?>
								<p><?php echo esc_attr( $news_desc ); ?></p>
							<?php endif; ?>
											
							<?php 
								$news_link = get_post_meta(get_the_ID(), '_BookmeMB_news_more_url', true);
								$news_more = get_post_meta(get_the_ID(), '_BookmeMB_news_more_text', true);
								if ( $news_link ) : ?>
									<a class="btn btn-two" href="<?php echo esc_url( $news_link ); ?>">
										<?php if ( $news_more ) { echo esc_attr( $news_more ); } else { echo esc_html__('More News', 'bookme'); } ?>
									</a>
							<?php endif; ?>
											
						</div><!-- post -->
									
					</div><!-- col-md-4 -->
									
					<?php 
						$post_tag = get_post_meta(get_the_ID(), '_BookmeMB_news_post_tag', true);
						if ( $post_tag ) {
							$term_ids = array($post_tag);
						} else {
							$terms = get_terms( 'post_tag' ); 
							$term_ids = wp_list_pluck( $terms, 'term_id' );
						}
						$post = array(
							'post_type' => 'post',
							'posts_per_page' => 2,
							'tax_query' => array(
								array(
									'taxonomy' => 'post_tag',
									'field' => 'term_id',
									'terms' => $term_ids,
								),
							),
						);
						$news_post = new WP_Query( $post );
						$count = '0';
						if ( $news_post->have_posts() ) : 
							while ( $news_post->have_posts() ) : $news_post->the_post(); ?>
											
								<div class="col-md-4 col-sm-6">
												
									<div class="post">
													
										<?php 
											if ( has_post_thumbnail() ) {
												the_post_thumbnail('bookme_news_thumbnail');
											} else {
												echo '<img src="http://placehold.it/360x236">';
											}
										?>
										<div class="news-entry">
											<div class ="title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</div>
											<span class="news-date"><?php echo get_the_date(); ?> </span>
											<span class="news-cat"><?php the_terms( $post->ID, 'category', 'In : ', ' / ' ); ?></span>
										</div>
										<a class="link-more" href="<?php echo get_permalink( $post->ID ); ?>"><?php echo wp_kses_post(__('Read more <span class="lnr lnr-arrow-right"></span>', 'bookme')); ?></a>

									</div>
												
								</div><?php
								$count = $count+0.5;
							endwhile;
						endif; wp_reset_postdata(); ?>
					</div>
				</div><!-- container -->
			</section><!-- #news -->
	<?php endif; ?>
