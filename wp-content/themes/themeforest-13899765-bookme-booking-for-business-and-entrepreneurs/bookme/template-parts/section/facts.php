<?php
/*
 * Section Facts
 *
 */

	$facts = get_post_meta(get_the_ID(), '_BookmeMB_fact', true);
	if ( $facts ) { ?>
		<a name="facts" />
		<section id="facts">
			<div class="facts-wrapper">
				<div class="container wow fadeInDown">
					<div class="row">
						<div class="col-md-12">
							<div class="header-section text-center">
								<?php
									$facts_small_text = get_post_meta(get_the_ID(), '_BookmeMB_facts_small_text', true);
									if ( !empty( $facts_small_text ) )
										echo '<div class="small-title"><h3>' . esc_attr( $facts_small_text ) . '</h3></div>';
								?>
								<?php
									$facts_title = get_post_meta(get_the_ID(), '_BookmeMB_facts_title', true);
									if ( !empty( $facts_title ) )
										echo '<div class="title"><h2>' . esc_attr( $facts_title ) . '</h2></div>';
								?>
								<?php
									$facts_desc = get_post_meta(get_the_ID(), '_BookmeMB_facts_desc', true);
									if ( !empty( $facts_desc ) )
										echo '<p>' . $facts_desc . '</p>';
								?>
							</div>
						</div>

						<?php
							$count = '0';
							foreach ( (array) $facts as $key => $fact ) {
								$icon = $icon_img = $content = '';
								if ( isset( $fact['icon'] ) )
									$icon = $fact['icon'];
								if ( isset( $fact['icon_img'] ) )
									$icon_img = $fact['icon_img'];
								if ( isset( $fact['content'] ) )
									$content = $fact['content']; ?>

								<div class="col-md-4 col-sm-4">
									<div class="facts-item">
										<?php if ( $icon_img ) : ?>
											<div class="icon-img"><img src="<?php echo esc_url( $icon_img ); ?>" alt=""></div>
										<?php elseif ( $icon ) : ?>
											<span class="fa <?php echo $icon; ?>"></span>
										<?php endif; ?>
										<?php echo $content; ?>
									</div>
								</div><?php
								$count = $count+0.5;
							}
						?>
					</div>
				</div>
			</div>
		</section>
<?php }	?>
