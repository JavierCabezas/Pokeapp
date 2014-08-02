<?php $this->setPageTitle('Pokéapp - Actualizando pokémon para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Mi equipo'=>array('/torneo/miEquipo'),
	'Actualizando a '.$model->pokemonName,
);
?>

<h1>Actualizando a <?php echo $model->pokemonName ?> </h1>

<?php echo $this->renderPartial('_form', array(
	'model'				=> $model,
    'array_ability'		=> $array_ability,
    'array_moves'		=> $array_moves,
    'array_pokemon'		=> $array_pokemon,
    'array_nature'		=> $array_nature,
    'array_item'		=> $array_item,
    'array_tournament'	=> $array_tournament,
)); ?>