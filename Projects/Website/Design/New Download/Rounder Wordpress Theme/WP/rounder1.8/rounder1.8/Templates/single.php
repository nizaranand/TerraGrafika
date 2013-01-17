{extends $layout}

{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->order : null}

{block content}

<section class="section content-section">

<div id="container" class="subpage single clearfix {isActiveSidebar post-sidebar}{else}onecolumn{/isActiveSidebar}">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			{if $post->thumbnailSrc}
			<article id="post-{$post->id}" class="{$post->htmlClasses} clearfix">
			{else}
			<article id="post-{$post->id}" class="{$post->htmlClasses} no-thumbnail clearfix">
			{/if}

			{include snippets/posted-on.php}

			{if $post->thumbnailSrc != false }
			<a href="{$post->thumbnailSrc}">
			<div class="entry-thumbnail">
				{var $imgWidth = 1000}
				{isActiveSidebar post-sidebar} {var $imgWidth = 655} {/isActiveSidebar}
				<img src="{timthumb src => $post->thumbnailSrc, w => $imgWidth, h => 450}" alt="" />
			</div>
			</a>
			{/if}

			<div class="entry-content">
				{!$post->content}
			</div>

			<div class="entry-meta post-footer">

				{if $post->type == 'post'}
					<p>
						<span class="single-posted">
							<strong>{_x 'Posted:', 'posted'}</strong>
							<a class="url fn n ln" href="{$post->author->postsUrl}" title="{__ 'View all posts by'} {$post->author->name}" rel="author">
								{$post->author->name}
							</a>
						</span>
					<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		    		{if $post->categories}
		                	<span class="single-categories"><strong>{__ 'Categories:'}</strong> {!$post->categories}</span>
		            {/if}
		            </p>

					{if $post->tags}
					<p><span class="tag-links">
						<span class="entry-utility-prep entry-utility-prep-tag-links"><strong>{__ 'Tagged:'}</strong></span>
						{!$post->tags}
					</span></p>
					{/if}
				{/if}

			</div><!-- /.entry-meta -->

			{include 'snippets/post-nav.php' location=> nav-above}

		</article>

			{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

		</div><!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar post-sidebar}
	<div class="page-sidebar post-sidebar right clearfix">
		{dynamicSidebar post-sidebar}
	</div>
	{/isActiveSidebar}

</div ><!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>

{/block}


{? isset($post->options('testimonials')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
{define $sectionB}
	{include snippets/testimonials.php, show => $post->options('testimonials')->showTestimonials, options => $post->options('testimonials')}
{/define}

{? isset($post->options('service-boxes')->overrideGlobal) ? $sectionC = 'sectionC' : $sectionC = 'xc'}
{define $sectionC}
	{include snippets/services-boxes.php, show => $post->options('service-boxes')->showServiceBoxes, boxes => $site->create('service-box', $post->options('service-boxes')->category)}
{/define}

{? isset($post->options('presentation')->overrideGlobal) ? $sectionD = 'sectionD' : $sectionD = 'xd'}
{define $sectionD}
	{include snippets/presentation.php, show => $post->options('presentation')->showPresentation, options => $post->options('presentation'), pictures => $site->create('presentation', $post->options('presentation')->presentationType) }
{/define}