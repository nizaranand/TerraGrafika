<header class="single-header clearfix">
	<div class="date round clearfix">
		<a href="{dayLink $post->date}" title="{$post->date|date:$site->dateFormat}" rel="bookmark">
			<div class="day">{$post->date|date:"d"}</div><div class="month">{$post->date|date:"M"}</div>
		</a>
	</div>
	<h1 class="single-entry-title left">{$post->title}</h1>
	<div class="comments right"><span>{$post->commentsCount}</span></div>
</header>