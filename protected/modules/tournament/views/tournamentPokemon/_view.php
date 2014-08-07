<div class="view">

	<div class="pkmnimg">	<?php echo $data->idPokemonSpecies->image('moving'); ?> </div>
	<h3><?php echo CHtml::encode($data->pokemonName) ?></h3>
	
	<div class="mod_btn">
		<p class="mod"> 
			<?php echo CHtml::link(CHtml::encode('Modificar'), 
				array('/torneo/modificarPokemon/', 'id' =>$data->id
			)) ?>
		</p>
		<p class="delete"> 
			<?php echo CHtml::link(CHtml::encode('Borrar'), 
					array( '/torneo/borrarPokemon/', 'id' =>$data->id),  
					array( 'confirm' => 'Se borrará completamente a '.$data->pokemonName.'. ¿Continuar?'
			)) ?>
		</p>
	</div>
</div>