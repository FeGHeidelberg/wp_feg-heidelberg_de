<?php
defined('WP_ADMIN') || define('WP_ADMIN', true);
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Events Calendar','churchope'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.7.1"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
	<?php wp_print_scripts( 'jquery-ui-core' ); ?>
	<?php wp_print_scripts( 'jquery-ui-datepicker' ); ?>
	<script language="javascript" type="text/javascript">
	function init() {
		tinyMCEPopup.resizeToInnerSize();
	}
	function submitData() {				
		var shortcode;
		var category = jQuery('#event_category').val();
		var from = jQuery('#event_date_from').val();
		var to = jQuery('#event_date_to').val();
		var layout = jQuery('#layout_type').val();
		shortcode = '[event';
		if(category && category.length)
		{
			shortcode += ' category="'+category+'"';
		}
		if(from && from.length )
		{
			shortcode += ' from="'+from+'"';
		}
		if(to && to.length)
		{
			shortcode += ' to="'+to+'"';
		}
		if(layout && layout.length)
		{
			shortcode += ' layout="'+layout+'"';
		}
		shortcode +=']';
//		shortcode += ' from="'+from+'" to="'+to+'" layout="'+layout+'"]';			
			
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
		jQuery(function() {
		var dates = jQuery( "#event_date_from, #event_date_to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "event_date_from" ? "minDate" : "maxDate",
					instance = jQuery( this ).data( "datepicker" ),
					date = jQuery.datepicker.parseDate(
						instance.settings.dateFormat ||
						jQuery.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
//			jQuery('#' + jQuery(this).attr('id')).datepicker();
	});
	</script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/backend/css/admin.css'?>" />
	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="events" action="#" >
		<div class="tabs">
			<ul>
				<li id="events_tab" class="current"><span><a href="javascript:mcTabs.displayTab('events_tab','events_panel');" onMouseDown="return false;"><?php _e('Events','churchope'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Category of event:','churchope'); ?></legend>
				<label for="event_category"><?php _e('Choose a category:','churchope'); ?></label><br><br>
				<select name="event_category" id="event_category"  style="width:250px" MULTIPLE SIZE=5>
					<?php
						$terms_list = get_terms(Custom_Posts_Type_Event::TAXONOMY);
						foreach ($terms_list as $term) {
							$option = '<option value="'.$term->term_id.'">';
							$option .= $term->name;
							$option .= ' ('.$term->count.')';
							$option .= '</option>';
							echo $option;
						}
						?>
				</select>
				<br/>
				<?php _e('* if no one selected, then selected ALL','churchope'); ?>
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Date range:','churchope'); ?></legend>
				<label for="event_date_from"><?php _e('Event begin date:','churchope'); ?></label><br><br>
					<input id="event_date_from" type="text" value="" name="event_date_from" style="width:250px" ><br><br>
				<label for="event_date_to"><?php _e('Event finish date:','churchope'); ?></label><br><br>
					<input id="event_date_to" type="text" value="" name="event_date_to" style="width:250px" >					
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Type of layout:','churchope'); ?></legend>
				<label for="layout_type"><?php _e('Choose a type:','churchope'); ?></label><br><br>
				<select name="layout_type" id="layout_type"  style="width:250px">
					<option value="full"><?php _e('Full','churchope'); ?></option>
					<option value="active"><?php _e('Active','churchope'); ?></option>
				</select>					
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