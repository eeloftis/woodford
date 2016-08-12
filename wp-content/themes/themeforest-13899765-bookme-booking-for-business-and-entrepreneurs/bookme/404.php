<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BookMe Theme
 */

get_header(); ?>

	<?php bookme_before_page(); ?>
	<?php global $bookme_option; ?>		
	
		<section class="error-404 not-found">
			<div class="row">
				<div class="col-md-6">
					<div class="error-wrapper">
						<?php 
							$left_title = $bookme_option['error404_left_title'];
							$left_content = $bookme_option['error404_left_content'];
							if ( $left_title ) echo '<div class="title"><h2>' . esc_attr( $left_title ) . '</h2></div>';
							if ( $left_content ) echo '<p>' . esc_attr( $left_content ) . '</p>';
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="error-content">
						<?php 
							$right_title = $bookme_option['error404_right_title'];
							$right_content = apply_filters('the_content', $bookme_option['error404_right_content']);
							$menu_object = $bookme_option['error404_menu'];
							$btn_text = $bookme_option['error404_btn_text'];
							$btn_url = $bookme_option['error404_btn_url'];
							if ( $right_title ) echo '<div class="title"><h4>' . esc_attr( $right_title ) . '</h4></div>';
							if ( $right_content ) echo $right_content ;
							if ($menu_object) {
								$menu = wp_get_nav_menu_object( $menu_object );
								$menu_items = wp_get_nav_menu_items($menu->term_id);
								echo '<ul id="menu-404">';
								foreach ( (array) $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									echo '<li><a href="' . $url . '">' . $title . '</a></li>';
								}
								echo '</ul>';
							}
							if ( $btn_text ) echo '<a href="'. esc_url( $btn_url ) .'" class="btn btn-one">' . esc_attr( $btn_text ) . '</a>';
						?>
					</div>
				</div>
			</div><!-- .row -->
		</section><!-- .error-404 -->

		<?php bookme_after_page(); ?>
	
	<?php get_template_part('template-parts/section/footer', 'quote'); ?>

<?php get_footer(); ?>
