<?php //netteCache[01]000475a:2:{s:4:"time";s:21:"0.80074300 1358148220";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/author.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/author.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'di4kub9pt2')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbc908283f1e_content')) { function _lbc908283f1e_content($_l, $_args) { extract($_args)
?>

<section class="section content-section">

<div id="container" class="subpage blog clearfix <?php if(is_active_sidebar("blog-sidebar")): else: ?>
onecolumn<?php endif ?>">

<?php if ($posts): ?>

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

            <h1 class="page-title author">
                <?php echo NTemplateHelpers::escapeHtml(__('Author Archives:', 'ait'), ENT_NOQUOTES) ?>

                <span class="vcard">
                    <a class="url fn n" href="<?php echo htmlSpecialChars($author->postsUrl) ?>
" title="<?php echo htmlSpecialChars($author->name) ?>" rel="me"><?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?></a>
                </span>
            </h1>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['di4kub9pt2'])->render() ?>

<?php if (strlen($author->bio) !== 0): ?>
			<div id="author-info" class="clearfix">
				<div id="author-avatar" class="left"><?php echo $author->avatar(60) ?></div>
				<div id="author-description" class="left">
					<div class="author-name"><?php echo NTemplateHelpers::escapeHtml(_x('About', 'about author', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($author->name, ENT_NOQUOTES) ?></div>
					<div class="bio"><?php echo NTemplateHelpers::escapeHtml($author->bio, ENT_NOQUOTES) ?></div>
				</div>
			</div>
<?php endif ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['di4kub9pt2'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['di4kub9pt2'])->render() ?>

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

<?php if(is_active_sidebar("blog-sidebar")): ?>
	<div class="page-sidebar blog-sidebar right clearfix">
<?php dynamic_sidebar('blog-sidebar') ?>
	</div>
<?php endif ?>

<?php else: ?>

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['di4kub9pt2'])->render() ?>

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

<?php endif ?>

</div> <!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>

<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = true; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$_l->extends = $layout ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
