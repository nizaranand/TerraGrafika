<?php
/**
* AIT Theme Admin
*
* Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
*
*/

function aitTestimonialPostType()
{
    register_post_type( 'ait-testimonial',
        array(
            'labels' => array(
                'name'                  => __('Testimonials', 'ait'),
                'singular_name'         => __('Testimonial', 'ait'),
                'add_new'               => __('Add new testimonial', 'ait'),
                'add_new_item'          => __('Add new testimonial', 'ait'),
                'edit_item'             => __('Edit testimonial', 'ait'),
                'new_item'              => __('New testimonial', 'ait'),
                'view_item'             => __('View testimonial', 'ait'),
                'search_items'          => __('Search testimonials', 'ait'),
                'not_found'             => __('No testimonials found', 'ait'),
                'not_found_in_trash'    => __('No testimonials found in Trash', 'ait'),
                'menu_name'             => __('Testimonials', 'ait'),
            ),
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'page-attributes',
            ),
            'description'               => __('Manipulating with testimonials', 'ait'),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'menu_icon'                 => AIT_FRAMEWORK_URL . '/CustomTypes/testimonial/testimonial.png',
            'menu_position'             => $GLOBALS['aitThemeCustomTypes']['testimonial'],
            'has_archive'               => false,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'testimonial' )
        )
    );
    aitTestimonialTaxonomies();

    flush_rewrite_rules(false);
}

function aitTestimonialTaxonomies()
{
    register_taxonomy('ait-testimonial-category', array('ait-testimonial'),
        array(
            'labels' => array(
                'name'                  => _x( 'Testimonial Categories', 'taxonomy general name', 'ait'),
                'singular_name'         => _x( 'Testimonial Category', 'taxonomy singular name', 'ait'),
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
    if(!term_exists( 'Uncategorized Testimonials', 'ait-testimonial-category')){
        wp_insert_term( 'Uncategorized Testimonials', 'ait-testimonial-category');
    }
}
add_action( 'init', 'aitTestimonialPostType' );

function aitTestimonialFeaturedImageMetabox()
{
    remove_meta_box( 'postimagediv', 'ait-testimonial-box', 'side' );
    add_meta_box('postimagediv', __('Testimonial image', 'ait'), 'post_thumbnail_meta_box', 'ait-testimonial', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitTestimonialFeaturedImageMetabox');

$testimonialOptions = new WPAlchemy_MetaBox(array(
    'id'        => '_ait-testimonial',
    'title'     => __('Options for testimonial', 'ait'),
    'types'     => array('ait-testimonial'),
    'context'   => 'normal',
    'priority'  => 'core',
    'config'    => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon'
));

function aitTestimonialChangeColumns($cols)
{
    $cols = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => __( 'Title', 'ait'),
        'menu_order'    => __( 'Order', 'ait'),
        'category'      => __( 'Category', 'ait'),
    );
    return $cols;
}
add_filter( "manage_ait-testimonial_posts_columns", "aitTestimonialChangeColumns");

/*
function aitTestimonialCustomColumns($column, $post_id)
{
    global $testimonialOptions;
    $options = $testimonialOptions->the_meta();

    switch ($column)
    {
        case "testimonial_date":
            if(isset($options['testimonialDate'])){
                echo "<p>".$options['testimonialDate']."</p>";
            }
            unset($options);
        break;
    }
}
add_action( "manage_posts_custom_column", "aitTestimonialCustomColumns", 10, 2);*/
/*
function aitTestimonialSortableColumns()
{
    return array(
        'testimonial_date'    => 'testimonial_date',
        'menu_order'    => 'order',
        'category'      => 'category',
    );
}
add_filter("manage_edit-ait-testimonial_sortable_columns", "aitTestimonialSortableColumns");*/
