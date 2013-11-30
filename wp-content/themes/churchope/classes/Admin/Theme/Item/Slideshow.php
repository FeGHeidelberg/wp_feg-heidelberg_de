<?php
/**
 * 'Footer' admin menu page
 */
class Admin_Theme_Item_Slideshow extends Admin_Theme_Menu_Item
{
	const CATEGORY	= '_global_slider_cat';
	const COUNT		= '_global_slider_count';
	const TYPE		= '_global_slider';
	const SLIDER    = '_global_slider_alias';
	
	const EFFECT			= '_global_slider_fx';
	const TIMEOUT			= '_global_slider_timeout';
	const SPEED				= '_global_slider_speed';
	const NAVIGATION		= '_global_slider_navigation';
	const FIXEDHEIGHT		= '_global_slider_fixedheight';
	const PADDING			= '_global_slider_padding';
	const AUTOSCROLL		= '_global_slider_autoscroll';
	const PAUSE				= '_global_slider_pause';

	
	public static $effects_list = array('fade', 'blindX', 'blindY', 'blindZ', 'cover', 'curtainX', 'curtainY',
					'fadeZoom', 'growX', 'growY', 'none', 'scrollUp',
					'scrollDown', 'scrollLeft', 'scrollRight', 'scrollHorz', 'scrollVert',
					'shuffle', 'slideX', 'slideY', 'toss', 'turnUp', 'turnDown', 'turnLeft',
					'turnRight', 'uncover', 'wipe', 'zoom');

	
	public function __construct($parent_slug = '')
	{
		$this->setPageTitle(__('Slideshows','churchope'));
		$this->setMenuTitle(__('Slideshows','churchope'));
		$this->setCapability('administrator');
		$this->setMenuSlug(SHORTNAME.'_slideshows');
		parent::__construct($parent_slug);
		$this->init();
		
	}

