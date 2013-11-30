<?php

class Admin_Theme_Item_Captcha extends Admin_Theme_Menu_Item
{
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('reCaptcha','churchope'));
		$this->setMenuTitle(__('reCaptcha','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME . '_recaptcha');
		parent::__construct($parent_slug);
		$this->init();
	}

	public function init()
	{
		
		
		$option = null;
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('reCaptcha <a href=\''.$this->getCaptchaURL().'\' title=\'Get your reCAPTCHA API Keys\'  target=\'_blank\'>Keys</a>','churchope'));
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Info();
		$option->setName(__('Learn more about reCaptcha <a href=\'//www.google.com/recaptcha/learnmore\' title=\'What is reCAPTCHA?\'  target=\'_blank\'>here</a>','churchope'));
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Public Key','churchope'))
				->setDescription(__('These keys are required for using in reCaptcha.','churchope'))
				->setId(SHORTNAME."_captcha_public_key")
				->setStd("");
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Private Key','churchope'))
				->setDescription(__('These keys are required for using in reCaptcha.','churchope'))
				->setId(SHORTNAME."_captcha_private_key")
				->setStd("");
		$this->addOption($option);
	}
	
	private function getCaptchaURL()
	{
		$url = str_replace(array('http://', 'https://'), '',  get_bloginfo('url'));
		return 'https://www.google.com/recaptcha/admin/create?domains='.  $url.'&amp;app=wordpress';
	}
}
?>
