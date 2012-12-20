<?php
require '../../../../../../wp-load.php';

$data = NNeon::decode(file_get_contents('./'.$_REQUEST['plugin'].'/config.neon', true));

?>

<script type="text/javascript">

    	jQuery('#popup-shortcode-form .ait-colorpicker').cp();

    	// init show only selected type
		jQuery('#popup-shortcode-form select.type-select option:selected[class^="shortcodeName-"]').each(function(index) {
			var className = jQuery(this).attr('class');
			var showedName = className.replace("shortcodeName-","");

			jQuery('#popup-shortcode-form tr').hide();
			jQuery('#popup-shortcode-form tr.type-'+showedName).show();
			jQuery('#popup-shortcode-form tr.type-all').show();
		});
		// show by actual selected item
		jQuery('#popup-shortcode-form select.type-select').change(function () {
			jQuery("#popup-shortcode-form select.type-select option:selected").each(function () {
				var className = jQuery(this).attr('class');
				var showedName = className.replace("shortcodeName-","");

				jQuery('#popup-shortcode-form tr').hide();
				jQuery('#popup-shortcode-form tr.type-'+showedName).show();
				jQuery('#popup-shortcode-form tr.type-all').show();
			});
		});

		jQuery('#popup-shortcode-form .button.submit').click(function() {

			var shortcodeName = <?php echo isset($data['shortcodeName']) ? json_encode($data['shortcodeName']) : "''"; ?>;
	    	var shortcodeAttr = '';
	    	var paired = <?php echo isset($data['paired']) ? json_encode($data['paired']) : "''"; ?>;
	    	var insertContent = <?php echo isset($data['insertContent']) ? json_encode($data['insertContent']) : "''"; ?>;
	    	var content = <?php echo isset($data['content']) ? json_encode($data['content']) : "''"; ?>;

	    	var shortcodeType = 'all';

	    	// seleced shortcode type
			jQuery('#popup-shortcode-form select.type-select option:selected[class^="shortcodeName-"]').each(function(index) {
				var className = jQuery(this).attr('class');
				// rename shortcode name
				shortcodeName = className.replace("shortcodeName-","");

				shortcodeType = shortcodeName;
			});
	    	// textfield
		    jQuery('#popup-shortcode-form input:text').each(function(){
		    	if(!jQuery(this).hasClass('hide-option') && (jQuery(this).hasClass('type-'+shortcodeType) || jQuery(this).hasClass('type-all'))){
		    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="' + jQuery(this).val() + '"';
		    	}
		    });
		    // checkbox
		    if(shortcodeName == 'ait-econtent'){
		      jQuery('#popup-shortcode-form input:radio').each(function(){
		        if(jQuery(this).is(':checked')){
		          shortcodeAttr += ' type="' + jQuery(this).val() + '"';
            }
          });
        } else {
          jQuery('#popup-shortcode-form input:checkbox').each(function(){
  		    	if(!jQuery(this).parent().hasClass('hide-option') && (jQuery(this).parent().hasClass('type-'+shortcodeType) || jQuery(this).parent().hasClass('type-all'))){
  			    	if(jQuery(this).is(':checked')){
  			    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="yes"';
  			    	} else {
  			    		shortcodeAttr += ' ' + jQuery(this).attr('name') + '="no"';
  			    	}
  		    	}
  		    });
		    }
		    // multi-select box
		    var tempString = '';
        var catNum = 0;
        var catNumAll = jQuery('.ait-grid-portfolio-category-checklist input:checkbox').size();
		    jQuery('.ait-grid-portfolio-category-checklist input:checkbox').each(function(){
          if(jQuery(this).is(':checked')){
            tempString += jQuery(this).val()+', ';
            catNum++;
          }
        });

        if(catNum != 0){
          if(catNum == catNumAll){
            tempString = '0';
          } else {
            tempString = tempString.substring(0,tempString.lastIndexOf(", "));
          }
          shortcodeAttr += ' ' + 'category' + '="'+tempString+'"';
        }


		    // select
		    jQuery('#popup-shortcode-form select option:selected').each(function(index) {
		    	if(!jQuery(this).parent().hasClass('hide-option') && (jQuery(this).parent().hasClass('type-'+shortcodeType) || jQuery(this).parent().hasClass('type-all'))){
					shortcodeAttr += ' ' + jQuery(this).parent().attr('name') + '="' + jQuery(this).val() + '"';
				}
			});

	    	// generate shortcode string
	    	if(paired == '1'){
	    		if(insertContent == '1'){
	    			var shortcodeString = '[' + shortcodeName + shortcodeAttr + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + shortcodeName + ']';
	    		} else {
	    			var shortcodeString = '[' + shortcodeName + shortcodeAttr + ']' + content + '[/' + shortcodeName + ']';
	    		}
	    	} else {
	    		var shortcodeString = "";
          if(shortcodeName == 'ait-econtent'){
            var themeName = jQuery('#js-themeName').html();
            var test2 = "../wp-content/themes/"+ themeName +"/AIT/Framework/Shortcodes/"+shortcodeName.replace("ait-","")+"/"+shortcodeName.replace("ait-","get-")+'.php?'+shortcodeAttr.trim().replace('"','').replace('"','');
            jQuery.get(test2, function(data){
              tinyMCE.get('content').setContent(data);
            });
            //shortcodeString = test2;
          } else {
            shortcodeString = '[' + shortcodeName + shortcodeAttr + ']';
          }
	    	}

	        // insert shortcode
	        tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, shortcodeString );

			tb_remove();
		});

