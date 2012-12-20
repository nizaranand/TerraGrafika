<?php
	add_filter('plugins_url','aitRevsliderUrl',10,3);

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'revslider'.DIRECTORY_SEPARATOR.'revslider.php';

	function aitRevsliderTables(){
		aitCreateTable(GlobalsRevSlider::TABLE_SLIDERS_NAME);
		aitCreateTable(GlobalsRevSlider::TABLE_SLIDES_NAME);
	}

	function aitCreateTable($tableName){
		global $wpdb;
		$tableRealName = $wpdb->base_prefix.$tableName;
		if(UniteFunctionsWPRev::isDBTableExists($tableRealName))
			return(false);
		
		switch($tableName){
			case GlobalsRevSlider::TABLE_SLIDERS_NAME:					
			$sql = "CREATE TABLE " .$wpdb->base_prefix.$tableName ." (
						  id int(9) NOT NULL AUTO_INCREMENT,					  
						  title tinytext NOT NULL,
						  alias tinytext,
						  params text NOT NULL,
						  PRIMARY KEY (id)
						);";
			break;
			case GlobalsRevSlider::TABLE_SLIDES_NAME:
				$sql = "CREATE TABLE " .$wpdb->base_prefix.$tableName ." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  slider_id int(9) NOT NULL,
							  slide_order int not NULL,					  
							  params text NOT NULL,
							  layers text NOT NULL,
							  PRIMARY KEY (id)
							);";
			break;
			default:
				UniteFunctionsRev::throwError("table: $tableName not found");
			break;
		}
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	function aitRevsliderUrl($url ,$path, $plugin){
		if($path == 'revslider'){
			return THEME_URL.'/plugins/'.$path;
		}
	}

	add_action('aitThemeActivation', 'aitRevsliderTables');