<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$aitThemeCustomTypes = array(
	'slider-creator' => 32,
	'service-box' => 33,
	'presentation' => 34,
	'grid-portfolio' => 35
);

$aitThemeWidgets = array(
	'post',
	'flickr',
	'submenu',
	'twitter'
);

$aitEditorShortcodes = array(
	'custom',
	'columns',
	'images',
	'posts',
	'buttons',
	'boxesFrames',
	'lists',
	'notifications',
	'modal',
	'social',
	'video',
	'gMaps',
	'gChart',
	'portfolio',
	'language',
	'tabs',
	'gridgallery',
	'econtent'
);

$aitThemeShortcodes = array(
	'boxesFrames' => 2,
	'buttons' => 1,
	'columns'=> 1,
	'custom'=> 1,
	'images'=> 1,
	'lists'=> 1,
	'modal'=> 1,
	'notifications'=> 1,
	'portfolio'=> 1,
	'posts'=> 1,
	'sitemap'=> 1,
	'social'=> 1,
	'video'=> 1,
	'language'=> 1,
	'gMaps'=> 1,
	'gChart'=> 1,
	'tabs'=> 1,
	'gridgallery'=> 1,
	'econtent' => 1
);

require dirname(__FILE__) . '/AIT/ait-bootstrap.php';


$pageOptions = array(
	'header' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_header_options',
		'title' => __('Header'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-header.neon'
	)),
	/*
	'featured-image' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_featured_images_options',
		'title' => __('Featured Image'),
		'types' => array('post'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/post-featured.neon'
	)),
	*/
	'slider' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_slider_options',
		'title' => __('Slider Settings'),
		'types' => array('post', 'page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-slider-meta.neon',
		'js' => dirname(__FILE__) . '/conf/page-slider-meta.js',
	)),
	'testimonials' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_testimonials_options',
		'title' => __('Testimonials Page Settings'),
		'types' => array('post', 'page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-testimonials-meta.neon'
	)),
    'service-boxes' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_service_boxes_options',
		'title' => __('Service Boxes Page Settings'),
		'types' => array('post', 'page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-service-boxes-meta.neon'
	)),
    'presentation' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_presentation_options',
		'title' => __('Pictures Presentation Page Settings'),
		'types' => array('post', 'page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/page-presentation-meta.neon'
	)),
	'sections-order' => new WPAlchemy_MetaBox(array(
		'id' => '_ait_sections_order',
		'title' => __('Sections order for this page'),
		'types' => array('page'),
		'context' => 'normal',
		'priority' => 'core',
		'config' => dirname(__FILE__) . '/conf/sections-order.neon'
	)),
);



function aitEnqueueScriptsAndStyles()
{
	if (!is_admin()) {

		//aitLoadJQuery('1.7.1');

		wp_enqueue_script( 'JS_easy', THEME_JS_URL . '/libs/jquery.easing-1.3.min.js',  array('jquery') );

		// HTML 5 Support
		wp_enqueue_script( 'JS_html_5_shiv', THEME_JS_URL . '/libs/html5shiv.js');

		// google maps
		wp_enqueue_script( 'JS_googleMaps', THEME_JS_URL . '/libs/jquery.gmap.min.js',  array('jquery') );

		// Colorbox
		wp_enqueue_style( 'CSS_colorbox', THEME_CSS_URL . '/colorbox.css');
		wp_enqueue_script( 'JS_colorbox', THEME_JS_URL . '/libs/jquery.colorbox-min.js',  array('jquery') );

		// hoverZoom
		wp_enqueue_style( 'CSS_hover_zoom', THEME_CSS_URL . '/hoverZoom.css');
		wp_enqueue_script( 'JS_hover_zoom', THEME_JS_URL . '/libs/hover.zoom.js',  array('jquery') );

		// Image Switch
		wp_enqueue_script( 'JS_imageSwitch', THEME_JS_URL . '/libs/jquery.ImageSwitch.yui.js',  array('jquery') );

		// fancybox
		wp_enqueue_style( 'CSS_fancybox', THEME_CSS_URL . '/fancybox/jquery.fancybox-1.3.4.css');
		wp_enqueue_script( 'JS_fancybox', THEME_JS_URL . '/libs/jquery.fancybox-1.3.4.js',  array('jquery') );

		// infield labels
		wp_enqueue_script( 'JS_infieldlabel', THEME_JS_URL . '/libs/jquery.infieldlabel.js',  array('jquery') );

		// jQuery UI
		wp_enqueue_script( 'JS_jquery_ui', THEME_JS_URL . '/libs/jquery-ui-1.8.22.custom.min.js',  array('jquery') );

		// contact
		wp_enqueue_style( 'CSS_contact', THEME_CSS_URL . '/contact.css');

		// comments
		wp_enqueue_style( 'CSS_comments', THEME_CSS_URL . '/comments.css');

		// Pretty sociable
		wp_enqueue_style( 'CSS_pretty_sociable', THEME_CSS_URL . '/prettySociable.css');
		wp_enqueue_script( 'JS_pretty_sociable', THEME_JS_URL . '/libs/jquery.prettySociable.js',  array('jquery') );

		// modernizr
		wp_enqueue_script( 'JS_modernizr', THEME_JS_URL . '/libs/jquery.modernizr.2.5.3.js',  array('jquery') );

		// Anything slider
		wp_enqueue_style( 'CSS_anything', THEME_CSS_URL . '/anythingslider.css');
		wp_enqueue_script( 'JS_anythingFx', THEME_JS_URL . '/libs/jquery.anythingslider.fx.min.js', array('jquery') );
		wp_enqueue_script( 'JS_anything', THEME_JS_URL . '/libs/jquery.anythingslider.min.js',  array('jquery') );

		// paralax slider
		wp_enqueue_style( 'CSS_hover_zoom', THEME_CSS_URL . '/cslider.css');
		wp_enqueue_script( 'JS_paralaxSlider', THEME_JS_URL . '/libs/jquery.cslider.js',  array('jquery') );

		//Quick sand
		wp_enqueue_script( 'JS_quicksand', THEME_JS_URL . '/libs/jquery.quicksand.js',  array('jquery') );

		// grid gallery
		wp_enqueue_script( 'JS_gridGallery', THEME_JS_URL . '/gridgallery.js',  array('jquery') );

		// General script
		wp_enqueue_script( 'JS_general_script', THEME_JS_URL . '/script.js',  array('jquery') );
	}
}

