<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitIconPostType()
{
	register_post_type( 'ait-icon',
		array(
			'labels' => array(
				'name'			=> __('Icon Sets', 'ait'),
				'singular_name' => __('Icon Set', 'ait'),
				'add_new'		=> __('Add new', 'ait'),
				'add_new_item'	=> __('Add new Set', 'ait'),
				'edit_item'		=> __('Edit Set', 'ait'),
				'new_item'		=> __('New Set', 'ait'),
				'not_found'		=> __('No Sets found', 'ait'),
				'not_found_in_trash' => __('No Sets found in Trash', 'ait'),
				'menu_name'		=> __('Icon Sets', 'ait'),
			),
			'description' => __('Manipulating with icon sets', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/icon/icon.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['icon'],
		)
	);
	aitIconTaxonomies();
}


function aitIconTaxonomies()
{

	register_taxonomy( 'ait-icon-category', array( 'ait-icon' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Icon Sets Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array( 'slug' => 'ait-icon-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Icon Sets', 'ait-icon-category' )){
		wp_insert_term( 'Uncategorized Icon Sets', 'ait-icon-category' );
	}
}
add_action( 'init', 'aitIconPostType');



function aitIconFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-icon', 'side' );
	add_meta_box('postimagediv', __('Icon', 'ait'), 'post_thumbnail_meta_box', 'ait-icon', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitIconFeaturedImageMetabox');


$iconOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-icon',
	'title' => __('Options for Icon-Set', 'ait'),
	'types' => array('ait-icon'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));


function aitIconChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', 'ait'),
		'thumbnail'		=> __( 'Image', 'ait'),
		'icon_text'		=> __( 'Text', 'ait'),
		'icon_link'		=> __( 'Link', 'ait'),
		'menu_order'	=> __( 'Order', 'ait'),
		'category'      => __( 'Icon-Set Category', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-icon_posts_columns", "aitIconChangeColumns");

function aitIconCustomColumns($column, $post_id)
{
	global $iconOptions;

	$options = $iconOptions->the_meta();

	switch ($column){
		case "icon_text":
			if(isset($options['iconText'])){
				echo $options['iconText'];
			}
			break;
		case "icon_link":
			if(isset($options['iconLink'])){
				echo '<a href="'.htmlspecialchars($options['iconLink']).'">'.htmlspecialchars($options['iconLink']).'</a>';
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitIconCustomColumns", 10, 2);

function aitIconSortableColumns()
{
	return array(
		'menu_order' => 'order',
		'category'   => 'category',
	);
}

add_filter( "manage_edit-ait-icon_sortable_columns", "aitIconSortableColumns" );