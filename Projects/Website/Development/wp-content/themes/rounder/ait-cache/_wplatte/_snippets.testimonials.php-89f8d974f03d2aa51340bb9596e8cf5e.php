<?php //netteCache[01]000491a:2:{s:4:"time";s:21:"0.49012400 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:101:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/testimonials.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/testimonials.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '4w3k7sbir2')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if (!empty($options->testimonialsText)): if ($show == 'true' or $show == '1' or $show == 'yes'): ?>
    <section class="section testimonials entry-content">
        <div class="testimonials-container">
            <div class="testimonials defaultContentWidth clearfix">
                <p><?php echo $options->testimonialsText ?></p>
            </div>
            <style type="text/css" scoped="scoped">
                .section.testimonials .testimonials-container   { background-color: <?php echo $options->testimonialsBgColor ?>; }
                .section.testimonials                           { color: <?php echo $options->testimonialsColor ?>; }
                .section.testimonials a,
                .section.testimonials a:hover,
                .section.testimonials a:visited                 { color: <?php echo $options->testimonialsLinkColor ?>; }
            </style>
        </div>
        <div class="rule-double">&nbsp;</div>
    </section>
<?php endif ;endif ;
