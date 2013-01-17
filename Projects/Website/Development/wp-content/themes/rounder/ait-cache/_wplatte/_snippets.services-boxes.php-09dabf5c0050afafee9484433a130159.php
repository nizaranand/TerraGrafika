<?php //netteCache[01]000493a:2:{s:4:"time";s:21:"0.50796700 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:103:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/services-boxes.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/services-boxes.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'xt8f31uvsn')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($show == 'true' or $show == '1' or $show == 'yes'): if ($boxes): ?>
<section class="section services entry-content">
	<div class="sboxes-wrap clearfix">
<?php $width  = 1000 ;$margin = 45 ;$i = 0 ?>
		
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($boxes) as $box): $i++ ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		
<?php $sboxesWidth = ($width-(($i-1)*$margin))/$i ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($boxes) as $box): ?>
			
			<div class="clearfix sbox sbox<?php echo htmlSpecialChars($iterator->counter) ?>
 <?php if ($iterator->first): ?>first-sbox<?php elseif ($iterator->last): ?>last-sbox<?php endif ?>" 
				style="width: <?php if (isset($box->options->boxWidth)): echo htmlSpecialChars(NTemplateHelpers::escapeCss($box->options->boxWidth)) ;echo $sboxesWidth ?>
px<?php endif ?>;">
				<div class="sbox-wrap">
					<div class="sbox-content clear clearfix">

						<h2 class="title"><a href="<?php echo htmlSpecialChars($box->options->boxLink) ?>">
							<span class="title-text"><?php echo NTemplateHelpers::escapeHtml($box->title, ENT_NOQUOTES) ?></span>
							<span class="title-icon">
								<span class="mwrap">
									<span class="molecule">
										<span class="p1wrap"><span class="particle1">&nbsp;</span></span>
										<span class="p2wrap"><span class="particle2">&nbsp;</span></span>
										<span class="p3wrap"><span class="particle3">&nbsp;</span></span>
									</span>
									<img src="<?php echo htmlSpecialChars($box->thumbnailSrc) ?>" alt="<?php echo htmlSpecialChars($box->title) ?>" width="65" height="65" class="ico" />
								</span>
							</span>
						</a></h2>
						<p class="left"><?php echo NTemplateHelpers::escapeHtml($box->options->boxText, ENT_NOQUOTES) ?></p>
						<!--<a href="<?php echo NTemplateHelpers::escapeHtmlComment($box->options->boxLink) ?>
" class="more"><?php echo NTemplateHelpers::escapeHtmlComment($box->options->boxMoreText) ?></a>-->
				    </div>
				</div>
			</div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</div><!-- end of services -->
	<div class="rule-double">&nbsp;</div>
</section>
<?php endif ;endif ;
