<?php 
/*
 * Theme Widget
 *
 */

// Contact Info
class BookmeContactInfo extends WP_Widget {

	function __construct() {
		parent::__construct(
			'bookme_contact_info',
			__( 'Bookme : Contact Info', 'bookme' ),
			array( 'classname' => 'widget_contact', 'description' => __( 'Display Contact Info.', 'bookme' ), )
		);
	}

	function widget( $args, $instance ) {

		extract ( $args );
		$title = apply_filters ( 'title', isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '' );
		$map_lat = apply_filters ( 'map_lat', isset ( $instance ['map_lat'] ) ? esc_attr ( $instance ['map_lat'] ) : '' );
		$map_lng = apply_filters ( 'map_lng', isset ( $instance ['map_lng'] ) ? esc_attr ( $instance ['map_lng'] ) : '' );
		$map_zoom = apply_filters ( 'map_zoom', isset ( $instance ['map_zoom'] ) ? $instance ['map_zoom'] : '15' );
		$cp_name = apply_filters ( 'cp_name', isset ( $instance ['cp_name'] ) ? esc_attr ( $instance ['cp_name'] ) : '' );
		$cp_address = apply_filters ( 'cp_address', isset ( $instance ['cp_address'] ) ? esc_attr ( $instance ['cp_address'] ) : '' );
		$cp_phone = apply_filters ( 'cp_phone', isset ( $instance ['cp_phone'] ) ? esc_attr ( $instance ['cp_phone'] ) : '' );

		echo $before_widget;

		if (! empty ( $title ))
			echo $before_title . $title . $after_title; ?>

			<div class="widget_address">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-4">
						<?php if ( $map_lat && $map_lng ) : ?>
							<div class="map">
								<div id="googleMap" style="width:130px;height:135px;"></div>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-9 col-md-8">
						<div class="contact-info">
							<?php if ( $cp_name ) : ?>
								<div class="contact-info-title">
									<?php echo esc_attr( $cp_name ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $cp_address ) : ?>
								<div class="contact-info-address">
				        			<?php echo esc_attr( $cp_address ); ?>
				        		</div>
				        	<?php endif; ?>
				        	<?php if ( $cp_phone ) : ?>
								<div class="contact-info-phone">
									<strong><?php echo esc_html__('Call Me: ', 'bookme'); ?></strong>
									<span class="contact-info-number"><strong><?php echo esc_attr( $cp_phone ); ?></strong></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<script>
				var Lat = '<?php echo $map_lat; ?>';
				var Lng = '<?php echo $map_lng; ?>';
				var map_zoom = <?php echo $map_zoom; ?>;
				var myCenter=new google.maps.LatLng(Lat,Lng);

				function initialize() {
					var mapProp = {
						center: myCenter,
						zoom: map_zoom,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
  
					var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
					var marker = new google.maps.Marker({
						position: myCenter,
					});
  
					marker.setMap(map);
				}

				google.maps.event.addDomListener(window, 'load', initialize);
			</script>

		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$title = isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '';
		$map_lat = isset ( $instance ['map_lat'] ) ? esc_attr ( $instance ['map_lat'] ) : '';
		$map_lng = isset ( $instance ['map_lng'] ) ? esc_attr ( $instance ['map_lng'] ) : '';
		$map_zoom = isset ( $instance ['map_zoom'] ) ? $instance ['map_zoom'] : '15';
		$cp_name = isset ( $instance ['cp_name'] ) ? esc_attr ( $instance ['cp_name'] ) : '';
		$cp_address = isset ( $instance ['cp_address'] ) ? esc_attr ( $instance ['cp_address'] ) : '';
		$cp_phone = isset ( $instance ['cp_phone'] ) ? esc_attr ( $instance ['cp_phone'] ) : ''; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_lat'); ?>"><?php _e('Map Latitude:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('map_lat'); ?>" name="<?php echo $this->get_field_name('map_lat'); ?>" type="text" value="<?php echo esc_attr($map_lat); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_lng'); ?>"><?php _e('Map Longitude:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('map_lng'); ?>" name="<?php echo $this->get_field_name('map_lng'); ?>" type="text" value="<?php echo esc_attr($map_lng); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_zoom'); ?>"><?php _e('Map Zoom:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('map_zoom'); ?>" name="<?php echo $this->get_field_name('map_zoom'); ?>" type="number" value="<?php echo $map_zoom; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cp_name'); ?>"><?php _e('Name:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('cp_name'); ?>" name="<?php echo $this->get_field_name('cp_name'); ?>" type="text" value="<?php echo esc_attr($cp_name); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cp_address'); ?>"><?php _e('Address:', 'bookme'); ?> 
				<textarea class="widefat" id="<?php echo $this->get_field_id('cp_address'); ?>" name="<?php echo $this->get_field_name('cp_address'); ?>"><?php echo esc_attr($cp_address); ?></textarea>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cp_phone'); ?>"><?php _e('Phone:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('cp_phone'); ?>" name="<?php echo $this->get_field_name('cp_phone'); ?>" type="text" value="<?php echo esc_attr($cp_phone); ?>" />
			</label>
		</p><?php 
	}

}

function bookme_contact_info_widgets() {
	register_widget( 'BookmeContactInfo' );
}
add_action( 'widgets_init', 'bookme_contact_info_widgets' );


// Recent Posts 
class BookmeRecentPosts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'bookme_recent_posts',
			__( 'Bookme : Recent Posts', 'bookme' ),
			array( 'classname' => 'widget_recent', 'description' => __( 'Display Recent Posts.', 'bookme' ), )
		);
	}
	
	function widget( $args, $instance ) {
		extract ( $args );
		$title = apply_filters ( 'title', isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '' );
		$show_posts = apply_filters ( 'show_posts', isset ( $instance ['show_posts'] ) ? $instance ['show_posts'] : '2' );
		
		echo $before_widget;

		if (! empty ( $title ))
			echo $before_title . $title . $after_title;
			
		$posts_arg = array(
			'post_type' => 'post',
			'posts_per_page' => $show_posts,
			'ignore_sticky' => true,
		);
		$posts = new WP_Query( $posts_arg );
		if ( $posts->have_posts() ) :
			echo '<div class="bookme-recent">';
			
			while ( $posts->have_posts() ) : $posts->the_post(); ?>
							
				<div class="bookme-recent-item">
					<div class="row">
						<div class="col-md-5 col-sm-5">
							<div class="recent-item-img">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('bookme_news_thumbnail');
									} else {
										echo '<img src="http://placehold.it/360x236">';
									}
								?>
							</div>
						</div>
						<div class="col-md-7 col-sm-7">
							<div class="bookme-recent-entry row">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p class="date"><?php echo the_time('M d, Y'); ?></p>
							</div>
						</div>
					</div>
				</div><?php 
			
			endwhile;
				
			echo '</div>';
			echo '<style type="text/css">.bookme-recent-item { margin-bottom: 30px; } .bookme-recent-item h4 { margin-top: 0; } .bookme-recent-item h4 a { color: #333; font-size: 14px; font-family: "Montserratbold"; text-transform: uppercase; } .bookme-recent-item .date { font-family: "loraregular"; font-size: 12px; color: #333; } </style>';
		endif; wp_reset_postdata(); 
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$title = isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '';
		$show_posts = isset ( $instance ['show_posts'] ) ? esc_attr ( $instance ['show_posts'] ) : '2'; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_posts'); ?>"><?php _e('Posts to show:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>" type="number" value="<?php echo $show_posts; ?>" />
			</label>
		</p><?php 
	}
	
}

