<?php 

/*------------------------------------------------------------------*/
/*	Header Hook
/*------------------------------------------------------------------*/

function bookme_head() { 
	do_action( 'bookme_head_section' );		
}
add_action( 'wp_head', 'bookme_head', 0 );

if ( !function_exists( 'bookme_head_script' ) ) {
	function bookme_head_script() { ?>
		<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
		<![endif]-->
		<script>(function(){document.documentElement.className='js'})();</script><?php 
	}
	add_action( 'bookme_head_section', 'bookme_head_script' );
}

if ( !function_exists( 'bookme_favicon' ) ) {
	function bookme_favicon() {
		global $bookme_option;
		$favicon = $bookme_option['site_favicon']['url']; 
		if ( $favicon ) echo '<link rel="icon" href="' . esc_url( $favicon ) . '" type="image/x-icon">';
	}
}

if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	add_action( 'bookme_head_section', 'bookme_favicon' );
}


if ( !function_exists( 'bookme_theme_inline_css' ) ) {
	function bookme_theme_inline_css() {
		include get_template_directory() . '/inc/color-scheme.php';
		echo '<style type="text/css">';
		
			global $bookme_option;
		
			$header_bg = get_post_meta(get_the_ID(), '_BookmeMB_header_bg_color', true);
			if ( $header_bg ) 
				echo '.site-header { background-color: ' . $header_bg . '; } ';

			$page_color_scheme = get_post_meta(get_the_ID(), '_BookmeMB_page_color_scheme', true);
			if ( $page_color_scheme )
				echo '.logo-wrapper .dropdown .btn, .small-title, .btn-two, #about .fa, .dot::before { color: '. $page_color_scheme .' !important; } ';
				echo '.btn-one, #facts .fa { background-color: '.$page_color_scheme.' !important; } ';
				echo '#main-menu .nav-menu li a:hover, #main-menu .nav-menu li a:focus, .btn-one, .btn-two { border-color: '. $page_color_scheme .' !important; } ';
				echo '.container { padding-left: 15px !important; padding-right: 15px !important; } ';

			$facts_bg_img = get_post_meta(get_the_ID(), '_BookmeMB_facts_bg_image', true);
			$facts_bg_color = get_post_meta(get_the_ID(), '_BookmeMB_facts_bg_color', true);
			if ( $facts_bg_img )
				echo 'body #facts { background-image: url("'.esc_url($facts_bg_img).'") !important; } ';
			if ( $facts_bg_color )
				echo '.facts-wrapper { background-color: '.$facts_bg_color.'; } ';

			$therapy_testi_bg_img = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonials_bg_img', true);
			$therapy_testi_bg_color = get_post_meta(get_the_ID(), '_BookmeMB_therapy_testimonials_bg_color', true);
			if ($therapy_testi_bg_img) {
				echo 'body #page-therapy #testimonials { background-image: url('.$therapy_testi_bg_img.'); } ';
				echo 'body #page-corporate-trainer #testimonials { background-image: url('.$therapy_testi_bg_img.'); } ';
			}
			if ( $therapy_testi_bg_color ) {
				echo '#page-therapy #testimonials .testimonials-wrapper { background-color: '.$therapy_testi_bg_color.'; } ';
				echo '#page-corporate-trainer #testimonials .testimonials-wrapper { background-color: '.$therapy_testi_bg_color.'; } ';
			}

			$service_archive_content_bg = $bookme_option['service_archive_content_bg'];
			if ( !empty( $service_archive_content_bg ) ) {
				echo '#service-content { ';
			
					if ( isset($service_archive_content_bg['background-color']) ) {
						$sc_bg_color = $service_archive_content_bg['background-color'];
						echo 'background-color: ' . $sc_bg_color . '; ';
					}
					if ( isset($service_archive_content_bg['background-image']) ) {
						$sc_bg_img = $service_archive_content_bg['background-image'];
						echo 'background-image: url(' . $sc_bg_img . '); ';
					}
					if ( isset($service_archive_content_bg['background-repeat']) ) {
						$sc_bg_repeat = $service_archive_content_bg['background-repeat'];
						echo 'background-repeat: ' . $sc_bg_repeat . '; ';
					}
					if ( isset($service_archive_content_bg['background-position']) ) {
 						$sc_bg_position = $service_archive_content_bg['background-position'];
 						echo 'background-position: ' . $sc_bg_position . '; ';
 					}
					if ( isset($service_archive_content_bg['background-size']) ) {
						$sc_bg_size = $service_archive_content_bg['background-size'];
						echo 'background-size: ' . $sc_bg_size . '; ';
					}
					if ( isset($service_archive_content_bg['background-attachment']) ) {
						$sc_bg_attachment = $service_archive_content_bg['background-attachment'];
						echo 'background-attachment: ' . $sc_bg_attachment . '; ';
					}
				echo ' } ';
				
			}
			
			$archive_sc1 = $bookme_option['service_details1_bg'];
			if ( !empty( $archive_sc1 ) ) {
				echo '#services .sc1 { ';
			
					if ( isset($archive_sc1['background-image']) ) {
						$sc1_bg_img = $archive_sc1['background-image'];
						echo 'background-image: url(' . $sc1_bg_img . '); ';
					}
					if ( isset($archive_sc1['background-repeat']) ) {
						$sc1_bg_repeat = $archive_sc1['background-repeat'];
						echo 'background-repeat: ' . $sc1_bg_repeat . '; ';
					}
					if ( isset($archive_sc1['background-position']) ) {
 						$sc1_bg_position = $archive_sc1['background-position'];
 						echo 'background-position: ' . $sc1_bg_position . '; ';
 					}
					if ( isset($archive_sc1['background-size']) ) {
						$sc1_bg_size = $archive_sc1['background-size'];
						echo 'background-size: ' . $sc1_bg_size . '; ';
					}
					if ( isset($archive_sc1['background-attachment']) ) {
						$sc1_bg_attachment = $archive_sc1['background-attachment'];
						echo 'background-attachment: ' . $sc1_bg_attachment . '; ';
					}
				echo ' } ';
				
				echo '.sc1 .services-item { ';
					if ( isset($archive_sc1['background-color']) ) {
						$sc1_bg_color = $archive_sc1['background-color'];
						echo 'background-color: ' . $sc1_bg_color . '; ';
					}
				echo ' } ';
			}
			$sc1_small_color = $bookme_option['service_details1_small_text_color'];
			$sc1_title_color = $bookme_option['service_details1_title_color'];
			$sc1_content_color = $bookme_option['service_details1_content_color'];
			$sc1_readmore_color = $bookme_option['service_details1_readmore_color'];
			$sc1_icon_color = $bookme_option['service_details1_icon_color'];
			if ( $sc1_icon_color )
				echo '#services .sc1 .fa { color: ' . $sc1_icon_color . '; } ';
			if ( $sc1_small_color )
				echo '#services .sc1 .small-title { color: ' . $sc1_small_color . '; } ';
			if ( $sc1_title_color )
				echo '#services .sc1 .title { color: ' . $sc1_title_color . '; } ';
			if ( $sc1_content_color )
				echo '#services .services-item.sc1 p { color: ' . $sc1_content_color . '; } ';
			if ( $sc1_readmore_color )
				echo '#services .sc1 .btn { border-color: ' . $sc1_readmore_color . '; color: ' . $sc1_readmore_color . '; } ';
			
			$archive_sc2 = $bookme_option['service_details2_bg'];
			if ( !empty( $archive_sc2 ) ) {
				echo '#services .sc2 { ';
			
					if ( isset($archive_sc2['background-image']) ) {
						$sc2_bg_img = $archive_sc2['background-image'];
						echo 'background-image: url(' . $sc2_bg_img . '); ';
					}
					if ( isset($archive_sc2['background-repeat']) ) {
						$sc2_bg_repeat = $archive_sc2['background-repeat'];
						echo 'background-repeat: ' . $sc2_bg_repeat . '; ';
					}
					if ( isset($archive_sc2['background-position']) ) {
 						$sc2_bg_position = $archive_sc2['background-position'];
 						echo 'background-position: ' . $sc2_bg_position . '; ';
 					}
					if ( isset($archive_sc2['background-size']) ) {
						$sc2_bg_size = $archive_sc2['background-size'];
						echo 'background-size: ' . $sc2_bg_size . '; ';
					}
					if ( isset($archive_sc2['background-attachment']) ) {
						$sc2_bg_attachment = $archive_sc2['background-attachment'];
						echo 'background-attachment: ' . $sc2_bg_attachment . '; ';
					}
				echo ' } ';
				
				echo '.sc2 .services-item { ';
					if ( isset($archive_sc2['background-color']) ) {
						$sc2_bg_color = $archive_sc2['background-color'];
						echo 'background-color: ' . $sc2_bg_color . '; ';
					}
				echo ' } ';
			}
			$sc2_small_color = $bookme_option['service_details2_small_text_color'];
			$sc2_title_color = $bookme_option['service_details2_title_color'];
			$sc2_content_color = $bookme_option['service_details2_content_color'];
			$sc2_readmore_color = $bookme_option['service_details2_readmore_color'];
			$sc2_icon_color = $bookme_option['service_details2_icon_color'];
			if ( $sc2_icon_color )
				echo '#services .sc2 .fa { color: ' . $sc2_icon_color . '; } ';
			if ( $sc2_small_color )
				echo '#services .sc2 .small-title { color: ' . $sc2_small_color . '; } ';
			if ( $sc2_title_color )
				echo '#services .sc2 .title { color: ' . $sc2_title_color . '; } ';
			if ( $sc2_content_color )
				echo '#services .services-item.sc2 p { color: ' . $sc2_content_color . '; } ';
			if ( $sc2_readmore_color )
				echo '#services .sc2 .btn { border-color: ' . $sc2_readmore_color . '; color: ' . $sc2_readmore_color . '; } ';
			
			$archive_sc3 = $bookme_option['service_details3_bg'];
			if ( !empty( $archive_sc3 ) ) {
				echo '#services .sc3 { ';
			
					if ( isset($archive_sc3['background-image']) ) {
						$sc3_bg_img = $archive_sc3['background-image'];
						echo 'background-image: url(' . $sc3_bg_img . '); ';
					}
					if ( isset($archive_sc3['background-repeat']) ) {
						$sc3_bg_repeat = $archive_sc3['background-repeat'];
						echo 'background-repeat: ' . $sc3_bg_repeat . '; ';
					}
					if ( isset($archive_sc3['background-position']) ) {
 						$sc3_bg_position = $archive_sc3['background-position'];
 						echo 'background-position: ' . $sc3_bg_position . '; ';
 					}
					if ( isset($archive_sc3['background-size']) ) {
						$sc3_bg_size = $archive_sc3['background-size'];
						echo 'background-size: ' . $sc3_bg_size . '; ';
					}
					if ( isset($archive_sc3['background-attachment']) ) {
						$sc3_bg_attachment = $archive_sc3['background-attachment'];
						echo 'background-attachment: ' . $sc3_bg_attachment . '; ';
					}
				echo ' } ';
				
				echo '.sc3 .services-item { ';
					if ( isset($archive_sc3['background-color']) ) {
						$sc3_bg_color = $archive_sc3['background-color'];
						echo 'background-color: ' . $sc3_bg_color . '; ';
					}
				echo ' } ';
			}
			$sc3_small_color = $bookme_option['service_details3_small_text_color'];
			$sc3_title_color = $bookme_option['service_details3_title_color'];
			$sc3_content_color = $bookme_option['service_details3_content_color'];
			$sc3_readmore_color = $bookme_option['service_details3_readmore_color'];
			$sc3_icon_color = $bookme_option['service_details3_icon_color'];
			if ( $sc3_icon_color )
				echo '#services .sc3 .fa { color: ' . $sc3_icon_color . '; } ';
			if ( $sc3_small_color )
				echo '#services .sc3 .small-title { color: ' . $sc3_small_color . '; } ';
			if ( $sc3_title_color )
				echo '#services .sc3 .title { color: ' . $sc3_title_color . '; } ';
			if ( $sc3_content_color )
				echo '#services .services-item.sc3 p { color: ' . $sc3_content_color . '; } ';
			if ( $sc3_readmore_color )
				echo '#services .sc3 .btn { border-color: ' . $sc3_readmore_color . '; color: ' . $sc3_readmore_color . '; } ';
				
			$booked_shortcode = get_post_meta(get_the_ID(), '_BookmeMB_slider_booked_shortcode', true);
			if ( class_exists( 'booked_plugin' ) && !empty($booked_shortcode) ) {
				//echo 'body #main-slider .slide-content { top: 10%; } ';
			}
			
			$services = get_post_meta(get_the_ID(), '_BookmeMB_services', true);
			if ( $services ) {
				foreach ( (array) $services as $key => $service ) {
					$img_bg = '';
					if ( isset( $service['image'] ) ) 
						$img_bg = $service['image'];
						
					if ( $img_bg ) {
						echo '.services-item.service-'.$key.':hover, .services-item.service-'.$key.':focus { background-image: url(' . esc_url( $img_bg ) . '); background-repeat: no-repeat; background-size: cover; } ';
					}
				}
			}
			
			$gen_pg_title_bg = $bookme_option['page_title_bg']['url'];
			if($gen_pg_title_bg) 
				echo '#navigations { background-image: url(' . esc_url($gen_pg_title_bg) . '); } ';
				
			$gen_pg_title_color = $bookme_option['page_title_color'];
			if($gen_pg_title_color) 
				echo '#navigations .title h1 { color: ' . esc_attr($gen_pg_title_color) . '; } ';
				
			$gen_breadcrumb_color = $bookme_option['breadcrumb_color'];
			if($gen_breadcrumb_color) 
				echo '#navigations .breadcrumb { color: ' . esc_attr($gen_breadcrumb_color) . '; } ';
			
			$custom_css = $bookme_option['custom_css'];
			if ( $custom_css )
				echo $custom_css;
				
			$page_titel_bg = get_post_meta(get_the_ID(), '_BookmeMB_page_title_img_bg', true);
			if($page_titel_bg)
				echo '#navigations { background-image: url(' . esc_url($page_titel_bg) . '); } ';
				
			$page_titel_color = get_post_meta(get_the_ID(), '_BookmeMB_page_title_color', true);
			if($page_titel_color) 
				echo '#navigations .title h1 { color: ' . esc_attr($page_titel_color) . '; } ';
				
			$page_brdcumb_color = get_post_meta(get_the_ID(), '_BookmeMB_breadcrumb_color', true);
			if($page_brdcumb_color)
				echo '#navigations .breadcrumb { color: ' . esc_attr($page_brdcumb_color) . '; } ';
				
			$post_titel_bg = get_post_meta(get_the_ID(), '_BookmeMB_post_title_img_bg', true);
			if($post_titel_bg)
				echo '#navigations { background-image: url(' . esc_url($post_titel_bg) . '); } ';
				
			$post_titel_color = get_post_meta(get_the_ID(), '_BookmeMB_post_title_color', true);
			if($post_titel_color) 
				echo '#navigations .title h1 { color: ' . esc_attr($post_titel_color) . '; } ';
				
			$post_brdcumb_color = get_post_meta(get_the_ID(), '_BookmeMB_post_breadcrumb_color', true);
			if($post_brdcumb_color)
				echo '#navigations .breadcrumb { color: ' . esc_attr($post_brdcumb_color) . '; } ';
				
			
		echo '</style>';
	}
}
add_action('wp_head', 'bookme_theme_inline_css', 9999);


