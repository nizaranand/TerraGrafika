<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$latteParams['archive'] = new WpLatteArchiveEntity();

$latteParams['posts'] = WpLatte::createPostEntity($wp_query->posts);

$latteParams['headerIcon'] = $aitThemeOptions->globals->headerIcon;

$latteParams['bodyClasses'] .= empty($aitThemeOptions->globals->sliderEnable) ? ' no-slider' : '';

if($aitThemeOptions->general->enableCSSFeatures->enable === 'enable') {
	$latteParams['bodyClasses'] .= ' css-features';
}

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();