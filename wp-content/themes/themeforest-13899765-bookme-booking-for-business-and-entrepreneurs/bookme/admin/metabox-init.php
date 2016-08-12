<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/admin/metabox/init.php' ) ) {
	require_once get_template_directory() . '/admin/metabox/init.php';
} 

/**
 * CMB2 RGBA Color
 */
class JW_Fancy_Color {
	const VERSION = '0.2.0';
	public function hooks() {
		add_action( 'cmb2_render_rgba_colorpicker', array( $this, 'render_color_picker' ), 10, 5 );
		add_action( 'admin_enqueue_scripts', array( $this, 'setup_admin_scripts' ) );
	}
	public function render_color_picker( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		echo $field_type_object->input( array(
			'class'              => 'cmb2-colorpicker color-picker',
			'data-default-color' => $field->args( 'default' ),
			'data-alpha'         => 'true',
		) );
	}
	public function setup_admin_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'jw-cmb2-rgba-picker-js', get_template_directory_uri() . '/js/jw-cmb2-rgba-picker.js', array( 'wp-color-picker' ), null, true );
	}
}
$jw_fancy_color = new JW_Fancy_Color();
$jw_fancy_color->hooks();

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}


/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

function bookme_get_term_options( $taxonomy = 'team_category', $args = array() ) {
    if(class_exists('Bookme_Posttype_Taxonomy')) {
        $args['taxonomy'] = $taxonomy;
        // $defaults = array( 'taxonomy' => 'category' );
        $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

        $taxonomy = $args['taxonomy'];

        $terms = (array) get_terms( $taxonomy, $args );

        // Initate an empty array
        $term_options = array();
        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $term_options[ $term->term_id ] = $term->name;
            }
        }

        return $term_options;
    }
}

function bookme_metabox_show_on_template( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
        return $display;
    }

    if ( 'template' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }

    $template_name = get_page_template_slug( $post_id );
    $template_name = ! empty( $template_name ) ? substr( $template_name, 0, -4 ) : '';

    // See if there's a match
    return in_array( $template_name, (array) $meta_box['show_on']['value'] );
}
add_filter( 'cmb2_show_on', 'bookme_metabox_show_on_template', 10, 2 );


function bookme_metabox_exclude_on_template( $display, $meta_box ) {

	if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
    	return $display;
    } 

	if( 'exclude_template' !== $meta_box['show_on']['key'] )
    	return $display;

	$post_id = 0;
    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }
    if ( ! $post_id ) {
        return false;
    }

  	$template_name = get_page_template_slug( $post_id );
  	$template_name = ! empty( $template_name ) ? substr( $template_name, 0, -4 ) : '';

  	// If value isn't an array, turn it into one
  	$meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];

  	// See if there's a match
  	if( in_array( $template_name, $meta_box['show_on']['value'] ) ) {
    	return false;
  	} else {
    	return true;
  	}
}
add_filter( 'cmb2_show_on', 'bookme_metabox_exclude_on_template', 20, 2 );

function bookme_show_on_meta_value( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['meta_key'] ) ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    $value = get_post_meta( $post_id, $meta_box['show_on']['meta_key'], true );

    if ( empty( $meta_box['show_on']['meta_value'] ) ) {
        return (bool) $value;
    }

    return $value == $meta_box['show_on']['meta_value'];
}
add_filter( 'cmb2_show_on', 'bookme_show_on_meta_value', 10, 2 );


function bookme_show_on_post_format( $display, $post_format ) {
    if ( ! isset( $post_format['show_on']['key'] ) ) {
        return $display;
    }
    $post_id = 0;
    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }
    if ( ! $post_id ) {
        return $display;
    }
    $value  = get_post_format($post_id);
 
    if ( empty( $post_format['show_on']['key'] ) ) {
        return (bool) $value;
    }
    return $value == $post_format['show_on']['value'];
}
add_filter( 'cmb2_show_on', 'bookme_show_on_post_format', 10, 2 );



if(class_exists('Bookme_Posttype_Taxonomy')) {
    add_action( 'cmb2_init', 'bookme_clients_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_testimonials_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_team_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_projects_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_portfolio_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_service_posttype_opt_metabox' );
    add_action( 'cmb2_init', 'bookme_pricing_posttype_opt_metabox' );
}

function bookme_clients_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_clients_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'clients_posttype',
		'title'         => __( 'Client Details', 'cmb2' ),
		'object_types'  => array( 'bookme_client', ), // Post type
		'priority'   => 'high',
	) );

	$bookme_clients_posttype->add_field( array(
		'name'       => __( 'URL', 'cmb2' ),
		'id'         => $prefix . 'clients_url_detil',
		'type'       => 'text_url',
	) );

}



function bookme_testimonials_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_testimonials_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'testimonials_posttype',
		'title'         => __( 'Testimonials Details', 'cmb2' ),
		'object_types'  => array( 'bookme_testimonial', ), // Post type
		'priority'   => 'high',
	) );

	$bookme_testimonials_posttype->add_field( array(
		'name'       => __( 'Position', 'cmb2' ),
		'id'         => $prefix . 'clients_position',
		'type'       => 'text_medium',
	) );

}



function bookme_team_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_team_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'team_posttype',
		'title'         => __( 'Team Details', 'cmb2' ),
		'object_types'  => array( 'bookme_team', ), // Post type
		'priority'   => 'high',
	) );

	$bookme_team_posttype->add_field( array(
		'name'       => __( 'Email', 'cmb2' ),
		'id'         => $prefix . 'team_email',
		'type'       => 'text_email',
	) );

}



function bookme_projects_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_testimonials_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'projects_posttype',
		'title'         => __( 'Projects Details', 'cmb2' ),
		'object_types'  => array( 'bookme_project', ), // Post type
		'priority'   => 'high',
	) );
	
	$bookme_testimonials_posttype->add_field( array(
		'name' => __( 'Projects Image', 'cmb2' ),
		'id'   => $prefix . 'project_image',
		'type' => 'file',
	) );

}



function bookme_portfolio_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_portfolio_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'portfolio_posttype',
		'title'         => __( 'Portfolio Details', 'cmb2' ),
		'object_types'  => array( 'bookme_portfolio', ), // Post type
		'priority'   => 'high',
	) );
	
	$bookme_portfolio_posttype->add_field( array(
		'name' => __( 'Short Description', 'cmb2' ),
		'id'   => $prefix . 'portfolio_shortdesc',
		'type' => 'textarea_small',
	) );
	
}



function bookme_service_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_service_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'service_posttype',
		'title'         => __( 'Service Details', 'cmb2' ),
		'object_types'  => array( 'bookme_service', ), // Post type
		'priority'   => 'high',
	) );
	
	$bookme_service_posttype->add_field( array(
		'name' => __( 'Service Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => $prefix . 'service_post_icon',
		'type' => 'text_small',
	) );
	
	$bookme_service_posttype->add_field( array(
		'name' => __( 'Service Icon', 'cmb2' ),
		'description' => __( 'Upload Image as icon . This will replace the icon above', 'cmb2' ),
		'id'   => $prefix . 'service_post_icon_img',
		'type' => 'file',
	) );
	
}


function bookme_pricing_posttype_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_pricing_posttype = new_cmb2_box( array(
		'id'            => $prefix . 'pricing_posttype',
		'title'         => __( 'Pricing Details', 'cmb2' ),
		'object_types'  => array( 'bookme_pricing', ), // Post type
		'priority'   => 'high',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name'    => __( 'Box Background Color', 'cmb2' ),
		'id'      => $prefix . 'pricing_box_bg_color',
		'description' => __('For pricing page only', 'cmb2'),
		'type'    => 'colorpicker',
		'default' => '#9C8147',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name'    => __( 'Box Header Background Color', 'cmb2' ),
		'id'      => $prefix . 'pricing_header_bg_color',
		'description' => __('For pricing page only', 'cmb2'),
		'type'    => 'colorpicker',
		'default' => '#876D35',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name'    => __( 'Pricing Value Background Color', 'cmb2' ),
		'id'      => $prefix . 'pricing_value_bg_color',
		'description' => __('For pricing page only', 'cmb2'),
		'type'    => 'colorpicker',
		'default' => '#735C29', 
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name' => __( 'Description', 'cmb2' ),
		'id'   => $prefix . 'pricing_desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name' => __( 'Price', 'cmb2' ),
		'id'   => $prefix . 'pricing_price',
		'type' => 'text_money',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name' => __( 'Feature', 'cmb2' ),
		'id'   => $prefix . 'pricing_feature',
		'description' => __('For pricing page only', 'cmb2'),
		'type' => 'text',
		'repeatable' => true,
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name' => __( 'Button Text', 'cmb2' ),
		'id'   => $prefix . 'pricing_btn_text',
		'type' => 'text',
	) );
	
	$bookme_pricing_posttype->add_field( array(
		'name' => __( 'Button URL', 'cmb2' ),
		'id'   => $prefix . 'pricing_btn_url',
		'type' => 'text_url',
	) );
	
}
	

