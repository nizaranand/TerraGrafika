<?php //netteCache[01]000476a:2:{s:4:"time";s:21:"0.36706400 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/@layout.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/@layout.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '8qb3alks5h')
;//
// block slider
//
if (!function_exists($_l->blocks['slider'][] = '_lb418f2caeaa_slider')) { function _lb418f2caeaa_slider($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/slider.php", array('options' => $themeOptions->globals) + $template->getParams(), $_l->templates['8qb3alks5h'])->render() ;
}}

//
// block sectionA
//
if (!function_exists($_l->blocks['sectionA'][] = '_lb7ca7b0d730_sectionA')) { function _lb7ca7b0d730_sectionA($_l, $_args) { extract($_args)
;NUIMacros::callBlock($_l, 'content', $template->getParams()) ;
}}

//
// block sectionB
//
if (!function_exists($_l->blocks['sectionB'][] = '_lb3b5a955521_sectionB')) { function _lb3b5a955521_sectionB($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/testimonials.php", array('show' => $themeOptions->globals->showTestimonials, 'options' => $themeOptions->globals) + $template->getParams(), $_l->templates['8qb3alks5h'])->render() ;
}}

//
// block sectionC
//
if (!function_exists($_l->blocks['sectionC'][] = '_lb4e52402d50_sectionC')) { function _lb4e52402d50_sectionC($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/services-boxes.php", array('show' => $themeOptions->globals->showServiceBoxes, 'boxes' => $site->create('service-box', $themeOptions->globals->globalServiceBoxes)) + $template->getParams(), $_l->templates['8qb3alks5h'])->render() ;
}}

//
// block sectionD
//
if (!function_exists($_l->blocks['sectionD'][] = '_lb11618bb6b9_sectionD')) { function _lb11618bb6b9_sectionD($_l, $_args) { extract($_args)
;NCoreMacros::includeTemplate("snippets/presentation.php", array('show' => $themeOptions->globals->showPresentation, 'pictures' => $site->create('presentation', $themeOptions->globals->globalPresentation), 'options' => $themeOptions->globals) + $template->getParams(), $_l->templates['8qb3alks5h'])->render() ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extends) ? FALSE : $template->_extends; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
get_header("") ?>

	<div class="mainpage">

			<div id="sections">
				<div id="sections-container">

<?php $overrideSettings = FALSE ?>

<?php if (is_object($post)): $overrideSettings = strcmp($post->options('slider')->overrideGlobal["yes"], 'yes') === 0 ? TRUE : FALSE ;$sliderBgImg = $post->options('slider')->sliderBgImg ;$overrideSettings = empty($sliderBgImg) ? FALSE : TRUE ;endif ?>

					<div class="header-background-wrapper entry-content" style="<?php if ($overrideSettings): ?>
background-image: url('<?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($sliderBgImg)) ?>
');<?php endif ?>">
<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['slider']), $_l, get_defined_vars()); } ?>
					</div>

					<div id="section-container" class="clearfix wrapper">





						<?php if (!isset($sectionsOrder)): ?> <?php $sectionsOrder = $themeOptions->globals->sectionsOrder ?>
 <?php endif ?>


<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($sectionsOrder) as $section): NUIMacros::callBlock($_l, $section, $template->getParams()) ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

					</div>

				</div><!-- /#sections-container -->
			</div><!-- /#sections -->

	</div> <!-- /#mainpage -->

<?php get_footer("") ;
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
