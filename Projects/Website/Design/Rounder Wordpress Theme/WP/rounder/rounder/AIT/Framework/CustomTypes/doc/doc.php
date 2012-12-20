<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


function aitDocPostType()
{
	register_post_type('ait-doc',
		array(
			'labels' => array(
			'name'			=> __('Documentations', 'ait'),
			'singular_name' => __('Documentation', 'ait'),
			'add_new'		=> __('Add new', 'ait'),
			'add_new_item'	=> __('Add new doc', 'ait'),
			'edit_item'		=> __('Edit doc', 'ait'),
			'new_item'		=> __('New doc', 'ait'),
			'view_item'		=> __('View doc', 'ait'),
			'search_items'	=> __('Search docs', 'ait'),
			'not_found'		=> __('No docs found', 'ait'),
			'not_found_in_trash' => __('No docs found in Trash', 'ait'),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'rewrite' => array('slug' => 'doc'),
		'supports' => array('title', 'thumbnail', 'page-attributes', 'editor', 'excerpt'),
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/doc/doc.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['doc'],
		)
	);

	aitDocTaxonomies();

	flush_rewrite_rules(false);
}



function aitDocTaxonomies()
{

	register_taxonomy( 'ait-doc-category', array( 'ait-doc' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Docs Categories', 'taxonomy general name', 'ait'),
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
		'rewrite' => array('slug' => 'documentation'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Docs', 'ait-doc-category' )){
		wp_insert_term( 'Uncategorized Docs', 'ait-doc-category' );
	}

	create_metadata_table_doc('ait_doc_category');

}
add_action( 'init', 'aitDocPostType' );


function aitDocImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-doc', 'side' );
	add_meta_box('postimagediv', __('Thumbnail', 'ait'), 'post_thumbnail_meta_box', 'ait-doc', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitDocImageMetabox');


$docOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-doc',
	'title' => __('Doc Options', 'ait'),
	'types' => array('ait-doc'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));



function aitDocChangeColumns($cols)
{
	$cols = array(
		'cb'		=> '<input type="checkbox" />',
		'title'		=> __( 'Doc Name', 'ait'),
		'thumbnail' => __( 'Thumbnail', 'ait'),
		'menu_order' => __( 'Order', 'ait'),
		'category'  => __( 'Doc Category', 'ait'),
	);

  return $cols;
}
add_filter( "manage_ait-doc_posts_columns", "aitDocChangeColumns");



function aitDocCustomColumns($column, $post_id)
{
	global $docOptions;
	$options = $docOptions->the_meta();

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
add_action( "manage_posts_custom_column", "aitDocCustomColumns", 10, 2 );



function aitDocSortableColumns()
{
	return array(
		'title'      => 'title',
		'category'     => 'category',
		'menu_order'     => 'order',
	);
}
add_filter( "manage_edit_ait-doc_sortable_columns", "aitDocSortableColumns" );


/************************** Add term taxonomy meta *****************************************/
add_action( 'ait-doc-category_edit_form_fields', 'edit_doc_category', 10, 2);
add_action( 'ait-doc-category_add_form_fields', 'add_doc_category', 10, 2);
function edit_doc_category($tag, $taxonomy)
{
	$thumbnail = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_doc_category_thumbnail', true);

	?>
	<tr class="form-field">
        <th scope="row" valign="top"><label for="ait_doc_category_thumbnail">Thumbnail</label></th>
        <td>
            <input type="text" name="ait_doc_category_thumbnail" id="ait_doc_category_thumbnail" value="<?php echo $thumbnail; ?>" style="width: 80%;"/>
            <input type="button" value="Select Image" class="media-select" id="ait_doc_category_thumbnail_selectMedia" name="ait_doc_category_thumbnail_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Thumbnail for theme</p>
        </td>
    </tr>
    <?php
}
function add_doc_category($tag, $taxonomy)
{
	$thumbnail = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_doc_category_thumbnail', true);

	?>
	<div class="form-field">
		<label for="ait_doc_category_thumbnail">Thumbnail</label>
		<input type="text" name="ait_doc_category_thumbnail" id="ait_doc_category_thumbnail" value="<?php echo $thumbnail; ?>" style="width: 80%;"/>
        <input type="button" value="Select Image" class="media-select" id="ait_doc_category_thumbnail_selectMedia" name="ait_doc_category_thumbnail_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Thumbnail for theme</p>
	</div>
	<?php
}
add_action( 'created_ait-doc-category', 'save_doc_category', 10, 2);
add_action( 'edited_ait-doc-category', 'save_doc_category', 10, 2);
function save_doc_category($term_id, $tt_id)
{
    if (!$term_id) return;

	if (isset($_POST['ait_doc_category_thumbnail']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_doc_category_thumbnail', $_POST['ait_doc_category_thumbnail']);
}

// create table in your plugin activation function
function create_metadata_table_doc($type) {
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

/************************** Add term taxonomy meta theme association *****************************************/

add_action( 'ait-doc-category_edit_form_fields', 'edit_doc_category_theme', 10, 2);
add_action( 'ait-doc-category_add_form_fields', 'add_doc_category_theme', 10, 2);
function edit_doc_category_theme($tag, $taxonomy)
{
	$allThemesArgs = array( 'numberposts' => 1000 , 'post_type' => 'ait-theme', 'orderby' => 'title', 'order' => 'ASC' );
	$allThemes = get_posts($allThemesArgs);

	$themeAssociation = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_theme_for_doc', true);

	echo '<tr class="form-field">';
    echo '<th scope="row" valign="top"><label for="ait_theme_for_doc">Theme association</label></th>';
    echo '<td>';

	if(!empty($allThemes)){
		echo '<select name="ait_theme_for_doc" id="ait_theme_for_doc">';
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
	echo '	<p class="description">Theme association with this doc category</p>';
    echo '  </td>';
    echo '</tr>';

}
function add_doc_category_theme($tag, $taxonomy)
{
	$allThemesArgs = array( 'numberposts' => 1000 , 'post_type' => 'ait-theme', 'orderby' => 'title', 'order' => 'ASC' );
	$allThemes = get_posts($allThemesArgs);

	$themeAssociation = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_theme_for_doc', true);

	echo '<div class="form-field">';
	echo '<label for="ait_theme_for_doc">Theme association</label>';

	if(!empty($allThemes)){
		echo '<select name="ait_theme_for_doc" id="ait_theme_for_doc">';
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
  	echo '<p class="description">Theme association with this doc category</p>';
	echo '</div>';

}
add_action( 'created_ait-doc-category', 'save_doc_category_theme', 10, 2);
add_action( 'edited_ait-doc-category', 'save_doc_category_theme', 10, 2);
function save_doc_category_theme($term_id, $tt_id)
{
    if (!$term_id) return;

	if (isset($_POST['ait_theme_for_doc']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_theme_for_doc', $_POST['ait_theme_for_doc']);
}

// create table in your plugin activation function
function create_metadata_table_doc_theme($type) {
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
add_filter("manage_edit-ait-doc-category_columns", 'doc_category_columns_theme');

function doc_category_columns_theme($skin_category_columns) {
	$new_columns = array(
		'cb'        => '<input type="checkbox" />',
		'name'      => __('Name', 'ait'),
		'theme'     => __('Theme association', 'ait'),
		'thumbnail' => __('Thumbnail', 'ait'),
		'slug'      => __('Slug', 'ait'),
		'posts'     => __('Docs', 'ait'),
		);
	return $new_columns;
}

add_filter("manage_ait-doc-category_custom_column", 'manage_doc_category_columns_theme', 10, 3);

function manage_doc_category_columns_theme($out, $column_name, $cat_id) {

	$themeAssociation = get_metadata("ait_doc_category", $cat_id, 'ait_theme_for_doc', true);
	$theme = get_post($themeAssociation);

	$thumbnail = get_metadata("ait_doc_category", $cat_id, 'ait_doc_category_thumbnail', true);

	switch ($column_name) {
		case 'theme':
			$out .= '<a href="'.get_permalink($theme->ID).'">'.$theme->post_title.'</a>';
 			break;
 		case 'thumbnail':
			if(!empty($thumbnail)){
				$out .= '<img src="'.$thumbnail.'" alt="" width="80" height="80">';
			}
 			break;

		default:
			break;
	}
	return $out;
}

?>