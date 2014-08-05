<div class="view">

	<?php echo $data->idPokemonSpecies->image('moving'); ?>
	<?php echo CHtml::encode($data->pokemonName) ?>
	
	<p> 
		<?php echo CHtml::link(CHtml::encode('Modificar a '.$data->pokemonName), 
			array('/torneo/modificarPokemon/', 'id' =>$data->id
		)) ?>
	</p>
	<p> 
		<?php echo CHtml::link(CHtml::encode('Borrar a '.$data->pokemonName), 
				array( '/torneo/borrarPokemon/', 'id' =>$data->id),  
				array( 'confirm' => 'Se borrará completamente a '.$data->pokemonName.'. ¿Continuar?'
		)) ?>
	</p>

</div>