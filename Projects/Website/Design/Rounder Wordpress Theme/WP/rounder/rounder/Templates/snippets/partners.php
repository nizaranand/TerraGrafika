{if !empty($partners)}

	<div class="clear partners-section">
		<div class="partners-container">
			<ul id="partners-list" class="clearfix clear partners">
				{foreach $partners as $partner}
					<li>
						<a href="{$partner->options->partnersLink}" title="{$partner->title}">

							<span class="thumb"><img src="{$partner->thumbnailSrc}" alt="{$partner->title}" /></span>
							<!--<span class="title">{$partner->title}</span>-->
						</a>
					</li>
				{/foreach}
			</ul>
		</div>
	</div><!-- end of partners -->
{/if}