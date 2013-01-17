<footer class="page-footer mainpage" role="contentinfo">
	{isActiveSidebar footer-widgets}
	<div class="footer-widgets">
		<div class="wrapper">
			<div class="holder">
				{dynamicSidebar footer-widgets}
			</div>
		</div>
	</div>
	{/isActiveSidebar}
	<div class="foot-holder">
		<div class="wrapper">
			<div class="left">{doShortcode $themeOptions->general->footer_text}</div>
			<div class="footer-menu right clearfix">{menu 'theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1 }</div>
		</div>
	</div>
</footer>

	{ifset $themeOptions->general->displayThemebox}
		{include "$themeboxDir/ThemeBoxTemplate.php"}
	{/ifset}

	{if $themeOptions->fonts->fancyFont->type == 'cufon' or $themeOptions->general->displayThemebox}
		{cufon
			fonts,
			fancyFont,
			"$themeUrl/design/js/libs/cufon.js",
			THEME_FONTS_URL . "/{$themeOptions->fonts->fancyFont->file}",
			$themeOptions->fonts->fancyFont->font,
			isset($themeOptions->general->displayThemebox)
		}
	{/if}

	{footer}

	<script type="text/javascript">
	{if isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")}
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', {$themeOptions->general->ga_code}]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	{/if}
	</script>

</body>
</html>