<?php
/**
 * 'General' admin menu page
 */
class Admin_Theme_Item_Dummy extends Admin_Theme_Menu_Item
{
	
	
	
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Dummy content','churchope'));
		$this->setMenuTitle(__('Dummy content','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME.'_dummy');
		parent::__construct($parent_slug);
		$this->init();
	}

	public function init()
	{
		
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Dummy content install','churchope'));
		$this->addOption($option);
		$option = null;
		
		
		$option = new Admin_Theme_Element_InstallDummy();
		$this->addOption($option);				
		
	}
}
?>