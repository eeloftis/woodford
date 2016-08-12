<?php 
/*
 * Section About Barber
 *
 */

$about_img = get_post_meta(get_the_ID(), '_BookmeMB_barber_about_img', true);
$about_content = get_post_meta(get_the_ID(), '_BookmeMB_barber_about_content', true);
if ( $about_img || $about_content ) : ?>
	<div id="about">
		<div class="container wow fadeInUp">
			<div class="row">
				<div class="col-md-8">
					<?php if ( $about_img ) echo '<img src="' .esc_url($about_img). '" alt="">'; ?>
				</div>
				<div class="col-md-4">
					<div class="entry-about-barber">
						<?php if ( $about_content ) echo wp_kses_post($about_content); ?>
					</div>
				</div>
			</div>
		</div>
	</div><?php
endif;