</script>

<?php
if(!empty($data['popupOptions'])){
	echo '<h3 class="media-title">'.$data['title'].' Options</h3>';
	echo('<div id="js-themeName" style="display: none">'.THEME_CODE_NAME.'</div>');
  echo('<script type="text/javascript">');
	echo("
      jQuery('#popup-shortcode-form input[name=ait-econtent-choose]:radio').each(function(){
         jQuery(this).click(function(){
           jQuery('#ait-econtent-preview img').hide();
           var image = jQuery(this).attr('data-image');
           var alt = jQuery(this).attr('data-alt');
           var title = jQuery(this).attr('data-title');
           jQuery('#ait-econtent-preview img').attr('src', image);
           jQuery('#ait-econtent-preview img').attr('alt', alt);
           jQuery('#ait-econtent-preview img').attr('title', title);
           jQuery('#ait-econtent-preview img').fadeIn('fast');
         });
        });

  ");
  echo('</script>');

	echo '<form id="popup-shortcode-form" name="shortcode-form">';
	echo '<table class="form-table">';

	foreach ($data['popupOptions'] as $key => $value) {

		echo '<tr class="type-'.$value['class'].'">';
		if($value['type'] == 'examples-select'){
    }else{
      echo '<th>'.$value['label'].': </th>';
    }

    echo '<td>';
		// textfield
		if($value['type'] == 'text'){

			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="regular-text type-'.$value['class'].'">';

		// image-select
		} elseif($value['type'] == 'image-url'){

			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="regular-text type-'.$value['class'].'">';
			echo '<input type="button" value="Select Image" class="media-select" id="ait-'.$key.'_selectMedia" name="'.$key.'_selectMedia" >';

		// colorpicker
		} elseif($value['type'] == 'colorpicker'){

			echo '<input type="text" id="ait-'.$key.'" name="'.$key.'" value="'.$value['default'].'" class="ait-colorpicker type-'.$value['class'].'">';

		// select-language
		} elseif($value['type'] == 'select-language'){

			// require WPML plugin
			$languages = icl_get_languages('skip_missing=0');

			echo '<select id="ait-'.$key.'" name="'.$key.'" class="type-'.$value['class'].'">';
			foreach($languages as $language){
				echo '<option value="'.$language['language_code'].'">'.$language['translated_name'].' ('.$language['native_name'].')</option>';
			}
			echo '</select>';

		// select-category
		} elseif($value['type'] == 'select-category'){

			if($value['category']) $category = 'ait-'.$value['category'].'-category'; else $category = 'category';

			wp_dropdown_categories(array(
				'name' => esc_attr($key),
				'id' => 'ait-' . esc_attr($key),
				'class' => "type-".$value['class'],
				'taxonomy' => $category,
				'show_option_all' => __('All', THEME_CODE_NAME),
				'hide_empty' => 0,
				'show_count' => 1
			));

    // multiple-category
		} elseif($value['type'] == 'multiple-category'){

    	if($value['category']) $category = 'ait-'.$value['category'].'-category'; else $category = 'category';
    	$cats = get_categories( array( 'taxonomy' => $category, 'orderby' => 'menu_order', 'order' => 'ASC'));

      echo('<div class="type-all" style="width: 300px">');
    	 echo('<ul class="cat-checklist '.$category.'-checklist" style="border-color: #DFDFDF; height: 8em">');
    	   foreach($cats as $cat){
          echo('<li id="'.$category.'-'.$cat->term_id.'" class="popular-category" style="margin-bottom: 0px">');
            echo('<label class="selectit"><input value="'.$cat->term_id.'" type="checkbox" name="tax_input['.$category.'][]" id="in-'.$category.'-'.$cat->term_id.'"> '.$cat->name.'</label>');
          echo('</li>');
         }
       echo('</ul>');
      echo('</div>');

		// select-page
		} elseif($value['type'] == 'select-page'){

			if($value['pageType']) $pageType = 'ait-'.$value['pageType']; else $pageType = 'post';

			wp_dropdown_pages(array(
				'post_type' => 'page'
			));

		// select
		} elseif($value['type'] == 'select' || $value['type'] == 'type-select') {

			if($value['type'] == 'type-select') $hide = 'hide-option type-select'; else $hide = '';

			echo '<select id="ait-'.$key.'" name="'.$key.'" class="'.$hide.' type-'.$value['class'].'">';
			foreach($value['default'] as $k => $v){
				if($v['checked'] == 'true') $checked = ' selected'; else $checked = '';

				if($value['type'] == 'type-select'){
					echo '<option value="'.$k.'"'.$checked.' class="shortcodeName-'.$v['shortcodeName'].'">'.$v['label'].'</option>';
				} else {
					echo '<option value="'.$k.'"'.$checked.'>'.$v['label'].'</option>';
				}
			}
			echo '</select>';
		// checkbox
		} elseif($value['type'] == 'checkbox'){
			echo '<input type="checkbox" id="ait-'.$key.'" name="'.$key.'" class="type-'.$value['class'].'">';

    // examples
    } elseif($value['type'] == 'examples-select'){
      $examples = array();
      $examplDir = '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'design'.DIRECTORY_SEPARATOR.'example-content';
      $examplesDir = realpath($examplDir);
      $timthumb = realpath('..'.DIRECTORY_SEPARATOR.'Libs'.DIRECTORY_SEPARATOR.'timthumb'.DIRECTORY_SEPARATOR.'timthumb.php');
      //var_dump($examplesDir);
      if(is_dir($examplesDir) && file_exists($examplesDir)){
        $dirHandler = opendir($examplesDir);
        while($exampleFile = readdir($dirHandler)){
          $systemFile = pathinfo($examplesDir.DIRECTORY_SEPARATOR.$exampleFile);
          if($exampleFile != "." && $exampleFile != ".." && $exampleFile != ".svn" && $systemFile['extension'] == 'html' && $exampleFile != ".htaccess"){
            array_push($examples, $exampleFile);
          }
        }
        closedir($dirHandler);
      }

      if(!empty($examples)){
        echo('</td></tr>');
        if(isset($_SERVER['HTTPS']) and !empty($_SERVER['HTTPS'])){
          $replaceSep = 'https://'.str_replace(realpath($_SERVER['DOCUMENT_ROOT']),$_SERVER['SERVER_NAME'],$examplesDir);
          $timthumb = 'https://'.str_replace(realpath($_SERVER['DOCUMENT_ROOT']),$_SERVER['SERVER_NAME'],$timthumb);
        } else {
          $replaceSep = 'http://'.str_replace(realpath($_SERVER['DOCUMENT_ROOT']),$_SERVER['SERVER_NAME'],$examplesDir);
          $timthumb = 'http://'.str_replace(realpath($_SERVER['DOCUMENT_ROOT']),$_SERVER['SERVER_NAME'],$timthumb);
        }
        $i = 0;
        sort($examples, SORT_REGULAR);
        foreach($examples as $example){
             $fName = explode('-',$example);
             $id = str_replace(".html",'',$fName[3]);
             preg_match("<!--(.*?)-->",file_get_contents($examplesDir.'/'.$example),$description);
             echo('<tr>');
             if(file_exists($examplesDir.DIRECTORY_SEPARATOR.str_replace('.html','.png',$example))){
                echo '<th style="margin:0px; padding:0px; width: 10px; vertical-align: middle; height: 0px; text-align: center"><input style="margin:0px; padding:0px" type="radio" name="ait-econtent-choose" value="'.$id.'" class="type-'.$value['class'].'" data-image="'.$timthumb.'?src='.$replaceSep.DIRECTORY_SEPARATOR.str_replace('.html','.png',$example).'&w=200" data-alt="'.trim(str_replace("@description: ","",$description[1])).'" data-title="'.trim(str_replace("@description: ","",$description[1])).'"></th>';
                echo('<td style="margin:0px; padding:0px; width: 200px"> '.ucfirst($fName[2]).' '.$id.' <br> '.trim(str_replace("@description: ","",$description[1])).'</td>');
             } else {
                echo '<th style="margin:0px; padding:0px; width: 10px; vertical-align: middle; height: 0px; text-align: center"><input style="margin:0px; padding:0px" type="radio" name="ait-econtent-choose" value="'.$id.'" class="type-'.$value['class'].'" data-image="'.$timthumb.'?src='.$replaceSep.DIRECTORY_SEPARATOR.'none.gif&w=200" data-alt="none" data-title="'.trim(str_replace("@description: ","",$description[1])).'"></th>';
                echo('<td style="margin:0px; padding:0px; width: 200px"> '.ucfirst($fName[2]).' '.$id.' <br> '.trim(str_replace("@description: ","",$description[1])).'</td>');
             }
             if($i == 0){
                echo '<td rowspan="'.count($examples).'"><div id="ait-econtent-preview" style="width: 200px; overflow: hidden"><img style="display: none;" src=" " alt=" " title=" " width="200px"/></div></td>';
             } else {
                echo('</tr>');
             }
          $i++;
        }
      } else {
        echo('<tr>');
        echo('<td colspan="2">');
        echo('No examples found');
        echo('</td>');
        echo('</tr>');
      }
    }

		echo '</td>';

		echo '</tr>';

	}

	echo '<tr class="type-all"><td><input type="button" value="Insert" class="button submit"></td></tr>';

	echo '</table></form>';

}
?>