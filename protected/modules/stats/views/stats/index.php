<h2> Calculadora de stats </h2>

<p> En este módulo puedes hacer una simulación de stats de algún pokémon y compararlo con otro. Puedes usar esta calculadora para hacer estimaciones de
los stats de tus pokémon antes de entrenarlos o estimar cuantos EV necesitarás entregarle a tu pokémon. </p>

<!-- Render the two forms partials -->
<div class='pokemon_1'>
	<?php $this->renderPartial('_form', array(
		'n' 			  		=> 1,
		'array_pokeymans' 		=> $array_pokeymans,
		'array_items' 	  		=> $array_items,
		'array_nature'			=> $array_nature,
		));
	?>
</div> <!-- end of form 1 -->

<div clas='pokemon_2'>
	<?php $this->renderPartial('_form', array(
		'n' 			  		=> 2,
		'array_pokeymans' 		=> $array_pokeymans,
		'array_items' 			=> $array_items,
		'array_nature'			=> $array_nature,
		));
	?>
</div> <!-- end of form 2 -->

<div class='result_1'>
	<?php $this->renderPartial('_showResults', array(
		'n'		 => 1,
		'pokemon' => null
	)); ?>
</div> <!-- end of results 1 -->

<div class='result_2'>
	<?php $this->renderPartial('_showResults', array(
		'n'		 => 2,
		'pokemon' => null
	)); ?>
</div> <!-- end of results 2 -->