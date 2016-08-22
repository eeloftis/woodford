<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BookMe Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
	global $bookme_option;
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
    <div id="wrapp">

	<?php bookme_before_header(); ?>

	<header id="masthead" class="site-header">
			<div class="container">
			<div class="row">
				<div class="col-md-4 re-size col-sm-4">
						<div class="logo-wrapper">
							<a href="<?php echo esc_url( home_url() ); ?>" >
							<?php
								$site_logo = $bookme_option['header_logo']['url'];
								if ( $site_logo != '' || !empty($site_logo) ) {
									echo '<img src="' . $site_logo . '" alt="' . get_bloginfo('name') . '">';
								} else { ?>
								<h1 class="site-name">
									<?php echo esc_attr( get_bloginfo('name') ); ?>
								</h1>
								<p class="site-desc">
									<?php echo esc_attr( get_bloginfo('description') ); ?>
								</p>
							<?php } ?>
							</a>
						</div>
                        <div class="header-right movers-show">
							<?php
								$social_icon = $bookme_option['header_social_icon'];
								if ( $social_icon == 1 ) :
									echo '<div class="bookme-social-media">';
										echo '<ul>';

										$facebook = $bookme_option['facebook_url'];
										$twitter = $bookme_option['twitter_url'];
										$google = $bookme_option['google_url'];
										$linkedin = $bookme_option['linkedin_url'];
										$instagram = $bookme_option['instagram_url'];
										$youtube = $bookme_option['youtube_url'];

										if ( $facebook )
											echo '<li><a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a></li>';
										if ( $twitter )
											echo '<li><a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a></li>';
										if ( $google )
											echo '<li><a href="' . esc_url( $google ) . '"><i class="fa fa-google-plus"></i></a></li>';
										if ( $linkedin )
											echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a></li>';
										if ( $instagram )
											echo '<li><a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a></li>';
										if ( $youtube )
											echo '<li><a href="' . esc_url( $youtube ) . '"><i class="fa fa-youtube"></i></a></li>';

										echo '</ul>';
									echo '</div>';
								endif;

								$mb_header_quote = get_post_meta(get_the_ID(), '_BookmeMB_header_quote', true);
								if ( $mb_header_quote == 'on' ) {
									echo '<div class="header-quote">';

									$quote_text = get_post_meta(get_the_ID(), '_BookmeMB_header_quote_text', true);
									if ( $quote_text )
										echo '<div class="quote-text">' . ( esc_attr( $quote_text ) ) . '</div>';

									$quote_phone = get_post_meta(get_the_ID(), '_BookmeMB_header_quote_phone', true);
									if ( $quote_phone )
										echo '<div class="bookme-phone"><h4> ' . esc_attr( $quote_phone ) . '</h4></div>';

									echo '</div>';
								} else {
									$header_quote = $bookme_option['header_quote'];
									if ( $header_quote == 1 ) :
										echo '<div class="header-quote">';

										$quote_text = $bookme_option['header_quote_text'];
										if ( $quote_text )
											echo '<div class="quote-text">' . ( esc_attr( $quote_text ) ) . '</div>';

										$quote_phone = $bookme_option['header_quote_phone'];
										if ( $quote_phone )
											echo '<div class="bookme-phone"><h4> ' . esc_attr( $quote_phone ) . '</h4></div>';

										echo '</div>';
									endif;
								}
							?>
				    </div>
                    <div class="clearfix"></div>
				</div>
				<div class="col-md-8 col-sm-8 re-size">
					<div class="row">
						<div class="header-right">
							<?php
								$social_icon = $bookme_option['header_social_icon'];
								if ( $social_icon == 1 ) :
									echo '<div class="bookme-social-media">';
										echo '<ul>';

										$facebook = $bookme_option['facebook_url'];
										$twitter = $bookme_option['twitter_url'];
										$google = $bookme_option['google_url'];
										$linkedin = $bookme_option['linkedin_url'];
										$instagram = $bookme_option['instagram_url'];
										$youtube = $bookme_option['youtube_url'];

										if ( $facebook )
											echo '<li><a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a></li>';
										if ( $twitter )
											echo '<li><a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a></li>';
										if ( $google )
											echo '<li><a href="' . esc_url( $google ) . '"><i class="fa fa-google-plus"></i></a></li>';
										if ( $linkedin )
											echo '<li><a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a></li>';
										if ( $instagram )
											echo '<li><a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a></li>';
										if ( $youtube )
											echo '<li><a href="' . esc_url( $youtube ) . '"><i class="fa fa-youtube"></i></a></li>';

										echo '</ul>';
									echo '</div>';
								endif;

								$mb_header_quote = get_post_meta(get_the_ID(), '_BookmeMB_header_quote', true);
								if ( $mb_header_quote == 'on' ) {
									echo '<div class="header-quote">';

									$quote_text = get_post_meta(get_the_ID(), '_BookmeMB_header_quote_text', true);
									if ( $quote_text )
										echo '<div class="quote-text">' . ( esc_attr( $quote_text ) ) . '</div>';

									$quote_phone = get_post_meta(get_the_ID(), '_BookmeMB_header_quote_phone', true);
									if ( $quote_phone )
										echo '<div class="bookme-phone"><h4> ' . esc_attr( $quote_phone ) . '</h4></div>';

									echo '</div>';
								} else {
									$header_quote = $bookme_option['header_quote'];
									if ( $header_quote == 1 ) :
										echo '<div class="header-quote">';

										$quote_text = $bookme_option['header_quote_text'];
										if ( $quote_text )
											echo '<div class="quote-text">' . ( esc_attr( $quote_text ) ) . '</div>';

										$quote_phone = $bookme_option['header_quote_phone'];
										if ( $quote_phone )
											echo '<div class="bookme-phone"><h4> ' . esc_attr( $quote_phone ) . '</h4></div>';

										echo '</div>';
									endif;
								}
							?>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <nav id="main-menu" class="clearfix">
                                <ul class="nav-menu">

																		<li><a id="about-link">About</a></li>
																		<li><a id="services-link">Services</a></li>
																		<li><a id="features-link">Leadership</a></li>
																		<li><a id="facts-link">Woodford Difference</a></li>
																		<li><a id="clients-link">Clients</a></li>
																		<li><a id="contact-estimate-link">Contact</a></li>


                                    <!-- <?php
                                        if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {
                                            wp_nav_menu( array( 'container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'primary' ) );
                                        } else {
                                            wp_list_pages( 'sort_column=menu_order&depth=6&title_li=' );
                                        }
                                    ?> -->
                                </ul>
                            </nav>
                        </div>
				    </div>
				</div>
				</div>


			</div>
		</header>

	<?php bookme_after_header(); ?>