add_action( 'cmb2_init', 'bookme_page_opt_metabox' );
function bookme_page_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_page_opt = new_cmb2_box( array(
		'id'            => $prefix . 'page_opt',
		'title'         => __( 'Page Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-accounting3.php', 'template-architect.php', 'template-attorney.php', 'template-trainer.php', 'template-corporate-trainer.php', 'template-therapy.php', 'template-corporate-trainer.php', 'template-about.php', 'template-architect.php', 'template-barber.php', 'template-services.php') ),
	) );

	$bookme_page_opt->add_field( array(
		'name' => __( 'Page Color Scheme', 'cmb2' ),
		'id'   => $prefix . 'page_color_scheme',
		'type' => 'colorpicker',
	) );

}

add_action( 'cmb2_init', 'bookme_general_page_opt_metabox' );
function bookme_general_page_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_general_page_opt = new_cmb2_box( array(
		'id'            => $prefix . 'general_page_opt',
		'title'         => __( 'Page Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'       => array( 'key' => 'exclude_template', 'value' => array( 'template-accounting', 'template-accounting2', 'template-accounting3', 'template-therapy', 'template-attorney', 'template-trainer', 'template-corporate-trainer', 'template-barber', 'template-architect', 'template-mover', 'template-about', 'template-services' )),
	) );

	$bookme_general_page_opt->add_field( array(
		'name' => __( 'Page Color Scheme', 'cmb2' ),
		'id'   => $prefix . 'general_page_color_scheme',
		'type' => 'colorpicker',
	) );
	
	$bookme_general_page_opt->add_field( array(
		'name' => __( 'Page Title Image Background', 'cmb2' ),
		'description' => __( 'Upload Image as background.', 'cmb2' ),
		'id'   => $prefix . 'page_title_img_bg',
		'type' => 'file',
	) );
	
	$bookme_general_page_opt->add_field( array(
		'name' => __( 'Page Title Color', 'cmb2' ),
		'id'   => $prefix . 'page_title_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_general_page_opt->add_field( array(
		'name' => __( 'Breadcrumb Color', 'cmb2' ),
		'id'   => $prefix . 'breadcrumb_color',
		'type' => 'colorpicker',
	) );

	$bookme_general_page_opt->add_field( array(
		'name'             => __( 'Page Layout', 'cmb2' ),
		'id'               => $prefix . 'page_layout',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'left_sb' => __( 'Left Sidebar', 'cmb2' ),
			'right_sb'   => __( 'Right Sidebar', 'cmb2' ),
			'fullwidth'     => __( 'Fullwidth', 'cmb2' ),
		),
	) );

}


add_action( 'cmb2_init', 'bookme_header_opt_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function bookme_header_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$bookme_header_opt = new_cmb2_box( array(
		'id'            => $prefix . 'header_opt',
		'title'         => __( 'Header Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'closed'     => true,
		//'show_on'      => array( 'key' => 'page-template', 'value' => array('template-home.php', 'template-accounting.php', 'template-therapy.php', 'template-architect.php', 'template-attorney.php') ),
	) );
	
	$bookme_header_opt->add_field( array(
		'name'    => __( 'Header Background', 'cmb2' ),
		'desc'    => __( 'Set header background color for this specific page', 'cmb2' ),
		'id'      => $prefix . 'header_bg_color',
		'type'    => 'colorpicker',
		//'show_on'      => array( 'key' => 'page-template', 'value' => array('template-home.php', 'template-accounting.php', 'template-architect.php', 'template-attorney.php') ),
	) );
	
	$bookme_header_opt->add_field( array(
		'name' => __( 'Header Quote', 'cmb2' ),
		'desc' => __( 'Check to replace default header quote.', 'cmb2' ),
		'id'   => $prefix . 'header_quote',
		'type' => 'checkbox',
	) );
	
	$bookme_header_opt->add_field( array(
		'name'       => __( 'Header Quote Text', 'cmb2' ),
		'id'         => $prefix . 'header_quote_text',
		'type'       => 'text',
	) );
	
	$bookme_header_opt->add_field( array(
		'name'       => __( 'Header Quote Phone', 'cmb2' ),
		'id'         => $prefix . 'header_quote_phone',
		'type'       => 'text',
	) );
	
}

function all_rev_sliders_in_array(){
    if (class_exists('RevSlider')) {
        $theslider     = new RevSlider();
        $arrSliders = $theslider->getArrSliders();
        $arrA     = array();
        $arrT     = array();
        foreach($arrSliders as $slider){
            $arrA[]     = $slider->getAlias();
            $arrT[]     = $slider->getTitle();
        }
        if($arrA && $arrT){
            $result = array_combine($arrA, $arrT);
        }
        else
        {
            $result = false;
        }
        return $result;
    }
}

add_action( 'cmb2_init', 'bookme_slider_opt_metabox' );
function bookme_slider_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_slider_opt = new_cmb2_box( array(
		'id'           => $prefix . 'slider_metabox',
		'title'        => __( 'Slider Options', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-architect.php', 'template-attorney.php', 'template-trainer.php', 'template-therapy.php', 'template-corporate-trainer.php', 'template-movers.php', 'template-barber.php') ),
		'closed'     => true,
	) );

	if(class_exists('RevSlider')) {
		$bookme_slider_opt->add_field( array(
    		'name' => __( 'Enable Revolution Slider', 'cmb2' ),
    		'desc' => __( 'Use Rev Slider as the slider for this page', 'cmb2' ),
    		'id'   => $prefix . 'rev_slider',
    		'type' => 'checkbox'
		) );
		$bookme_slider_opt->add_field( array(
			'name'     => __( 'Choose Slider', 'cmb2' ),
			'id'       => $prefix . 'rev_slider_alias',
			'type'     => 'select',
			'show_option_none' => true,
			'options' => all_rev_sliders_in_array(), // Taxonomy Slug
		) );
	} 

	$bookme_slider_opt->add_field( array(
		'name'         => __( 'Slide Images', 'cmb2' ),
		'desc'         => __( 'Upload or add slide images.', 'cmb2' ),
		'id'           => $prefix . 'slide_img',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	$bookme_slider_opt->add_field( array(
		'name'             => __( 'Caption Position', 'cmb2' ),
		'id'               => $prefix . 'caption_position',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'left' => __( 'Left', 'cmb2' ),
			'right'   => __( 'Right', 'cmb2' ),
		),
	) );
			
	$bookme_slider_opt->add_field( array(
		'name' => __( 'Slider Content Small Text', 'cmb2' ),
		'id'   => $prefix . 'slider_small_title',
		'type' => 'text_medium',
	) );
	
/*	$bookme_slider_opt->add_field( array(
		'name'       => __( 'Slider Content Title', 'cmb2' ),
		'id'         => $prefix . 'slider_title',
		'type'       => 'text',
	) ); */
	
	$bookme_slider_opt->add_field( array(
		'name'    => __( 'Slider Content', 'cmb2' ),
		'id'      => $prefix . 'slider_content',
		'type'    => 'textarea',
	) );
	
	$bookme_slider_opt->add_field( array(
		'name' => __( 'Slider Button 1 Text', 'cmb2' ),
		'id'   => $prefix . 'sld_btn1_text',
		'type' => 'text_medium',
	) );

	$bookme_slider_opt->add_field( array(
		'name' => __( 'Slider Button 1 URL', 'cmb2' ),
		'id'   => $prefix . 'sld_btn1_url',
		'type' => 'text_url',
	) );
	
	$bookme_slider_opt->add_field( array(
		'name' => __( 'Slider Button 2 Text', 'cmb2' ),
		'id'   => $prefix . 'sld_btn2_text',
		'type' => 'text_medium',
	) );

	$bookme_slider_opt->add_field( array(
		'name' => __( 'Slider Button 2 URL', 'cmb2' ),
		'id'   => $prefix . 'sld_btn2_url',
		'type' => 'text_url',
	) );
	
/*	if ( class_exists('booked_plugin') ) {
		$bookme_slider_opt->add_field( array(
    		'name' => 'Enable Book Calendar',
    		'id'   => $prefix . 'slider_booked_calendar',
    		'type' => 'checkbox'
		) );
		$bookme_slider_opt->add_field( array(
			'name' => __( 'Book Calendar Title', 'cmb2' ),
			'id'   => $prefix . 'slider_booked_title',
			'type' => 'textarea_small',
		) );
		$bookme_slider_opt->add_field( array(
			'name' => __( 'Booked shortcode', 'cmb2' ),
			'id'   => $prefix . 'slider_booked_shortcode',
			'type' => 'text',
		) );
	} */
	
}

add_action( 'cmb2_init', 'bookme_acc3_slider_opt_metabox' );
function bookme_acc3_slider_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_acc3_slider_opt = new_cmb2_box( array(
		'id'           => $prefix . 'acc3_slider_metabox',
		'title'        => __( 'Slider Options', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting3.php') ),
		'closed'     => true,
	) );

	if(class_exists('RevSlider')) {
		$bookme_acc3_slider_opt->add_field( array(
    		'name' => __( 'Enable Revolution Slider', 'cmb2' ),
    		'desc' => __( 'Use Rev Slider as the slider for this page', 'cmb2' ),
    		'id'   => $prefix . 'acc3_rev_slider',
    		'type' => 'checkbox'
		) );
		$bookme_acc3_slider_opt->add_field( array(
			'name'     => __( 'Choose Slider', 'cmb2' ),
			'id'       => $prefix . 'acc3_rev_slider_alias',
			'type'     => 'select',
			'show_option_none' => true,
			'options' => all_rev_sliders_in_array(), // Taxonomy Slug
		) );
	} 

	$bookme_acc3_slider_opt->add_field( array(
		'name'         => __( 'Slide Images', 'cmb2' ),
		'desc'         => __( 'Upload or add slide images.', 'cmb2' ),
		'id'           => $prefix . 'acc3_slide_img',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	$bookme_acc3_slider_opt->add_field( array(
		'name' => __( 'Quote Form small text', 'cmb2' ),
		'id'   => $prefix . 'acc3_quote_small_text',
		'type' => 'text_medium',
	) );

	$bookme_acc3_slider_opt->add_field( array(
		'name' => __( 'Quote Form Title', 'cmb2' ),
		'id'   => $prefix . 'acc3_quote_title',
		'type' => 'text',
	) );
	
	if ( function_exists('wpcf7') ) {
		$cform = bookme_get_cf7_post(array('post_type' => 'wpcf7_contact_form',));
		if ( $cform ) {
			$bookme_acc3_slider_opt->add_field( array(
				'name' => __( 'CF7 Form', 'cmb2' ),
				'id'   => $prefix . 'acc3_cf7_form',
				'type'    => 'select',
				'show_option_none' => true,
                'options' => $cform,
			) );
		}
	}
}


add_action( 'cmb2_init', 'bookme_about_opt_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function bookme_about_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-about.php') ),
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'about_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_about_opt->add_field( array(
		'name'    => __( 'About Content', 'cmb2' ),
		'id'      => $prefix . 'about_content',
		'type'    => 'textarea',
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'About More Text', 'cmb2' ),
		'id'   => $prefix . 'abt_more_text',
		'type' => 'text_medium',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About More URL', 'cmb2' ),
		'id'   => $prefix . 'abt_more_url',
		'type' => 'text_url',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Image 1', 'cmb2' ),
		'id'   => $prefix . 'about_image1',
		'type' => 'file',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Image 2', 'cmb2' ),
		'id'   => $prefix . 'about_image2',
		'type' => 'file',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Image 3', 'cmb2' ),
		'id'   => $prefix . 'about_image3',
		'type' => 'file',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Image 4', 'cmb2' ),
		'id'   => $prefix . 'about_image4',
		'type' => 'file',
	) );
	
}

