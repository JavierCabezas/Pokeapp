<?php $this->setPageTitle('Pokéapp - Crear  pokémon para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario'=>array('/torneo/menuUsuario'),
	'Crear nuevo pokémon a mi equipo',
);
?>

<h1 class="nuevopkmn">Agregar nuevo pokémon</h1>

<div class="infosec">
	<?php echo $this->renderPartial('_form', array(
		'model'				=> $model,
	    'array_tournament'	=> $array_tournament,
	)); ?>
</div>