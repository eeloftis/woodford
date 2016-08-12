<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "bookme_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'bookme_option',
        'use_cdn' => TRUE,
        'display_name' => 'BookMe',
        'display_version' => '1.0',
        'page_slug' => 'bookme-options',
        'page_title' => 'BookMe Options',
        'update_notice' => TRUE,
        'intro_text' => '<div class="clearfix"><div class="option_tab"><div class="tab-panel"><a href="http://demo.puriwp.com/bookme/documentation">Theme Documentation</a></div><div class="tab-panel"><a href="http://support.puriwp.com">Theme Support</a></div><div class="tab-panel"><a href="http://themeforest.net/user/minimalthemes/portfolio?WT.ac=item_portfolio&WT.seg_1=item_portfolio&WT.z_author=minimalthemes">Theme Collection</a></div></div></div>',
        'footer_text' => false,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'BookMe Options',
        'menu_icon' => get_template_directory_uri() . '/images/theme-options-icon.png',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'page_priority' => 59,
        'page_icon' => 'icon-themes',
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'dev_mode'  => FALSE
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */
     
    Redux::setSection( $opt_name, array(
        'title'  => __( 'General', 'redux-framework-demo' ),
        'id'     => 'general',
        'icon'   => 'el el-wrench-alt',
        'fields' => array(
            array(
                'id'       => 'site_favicon',
                'type'     => 'media', 
                'url'      => true,
                'title'    => __('Favicon', 'redux-framework-demo'),
                'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                'default'  => array( 'url' => get_template_directory_uri() . '/images/bookme.ico' ),
			),
            array(
                'id'       => 'site_layout',
                'type'     => 'select',
                'title'    => __( 'Select Default Site Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'sb_left' => '2 column with left sidebar',
                    'sb_right' => '2 column with right sidebar',
                    'fwd' => 'Fullwidth',
                ),
                'default'  => 'sb_right'
            ),
            array(
                'id'       => 'color_scheme',
                'type'     => 'color',
                'title'    => __( 'Default Color Scheme', 'redux-framework-demo' ),
                'default'  => '#9f8447',
            ),
            array(
                'id'       => 'hover_color',
                'type'     => 'color',
                'title'    => __( 'Hover Button color', 'redux-framework-demo' ),
                'default'  => '#9f8447',
            ),
            array(
                'id'       => 'page_title_bg',
                'type'     => 'media', 
                'url'      => true,
                'title'    => __('Page Title Image Background', 'redux-framework-demo'),
                'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                'default'  => array( 'url' => get_template_directory_uri() . '/images/navigation_01.png' ),
			),
			array(
                'id'       => 'page_title_color',
                'type'     => 'color',
                'title'    => __( 'Page Title color', 'redux-framework-demo' ),
                'default'  => '#333333',
            ),
            array(
                'id'       => 'breadcrumb_color',
                'type'     => 'color',
                'title'    => __( 'Breadcrumb color', 'redux-framework-demo' ),
                'default'  => '#9f8447',
            ),
            array(
                'id'       => 'wow_effect',
                'type'     => 'switch',
                'title'    => __( 'WOW Effect Animation', 'redux-framework-demo' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
			array(
                'id'       => 'retina_image',
                'type'     => 'switch',
                'title'    => __( 'Retina Ready', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom CSS', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => "#header{\n   margin: 0 auto;\n}"
            ),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
        )
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
				'output'      => array( 'body', 'p' ),
                'google'   => true,
            ),
            array(
                'id'          => 'h1-typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h1', 'redux-framework-demo' ),
                'font-backup' => true,
                'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => true,  // Defaults to false
                'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'h1' ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'    => array( 'h1' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
            ),
			array(
                'id'          => 'h2-typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h2', 'redux-framework-demo' ),
                'font-backup' => true,
                'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => true,  // Defaults to false
                'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'h2' ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'    => array( 'h2' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
            ),
			array(
                'id'          => 'h3-typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h3', 'redux-framework-demo' ),
                'font-backup' => true,
                'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => true,  // Defaults to false
                'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'h3' ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'    => array( 'h3' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
            ),
			array(
                'id'          => 'h4-typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h4', 'redux-framework-demo' ),
                'font-backup' => true,
                'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => true,  // Defaults to false
                'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'h4' ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'    => array( 'h4' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
            ),
			array(
                'id'          => 'h5-typography',
                'type'        => 'typography',
                'title'       => __( 'Typography h5', 'redux-framework-demo' ),
                'font-backup' => true,
                'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                //'subsets'       => false, // Only appears if google is true and subsets not set to false
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => true,  // Defaults to false
                'letter-spacing'=> true,  // Defaults to false
                'color'         => false,
                //'preview'       => false, // Disable the previewer
                'all_styles'  => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'      => array( 'h5' ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'    => array( 'h5' ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'       => 'px',
                // Defaults to px
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header', 'redux-framework-demo' ),
        'id'     => 'header',
        'icon'   => 'el el-th-large',
        'fields' => array(
            array(
                'id'       => 'bg_header',
                'type'     => 'color',
                'title'    => __( 'Default Background header', 'redux-framework-demo' ),
                'default'  => '#ffffff',
            ),
        	array(
                'id'       => 'header_logo',
                'type'     => 'media', 
                'url'      => true,
                'title'    => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
			),
			array(
                'id'       => 'header_social_icon',
                'type'     => 'switch',
                'title'    => __( 'Header Social Icon, Enable to show', 'redux-framework-demo' ),
                'subtitle' => __( 'Set your social media account <a href="#">here</a>', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_quote',
                'type'     => 'switch',
                'title'    => __( 'Header Quote, Enable to show', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'header_quote_text',
                'type'     => 'text',
                'required' => array( 'header_quote', '=', true ),
                'title'    => __( 'Header Quote Text', 'redux-framework-demo' ),
                'default'  => 'Absolutely Free Quotation Now',
            ),
            array(
                'id'       => 'header_quote_phone',
                'type'     => 'text',
                'required' => array( 'header_quote', '=', true ),
                'title'    => __( 'Header Quote Phone', 'redux-framework-demo' ),
                'default'  => '215 123 4567',
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Social Media', 'redux-framework-demo' ),
        'id'     => 'soc_med',
        'desc'   => __( 'Social Media Account.', 'redux-framework-demo' ),
        'icon'   => 'el el-group',
        'fields' => array(
        	array(
                'id'       => 'facebook_url',
                'type'     => 'text',
                'title'    => __( 'Facebook URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your facebook page url.', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'http://facebook.com',
            ),
            array(
                'id'       => 'twitter_url',
                'type'     => 'text',
                'title'    => __( 'Twitter URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your twitter page url.', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'http://twitter.com',
            ),
            array(
                'id'       => 'google_url',
                'type'     => 'text',
                'title'    => __( 'Google+ URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your google+ page url.', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'http://google.com',
            ),
            array(
                'id'       => 'instagram_url',
                'type'     => 'text',
                'title'    => __( 'Instagram URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your instagram page url.', 'redux-framework-demo' ),
                'validate' => 'url',
            ),
            array(
                'id'       => 'linkedin_url',
                'type'     => 'text',
                'title'    => __( 'Linkedin URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your linkedin page url.', 'redux-framework-demo' ),
                'validate' => 'url',
            ),
            array(
                'id'       => 'youtube_url',
                'type'     => 'text',
                'title'    => __( 'Youtube URL', 'redux-framework-demo' ),
                'desc'     => __( 'Add your youtube page url.', 'redux-framework-demo' ),
                'validate' => 'url',
            ),
        )
    ) );
    
    // -> START Page Selection
    Redux::setSection( $opt_name, array(
        'title' => __( 'Page', 'redux-framework-demo' ),
        'id'    => 'page_opt',
        'icon'  => 'el el-list-alt'
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Contact', 'redux-framework-demo' ),
        'id'     => 'contact',
        'desc'   => __( 'Contact Info.', 'redux-framework-demo' ),
        'icon'	 => 'el el-envelope',
        'subsection' => true,
        'fields' => array(
			array(
                'id'       => 'contact_small_text',
                'type'     => 'text',
                'title'    => __( 'Contact small text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'contact_form_title',
                'type'     => 'text',
                'title'    => __( 'Contact Form Title', 'redux-framework-demo' ),
			),
			array(
                'id'=>'contact_address',
                'type' => 'textarea',
                'title' => __('Address', 'redux-framework-demo'), 
            ),
			array(
                'id'       => 'contact_phone1',
                'type'     => 'text',
                'title'    => __( 'Phone 1', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'contact_phone2',
                'type'     => 'text',
                'title'    => __( 'Phone 2', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'contact_email',
                'type'     => 'text',
                'title'    => __( 'Email', 'redux-framework-demo' ),
				'validate' => 'email',
			),
			array(
                'id'       => 'contact_map_lat',
                'type'     => 'text',
                'title'    => __( 'Map Latitude', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'contact_map_long',
                'type'     => 'text',
                'title'    => __( 'Map Longitude', 'redux-framework-demo' ),
			),
		),
	) );
	
	Redux::setSection( $opt_name, array(
        'title'  => __( 'Service Archive', 'redux-framework-demo' ),
        'id'     => 'service_archive',
        'desc'   => __( 'Service Archive Page Options', 'redux-framework-demo' ),
        'icon'	 => 'el el-cogs',
        'subsection' => true,
        'fields' => array(
        	array(
                'id'       => 'service_archive_title',
                'type'     => 'text',
                'title'    => __( 'Archive Page Title', 'redux-framework-demo' ),
			),
			array(         
				'id'       => 'service_archive_content_bg',
				'type'     => 'background',
				'title'    => __('Archive Content Background', 'redux-framework-demo'),
				'subtitle' => __('Archive Content background with image, color, etc.', 'redux-framework-demo'),
			),
			array(
                'id'       => 'service_archive_content_small_text',
                'type'     => 'text',
                'title'    => __( 'Archive Content Small Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_archive_content_title',
                'type'     => 'text',
                'title'    => __( 'Archive Content Title', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_archive_content_description',
                'type'     => 'textarea',
                'title'    => __( 'Archive Content Description', 'redux-framework-demo' ),
			),
			array(
				'id' => 'service_details1_start',
				'type' => 'section',
				'title' => __('Service Details 1', 'redux-framework-demo'),
				'indent' => true 
			),
			array(         
				'id'       => 'service_details1_bg',
				'type'     => 'background',
				'title'    => __('Service Details 1 Background', 'redux-framework-demo'),
				'subtitle' => __('Service Details 1 background with image, color, etc.', 'redux-framework-demo'),
			),
			array(
                'id'       => 'service_details1_icon',
                'type'     => 'text',
                'title'    => __( 'Icon', 'redux-framework-demo' ),
                'desc'	   => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details1_icon_color',
                'type'     => 'color',
                'title'    => __( 'Icon 1 Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details1_icon_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Icon Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload Image as icon . This will replace the icon above', 'redux-framework-demo' ),
            ),
			array(
                'id'       => 'service_details1_small_text',
                'type'     => 'text',
                'title'    => __( 'Small Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details1_small_text_color',
                'type'     => 'color',
                'title'    => __( 'Small Text Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details1_title',
                'type'     => 'text',
                'title'    => __( 'Title', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details1_title_color',
                'type'     => 'color',
                'title'    => __( 'Title Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details1_content',
                'type'     => 'textarea',
                'title'    => __( 'Content', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details1_content_color',
                'type'     => 'color',
                'title'    => __( 'Content Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
            array(
                'id'       => 'service_details1_readmore_tex',
                'type'     => 'text',
                'title'    => __( 'Read More Button Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details1_readmore_url',
                'type'     => 'text',
                'title'    => __( 'Read More Button URL', 'redux-framework-demo' ),
                'validate' => 'url',
			),
			array(
                'id'       => 'service_details1_readmore_color',
                'type'     => 'color',
                'title'    => __( 'Read More Button Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
				'id'     => 'service_details1_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id' => 'service_details2_start',
				'type' => 'section',
				'title' => __('Service Details 2', 'redux-framework-demo'),
				'indent' => true 
			),
			array(         
				'id'       => 'service_details2_bg',
				'type'     => 'background',
				'title'    => __('Service Details 2 Background', 'redux-framework-demo'),
				'subtitle' => __('Service Details 2 background with image, color, etc.', 'redux-framework-demo'),
			),
			array(
                'id'       => 'service_details2_icon',
                'type'     => 'text',
                'title'    => __( 'Icon', 'redux-framework-demo' ),
                'desc'	   => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details2_icon_color',
                'type'     => 'color',
                'title'    => __( 'Icon 2 Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details2_icon_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Icon Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload Image as icon . This will replace the icon above', 'redux-framework-demo' ),
            ),
			array(
                'id'       => 'service_details2_small_text',
                'type'     => 'text',
                'title'    => __( 'Small Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details2_small_text_color',
                'type'     => 'color',
                'title'    => __( 'Small Text Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details2_title',
                'type'     => 'text',
                'title'    => __( 'Title', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details2_title_color',
                'type'     => 'color',
                'title'    => __( 'Title Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details2_content',
                'type'     => 'textarea',
                'title'    => __( 'Content', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details2_content_color',
                'type'     => 'color',
                'title'    => __( 'Content Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
            array(
                'id'       => 'service_details2_readmore_tex',
                'type'     => 'text',
                'title'    => __( 'Read More Button Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details2_readmore_url',
                'type'     => 'text',
                'title'    => __( 'Read More Button URL', 'redux-framework-demo' ),
                'validate' => 'url',
			),
			array(
                'id'       => 'service_details2_readmore_color',
                'type'     => 'color',
                'title'    => __( 'Read More Button Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
				'id'     => 'service_details2_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id' => 'service_details3_start',
				'type' => 'section',
				'title' => __('Service Details 3', 'redux-framework-demo'),
				'indent' => true 
			),
			array(         
				'id'       => 'service_details3_bg',
				'type'     => 'background',
				'title'    => __('Service Details 3 Background', 'redux-framework-demo'),
				'subtitle' => __('Service Details 3 background with image, color, etc.', 'redux-framework-demo'),
			),
			array(
                'id'       => 'service_details3_icon',
                'type'     => 'text',
                'title'    => __( 'Icon', 'redux-framework-demo' ),
                'desc'	   => __( 'Fontawesome icon code. i.e: fa-home. You can get the code <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details3_icon_color',
                'type'     => 'color',
                'title'    => __( 'Icon 3 Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details3_icon_img',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Icon Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload Image as icon . This will replace the icon above', 'redux-framework-demo' ),
            ),
			array(
                'id'       => 'service_details3_small_text',
                'type'     => 'text',
                'title'    => __( 'Small Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details3_small_text_color',
                'type'     => 'color',
                'title'    => __( 'Small Text Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details3_title',
                'type'     => 'text',
                'title'    => __( 'Title', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details3_title_color',
                'type'     => 'color',
                'title'    => __( 'Title Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
                'id'       => 'service_details3_content',
                'type'     => 'textarea',
                'title'    => __( 'Content', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details3_content_color',
                'type'     => 'color',
                'title'    => __( 'Content Font Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
            array(
                'id'       => 'service_details3_readmore_tex',
                'type'     => 'text',
                'title'    => __( 'Read More Button Text', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'service_details3_readmore_url',
                'type'     => 'text',
                'title'    => __( 'Read More Button URL', 'redux-framework-demo' ),
                'validate' => 'url',
			),
			array(
                'id'       => 'service_details3_readmore_color',
                'type'     => 'color',
                'title'    => __( 'Read More Button Color', 'redux-framework-demo' ),
                //'output'   => array( 'body' ),
            ),
			array(
				'id'     => 'service_details3_end',
				'type'   => 'section',
				'indent' => false,
			),
        ),
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'  => __( '404 Error', 'redux-framework-demo' ),
        'id'     => 'error404',
        'desc'   => __( '404 Page Options.', 'redux-framework-demo' ),
        'icon'	 => 'el el-remove',
        'subsection' => true,
        'fields' => array(
			array(
				'id' => 'error404_left_start',
				'type' => 'section',
				'title' => __('404 Left Content', 'redux-framework-demo'),
				'indent' => true 
			),
			array(
                'id'       => 'error404_left_title',
                'type'     => 'text',
                'title'    => __( 'Left Content Title', 'redux-framework-demo' ),
				'default'  => '404',
			),
			array(
                'id'       => 'error404_left_content',
                'type'     => 'textarea',
                'title'    => __( 'Content', 'redux-framework-demo' ),
				'default'  => 'Page Error File Not Found',
			),
			array(
				'id'     => 'error404_left_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id' => 'error404_right_start',
				'type' => 'section',
				'title' => __('404 Right Content', 'redux-framework-demo'),
				'indent' => true 
			),
			array(
                'id'       => 'error404_right_title',
                'type'     => 'text',
                'title'    => __( 'Right Content Title', 'redux-framework-demo' ),
			),
			array(
                'id'       => 'error404_right_content',
                'type'     => 'editor',
                'title'    => __( 'Editor', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'error404_menu',
                'type'     => 'select',
                'title'    => __( 'Error 404 menu', 'redux-framework-demo' ),
                'data'     => 'menu'
            ),
			 array(
                'id'       => 'error404_btn_text',
                'type'     => 'text',
                'title'    => __( 'Button Text', 'redux-framework-demo' ),
                'default'  => 'Go Home',
            ),
            array(
                'id'       => 'error404_btn_url',
                'type'     => 'text',
                'title'    => __( 'Button URL', 'redux-framework-demo' ),
                'validate' => 'url',
            ),
			array(
				'id'     => 'error404_right_end',
				'type'   => 'section',
				'indent' => false,
			),
		),
	) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer', 'redux-framework-demo' ),
        'id'     => 'footer',
        'icon'   => 'el el-caret-down',
        'fields' => array(
            array(
                'id'       => 'footer_quote',
                'type'     => 'switch',
                'title'    => __( 'Footer Quote, Enable to show', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'footer_quote_small_text',
                'type'     => 'text',
                'required' => array( 'footer_quote', '=', true ),
                'title'    => __( 'Small Text', 'redux-framework-demo' ),
                'default'  => 'Free Estimate',
            ),
            array(
                'id'       => 'footer_quote_conten',
                'type'     => 'editor',
                'title'    => __( 'Editor', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'footer_quote_btn_text',
                'type'     => 'text',
                'required' => array( 'footer_quote', '=', true ),
                'title'    => __( 'Button Text', 'redux-framework-demo' ),
                'default'  => 'Get a Quote',
            ),
            array(
                'id'       => 'footer_quote_btn_url',
                'type'     => 'text',
                'required' => array( 'footer_quote', '=', true ),
                'title'    => __( 'Button URL', 'redux-framework-demo' ),
                'validate' => 'url',
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
