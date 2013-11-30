<?php
/**
 *  Contact form widget
 */
class Widget_ContactForm extends Widget_Default {

	function __construct()
	{
		$this->setClassName('widget_contactform');
		$this->setName(__('Contact form','churchope'));
		$this->setDescription(__('Contact form widget','churchope'));
		$this->setIdSuffix('contactform');
		parent::__construct();
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );			
		
		$to = (isset($instance['recipient'])
						&& !empty($instance['recipient'])
						&& filter_var($instance['recipient'], FILTER_VALIDATE_EMAIL))
					? $instance['recipient']
					: get_bloginfo('admin_email');

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		
		global $wid;
		$wid = $args['widget_id'];
		global $am_validate; $am_validate = true;
		
		?>
        
          
					<form class="contactformWidget" method="post" action="#contactformWidget">
					
							
							<div>
								
								<input name="name" class="name" type="text" placeholder="<?php _e('Name','churchope'); ?>" />
							</div>
							<div>								
								<input  name="email" class="email" type="text" id="email_from" placeholder="<?php _e('E-Mail','churchope'); ?>" />
							</div>
							<div>
								<textarea  name="comments"  rows="5" cols="20" placeholder="<?php _e('Type your message here','churchope'); ?>"></textarea>
							</div>
							<div>
                            	<button type="submit"><?php _e('Send message','churchope'); ?></button>								
                            </div>
							<input type="hidden" name="to" value="<?php echo $to;?>">
							<input type='hidden' class='th-email-from' name='th-email-from' value='email_from'>
							
					</form>
                    <script type="text/javascript">
					jQuery(document).ready(function() {
                    jQuery("#<?php global $wid; echo $wid; ?> .contactformWidget").validate({
						submitHandler: function(form) {	
							jQuery("#<?php global $wid; echo $wid; ?> .contactformWidget button").attr('disabled', 'disabled');		
							ajaxContact(form);
							return false;
						},
						 rules: {
								comments: "required",
								email: "required email",
								name: "required"
						},
						 messages: {
							name: "<?php _e('Please specify your name.','churchope'); ?>",
							comments: "<?php _e('Please enter your message.','churchope'); ?>",
							email: {
								required: "<?php _e('We need your email address to contact you.','churchope'); ?>",
								email: "<?php _e('Your email address must be in the format of name@domain.com','churchope'); ?>"
							}
					 }
					});
					});
                    </script>
                    
                    
                    <?php		
		echo $after_widget;
		
		wp_enqueue_script('validate');
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['recipient'] = strip_tags( $new_instance['recipient'] );
		return $instance;
	}


	function form( $instance ) {

		// Defaults
		$defaults = array( 'title' => __( 'Contact us', 'churchope' ),
						   'recipient' => get_bloginfo('admin_email'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'churchope' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'recipient' ); ?>"><?php _e( 'Recipient email:', 'churchope' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'recipient' ); ?>" name="<?php echo $this->get_field_name( 'recipient' ); ?>" type="text" value="<?php echo $instance['recipient']; ?>" style="width:100%;" />
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}
?>