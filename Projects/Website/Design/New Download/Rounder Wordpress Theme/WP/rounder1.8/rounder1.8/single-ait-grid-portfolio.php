<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


$latteParams['post'] = WpLatte::createPostEntity(
	$post,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);

$latteParams['post']->classes = implode(' ', get_post_class());

$latteParams['headerIcon'] = ($latteParams['post']->options('header')->overrideGlobal) ? $latteParams['post']->options('header')->headerIcon : $aitThemeOptions->globals->headerIcon;

$sliderEnable = ($latteParams['post']->options('slider')->overrideGlobal) ? $latteParams['post']->options('slider')->sliderEnable : $aitThemeOptions->globals->sliderEnable;

if (empty($sliderEnable)) {
	$latteParams['bodyClasses'] .= ' no-slider';
}

if($aitThemeOptions->general->enableCSSFeatures->enable === 'enable') {
	$latteParams['bodyClasses'] .= ' css-features';
}

$latteParams['itemMeta'] = get_post_meta($latteParams['post']->id, "_ait-grid-portfolio", true);
ChromePhp::log("META",$latteParams['itemMeta']);

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();