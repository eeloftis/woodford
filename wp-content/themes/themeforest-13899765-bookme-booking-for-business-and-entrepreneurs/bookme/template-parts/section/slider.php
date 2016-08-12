<?php 
/*
 * Slider Section
 *
 */

$rev_slide = get_post_meta(get_the_ID(), '_BookmeMB_rev_slider', true);
if ( class_exists('RevSlider') && $rev_slide == 'on' ) {
	echo '<div class="repslider">';
	$alias = get_post_meta(get_the_ID(), '_BookmeMB_rev_slider_alias', true);
	if ( $alias != '' ) { putRevSlider( $alias ); }
	echo '</div>';
} else { ?>

	<section id="main-slider">
						
		<?php 
			$slides = get_post_meta(get_the_ID(), '_BookmeMB_slide_img', true);
			if ( $slides ) {
				echo '<div id="acc-slides" class="owl-carousel owl-theme">';
				foreach ( (array) $slides as $attachment_id => $attachment_url ) {
					echo wp_get_attachment_image( $attachment_id, 'bookme_slide' );
				}
				echo '</div>';
			}
		?>
		<div class="slide-content">
			<div class="container">
				<div class="row">
					<?php 
						$class_right = '';
						$slide_right = get_post_meta(get_the_ID(), '_BookmeMB_caption_position', true);
						if ( $slide_right == 'right' ) $class_right = 'col-lg-push-6 col-md-push-6';
					?>
					<div class="slide-caption col-lg-6 col-md-6 col-sm-6 <?php echo $class_right; ?> col-xs-12 animated bounceInRight">
						<?php 
							$small_title = get_post_meta(get_the_ID(), '_BookmeMB_slider_small_title', true);
							$slider_content = get_post_meta(get_the_ID(), '_BookmeMB_slider_content', true);
								
							if ( $small_title ) 
								echo '<div class="small-title"><h3>' . esc_attr( $small_title ) . '</h3></div>';
											
							if ( $slider_content ) 
								echo wp_kses_post($slider_content);
											
							$sld_btn1_text = get_post_meta(get_the_ID(), '_BookmeMB_sld_btn1_text', true);
							$sld_btn1_url = get_post_meta(get_the_ID(), '_BookmeMB_sld_btn1_url', true);
							$sld_btn2_text = get_post_meta(get_the_ID(), '_BookmeMB_sld_btn2_text', true);
							$sld_btn2_url = get_post_meta(get_the_ID(), '_BookmeMB_sld_btn2_url', true);
									
							if ( $sld_btn1_url )
								echo '<a class="btn btn-one" href="' .esc_url($sld_btn1_url). '">';
							if ( $sld_btn1_text ) echo wp_kses_post($sld_btn1_text); 
								echo '</a>';
							if ( $sld_btn2_url ) 
								echo '<a class="btn btn-two" href="' .esc_url($sld_btn2_url). '">';
							if ( $sld_btn2_text ) echo wp_kses_post($sld_btn2_text); 
								echo '</a>'; 
						?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$calendar = get_post_meta(get_the_ID(), '_BookmeMB_parallax_booked_calendar', true);
			if ( $calendar ) : ?>
				<div class="container">
					<div class="booked-btn">
						<div class="cd-single-point">
							 <a href="#features" class="page-scroll"></a>
						</div>
					</div>
				</div>
		<?php endif; ?>
	</section><?php 

}