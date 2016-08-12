<?php 
/*
 * Schedule Barber
 *
 */

$sect_small_text = get_post_meta(get_the_ID(), '_BookmeMB_barber_schedule_small_text', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_barber_schedule_title', true); 
if ( $sect_small_text || $sect_title ) : ?>
	<section id="schedules">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="header-section text-center">
						<?php if ($sect_small_text) echo '<div class="small-title"><h4>'.esc_attr($sect_small_text).'</h4></div>'; ?>
						<?php if ($sect_title) echo '<h3 class="title">' . esc_attr($sect_title).'<i class="dot">&nbsp;</i></h3>'; ?>
					</div>
				</div>
				<?php 
					$schedule_entry = get_post_meta(get_the_ID(), '_BookmeMB_barber_schedule', true);
					if ( $schedule_entry ) {
						echo '<div class="col-md-12 post">';
						foreach((array) $schedule_entry as $key => $entry) {
							$day = $time = '';
							if(isset($entry['day']))
								$day = $entry['day'];
							if(isset($entry['time']))
								$time = $entry['time']; ?>
								
								<div class="schedules-item col-md-2 col-xs-6">
									<div class="row">
										<div class="text-center">
											<h3 class="title"><?php echo esc_attr($day); ?></h3>
											<?php echo esc_attr($time); ?>
										</div>
									</div>
								</div><?php
						}
						echo '</div>';
					}
					$btn_text = get_post_meta(get_the_ID(), '_BookmeMB_barber_schedule_btn_text', true);
					$btn_url = get_post_meta(get_the_ID(), '_BookmeMB_barber_schedule_btn_url', true);
					if ( $btn_url ) : ?>
						<div class="col-md-12">
							<div class="text-center">
								<a class="btn btn-two" href="<?php echo esc_url($btn_url); ?>">
									<?php if ( $btn_text ) { echo esc_attr($btn_text); } else { echo esc_html__('Book Me', 'bookme'); } ?>
								</a>
							</div>
						</div><?php 
					endif;
				?>
			</div>
		</div>
	</section><?php 
endif;
