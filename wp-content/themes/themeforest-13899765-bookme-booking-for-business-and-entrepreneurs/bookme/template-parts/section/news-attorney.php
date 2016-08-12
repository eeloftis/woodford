<?php 
/*
 * Section News Attorney
 *
 */

$news_small_text = get_post_meta(get_the_ID(), '_BookmeMB_attorney_news_small_text', true);
$news_title = get_post_meta(get_the_ID(), '_BookmeMB_attorney_news_title', true);
if ( $news_small_text || $news_title ) : ?>
	<section id="news">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="post header-section text-center">
						<?php if ( $news_small_text ) : ?>
							<div class="small-title">
								<h4><?php echo esc_attr( $news_small_text ); ?></h4>
							</div>
						<?php endif; ?>
						<?php if ( $news_title ) echo '<h2 class="title">' . esc_attr( $news_title ) . '</h2>'; ?>
					</div>
				</div>
				<?php 
					$news_tag = get_post_meta(get_the_ID(), '_BookmeMB_attorney_post_tag', true);
					if ( $news_tag ) {
						$term_ids = array($news_tag);
					} else {
						$terms = get_terms( 'post_tag' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$news_args = array(
						'post_type' => 'post',
						'posts_per_page' => 1,
						'ignore_sticky_posts' => true,
						'tax_query' => array(
							array(
								'taxonomy' => 'post_tag',
								'field' => 'term_id',
								'terms' => $term_ids,
							),
						),
					);
					$news = new WP_Query( $news_args );
					if ( $news->have_posts() ) : ?>
						<div class="col-md-6 col-sm-12">
							<?php while ( $news->have_posts() ) : $news->the_post(); ?>
								<div class="post">
									<?php 
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('bookme_att_news_big_thumbnail');
										} else {
											echo '<img src="http://placehold.it/555x363">';
										}
									?>
									<div class="row">
										<div class="col-md-8 col-sm-12">
											<div class="news-entry">
												<div class ="title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</div>
												<span class="news-date"><?php echo the_time('M d, Y'); ?></span>
												<span class="news-cat"><?php the_terms( $post->ID, 'category', 'In : ', ' / ' ); ?></span>
											</div>
										</div>
										<div class="col-md-4 col-sm-12 text-right">
											<div class="news-entry">
												<a class="link-more" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read more ', 'bookme'); ?><span class="lnr lnr-arrow-right"></span></a>
											</div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
				<?php endif; wp_reset_postdata(); ?>
				<?php 
					$news_tag = get_post_meta(get_the_ID(), '_BookmeMB_attorney_post_tag', true);
					if ( $news_tag ) {
						$term_ids = array($news_tag);
					} else {
						$terms = get_terms( 'post_tag' ); 
						$term_ids = wp_list_pluck( $terms, 'term_id' );
					}
					$item = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'offset' => 1,
						'ignore_sticky_posts' => true,
						'tax_query' => array(
							array(
								'taxonomy' => 'post_tag',
								'field' => 'term_id',
								'terms' => $term_ids,
							),
						),
					);
					$news_item = new WP_Query( $item );
					if ( $news_item->have_posts() ) : ?>
						<div class="col-md-6 col-sm-12">
							<?php $count = '0'; ?>
							<?php while ( $news_item->have_posts() ) : $news_item->the_post(); ?>	
								<div class="row news-item">
									<div class="col-md-4 col-sm-12">
										<?php 
											if ( has_post_thumbnail() ) {
												the_post_thumbnail('bookme_att_news_big_thumbnail');
											} else {
												echo '<img src="http://placehold.it/555x363">';
											}
										?>
									</div>
									<div class="col-md-8 col-sm-12">
										<div class="news-entry">
												<div class ="title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</div>
												<span class="news-date"><?php echo the_time('M d, Y'); ?></span>
												<span class="news-cat"><?php the_terms( $post->ID, 'category', 'In : ', ' / ' ); ?></span>
											</div>
										<a class="link-more" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read more ', 'bookme'); ?><span class="lnr lnr-arrow-right"></span></a>
									</div>
								</div>
								<?php $count = $count+0.5; ?>
							<?php endwhile; ?>
						</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div><!--/.container-->
	</section><?php 
endif;
