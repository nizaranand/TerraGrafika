{extends $layout}

{block content}

<section class="section content-section">

<div id="container" class="subpage blog clearfix {isActiveSidebar blog-sidebar}{else}onecolumn{/isActiveSidebar}">

	{if $posts}

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

            <h1 class="page-title author">
                {__ 'Author Archives:'}
                <span class="vcard">
                    <a class="url fn n" href="{$author->postsUrl}" title="{$author->name}" rel="me">{$author->name}</a>
                </span>
            </h1>

			{include snippets/content-nav.php location => nav-above}

			{if strlen($author->bio) !== 0}
			<div id="author-info" class="clearfix">
				<div id="author-avatar" class="left">{!$author->avatar(60)}</div>
				<div id="author-description" class="left">
					<div class="author-name">{_x 'About', 'about author'} {$author->name}</div>
					<div class="bio">{$author->bio}</div>
				</div>
			</div>
			{/if}

			{include snippets/content-loop.php posts => $posts}

			{include snippets/content-nav.php location => nav-below}

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