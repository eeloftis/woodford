<?php 
/*
 * Section Architect Quotation
 *
 */

$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_small_title', true);
$sect_content = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_content', true);
if ( $sect_title || $sect_title ) : ?>
	<section id="requests">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="header-section text-center">
						<?php if ( $sect_title ) echo '<div class="small-title"><h3>' . esc_attr($sect_title) . '</h3></div>'; ?>
						<?php if ( $sect_content ) echo wp_kses_post($sect_content); ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="requests-item">
							<div class="col-md-6">
								<?php 
									$form_left_content = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_form_left_content', true);
									if ( $form_left_content ) echo wp_kses_post($form_left_content); ?>
							</div>
							<div class="col-md-6">
								<div class="quote-form">
									<span class="lnr lnr-flag"></span>
									<?php 
		   								$cf7_id = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_cf7_form', true);
		   								if ( $cf7_id != '' ) {
											$cf7_title = get_the_title($cf7_id);
											echo do_shortcode('[contact-form-7 id="'.$cf7_id.'" title="'.$cf7_title.'"]');
										} else { 
											$form_title = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_form_title_content', true);
											$form_content = get_post_meta(get_the_ID(), '_BookmeMB_architect_quote_form_desc_content', true);
											if ( $form_title ) echo '<div class="title"><h4>' . esc_attr($form_title) . '</h4></div>';
											if ( $form_content ) echo wp_kses_post($form_content); 
										
											echo do_shortcode('[bookme_contact subject="Request a Quote"]'); 
								      	}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><?php 
endif;
