<?php //netteCache[01]000473a:2:{s:4:"time";s:21:"0.95784000 1357886037";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:84:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/page.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/page.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'rf561i0qlp')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbfc6d4ef417_content')) { function _lbfc6d4ef417_content($_l, $_args) { extract($_args)
?>

<?php if (trim($post->content) != ""): ?>
<section class="section content-section">

<div id="container" class="subpage clearfix <?php if(is_active_sidebar("subpages-sidebar")): else: ?>
onecolumn<?php endif ?>">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			<header class="entry-title clearfix">
<?php NCoreMacros::includeTemplate("snippets/header-icon.php", $template->getParams(), $_l->templates['rf561i0qlp'])->render() ?>
				<h1><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>
				<span class="breadcrumbs"><?php echo NTemplateHelpers::escapeHtml(__('You are here:', 'ait'), ENT_NOQUOTES) ?>
 <?php echo WpLatteFunctions::breadcrumbs(array()) ?></span>
			</header>

			<?php echo $post->content ?>


		</div> <!-- /.content-wrapper -->

<?php NCoreMacros::includeTemplate("comments.php", array('closeable' => $themeOptions->general->closeComments, 'defaultState' => $themeOptions->general->defaultPosition) + $template->getParams(), $_l->templates['rf561i0qlp'])->render() ?>

	</div><!-- /#content -->

<?php if(is_active_sidebar("subpages-sidebar")): ?>
	<div class="page-sidebar subpage-sidebar right clearfix">
<?php dynamic_sidebar('subpages-sidebar') ?>
	</div>
<?php endif ?>

</div><!-- /#container -->

</section>
<?php endif ?>

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


<?php $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->order : null ?>




<?php isset($post->options('slider')->overrideGlobal) ? $slider = 'slider' : $slider = 'xa' ;//
// block $slider
//
if (!function_exists($_l->blocks[$slider][] = '_lb7c1e59b76c__slider')) { function _lb7c1e59b76c__slider($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $post->options('slider')) + $template->getParams(), $_l->templates['rf561i0qlp'])->render() ;}} call_user_func(reset($_l->blocks[$slider]), $_l, get_defined_vars()) ?>

<?php isset($post->options('testimonials')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lb806e9be60d__sectionB')) { function _lb806e9be60d__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/testimonials.php", array('show' => $post->options('testimonials')->showTestimonials, 'options' => $post->options('testimonials')) + $template->getParams(), $_l->templates['rf561i0qlp'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ?>

<?php isset($post->options('service-boxes')->overrideGlobal) ? $sectionC = 'sectionC' : $sectionC = 'xc' ;//
// block $sectionC
//
if (!function_exists($_l->blocks[$sectionC][] = '_lb4b63fda1ba__sectionC')) { function _lb4b63fda1ba__sectionC($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/services-boxes.php", array('show' => $post->options('service-boxes')->showServiceBoxes, 'boxes' => $site->create('service-box', $post->options('service-boxes')->category)) + $template->getParams(), $_l->templates['rf561i0qlp'])->render() ;}} call_user_func(reset($_l->blocks[$sectionC]), $_l, get_defined_vars()) ?>

<?php isset($post->options('presentation')->overrideGlobal) ? $sectionD = 'sectionD' : $sectionD = 'xd' ;//
// block $sectionD
//
if (!function_exists($_l->blocks[$sectionD][] = '_lba57f170084__sectionD')) { function _lba57f170084__sectionD($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/presentation.php", array('show' => $post->options('presentation')->showPresentation, 'options' => $post->options('presentation'), 'pictures' => $site->create('presentation', $post->options('presentation')->presentationType)) + $template->getParams(), $_l->templates['rf561i0qlp'])->render() ;}} call_user_func(reset($_l->blocks[$sectionD]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
