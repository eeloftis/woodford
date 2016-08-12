<?php 
/*
 * About Corporate Trainer
 *
 */

$about_small_title = get_post_meta(get_the_ID(), '_BookmeMB_corp_trainer_about_small_text', true);
$about_content = get_post_meta(get_the_ID(), '_BookmeMB_corp_trainer_about_content', true);
if ( $about_small_title || $about_content ) : ?>
	<section id="about">
		<div class="container wow fadeInDown">
			<div class="col-md-7 col-sm-7">
				<div class="post">
					<?php if ($about_small_title) echo '<div class="small-title"><h4>' . esc_attr($about_small_title) . '</h4></div>'; ?>
					<?php if ( $about_content ) echo wp_kses_post($about_content); ?>
				</div>
			</div>
			<?php 
				$about_images = get_post_meta(get_the_ID(), '_BookmeMB_corp_trainer_about_slider', true);
				if ( $about_images ) : 
					echo '<div class="col-md-5 col-sm-5"><div id="about-corp-trainer" class="owl-carousel owl-theme">';
					foreach($about_images as $image) {
						$attachment_id = bookme_get_image_id($image);
						$attachment_url = wp_get_attachment_image_src($attachment_id, 'bookme_therapy_about'); ?>
						<div class="item">
							<div class="about-media">
										<img src="<?php echo $attachment_url[0]; ?>" alt="" />
							</div>
						</div><?php 
					}
					echo '</div></div>';
				endif;
			?>
		</div>
	</section><?php 
endif;
