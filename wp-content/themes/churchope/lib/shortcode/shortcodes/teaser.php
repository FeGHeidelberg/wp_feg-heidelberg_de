<?php
	defined('WP_ADMIN') || define('WP_ADMIN', true);
	require_once('../../../../../../wp-load.php');
	$posts = get_posts( array(  'post_type'		=> array('page', 'post', Custom_Posts_Type_Gallery::POST_TYPE),
								'post_status'	=> 'publish',
								'numberposts'	=> -1,
								'suppress_filters' => '0',
							)); 
?>	
<!doctype html>
<html lang="en">
	<head>
	<title><?php _e('Insert Teaser','churchope'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">
		var posts_data = {};
	<?php if($posts && count($posts)):?>
		<?php foreach ($posts as $post):?>
			var data = {};
			data.id = <?php echo $post->ID?>;
			data.title = '<?php echo str_replace(array("\r", "\n"), '', addslashes($post->post_title)); ?>';
			data.post_url = '<?php echo get_permalink( $post->ID ); ?>';
			
			posts_data['<?php echo $post->post_name?>'] = data;
		<?php endforeach;?>
	<?php endif;?>
	</script>
	<script language="javascript" type="text/javascript">
		
	jQuery(document).ready(function() {
		jQuery("#select_post").change(function() {
			var slug = jQuery(this).val();
			if(typeof posts_data[slug] != 'undefined')
			{
				var details = posts_data[slug];
				jQuery('#title').val(details.title);
				jQuery('#button_url').val(details.post_url);
			}
		});	
	});
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
	}
	
	
	function submitData() {				
		var shortcode;
		
		var url = jQuery('#button_url').val();
		var title = jQuery('#title').val();
		var button_title = jQuery('#button_title').val();
		var src = jQuery('#image_url').val();
		shortcode = ' [teaser';
		if(url.length)
		{
			shortcode += ' url="'+url+'" ';
		}
		
		if(title.length)
		{
			shortcode += ' title="'+title+'" ';
		}
		
		if(src.length)
		{
			shortcode += ' src="'+src+'" ';
			
		}
		else
		{
			var slug = jQuery('#select_post').val();
			if(typeof posts_data[slug] != 'undefined')
			{
				var details = posts_data[slug];
				shortcode += ' post="'+details.id+'" ';
			}
		}
		if (jQuery('#target').is(':checked')) {
			shortcode += ' target="_blank"';
		}
		
		shortcode += ']';
		if(button_title.length)
		{
			shortcode +=button_title;
		}
		shortcode += '[/teaser]';
			
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
	<form name="notifications" action="#" >
		<div class="tabs">
			<ul>
				<li id="notifications_tab" class="current"><span><a href="javascript:mcTabs.displayTab('notifications_tab','notifications_panel');" onMouseDown="return false;"><?php _e('Teaser','churchope'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend><?php _e('Post, Page, Gallery:','churchope'); ?></legend>
					<label for="select_post"><?php _e('Choose a template:','churchope'); ?></label><br><br>
					<select name="select_post" id="select_post"  style="width:250px">
						<option value="" disabled selected><?php _e('Select type','churchope'); ?></option>
						<?php 
						if($posts && count($posts))
						{
							foreach($posts as $post)
							{?>
								<option value="<?php echo esc_html($post->post_name)?>"><?php echo esc_html($post->post_title); ?></option>
							<?php }
						}
						?>
					</select>					
				</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Image src:','churchope'); ?></legend>
					<label for="image_url"><?php _e('Type your image URL here:','churchope'); ?></label><br><br>
					<input name="image_url" type="text" id="image_url" style="width:250px">
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Title:','churchope'); ?></legend>
					<label for="title"><?php _e('Type your teaser title:','churchope'); ?></label><br><br>
					<input name="title" type="text" id="title" style="width:250px">
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Button title:','churchope'); ?></legend>
					<label for="button_title"><?php _e('Type your button title here:','churchope'); ?></label><br><br>
					<input name="button_title" type="text" id="button_title" style="width:250px" value="<?php _e('learn  more...','churchope'); ?>">
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('URL for button:','churchope'); ?></legend>
					<label for="button_url"><?php _e('Type your button URL here:','churchope'); ?></label><br><br>
					<input name="button_url" type="text" id="button_url" style="width:250px" >
			</fieldset>
			<fieldset style="margin-bottom:10px;padding:10px">
				<legend><?php _e('Target Blank:','churchope'); ?></legend>
					<label for="target"><?php _e('Check if you want open in new window:','churchope'); ?></label><br><br>
					<input name="target" type="checkbox" id="target">
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