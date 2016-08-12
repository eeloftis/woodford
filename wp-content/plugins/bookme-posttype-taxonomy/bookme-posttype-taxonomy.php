<?PHP
/*
 * Plugin Name: 	Bookme Post-type and Taxonomy
 * Plugin URI: 		http://puriwp.com/
 * Description: 	Post-type and Taxonomy for Bookme Theme.
 * Version: 		1.0.0
 * Author: 			PuriWP
 * Author URI: 		http://puriwp.com/
 * Text Domain: 	bookme-post-type-taxonomy

 * Copyright Ega Erlangga
 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bookme_Posttype_Taxonomy {

	/**
	 * Version.
	 *
	 * @var string $version Plugin version number.
	 */
	public $version = '1.0.0';


	/**
	 * Instance of Bookme_Posttype_Taxonomy.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var object $instance The instance of BPT.
	 */
	private static $instance;
	
	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		if ( ! function_exists( 'is_plugin_active_for_network' ) )
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

		$this->init();

	}
	
	/**
	 * Instance.
	 *
	 * An global instance of the class. Used to retrieve the instance
	 * to use on other files/plugins/themes.
	 *
	 * @since 1.1.0
	 *
	 * @return object Instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;

	}


	/**
	 * Init.
	 *
	 * Initialize plugin parts.
	 *
	 * @since 1.1.0
	 */
	public function init() {

		// Load textdomain
		$this->load_textdomain();

		/**
		 * Require file with settings.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-bpt-post-type.php';
		//$this->post_type = new BPT_post_type();

		/**
		 * Require file taxonomy.
		 */
		require_once plugin_dir_path( __FILE__ ) . '/includes/class-bpt-taxonomy.php';
		//$this->taxonomy = new BPT_Taxonomy();

	}
	
	/**
	 * Textdomain.
	 *
	 * Load the textdomain based on WP language.
	 *
	 * @since 1.1.0
	 */
	public function load_textdomain() {

		// Load textdomain
		load_plugin_textdomain( 'bookme-post-type-taxonomy', false, basename( dirname( __FILE__ ) ) . '/languages' );

	}

}

if ( ! function_exists( 'BPT' ) ) :

 	function BPT() {
		return Bookme_Posttype_Taxonomy::instance();
	}

endif;

BPT();