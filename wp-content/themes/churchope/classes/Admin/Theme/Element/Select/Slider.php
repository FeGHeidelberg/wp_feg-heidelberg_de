<?php

/**
 * Class for Select Html element
 */
class Admin_Theme_Element_Select_Slider extends Admin_Theme_Menu_Element
{
	private $taxonomy = array();

	protected $option = array(
		'type' => Admin_Theme_Menu_Element::TYPE_SELECT,
	);

	public function render()
	{
		ob_start();
		echo $this->getElementHeader();
		$cur = false;
		?>
    <select  name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
		<?php foreach ($this->getSliders() as $alias =>$title) { ?>
        <option
			<?php if ( get_option( $this->id ) == $alias)
		{
			echo ' selected="selected"';
			$cur = true;
		}
		?> value="<?php echo $alias;?>">
			<?php echo $title; ?>
        </option>
		<?php } ?>
    </select>
	<?php
		echo $this->getElementFooter();
		$html = ob_get_clean();
		return $html;
	}


	public static function getSliders()
	{
		/*slider choosing*/
		$sliderOptions = array();

		if (class_exists('UniteBaseClassRev')) {
			$slider = new RevSlider();
			$arrSliders = $slider->getArrSliders();
			foreach($arrSliders as $slider) {
				//				$sliderOptions[] = array( 'name' => $slider->getTitle(), 'value' => $slider->getAlias());
				$sliderOptions[$slider->getAlias()] = $slider->getTitle();
			}
		}
		return $sliderOptions;
	}
}
?>
