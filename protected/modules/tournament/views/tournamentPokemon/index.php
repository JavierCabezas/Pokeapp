<?php $this->setPageTitle('Pokéapp - Listado de mis pokémon'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario'=>array('/torneo/menuUsuario'),
	'Listado de mis pokémon',
);
?>
<h1>Modificar pokémon</h1>

<p>Para editar un pokémon en específico haz click sobre su nombre. La lista de pokémon disponibles para edición es la siguiente:</p>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>

<?php echo CHtml::link('Volver al menú principal', array('/torneo/menuUsuario')) ?>