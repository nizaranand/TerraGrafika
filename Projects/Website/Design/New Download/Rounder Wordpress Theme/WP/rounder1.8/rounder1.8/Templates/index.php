{extends $layout}

{*
 {if !$isIndexPage}
	{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->order : null}
{/if}
*}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}
	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

		{if trim($post->content) != ""}
			{if !$isIndexPage}

			<header class="entry-title clearfix">
				{include snippets/header-icon.php}
				<h1>{$post->title}</h1>
				<span class="breadcrumbs">{__ 'You are here:'} {breadcrumbs}</span>
			</header>

			{!$post->content}

			{/if}
		{/if}


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


{if !$isIndexPage}
	{? isset($post->options('slider')->overrideGlobal) ? $slider = 'slider' : $slider = 'xb'}
	{define $slider}
		{include snippets/slider.php, options => $post->options('slider')}
	{/define}
{/if}