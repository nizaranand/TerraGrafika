<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitFreebiePostType()
 {
	register_post_type('ait-freebie',
		array(
			'labels' => array(
				'name'               => __('Freebies', 'ait'),
				'singular_name'      => __('Freebie', 'ait'),
				'add_new'            => __('Add new', 'ait'),
				'add_new_item'       => __('Add new freebie', 'ait'),
				'edit_item'          => __('Edit freebie', 'ait'),
				'new_item'           => __('New freebie', 'ait'),
				'view_item'          => __('View freebie', 'ait'),
				'search_items'       => __('Search freebies', 'ait'),
				'not_found'          => __('No freebies found', 'ait'),
				'not_found_in_trash' => __('No freebies found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'freebies'),
		'supports' => array('title', 'thumbnail', 'page-attributes', 'editor'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/freebie/freebie.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['freebie'],
		)
	);

	aitFreebieTaxonomies();

	flush_rewrite_rules(false);
}



function aitFreebieTaxonomies()
{

	register_taxonomy( 'ait-freebie-category', array( 'ait-freebie' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Freebies Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'freebies-cat'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Freebies', 'ait-freebie-category' )){
		wp_insert_term( 'Uncategorized Freebies', 'ait-freebie-category' );
	}
}
add_action( 'init', 'aitFreebiePostType' );


function aitFreebieImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-freebie', 'side' );
	add_meta_box('postimagediv', __('Thumbnail', 'ait'), 'post_thumbnail_meta_box', 'ait-freebie', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitFreebieImageMetabox');


$freebieOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-freebie',
	'title' => __('Download Options', 'ait'),
	'types' => array('ait-freebie'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));



function aitFreebieChangeColumns($cols)
{
	$cols = array(
		'cb'		=> '<input type="checkbox" />',
		'title'		=> __( 'Freebie Name', 'ait'),
		'thumbnail' => __( 'Thumbnail', 'ait'),
		'menu_order' => __( 'Order', 'ait'),
		'category'  => __( 'Freebie Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-freebie_posts_columns", "aitFreebieChangeColumns");



function aitFreebieCustomColumns($column, $post_id)
{
	global $freebieOptions;
	$options = $freebieOptions->the_meta();
}

add_action( "manage_posts_custom_column", "aitFreebieCustomColumns", 10, 2 );



function aitFreebieSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'   => 'category',
		'menu_order' => 'order',
	);
}
add_filter( "manage_edit-ait-freebie_sortable_columns", "aitFreebieSortableColumns" );