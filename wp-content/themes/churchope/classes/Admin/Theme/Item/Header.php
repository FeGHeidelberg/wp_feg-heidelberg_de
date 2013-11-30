<?php
/**
 * 'Header' admin menu page
 */
class Admin_Theme_Item_Header extends Admin_Theme_Menu_Item
{
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Header','churchope'));
		$this->setMenuTitle(__('Header','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME . '_header');
		parent::__construct($parent_slug);
		
		$this->init();
	}

	public function init()
	{
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Header Settings','churchope'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_File();
		$option->setName(__('Use custom logo image','churchope'))
				->setDescription(__('You can upload custom logo image.','churchope'))
				->setId(SHORTNAME."_logo_custom")
				->setStd(get_template_directory_uri().'/images/logo.png');
		$this->addOption($option);
		$option = null;		
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Hide logo image','churchope'))
				->setDescription(__('Check this box if you want to hide logo image and use text site name instead','churchope'))
				->setId(SHORTNAME."_logo_txt")
				->setStd('');
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_File();
		$option->setName(__('Use custom pattern image for  header section','churchope'))
				->setDescription(__('You can upload custom pattern image.','churchope'))
				->setId(SHORTNAME."_headerpattern")
				->setStd(get_template_directory_uri().'/images/bg_header_pattern.png');
		$this->addOption($option);
		$option = null;	
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern repeat','churchope'))
				->setDescription(__('Custom pattern repeat settings','churchope'))
				->setId(SHORTNAME."_headerpattern_repeat")
				->setStd('repeat')
				->setOptions(array('repeat','no-repeat','repeat-x','repeat-y'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern horizontal position','churchope'))
				->setDescription(__('Custom pattern horizontal position','churchope'))
				->setId(SHORTNAME."_headerpattern_x")
				->setStd('0')
				->setOptions(array('0','50%','100%'));
		$this->addOption($option);
		$option = null;
		
				$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern vertical position','churchope'))
				->setDescription(__('Custom pattern vertical position','churchope'))
				->setId(SHORTNAME."_headerpattern_y")
				->setStd('0')
				->setOptions(array('0','50%','100%'));
		$this->addOption($option);
		$option = null;
		
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_File();
		$option->setName(__('Use custom pattern image for color header section','churchope'))
				->setDescription(__('You can upload custom pattern image.','churchope'))
				->setId(SHORTNAME."_menupattern")
				->setStd(get_template_directory_uri().'/images/menu_pattern.png');
		$this->addOption($option);
		$option = null;	
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern repeat for color header section','churchope'))
				->setDescription(__('Custom pattern repeat settings for color header','churchope'))
				->setId(SHORTNAME."_menupattern_repeat")
				->setStd('repeat')
				->setOptions(array('repeat','no-repeat','repeat-x','repeat-y'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern horizontal position  for color header','churchope'))
				->setDescription(__('Custom pattern horizontal position  for color header','churchope'))
				->setId(SHORTNAME."_menupattern_x")
				->setStd('0')
				->setOptions(array('0','50%','100%'));
		$this->addOption($option);
		$option = null;
		
				$option = new Admin_Theme_Element_Select();
		$option->setName(__('Custom pattern vertical position  for color header','churchope'))
				->setDescription(__('Custom pattern vertical position  for color header','churchope'))
				->setId(SHORTNAME."_menupattern_y")
				->setStd('0')
				->setOptions(array('0','50%','100%'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Call to action header ribbon URL','churchope'))
				->setDescription(__('Type here URL for call to action header ribbon','churchope'))
				->setId(SHORTNAME."_ribbon")
				->setStd("http://themoholics.com");
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Align menu to left','churchope'))
				->setDescription(__('Switch on to align menu to left side','churchope'))
				->setId(SHORTNAME."_menu_left")
				->setStd('');
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		
		
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Header background color','churchope'))
				->setDescription(__('Please select your custom color for header background','churchope'))
				->setId( SHORTNAME."_headerbgcolor")
				->setStd('#261c1e');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Header text color','churchope'))
				->setDescription(__('Please select your custom color for header text','churchope'))
				->setId( SHORTNAME."_headertextcolor")
				->setStd('#eeeeee');
		$this->addOption($option);
		
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Color area background color','churchope'))
				->setDescription(__('Please select your custom color for color area background','churchope'))
				->setId( SHORTNAME."_menubgcolor")
				->setStd('#c62b02');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Colorchooser();
		$option->setName(__('Color area text color','churchope'))
				->setDescription(__('Please select your custom color for color area text','churchope'))
				->setId( SHORTNAME."_menutextcolor")
				->setStd('#ffffff');
		$this->addOption($option);
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
	
	}
}
?>