/*------------------------------------------------------------------*/
/*	Page Hook
/*------------------------------------------------------------------*/

function bookme_before_header() { 
	do_action( 'bookme_before_header_section' );		
}
function bookme_after_header() { 
	do_action( 'bookme_after_header_section' );		
}
function bookme_before_page() {
	do_action('bookme_before_page_content');
}
function bookme_after_page() {
	do_action('bookme_after_page_content');
}
function bookme_before_footer() { 
	do_action( 'bookme_before_footer_section' );		
}
function bookme_footer() { 
	do_action( 'bookme_footer_after' );		
}

if ( !function_exists( 'bookme_site_content_start' ) ) {
	function bookme_site_content_start() {
		echo '<div id="content" class="site-content">';
	}
	add_action( 'bookme_after_header_section', 'bookme_site_content_start', 10 );
}

if ( !function_exists( 'bookme_site_wrapper_end' ) ) {
	function bookme_site_wrapper_end() {
		echo '</div>';
	}
	add_action( 'bookme_footer_after', 'bookme_site_wrapper_end', 10 );
}

if ( !function_exists('bookme_entry_header') ) {
	function bookme_entry_header() { ?>
		<section id="navigations">
			<div class="navigations-wrapper">
				<div class="container">
				
					<?php if ( !is_search() ) : ?>
						<?php bookme_breadcrumbs(); ?>
					<?php endif; ?>
					
					<?php if ( is_404() ) : ?>
						<div class="title">
							<h1 class="page-title"><?php echo esc_html__('404 Error Page', 'bookme'); ?><span class="screen-reader-text"><?php echo esc_html__('404 Error Page', 'bookme'); ?></span></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_home() && ! is_front_page() ) : ?>
						<div class="title">
							<h1 class="page-title"><?php single_post_title(); ?><span class="screen-reader-text"><?php single_post_title(); ?></span></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_archive() && !is_post_type_archive('bookme_service') ) : ?>
						<div class="title">
							<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
						</div>
					<?php endif; ?>
					
					<?php if ( is_post_type_archive('bookme_service') ) : ?>
					<div class="title">
							<h1><?php echo esc_html__('Service', 'bookme'); ?></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_singular('post') ) : ?>
						<div class="title">
							<h1><?php echo esc_html__('Blog Post', 'bookme'); ?></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_singular('bookme_service') ) : ?>
						<div class="title">
							<h1><?php echo esc_html__('Service Details', 'bookme'); ?></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_page() ) : ?>
						<div class="title">
							<h1><?php the_title(); ?></h1>
						</div>
					<?php endif; ?>
					
					<?php if ( is_search() ) : ?>
						<div class="title">
							<h1><?php printf( esc_html__( 'Search Results for: %s', 'bookme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</div>
					<?php endif; ?>
					
				</div>
			</div>
		</section><?php 
	}
	add_action('bookme_before_page_content', 'bookme_entry_header', 10);
}

