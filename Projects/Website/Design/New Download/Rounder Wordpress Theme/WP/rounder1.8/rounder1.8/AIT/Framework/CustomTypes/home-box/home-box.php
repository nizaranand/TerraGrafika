<?php

/**
 * AIT Theme Framework
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 * Developer: Cifro Nix (http://about.me/Cifro)
 */



function aitHomeBoxPostType()
{
	register_post_type('ait-home-box',
		array(
			'labels' => array(
				'name'			=> __('Home boxes', 'ait'),
				'singular_name' => __('Home box', 'ait'),
				'add_new'		=> __('Add new', 'ait'),
				'add_new_item'	=> __('Add new box', 'ait'),
				'edit_item'		=> __('Edit box', 'ait'),
				'new_item'		=> __('New box', 'ait'),
				'not_found'		=> __('No boxes found', 'ait'),
				'not_found_in_trash' => __('No boxes found in Trash', 'ait'),
				'menu_name'		=> __('Home Boxes', 'ait'),
			),
			'description' => __('Manipulating with home boxes on homepage', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/home-box/home-box.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['home-box'],
		)
	);

	flush_rewrite_rules(false);
}
add_action( 'init', 'aitHomeBoxPostType' );

function aitFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-home-box', 'side' );
	add_meta_box('postimagediv', __('Image', 'ait'), 'post_thumbnail_meta_box', 'ait-home-box', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitFeaturedImageMetabox');


$homeBoxOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-home-box',
	'title' => __('Options for featured box', 'ait'),
	'types' => array('ait-home-box'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitHomeBoxChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', 'ait'),
		'thumbnail'		=> __( 'Image', 'ait'),
		'isBigBox'		=> __( 'Large box', 'ait'),
		'menu_order'	=> __( 'Order', 'ait'),
		'boxLink'		=> __( 'Link', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-home-box_posts_columns", "aitHomeBoxChangeColumns" );



function aitHomeBoxCustomColumns($column, $postId)
{
	global $homeBoxOptions;

	switch($column){
		case "isBigBox":
			$options = $homeBoxOptions->the_meta();

			if(isset($options['isBigBox'])){
				echo "<strong>" . __( "Yes", 'ait') . "</strong>";
			}else{
				echo __( "No", 'ait');
			}
			break;

		case "boxLink":
			$options = $homeBoxOptions->the_meta();

			if(isset($options['boxLink'])){
				echo '<a href="' . htmlspecialchars($options['boxLink']) . '">' . htmlspecialchars($options['boxLink']) . "</a>";
			}
			break;
	}
}
add_action( "manage_posts_custom_column", "aitHomeBoxCustomColumns", 10, 2);