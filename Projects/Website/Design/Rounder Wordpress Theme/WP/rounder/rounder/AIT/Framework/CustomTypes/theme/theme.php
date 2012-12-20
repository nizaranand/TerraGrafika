<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitThemePostType()
 {
	register_post_type('ait-theme',
		array(
			'labels' => array(
			'name'			=> __('Themes', 'ait'),
			'singular_name' => __('Theme', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new theme', 'ait'),
			'edit_item'		=> __('Edit theme', 'ait'),
			'new_item'		=> __('New theme', 'ait'),
			'view_item'		=> __('View theme', 'ait'),
			'search_items'	=> __('Search themes', 'ait'),
			'not_found'		=> __('No themes found', 'ait'),
			'not_found_in_trash' => __('No themes found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'wordpress-themes'),
		'supports' => array('title', 'page-attributes', 'editor', 'thumbnail'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/theme/theme.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['theme'],
		)
	);

	aitThemeTaxonomies();

	flush_rewrite_rules(false);
}



function aitThemeTaxonomies()
{

	register_taxonomy( 'ait-theme-category', array( 'ait-theme' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Themes Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'themes'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Themes', 'ait-theme-category' )){
		wp_insert_term( 'Uncategorized Themes', 'ait-theme-category' );
	}
}
add_action( 'init', 'aitThemePostType' );

$themeOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-theme',
	'title' => 'Theme Options',
	'types' => array('ait-theme'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));

function aitThemeFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-theme', 'side' );
	add_meta_box('postimagediv', __('Medium (blog) image', 'ait'), 'post_thumbnail_meta_box', 'ait-theme', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitThemeFeaturedImageMetabox');

function aitThemeChangeColumns($cols)
{
	$cols = array(
		'cb'         => '<input type="checkbox" />',
		'title'      => __( 'Theme Name', 'ait'),
		'thumbnail'  => __( 'Thumbnail', 'ait'),
		'menu_order' => __( 'Order', 'ait'),
		'category'   => __( 'Theme Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-theme_posts_columns", "aitThemeChangeColumns");



function aitThemeCustomColumns($column, $post_id)
{
	global $themeOptions;
	$options = $themeOptions->the_meta();

	/*
	switch ($column){
		case "description":
			if(isset($options['description'])){
				echo $options['description'];
			}
			break;
		case "link":
			if(isset($options['link'])){
				echo '<a href="' . htmlspecialchars($options['link']) . '">' . htmlspecialchars($options['link']) . "</a>";
			}
			break;
	}
	 *
	 */
}
add_action( "manage_posts_custom_column", "aitThemeCustomColumns", 10, 2 );

function aitThemeSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'   => 'category',
		'menu_order' => 'order',
	);
}
add_filter( "manage_edit-ait-theme_sortable_columns", "aitThemeSortableColumns" );