add_action( 'cmb2_init', 'bookme_therapy_about_opt_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function bookme_therapy_about_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'therapy_about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-therapy.php') ),
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'therapy_about_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_about_opt->add_field( array(
		'name'    => __( 'About Content', 'cmb2' ),
		'id'      => $prefix . 'therapy_about_content',
		'type'    => 'textarea',
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'About More Text', 'cmb2' ),
		'id'   => $prefix . 'therapy_abt_more_text',
		'type' => 'text_medium',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About More URL', 'cmb2' ),
		'id'   => $prefix . 'therapy_abt_more_url',
		'type' => 'text_url',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Video Image', 'cmb2' ),
		'id'   => $prefix . 'therapy_about_video_img',
		'type' => 'file',
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'Video URL', 'cmb2' ),
		'id'   => $prefix . 'therapy_about_video_url',
		'type' => 'text_url',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'Opening Hours Title', 'cmb2' ),
		'id'   => $prefix . 'therapy_open_hours_title',
		'type' => 'textarea_small',
	) );

	$group_field_id = $bookme_about_opt->add_field( array(
		'id'          => $prefix . 'therapy_open_hours',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => __( 'Open Hours {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Open Hours', 'cmb2' ),
			'remove_button' => __( 'Remove Open Hours', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$bookme_about_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon', 'cmb2' ),
		'id'   => 'icon',
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'type' => 'text_small',
	) );
	
	$bookme_about_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon Image', 'cmb2' ),
		'description' => __( 'Upload Image as icon . This will replace the icon above', 'cmb2' ),
		'id'   => 'icon_img',
		'type' => 'file',
	) );

	$bookme_about_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Description', 'cmb2' ),
		'id'   => 'desc',
		'description' => __( 'Linearicons icon code. i.e: lnr-home. You can get the code <a href="https://linearicons.com/free">here</a>', 'cmb2' ),
		'type' => 'textarea_small',
	) );
	
}

add_action( 'cmb2_init', 'bookme_trainer_about_opt_metabox' );
function bookme_trainer_about_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'trainer_about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-trainer.php') ),
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'trainer_about_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_about_opt->add_field( array(
		'name'    => __( 'About Content', 'cmb2' ),
		'id'      => $prefix . 'trainer_about_content',
		'type'    => 'textarea',
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'About More Text', 'cmb2' ),
		'id'   => $prefix . 'trainer_abt_more_text',
		'type' => 'text_medium',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About More URL', 'cmb2' ),
		'id'   => $prefix . 'trainer_abt_more_url',
		'type' => 'text_url',
	) );

	$bookme_about_opt->add_field( array(
		'name' => __( 'About Video Image', 'cmb2' ),
		'id'   => $prefix . 'trainer_about_video_img',
		'type' => 'file',
	) );
	
	$bookme_about_opt->add_field( array(
		'name' => __( 'Video URL', 'cmb2' ),
		'id'   => $prefix . 'trainer_about_video_url',
		'type' => 'text_url',
	) );
}


add_action( 'cmb2_init', 'bookme_attorney_about_opt_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function bookme_attorney_about_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_attorney_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'attorney_about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-attorney.php', 'template-accounting3.php') ),
	) );
	
	$bookme_attorney_about_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'attorney_about_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_attorney_about_opt->add_field( array(
		'name'    => __( 'About Content', 'cmb2' ),
		'id'      => $prefix . 'attorney_about_content',
		'type'    => 'textarea',
	) );
	
	$bookme_attorney_about_opt->add_field( array(
		'name' => __( 'About More Text', 'cmb2' ),
		'id'   => $prefix . 'attorney_abt_more_text',
		'type' => 'text_medium',
	) );
	
	$bookme_attorney_about_opt->add_field( array(
		'name' => __( 'About More URL', 'cmb2' ),
		'id'   => $prefix . 'attorney_abt_more_url',
		'type' => 'text_url',
	) );
	
	$bookme_attorney_about_opt->add_field( array(
		'name'     => __( 'Clients Category', 'cmb2' ),
		'id'       => $prefix . 'attorney_clients_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('client_category'), // Taxonomy Slug
	) );
	
}

add_action( 'cmb2_init', 'bookme_movers_about_opt_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function bookme_movers_about_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_movers_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'movers_about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-movers.php') ),
	) );
	
	$bookme_movers_about_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'movers_about_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_movers_about_opt->add_field( array(
		'name'    => __( 'About Content', 'cmb2' ),
		'id'      => $prefix . 'movers_about_content',
		'type'    => 'textarea',
	) );
	
	$bookme_movers_about_opt->add_field( array(
		'name' => __( 'About Quote Form small text', 'cmb2' ),
		'id'   => $prefix . 'about_quote_small_text',
		'type' => 'text_medium',
	) );

	$bookme_movers_about_opt->add_field( array(
		'name' => __( 'About Quote Form Title', 'cmb2' ),
		'id'   => $prefix . 'about_quote_title',
		'type' => 'text',
	) );
	
	if ( function_exists('wpcf7') ) {
		$cform = bookme_get_cf7_post(array('post_type' => 'wpcf7_contact_form',));
		if ( $cform ) {
			$bookme_movers_about_opt->add_field( array(
				'name' => __( 'CF7 Form', 'cmb2' ),
				'id'   => $prefix . 'about_cf7_form',
				'type'    => 'select',
				'show_option_none' => true,
                'options' => $cform,
			) );
		}
	}
	
}