if ( !function_exists('bookme_page_layout_start') ) {
	function bookme_page_layout_start() {
		$class_id = 'page-entry';
		if ( is_home() && ! is_front_page() || is_single() ) $class_id = 'blog-content';
		echo '<div id="' . $class_id . '" class="page-content-wrapper container"><div class="row">';
		global $bookme_option;
		$page_layout = '';
		if ( is_404() || is_page_template('template-why-me.php') || is_page_template('template-about.php') ) :
			$page_layout = 'col-md-12 col-sm-12';
		elseif ( is_single() ) :
			$page_layout_mb = get_post_meta(get_the_ID(), '_BookmeMB_post_layout', true);
			if ( $page_layout_mb == 'left_sb' ) {
				$page_layout = 'col-md-8 col-sm-8';
				get_sidebar();
			} elseif ( $page_layout_mb == 'fullwidth' ) {
				$page_layout = 'col-md-12 col-sm-12';
			} else {
				$page_layout = 'col-md-8 col-sm-8';
			}
		else :
			$page_layout_mb = get_post_meta(get_the_ID(), '_BookmeMB_page_layout', true);
			$site_layout = $bookme_option['site_layout'];
			if ( $page_layout_mb == 'left_sb' ) {
				$page_layout = 'col-md-8 col-sm-8';
				get_sidebar();
			} elseif ( $page_layout_mb == 'right_sb' ) {
				$page_layout = 'col-md-8 col-sm-8';
			} elseif ( $page_layout_mb == 'fullwidth' )  {
				$page_layout = 'col-md-12 col-sm-12';
			} elseif ( empty( $page_layout_mb ) || $page_layout_mb = '' ) {
				if ( $site_layout == 'sb_left' ) {
					$page_layout = 'col-md-8 col-sm-8';
					get_sidebar();
				} elseif ( $site_layout == 'sb_right' ) {
					$page_layout = 'col-md-8 col-sm-8';
				} else {
					$page_layout = 'col-md-12 col-sm-12';
				}
			} 
		endif;
		echo '<div id="primary" class="content-area '. $page_layout .'"><main id="main" class="site-main" >';
	}
	add_action('bookme_before_page_content', 'bookme_page_layout_start', 20);
}

