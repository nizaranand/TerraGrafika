<?php //netteCache[01]000474a:2:{s:4:"time";s:21:"0.79998300 1357903177";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/image.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/image.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'pfe9hcf8bi')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb642b1019ec_content')) { function _lb642b1019ec_content($_l, $_args) { extract($_args)
?>

<!-- SUBPAGE -->
<div id="container" class="subpage clearfix">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

<?php NCoreMacros::includeTemplate("snippets/image-nav.php", $template->getParams(), $_l->templates['pfe9hcf8bi'])->render() ?>

			<h1><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></h1>

			<div class="entry-meta">
<?php $metadata = wp_get_attachment_metadata() ?>

				<?php echo $template->printf(__('<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'ait'), esc_attr(get_the_time()), get_the_date(), esc_url(wp_get_attachment_url()), $metadata['width'], $metadata['height'], esc_url( get_permalink($post->parent)), esc_attr(strip_tags(get_the_title( $post->parent))), get_the_title($post->parent)) ?>


<?php edit_post_link(__("Edit"), "<span class=\"edit-link\">", "</span>", $post->id) ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">

				<div class="entry-attachment">
					<div class="attachment">
<?php $attachments = array_values( get_children( array( 'post_parent' => $post->parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) ) ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($attachments) as $k => $attachment): if ($attachment->ID == $post->id) break ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

<?php $k++ ?>


<?php if (count($attachments) > 1): if (isset($attachments[$k])): $next_attachment_url = get_attachment_link($attachments[$k]->ID) ;else: $next_attachment_url = get_attachment_link($attachments[0]->ID) ;endif ;else: $next_attachment_url = wp_get_attachment_url() ;endif ?>

						<a href="<?php echo htmlSpecialChars($next_attachment_url) ?>" title="<?php the_title_attribute() ?>" rel="attachment">
						<?php echo wp_get_attachment_image($post->id, array(1000, 1024)) ?>

						</a>

<?php if (!empty($post->excerpt)): ?>
						<div class="entry-caption">
<?php the_excerpt() ?>
						</div>
<?php endif ?>
					</div><!-- .attachment -->

				</div><!-- .entry-attachment -->

				<div class="entry-description">
					<?php echo $post->content ?>

				</div><!-- .entry-description -->

			</div><!-- .entry-content -->

			<div class="rule"></div>

<?php NCoreMacros::includeTemplate("comments.php", array('closeable' => $themeOptions->general->closeComments, 'defaultState' => $themeOptions->general->defaultPosition) + $template->getParams(), $_l->templates['pfe9hcf8bi'])->render() ?>

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->
</div><!-- end of container -->
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
