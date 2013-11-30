//placeholders
(function(a){a(function(){var b=Modernizr.input.placeholder;if(!b){var c=a("input[placeholder], textarea[placeholder]"),d=c.length,e,f="placeholder";while(d--)c[d].value=c[d].value?c[d].value:c.eq(d).addClass(f).attr("placeholder"),c.eq(d).focus(function(){var b=a(this);this.value==b.attr("placeholder")&&(b.removeClass(f),this.value="")}).blur(function(){var b=a(this);this.value==""&&(b.addClass(f),this.value=b.attr("placeholder"))}),function(b){a(b.form).bind("submit",function(){b.value==a(b).attr("placeholder")&&(b.value="")})}(c[d])}})})(jQuery)
var History_inited = false;
var slider_was_run = false;
var slideshowVideo = {
		playing  : false,

		play : function(){
			this.playing = true;
		},
		pause: function()
		{
			this.playing = false;
		},
		end: function(){
			this.playing = false;
		},
		isPlaing: function(){
			return this.playing;
		}
};

jQuery(window).load(function() {
	initHistory();
	if (jQuery('.filters').next('.row').length) {
		jQuery(this).find('.gallery_wrap').isotope({ layoutMode : 'fitRows' });
	}

	var isotopeit = jQuery('.filters').next('.row');
	if (isotopeit.length) {
		isotopeit.each(function(){ jQuery(this).find('.gallery_wrap').isotope({ layoutMode : 'fitRows' }); })
	}

	jQuery('.filters a').click(function(){
		jQuery(this).closest("li").removeClass("cat-item");

		if (jQuery(this).closest("li").hasClass("*")) {
			var selector = "*";
		} else {
			var selector = "." + jQuery(this).closest("li").attr("class");
		}
		jQuery(this).closest('.filters').next('.row').find('.gallery_wrap').isotope({ filter: selector });

		return false;
	});
});

