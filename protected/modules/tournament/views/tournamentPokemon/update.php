<?php $this->setPageTitle('Pokéapp - Actualizando pokémon para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario'=>array('/torneo/menuUsuario'),
	'Actualizando a '.$model->pokemonName,
);
?>

<h1>Actualizando a <?php echo $model->pokemonName ?> </h1>

<?php echo $this->renderPartial('_form', array(
	'model'				=> $model,
    'array_tournament'	=> $array_tournament,
)); ?>