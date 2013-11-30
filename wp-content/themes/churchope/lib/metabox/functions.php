<?php

// add select_sidebar rendering function.
add_action( 'cmb_render_select_sidebar', 'render_select_sidebar', 10, 2 );

/**
 * Render select_sidebar element
 * @param array $field [name, desc, id ...]
 * @param string $current_meta_value current element value
 */
function render_select_sidebar($field, $current_meta_value )
{
	$sidebars = getSidebarsList();
	if (is_array($sidebars) && !empty($sidebars))
	{
		$html = "<select name=".$field['id']." id=".$field['id'].">";
		foreach ($sidebars as $sidebar)
		{
			if ($current_meta_value == $sidebar['value'])
			{
				$html .= "<option value=".$sidebar['value']." selected='selected'>".$sidebar['name']."</option>\n";
			}
			else
			{
				 $html .= "<option value=".$sidebar['value']." >".$sidebar['name']."</option>\n";
			}
		}
	}
	echo $html;
}

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

/**
 * Array of options with custom icon if exist.
 * @return array
 */
function getIconsList()
{
	$option_list = array();
	$default_icons = array('i_video.png','i_text.png','i_more.png','i_zoom.png','i_audio.png');
	
	$dir = get_template_directory_uri() . '/lib/metabox/images/';
	
	$option_list[] = array('value'=>'', 'name'=> 'Use global');
	
	foreach($default_icons as $icon)
	{
		$option_list[] = array('value'=>$dir . $icon, 'name'=> '<img src="'. $dir . $icon .'" style="max-width:50px;max-height:50px" alt="Post icon" /> ');
	}
	
	$custom_icons_option = get_option(SHORTNAME . Admin_Theme_Item_Galleries::CUSTOM_GALLERY_ICONS);

	if($custom_icons_option)
	{
		$custom_icons_list = unserialize($custom_icons_option);
		if(is_array($custom_icons_list) && count($custom_icons_list))
		{
			foreach($custom_icons_list as $icon)
			{
				$option_list[] = array('value'=>$icon, 'name'=> '<img src="'. $icon .'" style="max-width:50px;max-height:50px" alt="Post icon" /> ');
			}
		}
	}
	return $option_list;
}

function getSidebarsList()
{
	$sidebar_list = array();
	$sidebar_list[] = array('name'=>__('Use global sidebar','churchope'), 'value'=>'""');
	$sidebars = Sidebar_Generator::get_sidebars();
	if (is_array($sidebars) && !empty($sidebars))
	{
		foreach ($sidebars as $class=>$name)
		{
			$sidebar_list[] = array('name'=>$name, 'value'=>$class);
		}
	}
	return $sidebar_list;
}

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
	
	$meta_boxes[] = array(
		'id'         => 'page_sidebar',
		'title'      => __('Custom sidebar','churchope'),
		'pages'      => array('page'), // Page type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __('Sidebar','churchope'),
				'desc'    => __('Sidebar to display','churchope'),
				'id'      => SHORTNAME . '_page_sidebar',
				'type'    => 'select_sidebar',
            ),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'page_title',
		'title'      => __('Title area settings','churchope'),
		'pages'      => array('page','post', Custom_Posts_Type_Gallery::POST_TYPE,
								Custom_Posts_Type_Gallery::POST_TYPE,
								Custom_Posts_Type_Event::POST_TYPE), // Page type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
