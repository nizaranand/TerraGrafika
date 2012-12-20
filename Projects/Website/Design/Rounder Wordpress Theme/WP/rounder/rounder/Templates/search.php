{extends $layout}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog search clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}
	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			<header class="page-header">
				<h1 class="page-title">
					{__ 'Search Results for:'} <span>{$site->searchQuery}</span>
				</h1>
			</header>

			<style type="text/css" scoped="scoped">
				div.non-thumb-item { display: none; }
				div.entry-thumb-img { display: none; }
				div.tool-buttons { display: none; }
			</style>

			{include snippets/content-nav.php location => 'nav-above'}

			{include snippets/content-loop.php posts => $posts}

			{include snippets/content-nav.php location => 'nav-below'}

		</div> <!-- /.content-wrapper -->
	</div><!-- /#content -->

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