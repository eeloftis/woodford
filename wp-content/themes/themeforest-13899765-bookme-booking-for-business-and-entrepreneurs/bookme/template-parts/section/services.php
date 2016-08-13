<?php
/*
 * Section Services
 */
?>
<!-- === Section Services === -->
<a name="services" />
<?php
	$services = get_post_meta(get_the_ID(), '_BookmeMB_services', true);
	if ( $services ) : ?>
		<section id="services">
			<div class="container-fluid">
				<div class="row wow fadeInUp">
					<?php
						$count = '0';
						foreach ( (array) $services as $key => $service ) {
							$img_bg = $color_bg = $icon = $icon_img = $small_title = $small_title_color = $title = $title_color = $desc = $desc_color = $more_text = $url = $btn_color = '';
							if ( isset( $service['image'] ) )
							   	$img_bg = $service['image'];
							if ( isset( $service['color'] ) )
							   	$color_bg = $service['color'];
							if ( isset( $service['icon'] ) )
							   	$icon = $service['icon'];
							if ( isset( $service['icon_img'] ) )
							   	$icon_img = $service['icon_img'];
							if ( isset( $service['small_title'] ) )
							   	$small_title = $service['small_title'];
							if ( isset( $service['small_title_color'] ) )
							   	$small_title_color = $service['small_title_color'];
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

							if ( $img_bg || $color_bg || $small_title || $title || $desc || $more_text || $url ) {
								$bg_img = $bg_color = $color_btn = $s_color = $t_color = $d_color = '' ;

								if ( $color_bg ) {
									$bg_color = 'style="background-color: ' . $color_bg . '; "';
								}
								if ( $btn_color ) {
									$color_btn = 'style="border: 1px solid ' . $btn_color . '; color: ' . $btn_color . ';"';
								}
								if ( $small_title_color ) {
									$s_color = 'style="color: '.$small_title_color.'"';
								}
								if ( $title_color ) {
									$t_color = 'style="color: '.$title_color.'"';
								}
								if ( $desc_color ) {
									$d_color = 'style="color: '.$desc_color.'"';
								}
								echo '<div class="col-md-4 col-sm-4 col-xs-12"><div class="row" ' . $bg_color . '>';

								echo '<div class="services-item text-center service-'.$key.'">';

								if ( $icon_img ) {
									echo '<div class="icon-img"><img src="' . esc_url( $icon_img ) . '" alt=""></div>';
								} else {
									if ( $icon )
										echo '<span class="fa '.$icon.'" '.$t_color.'></span>';
								}
								if ( $small_title )
									echo '<div class="small-title"><h4 '.$s_color.'>' . esc_attr( $small_title ) . '</h4></div>';
								if ( $title )
									echo '<div class="title"><h3 '.$t_color.'>' . esc_attr( $title ) . '</h3></div>';
								if ( $desc )
									echo '<p '.$d_color.'>' . esc_attr ( $desc ) . '</p>';
								if ( $url )
									echo '<a class="btn btn-services-one" href="'. esc_url( $url ) . '" ' . $color_btn . '>' . esc_attr( $more_text ) . '</a>';
								echo '</div></div></div>';
								$count = $count+0.5;
							}
						}
					?>
				</div>
			</div>
		</section>
<?php endif; ?>
