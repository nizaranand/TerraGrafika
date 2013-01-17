{extends $layout}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog category clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">


				<header class="page-header">
					<h1 class="page-title">
						{__ 'Category Archives:'}<span>{$category->title}</span>
					</h1>

					{if strlen($category->description) !== 0}
						<div class="category-archive-meta">{!$category->description}</div>
					{/if}

				</header>

				{include snippets/content-nav.php location => 'nav-above'}

				{include snippets/content-loop.php posts => $posts}

				{include snippets/content-nav.php location => 'nav-below'}


		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{isActiveSidebar blog-sidebar}
	<div class="page-sidebar blog-sidebar right clearfix">
		{dynamicSidebar blog-sidebar}
	</div>
	{/isActiveSidebar}


	{else}

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			{include snippets/nothing-found.php}

		</div> <!-- /.content-wrapper -->
	</div> <!-- /#content -->

	{/if}

</div> <!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>

{/block}