add_action( 'cmb2_init', 'bookme_architect_quote_opt_metabox' );
function bookme_architect_quote_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_architect_quote_opt = new_cmb2_box( array(
		'id'           => $prefix . 'architect_quote_metabox',
		'title'        => __( 'Quotation Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
	) );
	
	$bookme_architect_quote_opt->add_field( array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => $prefix . 'architect_quote_small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_architect_quote_opt->add_field( array(
		'name'    => __( 'Content', 'cmb2' ),
		'id'      => $prefix . 'architect_quote_content',
		'type'    => 'textarea_small',
	) );
	
	$bookme_architect_quote_opt->add_field( array(
		'name'    => __( 'Form Left Content', 'cmb2' ),
		'id'      => $prefix . 'architect_quote_form_left_content',
		'type'    => 'textarea_small',
	) );
	
	$bookme_architect_quote_opt->add_field( array(
		'name'    => __( 'Form Title', 'cmb2' ),
		'id'      => $prefix . 'architect_quote_form_title_content',
		'type'    => 'text_medium',
	) );
	$bookme_architect_quote_opt->add_field( array(
		'name'    => __( 'Form Description', 'cmb2' ),
		'id'      => $prefix . 'architect_quote_form_desc_content',
		'type'    => 'textarea_small',
	) );
	
	if ( function_exists('wpcf7') ) {
		$cform = bookme_get_cf7_post(array('post_type' => 'wpcf7_contact_form',));
		if ( $cform ) {
			$bookme_architect_quote_opt->add_field( array(
				'name' => __( 'CF7 Form', 'cmb2' ),
				'id'   => $prefix . 'architect_quote_cf7_form',
				'type'    => 'select',
				'show_option_none' => true,
                'options' => $cform,
			) );
		}
	}
}

add_action( 'cmb2_init', 'bookme_services_opt_metabox' );
function bookme_services_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_services_opt = new_cmb2_box( array(
		'id'           => $prefix . 'services_metabox',
		'title'        => __( 'Services Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-accounting3.php', 'template-attorney.php', 'template-therapy.php', 'template-corporate-trainer.php') ),
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $bookme_services_opt->add_field( array(
		'id'          => $prefix . 'services',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Service {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Service', 'cmb2' ),
			'remove_button' => __( 'Remove Service', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Background Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => 'color',
		'type' => 'rgba_colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon', 'cmb2' ),
		'id'   => 'icon',
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'type' => 'text_small',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon Image', 'cmb2' ),
		'id'   => 'icon_img',
		'description' => __( 'Upload Image as icon . This will replace the icon above', 'cmb2' ),
		'type' => 'file',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Small Title', 'cmb2' ),
		'id'   => 'small_title',
		'type' => 'text_medium',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Small Title Font Color', 'cmb2' ),
		'id'   => 'small_title_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title', 'cmb2' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title Font Color', 'cmb2' ),
		'id'   => 'title_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Description', 'cmb2' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Description Font Color', 'cmb2' ),
		'id'   => 'desc_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button Text', 'cmb2' ),
		'id'   => 'more_text',
		'type' => 'text_medium',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button URL', 'cmb2' ),
		'id'   => 'more_url',
		'type' => 'text_url',
	) );
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button Color', 'cmb2' ),
		'id'   => 'btn_color',
		'type' => 'colorpicker',
	) ); 

}

add_action( 'cmb2_init', 'bookme_trainer_services_opt_metabox' );
function bookme_trainer_services_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_services_opt = new_cmb2_box( array(
		'id'           => $prefix . 'trainer_services_metabox',
		'title'        => __( 'Services Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-trainer.php') ),
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $bookme_services_opt->add_field( array(
		'id'          => $prefix . 'trainer_services',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Service {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Service', 'cmb2' ),
			'remove_button' => __( 'Remove Service', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => 'color',
		'type' => 'rgba_colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title', 'cmb2' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title Font Color', 'cmb2' ),
		'id'   => 'title_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Description', 'cmb2' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Description Font Color', 'cmb2' ),
		'id'   => 'desc_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button Text', 'cmb2' ),
		'id'   => 'more_text',
		'type' => 'text_medium',
	) );
	
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button URL', 'cmb2' ),
		'id'   => 'more_url',
		'type' => 'text_url',
	) );
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => __( 'More Button Color', 'cmb2' ),
		'id'   => 'btn_color',
		'type' => 'colorpicker',
	) );
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name' => 'Money Service',
		'id' => 'text_money',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );
	$bookme_services_opt->add_group_field( $group_field_id, array(
		'name'     => __( 'Time Service', 'cmb2' ),
		'id'       => 'time_services',
		'type'     => 'select',
		'options'          => array(
			'month' => __( 'Month', 'cmb2' ),
			'day'   => __( 'Day', 'cmb2' ),
		),
	) );
}


add_action( 'cmb2_init', 'bookme_architect_services_opt_metabox' );
function bookme_architect_services_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_architect_opt = new_cmb2_box( array(
		'id'           => $prefix . 'architect_services_metabox',
		'title'        => __( 'Services Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
	) );
	
	$bookme_architect_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'architect_small_text',
		'type' => 'text_medium',
	) );
	
	$bookme_architect_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'architect_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_architect_opt->add_field( array(
		'name'     => __( 'Service Posts Category', 'cmb2' ),
		'id'       => $prefix . 'architect_service_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('service_category'), // Taxonomy Slug
	) );
}
	
	
	

add_action( 'cmb2_init', 'bookme_news_opt_metabox' );

function bookme_news_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_news_opt = new_cmb2_box( array(
		'id'           => $prefix . 'news_metabox',
		'title'        => __( 'News Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-architect.php', 'template-therapy.php', 'template-movers.php') ),
	) );
	
	$bookme_news_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'news_small_text',
		'type' => 'text_medium',
	) );
	
	$bookme_news_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'news_title',
		'type' => 'text',
	) );
	
	$bookme_news_opt->add_field( array(
		'name' => __( 'Section Description', 'cmb2' ),
		'id'   => $prefix . 'news_desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_news_opt->add_field( array(
		'name' => __( 'More Button Text', 'cmb2' ),
		'id'   => $prefix . 'news_more_text',
		'type' => 'text_medium',
	) );
	
	$bookme_news_opt->add_field( array(
		'name' => __( 'More Button URL', 'cmb2' ),
		'id'   => $prefix . 'news_more_url',
		'type' => 'text_url',
	) );
	
	$bookme_news_opt->add_field( array(
		'name'     => __( 'Post Tag', 'cmb2' ),
		'id'       => $prefix . 'news_post_tag',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('post_tag'), // Taxonomy Slug
	) );
	
}

add_action( 'cmb2_init', 'bookme_trainer_news_opt_metabox' );
function bookme_trainer_news_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_trainer_news_opt = new_cmb2_box( array(
		'id'           => $prefix . 'trainer_news_metabox',
		'title'        => __( 'News Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-trainer.php', 'template-corporate-trainer.php') ),
	) );
	
	$bookme_trainer_news_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'trainer_news_small_text',
		'type' => 'text_medium',
	) );
	
	$bookme_trainer_news_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'trainer_news_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_trainer_news_opt->add_field( array(
		'name'     => __( 'Post Tag', 'cmb2' ),
		'id'       => $prefix . 'trainer_post_tag',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('post_tag'), // Taxonomy Slug
	) );
		
}

add_action( 'cmb2_init', 'bookme_attorney_news_opt_metabox' );

function bookme_attorney_news_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_attorney_news_opt = new_cmb2_box( array(
		'id'           => $prefix . 'attorney_news_metabox',
		'title'        => __( 'News Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-attorney.php', 'template-accounting3.php') ),
	) );
	
	$bookme_attorney_news_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'attorney_news_small_text',
		'type' => 'text_medium',
	) );
	
	$bookme_attorney_news_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'attorney_news_title',
		'type' => 'text',
	) );
	
	$bookme_attorney_news_opt->add_field( array(
		'name'     => __( 'Post Tag', 'cmb2' ),
		'id'       => $prefix . 'attorney_post_tag',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('post_tag'), // Taxonomy Slug
	) );
		
}


add_action( 'cmb2_init', 'bookme_facts_opt_metabox' );

function bookme_facts_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_facts_opt = new_cmb2_box( array(
		'id'           => $prefix . 'facts_metabox',
		'title'        => __( 'Facts Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-accounting3.php', 'template-architect.php', 'template-attorney.php', 'template-therapy.php', 'template-corporate-trainer.php', 'template-about.php', 'template-trainer.php', 'template-movers.php') ),
		'closed'     => true,
	) );

	$bookme_facts_opt->add_field( array(
		'name' => __( 'Background Image', 'cmb2' ),
		'id'   => $prefix . 'facts_bg_image',
		'type' => 'file',
	) );
	
	$bookme_facts_opt->add_field( array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => $prefix . 'facts_bg_color',
		'type' => 'rgba_colorpicker',
	) );

	$bookme_facts_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'facts_small_text',
		'type' => 'text_medium',
	) );
	
	$bookme_facts_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'facts_title',
		'type' => 'text',
	) );
	
	$bookme_facts_opt->add_field( array(
		'name' => __( 'Section Description', 'cmb2' ),
		'id'   => $prefix . 'facts_desc',
		'type' => 'textarea_small',
	) );

	$group_field_id = $bookme_facts_opt->add_field( array(
		'id'          => $prefix . 'fact',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Fact {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Fact', 'cmb2' ),
			'remove_button' => __( 'Remove Fact', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$bookme_facts_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon', 'cmb2' ),
		'id'   => 'icon',
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'type' => 'text_small',
	) );
	
	$bookme_facts_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon Image', 'cmb2' ),
		'id'   => 'icon_img',
		'description' => __( 'Upload Image as icon . This will replace the icon above', 'cmb2' ),
		'type' => 'file',
	) );

	$bookme_facts_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Content', 'cmb2' ),
		'id'   => 'content',
		'type' => 'textarea_small',
	) );

}

