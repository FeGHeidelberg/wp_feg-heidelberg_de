<?php
class Widget_Twitter extends Widget_Default implements Widget_Interface_Cache
{
	const TWITTER_TRANSIENT = 'sdf_2L4d';
	
	const TWITTER_LONG_TRANSIENT = 'long_sdf_2L4d';
	
	/**
	 * expiration for long-term cache
	 */
	const EXPIRATION_TWO_DAYS = 172800;
	
	function __construct()
	{
		$this->setClassName('widget_twitter');
		$this->setName(__('Twitter','churchope'));
		$this->setDescription(__('Show latest tweets','churchope'));
		$this->setIdSuffix('twitter');
		parent::__construct();
	}

	function widget($args, $instance)
	{
		$aMessage = '';
		
		extract($args);
		$title = esc_attr($instance['title']);
		$username = $instance['username'];
		$num = $instance['num'];
		$update = $instance['update'];
		$extractLinks = $instance['hyperlinks'];
		$extractUsers = $instance['twitter_users'];
		$encode = $instance['encode_utf8'];
		$target_blank	= isset($instance['target_blank'])?$instance['target_blank']:false;

		if (empty($username))
		{
			return false;
		}

		if($this->isCurlExist())
		{
			$aMessage = $this->getTwitterFeedItems($instance);
		}

		if ($aMessage == "Error" || !$this->isCurlExist())
		{
			$content = '<p class="notice">' . __('Can\'t connect to twitter.', 'churchope') . '</p>';
		}
		else
		{
			if (empty($aMessage))
			{
				$content = '<p class="notice">' . __('There are no public messages.', 'churchope') . '</p>';
			}
			else
			{
				$content = $this->generateMessageOutput($aMessage, $update, $username);
			}
		}


		echo $before_widget;

		if ($title)
		{
			echo $before_title . $title . $after_title;
		}
		echo $content;

		echo $after_widget;
	}
	
	/**
	 * Get cached data,
	 * if not exist try get it
	 * 
	 * @param array $instance widget data
	 * @return mixed
	 */
	private function getTwitterFeedItems($instance)
	{
		if($this->isShortCacheValid())
		{
			$this->updateLongTermCache();
		}
		else
		{
			$this->reinitWidgetCache($instance);
			if( $this->isShortCacheValid() )
			{
				$this->updateLongTermCache();
			}
		}
		
		return $this->getLongTermCacheData();
	}
	
	
	
	private function isShortCacheValid()
	{
		return $this->isValidCache($this->getCachedWidgetData());
	}
	
//	private function isLongCacheValid()
//	{
//		return $this->isValidCache($this->getLongTermCacheData());
//	}
	
	private function isValidCache ($feeds)
	{
		return !(false == $feeds || 'Error' == $feeds || empty($feeds));
	}
	
	public function reinitWidgetCache($instance)
	{
		$username		= $instance['username'];
		$num			= $instance['num'];
		$extractLinks	= $instance['hyperlinks'];
		$extractUsers	= $instance['twitter_users'];
		$encode			= $instance['encode_utf8'];
		$target			= (isset($instance['target_blank'])) ? $instance['target_blank'] : false;
		$oFeed = new Widget_Twitter_Feed();
		$feedsItems = $oFeed->getFeedItems($username, $num, $encode, $extractLinks, $extractUsers, $target);
		
		set_site_transient($this->getTransientId(), $feedsItems, $this->getExparationTime());
	}
	
	/**
	 * Cached twitter feed items
	 * @return false|array 
	 */
	function getCachedWidgetData()
	{
		return  get_site_transient($this->getTransientId());
	}
	
	function getTransientId()
	{
		return $this->get_field_id( self::TWITTER_TRANSIENT );
	}
	
	/**
	 * Transient Id for long cache
	 * @return string
	 */
	private function getLongTermCacheTransientId() {
		return $this->get_field_id( self::TWITTER_LONG_TRANSIENT );
	}
	
	/**
	 * Update Long-term cache bu valid-short cache
	 */
	private function updateLongTermCache() {
		$this->setLongTermCache();
	}
	
	/**
	 * Set transient longe-term cashe
	 */
	private function setLongTermCache()
	{
		set_site_transient($this->getLongTermCacheTransientId(), $this->getCachedWidgetData(), $this->getLongExparationTime());
	}
	
	/**
	 * get long-term cache data
	 * @return array
	 */
	private function getLongTermCacheData() {
		return  get_site_transient($this->getLongTermCacheTransientId());
	}

	protected function generateMessageOutput($aMessage, $update = true,  $username)
	{

		$output = '<ul class="tweet_list">';

		foreach ($aMessage as $item)
		{
			$content = $item['description'];
			$link = $item['link'];

			$output .= sprintf(
					'<li class="twitter-item">%s%s</li>', $content, $update ? sprintf('<a href="%s" class="twitter-date">%s</a>', $link, $item['date-posted']) : ''
			);
		}
		$output .= '</ul>';
		
		return $output;
	}