function bookme_recent_posts_widgets() {
	register_widget( 'BookmeRecentPosts' );
}
add_action( 'widgets_init', 'bookme_recent_posts_widgets' );


// Related Posts 
class BookmeRelatedPosts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'bookme_related_posts',
			__( 'Bookme : Related Posts', 'bookme' ),
			array( 'classname' => 'widget_related', 'description' => __( 'Display Related Posts.', 'bookme' ), )
		);
	}
	
	function widget( $args, $instance ) {
		extract ( $args );
		$title = apply_filters ( 'title', isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '' );
		$post_type = apply_filters ( 'post_type', isset ( $instance ['post_type'] ) ? esc_attr ( $instance ['post_type'] ) : '' );
		$show_posts = apply_filters ( 'show_posts', isset ( $instance ['show_posts'] ) ? $instance ['show_posts'] : '2' );
		
		if ( is_single() ) :
			echo $before_widget;

			if (! empty ( $title ))
				echo $before_title . $title . $after_title;
			
			$taxnomy = '';
			if ( $post_type == 'post' ) $taxnomy = 'category';
			if ( $post_type == 'bookme_service' ) $taxnomy = 'service_category';
			
			$terms = get_the_terms( get_the_ID(), $taxnomy );
			if ( $terms ) {
				$term_ids = array();
				foreach($terms as $individual_term) $term_ids[] = $individual_term->term_id;
				$related_args = array(
					'post_type' => $post_type,
					'posts_per_page' => $show_posts,
					'ignore_sticky' => true,
					'tax_query' => array(
						array(
							'taxonomy' => $taxnomy,
							'field'    => 'term_id',
							'terms'    => $term_ids,
						),
					),
				); 
				$related = new WP_Query( $related_args );
				if ( $related->have_posts() ) :
					echo '<div class="bookme-related"><ul>';
				
					while ( $related->have_posts() ) : $related->the_post(); 
						echo '<li><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></li>';
					endwhile;
				
					echo '</ul></div>';
				endif; wp_reset_postdata(); 
			} 
		
			echo $after_widget;
		endif;
	}
	
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$title = isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '';
		$post_type = isset ( $instance ['post_type'] ) ? esc_attr ( $instance ['post_type'] ) : '';
		$show_posts = isset ( $instance ['show_posts'] ) ? esc_attr ( $instance ['show_posts'] ) : '2'; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:', 'bookme'); ?> 
			<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" >
				<option value="post"><?php echo esc_html__('Post', 'bookme'); ?></option>
				<option value="bookme_service"><?php echo esc_html__('Service', 'bookme'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_posts'); ?>"><?php _e('Posts to show:', 'bookme'); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>" type="number" value="<?php echo $show_posts; ?>" />
			</label>
		</p><?php 
	}
	
}
function bookme_related_posts_widgets() {
	register_widget( 'BookmeRelatedPosts' );
}
add_action( 'widgets_init', 'bookme_related_posts_widgets' );
