<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


function aitVideoPostType() {
	register_post_type('ait-video',
		array(
			'labels' => array(
			'name'			=> __('Videos', 'ait'),
			'singular_name' => __('Video', 'ait'),
			'add_new'		=> __('Add New Video', 'ait'),
			'add_new_item'	=> __('Add New Video', 'ait'),
			'edit_item'		=> __('Edit Video', 'ait'),
			'new_item'		=> __('New Video', 'ait'),
			'view_item'		=> __('View Video', 'ait'),
			'search_items'	=> __('Search Videos', 'ait'),
			'not_found'		=> __('No Video Items found', 'ait'),
			'not_found_in_trash' => __('No items found in Trash', 'ait'),
		),
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'ait-video'),
		'supports' => array('title', 'thumbnail', 'page-attributes'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/video/video.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['video'],
		)
	);

	aitVideoTaxonomies();
}



function aitVideoTaxonomies()
{
	register_taxonomy( 'ait-video-category', array( 'ait-video' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Videos Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'ait-video-category'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Videos', 'ait-video-category' )){
		wp_insert_term( 'Uncategorized Videos', 'ait-video-category' );
	}
}

add_action( 'init', 'aitVideoPostType' );

$videoOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-video',
	'title' => 'Slider Item Options',
	'types' => array('ait-video'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));


function aitVideoChangeColumns($cols)
{
  $cols = array(
	'cb'          => '<input type="checkbox" />',
	'title'       => __( 'Title', 'ait'),
	'thumbnail'   => __( 'Thumbnail Image', 'ait'),
	'description' => __( 'Description', 'ait'),
	'video_link'  => __( 'Video Link', 'ait'),
	'menu_order'  => __( 'Order', 'ait'),
	'category'    => __( 'Video Category', 'ait'),
  );

  return $cols;
}
add_filter( "manage_ait-video_posts_columns", "aitVideoChangeColumns");

function aitVideoCustomColumns($column, $post_id)
{
	global $videoOptions;
	$options = $videoOptions->the_meta();

	switch ($column){
		case "description":
			if(isset($options['description'])){
				echo $options['description'];
			}
			break;
		case "video_link":
			if(isset($options['videoLink'])){
				echo '<a href="'.htmlspecialchars($options['videoLink']).'">'.htmlspecialchars($options['videoLink']).'</a>';
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitVideoCustomColumns", 10, 2 );

function aitVideoSortableColumns()
{
  return array(
    'title'      => 'title',
    'category'     => 'category',
    'menu_order'     => 'morder',
  );
}
add_filter( "manage_edit-ait-video_sortable_columns", "aitVideoSortableColumns" );

function aitVideoFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-video', 'side' );
	add_meta_box('postimagediv', __('Thumbnail Image', 'ait'), 'post_thumbnail_meta_box', 'ait-video', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitVideoFeaturedImageMetabox');