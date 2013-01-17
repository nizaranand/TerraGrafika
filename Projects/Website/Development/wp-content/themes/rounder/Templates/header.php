<!doctype html>

<!--[if IE 8]><html class="no-js oldie ie8 ie" lang="{$site->language}"><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" lang="{$site->language}"><!--<![endif]-->
    <head>
        <meta charset="{$site->charset}">        
        {mobileDetectionScript}
        <meta name="Author" content="AitThemes.com, http://www.ait-themes.com">

        <title>{title}</title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="{$site->pingbackUrl}">

        {if $themeOptions->fonts->fancyFont->type == 'google'}
        <link href="http://fonts.googleapis.com/css?family={$themeOptions->fonts->fancyFont->font}" rel="stylesheet" type="text/css">
        {/if}

        <link id="ait-style" rel="stylesheet" type="text/css" media="all" href="{less}">

        {head}
    </head>
    <body class="{bodyClasses $bodyClasses, ait-rounder}" data-themeurl="{$themeUrl}">

        <div class="topbar-sticky">
            <div class="topbar-line">&nbsp;</div>
            <div class="wrapper">
                <div class="menu-content clearfix left">

                    {var $duration = $themeOptions->general->mainmenu_dropdown_time . 's'}
                    {var $animation = $themeOptions->general->mainmenu_dropdown_animation}

                    <style type="text/css" scoped="scoped">
                        .mainmenu ul ul, .bubble {
                            transition-timing-function: {!$animation};
                            -moz-transition-timing-function: {!$animation}; 
                            -webkit-transition-timing-function: {!$animation}; 
                            -o-transition-timing-function: {!$animation}; 

                            transition-duration: {!$duration};
                            -moz-transition-duration: {!$duration};
                            -webkit-transition-duration: {!$duration};
                            -o-transition-duration: {!$duration};
                        }
                    </style>

                    {menu 'theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu' }
                    <div id="slidingArrow">&nbsp;</div>
                </div> <!-- /.menu-content -->
                <div class="side-right clearfix">
                    
                    {if $themeOptions->socialIcons->displayIcons}
                    {ifset $themeOptions->socialIcons->icons}
                    <ul class="social-icons right clearfix">
                        {foreach $themeOptions->socialIcons->icons as $icon}
                        <li class="left"><a href="{if !empty($icon->link)}{$icon->link}{else}#{/if}"><img src="{$icon->iconUrl}" height="30" width="30" alt="{$icon->title}" title="{$icon->title}"></a></li>
                        {/foreach}
                    </ul>
                    {/ifset}
                    {/if}
                </div> <!-- /.side-right -->
            </div> <!-- /.wrapper -->            
        </div> <!-- /.topbar-sticky -->
        <div class="logo-wrap wrapper">
            <a href="{$homeUrl}" class="logo">
                <img src="{$themeOptions->general->logo_img}" alt="logo">
                <span>{!$themeOptions->general->tagline}</span>
            </a>
        </div>