if ( !function_exists('bookme_page_layout_end') ) {
	function bookme_page_layout_end() {
		echo '</main></div>';
		
		if ( is_404() || is_page_template('template-why-me.php') || is_page_template('template-about.php') ) { 
			// Do No Thing!!!
		} else {
		
		global $bookme_option;
		$page_layout = '';
		
			if ( is_single() ) {
				$page_layout_mb = get_post_meta(get_the_ID(), '_BookmeMB_post_layout', true);
				if ( empty( $page_layout_mb ) || $page_layout_mb == '' || $page_layout_mb == 'right_sb' ) get_sidebar();
			} else {
				$page_layout_mb = get_post_meta(get_the_ID(), '_BookmeMB_page_layout', true);
				$site_layout = $bookme_option['site_layout'];
				if ( $page_layout_mb == 'right_sb' ) {
					get_sidebar(); 
				} else {
					if ( empty( $page_layout_mb ) && $site_layout == 'sb_right' || $page_layout_mb = '' && $site_layout == 'sb_right' ) {
						get_sidebar(); 
					}
				}
			}
		} 

		echo '</div></div>';
	}
	add_action('bookme_after_page_content', 'bookme_page_layout_end');
}

if ( !function_exists( 'bookme_custom_script' ) ) {
	function bookme_custom_script() {
		global $bookme_option;
		$custom_js = $bookme_option['custom_js'];
		if ( $custom_js ) {
			echo '<script type="text/javascript">';
			echo $custom_js;
			echo '</script>';
		}
	}
	add_action('wp_footer', 'bookme_custom_script', 9999);
}
