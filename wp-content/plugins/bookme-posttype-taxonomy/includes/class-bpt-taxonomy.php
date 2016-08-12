<?php
/**
 * Bookme add custom taxonomy.
 *
 */
if ( !function_exists('bookme_register_taxonomy') ) {

	function bookme_register_taxonomy() {

		// Clients Categories
		$client_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Client Category' ),
		);

		$client_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $client_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'client-category' ),
		);

		register_taxonomy( 'client_category', array( 'bookme_client' ), $client_cat_args );
		
		// Testimonials Categories
		$testi_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Testimonials Category' ),
		);

		$testi_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $testi_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => false,
		);

		register_taxonomy( 'testi_category', array( 'bookme_testimonial' ), $testi_cat_args );

		// Clients Categories
		$team_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Team Category' ),
		);

		$team_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $team_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'team-category' ),
		);

		register_taxonomy( 'team_category', array( 'bookme_team' ), $team_cat_args );

		// Services Categories
		$service_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Service Category' ),
		);

		$service_cat_args = array(
			'public'            => false,
			'hierarchical'      => true,
			'labels'            => $service_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => false,
			'rewrite'           => false,
		);

		register_taxonomy( 'service_category', array( 'bookme_service' ), $service_cat_args );
		
		// Projects Categories
		$project_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Project Category' ),
		);

		$project_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $project_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
		);

		register_taxonomy( 'project_category', array( 'bookme_project' ), $project_cat_args );
		
		// Projects Type
		$project_type_labels = array(
			'name'              => _x( 'Types', 'bookme' ),
			'singular_name'     => _x( 'Type', 'bookme' ),
			'search_items'      => __( 'Search Types' ),
			'all_items'         => __( 'All Types' ),
			'parent_item'       => __( 'Parent Type' ),
			'parent_item_colon' => __( 'Parent Type:' ),
			'edit_item'         => __( 'Edit Type' ),
			'update_item'       => __( 'Update Type' ),
			'add_new_item'      => __( 'Add New Type' ),
			'new_item_name'     => __( 'New Type Name' ),
			'menu_name'         => __( 'Project Type' ),
		);

		$project_type_args = array(
			'hierarchical'      => true,
			'labels'            => $project_type_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-type' ),
		);

		register_taxonomy( 'project_type', array( 'bookme_project' ), $project_type_args );
		
		// Portfolio Categories
		$portfolio_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Portfolio Category' ),
		);

		$portfolio_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $portfolio_cat_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'portfolio-category' ),
		);

		register_taxonomy( 'portfolio_category', array( 'bookme_portfolio' ), $portfolio_cat_args );
		
		// Pricing Categories
		$pricing_cat_labels = array(
			'name'              => _x( 'Categories', 'bookme' ),
			'singular_name'     => _x( 'Category', 'bookme' ),
			'search_items'      => __( 'Search Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Category' ),
		);

		$pricing_cat_args = array(
			'hierarchical'      => true,
			'labels'            => $pricing_cat_labels,
			'public'			=> false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => false,
		);

		register_taxonomy( 'pricing_category', array( 'bookme_pricing' ), $pricing_cat_args );
		
	}
	add_action('init', 'bookme_register_taxonomy');

}