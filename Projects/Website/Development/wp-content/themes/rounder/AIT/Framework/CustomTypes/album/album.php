<?php

/**
* AIT Theme Admin
*
* Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
*
*/

function aitAlbumPostType()
{
    register_post_type( 'ait-album',
        array(
            'labels' => array(
                'name'               => __('Songs', 'ait'),
                'singular_name'      => __('Album', 'ait'),
                'all_items'          => __('All songs', 'ait'),
                'add_new'            => __('Add new song', 'ait'),
                'add_new_item'       => __('Add new song', 'ait'),
                'edit_item'          => __('Edit song', 'ait'),
                'new_item'           => __('New song', 'ait'),
                'view_item'          => __('View song', 'ait'),
                'search_items'       => __('Search songs', 'ait'),
                'not_found'          => __('No songs found', 'ait'),
                'not_found_in_trash' => __('No songs found in Trash', 'ait'),
                'menu_name'          => __('Album', 'ait'),
            ),
            'supports' => array(
                'title',
                'page-attributes',
                'editor',
            ),
            'description'         => __('Manipulating with songs', 'ait'),
            'public'              => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'menu_icon'           => AIT_FRAMEWORK_URL . '/CustomTypes/album/album.png',
            'menu_position'       => $GLOBALS['aitThemeCustomTypes']['album'],
            'has_archive'         => 'albums',
            'query_var'           => true,
            'rewrite'             => array('slug' => 'song'),
        )
    );
    aitAlbumTaxonomies();

    flush_rewrite_rules(false);
}

function aitAlbumTaxonomies()
{
    register_taxonomy('ait-album-category', array('ait-album'),
            array(
                'labels' => array(
                    'name'              => _x( 'Albums', 'taxonomy general name', 'ait'),
                    'singular_name'     => _x( 'Album', 'taxonomy singular name', 'ait'),
                    'search_items'      => __( 'Search Album', 'ait'),
                    'all_items'         => __( 'All Albums', 'ait'),
                    'parent_item'       => __( 'Parent Album', 'ait'),
                    'parent_item_colon' => __( 'Parent Album:', 'ait'),
                    'edit_item'         => __( 'Edit Album', 'ait'),
                    'update_item'       => __( 'Update Album', 'ait'),
                    'add_new_item'      => __( 'Add New Album', 'ait'),
                    'new_item_name'     => __( 'New Album Name', 'ait'),
                ),
                'hierarchical' => true,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 'slug' => 'band-albums' ),
            )
    );

    // add uncategorized term
    if(!term_exists( 'Uncategorized Albums', 'ait-album-category' )){
        wp_insert_term( 'Uncategorized Albums', 'ait-album-category' );
    }
    create_metadata_table_album('ait_album_category');
}
add_action( 'init', 'aitAlbumPostType' );

/*function aitAlbumFeaturedImageMetabox()
{
remove_meta_box( 'postimagediv', 'ait-album-box', 'side' );
add_meta_box('postimagediv', __('Album image'), 'post_thumbnail_meta_box', 'ait-album', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitAlbumFeaturedImageMetabox');
*/

$albumOptions = new WPAlchemy_MetaBox(array
(
    'id'        => '_ait-album',
    'title'     => __('Options for album', 'ait'),
    'types'     => array('ait-album'),
    'context'   => 'normal',
    'priority'  => 'core',
    'config'    => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));

function aitAlbumChangeColumns($cols)
{
    $cols = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => __( 'Title', 'ait'),
        'song_embed'    => __( 'Embed', 'ait'),
        'song_link'     => __( 'Download', 'ait'),
        'song_buy'      => __( 'Buy', 'ait'),
        'song_video'    => __( 'Video', 'ait'),
        'menu_order'    => __( 'Order', 'ait'),
        'category'      => __( 'Category', 'ait'),
    );
    return $cols;
}
add_filter( "manage_ait-album_posts_columns", "aitAlbumChangeColumns");

function aitAlbumCustomColumns($column, $post_id)
{
    global $albumOptions;
    $options = $albumOptions->the_meta();

    switch ($column)
    {
        case "song_embed":
            if(isset($options['songEmbed'])){
                echo "<p>".$options['songEmbed']."</p>";
            }
            unset($options);
        break;
        case "song_link":
            if(isset($options['songLink'])){
                echo '<a href="' . htmlspecialchars($options['songLink']) . '">' . htmlspecialchars($options['songLink']) . "</a>";
            }
            unset($options);
        break;
        case "song_buy":
            if(isset($options['songBuy'])){
                echo '<a href="' . htmlspecialchars($options['songBuy']) . '">' . htmlspecialchars($options['songBuy']) . "</a>";
            }
            unset($options);
        break;
        case "song_video":
            if(isset($options['songVideo'])){
                echo '<a href="' . htmlspecialchars($options['songVideo']) . '">' . htmlspecialchars($options['songVideo']) . "</a>";
            }
            unset($options);
        break;
    }
}
add_action( "manage_posts_custom_column", "aitAlbumCustomColumns", 10, 2);


function aitAlbumSortableColumns()
{
    return array(
        'song_embed'    => 'song_embed',
        'menu_order'    => 'order',
        'category'      => 'category',
    );
}
add_filter("manage_edit-ait-album_sortable_columns", "aitAlbumSortableColumns");


