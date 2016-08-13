<?php
/**
 * BookMe Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package BookMe Theme
 */
if ( ! function_exists( 'bookme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bookme_setup() {
	/*
	 * Add Redux Framework
	 */
	require get_template_directory() . '/admin/admin-init.php';
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BookMe Theme, use a find and replace
	 * to change 'bookme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bookme', get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'bookme_slide', 1970, 770, true );
	add_image_size( 'bookme_thumbnail', 239, 240, true );
	add_image_size( 'bookme_news_thumbnail', 360, 236, true );
	add_image_size( 'bookme_att_news_big_thumbnail', 555, 363, true );
	add_image_size( 'bookme_att_news_small_thumbnail', 165, 108, true );
	add_image_size( 'bookme_therapy_about', 457, 299, true );
	add_image_size( 'bookme_testimonial_thumbnail', 67, 66, true );
	add_image_size( 'bookme_team_thumbnail', 262, 290, true );
	add_image_size( 'bookme_related_thumbnail', 360, 162, true );
	add_image_size( 'bookme_gallery_slider', 750, 330, true );
	add_image_size( 'bookme_gallery_thumb', 360, 290, true );
	add_image_size( 'bookme_project_thumb', 360, 270, true );
	add_image_size( 'bookme_barber_testi_small_thumb', 179, 233, true );
	add_image_size( 'bookme_barber_testi_thumb', 362, 362, true );
	add_image_size( 'bookme_barber_gallery_thumb', 263, 170, true );
	add_image_size( 'bookme_project_slide', 986, 730, true );
	add_image_size( 'bookme_trainer_testi', 950, 420, true );
	add_image_size( 'bookme_arc_testi', 100, 102, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'bookme' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video',
		'quote',
		'link',
	) );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bookme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // bookme_setup
add_action( 'after_setup_theme', 'bookme_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bookme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bookme_content_width', 640 );
}
add_action( 'after_setup_theme', 'bookme_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bookme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bookme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="content-post"><div class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="title"><h4>',
		'after_title'   => '</h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'bookme' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="footer-widget1 widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'bookme' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="footer-widget2 widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'bookme' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="footer-widget3 widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'bookme' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="footer-widget4 widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bookme_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function bookme_scripts() {
	global $bookme_option;
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/assets/bootstrap/css/bootstrap.min.css', array(), null );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/assets/fonts/font-awesome/css/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'linearicons', get_template_directory_uri() . '/inc/assets/fonts/linearicons/style.css', array(), null );
	wp_enqueue_style( 'montserrat', get_template_directory_uri() . '/inc/assets/fonts/montserrat/stylesheet.css', array(), null );
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/inc/assets/owl-carousel/owl.carousel.css', array(), null );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/inc/assets/owl-carousel/owl.theme.css', array(), null );
	wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/inc/assets/owl-carousel/owl.transitions.css', array(), null );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/inc/assets/wow/animate.css', array(), null );
	wp_enqueue_style( 'selectBox', get_template_directory_uri() . '/inc/assets/selectBox/jquery.selectBox.css', array(), null );
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/inc/assets/meanmenu/meanmenu.css', array(), null );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/inc/assets/prettyPhoto/css/prettyPhoto.css', array(), null );
	wp_enqueue_style( 'bookme-style', get_stylesheet_uri() );
	wp_enqueue_script('gmap', '//maps.googleapis.com/maps/api/js', array('jquery'), true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/assets/bootstrap/js/bootstrap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/inc/assets/meanmenu/jquery.meanmenu.js', array('jquery'), null, true );
	$retina_ready = $bookme_option['retina_image'];
	if($retina_ready == 1) {
		wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array('jquery'), null, true );
	}
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/inc/assets/owl-carousel/owl.carousel.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/inc/assets/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), null, true );
	wp_enqueue_script( 'prettyPhoto-init', get_template_directory_uri() . '/js/prettyPhoto-init.js', array('jquery'), null, true );
	wp_enqueue_script( 'bookme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );
	wp_enqueue_script( 'bookme-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'isotop', get_template_directory_uri() . '/inc/assets/isotope/jquery.isotope.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'isotop-init', get_template_directory_uri() . '/inc/assets/isotope/isotope-init.js', array('jquery'), null, true );
	wp_enqueue_script( 'selectBox', get_template_directory_uri() . '/inc/assets/selectBox/jquery.selectBox.js', array('jquery'), null, true );
	wp_enqueue_script( 'countTo', get_template_directory_uri() . '/inc/assets/count/jquery-countTo.js', array('jquery'), null, true );
	wp_enqueue_script( 'countTo-appear', get_template_directory_uri() . '/inc/assets/count/jquery.appear.js', array('jquery'), null, true );
	$wow_effect = $bookme_option['wow_effect'];
	if($wow_effect == 1) {
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/inc/assets/wow/wow.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'wow-init', get_template_directory_uri() . '/inc/assets/wow/wow-init.js', null, null, true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'right_height', get_template_directory_uri() . '/js/right-height.min.js', null, null, true );
}
	wp_enqueue_script( 'bookme', get_template_directory_uri() . '/js/bookme.js', null, null, true );
}
add_action( 'wp_enqueue_scripts', 'bookme_scripts' );

function bookme_wp_admin_script() {
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/assets/fonts/font-awesome/css/font-awesome.min.css', array(), null );
		wp_enqueue_style( 'select2', get_template_directory_uri() . '/inc/assets/select2/css/select2.min.css', array(), null );
        wp_register_style( 'bookme_wp_admin_css', get_template_directory_uri() . '/admin/css/bookme-admin.css', false, '1.0.0' );
        wp_enqueue_style( 'bookme_wp_admin_css' );
        wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), true);
        wp_enqueue_script( 'select2', get_template_directory_uri() . '/inc/assets/select2/js/select2.min.js', array('jquery'), null, true );
		wp_register_script( 'bookme_wp_admin_js', get_template_directory_uri() . '/admin/js/bookme-admin.js', true, '1.0.0' );
        wp_enqueue_script( 'bookme_wp_admin_js' );
}
add_action( 'admin_enqueue_scripts', 'bookme_wp_admin_script' );

/** limit excerpt */
function bookme_get_excerpt($count){
	global $post;
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = $excerpt.' <br/><a href="'.$permalink.'" class="more-link btn btn-two excerpt">read more</a>';
	return $excerpt;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Hook functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/theme-hook.php';
require get_template_directory() . '/inc/theme-widgets.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