	function update($new_instance, $old_instance)
	{
		$this->deleteWidgetCache();
		$instance = $old_instance;
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['username']	= strip_tags($new_instance['username']);
		$instance['num']		= strip_tags($new_instance['num']);
		$instance['update']		= strip_tags($new_instance['update']);
		$instance['linked']		= strip_tags($new_instance['linked']);
		$instance['hyperlinks'] = strip_tags($new_instance['hyperlinks']);
		$instance['twitter_users'] = strip_tags($new_instance['twitter_users']);
		$instance['encode_utf8'] = strip_tags($new_instance['encode_utf8']);
		$instance['target_blank'] = strip_tags($new_instance['target_blank']);
		
		return $instance;
	}

	function form($instance)
	{
		/**
		 * if twetter oAuth details not provided
		 */
		if($this->notCompletedAuthList())
		{
			global $blog_id;
			$notice = '<p>';
			$notice .= __('You\'ll need to set up Twitter Feed Authenticate options before using it. ', 'churchope') . __('You can make your changes', 'churchope') . ' <a href="' . get_admin_url($blog_id) . 'admin.php?page='.SHORTNAME.'_twitter">' . __('here', 'churchope') . '.</a>';
			$notice .= '</p>';
			echo $notice;
			return;
		}

		if(!$this->isCurlExist()) {
			$notice = '<p>'. __('cURL extension requred.', 'churchope').'</p>';
			$notice .= '<p>'. __('Please contact your System Administrator.', 'churchope').'</p>';
			echo $notice;
			return;
		}
		
		// Defaults
		$defaults = array('title' => __('Twitter', 'churchope'), 'username' => 'themoholics', 'num' => '3',  'update' => '1', 'linked' => '1', 'hyperlinks' => '1', 'twitter_users' => '1', 'encode_utf8' => '1', 'target_blank'=>'',);
		$instance = wp_parse_args((array) $instance, $defaults);

		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = esc_attr($instance['num']);
		$update = esc_attr($instance['update']);
		$linked = esc_attr($instance['linked']);
		$hyperlinks = esc_attr($instance['hyperlinks']);
		$twitter_users = esc_attr($instance['twitter_users']);
		$encode = esc_attr($instance['encode_utf8']);
		$target_blank = esc_attr($instance['target_blank']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'churchope'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter username:', 'churchope'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of tweets:', 'churchope'); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $number; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('update'); ?>"><?php _e('Show date posted:', 'churchope'); ?>
				<input id="<?php echo $this->get_field_id('update'); ?>" name="<?php echo $this->get_field_name('update'); ?>" type="checkbox" <?php echo $update ? 'checked="checked"' : ''; ?> />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('hyperlinks'); ?>"><?php _e('Discover hyperlinks:', 'churchope'); ?>
				<input id="<?php echo $this->get_field_id('hyperlinks'); ?>" name="<?php echo $this->get_field_name('hyperlinks'); ?>" type="checkbox" <?php echo $hyperlinks ? 'checked="checked"' : ''; ?> />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_users'); ?>"><?php _e('Discover @replies:', 'churchope'); ?>
				<input id="<?php echo $this->get_field_id('twitter_users'); ?>" name="<?php echo $this->get_field_name('twitter_users'); ?>" type="checkbox" <?php echo $twitter_users ? 'checked="checked"' : ''; ?> />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('encode_utf8'); ?>"><?php _e('UTF8 Encode:', 'churchope'); ?>
				<input id="<?php echo $this->get_field_id('encode_utf8'); ?>" name="<?php echo $this->get_field_name('encode_utf8'); ?>" type="checkbox" <?php echo $encode ? 'checked="checked"' : ''; ?> />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('target_blank'); ?>"><?php _e('Open in new tab:', 'churchope'); ?>
				<input id="<?php echo $this->get_field_id('target_blank'); ?>" name="<?php echo $this->get_field_name('target_blank'); ?>" type="checkbox" <?php echo $target_blank ? 'checked="checked"' : ''; ?> />
			</label>
		</p>
		<?php
	}
	
	function getExparationTime()
	{
		return self::EXPIRATION_HALF_HOUR;
	}
	
	/**
	 * 
	 * @return int
	 */
	private function getLongExparationTime() {
		return self::EXPIRATION_TWO_DAYS;
	}
	
	/**
	 * Remove short-term and long-term cache
	 */
	function deleteWidgetCache()
	{
		$this->deleteLongTermCache();
		$this->deleteShortTermCache();
	}
	
	/**
	 * Delete long-term cache
	 */
	private function deleteLongTermCache()
	{
		delete_site_transient($this->getLongTermCacheTransientId()); // clear cache
	}
	
	/**
	 * Delete short-term cache
	 */
	private function deleteShortTermCache()
	{
		delete_site_transient($this->getTransientId()); // clear cache
	}

	/**
	 * Check is all required twitter oauth field are present
	 * @return boolean
	 */
	private function notCompletedAuthList() {
		return !(get_option(SHORTNAME . '_consumer_key') && get_option(SHORTNAME . '_consumer_secret') && get_option(SHORTNAME . '_access_token') && get_option(SHORTNAME . '_access_token_secret'));
	}

	private function isCurlExist() {
		return function_exists('curl_version');
	}
}
?>