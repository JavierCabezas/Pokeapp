<div class="view">

	<?php echo $data->idPokemonSpecies->image('moving'); ?>
	<?php echo CHtml::link(CHtml::encode($data->pokemonName), array('/torneo/modificarPokemon/', 'id' =>$data->id)) ?>
	<br />


</div>