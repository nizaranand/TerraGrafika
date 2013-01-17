<?php //netteCache[01]000491a:2:{s:4:"time";s:21:"0.54043700 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:101:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/presentation.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/presentation.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'w8i9oi8z3k')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($show == 'true' or $show == '1' or $show == 'yes'): if ($pictures): ?>
<section class="section presentation entry-content" data-effect="<?php echo htmlSpecialChars($options->presentationEffect) ?>">
        
    <div class="pictures-preload" style="display: none;">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($pictures) as $picture): ?>
        <img src="<?php echo $picture->thumbnailSrc ?>" alt="" />
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    </div>

    <div class="picture">
            <a href="<?php echo htmlSpecialChars($pictures[0]->options->link) ?>
"><img class="img" src="<?php echo htmlSpecialChars($pictures[0]->thumbnailSrc) ?>" alt="" /></a>
    </div>

    <div class="cont">
        
        <h2><?php echo NTemplateHelpers::escapeHtml($options->presentationTitle, ENT_NOQUOTES) ?></h2>

        <div class="picture-buttons clearfix">

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($pictures) as $picture): ?>
            <div class="pic-item <?php if ($iterator->first): ?>active<?php endif ?>">

                <h3><?php echo NTemplateHelpers::escapeHtml($picture->title, ENT_NOQUOTES) ?></h3>

                <div class="item-picture" style="display: none;"><?php echo $picture->thumbnailSrc ?></div>
                <div class="item-description" style="display: none;"><?php echo $picture->options->description ?></div>
                <div class="item-link" style="display: none;"><?php echo $picture->options->link ?></div>
                    
            </div><!-- /.item -->
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

        </div>

        <div class="description">
            <?php echo $pictures[0]->options->description ?>

        </div>

    </div>
	
<div class="rule-double">&nbsp;</div>
</section>
<?php endif ;endif ;
