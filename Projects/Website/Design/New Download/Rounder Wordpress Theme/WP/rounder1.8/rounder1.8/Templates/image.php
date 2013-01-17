{extends $layout}

{block content}

<!-- SUBPAGE -->
<div id="container" class="subpage clearfix">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			{include snippets/image-nav.php}

			<h1>{$post->title}</h1>

			<div class="entry-meta">
				{var $metadata = wp_get_attachment_metadata()}

				{!__ '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>'
					|printf: esc_attr(get_the_time()),
						get_the_date(),
						esc_url(wp_get_attachment_url()),
						$metadata['width'],
						$metadata['height'],
						esc_url( get_permalink($post->parent)),
						esc_attr(strip_tags(get_the_title( $post->parent))),
						get_the_title($post->parent)}

				{editPostLink $post->id}
			</div><!-- .entry-meta -->

			<div class="entry-content">

				<div class="entry-attachment">
					<div class="attachment">
					{var $attachments = array_values( get_children( array( 'post_parent' => $post->parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) )}

					{foreach $attachments as $k => $attachment}
						{breakIf $attachment->ID == $post->id}
					{/foreach}

					{? $k++}


					{if count($attachments) > 1}
						{ifset $attachments[$k]}
							{var $next_attachment_url = get_attachment_link($attachments[$k]->ID)}
						{else}
							{var $next_attachment_url = get_attachment_link($attachments[0]->ID)}
						{/ifset}
					{else}
						{var $next_attachment_url = wp_get_attachment_url()}
					{/if}

						<a href="{$next_attachment_url}" title="{? the_title_attribute()}" rel="attachment">
						{!=wp_get_attachment_image($post->id, array(1000, 1024))}
						</a>

						{if !empty($post->excerpt)}
						<div class="entry-caption">
							{? the_excerpt()}
						</div>
						{/if}
					</div><!-- .attachment -->

				</div><!-- .entry-attachment -->

				<div class="entry-description">
					{!$post->content}
				</div><!-- .entry-description -->

			</div><!-- .entry-content -->

			<div class="rule"></div>

			{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

		</div><!-- end of content-wrapper -->
	</div><!-- end of mainbar -->
</div><!-- end of container -->
{/block}
