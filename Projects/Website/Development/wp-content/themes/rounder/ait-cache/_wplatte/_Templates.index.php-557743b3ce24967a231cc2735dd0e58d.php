<?php //netteCache[01]000474a:2:{s:4:"time";s:21:"0.35451400 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/index.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/index.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '3ppce088nx')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb4dbe33ba7d_content')) { function _lb4dbe33ba7d_content($_l, $_args) { extract($_args)
?>

<section class="section content-section">

<div id="container" class="subpage blog clearfix <?php if(is_active_sidebar("blog-sidebar")): else: ?>
onecolumn<?php endif ?>">

<?php if ($posts): ?>
	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

<?php if (trim($post->content) != ""): if (!$isIndexPage): ?>

			<header class="entry-title clearfix">
<?php NCoreMacros::includeTemplate("snippets/header-icon.php", $template->getParams(), $_l->templates['3ppce088nx'])->render() ?>
				<h1><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>
				<span class="breadcrumbs"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?>
 <?php echo WpLatteFunctions::breadcrumbs(array()) ?></span>
			</header>

			<?php echo $post->content ?>


<?php endif ;endif ?>


<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['3ppce088nx'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['3ppce088nx'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['3ppce088nx'])->render() ?>


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

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['3ppce088nx'])->render() ?>

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



<?php if (!$isIndexPage): isset($post->options('slider')->overrideGlobal) ? $slider = 'slider' : $slider = 'xb' ;//
// block $slider
//
if (!function_exists($_l->blocks[$slider][] = '_lb8c52c87f05__slider')) { function _lb8c52c87f05__slider($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $post->options('slider')) + $template->getParams(), $_l->templates['3ppce088nx'])->render() ;}} call_user_func(reset($_l->blocks[$slider]), $_l, get_defined_vars()) ;endif ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
