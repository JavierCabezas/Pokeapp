<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Mi equipo'=>array('/torneo/miEquipo'),
	'Crear pokémon'=>array('/torneo/agregarPokemon'),
	'Ver pokémon creado',
);
?>
<div id="column1-wrap">
    <div id="column1">
		<h1>  <?php echo CHtml::image(Yii::app()->baseUrl.'/images/sprites_gif/'.$model->idPokemonSpecies->identifier.'.gif'); ?> Mi  <?php echo $model->pokemonName ?> </h1>


		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
					'name'  => 'id_pokemon_species',
					'value' => beautify($model->idPokemonSpecies->identifier)
				),
		        array(
		            'name' => 'Habilidad',
		            'value' => beautify($model->idAbility->abilityName),
		        ),
		        array(
		            'name' => 'Naturaleza',
		            'value' => beautify($model->idNature->natureName),
		        ),
		        array(
		            'name' => 'Item',
		            'value' => $model->idItem?ucfirst($model->idItem->itemName):"Ninguno",
		        ),
		        array(
		            'name' => 'Nivel',
		            'value' => $model->level,
		        ),
		        array(
		            'name' => 'Movimiento 1',
		            'value' => beautify($model->idMove1->moveName),
		        ),
		        array(
		            'name' => 'Movimiento 2',
		            'value' => $model->idMove2?ucfirst($model->idMove2->moveName):"Ninguno",
		        ),
		        array(
		            'name' => 'Movimiento 3',
		            'value' => $model->idMove3?ucfirst($model->idMove3->moveName):"Ninguno",
		        ),
		        array(
		            'name' => 'Movimiento 4',
		            'value' => $model->idMove4?ucfirst($model->idMove4->moveName):"Ninguno",
		        ),
		        array(
		            'name' => 'Hit points ',
		            'value' => $model->hp,
		        ),
		        array(
		            'name' => 'Attack ',
		            'value' => $model->atk,
		        ),
		        array(
		            'name' => 'Defense ',
		            'value' => $model->def,
		        ),
		        array(
		            'name' => 'Special Attack ',
		            'value' => $model->spa,
		        ),
		        array(
		            'name' => 'Special Defense ',
		            'value' => $model->spd,
		        ),
		        array(
		            'name' => 'Speed ',
		            'value' => $model->spe,
		        ),
			),
		));
		?>
	</div>
</div>

<div id="column2">
	<h2> Opciones de pokémon </h2>
	<p> <?php echo CHtml::link('Agregar otro pokémon al equipo', array('/torneo/agregarPokemon')) ?> </p>
	<p> <?php echo CHtml::link('Cometí un error! Modificar a '.$model->pokemonName, array('/torneo/modificarPokemon/', 'id' =>$model->id)) ?> </p>
	<p> <?php echo CHtml::link('Borrar a '.$model->pokemonName, array('/torneo/borrarPokemon/', 'id' =>$model->id),  array('confirm' => 'Se borrará el pokémon y se sacará de cualquier equipo existente. ¿Estás seguro/a de que quieres continuar?')) ?> </p>
	<p> &nbsp; </p>
	<p> <?php echo CHtml::link('Volver a mi perfil', array('/torneo/miEquipo')) ?> </p>
</div>