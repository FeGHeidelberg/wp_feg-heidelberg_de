<?php
defined('WP_ADMIN') || define('WP_ADMIN', true);
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Notification','churchope'); ?></title>
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
		var selectedContent = tinyMCE.activeEditor.selection.getContent();				
		var notification_type = jQuery('#notification_type').val();		
		shortcode = ' [notification type="'+notification_type+'"]'+selectedContent+'[/notification] ';			
			
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
    jQuery("#notification_type").change(function() {
        var type = jQuery(this).val();
        jQuery("#preview").html(type ? "<div class='th_notification "+type+"' >Test block</div>"  : "");
    });	
	});
	
	</script>
	<style type="text/css">
	.th_notification {padding:20px 25px 10px 75px;margin-bottom:10px;min-height:52px}
	.th_notification.notification_mark {border:1px solid #b5e4a0; background:#dceccf url(../../../images/i_successful.png) no-repeat 19px 19px; padding:20px 15px 15px 70px; margin-bottom:20px; color:#427625; clear:both; min-height:38px;}
	.th_notification.notification_error {border:1px solid #d9c2ba; background:#f2e1d8 url(../../../images/i_errorn.png) no-repeat 19px 19px; padding:20px 15px 15px 70px; margin-bottom:20px; color:#872a06; clear:both; min-height:38px;}
	.th_notification.notification_info {border:1px solid #cccccc; background:#e9e9e9 url(../../../images/i_info.png) no-repeat 19px 19px; padding:20px 15px 15px 70px; margin-bottom:20px; clear:both; min-height:38px;}
	.th_notification.notification_warning {border:1px solid #eee3b1; background:#f6f0d9 url(../../../images/i_warning.png) no-repeat 19px 19px; padding:20px 15px 15px 70px; margin-bottom:20px; color:#a47607; clear:both; min-height:38px;}
	
.th_notification.notification_mark_tiny { border:1px solid #e5e7d1; background:#f4f9e1 url('../../../images/i_successful_tiny.png') no-repeat 13px 11px;padding:13px 15px 12px 48px; margin-bottom:10px; min-height:15px;color:#3d3d3d;  }
.th_notification.notification_error_tiny { border:1px solid #f1d6c6; background:#fbede8 url('../../../images/i_errorn_tiny.png') no-repeat 13px 11px;padding:13px 15px 12px 48px; margin-bottom:10px; min-height:15px;color:#3d3d3d; }
.th_notification.notification_info_tiny { border:1px solid #f1e5c6; background:#ffffe0 url('../../../images/i_info_tiny.png') no-repeat 13px 11px;padding:13px 15px 12px 48px; margin-bottom:10px; min-height:15px;color:#3d3d3d; }
.th_notification.notification_warning_tiny { border:1px solid #f1e5c6; background:#ffffe0 url('../../../images/i_warning_tiny.png') no-repeat 13px 11px;padding:13px 15px 12px 48px; margin-bottom:10px; min-height:15px;color:#3d3d3d; }
	</style>
	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="notifications" action="#" >
		<div class="tabs">
			<ul>
				<li id="notifications_tab" class="current"><span><a href="javascript:mcTabs.displayTab('notifications_tab','notifications_panel');" onMouseDown="return false;"><?php _e('Notification','churchope'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Type of notification:','churchope'); ?></legend>
					<label for="notification_type"><?php _e('Choose a type:','churchope'); ?></label><br><br>
					<select name="notification_type" id="notification_type"  style="width:250px">
						<option value="" disabled selected><?php _e('Select type','churchope'); ?></option>
						<option value="notification_mark"><?php _e('Successful','churchope'); ?></option>
						<option value="notification_error"><?php _e('Error','churchope'); ?></option>
						<option value="notification_info"><?php _e('Info','churchope'); ?></option>
						<option value="notification_warning"><?php _e('Warning','churchope'); ?></option>
						<option value="notification_mark_tiny"><?php _e('Successful Tiny','churchope'); ?></option>
						<option value="notification_error_tiny"><?php _e('Error Tiny','churchope'); ?></option>
						<option value="notification_info_tiny"><?php _e('Info Tiny','churchope'); ?></option>
						<option value="notification_warning_tiny"><?php _e('Warning Tiny','churchope'); ?></option>
					</select>					
				</fieldset>
			
				<fieldset style="margin-bottom:10px;padding:10px;">
					<legend><?php _e('Preview:','churchope'); ?></legend>
					<div id="preview" style="min-height:95px"></div>
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