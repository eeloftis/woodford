<?php 
/*
 * Architect About Details
 *
 */

$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_architect_about_details_small_text', true);
$sect_content = get_post_meta(get_the_ID(), '_BookmeMB_architect_about_details_content', true);
if ( $sect_title || $sect_content ) : ?>
	<section id="about-details">
		<div class="container wow fadeInDown">
			<div class="row">
				<div class="col-md-12">
					<div class="header-section text-center">
						<?php if ( $sect_title ) echo '<div class="small-title"><h3>' . esc_attr( $sect_title ) . '</h3></div>'; ?>
						<?php if ( $sect_content ) echo wp_kses_post($sect_content); ?>
					</div>
				</div>
				<div class="main-post">
					<div class="col-md-4 col-sm-4">
						<div class="post text-center">
							<?php 
								$owner_icon_fa = get_post_meta(get_the_ID(), '_BookmeMB_home_owner_icon', true);
								$owner_icon_img = get_post_meta(get_the_ID(), '_BookmeMB_home_owner_icon_img', true);
								if ( $owner_icon_img ) {
									echo '<div class="icon-img"><img src="' .esc_url($owner_icon_img). '" alt=""></div>';
								} elseif ( $owner_icon_fa ) {
									echo '<i class="fa '.esc_attr($owner_icon_fa).'"></i>';
								} else {
									echo '<i class="fa fa-home"></i>';
								}
							?>
							<div class="about-details-count">
								<?php $comments_count = get_post_meta(get_the_ID(), '_BookmeMB_home_owner_count', true); ?>	
								<?php if ( $comments_count ) : ?>							
									<span data-to="<?php echo esc_attr($comments_count); ?>">0</span>
								<?php endif; ?>
							</div>
							<?php 
								$owner_title = get_post_meta(get_the_ID(), '_BookmeMB_home_owner_title', true);
								$owner_desc = get_post_meta(get_the_ID(), '_BookmeMB_home_owner_desc', true); ?>
									<div class="title-regular">
										<?php if ($owner_title) { echo '<h4>' .esc_attr($owner_title). '</h4>'; } else { ?>
											<h4>Happy Home Owners</h4>
										<?php } ?>
									</div>
									<p>
									<?php if ($owner_desc) { echo esc_attr($owner_desc); } else { ?>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit debitis quas reiciendis consectetur totam fuga amet.
									<?php } ?>
									</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="post text-center">
							<?php 
								$projects_icon_fa = get_post_meta(get_the_ID(), '_BookmeMB_ongoing_project_icon', true);
								$projects_icon_img = get_post_meta(get_the_ID(), '_BookmeMB_ongoing_project_icon_img', true);
								if ($projects_icon_img) {
									echo '<div class="icon-img"><img src="' .esc_url($projects_icon_img). '" alt=""></div>';
								} elseif ( $projects_icon_fa ) {
									echo '<i class="fa '.esc_attr($projects_icon_fa).'"></i>';
								} else {
									echo '<i class="fa fa-home"></i>';
								}
							?>
							<div class="about-details-count">
								<?php $post_count = get_post_meta(get_the_ID(), '_BookmeMB_ongoing_project_count', true); ?>	
								<?php if ( $post_count ) : ?>							
									<span data-to="<?php echo esc_attr($post_count); ?>">0</span>
								<?php endif; ?>
							</div>
							<?php 
								$projects_title = get_post_meta(get_the_ID(), '_BookmeMB_ongoing_project_title', true);
								$projects_desc = get_post_meta(get_the_ID(), '_BookmeMB_ongoing_project_desc', true); ?>
									<div class="title-regular">
										<?php if ($projects_title) { echo '<h4>' .esc_attr($projects_title). '</h4>'; } else { ?>
											<h4>Ongoing Projects</h4>
										<?php } ?>
									</div>
									<p>
									<?php if ($projects_desc) { echo esc_attr($projects_desc); } else { ?>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit debitis quas reiciendis consectetur totam fuga amet.
									<?php } ?>
									</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="post text-center">
							<?php 
								$plans_icon_fa = get_post_meta(get_the_ID(), '_BookmeMB_future_plans_icon', true);
								$plans_icon_img = get_post_meta(get_the_ID(), '_BookmeMB_future_plans_icon_img', true);
								if ($plans_icon_img) {
									echo '<div class="icon-img"><img src="' .esc_url($plans_icon_img). '" alt=""></div>';
								} elseif ( $plans_icon_fa ) {
									echo '<i class="fa '.esc_attr($plans_icon_fa).'"></i>';
								} else {
									echo '<i class="fa fa-home"></i>';
								}
							?>
							<div class="about-details-count">
								<?php $plans_count = get_post_meta(get_the_ID(), '_BookmeMB_future_plans_count', true); ?>	
								<?php if ( $plans_count ) : ?>							
									<span data-to="<?php echo esc_attr($plans_count); ?>">0</span>
								<?php endif; ?>
							</div>
							<?php 
								$plans_title = get_post_meta(get_the_ID(), '_BookmeMB_future_plans_title', true);
								$plans_desc = get_post_meta(get_the_ID(), '_BookmeMB_future_plans_desc', true); ?>
									<div class="title-regular">
										<?php if ($plans_title) { echo '<h4>' .esc_attr($plans_title). '</h4>'; } else { ?>
											<h4>Ongoing plans</h4>
										<?php } ?>
									</div>
									<p>
									<?php if ($plans_desc) { echo esc_attr($plans_desc); } else { ?>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit debitis quas reiciendis consectetur totam fuga amet.
									<?php } ?>
									</p>
						</div>
					</div>
				</div>
				<?php 
					$more_text = get_post_meta(get_the_ID(), '_BookmeMB_architect_about_details_btn_text', true);
					$more_link = get_post_meta(get_the_ID(), '_BookmeMB_architect_about_details_more_url', true);
					if ( $more_link ) : ?>
						<div class="col-md-12">
							<div class="header-section text-center">
								<a class="btn btn-three" href="<?php echo esc_url($more_link); ?>"><?php echo esc_attr($more_text); ?></a>
							</div>
						</div><?php 
					endif; 
				?>
			</div>
		</div>
	</section><?php 
endif;
