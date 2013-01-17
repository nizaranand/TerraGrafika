<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitDirItemPostType()
{
	register_post_type( 'ait-dir-item',
		array(
			'labels' => array(
				'name'			=> 'Items',
				'singular_name' => 'Item',
				'add_new'		=> 'Add new',
				'add_new_item'	=> 'Add new item',
				'edit_item'		=> 'Edit item',
				'new_item'		=> 'New item',
				'not_found'		=> 'No items found',
				'not_found_in_trash' => 'No items found in Trash',
				'menu_name'		=> 'Items',
			),
			'description' => 'Manipulating with items',
			'public' => true,
			'show_in_nav_menus' => true,
			'supports' => array(
				'title',
            	'thumbnail',
				'editor',
				'excerpt',
				'page-attributes',
				'comments',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/dir-item/dir-item.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['dir-item'],
			'has_archive' => true,
			'query_var' => 'dir-item',
			'rewrite' => array('slug' => 'item'),
		)
	);
	aitDirItemTaxonomies();

	flush_rewrite_rules(false);
}

function aitDirItemTaxonomies()
{

	register_taxonomy( 'ait-dir-item-category', array( 'ait-dir-item' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> 'Item Categories',
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
		'rewrite' => array( 'slug' => 'cat' ),
		'query_var' => 'dir-item-category',
	));
	create_metadata_table_item_category('ait_dir_item_category');

	register_taxonomy( 'ait-dir-item-location', array( 'ait-dir-item' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> 'Item Locations',
			'singular_name' => _x( 'Location', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Location', 'ait'),
			'all_items'		=> __( 'All Locations', 'ait'),
			'parent_item'	=> __( 'Parent Location', 'ait'),
			'parent_item_colon' => __( 'Parent Location:', 'ait'),
			'edit_item'		=> __( 'Edit Location', 'ait'),
			'update_item'	=> __( 'Update Location', 'ait'),
			'add_new_item'	=> __( 'Add New Location', 'ait'),
			'new_item_name' => __( 'New Location Name', 'ait'),
		),
		'show_ui' => true,
		'rewrite' => false,
		'query_var' => false,
	));

}
add_action( 'init', 'aitDirItemPostType');

function aitDirItemFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-dir-item', 'side' );
	add_meta_box('postimagediv', 'Image for item', 'post_thumbnail_meta_box', 'ait-dir-item', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitDirItemFeaturedImageMetabox');

$dirItemOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-dir-item',
	'title' => __('Options for item', 'ait'),
	'types' => array('ait-dir-item'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));

function aitDirItemChangeColumns($cols)
{
	$cols = array(
		'cb'			=> '<input type="checkbox" />',
		'title'			=> __( 'Title', 'ait'),
		'thumbnail'		=> __( 'Image', 'ait'),
		'category'		=> __( 'Categories', 'ait')//,
		//'ait-dir-item-location'	=> __( 'Locations', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-dir-item_posts_columns", "aitDirItemChangeColumns" );

function aitDirItemCustomColumns($column, $post_id)
{
	global $dirItemOptions;

	switch($column){

		case "ait-dir-item-category":
			$terms = get_the_terms($post_id, 'ait-dir-item-category');
			if(!empty($terms)){
				foreach($terms as $term){
					echo "<a href='".get_term_link($term, 'ait-dir-item-category')."' rel='tag'>{$term->name}</p>";
				}
			}else{
				echo "<p>No categories</p>";
			}
		break;

		case "ait-dir-item-location":
			$terms = get_the_terms($post_id, 'ait-dir-item-location');
			if(!empty($terms)){
				foreach($terms as $term){
					echo "<a href='".get_term_link($term, 'ait-dir-item-location')."' rel='tag'>{$term->name}</p>";
				}
			}else{
				echo "<p>No locations</p>";
			}
		break;

	}
}
add_action( "manage_posts_custom_column", "aitDirItemCustomColumns", 10, 2);


/************************** Add meta ICON *****************************************/
add_action( 'ait-dir-item-category_edit_form_fields', 'edit_dir_item_category', 10, 2);
add_action( 'ait-dir-item-category_add_form_fields', 'add_dir_item_category', 10, 2);
function edit_dir_item_category($tag, $taxonomy)
{
	$icon = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_icon', true);
	$marker = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_marker', true);
	$excerpt = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_excerpt', true);

	?>
	<tr class="form-field">
        <th scope="row" valign="top"><label for="ait_dir_item_category_excerpt">Excerpt</label></th>
        <td>
            <textarea name="ait_dir_item_category_excerpt" id="ait_dir_item_category_excerpt" cols="30" rows="5"><?php $excerpt; ?></textarea>
        </td>
    </tr>
	<tr class="form-field">
        <th scope="row" valign="top"><label for="ait_dir_item_category_icon">Icon</label></th>
        <td>
            <input type="text" name="ait_dir_item_category_icon" id="ait_dir_item_category_icon" value="<?php echo $icon; ?>" style="width: 80%;"/>
            <input type="button" value="Select Image" class="media-select" id="ait_dir_item_category_icon_selectMedia" name="ait_dir_item_category_icon_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Icon for category</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="ait_dir_item_category_marker">Map Marker</label></th>
        <td>
            <input type="text" name="ait_dir_item_category_marker" id="ait_dir_item_category_marker" value="<?php echo $marker; ?>" style="width: 80%;"/>
            <input type="button" value="Select Image" class="media-select" id="ait_dir_item_category_marker_selectMedia" name="ait_dir_item_category_marker_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Marker image in map for category</p>
        </td>
    </tr>
    <?php
}
function add_dir_item_category($tag)
{
	$icon = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_icon', true);
	$marker = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_marker', true);
	$excerpt = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_dir_item_category_excerpt', true);

	?>
	<div class="form-field">
        <label for="ait_dir_item_category_excerpt">Excerpt</label>
        <textarea name="ait_dir_item_category_excerpt" id="ait_dir_item_category_excerpt" cols="30" rows="5"><?php $excerpt; ?></textarea>
    </div>
	<div class="form-field">
		<label for="ait_dir_item_category_icon">Icon</label>
		<input type="text" name="ait_dir_item_category_icon" id="ait_dir_item_category_icon" value="<?php echo $icon; ?>" style="width: 80%;"/>
        <input type="button" value="Select Image" class="media-select" id="ait_dir_item_category_icon_selectMedia" name="ait_dir_item_category_icon_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Icon for category</p>
	</div>
	<div class="form-field">
		<label for="ait_dir_item_category_marker">Map Marker</label>
		<input type="text" name="ait_dir_item_category_marker" id="ait_dir_item_category_marker" value="<?php echo $marker; ?>" style="width: 80%;"/>
        <input type="button" value="Select Image" class="media-select" id="ait_dir_item_category_marker_selectMedia" name="ait_dir_item_category_marker_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Marker image in map for category</p>
	</div>
	<?php
}
add_action( 'created_ait-dir-item-category', 'save_dir_item_category', 10, 2);
add_action( 'edited_ait-dir-item-category', 'save_dir_item_category', 10, 2);
function save_dir_item_category($term_id, $tt_id)
{
    if (!$term_id) return;

	if (isset($_POST['ait_dir_item_category_excerpt']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_dir_item_category_excerpt', $_POST['ait_dir_item_category_excerpt']);

	if (isset($_POST['ait_dir_item_category_icon']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_dir_item_category_icon', $_POST['ait_dir_item_category_icon']);

    if (isset($_POST['ait_dir_item_category_marker']))
        update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_dir_item_category_marker', $_POST['ait_dir_item_category_marker']);

}

// create table in your plugin activation function
function create_metadata_table_item_category($type) {
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

// TABLE COLUMNS
add_filter("manage_edit-ait-dir-item-category_columns", 'dir_item_category_columns');

function dir_item_category_columns($category_columns) {
	$new_columns = array(
		'cb'        		=> '<input type="checkbox" />',
		'name'      		=> __('Name', 'ait'),
		'description'     	=> __('Description', 'ait'),
		'item_excerpt'	    => __('Excerpt', 'ait'),
		'icon' 				=> __('Icon', 'ait'),
		'marker'			=> __('Marker', 'ait'),
		'slug'      		=> __('Slug', 'ait'),
		'posts'     		=> __('Items', 'ait'),
		);
	return $new_columns;
}

add_filter("manage_ait-dir-item-category_custom_column", 'manage_dir_item_category_columns', 10, 3);

function manage_dir_item_category_columns($out, $column_name, $cat_id) {

	$icon = get_metadata("ait_dir_item_category", $cat_id, 'ait_dir_item_category_icon', true);
	$marker = get_metadata("ait_dir_item_category", $cat_id, 'ait_dir_item_category_marker', true);
	$excerpt = get_metadata("ait_dir_item_category", $cat_id, 'ait_dir_item_category_excerpt', true);

	switch ($column_name) {
		case 'item_excerpt':
			if($excerpt && !empty($excerpt)){
				$out .= $excerpt;			
			}
			break;
 		case 'icon':
			if(!empty($icon)){
				$out .= '<img src="'.$icon.'" alt="" width="50" height="50">';
			}
 			break;
 		case 'marker':
			if(!empty($marker)){
				$out .= '<img src="'.$marker.'" alt="" width="50" height="50">';
			}
 			break;
		default:
			break;
	}
	return $out;
}

function aitDirItemSortableColumns()
{
  return array(
    'title'=> 'title',
    'category'=> 'category'
  );
}
add_filter( "manage_edit-ait-dir-item_sortable_columns", "aitDirItemSortableColumns" );

?>