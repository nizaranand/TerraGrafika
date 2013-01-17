<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitGalleryPostType()
{
	register_post_type( 'ait-gallery',
		array(
			'labels' => array(
				'name'			=> __('Grid-Gallery', 'ait'),
				'singular_name' => __('Picture', 'ait'),
				'add_new'		=> __('Add new', 'ait'),
				'add_new_item'	=> __('Add new picture', 'ait'),
				'edit_item'		=> __('Edit Picture', 'ait'),
				'new_item'		=> __('New Picture', 'ait'),
				'not_found'		=> __('No pictures found', 'ait'),
				'not_found_in_trash' => __('No pictures found in Trash', 'ait'),
				'menu_name'		=> __('Grid-Gallery', 'ait'),
			),
			'description' => __('Manipulating with gallery', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/gallery/gallery.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['gallery'],
		)
	);
	aitGalleryTaxonomies();
}


function aitGalleryTaxonomies()
{

	register_taxonomy( 'ait-gallery-category', array( 'ait-gallery' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> __( 'Gallery Categories', 'ait'),
			'singular_name' => __( 'Category', 'ait'),
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
		'rewrite' => array( 'slug' => 'ait-gallery-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Gallery', 'ait-gallery-category' )){
		wp_insert_term( 'Uncategorized Gallery', 'ait-gallery-category' );
	}
}
add_action( 'init', 'aitGalleryPostType');



function aitGalleryFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-gallery', 'side' );
	add_meta_box('postimagediv', __('Thumbnail', 'ait'), 'post_thumbnail_meta_box', 'ait-gallery', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitGalleryFeaturedImageMetabox');


$galleryOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-gallery',
	'title' => __('Options for Picture', 'ait'),
	'types' => array('ait-gallery'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));


function aitGalleryChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', 'ait'),
		'thumbnail'		=> __( 'Thumbnail', 'ait'),
		'large_image'	=> __( 'Large Image', 'ait'),
		'description'	=> __( 'Description', 'ait'),
		'menu_order'	=> __( 'Order', 'ait'),
		'category'      => __( 'Category', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-gallery_posts_columns", "aitGalleryChangeColumns");

function aitGalleryCustomColumns($column, $post_id)
{
	global $galleryOptions;

	$options = $galleryOptions->the_meta();

	switch ($column){
		case "large_image":
			if(isset($options['largeImage'])){
				echo '<img src="'.TIMTHUMB_URL.'?src='.htmlspecialchars($options['largeImage']).'&w=100&h=100" alt="" />';
			}
			break;
		case "description":
			if(isset($options['description'])){
				echo $options['description'];
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitGalleryCustomColumns", 10, 2);

function aitGallerySortableColumns()
{
	return array(
		'title' => 'title',
		'menu_order' => 'order',
		'category' => 'category',
	);
}

add_filter( "manage_edit-ait-gallery_sortable_columns", "aitGallerySortableColumns" );