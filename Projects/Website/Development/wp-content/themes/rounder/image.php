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

$latteParams['headerIcon'] = $aitThemeOptions->globals->headerIcon;

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();