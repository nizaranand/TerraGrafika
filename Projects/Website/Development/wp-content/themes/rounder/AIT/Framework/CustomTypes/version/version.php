<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitVersionPostType()
 {
	register_post_type('ait-version',
		array(
			'labels' => array(
			'name'			=> __('Notifications', 'ait'),
			'singular_name' => __('Notification', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new notification', 'ait'),
			'edit_item'		=> __('Edit notification', 'ait'),
			'new_item'		=> __('New notification', 'ait'),
			'view_item'		=> __('View notification', 'ait'),
			'search_items'	=> __('Search notification', 'ait'),
			'not_found'		=> __('No notifications found', 'ait'),
			'not_found_in_trash' => __('No notifications found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'notifications'),
		'supports' => array('title', 'page-attributes', 'editor'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/version/version.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['version'],
		)
	);

	aitVersionTaxonomies();

	flush_rewrite_rules(false);
}



function aitVersionTaxonomies()
{

	register_taxonomy( 'ait-version-category', array( 'ait-version' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Notifications Categories', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Category', 'ait'),
			'all_items'		=> __( 'All Gategories', 'ait'),
			'parent_item'	=> __( 'Parent Category', 'ait'),
			'parent_item_colon' => __( 'Parent Category:', 'ait'),
			'edit_item'		=> __( 'Edit Category', 'ait'),
			'update_item'	=> __( 'Update Gategory', 'ait'),
			'add_new_item'	=> __( 'Add New Category', 'ait'),
			'new_item_name' => __( 'New Category Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'log'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Notifications', 'ait-version-category' )){
		wp_insert_term( 'Uncategorized Notifications', 'ait-version-category' );
	}
}
add_action( 'init', 'aitVersionPostType' );


$versionOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-version',
	'title' => 'Notification Options',
	'types' => array('ait-version'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));


function aitVersionChangeColumns($cols)
{
	$cols = array(
		'cb'        => '<input type="checkbox" />',
		'title_cat' => __( 'Notification Name', 'ait'),
		'content'   => __( 'Content', 'ait'),
		'category'  => __( 'Notification Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-version_posts_columns", "aitVersionChangeColumns");

function aitVersionCustomColumns($column, $post_id)
{

	switch ($column){
		case "title_cat":
			$post = (get_post($post_id));
			$terms = wp_get_post_terms($post->ID, "ait-version-category");
			$edit_link = get_edit_post_link($post->ID);
			if(count($terms)>0){
				echo '<a href="'.$edit_link.'">' . $post->post_title . " - " . $terms[0]->name . '</a>';
			} else {
				echo '<a href="'.$edit_link.'">' . $post->post_title . '</a>';
			}
			unset($post);
			break;
	}

}
add_action( "manage_posts_custom_column", "aitVersionCustomColumns", 10, 2 );