jQuery(document).ready(function() {


	positionFooter();

	jQuery(window).scroll(positionFooter).resize(positionFooter).load(positionFooter);

	function positionFooter() {
		var docHeight = jQuery(document.body).height() - jQuery("#sticky-footer-push").height();
		if(docHeight < jQuery(window).height()){
			var diff = jQuery(window).height() - docHeight;
			if (!jQuery("#sticky-footer-push").length > 0) {
				jQuery("footer").before('<div id="sticky-footer-push"></div>');
			}
			jQuery("#sticky-footer-push").height(diff);
		}
	}

	jQuery('ul.sf-menu').superfish({
		hoverClass:  'sfHover',
		delay:       'false',
		animation:   {
			opacity:'show',
			height:'auto'
		},
		speed:       '1',
		autoArrows:  false,
		dropShadows: false,
		disableHI:   true
	}).supposition();

		jQuery('.main_menu_select select').change(function() {
			window.location = jQuery(this).find("option:selected").val();
		});
		
		jQuery('ul.sf-menu li:not(".dropdown") > a').on('touchend', function(event){
				var el = jQuery(this);
				var link = el.attr('href');
				window.location = link;
		});

		jQuery('article.posts_listing:last .post_title_area').css({'background':'none'});

///* jCycle */
//if (jQuery("#jcyclemain").length) {
//
//
//	if (typeof slider_padding != 'undefined' && (slider_padding == '1')){
//		jQuery('.bgimage').css('padding','0');
//	}
//	
//	if(jQuery("#jcyclemain .jcyclemain:first img").length)
//	{	
//			jQuery('#jcyclemain .jcyclemain:first img').each(function() {
//			   var new_image_source = (jQuery(this).attr('src'));	
//
//			   jQuery(this).load(function() {
//				   if(!window.slider_was_run)
//					{
//						sliderRun();
//					}
//				})
//				.attr('src', new_image_source); 				
//			});	
//			
//			if(!window.slider_was_run)
//			{
//				 sliderRun();
//			}
//	}
//	else
//	{
//		if(!window.slider_was_run)
//		{
//			sliderRun();
//		}
//	}
//}



/* Toggles and Tabs */
jQuery(".toggle_container:not('.active')").hide();
     jQuery("h4.trigger").click(function(){
     jQuery(this).toggleClass("active").next().slideToggle("normal");

        return false;
    });

if (jQuery('.tabgroup').length) {
    jQuery( ".tabgroup" ).tabs().show();
     }

/* ToC */

jQuery('div.toc a.toc_hide').click(function(){

	var hide = '['+jQuery(this).data('hide')+']';
	var show = '['+jQuery(this).data('show')+']';
	if (jQuery(this).html() == hide) {
		jQuery(this).html(show);
	} else {
		jQuery(this).html(hide);
	}
    jQuery(this).closest('h4').next().slideToggle("normal");


        return false;
    });

/* Lightbox */
	jQuery("a[data-pp^='lightbox']").prettyPhoto({
		theme: 'light_square',
		overlay_gallery: false,
		social_tools:'',
		deeplinking: false
		});

   jQuery("a img").filter('.alignleft').css('margin','0').closest('a').css({'float':'left', 'margin':'0 15px 15px 0'});
   jQuery("a img").filter('.alignright').css('margin','0').closest('a').css({'float':'right', 'margin':'0 0 15px 15px'});


    jQuery("a[data-pp^='lightbox'], a.thumb").hover(function(){

        jQuery(this).prepend("<span class='imghover'><span></span></span>");
        jQuery(this).find("span.imghover").stop().animate({opacity:0},0)
        var sh = jQuery(this).find("img").innerHeight()+2;
        var sw = jQuery(this).find("img").innerWidth()+2;
		if (sh > sw) {
			var hw = sw/2;
		} else {
			var hw = sh/2;
		}

        jQuery(this).find("span.imghover").height('0').width('0').css({'top':sh/2,'left':sw/2,'borderRadius':'100%'}).stop().animate({opacity:1,height:hw,width:hw,top:(sh/2 - hw/2),left:(sw/2 - hw/2)},300,

		function(){

			jQuery(this).find("span").css({opacity:1,height:hw,width:hw});

		}
);


    }, function(){
        jQuery(this).find("span.imghover span").css({opacity:0});
		jQuery(this).find("span.imghover").stop().animate({opacity:0},300,

		function() { jQuery(this).remove();}

	);

    });

/*filters */
jQuery('.filters').find('ul a').click(function(){
         if ( !jQuery(this).hasClass('selected') ) {
          jQuery(this).parents('ul').find('.selected').removeClass('selected');
          jQuery(this).addClass('selected');
        }
});


/* smooth fade rollovers */
	jQuery('.main_menu>.sf-menu>li.current-menu-item').prepend('<span class="hover"><span class="hoverL"><span class="hoverR"></span></span></span>').find(".hover").css('opacity', 0).stop().fadeTo(300, 1);
	jQuery(".main_menu>.sf-menu>li>a").on({
            	mouseenter:function(){
					 jQuery(this).closest('li:not(.current-menu-item)').find(".hover").remove();
					 jQuery(this).closest('li:not(.current-menu-item)').prepend('<span class="hover"><span class="hoverL"><span class="hoverR"></span></span></span>').find(".hover").css('opacity', 0).stop().fadeTo(300, 1);
				},
				mouseleave:function() {
       				 jQuery(this).closest('li:not(.current-menu-item)').find(".hover").stop().fadeTo(700, 0, function() { jQuery(this).closest('li:not(.current-menu-item)').find(".hover").remove()});
					},
				touchstart:function(){
					 jQuery(this).closest('li:not(.current-menu-item)').prepend('<span class="hover"><span class="hoverL"><span class="hoverR"></span></span></span>').find(".hover").css('opacity', 0).stop().fadeTo(300, 1);
				}
    });

	/////// events calendar


	jQuery('#previous_month').live('click', function(){
		sendCalendarData(jQuery(this), 'previous');
		return false;
	});

	jQuery('#next_month').live('click', function(){
		sendCalendarData(jQuery(this), 'next');
		return false;
	});
	
	jQuery('a[data-download]').click(function(){
		downloadLink(jQuery(this).attr('href'));
		return false;
	});
	
function sendCalendarData(obj, month_to_show)
{
	var form = obj.closest('form');
	var form_data = {};
	if(form && form.length)
	{
		var month = parseInt(jQuery('#calendar_month', form).val(), 10);
		var year = parseInt(jQuery('#calendar_year', form).val(), 10);
		var new_month = new_year = 0 ;

		if(month_to_show == 'previous')
		{
			if(month == 1)
			{
				new_month = 12;
				new_year = year - 1;
			}
			else
			{
				new_month = month - 1;
				new_year = year;
			}
		}
		else
		{
			if(month == 12)
			{
				new_month = 1;
				new_year = year + 1;
			}
			else
			{
				new_month = month + 1;
				new_year = year;
			}
		}

		form_data.calendar = true;
		form_data.month = new_month;
		form_data.year = new_year;
		form_data.layout = jQuery('#calendar_layout', form).val();
		form_data.category = jQuery('#calendar_category', form).val();
		form_data.from = jQuery('#calendar_from', form).val();
		form_data.to = jQuery('#calendar_to', form).val();

		form_data.action = 'calendar_walker';

		jQuery.ajax({
		type: "POST",
		url: ThemeData.admin_url,
		data: form_data,
		dataType: 'json',
		success:function(response) {
			if(response && typeof response == 'object' )
			{
				form.parents('.events_calendar').html(response.html);
				pushToHistory(response.html);
			}
		}
	});
	}
}



});

