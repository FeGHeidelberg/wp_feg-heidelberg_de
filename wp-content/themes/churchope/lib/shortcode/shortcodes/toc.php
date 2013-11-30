<?php
defined('WP_ADMIN') || define('WP_ADMIN', true);
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Table of Contents','churchope'); ?></title>
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
		var shortcode = '[toc';
		var title = jQuery('#title').val();
		var hide = jQuery('#hide').val();
		var show = jQuery('#show').val();
	
		
		if(title.length)
		{
			shortcode += ' title="'+title+'"';
		}
		if(hide.length)
		{
			shortcode += ' hide="'+hide+'"';
		}
		if(show.length)
		{
			shortcode += ' show="'+show+'"';
		}
		shortcode += ']';
		
		shortcode += '<ul><li><a href="#topic1" >Topic 1</a></li><li><a href="#topic2" >Topic 2</a></li><li><a href="#topic3" >Topic 3</a></li><li><a href="#topic4" >Topic 4</a></li><li><a href="#topic5" >Topic 5</a></li></ul>';
		
		
		shortcode += '[/toc]';
			
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
	
	
	</script>

	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="toc" action="#" >
		<div class="tabs">
			<ul>
				<li id="toc_tab" class="current"><span><a href="javascript:mcTabs.displayTab('toc_tab','toc_panel');" onMouseDown="return false;"><?php _e('Table of Contents','churchope'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Table of Contents settings:','churchope'); ?></legend>
					<label for="title"><?php _e('Title:','churchope'); ?></label><br><br>
					<input type="text" name="title" id="title" style="width:250px" value="<?php _e('Table of Contents','churchope'); ?>" />
					<br><br>
					<label for="hide"><?php _e('"Hide" link text:','churchope'); ?></label>
					<input type="text" name="hide" id="hide"   style="width:250px" value="<?php _e('hide','churchope'); ?>"/>					
					<br><br>
					<label for="show"><?php _e('"Show" link text:','churchope'); ?></label>
					<input type="text" name="show" id="show"   style="width:250px" value="<?php _e('show','churchope'); ?>" /> 
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