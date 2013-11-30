<?php
/**
 * 'Footer' admin menu page
 */
class Admin_Theme_Item_Footer extends Admin_Theme_Menu_Item
{
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Footer','churchope'));
		$this->setMenuTitle(__('Footer','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME.'_footer');
		parent::__construct($parent_slug);
		
		$this->init();
	}

	public function init()
	{
		$option = null;
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Footer Settings','churchope'));
		$this->addOption($option);
		
		$option = null;
		
				
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Enable footer widget area','churchope'))
				->setDescription(__('Check this box if you want to enable footer widgets area for whole site.','churchope'))
				->setId(SHORTNAME."_footer_widgets_enable")
				->setStd('true');
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Columns number for footer widgets area','churchope'))
				->setDescription(__('Select how many columns(sidebars) you want display for footer widgets area.','churchope'))
				->setId(SHORTNAME."_footer_widgets_columns")
				->setStd('4')
				->setOptions(array('1','2','3', '4'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Footer text','churchope'))
				->setDescription(__('Type here text that appear at botttom of each page - copyrights, etc..','churchope'))
				->setId(SHORTNAME."_copyright")
				->setStd("Churchope 2012 &copy; <a href='http://themoholics.com'>Premium WordPress Themes</a> by Themoholics");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Textarea();
		$option->setName(__('Google Analytics','churchope'))
				->setDescription(__('Insert your Google Analytics (or other) code here.','churchope'))
				->setId(SHORTNAME."_GA")
				->setStd("");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$option->setType(Admin_Theme_Menu_Element::TYPE_SEPARATOR);
		$this->addOption($option);
		$option = null;	
		
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer background color','churchope'))
				->setDescription(__('Please select your custom color for footer background','churchope'))
				->setId( SHORTNAME."_footerbgcolor")
				->setStd('#fafafa');
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer headings color','churchope'))
				->setDescription(__('Please select your custom color for footer headings','churchope'))
				->setId( SHORTNAME."_footerheadingscolor")
				->setStd('#545454');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer text color','churchope'))
				->setDescription(__('Please select your custom color for footer text','churchope'))
				->setId( SHORTNAME."_footertextcolor")
				->setStd('#919191');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer links color','churchope'))
				->setDescription(__('Please select your custom color for footer links','churchope'))
				->setId( SHORTNAME."_footerlinkscolor")
				->setStd('#c62b02');
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer copyright text color','churchope'))
				->setDescription(__('Please select your custom color for footer copyright text','churchope'))
				->setId( SHORTNAME."_footercopyrightcolor")
				->setStd('#afafaf');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Footer active menu item text color','churchope'))
				->setDescription(__('Please select your custom color for footer active menu item text','churchope'))
				->setId( SHORTNAME."_footeractivemenucolor")
				->setStd('#656565');
		$this->addOption($option);		
	
	}
}
?>