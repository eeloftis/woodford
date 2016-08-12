<?php
/**
 * Template Name: Why Me 
 *
 */

get_header(); global $bookme_option; ?>

	<?php bookme_before_page(); ?>
				
		<?php 
			while ( have_posts() ) : the_post();
				$whyme_small_text = get_post_meta(get_the_ID(), '_BookmeMB_whyme_small_text', true);
				$whyme_sub_title = get_post_meta(get_the_ID(), '_BookmeMB_whyme_subtitle', true); ?>
				
		<section id="facts">
			<div class="facts-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="header-section text-center">
								<?php 
									$whyme_small_text = get_post_meta(get_the_ID(), '_BookmeMB_whyme_small_text', true);
									if ( !empty( $whyme_small_text ) )
										echo '<div class="small-title"><h3>' . esc_attr( $whyme_small_text ) . '</h3></div>';
								?>
								<?php 
									$whyme_sub_title = get_post_meta(get_the_ID(), '_BookmeMB_whyme_subtitle', true);
									if ( !empty( $whyme_sub_title ) )
										echo '<div class="title"><h2>' . esc_attr( $whyme_sub_title ) . '</h2></div>';
								?>
								<?php the_content(); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<?php 
							$whyme_entry = get_post_meta(get_the_ID(), '_BookmeMB_whyme_entry', true);
							foreach ( (array) $whyme_entry as $key => $detail ) {
								$icon = $icon_img = $content = '';
								if ( isset( $detail['icon'] ) ) 
									$icon = $detail['icon'];
								if ( isset( $detail['icon_img'] ) ) 
									$icon_img = $detail['icon_img'];
								if ( isset( $detail['content'] ) ) 
									$content = $detail['content']; ?>

								<div class="col-md-4 col-sm-4">
									<div class="facts-item">
										<?php if ( $icon_img ) : ?>
											<div class="icon-img"><img src="<?php echo esc_url( $icon_img ); ?>" alt=""></div>
										<?php elseif ( $icon ) : ?>
											<span class="fa <?php echo esc_attr($icon); ?>"></span>
										<?php endif; ?>
										<?php echo wp_kses_post($content); ?>
									</div>
								</div><?php
							}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>