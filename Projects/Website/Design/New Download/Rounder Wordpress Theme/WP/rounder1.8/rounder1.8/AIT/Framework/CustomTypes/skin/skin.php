<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


function aitSkinPostType()
{
	register_post_type('ait-skin',
		array(
			'labels' => array(
			'name'			=> __('Skins', 'ait'),
			'singular_name' => __('Skin', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new skin', 'ait'),
			'edit_item'		=> __('Edit skin', 'ait'),
			'new_item'		=> __('New skin', 'ait'),
			'view_item'		=> __('View skin', 'ait'),
			'search_items'	=> __('Search skins', 'ait'),
			'not_found'		=> __('No skins found', 'ait'),
			'not_found_in_trash' => __('No skins found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'free-skins'),
		'supports' => array('title', 'thumbnail', 'page-attributes', 'editor'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/skin/skin.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['skin'],
		)
	);

	aitSkinTaxonomies();

	flush_rewrite_rules(false);
}



function aitSkinTaxonomies()
{

	register_taxonomy( 'ait-skin-category', array( 'ait-skin' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Skins Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'skins'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Skins', 'ait-skin-category' )){
		wp_insert_term( 'Uncategorized Skins', 'ait-skin-category' );
	}

	create_metadata_table_skins('ait_skin_category');
}
add_action( 'init', 'aitSkinPostType' );


function aitSkinImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-skin', 'side' );
	add_meta_box('postimagediv', __('Thumbnail', 'ait'), 'post_thumbnail_meta_box', 'ait-skin', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitSkinImageMetabox');


$skinOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-skin',
	'title' => 'Download Options',
	'types' => array('ait-skin'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));



function aitSkinChangeColumns($cols)
{
	$cols = array(
		'cb'         => '<input type="checkbox" />',
		'title'      => __( 'Skin Name', 'ait'),
		'thumbnail'  => __( 'Thumbnail', 'ait'),
		'menu_order' => __( 'Order', 'ait'),
		'category'   => __( 'Skin Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-skin_posts_columns", "aitSkinChangeColumns");



function aitSkinCustomColumns($column, $post_id)
{
	global $skinOptions;
	$options = $skinOptions->the_meta();

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
add_action( "manage_posts_custom_column", "aitSkinCustomColumns", 10, 2 );



function aitSkinSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'     => 'category',
		'menu_order'     => 'order',
	);
}
add_filter( "manage_edit-ait-skin_sortable_columns", "aitSkinSortableColumns" );

/************************** Add term taxonomy meta *****************************************/

add_action( 'ait-skin-category_edit_form_fields', 'edit_skin_category', 10, 2);
add_action( 'ait-skin-category_add_form_fields', 'add_skin_category', 10, 2);
function edit_skin_category($tag, $taxonomy)
{
	$allThemesArgs = array( 'numberposts' => 1000 , 'post_type' => 'ait-theme', 'orderby' => 'title', 'order' => 'ASC' );
	$allThemes = get_posts($allThemesArgs);

	$themeAssociation = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_theme_for_skins', true);

	echo '<tr class="form-field">';
    echo '<th scope="row" valign="top"><label for="ait_theme_for_skins">Theme association</label></th>';
    echo '<td>';

	if(!empty($allThemes)){
		echo '<select name="ait_theme_for_skins" id="ait_theme_for_skins">';
		foreach($allThemes as $key => $theme){
			if($themeAssociation == $theme->ID){
				echo '<option selected="selected" value="'.$theme->ID.'">'.$theme->post_title.'</option>';
			} else {
				echo '<option value="'.$theme->ID.'">'.$theme->post_title.'</option>';
			}
		}
		echo '</select>';
	}

	echo '	<br />';
	echo '	<p class="description">Theme association with this skins category</p>';
    echo '  </td>';
    echo '</tr>';

}
function add_skin_category($tag, $taxonomy)
{
	$allThemesArgs = array( 'numberposts' => 1000 , 'post_type' => 'ait-theme', 'orderby' => 'title', 'order' => 'ASC' );
	$allThemes = get_posts($allThemesArgs);

	$themeAssociation = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_theme_for_skins', true);

	echo '<div class="form-field">';
	echo '<label for="ait_theme_for_skins">Theme association</label>';

	if(!empty($allThemes)){
		echo '<select name="ait_theme_for_skins" id="ait_theme_for_skins">';
		foreach($allThemes as $key => $theme){
			if($themeAssociation == $theme->ID){
				echo '<option selected="selected" value="'.$theme->ID.'">'.$theme->post_title.'</option>';
			} else {
				echo '<option value="'.$theme->ID.'">'.$theme->post_title.'</option>';
			}
		}
		echo '</select>';
	}

	echo '<br />';
  	echo '<p class="description">Theme association with this skins category</p>';
	echo '</div>';

}
add_action( 'created_ait-skin-category', 'save_skin_category', 10, 2);
add_action( 'edited_ait-skin-category', 'save_skin_category', 10, 2);
function save_skin_category($term_id, $tt_id)
{
    if (!$term_id) return;

	if (isset($_POST['ait_theme_for_skins']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_theme_for_skins', $_POST['ait_theme_for_skins']);
}

// create table in your plugin activation function
function create_metadata_table_skins($type) {
	global $wpdb;
	$table_name = $wpdb->prefix . $type . 'meta';

	$variable_name = $type . 'meta';
	$wpdb->$variable_name = $table_name;

	if (!empty ($wpdb->charset))
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
	if (!empty ($wpdb->collate))
		$charset_collate .= " COLLATE {$wpdb->collate}";

	  $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
	  	meta_id bigint(20) NOT NULL AUTO_INCREMENT,
	  	{$type}_id bigint(20) NOT NULL default 0,

		meta_key varchar(255) DEFAULT NULL,
		meta_value longtext DEFAULT NULL,

	  	PRIMARY KEY meta_id (meta_id)
	) {$charset_collate};";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

}
// Edit taxonomy columns
add_filter("manage_edit-ait-skin-category_columns", 'skin_category_columns');

function skin_category_columns($skin_category_columns) {
	$new_columns = array(
		'cb'          => '<input type="checkbox" />',
		'name'        => __('Name', 'ait'),
		'theme'       => __('Theme association', 'ait'),
		'description' => __('Description', 'ait'),
		'slug'        => __('Slug', 'ait'),
		'posts'       => __('Skins', 'ait'),
		);
	return $new_columns;
}

add_filter("manage_ait-skin-category_custom_column", 'manage_skin_category_columns', 10, 3);

function manage_skin_category_columns($out, $column_name, $cat_id) {

	$themeAssociation = get_metadata("ait_skin_category", $cat_id, 'ait_theme_for_skins', true);
	$theme = get_post($themeAssociation);

	switch ($column_name) {
		case 'theme':
			$out .= '<a href="'.$theme->guid.'">'.$theme->post_title.'</a>';
 			break;

		default:
			break;
	}
	return $out;
}

?>