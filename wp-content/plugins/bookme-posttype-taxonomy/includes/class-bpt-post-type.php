<?php 
/**
 * Bookme add custom post type.
 *
 */
if ( !function_exists('bookme_register_post_type') ) {
	function bookme_register_post_type() {
		$client_labels = array(
			'name'               => _x( 'Clients', 'bookme' ),
			'singular_name'      => _x( 'Client', 'bookme' ),
			'menu_name'          => _x( 'Clients', 'bookme' ),
			'name_admin_bar'     => _x( 'Client', 'bookme' ),
			'add_new'            => _x( 'Add New', 'bookme' ),
			'add_new_item'       => __( 'Add New Client', 'bookme' ),
			'new_item'           => __( 'New Client', 'bookme' ),
			'edit_item'          => __( 'Edit Client', 'bookme' ),
			'view_item'          => __( 'View Client', 'bookme' ),
			'all_items'          => __( 'All Clients', 'bookme' ),
			'search_items'       => __( 'Search Clients', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Clients:', 'bookme' ),
			'not_found'          => __( 'No clients found.', 'bookme' ),
			'not_found_in_trash' => __( 'No clients found in Trash.', 'bookme' )
		);

		$clients = array(
			'labels'             => $client_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'client' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' )
		);

		register_post_type( 'bookme_client', $clients );

		$testimonial_labels = array(
			'name'               => _x( 'Testimonials', 'bookme' ),
			'singular_name'      => _x( 'Testimonial', 'bookme' ),
			'menu_name'          => _x( 'Testimonials', 'bookme' ),
			'name_admin_bar'     => _x( 'Testimonial', 'bookme' ),
			'add_new'            => _x( 'Add New', 'bookme' ),
			'add_new_item'       => __( 'Add New Testimonial', 'bookme' ),
			'new_item'           => __( 'New Testimonial', 'bookme' ),
			'edit_item'          => __( 'Edit Testimonial', 'bookme' ),
			'view_item'          => __( 'View Testimonial', 'bookme' ),
			'all_items'          => __( 'All Testimonials', 'bookme' ),
			'search_items'       => __( 'Search Testimonials', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Testimonials:', 'bookme' ),
			'not_found'          => __( 'No testimonials found.', 'bookme' ),
			'not_found_in_trash' => __( 'No testimonials found in Trash.', 'bookme' )
		);

		$testimonial = array(
			'labels'             => $testimonial_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'testimonial' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bookme_testimonial', $testimonial );

		$team_labels = array(
			'name'               => _x( 'Team', 'bookme' ),
			'singular_name'      => _x( 'Team', 'bookme' ),
			'menu_name'          => _x( 'Team', 'bookme' ),
			'name_admin_bar'     => _x( 'Team', 'bookme' ),
			'add_new'            => _x( 'Add New', 'bookme' ),
			'add_new_item'       => __( 'Add New Team', 'bookme' ),
			'new_item'           => __( 'New Team', 'bookme' ),
			'edit_item'          => __( 'Edit Team', 'bookme' ),
			'view_item'          => __( 'View Team', 'bookme' ),
			'all_items'          => __( 'All Team', 'bookme' ),
			'search_items'       => __( 'Search Team', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Team:', 'bookme' ),
			'not_found'          => __( 'No Team found.', 'bookme' ),
			'not_found_in_trash' => __( 'No Team found in Trash.', 'bookme' )
		);

		$team = array(
			'labels'             => $team_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bookme_team', $team );

		$team_labels = array(
			'name'               => _x( 'Service', 'bookme' ),
			'singular_name'      => _x( 'Services', 'bookme' ),
			'menu_name'          => _x( 'Services', 'bookme' ),
			'name_admin_bar'     => _x( 'Service', 'bookme' ),
			'add_new'            => _x( 'Add Service', 'bookme' ),
			'add_new_item'       => __( 'Add New Service', 'bookme' ),
			'new_item'           => __( 'New Service', 'bookme' ),
			'edit_item'          => __( 'Edit Service', 'bookme' ),
			'view_item'          => __( 'View Service', 'bookme' ),
			'all_items'          => __( 'All Services', 'bookme' ),
			'search_items'       => __( 'Search Services', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Services:', 'bookme' ),
			'not_found'          => __( 'No Services found.', 'bookme' ),
			'not_found_in_trash' => __( 'No Services found in Trash.', 'bookme' )
		);

		$team = array(
			'labels'             => $team_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'service' ),
			//'rewrite'			 => false,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bookme_service', $team );
		
		$projects_labels = array(
			'name'               => _x( 'Projects', 'bookme' ),
			'singular_name'      => _x( 'Project', 'bookme' ),
			'menu_name'          => _x( 'Projects', 'bookme' ),
			'name_admin_bar'     => _x( 'Project', 'bookme' ),
			'add_new'            => _x( 'Add Project', 'bookme' ),
			'add_new_item'       => __( 'Add New Project', 'bookme' ),
			'new_item'           => __( 'New Project', 'bookme' ),
			'edit_item'          => __( 'Edit Project', 'bookme' ),
			'view_item'          => __( 'View Project', 'bookme' ),
			'all_items'          => __( 'All Projects', 'bookme' ),
			'search_items'       => __( 'Search Projects', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Projects:', 'bookme' ),
			'not_found'          => __( 'No Projects found.', 'bookme' ),
			'not_found_in_trash' => __( 'No Projects found in Trash.', 'bookme' )
		);

		$projects = array(
			'labels'             => $projects_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'project' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bookme_project', $projects );
		
		$portfolio_labels = array(
			'name'               => _x( 'Portfolio', 'bookme' ),
			'singular_name'      => _x( 'Portfolio', 'bookme' ),
			'menu_name'          => _x( 'Portfolio', 'bookme' ),
			'name_admin_bar'     => _x( 'Portfolio', 'bookme' ),
			'add_new'            => _x( 'Add Portfolio', 'bookme' ),
			'add_new_item'       => __( 'Add New Portfolio', 'bookme' ),
			'new_item'           => __( 'New Portfolio', 'bookme' ),
			'edit_item'          => __( 'Edit Portfolio', 'bookme' ),
			'view_item'          => __( 'View Portfolio', 'bookme' ),
			'all_items'          => __( 'All Portfolio', 'bookme' ),
			'search_items'       => __( 'Search Portfolio', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Portfolio:', 'bookme' ),
			'not_found'          => __( 'No Portfolio found.', 'bookme' ),
			'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'bookme' )
		);

		$portfolio = array(
			'labels'             => $portfolio_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'bookme_portfolio', $portfolio );
		
		$pricing_labels = array(
			'name'               => _x( 'Pricing', 'bookme' ),
			'singular_name'      => _x( 'Pricing', 'bookme' ),
			'menu_name'          => _x( 'Pricing', 'bookme' ),
			'name_admin_bar'     => _x( 'Pricing', 'bookme' ),
			'add_new'            => _x( 'Add Pricing', 'bookme' ),
			'add_new_item'       => __( 'Add New Pricing', 'bookme' ),
			'new_item'           => __( 'New Pricing', 'bookme' ),
			'edit_item'          => __( 'Edit Pricing', 'bookme' ),
			'view_item'          => __( 'View Pricing', 'bookme' ),
			'all_items'          => __( 'All Pricing', 'bookme' ),
			'search_items'       => __( 'Search Pricing', 'bookme' ),
			'parent_item_colon'  => __( 'Parent Pricing:', 'bookme' ),
			'not_found'          => __( 'No Pricing found.', 'bookme' ),
			'not_found_in_trash' => __( 'No Pricing found in Trash.', 'bookme' )
		);

		$pricing = array(
			'labels'             => $pricing_labels,
			'description'        => __( 'Description.', 'bookme' ),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' )
		);

		register_post_type( 'bookme_pricing', $pricing );
				
		flush_rewrite_rules();

	}
	add_action('init', 'bookme_register_post_type');
}