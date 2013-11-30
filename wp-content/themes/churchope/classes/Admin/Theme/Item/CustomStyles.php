<?php
/**
 * 'Custom Styles' admin menu page
 */
class Admin_Theme_Item_CustomStyles extends Admin_Theme_Menu_Item
{
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Custom Styles','churchope'));
		$this->setMenuTitle(__('Custom Styles','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME.'_customstyles');
		parent::__construct($parent_slug);
		
		$this->init();
	}

	public function init()
	{
		$option = null;
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Custom Styles','churchope'));
		$this->addOption($option);
		
		$option = null;
		
				
		$option = new Admin_Theme_Element_Textarea();
		$option->setName(__('Custom CSS rules','churchope'))
				->setDescription(__('Type custom CSS rules at this box.','churchope'))
				->setId(SHORTNAME."_customcss")
				->setStd('');
		$this->addOption($option);
		$option = null;		
	}
}
?>