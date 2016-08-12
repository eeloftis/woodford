<?php 
/*
 * Section About Details
 *
 */

	$about_details = get_post_meta(get_the_ID(), '_BookmeMB_about_details', true);
	if ( $about_details ) { ?>
		<section id="about-details">
			<div class="container wow fadeInDown">
				<?php 
					$about_details_small_title = get_post_meta(get_the_ID(), '_BookmeMB_about_details_small_text', true);
					$about_details_content = get_post_meta(get_the_ID(), '_BookmeMB_about_details_content', true); 
					if ( $about_details_small_title || $about_details_content ) : ?>
						<div class="header-section text-center">
							<?php if ( $about_details_small_title ) : ?>
								<div class="small-title">
									<h3>Something About Me</h3>
								</div>
							<?php endif; ?>
							<?php if ( $about_details_content ) : ?>
								<?php echo wp_kses_post($about_details_content); ?>
							<?php endif; ?>
						</div>
				<?php endif; ?>

				<div class="main-post">
					<?php 
						$count = 0;
						foreach ( (array) $about_details as $key => $detail ) {
							$icon = $icon_img = $title = $content = '';
							if ( isset( $detail['icon'] ) ) 
								$icon = $detail['icon'];
							if ( isset( $detail['icon_img'] ) ) 
								$icon_img = $detail['icon_img'];
							if ( isset( $detail['title'] ) ) 
								$title = $detail['title'];
							if ( isset( $detail['content'] ) ) 
								$content = $detail['content']; 
							if ( $count == 3 ) {
								echo '</div><div class="main-post">';
								} ?>

								<div class="col-md-4 col-sm-4">
									<div class="post text-center">
										<?php if ( $icon_img ) : ?>
											<div class="icon-img"><img src="<?php echo esc_url( $icon_img ); ?>" alt=""></div>
										<?php elseif ( $icon ) : ?>
											<span class="fa <?php echo esc_attr($icon); ?>"></span>
										<?php endif; ?>
										<div class="title-regular">
											<h4><?php echo esc_attr( $title ); ?></h4>
										</div>
										<p><?php echo esc_attr( $content ); ?></p>
									</div>
								</div><?php 
							$count = $count+0.5;
						}
					?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="header-section text-center">
								<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_more_url', true) ) : ?> 
									<a class="btn btn-one" href="<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_more_url', true) ) { echo esc_url( get_post_meta(get_the_ID(), '_BookmeMB_about_details_more_url', true) ); } ?>"><?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_more_text', true) ) { echo esc_attr( get_post_meta(get_the_ID(), '_BookmeMB_about_details_more_text', true) ); } ?></a>
								<?php endif; ?>
								<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_book_url', true ) ) : ?>
									<a class="btn btn-two" href="<?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_book_url', true) ) { echo esc_url( get_post_meta(get_the_ID(), '_BookmeMB_about_details_book_url', true) ); } ?>"><?php if ( get_post_meta(get_the_ID(), '_BookmeMB_about_details_book_text', true) ) { echo esc_attr( get_post_meta(get_the_ID(), '_BookmeMB_about_details_book_text', true) ); } ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!--/.row-->
			</div>
		</section>
<?php } ?>
