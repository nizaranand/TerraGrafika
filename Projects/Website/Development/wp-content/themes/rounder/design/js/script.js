$j = jQuery.noConflict();

$j(document).ready(function() {

	//pngFix();

	closeableComments();
	responsiveMenu();

	ApplyColorbox();
	ApplyFancyboxVideo();
	PrettySociableInit();
	InitMisc();
	HoverZoomInit();
	OpenCloseShortcode();

	InitializeSlider();
	FlyoutMenu();

	PicturesPresnetation();
	menuSlidingArrow();
	widgetsSize('footer-widgets');
	
	sliderPrepareFix();

	sliderAlternativeFix();

	/* GRID GALLERY SHORTCODE :: START */
	// !!! order must be like this !!!
	gridGalleryShortcode();
  
    initTile();

    if($j('.portfolio').hasClass('item-direct')){
        directLink();
    } else if($j('.portfolio').hasClass('item-fancybox')) {
        itemFancybox();
    } else {
        if(parseInt($j(document).width()) < 500){
          directLink();
        } else {
          showTile();
        }
    }

    quicksand();

    categorySlider();

    tileHover();    
    /* GRID GALLERY SHORTCODE :: END */    

});

$j(window).resize(function(){
	sliderAlternativeFix();
});

function sliderPrepareFix(){
	if($j(window).width() < 497){
		$j('.rev_slider_wrapper').addClass('reloadMe');
	} 
}

function sliderAlternativeFix(){
	if($j(window).width() < 497){
		if($j('.slider-alternative').children('img').attr('src') != ""){
			$j('.rev_slider_wrapper').hide();
			$j('.slider-alternative').show();
		} else {
			$j('.rev_slider_wrapper').show();
			$j('.slider-alternative').hide();
		}
	} else {
		$j('.rev_slider_wrapper').show();
		$j('.slider-alternative').hide();
		
		if($j('.rev_slider_wrapper').hasClass('reloadMe')){
			$j('.rev_slider_wrapper').removeClass('reloadMe');
			location.reload();
		}
	}
}

function pngFix(){
	/*$j('.rev_slider .caption img').each(function(){
		$j(this).css({'filter':"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='crop',src='" + $j(this).attr('src') + "')"});
	});

	$j('.presentation .pictures-preload img').each(function(){
		$j(this).css({'filter':"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='crop',src='" + $j(this).attr('src') + "')"});
	});*/
	$j('html').find('img').each(function(){
		if($j(this).attr('src').indexOf('.png') != -1){
			$j(this).css({'filter':"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='crop',src='" + $j(this).attr('src') + "')"});
		}
	});
}

function FlyoutMenu () {
	var topbar = $j(".topbar-sticky");
	
	var initPosition = topbar.position();
	var height = topbar.height();
	var hiddenPosition = initPosition.top - height;

	var animated = false;

	$j(window).scroll(function() {
		if( $j(this).scrollTop() >= height){
			if(!animated){
				topbar.css("position","fixed");
				topbar.css("top",hiddenPosition+"px").animate({"top": initPosition.top+"px" },1000);
				animated = true;
			}
		} else if( $j(this).scrollTop() == 0){
			topbar.css("position","absolute");
			animated = false;
		} else {
			animated = false;
		}
	});
}

function widgetsSize(sidebar) {	

	 $j('.' + sidebar + ' .widget-container').each( function(index) {
	 	$j(this).addClass('col-' + (index + 1));
	 });
}

function closeableComments() {
	var comments = $j('.closeable #comments'),
		commentlist = comments.find('.commentlist'),
		button 	 = comments.parent().find('.open-button');	

	if(comments.children().length == 0) {

		$j('.closeable').remove();

	} else {

		button.show();

		if(button.hasClass('comments-closed') && commentlist.is(':visible')) {
			commentlist.hide();
		}

		button.click(function() {

			if (button.hasClass('comments-closed')) {

				commentlist.not(':animated').slideDown('slow') && button.removeClass('comments-closed').addClass('comments-opened').text('Close Comments');		

			} else if (button.hasClass('comments-opened')) {

				commentlist.not(':animated').slideUp('slow') && button.removeClass('comments-opened').addClass('comments-closed').text('Show Comments');		

			} else {

				commentlist.slideToggle();

			}
		});
	}
}

