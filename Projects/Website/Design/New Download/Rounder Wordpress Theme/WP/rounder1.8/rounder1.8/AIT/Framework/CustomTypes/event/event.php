<?php
/**
* AIT Theme Admin
*
* Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
*
*/

function aitEventPostType()
{
    register_post_type( 'ait-event',
        array(
            'labels' => array(
                'name'                  => __('Events', 'ait'),
                'singular_name'         => __('Event', 'ait'),
                'add_new'               => __('Add new event', 'ait'),
                'add_new_item'          => __('Add new event', 'ait'),
                'edit_item'             => __('Edit event', 'ait'),
                'new_item'              => __('New event', 'ait'),
                'view_item'             => __('View event', 'ait'),
                'search_items'          => __('Search events', 'ait'),
                'not_found'             => __('No events found', 'ait'),
                'not_found_in_trash'    => __('No events found in Trash', 'ait'),
                'menu_name'             => __('Events', 'ait'),
            ),
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'page-attributes',
            ),
            'description'               => __('Manipulating with events', 'ait'),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'menu_icon'                 => AIT_FRAMEWORK_URL . '/CustomTypes/event/event.png',
            'menu_position'             => $GLOBALS['aitThemeCustomTypes']['event'],
            'has_archive'               => false,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'event' )
        )
    );
    aitEventTaxonomies();

    flush_rewrite_rules(false);
}

function aitEventTaxonomies()
{
    register_taxonomy('ait-event-category', array('ait-event'),
        array(
            'labels' => array(
                'name'                  => _x( 'Event Categories', 'taxonomy general name', 'ait'),
                'singular_name'         => _x( 'Event Category', 'taxonomy singular name', 'ait'),
                'search_items'          => __( 'Search Category', 'ait'),
                'all_items'             => __( 'All Gategories', 'ait'),
                'parent_item'           => __( 'Parent Category', 'ait'),
                'parent_item_colon'     => __( 'Parent Category:', 'ait'),
                'edit_item'             => __( 'Edit Category', 'ait'),
                'update_item'           => __( 'Update Gategory', 'ait'),
                'add_new_item'          => __( 'Add New Category', 'ait'),
                'new_item_name'         => __( 'New Category Name', 'ait'),
            ),
            'hierarchical'              => true,
            'show_ui'                   => true,
            'query_var'                 => true,
            'rewrite'                   => true,
        )
    );

    // add uncategorized term
    if(!term_exists( 'Uncategorized Events', 'ait-event-category')){
        wp_insert_term( 'Uncategorized Events', 'ait-event-category');
    }
}
add_action( 'init', 'aitEventPostType' );

function aitEventFeaturedImageMetabox()
{
    remove_meta_box( 'postimagediv', 'ait-event-box', 'side' );
    add_meta_box('postimagediv', __('Event image', 'ait'), 'post_thumbnail_meta_box', 'ait-event', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitEventFeaturedImageMetabox');

$eventOptions = new WPAlchemy_MetaBox(array(
    'id'        => '_ait-event',
    'title'     => __('Options for event', 'ait'),
    'types'     => array('ait-event'),
    'context'   => 'normal',
    'priority'  => 'core',
    'config'    => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));

function aitEventChangeColumns($cols)
{
    $cols = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => __( 'Title', 'ait'),
        'event_date'    => __( 'Date', 'ait'),
        'thumbnail'     => __( 'Image', 'ait'),
        'menu_order'    => __( 'Order', 'ait'),
        'category'      => __( 'Category', 'ait'),
    );
    return $cols;
}
add_filter( "manage_ait-event_posts_columns", "aitEventChangeColumns");

function aitEventCustomColumns($column, $post_id)
{
    global $eventOptions;
    $options = $eventOptions->the_meta();

    switch ($column)
    {
        case "event_date":
            if(isset($options['eventDate'])){
                echo "<p>".$options['eventDate']."</p>";
            }
            unset($options);
        break;
    }
}
add_action( "manage_posts_custom_column", "aitEventCustomColumns", 10, 2);

function aitEventSortableColumns()
{
    return array(
        'event_date'    => 'event_date',
        'menu_order'    => 'order',
        'category'      => 'category',
    );
}
add_filter("manage_edit-ait-event_sortable_columns", "aitEventSortableColumns");
