<?php
defined('WP_ADMIN') || define('WP_ADMIN', true);
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Price Table','churchope'); ?></title>
	
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
		
		var title	= jQuery('#title').val();
		var price	= jQuery('#price').val();
		var text	= jQuery('#text').val().replace(/\n/g, '<br/>');
		var b_text	= jQuery('#b_text').val();
		var b_url	= jQuery('#b_url').val();
		var b_color	= jQuery('#b_color').val();
		var count	= parseInt(jQuery('#count').val());
		var offer_details = '';
		
		if(isNaN(count) || count == '')
		{
			count = 1;
		}
		
		offer_details = '[price_table title ="'+title+'" price="'+price+'" button_text="'+b_text+'" button_url ="'+b_url+'" button_color="'+b_color+'"]'+text+'[/price_table]';
		
		shortcode = '[price_table_group]<br/>';
		
		for(var i=1; i<=count; i++)
		{
			shortcode += offer_details+'<br/>';
		}
		
		shortcode += '[/price_table_group]<br/>';
			
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
		<form name="table" action="#" >
			<div class="tabs">
				<ul>
					<li id="table_tab" class="current"><span><a href="javascript:mcTabs.displayTab('table_tab','table_panel');" onMouseDown="return false;"><?php _e('Price Table','churchope'); ?></a></span></li>
				</ul>
			</div>
			<div class="panel_wrapper">
				
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Offer details:','churchope'); ?></legend>
					
					<label for="title"><?php _e('Title:','churchope'); ?></label><br>
					<input name="title" type="text" id="title" style="width:250px" value="<?php _e('Sale','churchope'); ?>">
					<br><br>

					<label for="price"><?php _e('Price:','churchope'); ?></label><br>
					<input name="price" type="text" id="price" style="width:250px" value="<?php _e('$47/month','churchope'); ?>">
					<br><br>
				
					<label for="text"><?php _e('Offer text:','churchope'); ?></label><br>
					<textarea name="text" type="text" id="text" style="width:250px"><?php _e('offer details','churchope'); ?></textarea>
					<br><br>

					<label for="b_text"><?php _e('Button text:','churchope'); ?></label><br>
					<input name="b_text" type="text" id="b_text" style="width:250px" value="<?php _e('Buy','churchope'); ?>">
					<br><br>
					
					<label for="b_url"><?php _e('Button URL:','churchope'); ?></label><br>
					<input name="b_url" type="text" id="b_url" style="width:250px" value="#">
					<br><br>
					
					<label for="b_color"><?php _e('Button Color:','churchope'); ?></label><br>
					<input name="b_color" type="color"  data-hex="true" id="b_color" style="width:250px" value="#29BCE4">
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Offers count:','churchope'); ?></legend>
						<label for="count"><?php _e('Choose count of offers in price table:','churchope'); ?></label><br><br>
					<input name="count" type="text" id="count" style="width:250px" value="3">
				</fieldset>
				
				<br/><br/><br/>
			</div>
			<div class="mceActionPanel">
				<div style="float: right">
					<input type="submit" id="insert" name="insert" value="<?php _e('Insert','churchope'); ?>" onClick="submitData();" />
				</div>
			</div>
		</form>
</body>
</html>