<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitPresentationPostType()
 {
	register_post_type('ait-presentation',
		array(
			'labels' => array(
			'name'			=> __('Presentations', 'ait'),
			'singular_name' => __('Presentation Item', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new presentation item', 'ait'),
			'edit_item'		=> __('Edit presentation item', 'ait'),
			'new_item'		=> __('New item', 'ait'),
			'view_item'		=> __('View item', 'ait'),
			'search_items'	=> __('Search items', 'ait'),
			'not_found'		=> __('No presentation items found', 'ait'),
			'not_found_in_trash' => __('No items found in Trash', 'ait'),
		),
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'ait-presentation'),
		'supports' => array('title', 'thumbnail', 'page-attributes'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/presentation/presentation.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['presentation'],
		)
	);

	aitPresentationTaxonomies();
}



function aitPresentationTaxonomies()
{

	register_taxonomy( 'ait-presentation-category', array( 'ait-presentation' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Presentation Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'ait-presentation-category'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Presentations', 'ait-presentation-category' )){
		wp_insert_term( 'Uncategorized Presentations', 'ait-presentation-category' );
	}
}
add_action( 'init', 'aitPresentationPostType' );



function aitPresentationImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-presentation', 'side' );
	add_meta_box('postimagediv', __('Presentation Item Thumbnail', 'ait'), 'post_thumbnail_meta_box', 'ait-presentation', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitPresentationImageMetabox');



$presentationOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-presentation',
	'title' => 'Presentation Item Options',
	'types' => array('ait-presentation'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));



function aitPresentationChangeColumns($cols)
{
	$cols = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Item Name', 'ait'),
		'thumbnail'   => __( 'Image', 'ait'),
		'description' => __( 'Description', 'ait'),
		'link'        => __( 'Link', 'ait'),
		'menu_order'  => __( 'Order', 'ait'),
		'category'    => __( 'Presentation Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-presentation_posts_columns", "aitPresentationChangeColumns");



function aitPresentationCustomColumns($column, $post_id)
{
	global $presentationOptions;
	$options = $presentationOptions->the_meta();

	switch ($column){
		case "description":
			if(isset($options['description'])){
				echo $options['description'];
			}
			break;
		case "link":
			if(isset($options['link'])){
				echo '<a href="' . esc_url($options['link']) . '">' . esc_url($options['link']) . "</a>";
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitPresentationCustomColumns", 10, 2 );



function aitPresentationSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'   => 'category',
		'menu_order' => 'order',
	);
}
add_filter( "manage_edit-ait-presentation_sortable_columns", "aitPresentationSortableColumns" );
