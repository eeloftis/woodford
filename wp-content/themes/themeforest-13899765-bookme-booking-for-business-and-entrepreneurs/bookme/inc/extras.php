<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BookMe Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bookme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'bookme_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function bookme_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'bookme' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'bookme_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function bookme_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'bookme_render_title' );
endif;

function bookme_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	if($attachment) {
        return $attachment[0]; 
    }
}


/*
 * Retina Ready
 */
 
global $bookme_option;
$retina_ready = $bookme_option['retina_image'];
if($retina_ready == 1) {
	add_filter( 'wp_generate_attachment_metadata', 'bookme_retina_support_attachment_meta', 10, 2 );
	add_filter( 'delete_attachment', 'bookme_delete_retina_support_images' );
}

/**
 * Retina images
 */
function bookme_retina_support_attachment_meta( $metadata, $attachment_id ) {
    foreach ( $metadata as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $image => $attr ) {
                if ( is_array( $attr ) )
                    bookme_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
            }
        }
    }
 
    return $metadata;
}

/**
 * Create retina-ready images
 */
function bookme_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}


/**
 * Delete retina-ready images
 */
function bookme_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
    $path = pathinfo( $meta['file'] );
    if($meta) {
    	foreach ( $meta as $key => $value ) {
        	if ( 'sizes' === $key ) {
            	foreach ( $value as $sizes => $size ) {
                	$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                	$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
                	if ( file_exists( $retina_filename ) )
                    	unlink( $retina_filename );
            	}
        	}
    	}
    }
}


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'bookme_register_required_plugins' );

function bookme_register_required_plugins() {

	$plugins = array(
	
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		
		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),
		
		array(
 			'name'               => 'Bookme Post-type and Taxonomy', 
 			'slug'               => 'bookme-posttype-taxonomy',
 			'source'             => get_template_directory() . '/inc/plugins/bookme-posttype-taxonomy.zip', 
 			'required'           => true, 
 			'version'            => '', 
 			'force_activation'   => false, 
 			'force_deactivation' => false, 
 			'external_url'       => '', 
 			'is_callable'        => '', 
 		),
 		
 		array(
 			'name'               => 'Bookme Shortcodes', 
 			'slug'               => 'bookme-shortcodes',
 			'source'             => get_template_directory() . '/inc/plugins/bookme-shortcodes.zip', 
 			'required'           => true, 
 			'version'            => '', 
 			'force_activation'   => false, 
 			'force_deactivation' => false, 
 			'external_url'       => '', 
 			'is_callable'        => '', 
 		),
		
		array(
 			'name'               => 'Booked Appointment', 
 			'slug'               => 'booked',
 			'source'             => get_template_directory() . '/inc/plugins/booked-appointment.zip', 
 			'required'           => false, 
 			'version'            => '', 
 			'force_activation'   => false, 
 			'force_deactivation' => false, 
 			'external_url'       => '', 
 			'is_callable'        => '', 
 		),
 		
 		array(
 			'name'               => 'Revolution Slider', 
 			'slug'               => 'revslider',
 			'source'             => get_template_directory() . '/inc/plugins/slider-revolution.zip', 
 			'required'           => false, 
 			'version'            => '', 
 			'force_activation'   => false, 
 			'force_deactivation' => false, 
 			'external_url'       => '', 
 			'is_callable'        => '', 
 		),

		array(
			'name'      => 'WP User Avatar',
			'slug'      => 'wp-user-avatar',
			'required'  => false,
		),
		array(
			'name'      => 'Easy Custom Sidebars',
			'slug'      => 'easy-custom-sidebars',
			'required'  => false,
		),
		array(
			'name'      => 'WP Retina 2x',
			'slug'      => 'wp-retina-2x',
			'required'  => false,
		),
		array(
			'name'      => 'Yoast SEO',
			'slug'      => 'wordpress-seo',
			'required'  => false,
		),
		array(
			'name'      => 'Google Analytics by Yoast',
			'slug'      => 'google-analytics-for-wordpress',
			'required'  => false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',    
		'has_notices'  => true,                    
		'dismissable'  => true,                    
		'dismiss_msg'  => '',                      
		'is_automatic' => false,                   
		'message'      => '',                      

		
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'bookme' ),
			'menu_title'                      => __( 'Install Plugins', 'bookme' ),
			'installing'                      => __( 'Installing Plugin: %s', 'bookme' ), 
			'oops'                            => __( 'Something went wrong with the plugin API.', 'bookme' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'bookme'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'bookme'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'bookme'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'bookme'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'bookme'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'bookme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'bookme' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'bookme' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'bookme' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'bookme' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'bookme' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
		
	);

	tgmpa( $plugins, $config );
}


