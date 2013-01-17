jQuery(function(){

	jQuery.fn.cp = function(){
		return this.each(function(){
			var $input = jQuery(this),
				myColor = $input.val();

			$input.css({'border-left-width': '15px'});
			$input.css({'border-left-color': myColor});

			$input.ColorPicker({
				color: myColor,
				onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).val( '#' + hex);
					jQuery(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					jQuery(this).ColorPickerSetColor(this.value);
					$input.css({'border-left-color': this.value});
				},
				onChange: function (hsb, hex, rgb){
					$input.val('#' + hex);
					$input.css({'border-left-color': '#' + hex});
				}
			}).bind('keyup', function(){
				jQuery(this).ColorPickerSetColor('#' + this.value);
			});
		});
	}

	jQuery('.ait-colorpicker').cp();

	jQuery('.ait-form-table-help-label').hover(function(){
			jQuery(this).find('.ait-form-table-help-tooltip').stop(true).fadeIn(150);
		},
		function(){
			jQuery(this).find('.ait-form-table-help-tooltip').stop(true).fadeOut(150);
	}).click(function(e){e.preventDefault();});

	var mediaUpload = '';

	var $mediaSelect = jQuery('input[type="button"].media-select');

	if($mediaSelect.length){

		$mediaSelect.click(function(){
			var buttonID = jQuery(this).attr("id").toString();
			var inputID = buttonID.replace("_selectMedia", "");
			mediaUpload = inputID;
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});

		window.send_to_editor = function(html) {
			var imgUrl = jQuery('img', html).attr('src');
			jQuery('#'+mediaUpload).val(imgUrl);
			tb_remove();
		}
	}

});