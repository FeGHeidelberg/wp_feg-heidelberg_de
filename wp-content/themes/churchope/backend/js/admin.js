jQuery.noConflict();

function file_rm_ajax() {
	jQuery("input[name^='file_rm']").live("click",function(){
		
		var $fileId = jQuery(this).attr("id");
//		var $fileName = jQuery("#"+$fileId).val();
		jQuery("#"+$fileId).remove();
		
		
			
		jQuery.ajax({
			type: "post",
			url: $AjaxUrl,
			data: { 
				action: "file_rm",
				file_id: $fileId,
				_ajax_nonce: $ajaxNonce },
			beforeSend: function() {jQuery("."+$fileId).css({display:""});}, //fadeIn loading just when link is clicked
			success: function(){ //so, if data is retrieved, store it in html
				jQuery("#file_deleted_"+$fileId).fadeOut("fast", function(){jQuery(this).remove()}); //animation
				jQuery("#image_"+$fileId).fadeOut("fast", function(){jQuery(this).remove()});
//				jQuery("#th_img_frame_"+$fileId).css({display:""});
			}
		}); //close jQuery.ajax
		return false;
	});
}

function file_up_ajax()
{
	if ( typeof wp !== 'undefined' && wp.media && wp.media.editor )
	{
		uploader_after35();
	}
	else
	{
		uploader_before35();
	}
}

function uploader_before35() {
		jQuery("input.button[id^='file_up_']").bind("click",function(){
		var $this   = jQuery(this),	tbframeInterval;
		var option_id = $this.attr('id').replace(/^file_up_/, '');
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true&width=670&height=600');
		tbframeInterval = setInterval(function() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
			jQuery('#TB_iframeContent').contents().find('#go_button').val('Use This Image');
		}, 1000);

		// Send img url
		window.send_to_editor = function(html) {
			var imgUrl = '';
			clearInterval( tbframeInterval );
			
			var HTMLObj = jQuery(html);
			
			if(HTMLObj.attr('href'))
			{
				imgUrl = HTMLObj.find('img').attr('src');
			}
			else
			{
				imgUrl = HTMLObj.attr('src');
			}
			if(!imgUrl || imgUrl.length == 0)
			{
					imgUrl = jQuery(html).attr('src');
			}
			//imgUrl = imgURl.replace(/(http:)\1/, '$1');
			if(imgUrl && imgUrl.length)
			{
				uploader_ajax($this, option_id, imgUrl);
			}
			tb_remove();
		};
		
	});
}

