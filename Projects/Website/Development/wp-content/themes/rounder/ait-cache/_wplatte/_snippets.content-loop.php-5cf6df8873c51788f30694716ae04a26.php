<?php //netteCache[01]000491a:2:{s:4:"time";s:21:"0.47519700 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:101:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/content-loop.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/content-loop.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'jbdtnkbsvh')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<section class="blog clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($posts) as $post): ?>

<?php if ($post->thumbnailSrc): ?>
	<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?> clearfix">
<?php else: ?>
	<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?> no-thumbnail clearfix">
<?php endif ?>

		<header class="entry-header left">
<?php if ($post->thumbnailSrc): ?>

			<div class="entry-thumbnail">

				<a href="<?php echo htmlSpecialChars($post->permalink) ?>"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $post->thumbnailSrc, 'w' => 140, 'h' => 140), "", "&amp;") ?>" alt="" /></a>

					<div class="date round clearfix">
						<a href="<?php echo WpLatteFunctions::getDayLink($post->date) ?>" title="<?php echo htmlSpecialChars($template->date($post->date, $site->dateFormat)) ?>" rel="bookmark">
							<div class="day"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "d"), ENT_NOQUOTES) ?>
</div><div class="month"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "M"), ENT_NOQUOTES) ?></div>
						</a>
					</div>

					<div class="edit round">
<?php edit_post_link(__("Edit"), "<span class=\"edit-link\">", "</span>", $post->id) ?>
					</div>

			</div>

<?php else: ?>

			<div class="title-no-thumbnail">

						<div class="date round clearfix">
						<a href="<?php echo WpLatteFunctions::getDayLink($post->date) ?>" title="<?php echo htmlSpecialChars($template->date($post->date, $site->dateFormat)) ?>" rel="bookmark">
							<div class="day"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "d"), ENT_NOQUOTES) ?>
</div><div class="month"><?php echo NTemplateHelpers::escapeHtml($template->date($post->date, "M"), ENT_NOQUOTES) ?></div>
						</a>
						</div>

						<div class="edit round">
<?php edit_post_link(__("Edit"), "<span class=\"edit-link\">", "</span>", $post->id) ?>
						</div>

  				</div>

<?php endif ?>

			</header><!-- .entry-header -->

<?php if ($site->isSearch): ?>
			<div class="entry-preview left">

				<h2 class="entry-title">
					<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="<?php echo htmlSpecialChars(__('Permalink to', 'ait')) ?>
 <?php echo htmlSpecialChars($post->title) ?>" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
					<span class="share-button"><a href="<?php echo htmlSpecialChars($post->permalink) ?>
" class="share-link" rel="prettySociable"><?php echo NTemplateHelpers::escapeHtml(_x('share', 'share button label', 'ait'), ENT_NOQUOTES) ?></a></span>
				</h2>

				<div class="entry-summary">
					<?php echo NTemplateHelpers::escapeHtml($post->excerpt, ENT_NOQUOTES) ?>

				</div><!-- .entry-summary -->

			</div>

<?php else: ?>

			<div class="entry-preview left">

			<h2 class="entry-title">
				<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="Permalink to <?php echo htmlSpecialChars($post->title) ?>
" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
				<span class="share-button"><a href="<?php echo htmlSpecialChars($post->permalink) ?>" class="share-link" rel="prettySociable">share</a></span>
			</h2>

			<?php echo $post->content ?>


			<div class="entry-meta clearfix">

			<div class="left">
				<strong>Posted: </strong>
				<a class="url fn n ln" href="<?php echo htmlSpecialChars($post->author->postsUrl) ?>
" title="<?php echo htmlSpecialChars(__('View all posts by', 'ait')) ?> <?php echo htmlSpecialChars($post->author->name) ?>
" rel="author"> <?php echo NTemplateHelpers::escapeHtml($post->author->name, ENT_NOQUOTES) ?></a>
				<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
<?php if ($post->type == 'post'): if ($post->categories): ?>
						<strong>Categories:</strong>
						<?php echo $post->categories ?>

<?php endif ;endif ?>
			</div>
			<div class="comments right"><span><?php echo NTemplateHelpers::escapeHtml($post->commentsCount, ENT_NOQUOTES) ?></span></div>

			</div>
			</div><!-- .entry-content -->



<?php 
			$a = array();
			if(empty($a)){
				wp_link_pages(array(
					"before" => "<div class=\"page-link\"><span>" . __("Pages:") . "</span>",
					"after" => "</div>"
				));
			}else{
				wp_link_pages(array(
					"before" => $a[1] . "<span>" . $a[0] . "</span>",
					"after" => $a[2]
				));
			}
			unset($a) ?>

<?php endif ?>

<!-- /.entry-meta -->
</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</section>