	public function init()
	{
		$option = null;
		$option = new Admin_Theme_Element_Pagetitle();
		$option->setName(__('Slideshow Settings','churchope'));
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Select();
			$option->setName(__('Select a global slideshow type','churchope'))
					->setDescription(__('Select a global slideshow type ','churchope'))
					->setId(SHORTNAME.self::TYPE)
					->setStd('Disable')
					->setOptions(array('Disable','jCycle','revSlider'));
			$this->addOption($option);
			$option = null;

		$option = new Admin_Theme_Element_Select_Slider();
			$option->setName('Select one of Revolution sliders')
					->setDescription('Select a global Revolution slider')
					->setId(SHORTNAME.self::SLIDER);
			$this->addOption($option);
			$option = null;
		
		$option = new Admin_Theme_Element_Select_Taxonomy();
			$option->setName(__('Select a slideshow category','churchope'))
					->setDescription(__('Select a slideshow category','churchope'))
					->setId(SHORTNAME.self::CATEGORY)
					->setStd('')
					->setTaxonomy(Custom_Posts_Type_Slideshow::TAXONOMY);
			$this->addOption($option);
			$option = null;
		
		$option = new Admin_Theme_Element_Text();
			$option->setName(__('How many slides to display','churchope'))
					->setDescription(__('Set a number of how many slides you want to use at current slider','churchope'))
					->setId(SHORTNAME.self::COUNT)
					->setStd(4);
			$this->addOption($option);
			$option = null;
		
		
		$option = new Admin_Theme_Element_Separator();
			$this->addOption($option);
			$option = null;
		
//		$option = new Admin_Theme_Element_Select();
//			$option->setName('Select a slideshow effect')
//					->setDescription('Select a slideshow effect')
//					->setId(SHORTNAME.self::EFFECT)
//					->setStd('fade')
//					->setOptions($this->getSlideshowEffectList());
//			$this->addOption($option);
//			$option = null;
			
		$option = new Admin_Theme_Element_Text();
			$option->setName(__('Slideshow timeout','churchope'))
					->setDescription(__('Milliseconds between slide transitions (0 to disable auto advance)','churchope'))
					->setId(SHORTNAME.self::TIMEOUT)
					->setStd(6000);
			$this->addOption($option);
			$option = null;
		
		$option = new Admin_Theme_Element_Text();
			$option->setName(__('Slideshow speed','churchope'))
					->setDescription(__('Speed of the transition(Milliseconds)','churchope'))
					->setId(SHORTNAME.self::SPEED)
					->setStd(1000);
			$this->addOption($option);
			$option = null;
			
		$option = new Admin_Theme_Element_Checkbox();
			$option->setName(__('Next/Prev navigation','churchope'))
					->setDescription(__('Check to show Next/Prev navigation for slideshow','churchope'))
					->setId(SHORTNAME.self::NAVIGATION)
					->setStd('');
			$this->addOption($option);
			$option = null;
			
		$option = new Admin_Theme_Element_Text();
			$option->setName(__('Slideshow fixed height','churchope'))
					->setDescription(__('Set custom fixed slideshow height. Write only number of pixels!','churchope'))
					->setId(SHORTNAME.self::FIXEDHEIGHT)
					->setStd('');
			$this->addOption($option);
			$option = null;
			
		$option = new Admin_Theme_Element_Checkbox();
			$option->setName(__('Remove top and bottom paddings from slideshow','churchope'))
					->setDescription(__('Check to remove top and bottom paddings from slideshow','churchope'))
					->setId(SHORTNAME.self::PADDING)
					->setStd('');
			$this->addOption($option);
			$option = null;
			
			
		$option = new Admin_Theme_Element_Checkbox();
			$option->setName(__('Slideshow pause','churchope'))
					->setDescription(__('"On" to pause enable "pause on hover"','churchope'))
					->setId(SHORTNAME.self::PAUSE)
					->setStd('');
			$this->addOption($option);
			$option = null;
		
		$option = new Admin_Theme_Element_Checkbox();
			$option->setName(__('Disable autoplay','churchope'))
					->setDescription(__('"On" to disable Slideshow autoplay','churchope'))
					->setId(SHORTNAME.self::AUTOSCROLL)
					->setStd('');
			$this->addOption($option);
			$option = null;
			
		$option = new Admin_Theme_Element_Separator();
			$this->addOption($option);
			$option = null;
			
		$custom_page = new Custom_Posts_Type_Slideshow();
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Slideshow Post slug','churchope'))
				->setDescription(__('Some description','churchope'))
				->setId($custom_page->getPostSlugOptionName())
				->setStd($custom_page->getDefaultPostSlug());
		$this->addOption($option);
		$option = null;
		
		$option = new Admin_Theme_Element_Text();
		$option->setName(__('Slideshow Tax slug','churchope'))
				->setDescription(__('Some description','churchope'))
				->setId($custom_page->getTaxSlugOptionName())
				->setStd($custom_page->getDefaultTaxSlug());
		$this->addOption($option);
		
	}
	
	private function getSlideshowEffectList()
	{
		return self::$effects_list;
	}
	
	/**
	 * Static function for getting jCycle effect list in format arrya('effect name'=>'value', .....)
	 * @return type
	 */
	public static function getMetaSlideshowEffectList()
	{
		$meta_list = array();

		foreach (self::$effects_list as $effect )
		{
			$meta_list[]  = array('name' => $effect, 'value' => $effect);
		}
		return $meta_list;
	}
	
	/**
	 * List of slideshow effects for Custom_MetaBox_Item_Default<br/>
	 * in format array('effect1 name'=>'value', 'effect2'=>'value')
	 * @return type
	 */
	public static function getTaxonomySlideshowEffectList()
	{
		$meta_list = array();

		foreach (self::$effects_list as $effect )
		{
			$meta_list[$effect]  = $effect;
		}
		return $meta_list;
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