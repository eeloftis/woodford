<?php
/**
 * Template part for displaying content service archive page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BookMe Theme
 */

global $bookme_option; ?>

<section>
	<div class="page-content-wrapper">
		<div class="container">
			<div class="row">
				<div id="service-content" class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                $sc_small_title = $bookme_option['service_archive_content_small_text'];
                                $sc_title = $bookme_option['service_archive_content_title'];
                                $sc_content = $bookme_option['service_archive_content_description'];
                                if ( $sc_small_title ) echo '<div class="small-title"><h4>' . esc_attr( $sc_small_title ) . '</h4></div>';
                                if ( $sc_title ) echo '<div class="title"><h2>' . esc_attr( $sc_title ) . '</h2></div>';
                                if ( $sc_content ) echo wp_kses_post($sc_content);
                            ?>
                        </div>
				    </div>
				</div>
			</div>
		</div>
	</div><!--/.page-content-wrapper-->
</section><!--#service-content-->

<!-- === Section Services === -->
<section id="services">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="row ">
					<div class="services-item text-center sc1">
						<?php
							$sd1_icon_img = $bookme_option['service_details1_icon_img']['url'];
							$sd1_icon_fa = $bookme_option['service_details1_icon'];
							if ( $sd1_icon_img ) {
								echo '<div class="icon-img"><img src="' . esc_url($sd1_icon_img) . '" alt=""></div>';
							} else {
								if ( $sd1_icon_fa ) {
									echo '<i class="fa fa-4x ' . esc_attr($sd1_icon_fa) . '"></i>';
								}
							}

							$sd1_small_title = $bookme_option['service_details1_small_text'];
							if ( $sd1_small_title )
          						echo '<div class="small-title"><h4>' . esc_attr( $sd1_small_title ) . '</h4></div>';

          					$sd1_title = $bookme_option['service_details1_title'];
          					if ( $sd1_title )
          						echo '<div class="title"><h3>' . esc_attr( $sd1_title ) . '</h3></div>';

          					$sd1_content = $bookme_option['service_details1_content'];
          					if ( $sd1_content ) echo wp_kses_post($sd1_content);

          					$sd1_more_text = $bookme_option['service_details1_readmore_tex'];
          					$sd1_more_link = $bookme_option['service_details1_readmore_url'];
          					if ( $sd1_more_link ) {
          						echo '<a class="btn" href="' . esc_url($sd1_more_link) . '">';
          						if ( $sd1_more_text ) echo esc_attr($sd1_more_text);
          						echo '</a>';
          					}
          				?>
         			</div>
        		</div>
       		</div>
       		<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="row sc2">
					<div class="services-item text-center">
						<?php
							$sd2_icon_img = $bookme_option['service_details2_icon_img']['url'];
							$sd2_icon_fa = $bookme_option['service_details2_icon'];
							if ( $sd2_icon_img ) {
								echo '<div class="icon-img"><img src="' . esc_url($sd2_icon_img) . '" alt=""></div>';
							} else {
								if ( $sd2_icon_fa ) {
									echo '<i class="fa fa-4x ' . esc_attr($sd2_icon_fa) . '"></i>';
								}
							}

							$sd2_small_title = $bookme_option['service_details2_small_text'];
							if ( $sd2_small_title )
          						echo '<div class="small-title"><h4>' . esc_attr( $sd2_small_title ) . '</h4></div>';

          					$sd2_title = $bookme_option['service_details2_title'];
          					if ( $sd2_title )
          						echo '<div class="title"><h3>' . esc_attr( $sd2_title ) . '</h3></div>';

          					$sd2_content = $bookme_option['service_details2_content'];
          					if ( $sd2_content ) echo wp_kses_post($sd2_content);

          					$sd2_more_text = $bookme_option['service_details2_readmore_tex'];
          					$sd2_more_link = $bookme_option['service_details2_readmore_url'];
          					if ( $sd2_more_link ) {
          						echo '<a class="btn" href="' . esc_url($sd2_more_link) . '">';
          						if ( $sd2_more_text ) echo esc_attr($sd2_more_text);
          						echo '</a>';
          					}
          				?>
         			</div>
        		</div>
       		</div>
       		<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="row sc3">
					<div class="services-item text-center">
						<?php
							$sd3_icon_img = $bookme_option['service_details3_icon_img']['url'];
							$sd3_icon_fa = $bookme_option['service_details3_icon'];
							if ( $sd3_icon_img ) {
								echo '<div class="icon-img"><img src="' . esc_url($sd3_icon_img) . '" alt=""></div>';
							} else {
								if ( $sd3_icon_fa ) {
									echo '<i class="fa fa-4x ' . esc_attr($sd3_icon_fa) . '"></i>';
								}
							}

							$sd3_small_title = $bookme_option['service_details3_small_text'];
							if ( $sd3_small_title )
          						echo '<div class="small-title"><h4>' . esc_attr( $sd3_small_title ) . '</h4></div>';

          					$sd3_title = $bookme_option['service_details3_title'];
          					if ( $sd3_title )
          						echo '<div class="title"><h3>' . esc_attr( $sd3_title ) . '</h3></div>';

          					$sd3_content = $bookme_option['service_details3_content'];
          					if ( $sd3_content ) echo wp_kses_post($sd3_content);

          					$sd3_more_text = $bookme_option['service_details3_readmore_tex'];
          					$sd3_more_link = $bookme_option['service_details3_readmore_url'];
          					if ( $sd3_more_link ) {
          						echo '<a class="btn" href="' . esc_url($sd3_more_link) . '">';
          						if ( $sd3_more_text ) echo esc_attr($sd3_more_text);
          						echo '</a>';
          					}
          				?>
         			</div>
        		</div>
       		</div>
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</section><!-- #services -->
