<?php

class Custom_MetaBox_Item_Event extends Custom_MetaBox_Item_Default
{
	
	function __construct($taxonomy)
	{
		parent::__construct($taxonomy);
		$this->setId('etax_meta_box')
			->setTitle('Event Taxonomy Meta Box');
		
		$this->addFields();
	}
	
	protected function addFields()
	{
		parent::addFields();
		
		$this->getMetaTaxInstance()->addSelect( SHORTNAME . '_post_listing_layout', array('' => 'Use global', 'layout_none_sidebar' => 'Full width','layout_left_sidebar' => 'Left sidebar', 'layout_right_sidebar' => 'Right sidebar'), array('name' => 'Template', 'std' => ''));
		$this->getMetaTaxInstance()->addSelect( SHORTNAME . '_post_listing_sidebar', $this->getSidebars(), array('name' => 'Sidebar', 'std' => ''));
		$this->getMetaTaxInstance()->addText( SHORTNAME . '_post_listing_number', array('name' => 'Items per page'));

		$this->getMetaTaxInstance()->addSelect(		SHORTNAME . '_custom_term_header',			array('enable_page_header_color'=>'Use custom settings',''=>'Use global'), array('name' => 'Custom category header settings', 'std' => ''));
		$this->getMetaTaxInstance()->addColor(		SHORTNAME . '_term_header_color',			array('name' => 'Choose custom page header color for category:'));
		$this->getMetaTaxInstance()->addFile(		SHORTNAME . '_term_menupattern',			array('name' => 'Choose custom pattern image for color header section for category', 'addmore'=>false));
		$this->getMetaTaxInstance()->addSelect(		SHORTNAME . '_term_headerpattern_repeat',	array('repeat'=> 'Repat','no-repeat'=> 'No repeat','repeat-x'=> 'Repeat horizontally','repeat-y'=> 'Repeat vertically'), array('name' => 'Custom pattern repeat for color header section', 'std' => 'repeat', 'desc'=>''));
		$this->getMetaTaxInstance()->addSelect(		SHORTNAME . '_term_headerpattern_x',		array('0' => 'Left', '50%' => 'Center', '100%' => 'Right'), array('name' => 'Custom pattern horizontal position', 'std' => '0', 'desc'=>''));
		$this->getMetaTaxInstance()->addSelect(		SHORTNAME . '_term_headerpattern_y',		array('0' => 'Top', '50%' => 'Middle', '100%' => 'Bottom'), array('name' => 'Custom pattern vertical position', 'std' => '0', 'desc'=>''));
	}
}
?>
