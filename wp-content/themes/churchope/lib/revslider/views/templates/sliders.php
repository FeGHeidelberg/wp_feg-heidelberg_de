<?php
	$exampleID = '"slider1"';
	if(!empty($arrSliders))
		$exampleID = '"'.$arrSliders[0]->getAlias().'"';
?>

	<div class='wrap'>

	<h2>
		Revolution Sliders
	</h2>

	<br>
	<?php if(empty($arrSliders)): ?>
		No Sliders Found
		<br>
	<?php else:
		 require self::getPathTemplate("sliders_list");	 		
	endif?>
	
	
	<br>
	<p>			
		<a class='button-primary' href='<?php echo $addNewLink?>'>Create New Slider</a>
	</p>
	 
	 <br>
	 
	
	
	<p></p>
	
	
	</div>
