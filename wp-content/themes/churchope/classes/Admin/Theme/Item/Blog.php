<?php
/**
 * 'Blog' admin menu page
 */
class Admin_Theme_Item_Blog extends Admin_Theme_Menu_Item
{
	
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Blog','churchope'));
		$this->setMenuTitle(__('Blog','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME.'_blog');
		parent::__construct($parent_slug);
		
		$this->init();
	}

	public function init()
	{
		
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Blog Settings','churchope'));
		$this->addOption($option);
		$option = null;
				
				
				
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Sidebar position for blog listing','churchope'))
				->setDescription(__('Choose a sidebar position for blog listing','churchope'))
				->setId(SHORTNAME."_post_listing_layout")
				->setStd('none')
				->setOptions(array("none", "left", "right"));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_SelectSidebar();
		$option->setName(__('Sidebar for blog listing','churchope'))
				->setDescription(__('Choose a sidebar for blog listing','churchope'))
				->setId(SHORTNAME."_post_listing_sidebar");					
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setDescription (__('Hide date from post','churchope'))
				->setName (__('Check to hide  date for post','churchope'))
				->setId (SHORTNAME."_hidedate");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setDescription (__('Hide feature images from posts listing','churchope'))
				->setName (__('Disable thumbnail for blog listing, categories, etc.','churchope'))
				->setId (SHORTNAME."_hidethumb");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setDescription (__('Disable excerpts','churchope'))
				->setName (__('Check to disable excerpts on blog listing','churchope'))
				->setId (SHORTNAME."_excerpt");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setDescription (__('Disable about author box','churchope'))
				->setName (__('Check to disable about author box on post entry','churchope'))
				->setId (SHORTNAME."_authorbox");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;

		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Sidebar position for single post','churchope'))
				->setDescription(__('Choose a sidebar position for single post','churchope'))
				->setId(SHORTNAME."_post_layout")
				->setStd('none')
				->setOptions(array("none", "left", "right"));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_SelectSidebar();
		$option->setName(__('Sidebar for single post','churchope'))
				->setDescription(__('Choose a sidebar for single post','churchope'))
				->setId(SHORTNAME."_post_sidebar");					
		$this->addOption($option);
		$option = null;		
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
	}
	
	
}
?>