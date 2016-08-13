<?php
/*
 * Section About
 *
 */
 ?>
<!-- === Section About === -->
<a name="about" />
<section id="about">
	<div class="container">
		<div class="row wow fadeInUp">
			<div class="col-md-5  col-md-offset-1 col-sm-6">
				<div class="post">
					<?php
						$abt_title = get_post_meta(get_the_ID(), '_BookmeMB_about_small_title', true);
						$abt_content = get_post_meta(get_the_ID(), '_BookmeMB_about_content', true);
						$abt_more_text = get_post_meta(get_the_ID(), '_BookmeMB_abt_more_text', true);
						$abt_more_link = get_post_meta(get_the_ID(), '_BookmeMB_abt_more_url', true);

						if ( $abt_title ) {
							echo '<div class="small-title">';
							echo '<h4>' . esc_attr( $abt_title ) . '</h4>';
							echo '</div>';
						}

						if ( $abt_content ) {
							echo '<div class="about-desc clearfix">' . $abt_content . '</div>';
						}

						if ( $abt_more_link ) {
							echo '<a class="btn btn-two" href="' .esc_url($abt_more_link). '">';
							if ( $abt_more_text )
								echo esc_attr( $abt_more_text );
							echo '</a>';
						}
					?>
				</div>
			</div>
			<div class="col-md-5 col-sm-6">
				<div class="row">
					<div class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1">
						<div class="col-md-6 col-sm-6">
							<div class="row">
								<?php
									$img1_url = get_post_meta(get_the_ID(), '_BookmeMB_about_image1', true);
									if ( $img1_url )
										echo '<img src="' . esc_url( $img1_url ) . '" alt="" />';

									$img2_url = get_post_meta(get_the_ID(), '_BookmeMB_about_image2', true);
									if ( $img2_url )
										echo '<img src="' . esc_url( $img2_url ) . '" alt="" />';
								?>
							</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<div class="row about-item">
								<?php
									$img3_url = get_post_meta(get_the_ID(), '_BookmeMB_about_image3', true);
									if ( $img3_url )
										echo '<img src="' . esc_url( $img3_url ) . '" alt="" />';

									$img4_url = get_post_meta(get_the_ID(), '_BookmeMB_about_image4', true);
									if ( $img4_url )
										echo '<img src="' . esc_url( $img4_url ) . '" alt="" />';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.container-->
</section><!-- #about -->
