<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


/**
 * Enhanced var_dump, but still stupid dump function. See Nette\Diagnostics\Debugger::dump(). That's a cool dump function!
 * @param mixed $var
 * @param int $exit Exit the script after dump?
 * @param int $f Dump function. 0 - var_dump, 1 - print_r
 */
function d($var, $exit = 0, $f = 0){
	($f == 0) ? $fn = 'var_dump' : $fn = 'print_r';
	echo '<pre style="background:#fff;color:#000;border:1px dotted #666;margin:.5em;padding:0.5em;">';
	if(is_string($var))
		$fn(htmlspecialchars($var));
	else
		$fn($var);
	echo "</pre>\n";
	if($exit) exit;
}