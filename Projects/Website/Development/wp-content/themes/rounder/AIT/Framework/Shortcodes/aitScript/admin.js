$j = jQuery.noConflict();

$j(function(){

	$j.fn.cp = function(){
		return this.each(function(){
			var $input = $j(this),
				myColor = $input.val();

			$input.css({'border-left-width': '15px'});
			$input.css({'border-left-color': myColor});

			$input.ColorPicker({
				color: myColor,
				onSubmit: function(hsb, hex, rgb, el) {
					$j(el).val( '#' + hex);
					$j(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					$j(this).ColorPickerSetColor(this.value);
					$input.css({'border-left-color': this.value});
				},
				onChange: function (hsb, hex, rgb){
					$input.val('#' + hex);
					$input.css({'border-left-color': '#' + hex});
				}
			}).bind('keyup', function(){
				$j(this).ColorPickerSetColor('#' + this.value);
			});
		});
	}

	$j('.ait-colorpicker').cp();

	$j('.ait-form-table-help-label').hover(function(){
			$j(this).find('.ait-form-table-help-tooltip').stop(true).fadeIn(150);
		},
		function(){
			$j(this).find('.ait-form-table-help-tooltip').stop(true).fadeOut(150);
	}).click(function(e){e.preventDefault();});

	var mediaUpload = '';

	var $mediaSelect = $j('input[type="button"].media-select');

	if($mediaSelect.length){

		$mediaSelect.click(function(){
			var buttonID = $j(this).attr("id").toString();
			var inputID = buttonID.replace("_selectMedia", "");
			mediaUpload = inputID;
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});

		window.send_to_editor = function(html) {
			var imgUrl = $j('img', html).attr('src');
			$j('#'+mediaUpload).val(imgUrl);
			tb_remove();
		}
	}

});