{foreach $site->widgets('sidebar') as $widget}
	{if is_active_sidebar($widget)}
	<div class="tabs-container">
		<div class="tabs-panels">
		{dynamicSidebar $widget}
		</div> <!-- /.tabs-panels -->
	</div> <!-- /.tabs-container -->

	{/if}
{/foreach}