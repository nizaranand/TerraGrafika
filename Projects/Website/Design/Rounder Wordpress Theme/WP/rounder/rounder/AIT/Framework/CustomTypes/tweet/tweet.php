<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitTweetPostType()
 {
	register_post_type('ait-tweet',
		array(
			'labels' => array(
			'name'			=> __('Tweets', 'ait'),
			'singular_name' => __('Tweet', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new tweet', 'ait'),
			'edit_item'		=> __('Edit tweet', 'ait'),
			'new_item'		=> __('New tweet', 'ait'),
			'view_item'		=> __('View tweet', 'ait'),
			'search_items'	=> __('Search tweets', 'ait'),
			'not_found'		=> __('No tweets found', 'ait'),
			'not_found_in_trash' => __('No tweets found in Trash', 'ait'),
		),
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'tweet'),
		'supports' => array('title', 'page-attributes', 'editor'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/tweet/tweet.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['tweet'],
		)
	);

	aitTweetTaxonomies();
}



function aitTweetTaxonomies()
{

	register_taxonomy( 'ait-tweet-category', array( 'ait-tweet' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Tweets Categories', 'taxonomy general name', 'ait'),
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
	if(!term_exists( 'Uncategorized Themes', 'ait-tweet-category' )){
		wp_insert_term( 'Uncategorized Themes', 'ait-tweet-category' );
	}
}
add_action( 'init', 'aitTweetPostType' );

$tweetOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-tweet',
	'title' => 'Tweet Options',
	'types' => array('ait-tweet'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));



function aitTweetChangeColumns($cols)
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
add_filter( "manage_ait-tweet_posts_columns", "aitTweetChangeColumns");



function aitTweetCustomColumns($column, $post_id)
{
	global $themeOptions;
	$options = $themeOptions->the_meta();

}
add_action( "manage_posts_custom_column", "aitTweetCustomColumns", 10, 2 );

function aitTweetSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'   => 'category',
		'menu_order' => 'order',
	);
}
add_filter( "manage_edit-ait-tweet_sortable_columns", "aitTweetSortableColumns" );