add_action('wp_enqueue_scripts', 'aitEnqueueScriptsAndStyles');



function aitThemeSetup()
{

	load_theme_textdomain('ait', get_template_directory() . '/languages');

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support('automatic-feed-links');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu('primary-menu', __('Primary Menu', 'ait'));
	register_nav_menu('footer-menu', __('Footer Menu', 'ait'));

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support('post-thumbnails');

}
add_action('after_setup_theme', 'aitThemeSetup');



/**
 * Register our sidebars and widgetized areas.
 */
function aitWidgetsInit()
{

	// Subpages Widgets
	register_sidebar(array(
		'name' => __('Subpages Widgets Area', 'ait'),
		'id' => 'subpages-sidebar',
		'description' => __(''),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<div class="title-border-bottom"><div class="title-border-top"><div class="title-decoration"></div><h2 class="widget-title">',
		'after_title' => '</h2></div></div>',
	));

	// Footer Widgets
	register_sidebar(array(
		'name' => __('Footer Widget Area', 'ait'),
		'id' => 'footer-widgets',
		'description' => __(''),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<div class="title-border-bottom"><div class="title-border-top"><div class="title-decoration"></div><h2 class="widget-title">',
		'after_title' => '</h2></div></div>',
	));

	// Blog Widgets
	register_sidebar(array(
		'name' => __('Blog Widgets Area', 'ait'),
		'id' => 'blog-sidebar',
		'description' => __(''),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<div class="title-border-bottom"><div class="title-border-top"><div class="title-decoration"></div><h2 class="widget-title">',
		'after_title' => '</h2></div></div>',
	));

	// Post Widgets
	register_sidebar(array(
		'name' => __('Post Widget Area', 'ait'),
		'id' => 'post-sidebar',
		'description' => __(''),
		'before_widget' => '<div id="%1$s" class="box widget-container %2$s"><div class="box-wrapper">',
		'after_widget' => "</div></div>",
		'before_title' => '<div class="title-border-bottom"><div class="title-border-top"><div class="title-decoration"></div><h2 class="widget-title">',
		'after_title' => '</h2></div></div>',
	));

}
add_action('widgets_init', 'aitWidgetsInit');


function default_menu()
{
	wp_nav_menu(array('menu' => 'Main Menu', 'fallback_cb' => 'default_page_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu clear'));
}


function default_page_menu()
{
	echo '<nav class="mainmenu">';
	wp_page_menu(array('menu_class' => 'menu clear'));
	echo '</nav>';
}



function default_footer_menu()
{
	wp_nav_menu(array('menu' => 'Main Menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1));
}

remove_action('wp_head', 'wp_generator'); // do not show generator meta element

add_filter('widget_title', 'do_shortcode');
add_filter('widget_text', 'do_shortcode'); // do shortcode in text widget



if(defined("WOOCOMMERCE_VERSION")){
	require_once dirname(__FILE__) . '/woocommerce/woocommerce-functions.php';
}

/* AUTOINSTALL PLUGINS :: START */
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'AIT'.DIRECTORY_SEPARATOR.'Framework'.DIRECTORY_SEPARATOR.'Libs'.DIRECTORY_SEPARATOR.'class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'register_required_plugins' );

function register_required_plugins() {
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme
        /*array(
            'name'                  => 'Revolution Slider',
            'slug'                  => 'revslider',
            'source'                => 'revslider-1.5.zip',
            'required'              => true,
            'version'               => '1.5',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),*/

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		array(
            'name'      => 'Really Simple CAPTCHA',
            'slug'      => 'really-simple-captcha',
            'required'  => false,
        ),
        array(
            'name'      => 'Widget Logic',
            'slug'      => 'widget-logic',
            'required'  => false,
        ),
    );

    $theme_text_domain = 'rounder';
    $config = array(
        'domain'            => $theme_text_domain,
        'default_path'      => home_url('/') . "wp-content/themes/{$theme_text_domain}/plugins/",
        'parent_menu_slug'  => 'plugins.php',
        'parent_url_slug'   => 'plugins.php',
        'menu'              => 'install-required-plugins',
        'has_notices'       => true,
        'is_automatic'      => true,
        'message'           => '',
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Required Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ),
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
            'nag_type'                                  => 'updated'
        )
    );
    tgmpa( $plugins, $config );
}
/* AUTOINSTALL PLUGINS :: START */

/* ADD CUSTOM CSS TO ADMIN :: START */
function add_admin_theme_styles() {
	wp_enqueue_style( 'CSS_revSliderAdmin', THEME_URL . '/design/admin-plugins/revslider.css');
}
add_action('admin_print_styles', 'add_admin_theme_styles');

function add_admin_theme_scripts() {
	wp_enqueue_script( 'JS_revSliderAdmin', THEME_URL . '/design/admin-plugins/revslider.js');
}
add_action('admin_print_scripts', 'add_admin_theme_scripts');
/* ADD CUSTOM CSS TO ADMIN :: END */
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'ait-revslider.php';