/* CATEGORY */
add_action( 'ait-album-category_edit_form_fields', 'edit_album_category', 10, 2);
add_action( 'ait-album-category_add_form_fields', 'add_album_category', 10, 2);
function edit_album_category($tag, $taxonomy)
{
    $thumbnail = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_thumbnail', true);
    $author = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_author', true);
    $data = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_data', true);
    $iconData = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_iconData', true);
    $order = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_order', true);

?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="ait_album_category_thumbnail">Thumbnail</label>
        </th>
        <td>
            <input type="text" name="ait_album_category_thumbnail" id="ait_album_category_thumbnail" value="<?php echo $thumbnail; ?>" style="width: 80%;"/>
            <input type="button" value="Select Image" class="media-select" id="ait_album_category_thumbnail_selectMedia" name="ait_album_category_thumbnail_selectMedia" style="width: 15%;">
            <br />
            <p class="description">Thumbnail for album</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="ait_album_category_author">Author</label>
        </th>
        <td>
            <input type="text" name="ait_album_category_author" id="ait_album_category_author" value="<?php echo $author; ?>" style="width: 95%;"/>
            <br />
            <p class="description">Album's author</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="ait_album_category_data">Additional Data</label>
        </th>
        <td>
            <textarea name="ait_album_category_data" id="ait_album_category_data" rows="5" cols="50" class="large-text" ><?php echo htmlspecialchars($data); ?></textarea>
            <br />
            <p class="description">Additional data code</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="ait_album_category_iconData">Additional Icon</label>
        </th>
        <td>
            <input type="text" name="ait_album_category_iconData" id="ait_album_category_iconData" value="<?php echo $iconData; ?>" style="width: 95%;"/>
            <br />
            <p class="description">Icon for Additional data</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="ait_album_category_order">Order</label>
        </th>
        <td>
            <input type="text" name="ait_album_category_order" id="ait_album_category_order" value="<?php echo $order; ?>" style="width: 95%;"/>
            <br />
            <p class="description">Order</p>
        </td>
    </tr>
<?php
}
function add_album_category($tag, $taxonomy = "")
{
    $thumbnail = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_thumbnail', true);
    $author = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_author', true);
    $data = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_data', true);
    $iconData = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_iconData', true);
    $order = get_metadata(str_replace("-","_",$tag->taxonomy), $tag->term_id, 'ait_album_category_order', true);
?>
    <div class="form-field">
        <label for="ait_album_category_thumbnail">Thumbnail</label>
        <input type="text" name="ait_album_category_thumbnail" id="ait_album_category_thumbnail" value="<?php echo $thumbnail; ?>" style="width: 80%;"/>
        <input type="button" value="Select Image" class="media-select" id="ait_album_category_thumbnail_selectMedia" name="ait_album_category_thumbnail_selectMedia" style="width: 15%;">
        <br />
        <p class="description">Thumbnail for album</p>
    </div>

    <div class="form-field">
        <label for="ait_album_category_author">Author</label>
        <input type="text" name="ait_album_category_author" id="ait_album_category_author" value="<?php echo $author; ?>" style="width: 95%;"/>
        <br />
        <p class="description">Album's author</p>
    </div>
    <div class="form-field">
        <label for="ait_album_category_data">Additional Data</label>
        <input type="text" name="ait_album_category_data" id="ait_album_category_data" value="<?php echo $data; ?>" style="width: 95%;" />
        <br />
        <p class="description">Additional data code</p>
    </div>
    <div class="form-field">
        <label for="ait_album_category_iconData">Additional Icon</label>
        <input type="text" name="ait_album_category_iconData" id="ait_album_category_iconData" value="<?php echo $iconData; ?>" style="width: 95%;" />
        <br />
        <p class="description">Icon for Additional data</p>
    </div>
    <div class="form-field">
        <label for="ait_album_category_order">Order</label>
        <input type="text" name="ait_album_category_order" id="ait_album_category_order" value="<?php echo $order; ?>" style="width: 95%;" />
        <br />
        <p class="description">Order</p>
    </div>
<?php
}
add_action( 'created_ait-album-category', 'save_album_category', 10, 2);
add_action( 'edited_ait-album-category', 'save_album_category', 10, 2);

function save_album_category($term_id, $tt_id)
{
    if (!$term_id) return;

    if (isset($_POST['ait_album_category_thumbnail']))
    update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_album_category_thumbnail', $_POST['ait_album_category_thumbnail']);

    if (isset($_POST['ait_album_category_author']))
    update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_album_category_author', $_POST['ait_album_category_author']);

    if (isset($_POST['ait_album_category_data']))
    update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_album_category_data', $_POST['ait_album_category_data']);

    if (isset($_POST['ait_album_category_iconData']))
    update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_album_category_iconData', $_POST['ait_album_category_iconData']);

    if (isset($_POST['ait_album_category_order']))
    update_metadata(str_replace("-","_",$_POST['taxonomy']), $term_id, 'ait_album_category_order', $_POST['ait_album_category_order']);
}

function create_metadata_table_album($type)
{
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
add_filter("manage_edit-ait-album-category_columns", 'album_category_columns_theme');

function album_category_columns_theme($skin_category_columns) {
    $new_columns = array(
        'cb'            => '<input type="checkbox" />',
        'name'          => __('Name', 'ait'),
        'thumbnail'     => __('Thumbnail', 'ait'),
        'slug'          => __('Slug', 'ait'),
    );
    return $new_columns;
}
add_filter("manage_ait-album-category_custom_column", 'manage_album_category_columns_theme', 10, 3);

function manage_album_category_columns_theme($out, $column_name, $cat_id)
{
    $thumbnail = get_metadata("ait_album_category", $cat_id, 'ait_album_category_thumbnail', true);

    switch ($column_name) {
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