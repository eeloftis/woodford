<?php 
/*
 * Slider Accounting3 Section
 *
 */

$rev_slide = get_post_meta(get_the_ID(), '_BookmeMB_acc3_rev_slider', true);
if ( class_exists('RevSlider') && $rev_slide == 'on' ) {
	echo '<div class="repslider">';
	$alias = get_post_meta(get_the_ID(), '_BookmeMB_acc3_rev_slider_alias', true);
	if ( $alias != '' ) { putRevSlider( $alias ); }
	echo '</div>';
} else { ?>

	<section id="main-slider">
						
		<?php 
			$slides = get_post_meta(get_the_ID(), '_BookmeMB_acc3_slide_img', true);
			if ( $slides ) {
				echo '<div id="acc-slides" class="owl-carousel owl-theme">';
				foreach ( (array) $slides as $attachment_id => $attachment_url ) {
					echo wp_get_attachment_image( $attachment_id, 'bookme_slide' );
				}
				echo '</div>';
			}
		?>
		<div class="slide-form wow fadeInLeft">
			<div class="container">
				<?php 
		   		$quote_small_title = get_post_meta(get_the_ID(), '_BookmeMB_acc3_quote_small_text', true);
		   		$quote_title = get_post_meta(get_the_ID(), '_BookmeMB_acc3_quote_title', true);
		   		if ( $quote_title ) : ?>
		   			<div class="quote-form">
		   				<?php if ( $quote_small_title ) : ?>
		     				<div class="small-title">
		      					<h4><?php echo esc_attr( $quote_small_title ); ?></h4>
		      				</div>
		      			<?php endif; ?>
		      			<?php if ( $quote_title ) : ?>
		      				<div class="title">
		       					<h2><?php echo esc_attr( $quote_title ); ?></h2>
		      				</div> 
		      			<?php endif; ?>
						
		   				<?php 
		   					$cf7_id = get_post_meta(get_the_ID(), '_BookmeMB_acc3_cf7_form', true);
		   					if ( $cf7_id != '' ) {
								$cf7_title = get_the_title($cf7_id);
								echo do_shortcode('[contact-form-7 id="'.$cf7_id.'" title="'.$cf7_title.'"]');
							} else {
								echo do_shortcode('[bookme_contact subject="Request a Quote"]');
							} 
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section><?php 
}
