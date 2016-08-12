<?php 
/*
 * News Corporate Trainer
 *
 */

$sect_small_title = get_post_meta(get_the_ID(), '_BookmeMB_trainer_news_small_text', true);
$sect_content = get_post_meta(get_the_ID(), '_BookmeMB_trainer_news_content', true);
$news_tag = get_post_meta(get_the_ID(), '_BookmeMB_trainer_post_tag', true);
if ( $news_tag ) {
	$term_ids = array($news_tag);
} else {
	$terms = get_terms( 'post_tag' ); 
	$term_ids = wp_list_pluck( $terms, 'term_id' );
}
$news_args = array(
	'post_type' => 'post',
	'posts_per_page' => 6,
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
	<section id="news">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="post header-section text-center">
						<?php 
							if ( $sect_small_title ) echo '<div class="small-title"><h4>' . esc_attr($sect_small_title) . '</h4></div>';
							if ( $sect_content ) echo wp_kses_post($sect_content); 
						?>
					</div>
				</div>
				<div class="col-md-12">
					<?php 
						$row = 0;
						echo '<div class="row">';
						while ( $news->have_posts() ) : $news->the_post(); 
							if ( $row == 3 ) {
								echo '</div><div class="row">';
								$row = 0;
							} ?>
								<div class="post col-md-4 col-sm-4">
									<div class="news-item">
										<div class ="title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
										<span class="news-date"><?php echo the_time('M d, Y'); ?></span>
										<span class="news-cat"><?php the_terms( $post->ID, 'category', 'In : ', ' / ' ); ?></span>
									</div>
									<a class="link-more" href="<?php the_permalink(); ?>"><?php echo wp_kses_post(__('Read more <span class="lnr lnr-arrow-right"></span>', 'bookme')); ?></a>
								</div><?php 
							$row++;
						endwhile;
						echo '</div>';
					?>
				</div>
				<div class="col-md-12">
					<div class="text-center">
						<a class="btn btn-one" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php echo esc_html__('Read All Posts', 'bookme'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section><?php
endif; wp_reset_postdata(); 
