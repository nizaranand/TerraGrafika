<?php //netteCache[01]000475a:2:{s:4:"time";s:21:"0.55135400 1357886034";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/footer.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/footer.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'q81hi6vp1z')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<footer class="page-footer mainpage" role="contentinfo">
<?php if(is_active_sidebar("footer-widgets")): ?>
	<div class="footer-widgets">
		<div class="wrapper">
			<div class="holder">
<?php dynamic_sidebar('footer-widgets') ?>
			</div>
		</div>
	</div>
<?php endif ?>
	<div class="foot-holder">
		<div class="wrapper">
			<div class="left"><?php echo do_shortcode($themeOptions->general->footer_text) ?></div>
			<div class="footer-menu right clearfix"><?php wp_nav_menu(array('theme_location' => 'footer-menu','fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu clear', 'depth' => 1)) ?></div>
		</div>
	</div>
</footer>

<?php if (isset($themeOptions->general->displayThemebox)): NCoreMacros::includeTemplate("$themeboxDir/ThemeBoxTemplate.php", $template->getParams(), $_l->templates['q81hi6vp1z'])->render() ;endif ?>

<?php if ($themeOptions->fonts->fancyFont->type == 'cufon' or $themeOptions->general->displayThemebox): 
			$__cufon = array('fonts',
			'fancyFont',
			"$themeUrl/design/js/libs/cufon.js",
			THEME_FONTS_URL . "/{$themeOptions->fonts->fancyFont->file}",
			$themeOptions->fonts->fancyFont->font,
			isset($themeOptions->general->displayThemebox)) ?>
			<script id="ait-cufon-script" src="<?php echo $__cufon[2] ?>"></script>
			<?php
			$__tbCookie = @strstr($_COOKIE['aitThemeBox-' .THEME_CODE_NAME], 'Type\":\"google\"');
			if($__tbCookie === false and substr($__cufon[3], -3, 3) == '.js'): ?>
			<script id="ait-cufon-font-script" src="<?php echo $__cufon[3] ?>"></script>
			<?php endif ?>

			<script id="ait-cufon-font-replace">
				<?php if($__cufon[5]): ?>
				var isCookie = false;
				try{
					var type = Cookies.get('<?php echo $__cufon[0] . ucfirst($__cufon[1]) . 'Type'?>');
					if(type == undefined || (type != undefined && type == 'cufon'))
						isCookie = true;
				}catch(e){
					isCookie = true;
				}

				if(isCookie != false){
				<?php endif ?>
					<?php $__font = WpLatteFunctions::getCssFontSelectors($__cufon[1])?>
					Cufon.now();
					<?php foreach($__font as $selectors => $values): ?>
					Cufon.replace('<?php echo $selectors ?>', {
						fontFamily: "<?php echo $__cufon[4]?>".replace(/\+/g, ' ')
						<?php if(isset($values['text-shadow'])): ?>, textShadow: '<?php echo $values['text-shadow'] ?>
'<?php endif ?>
						<?php if(isset($values['hover'])): ?>, hover: {<?php if(isset($values['hover']['color'])): ?>
color: '<?php echo $values['hover']['color'] ?>'<?php endif; if(isset($values['hover']['text-shadow'])): ?>
,textShadow: '<?php echo $values['hover']['text-shadow'] ?>'<?php endif ?>}
						<?php endif ?>
					});
					<?php endforeach ?>
				<?php if($__cufon[5]): ?>}<?php endif ?>
			</script><?php endif ?>

<?php wp_footer() ?>

	<script type="text/javascript">
<?php if (isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")): ?>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', <?php echo NTemplateHelpers::escapeJs($themeOptions->general->ga_code) ?>]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
<?php endif ?>
	</script>

</body>
</html>