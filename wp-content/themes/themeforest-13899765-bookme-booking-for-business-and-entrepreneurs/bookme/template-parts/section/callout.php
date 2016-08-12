<?php 
/*
 * Callout Section
 *
 */

$callout_img = get_post_meta(get_the_ID(), '_BookmeMB_callout_img', true);
$callout_left_content = get_post_meta(get_the_ID(), '_BookmeMB_callout_left_content', true);
$callout_right_content = get_post_meta(get_the_ID(), '_BookmeMB_callout_right_content', true);
if ( $callout_left_content || $callout_right_content ) : ?>
	<div class="testimonials-callout">
		<div class="container">
			<div class="row">
				<div class="testimonials-callout-entry col-md-12 wow fadeInUp">
					<div class="row">
						<?php if ( $callout_img ) echo '<div class="testimonials-callout-img"><img src="' . esc_url($callout_img) . '"  alt="" /></div>'; ?>
						<div class="col-md-7 col-sm-7">
							<?php if (	$callout_left_content ) echo '<div class="testimonials-callout-post-content">' . $callout_left_content . '</div>'; ?>
						</div>
						<div class="col-md-5 col-sm-5">
							<?php if (	$callout_right_content ) echo '<div class="testimonials-callout-content">' . $callout_right_content . '</div>'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><?php 
endif;
