<?php //netteCache[01]000487a:2:{s:4:"time";s:21:"0.29734100 1358064977";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:98:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/posted-on.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/posted-on.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'tnhg8ndugh')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<header class="single-header clearfix">
	<div class="date round clearfix">
		<a href="<?php echo WpLatteFunctions::getDayLink($post->date) ?>" title="<?php echo htmlSpecialChars($template->date($post->date, $site->dateFormat)) ?>" rel="bookmark">
			<div class="day"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "d"), ENT_NOQUOTES) ?>
</div><div class="month"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "M"), ENT_NOQUOTES) ?></div>
		</a>
	</div>
	<h1 class="single-entry-title left"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>
	<div class="comments right"><span><?php echo NTemplateHelpers::escapeHtml($post->commentsCount, ENT_NOQUOTES) ?></span></div>
</header>