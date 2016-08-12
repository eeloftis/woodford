<?php 
/*
 * Gallery Barber
 *
 */
 
$sect_small_text = get_post_meta(get_the_ID(), '_BookmeMB_barber_gallery_small_text', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_barber_gallery_subtitle', true); 
if ( $sect_small_text || $sect_title ) : ?>
	<section id="gallery" class="wow fadeInDown">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<?php 
							if ( $sect_small_text ) echo '<div class="small-title"><h4>' . esc_attr( $sect_small_text) . '</h4></div>';
							if ( $sect_title ) echo '<h3 class="title">' . esc_attr( $sect_title) . '<i class="dot">&nbsp;</i></h3>';
						?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$galleries = get_post_meta(get_the_ID(), '_BookmeMB_barber_gallery_images', true);
			if ( $galleries ) :
				echo '<div id="gallery-barber-slides" class="owl-carousel owl-theme">';
				    foreach ( (array) $galleries as $attachment_id => $attachment_url ) {
						echo '<div class="item"><a href="' . esc_url($attachment_url) . '" rel="prettyPhoto">' . wp_get_attachment_image( $attachment_id, 'bookme_barber_gallery_thumb' ) . '</a></div>';
					}
				echo '</div>';
			endif;
	echo '</section>';
endif;