add_action( 'cmb2_init', 'bookme_about_details_opt_metabox' );

function bookme_about_details_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_about_details_opt = new_cmb2_box( array(
		'id'           => $prefix . 'about_details_metabox',
		'title'        => __( 'About Details Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-accounting3.php', 'template-attorney.php', 'template-therapy.php', 'template-about.php', 'template-trainer.php') ),
		'closed'     => true,
	) );

	$bookme_about_details_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'about_details_small_text',
		'type' => 'text_medium',
	) );

	$bookme_about_details_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'about_details_content',
		'type' => 'textarea_small',
	) );

	$group_field_id = $bookme_about_details_opt->add_field( array(
		'id'          => $prefix . 'about_details',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Detail {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Detail', 'cmb2' ),
			'remove_button' => __( 'Remove Detail', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$bookme_about_details_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon', 'cmb2' ),
		'id'   => 'icon',
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'type' => 'text_small',
	) );
	
	$bookme_about_details_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Icon Image', 'cmb2' ),
		'id'   => 'icon_img',
		'description' => __( 'Upload Image as icon . This will replace the icon above', 'cmb2' ),
		'type' => 'file',
	) );

	$bookme_about_details_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title', 'cmb2' ),
		'id'   => 'title',
		'type' => 'text',
	) );

	$bookme_about_details_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Content', 'cmb2' ),
		'id'   => 'content',
		'type' => 'textarea_small',
	) );

	$bookme_about_details_opt->add_field( array(
		'name' => __( 'More Button Text', 'cmb2' ),
		'id'   => $prefix . 'about_details_more_text',
		'type' => 'text_medium',
	) );
	$bookme_about_details_opt->add_field( array(
		'name' => __( 'More Button URL', 'cmb2' ),
		'id'   => $prefix . 'about_details_more_url',
		'type' => 'text_url',
	) );
	$bookme_about_details_opt->add_field( array(
		'name' => __( 'Book Button Text', 'cmb2' ),
		'id'   => $prefix . 'about_details_book_text',
		'type' => 'text_medium',
	) );
	$bookme_about_details_opt->add_field( array(
		'name' => __( 'Book Button URL', 'cmb2' ),
		'id'   => $prefix . 'about_details_book_url',
		'type' => 'text_url',
	) );

}

add_action( 'cmb2_init', 'bookme_architect_about_details_opt_metabox' );

function bookme_architect_about_details_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_architect_about_details_opt = new_cmb2_box( array(
		'id'           => $prefix . 'architect_about_details_metabox',
		'title'        => __( 'About Details Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
		'closed'     => true,
	) );

	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'architect_about_details_small_text',
		'type' => 'text_medium',
	) );

	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'architect_about_details_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Home Owner Section Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => $prefix . 'home_owner_icon',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Home Owner Section Icon Image', 'cmb2' ),
		'description' => __( 'Will replace the icon above', 'cmb2' ),
		'id'   => $prefix . 'home_owner_icon_img',
		'type' => 'file',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Home Owner Count', 'cmb2' ),
		'id'   => $prefix . 'home_owner_count',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Home Owner Section Title', 'cmb2' ),
		'id'   => $prefix . 'home_owner_title',
		'type' => 'text',
	) );
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Home Owner Section Description', 'cmb2' ),
		'id'   => $prefix . 'home_owner_desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Ongoing Project Section Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => $prefix . 'ongoing_project_icon',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Ongoing Project Section Icon Image', 'cmb2' ),
		'description' => __( 'Will replace the icon above', 'cmb2' ),
		'id'   => $prefix . 'ongoing_project_icon_img',
		'type' => 'file',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Ongoing Project Count', 'cmb2' ),
		'id'   => $prefix . 'ongoing_project_count',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Ongoing Project Section Title', 'cmb2' ),
		'id'   => $prefix . 'ongoing_project_title',
		'type' => 'text',
	) );
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Ongoing Project Section Description', 'cmb2' ),
		'id'   => $prefix . 'ongoing_project_desc',
		'type' => 'textarea_small',
	) );
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Future Plans Section Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => $prefix . 'future_plans_icon',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Future Plans Section Icon Image', 'cmb2' ),
		'description' => __( 'Will replace the icon above', 'cmb2' ),
		'id'   => $prefix . 'future_plans_icon_img',
		'type' => 'file',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Future Plans Count', 'cmb2' ),
		'id'   => $prefix . 'future_plans_count',
		'type' => 'text_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Future Plans Section Title', 'cmb2' ),
		'id'   => $prefix . 'future_plans_title',
		'type' => 'text',
	) );
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'Future Plans Section Description', 'cmb2' ),
		'id'   => $prefix . 'future_plans_desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'More Button Text', 'cmb2' ),
		'id'   => $prefix . 'architect_about_details_btn_text',
		'type' => 'text_medium',
	) );
	$bookme_architect_about_details_opt->add_field( array(
		'name' => __( 'More Button URL', 'cmb2' ),
		'id'   => $prefix . 'architect_about_details_more_url',
		'type' => 'text_url',
	) );
}


add_action( 'cmb2_init', 'bookme_corp_trainer_about_opt_metabox' );

function bookme_corp_trainer_about_opt_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_corp_trainer_about_opt = new_cmb2_box( array(
		'id'           => $prefix . 'corp_trainer_about_metabox',
		'title'        => __( 'About Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-corporate-trainer.php') ),
		'closed'     => true,
	) );

	$bookme_corp_trainer_about_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'corp_trainer_about_small_text',
		'type' => 'text_medium',
	) );

	$bookme_corp_trainer_about_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'corp_trainer_about_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_corp_trainer_about_opt->add_field( array(
		'name'         => __( 'About Images Slider', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => $prefix . 'corp_trainer_about_slider',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

}
	
	

add_action( 'cmb2_init', 'bookme_clients_opt_metabox' );

function bookme_clients_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_clients_opt = new_cmb2_box( array(
		'id'           => $prefix . 'clients_metabox',
		'title'        => __( 'Clients Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-therapy.php', 'template-trainer.php', 'template-movers.php') ),
		'closed'     => true,
	) );

	$bookme_clients_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'clients_small_text',
		'type' => 'text_medium',
	) );

	$bookme_clients_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'clients_title',
		'type' => 'text',
	) );

	$bookme_clients_opt->add_field( array(
		'name' => __( 'Section Content', 'cmb2' ),
		'id'   => $prefix . 'clients_content',
		'type' => 'textarea_small',
	) );

	$bookme_clients_opt->add_field( array(
		'name'     => __( 'Clients Category', 'cmb2' ),
		'id'       => $prefix . 'clients_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('client_category'), // Taxonomy Slug
	) );

}


add_action( 'cmb2_init', 'bookme_corp_trainer_clients_opt_metabox' );

function bookme_corp_trainer_clients_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_corp_trainer_clients_opt = new_cmb2_box( array(
		'id'           => $prefix . 'corp_trainer_clients_metabox',
		'title'        => __( 'Clients Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-corporate-trainer.php') ),
		'closed'     => true,
	) );

	$bookme_corp_trainer_clients_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'corp_trainer_clients_title',
		'type' => 'text',
	) );

	$bookme_corp_trainer_clients_opt->add_field( array(
		'name'     => __( 'Clients Category', 'cmb2' ),
		'id'       => $prefix . 'corp_trainer_clients_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('client_category'), // Taxonomy Slug
	) );

}


add_action( 'cmb2_init', 'bookme_therapy_testimonials_opt_metabox' );

function bookme_therapy_testimonials_opt_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_therapy_testimonials_opt = new_cmb2_box( array(
		'id'           => $prefix . 'therapy_testimonial_metabox',
		'title'        => __( 'Testimonials Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-therapy.php', 'template-trainer.php', 'template-corporate-trainer.php', 'template-barber.php') ),
	) );

	$bookme_therapy_testimonials_opt->add_field( array(
		'name' => __( 'Background Image', 'cmb2' ),
		'id'   => $prefix . 'therapy_testimonials_bg_img',
		'type' => 'file',
	) );

	$bookme_therapy_testimonials_opt->add_field( array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => $prefix . 'therapy_testimonials_bg_color',
		'type' => 'rgba_colorpicker',
	) );

	$bookme_therapy_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Small Text', 'cmb2' ),
		'id'   => $prefix . 'therapy_testimonial_small_text',
		'type' => 'text_medium',
	) );

	$bookme_therapy_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Title', 'cmb2' ),
		'id'   => $prefix . 'therapy_testimonial_title',
		'type' => 'text_medium',
	) );
	
	$bookme_therapy_testimonials_opt->add_field( array(
		'name'     => __( 'Testimonials Category', 'cmb2' ),
		'id'       => $prefix . 'therapy_testi_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('testi_category'), // Taxonomy Slug
	) );

}


add_action( 'cmb2_init', 'bookme_testimonials_opt_metabox' );

