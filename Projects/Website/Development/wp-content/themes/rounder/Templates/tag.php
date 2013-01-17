{extends $layout}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog tag clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			{if $posts}

				<header class="page-header">

					<h1 class="page-title">
						{__ 'Tag Archives:'} <span>{$tag->title}</span>
					</h1>

					{if !empty($tag->description)}
						<div class="category-archive-meta">{!$tag->description}</div>
					{/if}
					
				</header>

				{include snippets/content-nav.php location => 'nav-above'}

				{include snippets/content-loop.php posts => $posts}

				{include snippets/content-nav.php location => 'nav-below'}

			{else}

				{include snippets/nothing-found.php}

			{/if}

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar blog-sidebar}
	<div class="page-sidebar blog-sidebar right clearfix">
		{dynamicSidebar blog-sidebar}
	</div>
	{/isActiveSidebar}

</div> <!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>

{/block}