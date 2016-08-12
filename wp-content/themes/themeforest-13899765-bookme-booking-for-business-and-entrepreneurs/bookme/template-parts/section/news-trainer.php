<?php 
/*
 * Section Trainer News
 *
 */

$small_title = get_post_meta(get_the_ID(), '_BookmeMB_trainer_news_small_text', true);
$content = get_post_meta(get_the_ID(), '_BookmeMB_trainer_news_content', true);
if ( $small_title || $content ) : ?>
	<section id="news">
		<div class="container wow fadeInDown">
			<div class="post header-section text-center">
				<?php 
					if ( $small_title ) 
						echo '<div class="small-title"><h4>' . esc_attr( $small_title ) . '</h4></div>';
					if ( $content )
						echo wp_kses_post($content);
				?>
			</div>
		<?php 
			$trainer_tag = get_post_meta(get_the_ID(), '_BookmeMB_trainer_post_tag', true);
			if ( $trainer_tag ) {
				$term_ids = array($trainer_tag);
			} else {
				$terms = get_terms( 'post_tag' ); 
				$term_ids = wp_list_pluck( $terms, 'term_id' );
			}
			$trainer_args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'term_id',
						'terms' => $term_ids,
					),
				),
			);
			$trainer = new WP_Query( $trainer_args );
			$count = '0';
			if ( $trainer->have_posts() ) : ?>
				<div class="row">
					<?php while ( $trainer->have_posts() ) : $trainer->the_post(); ?>
						<div class="col-md-4 col-sm-4">
							<div class="post">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('bookme_news_thumbnail');
									} else {
										echo '<img src="http://placehold.it/360x236" />';
									}
								?>
								<div class="title box-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>
								<div class="news-entry">
									<?php echo bookme_get_excerpt(130); ?>
								</div>
								<a class="link-more" href="<?php the_permalink(); ?>"><?php echo wp_kses_post(__('Read more <span class="lnr lnr-arrow-right"></span>', 'bookme')); ?></a>
							</div>
						</div>
						<?php $count = $count+0.5; ?>
					<?php endwhile; ?>
				</div><?php 
			endif; wp_reset_postdata(); ?>

		</div>
	</section><?php 
endif;