jQuery(window).load(function(){
	/* jCycle */
	if (jQuery("#jcyclemain").length) {


		if (typeof slider_padding != 'undefined' && (slider_padding == '1')){
			jQuery('.bgimage').css('padding','0');
		}

		if(jQuery("#jcyclemain .jcyclemain:first img").length)
		{	
				jQuery('#jcyclemain .jcyclemain:first img').each(function() {
				   var new_image_source = (jQuery(this).attr('src'));	

				   jQuery(this).load(function() {
					   if(!window.slider_was_run)
						{
							sliderRun();
						}
					})
					.attr('src', new_image_source); 				
				});	

				if(!window.slider_was_run)
				{
					 sliderRun();
				}
		}
		else
		{
			if(!window.slider_was_run)
			{
				sliderRun();
			}
		}
	}
});


function validateCaptcha(form, callback) 
{
	jQuery.ajax({
			type: 'post',
			url: ThemeData.admin_url,
			data: { 
				action: "captcha_check",
				recaptcha_challenge_field: jQuery('#recaptcha_challenge_field', form).val(),
				recaptcha_response_field: jQuery('#recaptcha_response_field', form).val() 
			},
			success: function(response){
				if(typeof response != 'undefined' && typeof response.is_valid != 'undefined')
				{
					if(typeof Recaptcha != 'undefined')
					{
						Recaptcha.reload();
					}
					
					if(response.is_valid)
					{
						if(typeof callback == 'function')
						{
							callback(form);
						}
					}
					
					return response.is_valid
					
				}
				return false;
			},
			error: function() {
				if(typeof Recaptcha != 'undefined')
					{
						Recaptcha.reload();
					}
				return false;
			}
		});
}


