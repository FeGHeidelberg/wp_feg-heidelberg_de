<?php
defined('WP_ADMIN') || define('WP_ADMIN', true);
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Share Buttons','churchope'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
	}
	function submitData() {				
		var shortcode;
		
		var current_tab = jQuery('div.current');
		switch(current_tab.attr('id'))
		{
			case 'google_panel':
				shortcode = googleShortcode();
				break;
			case 'facebook_panel':
				shortcode = facebookShortcode();
				break;
			case 'twitter_panel':
				shortcode = twitterShortcode();
				break;
			case 'pinterest_panel':
				shortcode = pinterestShortcode();
				break;
			default:
				shortcode ='';
				break;
		}
		
		if(window.tinyMCE) {
			var id;
			if(typeof tinyMCE.activeEditor.editorId != 'undefined')
			{
				id =  tinyMCE.activeEditor.editorId;
			}
			else
			{
				id = 'content';
			}
			window.tinyMCE.execInstanceCommand(id, 'mceInsertContent', false, shortcode)

			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	
	function twitterShortcode()
	{
		var url, text, count, size, via, related, shortcode;
		url = jQuery('#t_b_url').val();
		text = jQuery('#t_b_text').val();
		count = jQuery('#t_b_position').val();
		if (jQuery('#t_b_size').is(':checked')) {size = jQuery('#t_b_size:checked').val();} else { size = '';}		
		via = jQuery('#t_b_via').val();
		related = jQuery('#t_b_related').val();
		
		shortcode = '[social_button button="twitter" ';
		
		if(url)
		{
			shortcode += ' turl="'+url+'"';
		}
		if(text)
		{
			shortcode += ' ttext ="'+text+'"';
		}
		if(count)
		{
			shortcode += ' tcount ="'+count+'"';
		}
		if(size)
		{
			shortcode += ' tsize ="'+size+'"';
		}
		if(via)
		{
			shortcode += ' tvia ="'+via+'"';
		}
		if(related)
		{
			shortcode += ' trelated ="'+related+'"';
		}
		shortcode += ']';
		return shortcode;
		
	}
	
	function facebookShortcode()
	{
		var send, url, layout, width, face,action, colorsheme,shortcode;
		url = jQuery('#f_b_url').val();
		
		if (jQuery('#f_b_send').is(':checked')) {send = jQuery('#f_b_send:checked').val();} else { send = '';}			
		
		layout = jQuery('#f_b_layout').val();
		width =  jQuery('#f_b_width').val();
		if (jQuery('#f_b_face').is(':checked')) {face = jQuery('#f_b_face:checked').val();} else { face = '';}			
		action = jQuery('#f_b_verb').val();
		colorsheme = jQuery('#f_b_scheme').val();
		
		shortcode = '[social_button button="facebook"';
		
		if(url)
		{
			shortcode += ' furl="'+url+'"';
		}
		
		if(send)
		{
			shortcode += ' fsend="'+send+'"';
		}
		
		if(layout)
		{
			shortcode += ' flayout="'+layout+'"';
		}
		if(face)
		{
			shortcode += ' fshow_faces="'+face+'"';
		}
		if(width)
		{
			shortcode += ' fwidth="'+parseInt(width,10)+'"';
		}
		if(action)
		{
			shortcode += ' faction="'+action+'"';
		}
		if(colorsheme)
		{
			shortcode += ' fcolorsheme="'+colorsheme+'"';
		}
		shortcode += ']';
		
		return shortcode;
	}
	
	function googleShortcode()
	{
		var size, annatation, html, url, shortcode;
		size = jQuery('#g_b_size').val();
		annatation = jQuery('#g_b_annatation').val();
		if (jQuery('#g_b_html5').is(':checked')) {html = jQuery('#g_b_html5:checked').val();} else { html = '';}			
		url = jQuery('#g_b_url').val();
		
		shortcode = '[social_button button="google"';
		if(size)
		{
			shortcode += ' gsize="'+size+'"';
		}
		if(annatation)
		{
			shortcode += ' gannatation="'+annatation+'"';
		}
		if(html)
		{
			shortcode += ' ghtml5="'+html+'"';
		}
		if(url)
		{
			shortcode += ' gurl="'+url+'"';
		}
			
		shortcode += ']';
		return shortcode;
	}
	
	function pinterestShortcode()
	{
		var shortcode, purl, iurl, count, text;
		purl = jQuery('#p_b_purl').val();
		media = jQuery('#p_b_iurl').val();
		count = jQuery('#p_b_layout').val();
		text = jQuery('#p_b_text').val();
		shortcode = '[social_button button="pinterest"' ;
		if(purl && purl.length)
		{
			shortcode += ' purl="'+purl+'"';
		}
		if(media && media.length)
		{
			shortcode += ' pmedia="'+media+'"';
		}
		if(count && count.length)
		{
			shortcode += ' pcount="'+count+'"';
		}
		if(text && text.length)
		{
			shortcode += ' ptext="'+text+'"';
		}
		
		shortcode += ']';
		
		return shortcode;
	}
	</script>
<!--	Google+-->
<!--	<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	</script>-->
	
	
	
	<style type="text/css">
		.panel_wrapper div.current {
			height: 100%;
		}
	</style>
	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="buttons" action="#" >
		<div class="tabs">
			<ul>
				<li id="google_tab" class="current"><span><a href="javascript:mcTabs.displayTab('google_tab','google_panel');" onMouseDown="return false;">Google+</a></span></li>
				<li id="twitter_tab"><span><a href="javascript:mcTabs.displayTab('twitter_tab','twitter_panel');" onMouseDown="return false;">Twitter</a></span></li>
				<li id="facebook_tab"><span><a href="javascript:mcTabs.displayTab('facebook_tab','facebook_panel');" onMouseDown="return false;">Facebook</a></span></li>
				<li id="pinterest_tab"><span><a href="javascript:mcTabs.displayTab('pinterest_tab','pinterest_panel');" onMouseDown="return false;">Pinterest</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			<div id="google_panel" class="panel current">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Size:','churchope'); ?></legend>
					<label for="g_b_size"><?php _e('Choose a size:','churchope'); ?></label><br><br>
					<select name="g_b_size" id="g_b_size"  style="width:250px">
						<option value="small"><?php _e('Small (15px)','churchope'); ?></option>
						<option value="standard"><?php _e('Standard(24px)','churchope'); ?></option> <!-- default  -->
						<option value="medium"><?php _e('Medium(20px)','churchope'); ?></option>
						<option value="tall"><?php _e('Tall(60px)','churchope'); ?></option>
					</select>					
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Type of Annotation:','churchope'); ?></legend>
					<label for="g_b_annatation"><?php _e('Choose a Annotation:','churchope'); ?></label><br><br>
					<select name="g_b_annatation" id="g_b_annatation"  style="width:250px">
						<option value="inline"><?php _e('Inline','churchope'); ?></option>
						<option value="bubble"><?php _e('Bubble','churchope'); ?></option>  <!-- default  -->
						<option value="none"><?php _e('None','churchope'); ?></option>
					</select>					
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Advanced options:','churchope'); ?></legend>
					<label for="g_b_html5"><?php _e('HTML5 valid syntax:','churchope'); ?></label>
					<input name="g_b_html5" type="checkbox" id="g_b_html5"><br><br>	
			
					<label for="g_b_url"><?php _e('URL to +1:','churchope'); ?></label><br><br>
					<input name="g_b_url" type="text" id="g_b_url" style="width:250px">
				</fieldset>
			</div>
<!--	 ----------------------------------------------------------------------		-->
			<div id="twitter_panel" class="panel">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Count box position:','churchope'); ?></legend>
					<label for="t_b_position"><?php _e('Choose a Position:','churchope'); ?></label><br><br>
					<select name="t_b_position" id="t_b_position"  style="width:250px">
						<option value="none"><?php _e('None','churchope'); ?></option>
						<option value="horizontal"><?php _e('Horizontal','churchope'); ?></option>  <!-- default  -->
						<option value="vertical"><?php _e('Vertical','churchope'); ?></option>
					</select>					
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Button size:','churchope'); ?></legend>
					<label for="t_b_size"><?php _e('Large:','churchope'); ?></label>
					<input name="t_b_size" type="checkbox" id="t_b_size" value="large"><br><br>	
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('URL of the page to share:','churchope'); ?></legend>
					<label for="t_b_url"><?php _e('URL(default: URL of the webpage):','churchope'); ?></label><br><br>
					<input name="t_b_url" type="text" id="t_b_url" style="width:250px">
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Recommended accounts:','churchope'); ?></legend>
					<label for="t_b_related">@</label>
					<input name="t_b_related" type="text" id="t_b_related" style="width:236px"><br><br>
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Via user:','churchope'); ?></legend>
					<label for="t_b_via">@</label>
					<input name="t_b_via" type="text" id="t_b_via" style="width:236px">
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Default Tweet text:','churchope'); ?></legend>
				<label for="t_b_text"><?php _e('Text:','churchope'); ?></label><br>
					<textarea name="t_b_text" type="text" id="t_b_text" style="width:250px"></textarea>
				</fieldset>
				
				
			</div>
<!--	 -----------------------------URL to -----------------------------------------		-->
			<div id="facebook_panel" class="panel">
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('URL to Like:','churchope'); ?></legend>
					<label for="f_b_url"><?php _e('URL:','churchope'); ?></label><br><br>
					<input name="f_b_url" type="text" id="f_b_url" style="width:250px">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Send Button:','churchope'); ?></legend>
					<label for="f_b_send"><?php _e('Send Button:','churchope'); ?></label>
					<input name="f_b_send" type="checkbox" id="f_b_send"><br><br>	
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Layout Style:','churchope'); ?></legend>
					<label for="f_b_layout"><?php _e('Choose a Layout:','churchope'); ?></label><br><br>
					<select name="f_b_layout" id="f_b_layout"  style="width:250px">
						<option value="standard "><?php _e('Standard','churchope'); ?></option>
						<option value="button_count"><?php _e('Button Count','churchope'); ?></option>  <!-- default  -->
						<option value="box_count"><?php _e('Box Count','churchope'); ?></option>
					</select>					
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Width:','churchope'); ?></legend>
					<label for="f_b_width"><?php _e('Width:','churchope'); ?></label><br><br>
					<input name="f_b_width" type="text" id="f_b_width" style="width:250px" value="450">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Show profile picture:','churchope'); ?></legend>
					<label for="f_b_face"><?php _e('Show Faces:','churchope'); ?></label>
					<input name="f_b_face" type="checkbox" id="f_b_face"><br><br>	
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Verb to display','churchope'); ?></legend>
					<label for="f_b_verb"><?php _e('Choose a Verb:','churchope'); ?></label><br><br>
					<select name="f_b_verb" id="f_b_verb"  style="width:250px">
						<option value="like"><?php _e('Like','churchope'); ?></option>
						<option value="recommend"><?php _e('Recommend','churchope'); ?></option>  <!-- default  -->
					</select>					
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Color Scheme ','churchope'); ?></legend>
					<label for="f_b_scheme"><?php _e('Choose a Scheme:','churchope'); ?></label><br><br>
					<select name="f_b_scheme" id="f_b_scheme"  style="width:250px">
						<option value="light"><?php _e('Light','churchope'); ?></option>
						<option value="dark"><?php _e('Dark','churchope'); ?></option>  <!-- default  -->
					</select>					
				</fieldset>
			</div>
			<div id="pinterest_panel" class="panel">
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Page the pin is on:','churchope'); ?></legend>
					<label for="p_b_purl"><?php _e('URL:','churchope'); ?></label><br><br>
					<input name="p_b_purl" type="text" id="p_b_purl" style="width:250px">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Image to be pinned:','churchope'); ?></legend>
					<label for="p_b_iurl"><?php _e('URL:','churchope'); ?></label><br><br>
					<input name="p_b_iurl" type="text" id="p_b_iurl" style="width:250px">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Pin Count:','churchope'); ?></legend>
					<label for="p_b_layout"><?php _e('Choose a Layout:','churchope'); ?></label><br><br>
					<select name="p_b_layout" id="p_b_layout"  style="width:250px">
						<option value="horizontal"><?php _e('Horizontal','churchope'); ?></option>
						<option value="vertical "><?php _e('Vertical','churchope'); ?></option>
						<option value="none"><?php _e('No Count','churchope'); ?></option>
					</select>					
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e("What they're pinning:","churchope"); ?></legend>
					<label for="p_b_text"><?php _e('Text:','churchope'); ?></label><br>
					<textarea name="p_b_text" type="text" id="p_b_text" style="width:250px"></textarea>
				</fieldset>
			</div>
		</div>
		<div class="mceActionPanel">
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e('Insert','churchope'); ?>" onClick="submitData();" />
			</div>
		</div>
	</form>
</body>
</html>