function PicturesPresnetation(){

	var effect = $j(".section.presentation").data("effect"),
		buttons = $j('.picture-buttons .pic-item');

	buttons.click(function() {

		var pictureSrc = $j(this).find('.item-picture').text();
		var link = $j(this).find('.item-link').text();
		var description = $j(this).find('.item-description').html();

		buttons.removeClass('active');
		$j(this).addClass('active');

		// change description
		$j(".section.presentation .description").fadeOut(function(){
			$j(this).html(description).fadeIn();
		});
		
		// change link
		$j(".sec-picture .picture a").attr("href",link);
		
		getTranstionPresnetation(effect, pictureSrc);

	});

}

function getTranstionPresnetation(effect, pictureSrc){
	
	if(effect == "Random"){
		
		var randomNumber = Math.floor(Math.random()*3);
			
		switch(randomNumber){
			case 0:
				effect = 'FadeIn';
				break;
			case 1:
				effect = 'ScrollIn';
				break;
			case 2:
				effect = 'ScrollOut';
				break;
		}
			
	}
	
	var image = $j(".section.presentation .picture .img");

	image.ImageSwitch({
		Type: effect, 
		NewImage: pictureSrc
	});
}

function menuSlidingArrow() {

	if(!($j('html').hasClass('oldie'))) {

		var mainmenu 	= $j('.menu-content'),
			arrow 		= $j('#slidingArrow'),
			menuList 	= mainmenu.find('ul.menu'),
			activeItem 	= menuList.find('.current_page_item, .current_page_ancestor, .current_page_parent');

		$j(window).load(function() {
			arrow.css({ 'left': (activeItem.position().left + ((activeItem.outerWidth() - 30)/2) )-6/*, 'display': ' block'*/});
			arrow.fadeIn('slow');
		});
		
		menuList.children().hover(function(){
			arrow.animate({ 'left':($j(this).position().left + (($j(this).outerWidth() - 30)/2) ) -6}, 
				{ queue: false, easing: 'easeOutQuad', duration: 250 });
		},function(){
			arrow.animate({ 'left':(activeItem.position().left + ((activeItem.outerWidth() - 30)/2) ) -6}, 
				{ queue: false, easing: 'easeOutQuad', duration: 250 });
		});
	}
}

function responsiveMenu() {

	// Save list menu and create select
	var mainNavigation = $j('nav.mainmenu').clone();
	$j('nav.mainmenu').append('<select class="responsive-menu"></select>');
	var selectMenu = $j('select.responsive-menu');
	$j(selectMenu).append('<option>Main Menu...</option>');

	// Loop through each first level list items
	$j(mainNavigation).children('ul').children('li').each(function() {

		// Save menu item's attributes
 		var href = $j(this).children('a').attr('href'),
			text = $j(this).children('a').text();

		// Create menu item's option
		$j(selectMenu).append('<option value="'+href+'">'+text+'</option>');

		// Check if there is a second level of menu
		if ($j(this).children('ul').length > 0) {

			// Loop through each second level list items
			$j(this).children('ul').children('li').each(function() {

				// Save menu item's attributes
				var href2 = $j(this).children('a').attr('href'),
					text2 = $j(this).children('a').text();

				// Create menu item's option
				$j(selectMenu).append('<option value="'+href2+'">--- '+text2+'</option>');

				// Check if there is a third level of menu
				if ($j(this).children('ul').length > 0) {

					// Loop through each third level list items
					$j(this).children('ul').children('li').each(function() {

						// Save menu item's attributes
						var href3 = $j(this).children('a').attr('href'),
							text3 = $j(this).children('a').text();
						// Create menu item's option
						$j(selectMenu).append('<option value="'+href3+'">------ '+text3+'</option>');

					}); 	// End of third level loop
				} 			// If there is third level
			}); 			// End of second level loop
		} 					// If there is second level
	}); 					// End of first level loop
	
	$j(selectMenu).change(function() {
		location = this.options[this.selectedIndex].value;
	});
}

function ApplyColorbox(){
	// Apply fancybox on all images
	$j("a[href$='gif']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='jpg']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='png']").colorbox({rel: 'group', maxHeight:"95%"});
}