// Breadcrumbs
function bookme_breadcrumbs(){
  /* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['tax'] 	  = 'Archive for "%s"'; // text for a taxonomy page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' &raquo; '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$homeLink = home_url();
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) echo '<div id="crumbs" class="breadcrumb"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
	} else {
		echo '<div id="crumbs" class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
		
		}elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo esc_html__('Page', 'bookme') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div>';
	}
} // end bookme_breadcrumbs()

// Pagination
if ( !function_exists( 'bookme_pagination' ) ) {

	function bookme_pagination( $args = array(), $query = '' ) {

		global $wp_rewrite, $wp_query;
		do_action( 'bookme_pagination_start' );

		if ( $query ) {
			$wp_query = $query;
		} // End IF Statement

		/* If there's not more than one page, return nothing. */
		if ( 1 >= $wp_query->max_num_pages ) {

			return;
		}

		/* Get the current page. */
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages );

		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => esc_url( add_query_arg( 'paged', '%#%' ) ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '<span class="lnr lnr-arrow-left"></span>', 'bookme' ), // Translate in WordPress. This is the default.
			'next_text' => __( '<span class="lnr lnr-arrow-right"></span>', 'bookme' ), // Translate in WordPress. This is the default.
			'show_all' => false,
			'end_size' => 2,
			'mid_size' => 2,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination bookme-pagination">', // Begin bookme_pagination() arguments.
			'after' => '</div>',
			'echo' => true,
			'use_search_permastruct' => true,
            'index' => false

		);

		/* Allow themes/plugins to filter the default arguments. */
		$defaults = apply_filters( 'bookme_pagination_args_defaults', $defaults );

		/* Add the $base argument to the array if the user is using permalinks. */
		if( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

		/* If we're on a search results page, we need to change this up a bit. */
		if ( is_search() ) {

		/* If we're in BuddyPress, or the user has selected to do so, use the default "unpretty" URL structure. */
			if ( class_exists( 'BP_Core_User' ) || $defaults['use_search_permastruct'] ) {
				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );
				$base = user_trailingslashit( home_url() ) . '?s=' . urlencode( $search_query ) . '&paged=%#%';
				$defaults['base'] = $base;

			} else {

				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( urldecode( get_search_link() ) ) . 'page/%#%' );
			}

		}


		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args, $defaults );

		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters( 'bookme_pagination_args', $args );

		/* Don't allow the user to set this to an array. */
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';

		/* Make sure raw querystrings are displayed at the end of the URL, if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';

		preg_match( $pattern, $args['base'], $raw_querystring );
		if( $wp_rewrite->using_permalinks() && $raw_querystring ) {
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
			$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
			$args['base'] .= substr( $raw_querystring[0], 0, -1 );
		}

		/* Get the paginated links. */
		$page_links = paginate_links( $args );

		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

                if($args['index']) {
                    $args['before'] = $args['before'] . '<span class="pages">Page '.$args['current'].' of '.$args['total'].'</span>';
				}

		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];

		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters( 'bookme_pagination', $page_links );

		do_action( 'bookme_pagination_end' );

		/* Return the paginated links for use in themes. */
		if ( $args['echo'] ) {
			echo $page_links;
		}

		else {

			return $page_links;
		}

	} // End bookme_pagination()

} // End IF Statement


add_filter( 'get_user_option_meta-box-order_page', 'bookme_metabox_order' );
function bookme_metabox_order( $order ) {
	if (is_page_template('template-accounting.php')) {
	    return array(
	        'normal' => join( 
	            ",", 
	            array(       // vvv  Arrange here as you desire
	            	'_BookmeMB_page_opt',
	                '_BookmeMB_header_opt',
	                '_BookmeMB_slider_metabox',
	                '_BookmeMB_about_metabox',
	                '_BookmeMB_services_metabox',
	                '_BookmeMB_news_metabox',
	                '_BookmeMB_facts_metabox',
	                '_BookmeMB_about_details_metabox',
	                '_BookmeMB_clients_metabox',
	                '_BookmeMB_paralax_metabox',
	                '_BookmeMB_testimonial_metabox',
	            )
	        ),
	    );
	}
	if (is_page_template('template-therapy.php')) {
	    return array(
	        'normal' => join( 
	            ",", 
	            array(       // vvv  Arrange here as you desire
	            	'_BookmeMB_page_opt',
	                '_BookmeMB_header_opt',
	                '_BookmeMB_slider_metabox',
	                '_BookmeMB_therapy_about_metabox',
	                '_BookmeMB_services_metabox',
	                '_BookmeMB_about_details_metabox',
	                '_BookmeMB_facts_metabox',
	                '_BookmeMB_news_metabox',
	                '_BookmeMB_therapy_testimonial_metabox',
	                '_BookmeMB_clients_metabox',
	                '_BookmeMB_paralax_metabox',
	                
	            )
	        ),
	    );
	}
}

function bookme_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
    global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = do_shortcode( $content );
    $content = wpautop( $content );

    return $content;
}

function bookme_get_the_ip() {
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    else {
        return $_SERVER["REMOTE_ADDR"];
    }
}

function bookme_service_query() {

	$service_args = array(
		'post_type' => 'bookme_service',
		'posts_per_page' => -1,
	);
	$service = new WP_Query( $service_args );
	$option = array();
	while ( $service->have_posts() ) : $service->the_post();
		$option[] = '<option value="'.get_the_title().'">' . get_the_title() . '</option>';
	endwhile;
	wp_reset_postdata(); 
	return implode('', $option ); 
}


if ( ! function_exists( 'bookme_redux_disable_dev_mode_plugin' ) ) {
	function bookme_redux_disable_dev_mode_plugin( $redux ) {
		if ( $redux->args['opt_name'] != 'redux_demo' ) {
			$redux->args['dev_mode'] = false;
			$redux->args['forced_dev_mode_off'] = false;
		}
	}
	add_action( 'redux/construct', 'bookme_redux_disable_dev_mode_plugin' );
}

