<?php 
/*
 * Tab Section
 *
 */
$tabs = get_post_meta(get_the_ID(), '_BookmeMB_tab_details', true);
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_tab_sect_title', true);
$sect_style = '';
$wrap_style = '';
$bg_img = get_post_meta(get_the_ID(), '_BookmeMB_tab_bg_img', true);
$bg_color = get_post_meta(get_the_ID(), '_BookmeMB_tab_bg_color', true);
if ( $bg_img ) $sect_style = 'style="background-image: url(' . esc_url($bg_img) . ');"';
if ( $bg_color ) $wrap_style = 'style="background-color: ' . $bg_color . ';"';
if ( $tabs ) : ?>
	<section id="tabs" <?php echo $sect_style; ?>>
		<div class="tabs-wrapper" <?php echo $wrap_style; ?>>
			<div class="container wow fadeInDown">
				<div class="row">
					<?php if ( $sect_title ) : ?>
						<div class="col-md-12">
							<div class="header-section text-center">
								<h2 class="title"><?php echo esc_attr($sect_title); ?></h2>
							</div>
						</div>
					<?php endif; ?>
					<div class="col-md-12">
						<div class="tabs-item">
							<?php 
								$tab_id = 1;
								echo '<ul class="nav nav-tabs" role="tablist">';
								foreach( (array) $tabs as $key => $tab ) { 
									$title = $icon = $title_img = $tab_content = ''; 
									if ( isset($tab['title']) ) $title = $tab['title']; 
									if ( isset($tab['icon']) ) $icon = $tab['icon']; 
									if ( isset($tab['title_img']) ) $title_img = $tab['title_img']; 
									$active = '';
									if ( $tab_id == 1 ) $active = 'class="active"';?>
										<li role="presentation" <?php echo $active; ?>>
											<a href="#tab-<?php echo $tab_id; ?>" aria-controls="tab-<?php echo $tab_id; ?>" role="tab" data-toggle="tab">
												<div class="tab-title">
													<?php 
														if ( $title_img != '' ) {
															echo '<img class="grayscale" src="' . esc_url($title_img) . '" alt="" />';
														} elseif ( $title != '' ) {
															if ( $icon != '' ) echo '<i class="fa ' . $icon . '"></i>';
															echo esc_attr($title);
														} else {
															echo esc_html__('Tab ', 'bookme') . $tab_id;
														}
													?>
												</div>
											</a>
										</li><?php $tab_id++;
								}
								echo '</ul>';
								echo '<div class="tab-content">';
								$content_id = 1;
								foreach( (array) $tabs as $key => $tab ) { 
									$tab_content = ''; 
									$aktip = '';
									if ( $content_id == 1 ) $aktip = 'active';
									if ( isset($tab['tab_content']) ) $tab_content = apply_filters('the_content', $tab['tab_content']); ?>
										<div role="tabpanel" class="tab-pane col-md-12 <?php echo $aktip; ?>" id="tab-<?php echo $content_id; ?>">
											<?php if ( $tab_content != '' ) echo wp_kses_post($tab_content); ?>
										</div><?php 
									$content_id++;
								}
								echo '</div>';
							?>
						</div>
					</div>
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.tabs-wrapper-->
	</section><!-- #tabs --><?php 
endif;
