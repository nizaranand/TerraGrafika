{getHeader}

	<div class="mainpage">

			<div id="sections">
				<div id="sections-container">

					{var $overrideSettings = FALSE}

					{if is_object($post)}
						{var $overrideSettings = strcmp($post->options('slider')->overrideGlobal["yes"], 'yes') === 0 ? TRUE : FALSE}
						{var $sliderBgImg = $post->options('slider')->sliderBgImg}
						{var $overrideSettings = empty($sliderBgImg) ? FALSE : TRUE}
					{/if}

					<div class="header-background-wrapper entry-content" style="{if $overrideSettings}background-image: url('{$sliderBgImg}');{/if}">
					{block slider}
						{include snippets/slider.php, options => $themeOptions->globals}
					{/block}
					</div>

					<div id="section-container" class="clearfix wrapper">

						{define sectionA}
							{include #content}
						{/define}

						{define sectionB}
							{include snippets/testimonials.php, show => $themeOptions->globals->showTestimonials, options => $themeOptions->globals}
						{/define}

		                {define sectionC}
	                        {include snippets/services-boxes.php, show => $themeOptions->globals->showServiceBoxes, boxes => $site->create('service-box', $themeOptions->globals->globalServiceBoxes)}
		                {/define}

		                {define sectionD}
	                        {include snippets/presentation.php, show => $themeOptions->globals->showPresentation, pictures => $site->create('presentation', $themeOptions->globals->globalPresentation), options => $themeOptions->globals}
		                {/define}

						{if !isset($sectionsOrder)} {var $sectionsOrder = $themeOptions->globals->sectionsOrder} {/if}

						{foreach $sectionsOrder as $section}
							{include #$section}
						{/foreach}

					</div>

				</div><!-- /#sections-container -->
			</div><!-- /#sections -->

	</div> <!-- /#mainpage -->

{getFooter}