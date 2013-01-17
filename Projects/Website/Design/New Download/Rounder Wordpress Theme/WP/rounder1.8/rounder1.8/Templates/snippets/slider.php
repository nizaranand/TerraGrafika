{if $options->sliderEnable == 1}
	{if $options->sliderType == 'anything'}
		{var $slides = $site->create('slider-creator', $options->sliderCategory)}
		{if $slides}
			<ul id="slider" style="height: {$options->sliderHeight}px">
			{foreach $slides as $slide}
			<li>
				<a href="{$slide->options->link}">
				{ifset $slide->options->topImage}
					<img src="{$timthumbUrl}?src={$slide->options->topImage}&amp;w=920&amp;h={$options->sliderHeight}" alt="{$slide->options->description}" />
				{/ifset}
				</a>

				{if $slide->options->descriptionPosition != 'hide'}
				<div class="entry-content anything-caption caption-{$slide->options->descriptionPosition}">
			       	{!$slide->options->description}
			    </div>
			    {/if}
			</li>
			{/foreach}
			</ul>
		{/if}
	{elseif $options->sliderType == 'revolution'}
		{if $options->sliderAliases != 'null'}
			{if isset($options->sliderAlternative)}
			<div class="slider-alternative" style="display: none">
				<img src="{$options->sliderAlternative}" alt="alternative" />
			</div>
			{/if}
			{putRevSlider($options->sliderAliases)}
		{/if}
	{/if}
{/if}