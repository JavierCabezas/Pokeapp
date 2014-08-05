<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario'=>array('/torneo/menuUsuario'),
	'Crear pokémon'=>array('/torneo/agregarPokemon'),
	'Ver pokémon creado',
);
?>

<?php $this->renderPartial('_viewDetail', array(
	'model' => $model
));
?>

<div id="column2">
	<h2> Opciones de pokémon </h2>
	<p> <?php echo CHtml::link('Agregar otro pokémon al equipo', array('/torneo/agregarPokemon')) ?> </p>
	<p> <?php echo CHtml::link('Cometí un error! Modificar a '.$model->pokemonName, array('/torneo/modificarPokemon/', 'id' =>$model->id)) ?> </p>
	<p> <?php echo CHtml::link('Borrar a '.$model->pokemonName, array('/torneo/borrarPokemon/', 'id' =>$model->id),  array('confirm' => 'Se borrará el pokémon y se sacará de cualquier equipo existente. ¿Estás seguro/a de que quieres continuar?')) ?> </p>
	<p> &nbsp; </p>
	<p> <?php echo CHtml::link('Volver a mi perfil', array('/torneo/menuUsuario')) ?> </p>
</div>