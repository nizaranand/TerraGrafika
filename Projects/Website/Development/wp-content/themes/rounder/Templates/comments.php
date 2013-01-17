{ifset $closeable}
<div class="closeable">
	<div class="open-button {if $defaultState == 'opened'}comments-opened{else}comments-closed{/if}">
		{if $defaultState == 'opened'}
			{__ 'Close Comments'}
		{else}
			{__ 'Show Comments'}
		{/if}
	</div>
{/ifset}

<div id="comments">
{if !$post->isPasswordRequired}

{if $post->comments}

		<h2 id="comments-title">
			{commentTitle $post->title, $post->commentsCount, 'One thought on', 'Thoughts on'}
		</h2>

		{include snippets/comments-pagination.php, location => 'above'}

		{listComments comments => $post->comments}
			{if $comment->type == 'pingback' or $comment->type == 'trackback'}
			<li class="post pingback">
				<p>
				{__ 'Pingback'}
				{!$comment->author->link}
				{editCommentLink $comment->id}
				</p>
			{else}

			{* this is start tag, but end tag is missing in this template, it is included in {/listComments} macro. Weird. We know. *}
			<li class="{$comment->classes}">

				<article id="comment-{$comment->id}" class="comment">

					<div class="left controls clearfix">
						<div class="comment-avatar">{!$comment->author->avatar}</div>
						<div class="reply">{commentReplyLink 'Reply', $comment->args, $comment->depth, $comment->id}</div>
						{editCommentLink $comment->id}
					</div>

					<div class="body clearfix">
						<div class="arrow left"><!--  --></div>
						<div class="content ">
							<div>
								<span class="author vcard"><cite class="fn">{!$comment->author->nameWithLink}</cite></span><span class="eh">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class="date"><a href="{$comment->url}" class="comment-date"><time pubdate datetime="{$comment->date|date:'c'}">{$comment->date|date:$site->dateFormat} at {$comment->date|date:$site->timeFormat}</time></a></span>
							</div>
							{if !$comment->approved}
								<em class="comment-awaiting-moderation">{__ 'Your comment is awaiting moderation.'}</em><br>
							{/if}
							{!$comment->content}
						</div>
					</div>

				</article>
			{/if}
		{/listComments}

		{include snippets/comments-pagination.php, location => 'below'}

{elseif !$post->hasOpenComments && $post->type != 'page' && $post->hasSupportFor('comments')}

	<p class="nocomments">{__ 'Comments are closed.'}</p>

{/if}

{commentForm}

{else}
	<p class="nopassword">{__ 'This post is password protected. Enter the password to view any comments.'}</p>
{/if}
</div><!-- #comments -->

{ifset $closeable}
</div> 			<!-- /.closeable -->
{/ifset}