<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

define('AIT_FW_VERSION', "1.0");

if(!defined('THEME_CODE_NAME'))	define('THEME_CODE_NAME', strtolower(basename(get_stylesheet_directory())));


if(!defined('THEME_SHORT_NAME')){
	if(function_exists('wp_get_theme'))
		define('THEME_SHORT_NAME', wp_get_theme()->name);
	else{
		$t = get_theme_data(get_template_directory() . '/style.css');
		define('THEME_SHORT_NAME', $t['Name']);
		unset($t);
	}
}

if(!defined('THEME_LONG_NAME')) define('THEME_LONG_NAME', THEME_SHORT_NAME . ' Wordpress Theme');


if(file_exists(dirname(__FILE__) . '/../.dev') and !defined('AIT_DEVELOPMENT'))
	define('AIT_DEVELOPMENT', true);



define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_CSS_DIR', THEME_DIR . '/design/css');
define('THEME_CSS_URL', THEME_URL . '/design/css');
define('THEME_JS_URL', THEME_URL . '/design/js');
define('THEME_IMG_URL', THEME_URL . '/design/img');
define('THEME_FONTS_DIR', THEME_DIR . '/design/fonts');
define('THEME_FONTS_URL', THEME_URL . '/design/fonts');

define('THEME_STYLESHEET_URL', get_bloginfo('stylesheet_url'));
define('THEME_STYLESHEET_FILE', THEME_DIR . '/style.css');

define('THEME_SKINS_DIR', THEME_DIR . "/design/skins");
define('THEME_SKINS_URL', THEME_URL . "/design/skins");

define('AIT_FRAMEWORK_DIR', THEME_DIR . '/AIT/Framework');
define('AIT_FRAMEWORK_URL', THEME_URL . '/AIT/Framework');
define('AIT_ADMIN_DIR', THEME_DIR . '/AIT/Admin');
define("AIT_ADMIN_URL", THEME_URL . '/AIT/Admin');

define("AIT_CACHE_DIR", THEME_DIR . '/ait-cache');
define("AIT_CACHE_URL", THEME_URL . '/ait-cache');

define("AIT_TEMPLATES_DIR", THEME_DIR . '/Templates');

if(file_exists(THEME_DIR . '/tn.php'))
	define('TIMTHUMB_URL', THEME_URL . '/tn.php');
else
	define('TIMTHUMB_URL', AIT_FRAMEWORK_URL . '/Libs/timthumb/timthumb.php');

define('AIT_DEFAULT_OPTIONS_KEY', 'ait_' . THEME_CODE_NAME . '_options_en');
define('AIT_OPTIONS_KEY', substr(AIT_DEFAULT_OPTIONS_KEY, 0, -2) . (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en'));

define('AIT_BRANDING_OPTIONS_KEY',  substr('ait_' . THEME_CODE_NAME . '_admin_branding_en', 0, -2) . (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en'));

$showAdmin = array();
if(file_exists(THEME_DIR."/config.php")){
	$showAdmin = parse_ini_file(THEME_DIR."/config.php");
}

if(file_exists(AIT_FRAMEWORK_DIR . '/dev-tools.php'))
	require AIT_FRAMEWORK_DIR . '/dev-tools.php';

require AIT_FRAMEWORK_DIR . '/Libs/Nette/nette.min.php';
require_once AIT_FRAMEWORK_DIR . '/ait-functions.php';

require AIT_FRAMEWORK_DIR . '/load.php';

$aitThemeConfig = loadConfig(THEME_DIR. '/conf/theme-config.neon');
if(!$aitThemeConfig) $aitThemeConfig = loadConfig(THEME_DIR. '/conf/@theme-config.neon');

$o = get_option(AIT_OPTIONS_KEY);
if($o === false){
	$o = get_option(AIT_DEFAULT_OPTIONS_KEY);
}

if($o !== false)
	$aitThemeOptions = arrayToObject($o);
else
	$aitThemeOptions = arrayToObject(aitGetThemeDefaultOptions($aitThemeConfig));

unset($o);

$aitBrandingOptions = arrayToObject(get_option(AIT_BRANDING_OPTIONS_KEY));

if(!is_admin()){

	WpLatte::$cacheDir = realpath(AIT_CACHE_DIR);
	WpLatte::$templatesDir = realpath(AIT_TEMPLATES_DIR);

	// global and allways accessible template variables
	$latteParams = array(
		// url shortcuts
		'themeUrl' => THEME_URL,
		'themeCssUrl' => THEME_CSS_URL,
		'themeJsUrl' => THEME_JS_URL,
		'themeImgUrl' => THEME_IMG_URL,
		'themeFontsUrl' => THEME_FONTS_URL,
		'styleCssUrl' => THEME_STYLESHEET_URL,
		'homeUrl' =>  home_url('/'),

		'themeOptions' => $aitThemeOptions,
		'bodyClasses' => '',
		'timthumbUrl' => TIMTHUMB_URL,
		'themeboxDir' => AIT_FRAMEWORK_DIR . '/ThemeBox',
	);

}else{
	require AIT_ADMIN_DIR . '/load.php';
}

if(is_user_logged_in() and is_admin_bar_showing() and current_user_can('manage_options')){
	addAitToAdminBar();
}


function aitLoginStyles()
{
	$b = @$GLOBALS['aitBrandingOptions']->branding;
	echo '<style type="text/css">' . str_replace('{$img}', THEME_URL . '/' . @$b->loginScreenLogo, @$b->loginScreenCss) . '</style>';
}

add_action('login_head', 'aitLoginStyles');
add_action('login_headerurl', create_function('', 'return "' . @$GLOBALS['aitBrandingOptions']->branding->loginScreenLogoLink . '";'));
add_action('login_headertitle', create_function('', 'return "' . @$GLOBALS['aitBrandingOptions']->branding->loginScreenLogoTooltip . '";'));

// Change http request time to correct load docs
function wp_change_request_timeout($time) {
	$time = 30; //new number of seconds
	return $time;
}
add_filter( 'http_request_timeout', 'wp_change_request_timeout');