<?php

// back compatibility with older AIT themes. Removes script enqueued in functions.php
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );
function my_deregister_javascript() { wp_dequeue_script('JS_googleMaps'); wp_deregister_script( 'JS_googleMaps' ); }

function theme_shortcode_googlemap($atts, $content = null, $code) {

	$folder = basename(dirname(__FILE__));
	// loading script only if there is googlemap shortcode on page
	// will be printed in footer
	wp_enqueue_script('googlemap-api', "http://maps.google.com/maps/api/js?v=3.9&sensor=false");
	wp_enqueue_script('ait-gmap', AIT_FRAMEWORK_URL . "/Shortcodes/{$folder}/jquery.gmap.min.js",  array('jquery'), '1.0');

	extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 3,
		"text" => '',
		"popup" => 'false',
		"controls" => '[]',
		"scrollwheel" => 'true',
		"type" => 'ROADMAP',
		"marker" => 'true',
		'align' => false,
		'border' => ''
	), $atts));

	if($width && is_numeric($width)){
		$width = 'width:'.$width.'px;';
	}else{
		$width = '';
	}
	if($height && is_numeric($height)){
		$height = 'height:'.$height.'px';
	}else{
		$height = '';
	}

	if($border != ""){
		$borderStyle = ' border';
	} else {
		$borderStyle = "";
	}


	$align = $align?' align'.$align:'';
	$id = rand(100,1000);
	if($marker != 'false'){
		return <<<HTML
<div class="sc-map{$borderStyle}"><div class="wrap">
<div id="google_map_{$id}" class="google_map google_map{$align}" style="{$width}{$height}"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery(this).gMap({
			zoom: {$zoom},
			markers:[{
				address: "{$address}",
				latitude: {$latitude},
				longitude: {$longitude},
				html: "{$text}",
				popup: {$popup}
			}],
			controls: {$controls},
			maptype: '{$type}',
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	
	// in tabs shortcode
	var tabs = jQuery("#google_map_{$id}").parents('.ait-tabs');
	if(tabs.size()!=0){
		tabs.bind('tabsshow', function(event, ui) {
			jQuery(ui.panel).find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}

});
</script>
</div></div>
HTML;
	}else{
return <<<HTML
<div class="sc-map{$borderStyle}"><div class="wrap">
<div id="google_map_{$id}" class="google_map google_map{$align}" style="{$width}{$height}"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery("#google_map_{$id}").gMap({
			zoom: {$zoom},
			latitude: {$latitude},
			longitude: {$longitude},
			address: "{$address}",
			controls: {$controls},
			maptype: '{$type}',
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	
	// in tabs shortcode
	var tabs = jQuery("#google_map_{$id}").parents('.ait-tabs');
	if(tabs.size()!=0){
		tabs.bind('tabsshow', function(event, ui) {
			jQuery(ui.panel).find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
</div></div>
HTML;
	}
}

add_shortcode('googlemap','theme_shortcode_googlemap');