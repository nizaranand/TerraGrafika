<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

// if this is "Blog" page get the right template
if($GLOBALS['wp_query']->is_home && $GLOBALS['wp_query']->is_posts_page){
	$template = get_page_template();
	if($template = apply_filters('template_include', $template)){
		if(substr($template, -8, 8) != 'page.php'){
			require_once $template;
			return; // ends executing this script
		}
	}
}

$latteParams['posts'] = WpLatte::createPostEntity($GLOBALS['wp_query']->posts);

$latteParams['headerIcon'] = $aitThemeOptions->globals->headerIcon;

// no page was selected for "Posts page" from WP Admin in Settings->Reading
$latteParams['isIndexPage'] = true;

if(isset($GLOBALS['wp_query']->queried_object)){

	$latteParams['post'] = WpLatte::createPostEntity(
		$GLOBALS['wp_query']->queried_object,
		array(
			'meta' => $GLOBALS['pageOptions'],
	));

	$sliderEnable = ($latteParams['post']->options('slider')->overrideGlobal) ? $latteParams['post']->options('slider')->sliderEnable : $aitThemeOptions->globals->sliderEnable;

	if (empty($sliderEnable)) {
		$latteParams['bodyClasses'] .= ' no-slider';
	}

	$latteParams['headerIcon'] = ($latteParams['post']->options('header')->overrideGlobal) ? $latteParams['post']->options('header')->headerIcon : $aitThemeOptions->globals->headerIcon;

	$latteParams['isIndexPage'] = false;
}

if($aitThemeOptions->general->enableCSSFeatures->enable === 'enable') {
	$latteParams['bodyClasses'] .= ' css-features';
}

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();