function bookme_testimonials_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_testimonials_opt = new_cmb2_box( array(
		'id'           => $prefix . 'testimonial_metabox',
		'title'        => __( 'Testimonials Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php') ),
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'testimonial_small_text',
		'type' => 'text_medium',
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Section Title', 'cmb2' ),
		'id'   => $prefix . 'testimonial_title',
		'type' => 'text',
	) );
	
	$bookme_testimonials_opt->add_field( array(
		'name'     => __( 'Testimonials Category', 'cmb2' ),
		'id'       => $prefix . 'accounting_testi_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('testi_category'), // Taxonomy Slug
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Callout Image', 'cmb2' ),
		'id'   => $prefix . 'testimonial_callout_img',
		'type' => 'file',
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Callout content', 'cmb2' ),
		'id'   => $prefix . 'testimonial_callout_content',
		'type' => 'textarea_small',
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Quote Form small text', 'cmb2' ),
		'id'   => $prefix . 'testimonial_quote_small_text',
		'type' => 'text_medium',
	) );

	$bookme_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Quote Form Title', 'cmb2' ),
		'id'   => $prefix . 'testimonial_quote_title',
		'type' => 'text',
	) );

	if ( function_exists('wpcf7') ) {
		$cform = bookme_get_cf7_post(array('post_type' => 'wpcf7_contact_form',));
		if ( $cform ) {
			$bookme_testimonials_opt->add_field( array(
				'name' => __( 'CF7 Form', 'cmb2' ),
				'id'   => $prefix . 'testimonials_cf7_form',
				'type'    => 'select',
				'show_option_none' => true,
                'options' => $cform,
			) );
		}
	}

}


add_action( 'cmb2_init', 'bookme_architect_testimonials_opt_metabox' );
function bookme_architect_testimonials_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_architect_testimonials_opt = new_cmb2_box( array(
		'id'           => $prefix . 'architect_testimonial_metabox',
		'title'        => __( 'Testimonials Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
	) );
	
	$bookme_architect_testimonials_opt->add_field( array(
		'name' => __( 'Show Testimonials Section', 'cmb2' ),
		'id'   => $prefix . 'architect_testimonials',
		'type' => 'checkbox',
	) );
	
	$bookme_architect_testimonials_opt->add_field( array(
		'name'     => __( 'Testimonials Category', 'cmb2' ),
		'id'       => $prefix . 'architect_testi_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('testi_category'), // Taxonomy Slug
	) );
}


add_action( 'cmb2_init', 'bookme_attorney_testimonials_opt_metabox' );

function bookme_attorney_testimonials_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_attorney_testimonials_opt = new_cmb2_box( array(
		'id'           => $prefix . 'attorney_testimonial_metabox',
		'title'        => __( 'Testimonials Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-attorney.php', 'template-movers.php', 'template-accounting3.php') ),
	) );

	$bookme_attorney_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'attorney_testimonial_small_text',
		'type' => 'text_medium',
	) );

	$bookme_attorney_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Section Title', 'cmb2' ),
		'id'   => $prefix . 'attorney_testimonial_title',
		'type' => 'text',
	) );
	
	$bookme_attorney_testimonials_opt->add_field( array(
		'name'     => __( 'Testimonials Category', 'cmb2' ),
		'id'       => $prefix . 'attorney_testi_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('testi_category'), // Taxonomy Slug
	) );

	$bookme_attorney_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Callout Image', 'cmb2' ),
		'id'   => $prefix . 'attorney_testimonial_callout_img',
		'type' => 'file',
	) );

	$bookme_attorney_testimonials_opt->add_field( array(
		'name' => __( 'Testimonial Callout Content', 'cmb2' ),
		'id'   => $prefix . 'attorney_testimonial_callout_content',
		'type' => 'textarea_small',
	) );
	
}

add_action( 'cmb2_init', 'bookme_architect_clients_opt_metabox' );
function bookme_architect_clients_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_architect_clients_opt = new_cmb2_box( array(
		'id'           => $prefix . 'architect_clients_metabox',
		'title'        => __( 'Clients Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
	) );
	
	$bookme_architect_clients_opt->add_field( array(
		'name' => __( 'Show Clients Section', 'cmb2' ),
		'id'   => $prefix . 'architect_clients',
		'type' => 'checkbox',
	) );
	
	$bookme_architect_clients_opt->add_field( array(
		'name'     => __( 'Clients Category', 'cmb2' ),
		'id'       => $prefix . 'architect_clients_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('client_category'), // Taxonomy Slug
	) );
}


add_action( 'cmb2_init', 'bookme_callout_opt_metabox' );
function bookme_callout_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_callout_opt = new_cmb2_box( array(
		'id'           => $prefix . 'callout_metabox',
		'title'        => __( 'Call out Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-architect.php') ),
	) );
	
	$bookme_callout_opt->add_field( array(
		'name' => __( 'Callout Image', 'cmb2' ),
		'id'   => $prefix . 'callout_img',
		'type' => 'file',
	) );

	$bookme_callout_opt->add_field( array(
		'name' => __( 'Callout Left Content', 'cmb2' ),
		'id'   => $prefix . 'callout_left_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_callout_opt->add_field( array(
		'name' => __( 'Callout Right Content', 'cmb2' ),
		'id'   => $prefix . 'callout_right_content',
		'type' => 'textarea_small',
	) );
}

add_action( 'cmb2_init', 'bookme_projects_opt_metabox' );
function bookme_projects_opt_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_projects_opt = new_cmb2_box( array(
		'id'           => $prefix . 'project_metabox',
		'title'        => __( 'Projects Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-movers.php', 'template-architect.php') ),
	) );

	$bookme_projects_opt->add_field( array(
		'name' => __( 'Project Small Text', 'cmb2' ),
		'id'   => $prefix . 'project_small_text',
		'type' => 'text_medium',
	) );

	$bookme_projects_opt->add_field( array(
		'name' => __( 'Project Title', 'cmb2' ),
		'id'   => $prefix . 'project_title',
		'type' => 'text_medium',
	) );
	
	$bookme_projects_opt->add_field( array(
		'name' => __( 'Project Content', 'cmb2' ),
		'id'   => $prefix . 'project_content',
		'type' => 'textarea_small',
	) );
	
	$bookme_projects_opt->add_field( array(
		'name'     => __( 'Projects Type', 'cmb2' ),
		'id'       => $prefix . 'projects_type',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('project_type'), // Taxonomy Slug
	) );

}

add_action( 'cmb2_init', 'bookme_paralax_opt_metabox' );

function bookme_paralax_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_paralax_opt = new_cmb2_box( array(
		'id'           => $prefix . 'paralax_metabox',
		'title'        => __( 'Parallax Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-accounting.php', 'template-accounting2.php', 'template-accounting3.php', 'template-architect.php', 'template-attorney.php', 'template-therapy.php', 'template-trainer.php', 'template-corporate-trainer.php', 'template-movers.php', 'template-barber.php') ),
	) );

	$bookme_paralax_opt->add_field( array(
		'name' => __( 'Background Image', 'cmb2' ),
		'id'   => $prefix . 'paralax_bg_img',
		'type' => 'file',
	) );

	$bookme_paralax_opt->add_field( array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => $prefix . 'paralax_bg_color',
		'type' => 'rgba_colorpicker',
	) );

	$bookme_paralax_opt->add_field( array(
		'name' => __( 'Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'paralax_small_text',
		'type' => 'text_medium',
	) );

	$bookme_paralax_opt->add_field( array(
		'name' => __( 'Content', 'cmb2' ),
		'id'   => $prefix . 'paralax_content',
		'type' => 'textarea_small',
	) );

	$bookme_paralax_opt->add_field( array(
		'name' => __( 'Featured Logo Text', 'cmb2' ),
		'id'   => $prefix . 'paralax_featured_logo_text',
		'type' => 'text_medium',
	) );

	$bookme_paralax_opt->add_field( array(
		'name'         => __( 'Featured Logo', 'cmb2' ),
		'id'           => $prefix . 'paralax_featured_logo',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
	if ( class_exists('booked_plugin') ) {
		$bookme_paralax_opt->add_field( array(
    		'name' => 'Enable Book Calendar',
    		'id'   => $prefix . 'parallax_booked_calendar',
    		'type' => 'checkbox'
		) );
		$bookme_paralax_opt->add_field( array(
			'name' => __( 'Book Calendar Title', 'cmb2' ),
			'id'   => $prefix . 'parallax_booked_title',
			'type' => 'textarea_small',
		) );
		$bookme_paralax_opt->add_field( array(
			'name' => __( 'Booked shortcode', 'cmb2' ),
			'id'   => $prefix . 'parallax_booked_shortcode',
			'type' => 'text',
		) );
	}

}

function bookme_get_cf7_post( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'wpcf7_contact_form',
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}


add_action( 'cmb2_init', 'bookme_tab_opt_metabox' );

function bookme_tab_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_tab_opt = new_cmb2_box( array(
		'id'           => $prefix . 'tab_metabox',
		'title'        => __( 'Tab Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'closed'     => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-corporate-trainer.php') ),
	) );
	
	$bookme_tab_opt->add_field( array(
		'name' => __( 'Background Image', 'cmb2' ),
		'id'   => $prefix . 'tab_bg_img',
		'type' => 'file',
	) );

	$bookme_tab_opt->add_field( array(
		'name' => __( 'Background Color', 'cmb2' ),
		'id'   => $prefix . 'tab_bg_color',
		'type' => 'rgba_colorpicker',
	) );
	
	$bookme_tab_opt->add_field( array(
		'name' => __( 'Section Title', 'cmb2' ),
		'id'   => $prefix . 'tab_sect_title',
		'type' => 'text',
	) );
		
	$group_field_id = $bookme_tab_opt->add_field( array(
		'id'          => $prefix . 'tab_details',
		'type'        => 'group',
		'description' => __( 'Tab Details', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Tab {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Tab', 'cmb2' ),
			'remove_button' => __( 'Remove Tab', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );
	
	$bookme_tab_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title', 'cmb2' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	
	$bookme_tab_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => 'icon',
		'type' => 'text_small',
	) );
	
	$bookme_tab_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title Image', 'cmb2' ),
		'description' => __( 'Will replace the text title above', 'cmb2' ),
		'id'   => 'title_img',
		'type' => 'file',
	) );
	
	$bookme_tab_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Content', 'cmb2' ),
		'id'   => 'tab_content',
		'type' => 'wysiwyg',
	) );
}

