<?php
/**
 * Template Name: Contact
 *
 */

get_header(); global $bookme_option; ?>

	<?php bookme_before_page(); ?>
				
		<?php while ( have_posts() ) : the_post(); ?>
				
			<!-- === Section Contact Content === -->
			<section id="contact-content">
				<div class="col-md-12">
					<?php 
						$small_title = $bookme_option['contact_small_text'];
						if ( $small_title ) : ?>
							<div class="small-title">
								<h4><?php echo esc_attr( $small_title ); ?></h4>
							</div>
					<?php endif; ?>
					<?php 
						$title = $bookme_option['contact_form_title'];
						if ( $title ) : ?>
							<div class="title">
								<h2><?php echo esc_attr( $title ); ?></h2> 
							</div>
					<?php endif; ?>
				</div>
				<div class="col-md-12">
					<div class="row">
						<?php echo do_shortcode('[bookme_contact subject="Contact Form" class="contact-form form-horizontal"]'); ?>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="contact-info-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<div class="title">
										<h3><?php echo esc_html__('Address', 'bookme'); ?></h3>
									</div>
									<?php 
										$address = $bookme_option['contact_address'];
										if ( $address ) {
											echo wp_kses_post($address);
										}
									?>
								</div>
								<?php 
									$phone1 = $bookme_option['contact_phone1'];
									$phone2 = $bookme_option['contact_phone2'];
									if ( $phone1 || $phone2 ) : ?>
										<div class="col-md-3">
											<div class="title">
												<h3><?php echo esc_html__('Call me', 'bookme'); ?></h3>
											</div>
											<ul class="list-contact-info">
												<?php if ( $phone1 ) echo '<li>'. esc_attr($phone1) .'</li>'; ?>
												<?php if ( $phone2 ) echo '<li>'. esc_attr($phone2) .'</li>'; ?>
											</ul>
										</div>
								<?php endif; ?>
								<?php 
									$contact_email = $bookme_option['contact_email'];
									if ( $contact_email ) : ?>
										<div class="col-md-5">
											<div class="title">
												<h3><?php echo esc_html__('Email', 'bookme'); ?></h3>
											</div>
											<ul class="list-contact-info">
												<li><a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_attr($contact_email); ?></a></li>
												<?php 
													$social_icon = $bookme_option['header_social_icon'];
													if ( $social_icon == 1 ) : 
														echo '<li>';
															
														$facebook = $bookme_option['facebook_url'];
														$twitter = $bookme_option['twitter_url'];
														$google = $bookme_option['google_url'];
														$linkedin = $bookme_option['linkedin_url'];
														$instagram = $bookme_option['instagram_url'];
														$youtube = $bookme_option['youtube_url'];
														
														if ( $facebook )
															echo '<a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a>';
														if ( $twitter )
															echo '<a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a>';
														if ( $google )
															echo '<a href="' . esc_url( $google ) . '"><i class="fa fa-google-plus"></i></a>';
														if ( $linkedin )
															echo '<a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a>';
														if ( $instagram )
															echo '<a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a>';
														if ( $youtube )
															echo '<a href="' . esc_url( $youtube ) . '"><i class="fa fa-youtube"></i></a>';
															
														echo '</li>';
													endif;
												?>
											</ul>
										</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php 
					$ct_lat = $bookme_option['contact_map_lat'];
					$ct_lng = $bookme_option['contact_map_long'];
					if ( $ct_lat && $ct_lng) : ?>
						<div class="col-md-12">
							<div class="map-wrapper">
								<div class="title">
									<h3><?php echo esc_html__('Map & Locations', 'bookme'); ?></h3> 
								</div>
									<div id="gMap" class="map-canvas"></div>
								<script>
									var contactLat = '<?php echo esc_attr($ct_lat); ?>';
									var contactLng = '<?php echo esc_attr($ct_lng); ?>';
									var contactCenter=new google.maps.LatLng(contactLat,contactLng);

									function initialize() {
										var mapProp = {
											center:contactCenter,
											zoom:16,
											mapTypeId:google.maps.MapTypeId.ROADMAP
										};

										var map=new google.maps.Map(document.getElementById("gMap"),mapProp);

										var marker=new google.maps.Marker({
											position:contactCenter,
										});

										marker.setMap(map);
									}

									google.maps.event.addDomListener(window, 'load', initialize);
								</script>
							</div>
						</div>
				<?php endif; ?>

			</section><!--#contact-content-->
							
			<?php endwhile; // End of the loop. ?>

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>