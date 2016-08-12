<?php 
/*
 * Section About Trainer
 *
 */

	$abt_title = get_post_meta(get_the_ID(), '_BookmeMB_trainer_about_small_title', true);
	$abt_content = get_post_meta(get_the_ID(), '_BookmeMB_trainer_about_content', true);
	$abt_more_text = get_post_meta(get_the_ID(), '_BookmeMB_trainer_abt_more_text', true);
	$abt_more_link = get_post_meta(get_the_ID(), '_BookmeMB_trainer_abt_more_url', true);
	if ( $abt_title || $abt_content ) : ?>
		<section id="about">
			<div class="container">
				<div class="row wow fadeInRight">
					<div class="col-md-6">
						<div class="post">
							<div class="small-title">
								<h4><?php if ( $abt_title ) echo esc_attr( $abt_title ); ?></h4>
							</div>
							<?php if ( $abt_content ) echo wp_kses_post($abt_content); ?>
							<div class="clearfix"></div>
							<?php if ( $abt_more_link ) : ?>
								<a class="btn btn-two" href="<?php echo esc_url($abt_more_link); ?>">
									<?php if ( $abt_more_text ) { echo esc_attr( $abt_more_text ); } else { echo esc_html__('Read More', 'bookme'); } ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<?php 
						$video_embed_url = get_post_meta(get_the_ID(), '_BookmeMB_trainer_about_video_url', true);
						if ( $video_embed_url ) : ?>
							<div class="col-md-6">
								<div class="abt-video">
									<?php 
										$img_url = get_post_meta(get_the_ID(), '_BookmeMB_trainer_about_video_img', true);
										if ( $img_url ) {
											$img_id = bookme_get_image_id($img_url);
											$video_img_url = wp_get_attachment_image_src( $img_id, 'bookme_att_news_big_thumbnail' );
											echo '<img src="' . esc_url( $video_img_url[0] ) . '" alt="">';
										}
									?>
									<div class="video-play">
										<a href="<?php echo esc_url($video_embed_url); ?>" rel="prettyPhoto" >
											<i class="fa fa-play"></i>
										</a>
									</div>
								</div>
							</div>
					<?php endif; ?>
				</div>
			</div><!--/.container-->
		</section><!-- #about -->
<?php endif; ?>