function ApplyFancyboxVideo(){
	// AIT-Portfolio videos
	$j(".ait-portfolio a.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});

	// Images shortcode
	$j("a.sc-image-link.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});
}

function PrettySociableInit(){
	
	var homeUrl = $j("body").data("themeurl");
	
	$j.prettySociable({websites: {
		facebook : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'Facebook',
			'url': 'http://www.facebook.com/share.php?u=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/facebook.png',
			'sizes':{'width':70,'height':70}
		},
		twitter : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'Twitter',
			'url': 'http://twitter.com/home?status=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/twitter.png',
			'sizes':{'width':70,'height':70}
		},
		delicious : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'Delicious',
			'url': 'http://del.icio.us/post?url=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/delicious.png',
			'sizes':{'width':70,'height':70}
		},
		digg : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'Digg',
			'url': 'http://digg.com/submit?phase=2&url=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/digg.png',
			'sizes':{'width':70,'height':70}
		},
		linkedin : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'LinkedIn',
			'url': 'http://www.linkedin.com/shareArticle?mini=true&ro=true&url=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/linkedin.png',
			'sizes':{'width':70,'height':70}
		},
		reddit : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'Reddit',
			'url': 'http://reddit.com/submit?url=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/reddit.png',
			'sizes':{'width':70,'height':70}
		},
		stumbleupon : {
			'active': true,
			'encode':false, // If sharing is not working, try to turn to false
			'title': 'StumbleUpon',
			'url': 'http://stumbleupon.com/submit?url=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/stumbleupon.png',
			'sizes':{'width':70,'height':70}
		},
		tumblr : {
			'active': true,
			'encode':true, // If sharing is not working, try to turn to false
			'title': 'tumblr',
			'url': 'http://www.tumblr.com/share?v=3&u=',
			'icon':homeUrl+'/design/img/prettySociable/large_icons/tumblr.png',
			'sizes':{'width':70,'height':70}
		}
	}});

}

function InitMisc() {
	$j('#content input, #content textarea').each(function() {
		var id 	 = $j(this).attr('id'),
			name = $j(this).attr('name');
		
		if(id == undefined) {
			id = "";
		}	

		if( name == undefined ) {
			name = "";
		}

		if (id.length == 0 && name.length != 0) {
			$j(this).attr('id', name);
		}
	});

	$j('#content label').inFieldLabels();

	$j('.rule .top').click(function(event) {
		$j("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	$j('.sc-notification').children('a.close').click( function(event) {
		event.preventDefault();
		$j(this).parent().fadeOut('slow');
	});

	var more = $j('.more-link')
	if (more.not(':visible')) {
		more.parent().remove();
	};

}

function HoverZoomInit() {
	//// Post images
	//$j('#container .entry-thumbnail a').hoverZoom({overlayColor:'#ffffff',overlayOpacity: 0.8,zoom:0});

	// default wordpress gallery
	$j('.entry-content .gallery-item a').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

	// ait-portfolio
	$j('.entry-content .ait-portfolio a').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

	// schortcodes
	$j('.entry-content a.sc-image-link').hoverZoom({overlayColor:'#333',overlayOpacity: 0.8,zoom:0});

}

function OpenCloseShortcode(){
	
	//$j('#content .frame .frame-close.closed').parent().find('.frame-wrap').hide();
	$j('#content .frame .frame-close.closed .close.text').hide();
	$j('#content .frame .frame-close.closed .open.text').show();
	
	$j('#content .frame .frame-close').click(function(){
		if($j(this).hasClass('closed')){
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideDown('slow',function(){
				$butt.removeClass('closed');
				$butt.find('.close.text').show();
				$butt.find('.open.text').hide();
			});
		} else {
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideUp('slow',function(){
				$butt.addClass('closed');
				$butt.find('.close.text').hide();
				$butt.find('.open.text').show();
			});
			
		}
		
	});
}

function InitializeSlider(){

	$j('#slider') 
	  .anythingSlider({ autoPlay: true, hashTags : false }) 
	  .anythingSliderFx({ 
	   // '.selector' : [ 'caption', 'distance/size', 'time', 'easing' ] 
	   // 'distance/size', 'time' and 'easing' are optional parameters 
	   '.caption-top'    : [ 'caption-Top', '50px' ], 
	   '.caption-right'  : [ 'caption-Right', '130px', '1000', 'easeOutBounce' ], 
	   '.caption-bottom' : [ 'caption-Bottom', '50px' ], 
	   '.caption-left'   : [ 'caption-Left', '130px', '1000', 'easeOutBounce' ] 
	 }) 
	  /* add a close button (x) to the caption */ 
	.find('div[class*=caption]') 
	.css({ position: 'absolute' }) 
	.prepend('<span class="close">x</span>') 	
	.find('.close').click(function(){ 
	  var cap = $j(this).parent(), 
	   ani = { bottom : -50 }; // bottom 
	  if (cap.is('.caption-top')) { ani = { top: -50 }; } 
	  if (cap.is('.caption-left')) { ani = { left: -150 }; } 
	  if (cap.is('.caption-right')) { ani = { right: -150 }; } 
	  cap.animate(ani, 400, function(){ cap.hide(); } ); 
	}); 

}