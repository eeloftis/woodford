<?php 
/*
 * Section Footer Quote
 *
 */
 global $bookme_option;

	$footer_quote = $bookme_option['footer_quote'];
	if ( $footer_quote == 1 ) {
		$quote_small_text = $bookme_option['footer_quote_small_text']; 
		$quote_content = $bookme_option['footer_quote_conten']; 
		$btn_text = $bookme_option['footer_quote_btn_text'];
		$btn_url = $bookme_option['footer_quote_btn_url'];
		if ( $quote_small_text || $quote_content ) { ?>
			<section id="quotes">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<?php if ( $quote_small_text ) : ?>
								<div class="small-title">
									<h4><?php echo esc_attr( $quote_small_text ); ?></h4>
								</div>
							<?php endif; ?>
							<?php if ( $quote_content ) echo wp_kses_post($quote_content); ?>
						</div>
						<?php 
							if ( $btn_text ) : ?>
								<div class="col-md-4">
									<div class="quotes-callout">
										<?php 
											if ( $btn_url )
												echo '<a class="btn btn-one" href="'.esc_url($btn_url).'">';
														
											echo wp_kses_post($btn_text);
													
											if ( $btn_url ) 
												echo '</a>';
										?>
									</div>
								</div>
						<?php endif; ?>
					</div>
				</div>
			</section><?php
		}
	}
