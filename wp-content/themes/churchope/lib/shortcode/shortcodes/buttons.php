<?php	
require_once('../../../../../../wp-load.php');
if( get_option(SHORTNAME."_linkscolor")) { $customcolor = get_option(SHORTNAME."_linkscolor"); } else {$customcolor = "#c62b02"; }
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Button','churchope'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">if(typeof  THEME_URI == 'undefined'){var THEME_URI = '<?php echo get_template_directory_uri(); ?>';}</script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() . '/backend/js/mColorPicker/javascripts/mColorPicker.js'?>"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
	}
	function submitData() {				
		var shortcode;
		var selectedContent = tinyMCE.activeEditor.selection.getContent();				
		var button_type = jQuery('#button_type').val();		
		var button_url = jQuery('#button_url').val();	
		var button_color = jQuery('#button_color').val();
		var button_download = jQuery('#button_download').is(':checked');
		
		if (jQuery('#button_target').is(':checked')) {
		var button_target = jQuery('#button_target:checked').val();} else {var button_target = '';}			
	
		shortcode = ' [button type="'+button_type+'" url="'+button_url+'" target="'+button_target+'" button_color_fon="'+button_color+'" ';
		if(button_download){
			shortcode += 'download="1" ';
		}
		
		shortcode += ']'+selectedContent+'[/button] ';
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
	
	jQuery(document).ready(function() {
//		jQuery("#button_type").change(function() {
//			var type = jQuery(this).val();
//			jQuery("#preview").html(type ? "<a class='"+type+"' style='cursor:pointer'><span>Test button</span></a>"  : "");
//		});	

		jQuery('#button_color, #button_type').change(function() {
			var type = jQuery("#button_type").val(),
				color = jQuery('#button_color').val(),
				preview = jQuery('#preview');
			
			if (type == 'simple_button_black') {
				preview.html("<a class='" + type + "' style='cursor:pointer;background-color:#363636'><span>Test button</span></a><style>#preview .simple_button_black:hover{background:"+color+" !important;}</style>");
			} else {
				preview.html("<a class='"+type+"' style='cursor:pointer;background-color:"+color+"'><span>Test button</span></a>");
			}
		});
	});
	
	</script>

	<style type="text/css">
a {transition: color, background 200ms ease-in-out;
											  -webkit-transition: color, background 200ms ease-in-out;
											  -moz-transition: color, background 200ms ease-in-out;
											  -o-transition: color, background 200ms ease-in-out;}
a:hover {transition: color, background 200ms ease-in-out;
											  -webkit-transition: color, background 200ms ease-in-out;
											  -moz-transition: color, background 200ms ease-in-out;
											  -o-transition: color, background 200ms ease-in-out;}
.simple_button_link {background:<?php echo $customcolor ?>;padding: 3px 9px 4px;display: inline-block;color:#fff;text-decoration: none;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;margin-right: 7px;}
.simple_button_link:hover {background:#281e1f !important;color:#fff}
.simple_button_black {background:#281e1f;padding: 3px 9px 4px;display: inline-block;color:#fff;text-decoration: none;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;margin-right: 7px; }
.simple_button_black:hover {background:#fff<?php //echo $customcolor ?>;color:#fff}
.churchope_button {background:<?php echo $customcolor ?> url(../../../images/bg_button.png) repeat-x 0 0; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;text-decoration: none;font-size:12px;line-height: 15px;padding: 15px 23px 14px;display: inline-block;color:#fff;border:none; }
.churchope_button:hover{padding-bottom: 12px;margin-top: 2px;color:#fff;}
	</style>
	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="buttons" action="#" >
		<div class="tabs">
			<ul>
				<li id="buttons_tab" class="current"><span><a href="javascript:mcTabs.displayTab('buttons_tab','buttons_panel');" onMouseDown="return false;"><?php _e('Buttons','churchope'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Type of button:','churchope'); ?></legend>
					<label for="button_type"><?php _e('Choose a type:','churchope'); ?></label><br><br>
					<select name="button_type" id="button_type"  style="width:250px">
						<option value="" disabled selected><?php _e('Select type','churchope'); ?></option>
						<option value="simple_button_link"><?php _e('Simple button','churchope'); ?></option>
						<option value="simple_button_black"><?php _e('Simple button black','churchope'); ?></option>
						<option value="churchope_button"><?php _e('Big color button','churchope'); ?></option>                        
					</select>					
				</fieldset>
			
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('URL for button:','churchope'); ?></legend>
					<label for="button_url"><?php _e('Type your URL here:','churchope'); ?></label><br><br>
					<input name="button_url" type="text" id="button_url" style="width:250px">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Link target:','churchope'); ?></legend>
					<label for="button_target"><?php _e('Check if you want open in new window:','churchope'); ?></label><br><br>
					<input name="button_target" type="checkbox" id="button_target">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Use as download:','churchope'); ?></legend>
					<label for="button_download"><?php _e('Check if you want "force" download(i.e. download mp3 file):','churchope'); ?></label><br><br>
					<input name="button_download" type="checkbox" id="button_download">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Change Color:</legend>
					<label for="button_color">button background colors:</label><br><br>
					<input name="button_color" type="color"  data-hex="true" id="button_color" style="width:230px" value="#363636">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Preview:','churchope'); ?></legend>
					<div id="preview" style="height:70px"></div>
				</fieldset>
			
		</div>
		<div class="mceActionPanel">
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e('Insert','churchope'); ?>" onClick="submitData();" />
			</div>
		</div>
	</form>
</body>
</html>