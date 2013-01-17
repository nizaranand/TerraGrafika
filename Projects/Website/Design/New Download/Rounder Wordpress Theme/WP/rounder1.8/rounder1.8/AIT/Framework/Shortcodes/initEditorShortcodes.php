<?php

if(isset($GLOBALS['aitThemeShortcodes']) and !empty($GLOBALS['aitThemeShortcodes'])){
	foreach($GLOBALS['aitThemeShortcodes'] as $shortcode => $ver){
		require_once AIT_FRAMEWORK_DIR . "/Shortcodes/{$shortcode}/load.php";
	}
}

//var_dump($aitThemeShortcodes);
/*
Hook into WordPress
*/
add_action('init', 'ait_shortcodes_button');



/*
Create Our Initialization Function
*/
function ait_shortcodes_button() {
   	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     	return;
   	}

   	if(isset($GLOBALS['showAdmin']['wysiwyg']) == false){
   		$GLOBALS['showAdmin']['wysiwyg'] = "enabled";
   	}
   	if (get_user_option('rich_editing') == 'true' && @$GLOBALS['showAdmin']['wysiwyg'] != 'disabled') {
     	add_filter( 'mce_external_plugins', 'add_plugins' );
     	add_filter( 'mce_buttons_3', 'register_button_3' );
   	}

}



/*
Register Buttons
*/
function register_button_3( $buttons ) {

	if(isset($GLOBALS['aitEditorShortcodes']) and !empty($GLOBALS['aitEditorShortcodes'])){
		foreach($GLOBALS['aitEditorShortcodes'] as $shortcodes){
			$buttons[] = "ait_shortcodes_" . $shortcodes;
		}
	}
	return $buttons;
}


/*
Register TinyMCE Plugins
*/
function add_plugins( $plugin_array ) {

	$from = $_SERVER['REQUEST_URI'];
	if(isset($GLOBALS['aitEditorShortcodes']) and !empty($GLOBALS['aitEditorShortcodes'])){
		foreach($GLOBALS['aitEditorShortcodes'] as $shortcodes){
			$plugin_array["ait_shortcodes_" . $shortcodes] =  AIT_FRAMEWORK_URL . "/Shortcodes/pluginScript.php?plugin={$shortcodes}&from={$from}";
		}
	}
   	return $plugin_array;
}

/*
Shortcode empty Paragraph fix

add_filter('the_content', 'sc_empty_p_fix');
function sc_empty_p_fix($content)
{
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

	return $content;
}
*/