function uploader_after35() {
	 var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
	
	jQuery("input.button[id^='file_up_']").bind("click",function()
	{
		var $this   = jQuery(this);
		var option_id = $this.attr('id').replace(/^file_up_/, '');
		
		var button = jQuery(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				uploader_ajax($this, option_id, attachment.url);
//				jQuery("#"+id).val(attachment.url);
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		return false;
	});
	jQuery('.add_media').on('click', function(){
		_custom_media = false;
	});
}

function uploader_ajax(obj, option_id, imgUrl) 
{
	jQuery.ajax({
					type: "post",
					url: $AjaxUrl,
					data: { 
						action: "file_up",
						field_id: option_id,
						src: imgUrl,
						_ajax_nonce: $ajaxNonce },
					success: function(){
						var img = jQuery('#image_file_rm_'+option_id);
						if(img && img.length)
						{
							img.attr('src', imgUrl);
							img.attr('title', '<img src="'+imgUrl+'" alt=\'\' />');
						}
						else
						{
							jQuery('<img src="'+imgUrl+'" alt=""   id="image_file_rm_'+option_id+'" class="th_img" title="&lt;img src=\"'+imgUrl+'\" alt=\'\' /&rt;"  />'
									+'<div id="file_deleted_file_rm_'+option_id+'">'
												+'<div style="float:left;margin:0 0 20px 0">'
													+'<input type="button" name="file_rm_'+option_id+'" id="file_rm_'+option_id+'" class="button" value="Delete" />'
												+'</div>'
												+'<div style="margin:3px 0 24px 8px;float:left;"></div>'
									+'</div>').insertBefore(obj.closest('div.image-label'));
						}
					}
				}); //close jQuery.ajax
}


function install_dummy() {
	jQuery("input[name^='install_dummy']").bind("click",function(){
	
	jQuery.ajax({
		
			type: "post",
			url: $AjaxUrl,
			dataType: 'json',
			data: {action: "install_dummy",   _ajax_nonce: $ajaxNonce},
			beforeSend: function() {
				jQuery(".install_dummy_result").html('');
				jQuery(".install_dummy_loading").css({display:""});
				jQuery("input[name^='install_dummy']").attr('disabled', 'disabled');
				jQuery(".install_dummy_result").html("Importing dummy content...<br /> Please wait, it can take up to a few minutes.");					
			
			}, //fadeIn loading just when link is clicked
			success: function(response){ //so, if data is retrieved, store it in html
				var dummy_result = jQuery(".install_dummy_result");
				jQuery("input[name^='install_dummy']").remove();
				if(typeof response != 'undefined')
				{
					if(response.hasOwnProperty('status'))
					{
						switch(response.status)
						{
							case 'success':
									dummy_result.html('Completed');
								break;
							case 'error':
									dummy_result.html('<font color="red">'+response.data+'</font>');
								break;
							default:
								break;
						}
						
					}
				}
				jQuery(".install_dummy_loading").css({display:"none"});
			}
		}); //close jQuery.ajax
	
	return false;
	});
}



jQuery(document).ready(function(){
jQuery(":checkbox").iButton();

jQuery('.th_help[title], .th_img[title]').qtip({
	content: {
		text: false
	},
	style: {
		tip: "bottomLeft",
		classes: "ui-tooltip-dark"
	},
	position: {
		at: "top right",
		my: "bottom left"
	}
}
);
   

function sidebar_rm_ajax() {
	jQuery("input[name^='sidebar_rm']").bind("click",function(){
		
		var $sidebarId = jQuery(this).attr("id");
		var $sidebarName = jQuery("#sidebar_generator_"+$sidebarId).val();
		jQuery("#sidebar_generator_"+$sidebarId).remove();
		
		var $arraySidebarInputs = new Array;
		jQuery("input[name^='sidebar_generator_']").each(function(id) {
                     $updateSidebars = jQuery("input[name^='sidebar_generator_']").get(id);
                     $arraySidebarInputs.push($updateSidebars.value);
                    });
		
		var $sidebarInputsStr = $arraySidebarInputs.join(",");
			
		jQuery.ajax({
			type: "post",
			url: $AjaxUrl,
			data: {
				action: "sidebar_rm",
				sidebar: $sidebarInputsStr,
				sidebar_id: $sidebarId,
				sidebar_name: $sidebarName,
				_ajax_nonce: $ajaxNonce
			},
			beforeSend: function() {
				jQuery(".sidebar_rm_"+$sidebarId).css({display:""}); //fadeIn loading just when link is clicked
			}, 
			success: function(html){ //so, if data is retrieved, store it in html
				jQuery("#sidebar_cell_"+$sidebarId).fadeOut("fast"); //animation
			}
		}); //close jQuery.ajax
		return false;
	});
}


//Google fonts preview
function changegfont() {
  var str = "";
    jQuery("[id$=_gfont] option:selected").each(function() {
        str += jQuery(this).text() + "";
    });
	
	if(str && str.length)
	{
		var link = ("<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=" + str + "' media='screen' />");
		jQuery("head").append(link);
		jQuery(".gfont_preview").css("font-family", str);
	}

}
jQuery("[id$=_gfont]").closest("div").before('<div class="gfont_preview">The quick brown fox jumps over the lazy dog</div>');
changegfont();
jQuery("[id$=_gfont]").change(function() {
  changegfont();
});


jQuery("[id$=_gfont]").keyup(function() {
    changegfont();
});


jQuery("[id$=_gfont]").keydown(function() {
    changegfont();
});

/*
 * Toggling group of elements.
 */
jQuery('label.toggle').click(function(){
	var ul = jQuery(this).closest('li').find('ul:first');
	if(ul && ul.length>0)
	{
		jQuery(this).toggleClass('down');
		ul.toggle('slow');
	}
});

sidebar_rm_ajax();
file_rm_ajax();
install_dummy();
file_up_ajax();

});