<?php
/**
 * 'Header' admin menu page
 */
class Admin_Theme_Item_Events extends Admin_Theme_Menu_Item
{
	public function __construct($parent_slug = '')
	{
		
		$this->setPageTitle(__('Events','churchope'));
		$this->setMenuTitle(__('Events','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME . '_events');
		parent::__construct($parent_slug);
		
		$this->init();
	}

	public function init()
	{
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Events Settings','churchope'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Sidebar position for events listing','churchope'))
				->setDescription(__('Choose a sidebar position for events listing','churchope'))
				->setId(SHORTNAME."_events_listing_layout")
				->setStd('none')
				->setOptions(array("none", "left", "right"));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_SelectSidebar();
		$option->setName(__('Sidebar for events listing','churchope'))
				->setDescription(__('Choose a sidebar for events listing','churchope'))
				->setId(SHORTNAME."_events_listing_sidebar");					
		$this->addOption($option);
		$option = null;
		
				
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;

		$option = new Admin_Theme_Element_Select();
		$option->setName(__('Sidebar position for single events','churchope'))
				->setDescription(__('Choose a sidebar position for single event','churchope'))
				->setId(SHORTNAME."_events_layout")
				->setStd('none')
				->setOptions(array("none", "left", "right"));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_SelectSidebar();
		$option->setName(__('Sidebar for single events','churchope'))
				->setDescription(__('Choose a sidebar for single event','churchope'))
				->setId(SHORTNAME."_events_sidebar");					
		$this->addOption($option);
		$option = null;		
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Map types','churchope'))
				->setDescription(__('Allow your readers to change the map type (street, satellite, or hybrid)','churchope'))
				->setId(SHORTNAME."_maps_types_switch")
				->setStd('true');
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Scroll wheel zoom','churchope'))
				->setDescription(__('Enable zoom with the mouse scroll wheel','churchope'))
				->setId(SHORTNAME."_maps_weel_zoom")
				->setStd('');
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
		$option->setName(__('Tooltips','churchope'))
				->setDescription(htmlentities(__('Show marker titles as a "tooltip" on mouse-over','churchope')))
				->setId(SHORTNAME."_maps_tooltips")
				->setStd('true');
		$this->addOption($option);
		$option = null;
		
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('<a href="http://code.google.com/apis/maps/faq.html#languagesupport" target="_blank">Language</a>	','churchope'))
				->setDescription(__('Use a specific for map controls (defaults to browser language). Read Google Maps API doc.','churchope'))
				->setId(SHORTNAME."_maps_language");	
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Separator();
		$this->addOption($option);
		$option = null;
		
		$custom_page = new Custom_Posts_Type_Event();
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Event Post slug','churchope'))
				->setDescription(__('Some description','churchope'))
				->setId($custom_page->getPostSlugOptionName())
				->setStd($custom_page->getDefaultPostSlug());
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Event Tax slug','churchope'))
				->setDescription(__('Some description','churchope'))
				->setId($custom_page->getTaxSlugOptionName())
				->setStd($custom_page->getDefaultTaxSlug());
		$this->addOption($option);
	}
	
	/**
	 * Save form and set option-flag for reinit rewrite rules on init
	 */
	public function saveForm()
	{
		parent::saveForm();
		$this->setNeedReinitRulesFlag();
	}
	
	/**
	 * Reset form and set option-flag for reinit rewrite rules on init
	 */
	public function resetForm()
	{
		parent::resetForm();
		$this->setNeedReinitRulesFlag();
	}
	
	/**
	 * save to DB flag of need do flush_rewrite_rules on next init
	 */
	private function setNeedReinitRulesFlag()
	{
		update_option(SHORTNAME.'_need_flush_rewrite_rules', '1');
	}
}
?>