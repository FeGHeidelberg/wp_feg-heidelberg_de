<?php
	$emailto = '';
	$messages = '';
	
	if(!empty($_POST))
	{
		$headers = "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\r\n";
		
		if(isset($_POST['subject']))
		{
			$subject = stripslashes($_POST['subject']);
		}
		else
		{
			$subject = stripslashes("[".get_bloginfo('name')."]");
		}
		
		if(isset($_POST['to']))
		{
			$emailto = trim($_POST['to']);	
		}
		else
		{
			$emailto = get_option('admin_email');
		}
		
		if(isset($_POST['th-email-from']))
		{
			$from = trim($_POST['th-email-from']);
			
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" ;
		}
		
		
		foreach ($_POST as $field => $text)
		{
			if(!in_array($field, array('to', 'subject', 'th-email-from')))
			{
				if($field != 'action' && $text != 'send_contact_form')
				{
					$messages .= "<br><strong>{$field}</strong> : {$text}";
				}
			}
		}
		
		if($emailto)
		{
			$mail = wp_mail($emailto, $subject, stripslashes($messages), $headers);
			if($mail) {
				echo 'success';
			}
		}
	}
?>