<?php

class Admin_Theme_Item_Twitter extends Admin_Theme_Menu_Item {

	public function __construct($parent_slug = '')
	{
		$this->setPageTitle(__('Authenticating for Twitter', 'churchope'));
		$this->setMenuTitle(__('Twitter OAuth', 'churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME . '_twitter');
		parent::__construct($parent_slug);
		$this->init();
	}
	public function init()
	{
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Authenticating a User Timeline for Twitter OAuth API V1.1', 'churchope'));
		$this->addOption($option);
		$option = null;


		$option = new Admin_Theme_Element_Info();
		$option->setName(__('Enter a valid Twitter OAuth settings here to get started.','churchope'));
		$this->addOption($option);


		$option = new Admin_Theme_Element_Info();
		$option->setName(__('Don\'t know where to get? please visit this link, <a href="http://www.webdevdoor.com/php/authenticating-twitter-feed-timeline-oauth/" target="_blank">Authenticating for Twitter </a>','churchope'));
		$this->addOption($option);

		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Consumer key', 'churchope'))
				->setDescription(__('Consumer key', 'churchope'))
				->setId(SHORTNAME . '_consumer_key')
				->setStd('');
		$this->addOption($option);

		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Consumer secret', 'churchope'))
				->setDescription(__('Consumer secret', 'churchope'))
				->setId(SHORTNAME . '_consumer_secret')
				->setStd('');
		$this->addOption($option);

		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Access token', 'churchope'))
				->setDescription(__('Access token', 'churchope'))
				->setId(SHORTNAME . '_access_token')
				->setStd('');
		$this->addOption($option);

		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Access token secret', 'churchope'))
				->setDescription(__('Access token secret', 'churchope'))
				->setId(SHORTNAME . '_access_token_secret')
				->setStd('');
		$this->addOption($option);
		
	}
}
?>
