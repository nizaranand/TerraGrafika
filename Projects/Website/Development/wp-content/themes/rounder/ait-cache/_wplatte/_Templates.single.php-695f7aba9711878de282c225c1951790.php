<?php //netteCache[01]000475a:2:{s:4:"time";s:21:"0.47680100 1358394382";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/single.php";i:2;i:1358394380;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/single.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'x3izgwshbx')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbef114643e6_content')) { function _lbef114643e6_content($_l, $_args) { extract($_args)
?>

<section class="section content-section">

<div id="container" class="subpage single clearfix <?php if(is_active_sidebar("post-sidebar")): else: ?>
onecolumn<?php endif ?>">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

<?php if ($post->thumbnailSrc): ?>
			<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?> clearfix">
<?php else: ?>
			<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?> no-thumbnail clearfix">
<?php endif ?>

<?php NCoreMacros::includeTemplate("snippets/posted-on.php", $template->getParams(), $_l->templates['x3izgwshbx'])->render() ?>

<?php if ($post->thumbnailSrc != false): ?>
			<a href="<?php echo htmlSpecialChars($post->thumbnailSrc) ?>">
			<div class="entry-thumbnail">
<?php $imgWidth = 1000 ?>
				<?php if(is_active_sidebar("post-sidebar")): ?> <?php $imgWidth = 655 ?> <?php endif ?>

				<img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $post->thumbnailSrc, 'w' => $imgWidth, 'h' => 450), "", "&amp;") ?>" alt="" />
			</div>
			</a>
<?php endif ?>

			<div class="entry-content">
				<?php echo $post->content ?>

			</div>

			<div class="entry-meta post-footer">

<?php if ($post->type == 'post'): ?>
					<p>
						<span class="single-posted">
							<strong><?php echo NTemplateHelpers::escapeHtml(_x('Posted:', 'posted', 'ait'), ENT_NOQUOTES) ?></strong>
							<a class="url fn n ln" href="<?php echo htmlSpecialChars($post->author->postsUrl) ?>
" title="<?php echo htmlSpecialChars(__('View all posts by', 'ait')) ?> <?php echo htmlSpecialChars($post->author->name) ?>" rel="author">
								<?php echo NTemplateHelpers::escapeHtml($post->author->name, ENT_NOQUOTES) ?>

							</a>
						</span>
					<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
<?php if ($post->categories): ?>
		                	<span class="single-categories"><strong><?php echo NTemplateHelpers::escapeHtml(__('Categories:', 'ait'), ENT_NOQUOTES) ?>
</strong> <?php echo $post->categories ?></span>
<?php endif ?>
		            </p>

<?php if ($post->tags): ?>
					<p><span class="tag-links">
						<span class="entry-utility-prep entry-utility-prep-tag-links"><strong><?php echo NTemplateHelpers::escapeHtml(__('Tagged:', 'ait'), ENT_NOQUOTES) ?></strong></span>
						<?php echo $post->tags ?>

					</span></p>
<?php endif ;endif ?>

			</div><!-- /.entry-meta -->

<?php NCoreMacros::includeTemplate('snippets/post-nav.php', array('location'=> 'nav-above') + $template->getParams(), $_l->templates['x3izgwshbx'])->render() ?>

		</article>



		</div><!-- /.content-wrapper -->
	</div> <!-- /#content -->

<?php if(is_active_sidebar("post-sidebar")): ?>
	<div class="page-sidebar post-sidebar right clearfix">
<?php dynamic_sidebar('post-sidebar') ?>
	</div>
<?php endif ?>

</div ><!-- /#container -->

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

<?php $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->order : null ?>



<?php isset($post->options('testimonials')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb' ;//
// block $sectionB
//
if (!function_exists($_l->blocks[$sectionB][] = '_lb600f95e27c__sectionB')) { function _lb600f95e27c__sectionB($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/testimonials.php", array('show' => $post->options('testimonials')->showTestimonials, 'options' => $post->options('testimonials')) + $template->getParams(), $_l->templates['x3izgwshbx'])->render() ;}} call_user_func(reset($_l->blocks[$sectionB]), $_l, get_defined_vars()) ?>

<?php isset($post->options('service-boxes')->overrideGlobal) ? $sectionC = 'sectionC' : $sectionC = 'xc' ;//
// block $sectionC
//
if (!function_exists($_l->blocks[$sectionC][] = '_lb3322a96ed3__sectionC')) { function _lb3322a96ed3__sectionC($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/services-boxes.php", array('show' => $post->options('service-boxes')->showServiceBoxes, 'boxes' => $site->create('service-box', $post->options('service-boxes')->category)) + $template->getParams(), $_l->templates['x3izgwshbx'])->render() ;}} call_user_func(reset($_l->blocks[$sectionC]), $_l, get_defined_vars()) ?>

<?php isset($post->options('presentation')->overrideGlobal) ? $sectionD = 'sectionD' : $sectionD = 'xd' ;//
// block $sectionD
//
if (!function_exists($_l->blocks[$sectionD][] = '_lbb1b3eda05f__sectionD')) { function _lbb1b3eda05f__sectionD($_l, $_args) { extract($_args) ;NCoreMacros::includeTemplate("snippets/presentation.php", array('show' => $post->options('presentation')->showPresentation, 'options' => $post->options('presentation'), 'pictures' => $site->create('presentation', $post->options('presentation')->presentationType)) + $template->getParams(), $_l->templates['x3izgwshbx'])->render() ;}} call_user_func(reset($_l->blocks[$sectionD]), $_l, get_defined_vars()) ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
