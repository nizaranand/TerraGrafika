<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitTopStripPostType()
{
	register_post_type( 'ait-top-strip',
		array(
			'labels' => array(
				'name'			=> __('Top strips', 'ait'),
				'singular_name' => __('Top strip', 'ait'),
				'add_new'		=> __('Add new', 'ait'),
				'add_new_item'	=> __('Add new strip', 'ait'),
				'edit_item'		=> __('Edit strip', 'ait'),
				'new_item'		=> __('New strip', 'ait'),
				'not_found'		=> __('No strips found', 'ait'),
				'not_found_in_trash' => __('No strips found in Trash', 'ait'),
				'menu_name'		=> __('Top-Strips', 'ait'),
			),
			'description' => __('Manipulating with top strips', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/top-strip/top-strip.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['top-strip'],
		)
	);
	aitTopStripTaxonomies();

	//flush_rewrite_rules();
}


function aitTopStripTaxonomies()
{

	register_taxonomy( 'ait-top-strip-category', array( 'ait-top-strip' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Top Strip Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array( 'slug' => 'ait-top-strip-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Top-Strips', 'ait-top-strip-category' )){
		wp_insert_term( 'Uncategorized Top-Strips', 'ait-top-strip-category' );
	}
}
add_action( 'init', 'aitTopStripPostType');



function aitTopStripFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-top-strip', 'side' );
	add_meta_box('postimagediv', __('Icon for strip', 'ait'), 'post_thumbnail_meta_box', 'ait-top-strip', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitTopStripFeaturedImageMetabox');


$topStripOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-top-strip',
	'title' => __('Options for top strip', 'ait'),
	'types' => array('ait-top-strip'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));


function aitTopStripChangeColumns($cols)
{
	$cols = array(
		'cb'             => '<input type="checkbox" />',
		'title'          => __( 'Title', 'ait'),
		'top_strip_text' => __( 'Text', 'ait'),
		'top_strip_link' => __( 'Link', 'ait'),
		'thumbnail'      => __( 'Image', 'ait'),
		'menu_order'     => __( 'Order', 'ait'),
		'category'       => __( 'Category', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-top-strip_posts_columns", "aitTopStripChangeColumns");



function aitTopStripCustomColumns($column, $post_id)
{
	global $topStripOptions;

	$options = $topStripOptions->the_meta();

	switch ($column){
		case "top_strip_text":

			if(isset($options['stripText'])){
				echo "<p>".$options['stripText']."</p>";
			}
			unset($options);
			break;

		case "top_strip_link":

			if(isset($options['stripLink'])){
				echo '<a href="' . htmlspecialchars($options['stripLink']) . '">' . htmlspecialchars($options['stripLink']) . "</a>";
			}
			unset($options);
			break;
	}
}
add_action( "manage_posts_custom_column", "aitTopStripCustomColumns", 10, 2);

function aitTopStripSortableColumns()
{
	return array(
		'title'          => 'title',
		'top_strip_text' => 'top_strip_text',
		'top_strip_link' => 'top_strip_link'
	);
}

add_filter( "manage_edit_ait-top-strip_sortable_columns", "aitTopStripSortableColumns" );