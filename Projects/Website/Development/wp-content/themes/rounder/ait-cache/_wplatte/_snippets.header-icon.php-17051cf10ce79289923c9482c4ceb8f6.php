<?php //netteCache[01]000490a:2:{s:4:"time";s:21:"0.01574300 1357886038";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:100:"/export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/header-icon.php";i:2;i:1357885409;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: /export/Fiber/clients/terraClient/terra/wp-content/themes/rounder/Templates/snippets/header-icon.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'k68lo4e7eh')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<div class="mwrap">
	<div class="molecule">
		<div class="p1wrap"><span class="particle1">&nbsp;</span></div>
		<div class="p2wrap"><span class="particle2">&nbsp;</span></div>
		<div class="p3wrap"><span class="particle3">&nbsp;</span></div>
	</div>
	<img src="<?php echo $headerIcon ?>" alt="ico" width="65" height="65" class="ico" />
</div>