{extends $layout}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">


				<header class="page-header">
					<h1 class="page-title">
						{if $archive->isDay}
							{__ 'Daily Archives:'} <span>{$posts[0]->date|date:$site->dateFormat}</span>
						{elseif $archive->isMonth}
							{__ 'Monthly Archives:'}' <span>{$posts[0]->date|date:'F Y'}</span>
						{elseif $archive->isYear}
							{__ 'Yearly Archives:'}' <span>{$posts[0]->date|date:'Y'}</span>
						{else}
							{__ 'Blog Archives'}
						{/if}
					</h1>
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

</div><!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>

{/block}