<?php
/* **********************************************************
 * jQuery UI Tabs
 * **********************************************************/
/*
function theme_tabs( $params, $content = null) {
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'ver' => $GLOBALS['aitThemeShortcodes']['tabs']
    ), $params ) );

	$scontent = do_shortcode($content);
	if(trim($scontent) != ""){
		$output = '<div class="ait-tabs" id="ait-tabs-'.$id.'"><ul>'.$scontent.'</ul>';
		$output .= '</div>';
		$output .= '<script type="text/javascript">
		$j(function() {
			// remove br and p
			$j( "#ait-tabs-'.$id.' ul > br" ).remove();
			$j( "#ait-tabs-'.$id.' ul > p" ).remove();

			var tabId = 0;
			$j( "#ait-tabs-'.$id.' ul li" ).each(function(){
				tabId++;
				var tabName = "tab-'.$id.'-"+tabId;
				$j(this).find("a.tab-link").attr("href","#"+tabName);
				var tabContent = $j(this).find(".tab-content").html();
				if(tabContent != null){
                                    $j( "#ait-tabs-'.$id.'" ).append("<div id="'.'+tabName+'.'">"+tabContent+"</div>");
                                }
			});

                        if($j("#ait-tabs-'.$id.'").has("div.sc-accordion") != -1){
                            $j("#ait-tabs-'.$id.'").find("div.sc-accordion").accordion();
                        }
                        if($j("#ait-tabs-'.$id.'").find("div.google_map").length){
                            $j("#ait-tabs-'.$id.'").find("div.google_map").gMap();
                        }

			$j( "#ait-tabs-'.$id.'" ).tabs();
			$j( "#ait-tabs-'.$id.'").addClass("ait-tabs");
			Cufon.refresh();
		});
		</script>';

		return $output;
	} else {
		return "";
	}
}
add_shortcode( 'tabs', 'theme_tabs' );

function theme_tab( $params, $content = null) {
    extract( shortcode_atts( array(
        'title' => 'title'
    ), $params ) );

	return '<li><a class="tab-link" href="">'.$title.'</a><div class="tab-content" style="display: none;">'.do_shortcode($content).'</div></li>';

}
add_shortcode( 'tab', 'theme_tab' );*/

function theme_tabs( $params, $content = null) {
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'ver' => $GLOBALS['aitThemeShortcodes']['tabs'],
        'animation' => 'no',
    ), $params ) );

	$scontent = do_shortcode($content);

	$fx = '';

	if($animation == 'yes'){
		$fx = '
				{
					fx: {
						opacity: "toggle",
					}
				}
		';
	}

	$output = '<div class="ait-tabs" id="ait-tabs-'.$id.'"><ul></ul>';
	$output .= $scontent;
	$output .= '</div>';
	$output .= '
	<script type="text/javascript">
		(function($){

			$(function(){

				var $tabs = $("#ait-tabs-'.$id.'" ),
					$tabsList = $tabs.find("> ul"),
					$tabDivs = $tabs.find(".ait-tab.tab-content"),
					tabsCount = $tabDivs.length;

				$tabs.find("> p, > br").remove();

				var tabId = 0;
				$tabDivs.each(function(){
					tabId++;
					var tabName = "tab-'.$id.'-"+tabId;
					$(this).attr("id",tabName);
					var tabTitle = $(this).data("ait-tab-title");
					$("<li><a class=\'tab-link\' href=\'#"+tabName+"\'>"+tabTitle+"</a></li>").appendTo($tabsList);
				});

				$tabs.tabs(' . $fx . ');

				if(typeof Cufon !== "undefined")
					Cufon.refresh();
			});

		})(jQuery);
	</script>';

	return $output;

}
add_shortcode( 'tabs', 'theme_tabs' );

function theme_tab( $params, $content = null) {
    extract( shortcode_atts( array(
        'title' => 'title'
    ), $params ) );

	return '<div class="ait-tab tab-content" data-ait-tab-title="'.esc_attr($title).'">'.do_shortcode($content).'</div>';

}
add_shortcode( 'tab', 'theme_tab' );
