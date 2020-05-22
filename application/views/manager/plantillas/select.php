<?php
//echo $selected;
//var_dump($elementos); die();

	$value = isset($value) ? $value : 'value';
	$option = isset($option) ? $option : 'option';
	$selected = isset($selected) ? $selected : '';

	if(count($elementos)> 0 ){
		echo '<option value="">-SELECCIONAR-</option>';
		foreach ($elementos as $elemento):

			if($selected == $elemento[$value]){
			?>
				<option  selected value="<?php echo $elemento[$value]; ?>"><?php echo $elemento[$option]; ?></option>
			<?php 
			}else{
			?>
				<option value="<?php echo $elemento[$value]; ?>"><?php echo $elemento[$option]; ?></option>
			<?php 
			}	
			endforeach; 
	}else{
		echo '<option value="">-NO POSEE SUBCATEGORÍAS-</option>';
	}
?>