add_action( 'cmb2_init', 'bookme_faq_opt_metabox' );
function bookme_faq_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_faq_opt = new_cmb2_box( array(
		'id'            => $prefix . 'faq_opt',
		'title'         => __( 'FAQ Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-faq.php') ),
	) );
	
	$group_field_id = $bookme_faq_opt->add_field( array(
		'id'          => $prefix . 'faq_details',
		'type'        => 'group',
		'description' => __( 'FAQ Details', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'FAQ {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another FAQ', 'cmb2' ),
			'remove_button' => __( 'Remove FAQ', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$bookme_faq_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Title', 'cmb2' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	
	$bookme_faq_opt->add_group_field( $group_field_id, array(
		'name' => __( 'Content', 'cmb2' ),
		'id'   => 'content',
		'type' => 'textarea_small',
	) );

}

add_action( 'cmb2_init', 'bookme_gal_page_opt_metabox' );
function bookme_gal_page_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_gal_page = new_cmb2_box( array(
		'id'            => $prefix . 'gal_page_opt',
		'title'         => __( 'Gallery Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-gallery.php') ),
	) );
	
	$bookme_gal_page->add_field( array(
		'name'       => __( 'Gallery Column', 'cmb2' ),
		'id'         => $prefix . 'gallery_column',
		'type'		 => 'select',
		'show_option_none' => false,
		'options'          => array(
			'3col' => __( '3 Columns', 'cmb2' ),
			'4col'   => __( '4 Columns', 'cmb2' ),
		),
	) );
	
	$bookme_gal_page->add_field( array(
		'name'       => __( 'Gallery Sub Title', 'cmb2' ),
		'id'         => $prefix . 'gallery_page_subtitle',
		'type'       => 'text',
	) );
	
	$bookme_gal_page->add_field( array(
		'name'         => __( 'Upload Images', 'cmb2' ),
		'id'           => $prefix . 'gallery_page_imgs',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
	
}

add_action( 'cmb2_init', 'bookme_portfolio_page_opt_metabox' );
function bookme_portfolio_page_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_portfolio_page = new_cmb2_box( array(
		'id'            => $prefix . 'portfolio_page_opt',
		'title'         => __( 'Portfolio Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-portfolio.php') ),
	) );
	
	$bookme_portfolio_page->add_field( array(
		'name'       => __( 'Portfolio Column', 'cmb2' ),
		'id'         => $prefix . 'portfolio_column',
		'type'		 => 'select',
		'show_option_none' => false,
		'options'          => array(
			'2' => __( '2 Columns', 'cmb2' ),
			'3'   => __( '3 Columns', 'cmb2' ),
		),
	) );
	
	$bookme_portfolio_page->add_field( array(
		'name'       => __( 'Portfolio Sub Title', 'cmb2' ),
		'id'         => $prefix . 'portfolio_page_subtitle',
		'type'       => 'text',
	) );
	
}

add_action( 'cmb2_init', 'bookme_pricing_page_opt_metabox' );
function bookme_pricing_page_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_pricing_page = new_cmb2_box( array(
		'id'            => $prefix . 'pricing_page_opt',
		'title'         => __( 'Pricing Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-pricing.php') ),
	) );
	
	$bookme_pricing_page->add_field( array(
		'name'       => __( 'Pricing Sub Title', 'cmb2' ),
		'id'         => $prefix . 'pricing_page_subtitle',
		'type'       => 'text',
	) );
	
	$bookme_pricing_page->add_field( array(
		'name'     => __( 'Pricing Category', 'cmb2' ),
		'id'       => $prefix . 'pricing_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('pricing_category'), // Taxonomy Slug
	) );
	
}



add_action( 'cmb2_init', 'bookme_team_opt_metabox' );

function bookme_team_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_team_opt = new_cmb2_box( array(
		'id'           => $prefix . 'team_metabox',
		'title'        => __( 'Team Section', 'cmb2' ),
		'object_types' => array( 'page', ),
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-about.php') ),
		'closed'     => true,
	) );

	$bookme_team_opt->add_field( array(
		'name' => __( 'Team Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'team_small_text',
		'type' => 'text_medium',
	) );

	$bookme_team_opt->add_field( array(
		'name' => __( 'Team Section Title', 'cmb2' ),
		'id'   => $prefix . 'team_title',
		'type' => 'text',
	) );

	$bookme_team_opt->add_field( array(
		'name' => __( 'Team Section Description', 'cmb2' ),
		'id'   => $prefix . 'team_desc',
		'type' => 'textarea_small',
	) );

	$bookme_team_opt->add_field( array(
		'name'     => __( 'Team Category', 'cmb2' ),
		'id'       => $prefix . 'team_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('team_category'), // Taxonomy Slug
	) );

}


add_action( 'cmb2_init', 'bookme_post_opt_metabox' );
function bookme_post_opt_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_post_opt = new_cmb2_box( array(
		'id'           => $prefix . 'post_metabox',
		'title'        => __( 'Post Options', 'cmb2' ),
		'object_types' => array( 'post', ),
		'priority'   => 'high',
	) );

	$bookme_post_opt->add_field( array(
		'name' => __( 'Post Color Scheme', 'cmb2' ),
		'id'   => $prefix . 'post_color_scheme',
		'type' => 'colorpicker',
	) );
	
	$bookme_post_opt->add_field( array(
		'name' => __( 'Main Page Title Image Background', 'cmb2' ),
		'description' => __( 'Upload Image as background.', 'cmb2' ),
		'id'   => $prefix . 'post_title_img_bg',
		'type' => 'file',
	) );
	
	$bookme_post_opt->add_field( array(
		'name' => __( 'Main Page Title Color', 'cmb2' ),
		'id'   => $prefix . 'post_title_color',
		'type' => 'colorpicker',
	) );
	
	$bookme_post_opt->add_field( array(
		'name' => __( 'Breadcrumb Color', 'cmb2' ),
		'id'   => $prefix . 'post_breadcrumb_color',
		'type' => 'colorpicker',
	) );

	$bookme_post_opt->add_field( array(
		'name'             => __( 'Post Layout', 'cmb2' ),
		'id'               => $prefix . 'post_layout',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'left_sb' => __( 'Left Sidebar', 'cmb2' ),
			'right_sb'   => __( 'Right Sidebar', 'cmb2' ),
			'fullwidth'     => __( 'Fullwidth', 'cmb2' ),
		),
	) );

}

add_action( 'cmb2_init', 'bookme_post_gallery_format_metabox' );
function bookme_post_gallery_format_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_gallery_format = new_cmb2_box( array(
	    'id'		   => $prefix . 'gallery_format_metabox',
	    'title'        => __('Images Gallery', 'sage'),
	    'object_types' => array( 'post', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'post_format', 'value' => 'gallery' ),
	) );

	$bookme_gallery_format->add_field( array(
		'name'         => __( 'Upload Images', 'cmb2' ),
		'id'           => $prefix . 'gallery_imgs',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

}

add_action( 'cmb2_init', 'bookme_post_video_format_metabox' );
function bookme_post_video_format_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_video_format = new_cmb2_box( array(
	    'id'		   => $prefix . 'video_format_metabox',
	    'title'        => __('Video Options', 'sage'),
	    'object_types' => array( 'post', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'post_format', 'value' => 'video' ),
	) );

	$bookme_video_format->add_field( array(
		'name' 	=> __( 'Video URL', 'cmb2' ),
		'id'   	=> $prefix . 'format_video_url',
		'type' 	=> 'text_url',
	) );

}