//			array(					
//						'name'    => 'Box content',
//						'desc'    => '',
//						'id'      => SHORTNAME . '_contact_second_cont',
//						'type'    => 'wysiwyg',
//						'std'     => '',
//					),
			array(
				'name'    => __('Title additional text','churchope'),
				'desc'    => __('Extra text on right side of title. HTML markup supported.','churchope'),
				'id'      => SHORTNAME . '_page_extratitle',
				'type'    => 'wysiwyg',
				'options' => array('tinymce' => array( 
																		'theme_advanced_buttons1' => 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,spellchecker,wp_fullscreen,wp_adv' ,
																		'theme_advanced_buttons3' =>  "highlight,notifications,buttons,social_link,social_button",
																		)),
				'std'     => '',
            ),
			array(
				'name'    => __('Under title sidebar instance','churchope'),
				'desc'    => __('Sidebar to display under title on gray line.','churchope'),
				'id'      => SHORTNAME . '_title_sidebar',
				'type'    => 'select_sidebar',
            ),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'page_header_color',
		'title'      => __('Header Color Settings'),
		'pages'      => array('page', 'post', Custom_Posts_Type_Gallery::POST_TYPE, 
												Custom_Posts_Type_Event::POST_TYPE), // Page type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __('Custom header section settings','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_custom_post_header',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Use global','churchope'), 'value' => '', ),
					array( 'name' => __('Custom Color','churchope'), 'value' => 'custom',),
				),
			),
			array(
				
				'name'    => __('Header custom color value'),
				'desc'    => __('Custom color for post elements'),
				'id'      => SHORTNAME . '_page_header_color',
				'type'    => 'colorpicker',
				'std'     => '#C62B02',
            ),
			array(
				'name'    => 'Use custom pattern image for color header section ','churchope',
				'desc'    => 'You can upload custom pattern image.',
				'id'      => SHORTNAME . '_post_menupattern',
				'type'    => 'file',				
			),
			
			array(
				'name'    => 'Custom pattern repeat for color header section',
				'desc'    => '',
				'id'      => SHORTNAME . '_post_headerpattern_repeat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Repat', 'value' => 'repeat', ),
					array( 'name' => 'No repeat', 'value' => 'no-repeat', ),
					array( 'name' => 'Repeat horizontally', 'value' => 'repeat-x', ),
					array( 'name' => 'Repeat vertically', 'value' => 'repeat-y', ),
					),
				),
		array(
				'name'    => 'Custom pattern horizontal position',
				'desc'    => '',
				'id'      => SHORTNAME . '_post_headerpattern_x',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Left', 'value' => '0', ),
					array( 'name' => 'Center', 'value' => '50%', ),
					array( 'name' => 'Right', 'value' => '100%', ),					
					),
				),
		array(
				'name'    => 'Custom pattern vertical position',
				'desc'    => '',
				'id'      => SHORTNAME . '_post_headerpattern_y',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Top', 'value' => '0', ),
					array( 'name' => 'Middle', 'value' => '50%', ),
					array( 'name' => 'Bottom', 'value' => '100%', ),					
					),
				),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'testimonial_box',
		'title'      => __('Testimonial Options','churchope'),
		'pages'      => array(Custom_Posts_Type_Testimonial::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Author','churchope'),
				'desc' => __('Testimonial Author','churchope'),
				'id'   => SHORTNAME . '_testimonial_author',
				'type' => 'text',
			),
			array(
				'name' => __('Job','churchope'),
				'desc' => __('Testimonial Author Job','churchope'),
				'id'   => SHORTNAME . '_testimonial_author_job',
				'type' => 'text',
			),
			
			
		),
	);
	
	// Custom page lightBox
	$meta_boxes[] = array(
		'id'         => 'light_box',
		'title'      => __('LightBox Options','churchope'),
		'pages'      => array(  Custom_Posts_Type_Gallery::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Use lightbox','churchope'),
				'desc' => __('Use LightBox for preview thumbnail','churchope'),
				'id'   => SHORTNAME . '_use_lightbox',
				'type' => 'checkbox',
			),
			array(
				'name' => __('URL','churchope'),
				'desc' => __('Custom URL LightBox','churchope'),
				'id'   => SHORTNAME . '_url_lightbox',
				'type' => 'text',
			),
			
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'event_date_option',
		'title'      => __('Event date','churchope'),
		'pages'      => array(Custom_Posts_Type_Event::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Event Date','churchope'),
				'desc' => __('Event will happen','churchope'),
				'id'   => SHORTNAME . Widget_Event::EVENT_DATE_META_KEY,
				'type' => 'text_date',
			),
			array(
	            'name' => __('Event Time','churchope'),
	            'desc' => __('Event start at','churchope'),
	            'id'   => SHORTNAME . Widget_Event::EVENT_TIME_META_KEY,
	            'type' => 'text_time',
	        ),
			array(
				'name' => __('Is Repeating?','churchope'),
				'desc' => __('Is this event repetition?','churchope'),
				'id'   => SHORTNAME . Widget_Event::EVENT_REPEATING_META_KEY,
				'type' => 'checkbox',
			),
			array(
				'name'    => __('Repeat every:','churchope'),
				'desc'    => __('Repetition interval','churchope'),
				'id'      => SHORTNAME . Widget_Event::EVENT_INTERVAL_META_KEY,
				'type'    => 'select',
				'options' => array(
					array( 'value' => Widget_Event::INTERVAL_DAY,	'name' => __('Every day','churchope')),
					array( 'value' => Widget_Event::INTERVAL_WEEK,	'name' => __('Every week(initial day of week)','churchope')),
					array( 'value' => Widget_Event::INTERVAL_MONTH,	'name' => __('Evert month(initial day of month)','churchope')),
					array( 'value' => Widget_Event::INTERVAL_YEAR,	'name' => __('Every year(initial day of month)','churchope')),
				),
			),
			
		),
	);
	
	
	$meta_boxes[] = array(
		'id'         => 'event_additional_option',
		'title'      => __('Event Additional Information','churchope'),
		'pages'      => array(Custom_Posts_Type_Event::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Phone','churchope'),
				'desc' => __('Contact phone','churchope'),
				'id'   => SHORTNAME . Widget_Event_Upcoming::CONTACT_PHONE,
				'type' => 'text',
			),
//			array(
//				'name' => 'Email',
//				'desc' => 'Contact Email',
//				'id'   => SHORTNAME . Widget_Event_Upcoming::CONTACT_EMAIL,
//				'type' => 'text',
//			),
			array(
				'name' => __('Address','churchope'),
				'desc' => __('Exact Address','churchope'),
				'id'   => SHORTNAME . Widget_Event_Upcoming::EVENT_ADDRESS,
				'type' => 'text',
			),
			
		),
	);
	
	//Custom page Gallery Option
	$meta_boxes[] = array(
		'id'         => 'gallery_option',
		'title'      => __('Gallery Options','churchope'),
		'pages'      => array( Custom_Posts_Type_Gallery::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __('Live URL','churchope'),
				'desc' => __('Live URL','churchope'),
				'id'   => SHORTNAME . '_gallery_url',
				'type' => 'text',
			),
			array(
				'name' => __('Live URL button text','churchope'),
				'desc' => __('Live URL button text','churchope'),
				'id'   => SHORTNAME . '_gallery_url_button',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Live URL target at new window','churchope'),
				'desc' => __('Live URL  _blank ','churchope'),
				'id'   => SHORTNAME . '_gallery_target',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Hide more','churchope'),
				'desc' => __('Hide more button from preview','churchope'),
				'id'   => SHORTNAME . '_gallery_hide_more',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Hide feature image','churchope'),
				'desc' => __('Hide feature image from single gallery post','churchope'),
				'id'   => SHORTNAME . '_gallery_hide_thumb',
				'type' => 'checkbox',
			),
			array(
				'name'    => __('Preview icon','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_gallery_icon',
				'type'    => 'radio_inline',
				'options' => getIconsList(),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'layout_type',
		'title'      => __('Layout Type','churchope'),
		'pages'      => array( 'post', Custom_Posts_Type_Gallery::POST_TYPE,
								Custom_Posts_Type_Testimonial::POST_TYPE,
								Custom_Posts_Type_Event::POST_TYPE), // Post type
		'context'    => 'side',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __('Template','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_post_layout',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Use global','churchope'), 'value' => '', ),
					array( 'name' => __('Full width','churchope'), 'value' => 'layout_none_sidebar', ),
					array( 'name' => __('Left sidebar','churchope'), 'value' => 'layout_left_sidebar', ),
					array( 'name' => __('Right sidebar','churchope'), 'value' => 'layout_right_sidebar', ),
				),
			),
			array(
				'name'    => __('Sidebar','churchope'),
				'desc'    => __('Sidebar to display','churchope'),
				'id'      => SHORTNAME . '_post_sidebar',
				'type'    => 'select_sidebar',
            ),
			
		),
	);
	
	//Slideshow 
	$meta_boxes[] = array(
		'id'         => 'slide_link',
		'title'      => __('Link current slide to','churchope'),
		'pages'      => array(  Custom_Posts_Type_Slideshow::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => __('Write your URL','churchope'),
				'desc'    => __('Future image and call to action button wil be linked to that URL.','churchope'),
				'id'      => SHORTNAME . '_sliders_link',
				'type'    => 'text'
			),	
			array(
				'name'    => __('Link whole slide','churchope'),
				'desc'    => __('This option will cover whole slide content with link. Be careful with this option and interactive content of your slide!','churchope'),
				'id'      => SHORTNAME . '_sliders_link_whole',
				'type'    => 'checkbox'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'jcycle_options',
		'title'      => __('Options for jCycle slider','churchope'),
		'pages'      => array(  Custom_Posts_Type_Slideshow::POST_TYPE), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(			
			array(
				'name'    => __('Slide layout','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_sliders_cycle_position',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Left content','churchope'), 'value' => 'right'),
					array( 'name' => __('Right content','churchope'), 'value' => 'left', ),					
					array( 'name' => __('Only image','churchope'), 'value' => 'full', ),
					array( 'name' => __('Full width content','churchope'), 'value' => 'empty'),										
				),
			),
			array(
				'name'    => __('Inner content align','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_sliders_cycle_content_align',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Left align','churchope'), 'value' => ''),
					array( 'name' => __('Right align','churchope'), 'value' => 'right', ),					
					array( 'name' => __('Center align','churchope'), 'value' => 'center', ),														
				),
			),
			array(
				'name'    => __('Hide title','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_sliders_cycle_title',
				'type'    => 'checkbox'
			),
			array(
				'name'    => __('Hide feature image frame for content','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_sliders_cycle_frame',
				'type'    => 'checkbox'
			),
			array(
				'name'    => __('Text for call to action button','churchope'),
				'desc'    => __('It will display only if this option active.','churchope'),
				'id'      => SHORTNAME . '_sliders_cycle_btntxt',
				'type'    => 'text'
			),	
			array(
				'name'    => __('Use feature image as background of slide','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_slidebg',
				'type'    => 'checkbox'
			),
			array(
				'name'    => __('Background image width','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_slidebg_width',
				'type'    => 'select',
				'options' => array(					
					array( 'name' => __('Fluid','churchope'), 'value' => '', ),
					array( 'name' => __('Fixed','churchope'), 'value' => 'fixed'),
				),
			),
			array(
				'name'    => __('Background image repeating','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_slidebg_repeat',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No repeat','churchope'), 'value' => ''),
					array( 'name' => __('Repeat','churchope'), 'value' => 'repeat', ),
					array( 'name' => __('Repeat vertically only','churchope'), 'value' => 'repeaty'),
					array( 'name' => __('Repeat horizontally only','churchope'), 'value' => 'repeatx', ),
				),
			),
			array(
				'name'    => __('Background image vertical position','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_slidebg_positiony',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Top','churchope'), 'value' => ''),
					array( 'name' => __('Middle','churchope'), 'value' => 'middle', ),
					array( 'name' => __('Bottom','churchope'), 'value' => 'bottom'),					
				),
			),
			array(
				'name'    => __('Background image horizontal position','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_slidebg_positionx',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Center','churchope'), 'value' => '', ),
					array( 'name' => __('Left','churchope'), 'value' => 'left'),					
					array( 'name' => __('Right','churchope'), 'value' => 'right'),					
				),
			),
			
		),
	);
	
	$sliderOptions = array();
	if (class_exists('UniteBaseClassRev')) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		foreach($arrSliders as $slider) {
			$sliderOptions[] = array( 'name' => $slider->getTitle(), 'value' => $slider->getAlias());
		}
	}

	$meta_boxes[] = array(
		'id'         => 'sldieshow_options',
		'title'      => __('Slideshow options','churchope'),
		'pages'      => array(  'page','post', Custom_Posts_Type_Gallery::POST_TYPE,
								Custom_Posts_Type_Testimonial::POST_TYPE,  Custom_Posts_Type_Event::POST_TYPE), // 
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(			
			array(
				'name'    => __('Select a slideshow type for current page','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_post_slider',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Use global','churchope'), 'value' => ''),
					array( 'name' => __('jCycle','churchope'), 'value' => 'jCycle', ),
					array( 'name' => __('revSlider','churchope'), 'value' => 'revSlider', ),
					array( 'name' => __('Disable','churchope'), 'value' => 'Disable', ),															
				),
				),
			array(
				'name'    => 'Choose Revolution slider',
				'desc'    => 'Choose Revolution slider',
				'id'      => SHORTNAME . Admin_Theme_Item_Slideshow::SLIDER,
				'type'    => 'select',
				'options' => $sliderOptions,
			),
			array(
				'name'    => __('Select a slider category','churchope'),
				'desc'    => '',
				'id'      => SHORTNAME . '_post_slider_cat',
				'type'    => 'taxonomy_select',
				'taxonomy' => Custom_Posts_Type_Slideshow::TAXONOMY,
				),
			array(
				'name'    => __('How many slides to display:','churchope'),
				'desc'    => __('Set a number of how many slides you want to use at current slider','churchope'),
				'id'      => SHORTNAME . '_post_slider_count',
				'type'    => 'text_small',
				'std'	  => 4,
			),	
		),
	);
	
//	$Theme_Slideshow = new Admin_Theme_Item_Slideshow();
	$meta_boxes[] = array(
		'id'         => 'slideshow_effect_options',
		'title'      => __('Slideshow effect options','churchope'),
		'pages'      => array( 'page', 'post', Custom_Posts_Type_Gallery::POST_TYPE,
								Custom_Posts_Type_Testimonial::POST_TYPE), // 
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(			
//			array( // effect
//				'name'		=> 'Select a slideshow effect',
//				'desc'		=> '',
//				'id'		=> SHORTNAME . '_post_slider_effect',
//				'type'		=> 'select',
//				'options'	=> Admin_Theme_Item_Slideshow::getMetaSlideshowEffectList(),
//				'std'		=> 'fade',
//				),

			array( // timeout
				'name'		=> __('Slideshow timeout','churchope'),
				'desc'		=> __('Milliseconds between slide transitions (0 to disable auto advance)','churchope'),
				'id'		=> SHORTNAME . '_post_slider_timeout',
				'type'		=> 'text_small',
				'std'		=> '6000',
				),
			
			array( // naviagation
				'name'		=> __('Next/Prev navigation','churchope'),
				'desc'		=> __('Check to show Next/Prev navigation for slideshow','churchope'),
				'id'		=> SHORTNAME . '_post_slider_navigation',
				'type'		=> 'checkbox',
				),
			
			array( // fixed height
				'name'		=> __('Slideshow fixed height','churchope'),
				'desc'		=> __('Set custom fixed slideshow height. Write only number of pixels!','churchope'),
				'id'		=> SHORTNAME . '_post_slider_fixedheight',
				'type'		=> 'text_small',
				'std'		=> '',
				),
				
			array( //padding
				'name'		=> __('Remove top and bottom paddings from slideshow','churchope'),
				'desc'		=> __('Check to remove top and bottom paddings from slideshow','churchope'),
				'id'		=> SHORTNAME . '_post_slider_padding',
				'type'		=> 'checkbox',
				
			),
			array( //pause
				'name'		=> __('Slideshow pause','churchope'),
				'desc'		=> __('On to Slideshow pause enable "pause on hover"','churchope'),
				'id'		=> SHORTNAME . '_post_slider_pause',
				'type'		=> 'checkbox',
				
			),

			array( //pause
				'name'		=> __('Disable autoplay','churchope'),
				'desc'		=> __('"On" to disable Slideshow autoplay','churchope'),
				'id'		=> SHORTNAME . '_post_slider_autoscroll',
				'type'		=> 'checkbox',
				
			),	
			array( // speed
				'name'		=> __('Slideshow speed','churchope'),
				'desc'		=> __('Speed of the transition(Milliseconds)','churchope'),
				'id'		=> SHORTNAME . '_post_slider_speed',
				'type'		=> 'text_small',
				'std'		=> '1000',
				),
			),	
	);
	
	
	
	


	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
?>