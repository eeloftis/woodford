<?php 
/*
 * Section About Therapy
 *
 */

	$abt_title = get_post_meta(get_the_ID(), '_BookmeMB_therapy_about_small_title', true);
	$abt_content = get_post_meta(get_the_ID(), '_BookmeMB_therapy_about_content', true);
	$abt_more_text = get_post_meta(get_the_ID(), '_BookmeMB_therapy_abt_more_text', true);
	$abt_more_link = get_post_meta(get_the_ID(), '_BookmeMB_therapy_abt_more_url', true);
	if ( $abt_title || $abt_content ) : ?>
		<section id="about">
			<div class="container wow fadeInDown">
				<div class="row">
					<div class="col-md-7">
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
						$video_embed_url = get_post_meta(get_the_ID(), '_BookmeMB_therapy_about_video_url', true);
						if ( $video_embed_url ) : ?>
							<div class="col-md-5">
								<div class="abt-video">
									<?php 
										$video_img_url = get_post_meta(get_the_ID(), '_BookmeMB_therapy_about_video_img', true);
										if ( $video_img_url )
											echo '<img src="' . esc_url( $video_img_url ) . '" alt="">';
									?>
									<div class="video-play">
										<a href="<?php echo esc_url($video_embed_url); ?>" rel="prettyPhoto">
											<i class="fa fa-play"></i>
										</a>
									</div>
								</div>
							</div>
					<?php endif; ?>
				</div>
				
				<?php 
					$open_hours_title = get_post_meta(get_the_ID(), '_BookmeMB_therapy_open_hours_title', true);
					if ( $open_hours_title ) : ?>
						<div class="open-hours">
							<div class="header-section text-center">
								<?php echo wp_kses_post($open_hours_title); ?>
							</div>
							<?php 
								$open_hours_items = get_post_meta(get_the_ID(), '_BookmeMB_therapy_open_hours', true);
								if ( $open_hours_items ) {
									echo '<div class="row">';
									$count = '0';
									foreach ($open_hours_items as $key => $item) {
										$icon = $icon_img = $desc = '';
										if ( isset( $item['icon'] ) ) {
											$icon = $item['icon'];
										}
										if ( isset( $item['icon_img'] ) ) {
											$icon_img = $item['icon_img'];
										}
		        						if ( isset( $item['desc'] ) ) {
											$desc = $item['desc'];
		        						}
		        						echo '<div class="col-md-4 col-sm-4"><div class="about-item">';

		        						if ( $icon_img != '' ) {
		        							echo '<div class="media-left media-middle"><div class="icon-img"><img src="' . esc_url( $icon_img ) . '" alt=""></div></div>';
							        	} elseif ( $icon != '' ) {			
							        		echo '<div class="media-left media-middle"><i class="fa '.esc_html($icon).'"></i></div>';
							        	}		
		        						if ( $desc != '' ) 
		        							echo '<div class="media-body">' . $desc . '</div>';

		        						echo '</div></div>';
										$count = $count+0.5;
									}
									echo '</div>';
								}
							?>
						</div>
				<?php endif; ?>
			</div><!--/.container-->
		</section><!-- #about -->
<?php endif; ?>