add_action( 'cmb2_init', 'bookme_post_quote_format_metabox' );
function bookme_post_quote_format_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_quote_format = new_cmb2_box( array(
	    'id'		   => $prefix . 'quote_format_metabox',
	    'title'        => __('Quote Options', 'sage'),
	    'object_types' => array( 'post', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'post_format', 'value' => 'quote' ),
	) );

	$bookme_quote_format->add_field( array(
		'name' 	=> __( 'Quote Content', 'cmb2' ),
		'id'   	=> $prefix . 'format_quote_content',
		'type' 	=> 'textarea_small',
	) );

}

add_action( 'cmb2_init', 'bookme_post_link_format_metabox' );
function bookme_post_link_format_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_link_format = new_cmb2_box( array(
	    'id'		   => $prefix . 'link_format_metabox',
	    'title'        => __('Link Options', 'sage'),
	    'object_types' => array( 'post', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'post_format', 'value' => 'link' ),
	) );

	$bookme_link_format->add_field( array(
		'name' 	=> __( 'External Link URL', 'cmb2' ),
		'id'   	=> $prefix . 'format_link_url',
		'type' 	=> 'text_url',
	) );

}

add_action( 'cmb2_init', 'bookme_about_barber_page_metabox' );
function bookme_about_barber_page_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_barber_about = new_cmb2_box( array(
	    'id'		   => $prefix . 'barber_page_mb',
	    'title'        => __('About Options', 'sage'),
	    'object_types' => array( 'page', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'page-template', 'value' => array('template-barber.php') ),
	) );
	
	$bookme_barber_about->add_field( array(
		'name'         => __( 'Upload Images', 'cmb2' ),
		'id'           => $prefix . 'barber_about_img',
		'type'         => 'file',
	) );
	
	$bookme_barber_about->add_field( array(
		'name' 	=> __( 'Content', 'cmb2' ),
		'id'   	=> $prefix . 'barber_about_content',
		'type' 	=> 'textarea_small',
	) );
}

add_action( 'cmb2_init', 'bookme_services_barber_page_metabox' );
function bookme_services_barber_page_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_barber_services = new_cmb2_box( array(
	    'id'		   => $prefix . 'barber_services_mb',
	    'title'        => __('Services Options', 'cmb'),
	    'object_types' => array( 'page', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'page-template', 'value' => array('template-barber.php') ),
	) );
	
	$bookme_barber_services->add_field( array(
		'name' => __( 'Services Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'barber_services_small_text',
		'type' => 'text_medium',
	) );

	$bookme_barber_services->add_field( array(
		'name' => __( 'Services Section Title', 'cmb2' ),
		'id'   => $prefix . 'barber_services_title',
		'type' => 'text',
	) );

	$bookme_barber_services->add_field( array(
		'name' => __( 'Services Section Description', 'cmb2' ),
		'id'   => $prefix . 'barber_services_desc',
		'type' => 'textarea_small',
	) );
	
	$bookme_barber_services->add_field( array(
		'name'     => __( 'Services Category', 'cmb2' ),
		'id'       => $prefix . 'barber_services_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('service_category'), // Taxonomy Slug
	) );
}

add_action( 'cmb2_init', 'bookme_schedule_barber_page_metabox' );
function bookme_schedule_barber_page_metabox() {

	$prefix = '_BookmeMB_';

	$bookme_barber_schedule = new_cmb2_box( array(
	    'id'		   => $prefix . 'barber_schedule_mb',
	    'title'        => __('Schedule Options', 'cmb'),
	    'object_types' => array( 'page', ), // Post type
	    'context'      => 'normal',
	    'priority'     => 'high',
	    'show_on'      => array( 'key' => 'page-template', 'value' => array('template-barber.php') ),
	) );
	
	$bookme_barber_schedule->add_field( array(
		'name' => __( 'Schedule Section Small Text', 'cmb2' ),
		'id'   => $prefix . 'barber_schedule_small_text',
		'type' => 'text_medium',
	) );

	$bookme_barber_schedule->add_field( array(
		'name' => __( 'Schedule Section Title', 'cmb2' ),
		'id'   => $prefix . 'barber_schedule_title',
		'type' => 'text',
	) );
	
	$group_field_id = $bookme_barber_schedule->add_field( array(
		'id'          => $prefix . 'barber_schedule',
		'type'        => 'group',
		'description' => __( 'Schedule', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
			'remove_button' => __( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	
	$bookme_barber_schedule->add_group_field( $group_field_id, array(
		'name'       => __( 'Entry Day', 'cmb2' ),
		'id'         => 'day',
		'type'       => 'text_medium',
	) );
	
	$bookme_barber_schedule->add_group_field( $group_field_id, array(
		'name'       => __( 'Entry Time', 'cmb2' ),
		'id'         => 'time',
		'type'       => 'text_medium',
	) );
	
	$bookme_barber_schedule->add_field( array(
		'name' => __( 'Button Text', 'cmb2' ),
		'id'   => $prefix . 'barber_schedule_btn_text',
		'type' => 'text_medium',
	) );
	
	$bookme_barber_schedule->add_field( array(
		'name' => __( 'Button URL', 'cmb2' ),
		'id'   => $prefix . 'barber_schedule_btn_url',
		'type' => 'text_url',
	) );
}

add_action( 'cmb2_init', 'bookme_barber_pricing_opt_metabox' );
function bookme_barber_pricing_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_pricing_page = new_cmb2_box( array(
		'id'            => $prefix . 'barber_pricing_opt',
		'title'         => __( 'Pricing Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-barber.php') ),
	) );
	
	$bookme_pricing_page->add_field( array(
		'name'       => __( 'Pricing Small Text', 'cmb2' ),
		'id'         => $prefix . 'barber_pricing_small_text',
		'type'       => 'text',
	) );
	
	$bookme_pricing_page->add_field( array(
		'name'       => __( 'Pricing Sub Title', 'cmb2' ),
		'id'         => $prefix . 'barber_pricing_subtitle',
		'type'       => 'text',
	) );
	
	$bookme_pricing_page->add_field( array(
		'name'     => __( 'Pricing Category', 'cmb2' ),
		'id'       => $prefix . 'barber_pricing_cat',
		'type'     => 'select',
		'show_option_none' => 'All',
		'options' => bookme_get_term_options('pricing_category'), // Taxonomy Slug
	) );
	
}

add_action( 'cmb2_init', 'bookme_barber_gallery_opt_metabox' );
function bookme_barber_gallery_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_barber_gallery_page = new_cmb2_box( array(
		'id'            => $prefix . 'barber_gallery_opt',
		'title'         => __( 'Gallery Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-barber.php') ),
	) );
	
	$bookme_barber_gallery_page->add_field( array(
		'name'       => __( 'Gallery Small Text', 'cmb2' ),
		'id'         => $prefix . 'barber_gallery_small_text',
		'type'       => 'text',
	) );
	
	$bookme_barber_gallery_page->add_field( array(
		'name'       => __( 'Gallery Sub Title', 'cmb2' ),
		'id'         => $prefix . 'barber_gallery_subtitle',
		'type'       => 'text',
	) );
	
	$bookme_barber_gallery_page->add_field( array(
		'name'       => __( 'Gallery Images', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'         => $prefix . 'barber_gallery_images',
		'type'       => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
}

add_action( 'cmb2_init', 'bookme_whyme_page_opt_metabox' );
function bookme_whyme_page_opt_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_BookmeMB_';

	$bookme_whyme_page = new_cmb2_box( array(
		'id'            => $prefix . 'whyme_opt',
		'title'         => __( 'WhyMe Options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'priority'   => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => array('template-why-me.php') ),
	) );
	
	$bookme_whyme_page->add_field( array(
		'name'       => __( 'WhyMe Small Text', 'cmb2' ),
		'id'         => $prefix . 'whyme_small_text',
		'type'       => 'text',
	) );
	
	$bookme_whyme_page->add_field( array(
		'name'       => __( 'WhyMe Sub Title', 'cmb2' ),
		'id'         => $prefix . 'whyme_subtitle',
		'type'       => 'text',
	) );
	
	$group_field_id = $bookme_whyme_page->add_field( array(
		'id'          => $prefix . 'whyme_entry',
		'type'        => 'group',
		'description' => __( 'WhyMe Entry', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Entry', 'cmb2' ),
			'remove_button' => __( 'Remove Entry', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	
	$bookme_whyme_page->add_group_field( $group_field_id, array(
		'name' => __( 'WhyMe Icon', 'cmb2' ),
		'description' => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'cmb2' ),
		'id'   => 'icon',
		'type' => 'text_small',
	) );
	
	$bookme_whyme_page->add_group_field( $group_field_id, array(
		'name' => __( 'WhyMe Icon Image', 'cmb2' ),
		'description' => __( 'Will replace the icon above', 'cmb2' ),
		'id'   => 'icon_img',
		'type' => 'file',
	) );
	
	$bookme_whyme_page->add_group_field( $group_field_id, array(
		'name'       => __( 'WhyMe Content', 'cmb2' ),
		'id'         => 'content',
		'type'       => 'textarea_small',
	) );
	
}
