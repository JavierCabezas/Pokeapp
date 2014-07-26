<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Mi equipo'=>array('/torneo/miEquipo'),
	'Crear',
);
?>

<h1>Agregar nuevo pokémon</h1>

<?php echo $this->renderPartial('_form', array(
	'model'				=> $model,
    'array_ability'		=> $array_ability,
    'array_moves'		=> $array_moves,
    'array_pokemon'		=> $array_pokemon,
    'array_nature'		=> $array_nature,
    'array_item'		=> $array_item,
)); ?>