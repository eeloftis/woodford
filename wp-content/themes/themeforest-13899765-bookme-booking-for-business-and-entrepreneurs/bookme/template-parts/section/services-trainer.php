<?php 
/*
 * Section Services Trainer
 *
 */
?>
<!-- === Section Services === -->
<?php 
	$services = get_post_meta(get_the_ID(), '_BookmeMB_trainer_services', true);
	if ( $services ) : ?>
		<section id="services">
			<div class="container-fluid wow fadeInDown">
				<div class="row">
					<?php 
						$count = '0';
						foreach ( (array) $services as $key => $service ) {
							$color_bg = $title = $title_color = $desc = $desc_color = $url = $btn_color = $txt_money = $time = '';
							if ( isset( $service['color'] ) ) 
							   	$color_bg = $service['color'];
							if ( isset( $service['title'] ) ) 
							   	$title = $service['title'];
							if ( isset( $service['title_color'] ) ) 
							   	$title_color = $service['title_color'];
							if ( isset( $service['desc'] ) ) 
							   	$desc = $service['desc'];
							if ( isset( $service['desc_color'] ) ) 
							   	$desc_color = $service['desc_color'];
							if ( isset( $service['more_text'] ) ) 
							   	$more_text = $service['more_text'];
							if ( isset( $service['more_url'] ) ) 
							   	$url = $service['more_url'];
							if ( isset( $service['btn_color'] ) ) 
							   	$btn_color = $service['btn_color'];
							if ( isset( $service['text_money'] ) ) 
							   	$txt_money = $service['text_money'];
							if ( isset( $service['time_services'] ) ) 
							   	$time = $service['time_services'];
											   	
							if ( $color_bg || $title || $desc || $more_text || $url || $txt_money ) {
								$bg_color = $color_btn = $s_color = $t_color = $d_color = '' ;
								if ( $color_bg ) {
									$bg_color = 'style="background-color: ' . $color_bg . '; "';
								} 
								if ( $btn_color ) {
									$color_btn = 'style="border: 1px solid ' . $btn_color . '; color: ' . $btn_color . ';"';
								}
								if ( $title_color ) {
									$t_color = 'style="color: '.$title_color.'"';
								}
								if ( $desc_color ) {
									$d_color = 'style="color: '.$desc_color.'"';
								}
								echo '<div class="col-md-4 col-sm-4 col-xs-12 "><div class="row">';
								echo '<div class="services-item text-center"><div class="services-sub-item">';
								if ( $title ) 
									echo '<div class="title"><h3 '.$t_color.'>' . esc_attr( $title ) . '</h3></div>';
								if ( $desc )
									echo '<p '.$d_color.'>' . esc_attr ( $desc ) . '</p>';
								if ( $url )
									echo '<a class="btn" href="'. esc_url( $url ) . '" ' . $color_btn . '>' . esc_attr( $more_text ) . '</a>';
								echo '</div>';
								echo '<div class="prices-item"><h1 class="services-price">$' . esc_attr( $txt_money ) . '<span class="services-price-time">/' . esc_attr( $time ) . '</span></h1></div>';
								echo '</div></div></div>';
								$count = $count+0.5;
							}
						}
					?>
				</div>
			</div>
		</section>
<?php endif; ?>
