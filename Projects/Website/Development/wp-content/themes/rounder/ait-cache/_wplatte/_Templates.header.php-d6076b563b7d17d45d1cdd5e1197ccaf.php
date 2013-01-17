<?php //netteCache[01]000475a:2:{s:4:"time";s:21:"0.98843800 1358393515";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/header.php";i:2;i:1358393513;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/header.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'bw9vdgzy8z')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!doctype html>

<!--[if IE 8]><html class="no-js oldie ie8 ie" lang="<?php echo NTemplateHelpers::escapeHtmlComment($site->language) ?>"><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" lang="<?php echo htmlSpecialChars($site->language) ?>"><!--<![endif]-->
    <head>
        <meta charset="<?php echo htmlSpecialChars($site->charset) ?>" />        
<script type='text/javascript'>var ua = navigator.userAgent; var meta = document.createElement('meta');if((ua.toLowerCase().indexOf('android') > -1 && ua.toLowerCase().indexOf('mobile')) || ((ua.match(/iPhone/i)) || (ua.match(/iPod/i)))){ meta.name = 'viewport';	meta.content = 'target-densitydpi=device-dpi, width=480'; }var m = document.getElementsByTagName('meta')[0]; m.parentNode.insertBefore(meta,m);</script>         <meta name="Author" content="AitThemes.com, http://www.ait-themes.com" />

        <title><?php echo WpLatteFunctions::getTitle() ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php echo htmlSpecialChars($site->pingbackUrl) ?>" />

<?php if ($themeOptions->fonts->fancyFont->type == 'google'): ?>
        <link href="http://fonts.googleapis.com/css?family=<?php echo htmlSpecialChars($themeOptions->fonts->fancyFont->font) ?>" rel="stylesheet" type="text/css" />
<?php endif ?>

        <link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo WpLatteFunctions::lessify() ?>" />

<?php if(is_singular() && get_option("thread_comments")){wp_enqueue_script("comment-reply");}wp_head() ?>
    </head>
    <body class="<?php echo join(' ', get_body_class()) . ' ' . join(' ', array($bodyClasses, 'ait-rounder')) ?>
" data-themeurl="<?php echo htmlSpecialChars($themeUrl) ?>">

        <div class="topbar-sticky">
            <div class="topbar-line">&nbsp;</div>
            <div class="wrapper">
                <div class="menu-content clearfix left">

<?php $duration = $themeOptions->general->mainmenu_dropdown_time . 's' ;$animation = $themeOptions->general->mainmenu_dropdown_animation ?>

                    <style type="text/css" scoped="scoped">
                        .mainmenu ul ul, .bubble {
                            transition-timing-function: <?php echo $animation ?>;
                            -moz-transition-timing-function: <?php echo $animation ?>; 
                            -webkit-transition-timing-function: <?php echo $animation ?>; 
                            -o-transition-timing-function: <?php echo $animation ?>; 

                            transition-duration: <?php echo $duration ?>;
                            -moz-transition-duration: <?php echo $duration ?>;
                            -webkit-transition-duration: <?php echo $duration ?>;
                            -o-transition-duration: <?php echo $duration ?>;
                        }
                    </style>

<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu')) ?>
                    <div id="slidingArrow">&nbsp;</div>
                </div> <!-- /.menu-content -->
                <div class="side-right clearfix">
                    
<?php if ($themeOptions->socialIcons->displayIcons): if (isset($themeOptions->socialIcons->icons)): ?>
                    <ul class="social-icons right clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($themeOptions->socialIcons->icons) as $icon): ?>
                        <li class="left"><a href="<?php if (!empty($icon->link)): echo htmlSpecialChars($icon->link) ;else: ?>
#<?php endif ?>"><img src="<?php echo htmlSpecialChars($icon->iconUrl) ?>" height="30" width="30" alt="<?php echo htmlSpecialChars($icon->title) ?>
" title="<?php echo htmlSpecialChars($icon->title) ?>" /></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
                    </ul>
<?php endif ;endif ?>
                </div> <!-- /.side-right -->
            </div> <!-- /.wrapper -->            
        </div> <!-- /.topbar-sticky -->
        <div class="logo-wrap wrapper">
            <a href="<?php echo htmlSpecialChars($homeUrl) ?>" class="logo">
                <img src="<?php echo htmlSpecialChars($themeOptions->general->logo_img) ?>" alt="logo" />
                <span><?php echo $themeOptions->general->tagline ?></span>
            </a>
        </div>