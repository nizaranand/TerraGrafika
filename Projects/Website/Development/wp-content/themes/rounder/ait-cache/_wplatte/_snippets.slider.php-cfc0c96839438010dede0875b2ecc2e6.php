<?php //netteCache[01]000484a:2:{s:4:"time";s:21:"0.44616000 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:95:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/slider.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/slider.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '4u3746hfa4')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($options->sliderEnable == 1): if ($options->sliderType == 'anything'): $slides = $site->create('slider-creator', $options->sliderCategory) ;if ($slides): ?>
			<ul id="slider">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($slides) as $slide): ?>
			<li>
				<a href="<?php echo htmlSpecialChars($slide->options->link) ?>">
<?php if (isset($slide->options->topImage)): if ((!empty($options->sliderHeight))): ?>
					<img src="<?php echo htmlSpecialChars($timthumbUrl) ?>?src=<?php echo htmlSpecialChars($slide->options->topImage) ?>
&amp;w=920&amp;h=<?php echo htmlSpecialChars($options->sliderHeight) ?>" alt="<?php echo htmlSpecialChars($slide->options->description) ?>" />
<?php else: ?>
					<img src="<?php echo htmlSpecialChars($timthumbUrl) ?>?src=<?php echo htmlSpecialChars($slide->options->topImage) ?>
&amp;w=920&amp;h=442" alt="<?php echo htmlSpecialChars($slide->options->description) ?>" />
<?php endif ;endif ?>
				</a>

<?php if ($slide->options->descriptionPosition != 'hide'): ?>
				<div class="entry-content anything-caption caption-<?php echo htmlSpecialChars($slide->options->descriptionPosition) ?>">
			       	<?php echo $slide->options->description ?>

			    </div>
<?php endif ?>
			</li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
			</ul>
<?php endif ;elseif ($options->sliderType == 'revolution'): if ($options->sliderAliases != 'null'): if (isset($options->sliderAlternative)): ?>
			<div class="slider-alternative" style="display: none">
				<img src="<?php echo htmlSpecialChars($options->sliderAlternative) ?>" alt="alternative" />
			</div>
<?php endif ?>
			<?php echo NTemplateHelpers::escapeHtml(putRevSlider($options->sliderAliases), ENT_NOQUOTES) ?>

<?php endif ;endif ;endif ;
