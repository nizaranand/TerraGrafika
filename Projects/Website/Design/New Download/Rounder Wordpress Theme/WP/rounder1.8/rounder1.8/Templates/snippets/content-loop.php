<section class="blog clearfix">
	{foreach $posts as $post}

	{if $post->thumbnailSrc}
	<article id="post-{$post->id}" class="{$post->htmlClasses} clearfix">
	{else}
	<article id="post-{$post->id}" class="{$post->htmlClasses} no-thumbnail clearfix">
	{/if}

		<header class="entry-header left">
		{if $post->thumbnailSrc}

			<div class="entry-thumbnail">

				<a href="{$post->permalink}"><img src="{timthumb src => $post->thumbnailSrc, w => 140, h => 140}" alt=""/></a>

					<div class="date round clearfix">
						<a href="{dayLink $post->date}" title="{$post->date|date:$site->dateFormat}" rel="bookmark">
							<div class="day">{$post->date|date:"d"}</div><div class="month">{$post->date|date:"M"}</div>
						</a>
					</div>

					<div class="edit round">
						{editPostLink $post->id}
					</div>

			</div>

			{else}

			<div class="title-no-thumbnail">

						<div class="date round clearfix">
						<a href="{dayLink $post->date}" title="{$post->date|date:$site->dateFormat}" rel="bookmark">
							<div class="day">{$post->date|date:"d"}</div><div class="month">{$post->date|date:"M"}</div>
						</a>
						</div>

						<div class="edit round">
							{editPostLink $post->id}
						</div>

  				</div>

			{/if}

			</header><!-- .entry-header -->

			{if $site->isSearch}
			<div class="entry-preview left">

				<h2 class="entry-title">
					<a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a>
					<span class="share-button"><a href="{$post->permalink}" class="share-link" rel="prettySociable">{_x 'share', 'share button label'}</a></span>
				</h2>

				<div class="entry-summary">
					{$post->excerpt}
				</div><!-- .entry-summary -->

			</div>

			{else}

			<div class="entry-preview left">

			<h2 class="entry-title">
				<a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a>
				<span class="share-button"><a href="{$post->permalink}" class="share-link" rel="prettySociable">share</a></span>
			</h2>

			{!$post->content}

			<div class="entry-meta clearfix">

			<div class="left">
				<strong>Posted: </strong>
				<a class="url fn n ln" href="{$post->author->postsUrl}" title="{__ 'View all posts by'} {$post->author->name}" rel="author"> {$post->author->name}</a>
				<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
				{if $post->type == 'post'}
					{if $post->categories}
						<strong>Categories:</strong>
						{!$post->categories}
					{/if}
				{/if}
			</div>
			<div class="comments right"><span>{$post->commentsCount}</span></div>

			</div>
			</div><!-- .entry-content -->



			{postContentPager}

			{/if}

<!-- /.entry-meta -->
</article><!-- /#post-{$post->id} -->
{/foreach}
</section>