function ajaxContact(theForm) {
	var $ = jQuery;
	var name, el, label, html;
	var form_data = {};



	$('input, select, textarea', theForm).each(function(n, element) {
		el =  $(element);
//		if(el.is('input') || el.is('textarea') || el.is('select'))
		{
			name = el.attr('name');
//
				switch(el.attr('type'))
				{
					case 'radio':
						if(el.prop('checked'))
						{
							label = $('label:first', el.parent('div'));
						}
						break;
					case 'checkbox':
						label = $("label[for='"+name+"']:not(.error)", theForm);
						break;
					default:
						label = $("label[for='"+name+"']", theForm);
				}
				// Widget contact form skip this step!
				if( !($(theForm).hasClass('contactformWidget')) && label && label.length )
				{
					if(name != 'recaptcha_response_field')
					{
						html = label.html();
						html = html.replace(/<span>.*<\/span>/,'');
						html = html.replace(/<br>/,'');
						
						if(el.attr('type') == 'checkbox')
						{
							if(el.prop('checked'))
							{
								form_data[html] = 'yes';
							}
							else
							{
								form_data[html] = 'no';
							}
						}
						else
						{
							form_data[html] = el.val().replace(/\n/g, '<br/>');
						}
					}
				}
				else
				{
					/**
					 * to, subject .....
					 */
					if(name != undefined 
							&& name != '_wp_http_referer' 
							&& name != '_wpnonce' 
							&& name !='contact-form-id'
							&& name !='recaptcha_challenge_field' // IGNORE CAPTCH FORM ELEMENTS
							&& name !='recaptcha_response_field'
							&& name !='use-captch'
							)
					{
						if(el.attr('type') != 'radio')
						{
							/**
							 * email reply to:
							 */
							if(name == 'th-email-from')
							{
								if( form_data[name] == undefined)
								{
									/**
									 * first of reply
									 */
									var email_id = email_from = null;
									jQuery('[name="'+name+'"]').each(function()
									{
										email_id = jQuery(this).val();
										email_from = jQuery('#'+email_id, theForm).val();
										if(email_from && email_from.length)
										{
											return false;
										}
									});

									if(email_from && email_from.length)
									{
										form_data[name] = email_from ;
									}
								}
							}
							else
							{
								form_data[name] = el.val();
							}
						}
					}
				}
			name = label = html= null;
		}
		el = null;
	});

	
	form_data.action = 'send_contact_form';
	
	jQuery.ajax({
		type: "POST",
		url: ThemeData.admin_url,
		data: form_data,
		//dataType: 'json',
		success: function(response) {

				jQuery(theForm).find('div').fadeOut(500);
				setTimeout(function() {
						if (response === 'success') {
							jQuery(theForm).append('<p class="note">Your message has been successfully sent to us!</p>').slideDown('fast'); //success text
						} else {
							jQuery(theForm).append('<p class="note">Something going wrong with sending mail...</p>').slideDown('fast');	// error text when php mail() function failed
						}
					},500);


				setTimeout(function() {
							jQuery(theForm).find('.note').html('').slideUp('fast');
							jQuery(theForm).find("button, .churchope_button").removeAttr('disabled');
							jQuery(theForm).find("input[type=text], textarea").val('');
							jQuery(theForm).find('div').fadeIn(500);
						},3000);
            },
		error: function(response) {

					jQuery(theForm).find('div').fadeOut(500);
					setTimeout(function() {
						jQuery(theForm).append('<p class="note">Something going wrong with connection...</p>').fadeIn(500); //error text when ajax didn't send data to php processor
						},500);
							setTimeout(function() {
								jQuery(theForm).find('.note').html('').slideUp('fast');
								jQuery(theForm).find("button, .churchope_button").removeAttr('disabled');
								jQuery(theForm).find("input[type=text], textarea").val('');
								jQuery(theForm).find('div').fadeIn(500);
							},3000);

			}


	});

	return false;
}
 function handlePlayerStateChange (state) {
      switch (state) {
        case 1:
        case 3:
          // Video has begun playing/buffering
		  slideshowVideo.play();
		  jQuery('#jcyclemain').cycle('pause');
          break;
        case 2:
        case 0:
          // Video has been paused/ended
			slideshowVideo.pause();
			if(typeof slider_pause != 'undefined')
			{
				if(!slider_pause)
				{
					jQuery('#jcyclemain').cycle('resume')
				}
			}
          break;
      }
    }

    function onYouTubePlayerReady(id)
	{
		var player = jQuery('#jcyclemain #' + id).get(0);
		if(player)
		{
			if (player.addEventListener) {
				player.addEventListener('onStateChange', 'handlePlayerStateChange');
			}
			else {
				player.attachEvent('onStateChange', 'handlePlayerStateChange');
			}
		}
	}
	
	function initHistory() {
		if(History_inited == false ) {
			History_inited = true;
			
			// Prepare
			History = window.History; // Note: We are using a capital H instead of a lower h
			
			if(typeof History != 'undefined' && History !== null) 
			{
				if ( !History.enabled ) {
					 // History.js is disabled for this browser.
					 // This is because we can optionally choose to support HTML4 browsers or not.
					return false;
				}
				// initial state
				pushToHistory(jQuery('.events_calendar').html());

				// Bind to StateChange Event
				History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
					var State = History.getState(); // Note: We are using History.getState() instead of event.state

					if(typeof State.data.html != 'undefined' && State.data.html.length > 0)
					{
						jQuery('.events_calendar').html(State.data.html);
					}
				});
			}
		}
	}
	
	function pushToHistory(data) {
//		console.log('pushToHistory'); 
		if(typeof History != 'undefined' && History !== null)
		{
			History.pushState({html:data}, document.title, document.URL);
		}
	}
	
	function sliderRun(){
	// set slider run flag
	window.slider_was_run = true;

	/* Swipe Variables */
	jQuery.fn.cycle.transitions.scrollHorzTouch = function($cont, $slides, opts) {
		$cont.css('overflow','hidden').width();
		opts.before.push(function(curr, next, opts, fwd) {
			if (opts.rev)
				fwd = !fwd;
			positionNext = jQuery(next).position();
			positionCurr = jQuery(curr).position();

			$.fn.cycle.commonReset(curr,next,opts);
			if( ( positionNext.left > 0 && fwd ) || ( positionNext.left <  0 && !fwd ) )
			{
				opts.cssBefore.left = positionNext.left;
			}
			else
			{
				opts.cssBefore.left = fwd ? (next.cycleW-1) : (1-next.cycleW);
			}
			if( ( positionCurr.left > 0 && fwd ) || ( positionCurr.left <  0 && !fwd ) )
			{
				opts.animOut.left = positionCurr.left;
			}
			else
			{
				opts.animOut.left = fwd ? -curr.cycleW : curr.cycleW;
			}
		});
		opts.cssFirst.left = 0;
		opts.cssBefore.top = 0;
		opts.animIn.left = 0;
		opts.animOut.top = 0;
	};

	jQuery("#jcyclemain").css('display','block');
	var winWidth = jQuery(window).width(), winHeight = jQuery(window).height();
	var resizeTimeout = null;
	jQuery(window).resize(function(){
		onResize = function() {
//			console.log('resize');
			jQuery('#jcyclemain div[data-contsize]').removeAttr('data-contsize');
			var cw = jQuery('#jcyclemain .jcyclemain:visible .bgimage').innerWidth();
			var pad = parseInt((typeof slider_padding != 'undefined' && (slider_padding == '1'))?'0':'110');
			if(jQuery('#jcyclemain .jcyclemain:visible .cycle_content').length){
					var ch = jQuery('#jcyclemain .jcyclemain:visible .cycle_content').innerHeight();
				} else {
					var ch = 0;
				}
			if (cw > 767) {
				if(jQuery('#jcyclemain .jcyclemain:visible .cycle_image').length){
					var ih = jQuery('#jcyclemain .jcyclemain:visible .cycle_image').height();
				} else {
					if(jQuery('#jcyclemain .jcyclemain:visible ').attr('data-slidesize')){
					var ih = (jQuery('#jcyclemain .jcyclemain:visible ').attr('data-slidesize')-pad);
					jQuery('#jcyclemain .jcyclemain:visible .bgimage').css({'background-image': 'url(' + jQuery('#jcyclemain .jcyclemain:visible ').attr('data-background') + ')'});
					} else {
						var ih = 0;
					}
				}
				var nh = null;
				if (ih > ch){
					fh = (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0"))?slider_fixedheight:'0';

					if ( (ih > fh) && (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0")) ) {					
						if (fh > ch) {					
						jQuery(nextElement).find('.cycle_content').css({'paddingTop':(fh-ch)/2+'px'});
						}

					} else {
						if(typeof nextElement !== 'undefined')
						{
							jQuery(nextElement).find('.cycle_content').css({'paddingTop':(ih-ch)/2+'px'});
						}
					}
					nh = ih;
				} else {
					nh = ch;
				}
			}
			else
			{
				var nh = null;
				if(jQuery('#jcyclemain .jcyclemain:visible .cycle_image').length){
					var ih = jQuery('#jcyclemain .jcyclemain:visible .cycle_image').height();
					nh = ch + ih;
				} else {
					if(jQuery('#jcyclemain .jcyclemain:visible ').attr('data-slidesize')){
					var ih = (jQuery('#jcyclemain .jcyclemain:visible ').attr('data-slidesize')-pad);

					if (ih > ch){
						//jQuery('#jcyclemain .jcyclemain:visible .cycle_content').css({'paddingTop':(ih-ch)/2+'px'});
						nh = ih;
					} else {
						nh = ch;
					}

					jQuery('#jcyclemain .jcyclemain:visible .bgimage').css({'background-image': 'url(' + jQuery('#jcyclemain .jcyclemain:visible ').attr('data-background') + ')'});
					} else {
						var ih = 0;
						nh = ch + ih;
					}
				}

			}
			nh = (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0"))?slider_fixedheight:parseInt(nh);
			jQuery('#jcyclemain .jcyclemain:visible .bgimage').css({'height':nh+'px'});
			jQuery("#slide_next, #slide_prev").animate({top:(nh+pad)/2 - 50});
			jQuery("#jcyclemain").stop().animate({height:(nh+pad)+'px'});
		}
		var winNewWidth = jQuery(window).width(),winNewHeight = jQuery(window).height();

			// compare the new height and width with old one
			if(winWidth!=winNewWidth || winHeight!=winNewHeight)
			{
				if(resizeTimeout)
				{
					window.clearTimeout(resizeTimeout);
				}

				resizeTimeout = window.setTimeout(onResize, 65);
			}
			//Update the width and height
			winWidth = winNewWidth;
			winHeight = winNewHeight;
	});

	var currenSlide = null;
	var slideNumber = 0;
	var currentLeft = 0;
	var leftStart = 0;
	var sliderExpr;
	var slideFlag = false;
	var slideshow_iterator = 1;
	var slider_next = (typeof slider_navigation != 'undefined' && (slider_navigation != "0"))?"#slide_next":null;
	var slider_prev = (typeof slider_navigation != 'undefined' && (slider_navigation != "0"))?"#slide_prev":null;
	if (typeof slider_navigation == 'undefined' || (slider_navigation == "0")) {jQuery('#jcyclemain_navigation').remove();}
	jQuery('#jcyclemain').cycle({
				fx: (typeof slider_fx != 'undefined' && (slider_fx != ""))?slider_fx:'fade',//
				timeout: (typeof slider_timeout != 'undefined')?slider_timeout:'6000',//
				pager: '#navjcycle span',
				speed: (typeof slider_speed != 'undefined')?slider_speed:'1000',//
				pagerEvent: 'click',
//				pauseOnPagerHover:true,
//    			pauseOnPagerHover: (typeof slider_pauseOnHover != 'undefined')?!!slider_pauseOnHover:true,//
				cleartypeNoBg: true,
                cleartype: true,
				pause: (typeof slider_pause != 'undefined')?!!slider_pause:1,//
				next: slider_next,
				prev: slider_prev,
                before: animateSlide,
                after: animateSlideContent,
				slideResize: true,
                containerResize: false,
                width: '100%',
                fit: 1,
				autostop: (typeof autoscroll !='undefined')?!!autoscroll:false,
				autostopCount:1
	});

	jQuery('#jcyclemain').hover(function(){

		if(slideshowVideo.isPlaing())
		{
			jQuery('#jcyclemain').cycle('pause');
		}
	},function(){

		if(slideshowVideo.isPlaing())
		{
			jQuery('#jcyclemain').cycle('pause');
		}
	});

	jQuery('#color_header, .rev_slider_wrapper').hover(function(){	
		console.log('over');
		jQuery("#jcyclemain_navigation").fadeIn();
	},function(){
		jQuery("#jcyclemain_navigation").fadeOut();
	});


	jQuery('#jcyclemain').css("display", "block");
	jQuery('#navjcycle').css("display", "block");
	jQuery('#navjcycle a:only-child').remove();

	if (typeof jQuery('#jcyclemain').swipe!=='undefined'){
	jQuery('#jcyclemain').swipe({
			swipeMoving: function( pageX ){

				if( slideFlag ) return;

				var newLeft = currentLeft-pageX;

				currenSlide.css('left', newLeft+'px'  );

				var $slides = jQuery( sliderExpr, jQuery('#jcyclemain') );
				var scrollSlide;

				nextSlideLeft =   newLeft > 0 ? newLeft - currenSlide.width(): newLeft+currenSlide.width();
				flag = newLeft > 0 ? -1: 1;
				scrollSlide  = slideNumber + flag;
				if( scrollSlide < 0 || scrollSlide > ($slides.length - 1 ) ) {
					scrollSlide = scrollSlide < 0 ? $slides.length - 1 : 0;
				}
				$slides.eq( scrollSlide ).css('left',nextSlideLeft + 'px' );
				$slides.eq( scrollSlide ).show();
			},
			swipeLeft: function(){
				jQuery('#jcyclemain').cycle('next');
			},
			swipeRight: function(){
				jQuery('#jcyclemain').cycle('prev');
			}
		});
	}


	function animateSlide(currElement, nextElement, opts, isForward) {
		sliderExpr = opts.slideExpr;
		slideFlag = true;

		jQuery(nextElement).find('.bgimage').css({opacity:0});
			if (Modernizr.canvas ) {
		jQuery(currElement).find('.cycle_content .entry-title, .cycle_content .entry-content, .cycle_image, .bgimage').animate({'visibility':'hidden','opacity':'0'});
			}
    }


    function animateSlideContent(currElement, nextElement, opts, isForward) {
		currenSlide =  jQuery(nextElement);
		slideNumber = opts.currSlide;
		currentLeft = jQuery(nextElement).position().left;
		slideFlag = false;

		var cw = jQuery(nextElement).find('.bgimage').innerWidth();
		var pad = parseInt((typeof slider_padding != 'undefined' && (slider_padding == '1'))?'0':'110');
		if(jQuery(nextElement).find('.cycle_content').length)
		{
			var ch = parseInt(jQuery(nextElement).attr('data-contsize'),10);

			if (isNaN(ch))
			{
				var ch = jQuery(nextElement).find('.cycle_content').innerHeight();
//				if(slideshow_iterator>1)
				{
					jQuery(nextElement).attr('data-contsize',ch);
				}
			}
		}
		else
		{
			var ch = 0;
		}
		if (cw > 767)
		{
			if(jQuery(nextElement).find('.cycle_image').length)
			{
				var ih = jQuery(nextElement).find('.cycle_image').height();
			}
			else
			{
				if(jQuery(nextElement).attr('data-slidesize'))
				{
					var ih = (jQuery(nextElement).attr('data-slidesize')-pad);
					jQuery(nextElement).find('.bgimage').css({'background-image': 'url(' + jQuery(nextElement).attr('data-background') + ')'});
				}
				else
				{
					var ih = 0;
				}
			}
			var nh = null;
			if (ih > ch)
			{
				fh = (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0"))?slider_fixedheight:'0';
				
				if ( (ih > fh) && (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0")) ) {					
					if (fh > ch) {					
					jQuery(nextElement).find('.cycle_content').css({'paddingTop':(fh-ch)/2+'px'});
					}
					
				} else {
					jQuery(nextElement).find('.cycle_content').css({'paddingTop':(ih-ch)/2+'px'});
				
				}
				nh = ih;
			}
			else
			{
				nh = ch;
			}
		}
		else
		{
			var nh = null;
			if(jQuery(nextElement).find('.cycle_image').length)
			{
				var ih = jQuery(nextElement).find('.cycle_image').height();
				nh = ch + ih;
			}
			else
			{
				if(jQuery(nextElement).attr('data-slidesize'))
				{
					var ih = (jQuery(nextElement).attr('data-slidesize')-pad);
					if (ih > ch)
					{
						//jQuery(nextElement).find('.cycle_content').css({'paddingTop':(ih-ch)/2+'px'});
						nh = ih;
					}
					else
					{
						nh = ch;
					}
					jQuery(nextElement).find('.bgimage').css({'background-image': 'url(' + jQuery(nextElement).attr('data-background') + ')'});
				}
				else
				{
					var ih = 0;
					nh = ch + ih;
				}
			}
		}
		nh = (typeof slider_fixedheight != 'undefined' && (slider_fixedheight != "0"))?slider_fixedheight:parseInt(nh);
		jQuery(nextElement).find('.bgimage').css({'height':nh+'px'});
		jQuery("#slide_next, #slide_prev").animate({top:(nh+pad)/2 - 50});
		jQuery("#jcyclemain").stop().animate({height:(nh+pad)+'px'},{
			complete:function(){
						jQuery(nextElement).find('.cycle_content .entry-title, .cycle_content .entry-content, .cycle_image, .bgimage').css({'visibility':'visible'});
						jQuery(nextElement).find('.bgimage').animate({opacity:1});
						if (jQuery(nextElement).find('.cycle_image').length)
						{
								jQuery(nextElement).find('.cycle_image').stop().animate({opacity:1}, 400, function(){
								if(jQuery(nextElement).find('.cycle_content .entry-title').length) 
								{
									jQuery(nextElement).find('.cycle_content .entry-title').stop().animate({opacity:1}, 400, function(){
										jQuery(nextElement).find('.cycle_content .entry-content').stop().animate({opacity:1}, 400, function(){});
									});
								}
								else {
									jQuery(nextElement).find('.cycle_content .entry-content').stop().animate({opacity:1}, 400, function(){});
								}
							});
						}
						else
						{
							if(jQuery(nextElement).find('.cycle_content .entry-title').length)
							{
								jQuery(nextElement).find('.cycle_content .entry-title').stop().animate({opacity:1}, 400, function(){
									jQuery(nextElement).find('.cycle_content .entry-content').stop().animate({opacity:1}, 400, function(){});
								});
							}
							else
							{
								jQuery(nextElement).find('.cycle_content .entry-content').stop().animate({opacity:1}, 400, function(){});
							}
						}
					}
		});
		slideshow_iterator++;

    }

}

function downloadLink(link)
{
	if(link && link.length)
	{
		location.href = ThemeData.downloadLink + '?file='+encodeURIComponent(link);
	}
	return false;
}
//(function(window,undefined){
//
//History = window.History; // Note: We are using a capital H instead of a lower h
//	if ( !History.enabled ) {
//		 // History.js is disabled for this browser.
//		 // This is because we can optionally choose to support HTML4 browsers or not.
//		return false;
//	}
//
// // Bind to StateChange Event
// History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
//	 var State = History.getState(); // Note: We are using History.getState() instead of event.state
//	 History.log(State.data, State.title, State.url);
// });
//
// // Change our States
// History.pushState({state:1}, "State 1", "?state=1"); // logs {state:1}, "State 1", "?state=1"
// History.pushState({state:2}, "State 2", "?state=2"); // logs {state:2}, "State 2", "?state=2"
// History.replaceState({state:3}, "State 3", "?state=3"); // logs {state:3}, "State 3", "?state=3"
// History.pushState(null, null, "?state=4"); // logs {}, '', "?state=4"
// History.back(); // logs {state:3}, "State 3", "?state=3"
// History.back(); // logs {state:1}, "State 1", "?state=1"
// History.back(); // logs {}, "Home Page", "?"
// History.go(2); // logs {state:3}, "State 3", "?state=3"
//
//})(window);